<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MerchantRequest;
use App\Models\MerchantFiles;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class MerchantController extends Controller
{
    public function index()
    {
        $users = User::merchants()->withCount('events')->paginate(10);
        $active = User::active()->merchants()->count();
        $inactive = User::inactive()->merchants()->count();
        $pending = User::pending()->merchants()->count();
        return view('admin.merchants', compact('users', 'active', 'inactive', 'pending'));
    }

    public function store(MerchantRequest $request)
    {
        try {
            DB::beginTransaction();

            $genderMap = [
                'male' => 0,
                'female' => 1,
                'other' => 2,
            ];

            $data = $request->validated();

            $merchant = new User();
            $merchant->name = $data['name'];
            $merchant->email = $data['email'];
            $merchant->username = $data['username'];
            $merchant->first_name = $data['first_name'];
            $merchant->last_name = $data['last_name'];
            $merchant->phone_number = $data['phone_number'];
            $merchant->city = $data['city'];
            $merchant->dob = $data['dob'];
            $merchant->gender = $genderMap[$data['gender']];
            $merchant->country = $data['country'];
            $merchant->zip_code = $data['zip_code'];
            $merchant->address = $data['address'];

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images/merchants'), $imageName);
                $merchant->image = $imageName;
            }

            $merchant->email = $data['email'];
            $merchant->email_verified_at = now();
            $merchant->is_active = 1;
            $merchant->password = $data['password'];
            $merchant->role_id = Role::where('type', 'merchant')->first()->id;
            $merchant->password = Hash::make($data['password']);
            $merchant->save();

            Log::info('Merchant Created Successfully');

            DB::commit();
            return back()->with('success', 'Merchant Created Successfully');
        } catch (ValidationException $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return back()->withErrors($e->getMessage())->withInput();
        }
    }

    public function files($id)
    {
        $merchant = User::findOrFail($id);

        $files = MerchantFiles::with(['merchant', 'event'])
            ->where('merchant_id', $id)
            ->whereNotNull('event_id')
            ->latest()
            ->get();

        $submissions = $files
            ->groupBy('event_id')
            ->map(function ($group) {
                $firstFile = $group->first();
                $event = $firstFile?->event;
                $merchant = $firstFile?->merchant;
                $rawStatuses = $group->map(fn ($file) => (int) $file->getRawOriginal('status'));
                $statusCode = $rawStatuses->contains(2)
                    ? 2
                    : ($rawStatuses->every(fn ($status) => $status === 1) ? 1 : 0);

                return [
                    'event_id' => $event?->id,
                    'event_name' => $event?->event_name ?? 'Unknown Event',
                    'event_date' => $event?->event_date,
                    'merchant_name' => $merchant?->name ?? 'Unknown Merchant',
                    'status_code' => $statusCode,
                    'status' => MerchantFiles::STATUS[$statusCode] ?? MerchantFiles::STATUS[0],
                    'rejection_reason' => $group->first(fn ($file) => filled($file->rejection_reason))?->rejection_reason,
                    'file_count' => $group->count(),
                    'files' => $group->values()->map(function ($file) {
                        $extension = strtolower(pathinfo($file->file_name, PATHINFO_EXTENSION));

                        return [
                            'id' => $file->id,
                            'title' => $file->document_title ?: $file->file_name,
                            'file_name' => $file->file_name,
                            'file_path' => asset($file->file_path),
                            'extension' => $extension,
                            'is_image' => in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp']),
                            'is_pdf' => $extension === 'pdf',
                            'created_at' => $file->created_at?->format('Y-m-d H:i'),
                        ];
                    }),
                ];
            })
            ->sortByDesc('event_id')
            ->values();

        $stats = [
            'total' => $submissions->count(),
            'pending' => $submissions->where('status_code', 0)->count(),
            'approved' => $submissions->where('status_code', 1)->count(),
            'rejected' => $submissions->where('status_code', 2)->count(),
        ];

        return view('admin.component.merchant.files.files', compact('merchant', 'submissions', 'stats'));
    }

    public function reviewSubmission(Request $request, $id, $eventId)
    {
        try {
            $request->validate([
                'action' => 'required|in:approve,reject',
                'reason' => 'nullable|string|max:1000|required_if:action,reject',
            ]);

            $merchant = User::findOrFail($id);
            $files = MerchantFiles::where('merchant_id', $merchant->id)
                ->where('event_id', $eventId)
                ->get();

            if ($files->isEmpty()) {
                abort(404);
            }

            $status = $request->input('action') === 'approve' ? 1 : 2;
            $reason = $status === 2 ? trim((string) $request->input('reason')) : null;

            foreach ($files as $file) {
                $file->status = $status;
                $file->rejection_reason = $reason;
                $file->save();
            }

            return back()->with('success', $status === 1 ? 'Submission approved successfully.' : 'Submission rejected successfully.');
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    public function update(MerchantRequest $request, $id)
    {
        try {
            DB::beginTransaction();

            $genderMap = [
                'male' => 0,
                'female' => 1,
                'other' => 2,
            ];

            $data = $request->validated();

            $merchant = User::findOrFail($id);
            $merchant->name = $data['name'];
            $merchant->email = $data['email'];
            $merchant->username = $data['username'];
            $merchant->first_name = $data['first_name'];
            $merchant->last_name = $data['last_name'];
            $merchant->phone_number = $data['phone_number'];
            $merchant->city = $data['city'];
            $merchant->dob = $data['dob'];
            $merchant->gender = $genderMap[$data['gender']];
            $merchant->country = $data['country'];
            $merchant->zip_code = $data['zip_code'];
            $merchant->address = $data['address'];

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images/merchants'), $imageName);
                $merchant->image = $imageName;
            }

            // Only update password if provided
            if (!empty($data['password'])) {
                $merchant->password = Hash::make($data['password']);
            }

            $merchant->is_active = 1;
            $merchant->role_id = Role::where('type', 'merchant')->first()->id;
            $merchant->save();

            Log::info('Merchant Updated Successfully');

            DB::commit();
            return back()->with('success', 'Merchant Updated Successfully');
        } catch (ValidationException $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return back()->withErrors($e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $merchant = User::findOrFail($id);
            $merchant->delete();

            Log::info('Merchant Deleted Successfully');

            return back()->with('success', 'Merchant Deleted Successfully');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back()->withErrors($e->getMessage());
        }
    }

    public function uploadMerchantFiles(Request $request, $merchant_id)
    {
        try {
            DB::beginTransaction();

            $request->validate([
                'file' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            ]);

            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/merchant_files'), $fileName);

            MerchantFiles::create([
                'file_name' => $fileName,
                'file_path' => 'uploads/merchant_files/' . $fileName,
                'merchant_id' => $merchant_id,
                'status' => 0, // Pending by default
            ]);

            Log::info('Merchant File Uploaded Successfully');

            DB::commit();
            return back()->with('success', 'File Uploaded Successfully');
        } catch (ValidationException $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return back()->withErrors($e->getMessage())->withInput();
        }
    }
}
