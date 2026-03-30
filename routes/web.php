<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PublicController;
use App\Models\Sales;
use App\Models\Tickets;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

Route::get('/', [PublicController::class, 'index'])->name('public');
Route::get('show-case/events', [PublicController::class, 'events'])->name('public.events');
Route::get('coming-soon', [PublicController::class, 'coming_soon'])->name('public.coming.soon');
Route::get('event/{id}', [PublicController::class, 'event_details'])->name('public.event.details');

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'post'])->name('login.post');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'postRegister'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->name('verification.notice');

Route::get('/email/verify/expired', function () {
    return view('auth.verify-expired');
})->name('verification.expired');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect()->route('login')->with('success', 'Account activated! You can now log in.');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('success', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::middleware(['auth', 'verified'])->group(function () {
    require base_path('routes/admin/admin.php');
    require base_path('routes/merchants/merchants.php');
    require base_path('routes/staff/staff.php');
});

Route::get('/ticket-view', function () {
            $tickets = Tickets::find(7);

            $my_ticket = Sales::with(['ticket', 'customer_tickets'])
                ->where('customer_email', auth()->user()->email)
                ->first(); // 👈 single record, not collection

            if ($my_ticket && $my_ticket->customer_tickets) {
                $qrcode = QrCode::size(250)->generate($my_ticket->customer_tickets->reference_num);

                // attach QR code dynamically (not saved in DB, just passed to view)
                $my_ticket->customer_tickets->qrcode = $qrcode;
            }

            return view('mail.ticket', [
                'tick' => $tickets,
                'sales' => $my_ticket
            ]);
        })->name('ticket.view');

