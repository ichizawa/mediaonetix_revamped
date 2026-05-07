<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Events;
use App\Models\MerchantFiles;
use App\Models\ShowCases;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class EventsController extends Controller
{
    private function resolveUploadExtension(UploadedFile $file): string
    {
        $extension = $file->guessExtension()
            ?: $file->extension()
            ?: $file->getClientOriginalExtension();

        $extension = strtolower((string) $extension);

        if ($extension === '' || !preg_match('/^[a-z0-9]+$/', $extension)) {
            return 'jpg';
        }

        return $extension;
    }

    private function storePerformerImageIfNeeded(?string $value): ?string
    {
        if ($value === null) {
            return null;
        }

        $trimmed = trim($value);
        if ($trimmed === '') {
            return null;
        }

        if (!Str::startsWith($trimmed, 'data:image/')) {
            return $trimmed;
        }

        if (!preg_match('/^data:image\/([a-zA-Z0-9.+-]+);base64,(.*)$/s', $trimmed, $matches)) {
            return null;
        }

        $mimeSubtype = strtolower($matches[1]);
        $rawBase64 = str_replace(' ', '+', $matches[2]);
        $binary = base64_decode($rawBase64, true);
        if ($binary === false || $binary === '') {
            return null;
        }

        $extension = match ($mimeSubtype) {
            'jpeg', 'jpg' => 'jpg',
            'png' => 'png',
            'gif' => 'gif',
            'webp' => 'webp',
            'svg+xml', 'svg' => 'svg',
            default => 'jpg',
        };

        File::ensureDirectoryExists(public_path('images/events/performers'));
        $fileName = 'pf_' . Str::uuid()->toString() . '.' . $extension;
        file_put_contents(public_path('images/events/performers/' . $fileName), $binary);

        return $fileName;
    }

    private function normalizePerformerImage(?string $value): ?string
    {
        return $this->storePerformerImageIfNeeded($value);
    }

    private function normalizePerformersPayload(?string $performersJson): array
    {
        if ($performersJson === null || trim($performersJson) === '') {
            return [];
        }

        $decoded = json_decode($performersJson, true);
        if (!is_array($decoded)) {
            return [];
        }

        $normalized = [];
        foreach ($decoded as $item) {
            if (!is_array($item)) {
                continue;
            }

            $name = trim((string) ($item['name'] ?? ''));
            if ($name === '') {
                continue;
            }

            $id = isset($item['id']) && $item['id'] !== '' ? (int) $item['id'] : null;
            $image = $this->normalizePerformerImage(isset($item['image']) ? (string) $item['image'] : null);

            $normalized[] = [
                'id' => $id,
                'name' => $name,
                'image' => $image,
            ];
        }

        return $normalized;
    }

    public function index()
    {

        $eventsQuery = Auth::user()->isAdmin()
            ? Events::with(['tickets', 'latestShowcase'])
            : Events::getEventByMerchant(Auth::user()->id)
            ->with(['tickets', 'latestShowcase'])
            ->where('created_by', Auth::user()->id);

        $events = $eventsQuery->get();


        $tickets_sold = $events->sum('tickets_sold');
        $upcoming_events = $eventsQuery->getUpcoming()->count();
        $active_events = $eventsQuery->getActive()->count();
        $total_events = $eventsQuery->count();

        return view(auth()->user()->routePrefix() . '.events', [
            'tickets_sold' => $tickets_sold,
            'upcoming_events' => $upcoming_events,
            'active_events' => $active_events,
            'total_events' => $total_events,
            'events' => $events,

        ]);
    }
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $request->validate([
                'event_id'           => 'nullable|integer|exists:events,id',
                'name'               => 'required|string',
                'location'           => 'required|string',
                'category'           => 'required|string',
                'description'        => 'required|string',
                'date'               => 'required|date',
                'time'               => 'required|string',
                'status'             => 'required|string',
                'image'              => 'nullable|image|mimetypes:image/jpeg,image/png,image/gif,image/svg+xml,image/webp|max:15360',
                'seat_plan'          => 'nullable|image|mimetypes:image/jpeg,image/png,image/gif,image/svg+xml,image/webp|max:15360',
                'crop_x'             => 'nullable|numeric',
                'crop_y'             => 'nullable|numeric',
                'crop_width'         => 'nullable|numeric',
                'crop_height'        => 'nullable|numeric',
                'crop_natural_width'  => 'nullable|numeric',
                'crop_natural_height' => 'nullable|numeric',
                'performers'         => 'nullable|string',
            ]);

            $normalizedPerformers = $this->normalizePerformersPayload($request->input('performers'));
            $imageName = '';

            if ($request->hasFile('image')) {
                File::ensureDirectoryExists(public_path('images/events'));
                $image = $request->file('image');
                $imageName = Str::uuid()->toString() . '.' . $this->resolveUploadExtension($image);
                $image->move(public_path('images/events'), $imageName);
            }

            $seatPlanName = null;
            if ($request->hasFile('seat_plan')) {
                File::ensureDirectoryExists(public_path('images/events/seat_plan'));
                $seatPlan = $request->file('seat_plan');
                $seatPlanName = 'sp_' . Str::uuid()->toString() . '.' . $this->resolveUploadExtension($seatPlan);
                $seatPlan->move(public_path('images/events/seat_plan'), $seatPlanName);
            }

            $event = new Events();
            $event->event_name = $request->name;
            $event->category = $request->category;
            $event->description = $request->description;
            $event->event_image = $imageName ?? null;
            $event->seat_plan = $seatPlanName;
            $event->event_date = $request->date;
            $event->event_time = $request->time;
            $event->event_venue = $request->location;
            $event->event_total_tickets = 0;
            $event->status = $request->status;
            $event->created_by = Auth::user()->id;
            $event->approved_at = null;
            $event->rejected_at = null;
            $event->crop_x = $request->crop_x;
            $event->crop_y = $request->crop_y;
            $event->crop_width = $request->crop_width;
            $event->crop_height = $request->crop_height;
            $event->crop_natural_width = $request->crop_natural_width;
            $event->crop_natural_height = $request->crop_natural_height;
            $event->performers = !empty($normalizedPerformers) ? json_encode($normalizedPerformers) : null;
            // $event->slug = Str::slug($request->name);
            $event->save();

            DB::commit();

            return back()->with('success', 'Event created successfully');
        } catch (ValidationException $e) {
            DB::rollBack();
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors($e->getMessage())->withInput();
        }
    }
    public function update(Request $request)
    {
        try {
            DB::beginTransaction();

            $request->validate([
                'id'                 => 'required|integer|exists:events,id',
                'name'               => 'required|string',
                'location'           => 'required|string',
                'category'           => 'required|string',
                'description'        => 'required|string',
                'date'               => 'required|date',
                'time'               => 'required|string',
                'status'             => 'required|string',
                'image'              => 'nullable|image|mimetypes:image/jpeg,image/png,image/gif,image/svg+xml,image/webp|max:15360',
                'seat_plan'          => 'nullable|image|mimetypes:image/jpeg,image/png,image/gif,image/svg+xml,image/webp|max:15360',
                'crop_x'             => 'nullable|numeric',
                'crop_y'             => 'nullable|numeric',
                'crop_width'         => 'nullable|numeric',
                'crop_height'        => 'nullable|numeric',
                'crop_natural_width'  => 'nullable|numeric',
                'crop_natural_height' => 'nullable|numeric',
                'performers'         => 'nullable|string',
            ]);

            $normalizedPerformers = $this->normalizePerformersPayload($request->input('performers'));

            $event = Events::find($request->id);
            $event->event_name = $request->name;
            $event->category = $request->category;
            $event->description = $request->description;
            if ($request->hasFile('image')) {
                File::ensureDirectoryExists(public_path('images/events'));
                $image = $request->file('image');
                $imageName = Str::uuid()->toString() . '.' . $this->resolveUploadExtension($image);
                $image->move(public_path('images/events'), $imageName);
                $event->event_image = $imageName;
            }
            if ($request->hasFile('seat_plan')) {
                File::ensureDirectoryExists(public_path('images/events/seat_plan'));
                $seatPlan = $request->file('seat_plan');
                $seatPlanName = 'sp_' . Str::uuid()->toString() . '.' . $this->resolveUploadExtension($seatPlan);
                $seatPlan->move(public_path('images/events/seat_plan'), $seatPlanName);
                $event->seat_plan = $seatPlanName;
            }
            $event->event_date = $request->date;
            $event->event_time = $request->time;
            $event->event_venue = $request->location;
            // $event->event_total_tickets = 0;
            $event->status = $request->status;
            $event->crop_x = $request->crop_x;
            $event->crop_y = $request->crop_y;
            $event->crop_width = $request->crop_width;
            $event->crop_height = $request->crop_height;
            $event->crop_natural_width = $request->crop_natural_width;
            $event->crop_natural_height = $request->crop_natural_height;
            $event->performers = !empty($normalizedPerformers) ? $normalizedPerformers : null;
            if ($request->filled('approved_at')) {
                $event->approved_at = now();
            }

            $event->save();

            DB::commit();

            return back()->with('success', 'Event updated successfully');
        } catch (ValidationException $e) {
            DB::rollBack();
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors($e->getMessage())->withInput();
        }
    }
    public function delete($event_id)
    {
        Events::where('id', $event_id)->delete();

        return back()->with('success', 'Event deleted successfully');
    }
    public function setActive(Request $request)
    {
        try {
            $event = Events::where('slug', $request->input('slug'))->firstOrFail();

            $showcase = ShowCases::where('event_id', $event->id)
                ->where('user_id', Auth::id())
                ->first();

            if ($showcase) {
                $showcase->delete();

                $message = 'Event removed from showcase';
            } else {
                ShowCases::create([
                    'event_id' => $event->id,
                    'user_id' => Auth::id(),
                    'position' => 1
                ]);

                $message = 'Event placed in showcase';
            }

            return response()->json([
                'success' => true,
                'data' => null,
                'message' => $message
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'data' => null,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function approvalPage($event_id)
    {
        $event = Events::with('tickets')->findOrFail($event_id);

        if (!Auth::user()->isAdmin() && (int) $event->created_by !== (int) Auth::id()) {
            abort(403);
        }

        $submittedFiles = MerchantFiles::query()
            ->where('merchant_id', Auth::id())
            ->where('event_id', $event->id)
            ->latest()
            ->get();

        $submissionStatusCode = 0;
        if ($submittedFiles->isNotEmpty()) {
            $rawStatuses = $submittedFiles->map(fn($file) => (int) $file->getRawOriginal('status'));

            if ($rawStatuses->contains(2)) {
                $submissionStatusCode = 2;
            } elseif ($rawStatuses->every(fn($status) => $status === 1)) {
                $submissionStatusCode = 1;
            }
        }

        $submissionSummary = [
            'has_submission' => $submittedFiles->isNotEmpty(),
            'status_code' => $submissionStatusCode,
            'status' => MerchantFiles::STATUS[$submissionStatusCode] ?? MerchantFiles::STATUS[0],
            'can_edit' => $submittedFiles->isNotEmpty() && $submissionStatusCode === 0,
            'rejection_reason' => $submittedFiles->first(fn($file) => filled($file->rejection_reason))?->rejection_reason,
            'documents' => $submittedFiles
                ->groupBy(fn($file) => $file->document_title ?: 'Document')
                ->map(function ($group, $title) {
                    return [
                        'title' => $title,
                        'count' => $group->count(),
                        'files' => $group->values()->map(function ($file) {
                            $extension = strtolower(pathinfo($file->file_path, PATHINFO_EXTENSION));

                            return [
                                'id' => $file->id,
                                'title' => $file->document_title ?: $file->file_name,
                                'url' => asset($file->file_path),
                                'extension' => $extension,
                                'is_image' => in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp']),
                                'is_pdf' => $extension === 'pdf',
                            ];
                        }),
                    ];
                })
                ->values(),
        ];

        return view('merchant.approval-event', [
            'event' => $event,
            'submissionSummary' => $submissionSummary,
        ]);
    }

    public function uploadApprovalDocuments(Request $request, $event_id)
    {
        try {
            DB::beginTransaction();

            $event = Events::findOrFail($event_id);
            if (!Auth::user()->isAdmin() && (int) $event->created_by !== (int) Auth::id()) {
                abort(403);
            }

            $request->validate([
                'documents' => 'required|array|min:3',
                'documents.*.title' => 'required|string|max:255',
                'documents.*.images' => 'required|array|min:1|max:3',
                'documents.*.images.*' => 'required|file|image|mimes:jpg,jpeg,png,webp|max:20480',
            ]);

            $documents = $request->input('documents', []);
            $firstTitle = trim((string) ($documents[0]['title'] ?? ''));
            if (strcasecmp($firstTitle, 'Business Permit') !== 0) {
                return back()->withErrors([
                    'documents.0.title' => 'The first document type must be Business Permit.',
                ])->withInput();
            }

            $destination = public_path('uploads/merchant_files');
            if (!is_dir($destination)) {
                mkdir($destination, 0755, true);
            }

            $uploadedDocuments = $request->file('documents', []);
            foreach ($documents as $index => $document) {
                $title = trim((string) ($document['title'] ?? ''));
                $images = $uploadedDocuments[$index]['images'] ?? [];

                foreach ($images as $image) {
                    $storedName = time() . '_' . Str::random(8) . '_' . $image->getClientOriginalName();
                    $image->move($destination, $storedName);

                    MerchantFiles::create([
                        'file_name' => $storedName,
                        'document_title' => $title,
                        'file_path' => 'uploads/merchant_files/' . $storedName,
                        'merchant_id' => Auth::id(),
                        'event_id' => $event->id,
                        'status' => 0,
                    ]);
                }
            }

            DB::commit();
            return back()->with('success', 'Documents uploaded successfully.');
        } catch (ValidationException $e) {
            DB::rollBack();
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors($e->getMessage())->withInput();
        }
    }

    public function updateApprovalDocuments(Request $request, $event_id)
    {
        try {
            DB::beginTransaction();

            $event = Events::findOrFail($event_id);
            if (!Auth::user()->isAdmin() && (int) $event->created_by !== (int) Auth::id()) {
                abort(403);
            }

            $request->validate([
                'replacements' => 'nullable|array',
                'replacements.*' => 'required|file|image|mimes:jpg,jpeg,png,webp|max:20480',
            ]);

            $submittedFiles = MerchantFiles::query()
                ->where('merchant_id', Auth::id())
                ->where('event_id', $event->id)
                ->where('status', 0)
                ->get();

            if ($submittedFiles->isEmpty()) {
                return back()->withErrors(['submission' => 'This submission is no longer editable.']);
            }

            $replacementFiles = $request->file('replacements', []);
            $destination = public_path('uploads/merchant_files');
            if (!is_dir($destination)) {
                mkdir($destination, 0755, true);
            }

            foreach ($replacementFiles as $fileId => $replacement) {
                $merchantFile = $submittedFiles->firstWhere('id', (int) $fileId);
                if (! $merchantFile) {
                    continue;
                }

                $storedName = time() . '_' . Str::random(8) . '_' . $replacement->getClientOriginalName();
                $replacement->move($destination, $storedName);

                $oldPath = public_path($merchantFile->file_path);
                if (is_file($oldPath)) {
                    @unlink($oldPath);
                }

                $merchantFile->file_name = $storedName;
                $merchantFile->file_path = 'uploads/merchant_files/' . $storedName;
                $merchantFile->status = 0;
                $merchantFile->rejection_reason = null;
                $merchantFile->save();
            }

            DB::commit();

            return back()->with('success', 'Submission updated successfully.');
        } catch (ValidationException $e) {
            DB::rollBack();
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors($e->getMessage())->withInput();
        }
    }

    public function approve($event_id)
    {
        $event = Events::find($event_id);
        $event->approved_at = now();
        $event->status = 1;
        $event->save();

        return back()->with('success', 'Event approved successfully');
    }

    public function reject($event_id)
    {
        $event = Events::find($event_id);
        $event->rejected_at = now();
        $event->save();

        return back()->with('success', 'Event rejected successfully');
    }
}
