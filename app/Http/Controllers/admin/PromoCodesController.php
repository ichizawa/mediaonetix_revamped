<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PromoCodesRequest;
use App\Models\PromoCodes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class PromoCodesController extends Controller
{
    public function index()
    {

    }
    public function store(PromoCodesRequest $request)
    {
        try {
            DB::beginTransaction();

            $valid = $request->validated();

            $type = [
                'percentage' => 0,
                'fixed' => 1
            ];

            PromoCodes::create([
                'slug' => $valid['code'],
                'amount' => $valid['value'],
                'type' => $type[$valid['type']],
                'event_id' => $valid['event_id'],
                'user_id' => Auth::user()->id,
                'status' => 1,
                'valid' => $valid['valid'],
                'quantity' => $valid['limit']
            ]);

            DB::commit();
            return back()->with('success', 'Promo Code Created Successfully');
        } catch (ValidationException $e) {
            DB::rollBack();
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors($e->getMessage())->withInput();
        }
    }
}
