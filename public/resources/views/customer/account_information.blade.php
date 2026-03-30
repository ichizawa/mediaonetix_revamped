@extends('components.customer_navbar')

@section('content')

<div class="container py-5">
    <div class="row justify-content-center">
        <!-- Left Section: Account and Event Info -->
        <div class="col-md-7">
            <div class="card shadow-sm p-4 border-top border-5 border-dark">
                <h5 class="fw-bold text-dark mb-2">Account Information</h5>
                <hr>
                <h6 class="fw-bold">Hello, {{ Auth::user()->name ?? 'User' }}!</h6>
                <p>Your Account is Created.</p>
                <p>Thank you for purchasing your ticket to <strong>{{ $event->event_name ?? 'Davao Grunge Night' }}</strong>! We're excited to have you join us for an unforgettable night of music and fun.</p>
                <hr>
                <!-- Event Details -->
                <h6 class="fw-bold">Event Details:</h6>
                <p><i class="fa-solid fa-calendar"></i> <strong>{{ $event->event_date ? date('F j, Y', strtotime($event->event_date)) : 'May 1, 2025' }}</strong></p>
                <p><i class="bi bi-clock"></i> <strong>{{ $event->event_time ? date('g:i A', strtotime($event->event_time)) : '6:00 PM' }}</strong></p>
                <p><i class="bi bi-geo-alt"></i> <strong>{{ $event->event_loc ?? 'Mic 1 Live Room' }}</strong></p>
                <p>Your <strong>reference number</strong> has been sent to your email. Please check your inbox (and spam folder, just in case) for your ticket, reference number, and receipt.</p>
                <h6 class="fw-bold mt-4">What's Next?</h6>
                <ul>
                    <li><strong>Bring Your Ticket:</strong> Don't forget to bring your digital or printed ticket on the day of the event for entry.</li>
                    <li><strong>Reference Number:</strong> Keep your reference number handy for quick access or in case you need support.</li>
                    <li><strong>Get Ready to Rock:</strong> We've got an amazing lineup waiting for you!</li>
                </ul>
                <p>We can't wait to see you at the event! If you have any questions or need assistance, feel free to reach out to us at <strong>ruinze@mediaoneph.com</strong> or call <strong>(082) 308 2126</strong>.</p>
                <p class="fw-bold">Ready to take control of your account?</p>
                <p>Click the button below to set your password and get started with MediaOne Tix.</p>
                <!-- <button class="btn btn-dark w-100" onclick="window.location.href='{{ route('change_password') }}'">Reset Password</button> -->

            </div>
        </div>
        <!-- Right Section: Event Poster and Ticket Status -->
        <div class="col-md-5 mt-4 mt-md-0">
            <div class="card shadow-sm">
                <div class="w-100 d-flex justify-content-center pt-4">
                    <img src="{{ $event->event_image ? asset('storage/admin/events/' . $event->event_image) : 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSH14L2EGQ7s9Pujw_3GBM63edV8TLiSDffRA&s' }}" class="ticket-img card-img-top w-75 h-auto" alt="Event Poster">
                </div>
                <div class="card-body text-center">
                    <h5 class="card-title fw-bold">{{ $event->event_name ?? 'Davao Grunge Night' }}</h5>
                    <p class="fw-lighter mb-1"><i class="fa-solid fa-calendar"></i> {{ $event->event_date ? date('F j, Y', strtotime($event->event_date)) : 'May 1, 2025' }}</p>
                    <p class="fw-lighter mb-1"><i class="fas fa-clock"></i> {{ $event->event_time ? date('g:i A', strtotime($event->event_time)) : '6:00 PM' }}</p>
                    <p class="fw-lighter mb-2"><i class="fas fa-map-marker-alt"></i> {{ $event->event_loc ?? 'Mic 1 Live Room' }}</p>
                    <span class="badge bg-success fs-6 mb-2">Ticket Confirmed</span>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-5">
        <h5 class="fw-bold mb-3">Ticket Payment Details</h5>
        <div class="card shadow-sm p-4 border-top border-5 border-dark">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <div>
                    <span class="fw-bold">Payment Amount:</span>
                    <span class="fs-4 fw-bold text-dark">₱ {{ $payment_amount ?? '350.00' }}</span>
                </div>
                <div>
                    <span class="fw-bold">Payment Method:</span>
                    <span class="fs-5 fw-bold text-primary">{{ $payment_method ?? 'GCash' }}</span>
                </div>
            </div>
            <hr>
            <div class="mb-2">
                <span class="fw-bold">Payment for <span class="text-dark">{{ $event->event_name ?? 'Davao Grunge Night' }}</span> Ticket</span>
            </div>
            <div>
                <span class="fw-bold">Ticket Items:</span>
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th>Item Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="fw-bold">Gen Ad <br><small class="text-muted">₱ 350.00 / unit</small></td>
                            <td>1</td>
                            <td>₱ 350.00</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2" class="text-end fw-bold">Total:</td>
                            <td class="fw-bold text-dark">₱ {{ $payment_amount ?? '350.00' }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-6">
                <h6 class="fw-bold" style="color: #0F355A99;">Ticket Information</h6>
                <p style="color: #0F355A99; font-size: 0.95rem;">A "Transaction Confirmation with Reference Number" will be sent via email upon your completion of ticket booking with payment charged to your credit card. Note that it is important that you provide us with a valid email address.</p>
            </div>
            <div class="col-md-6">
                <h6 class="fw-bold" style="color: #0F355A99;">Other Information</h6>
                <ul style="color: #0F355A99; font-size: 0.95rem;">
                    <li>No professional cameras or video recording equipment allowed.</li>
                    <li>All ticket sales are final. No refunds or exchanges.</li>
                    <li>In case of event cancellation, tickets will be refunded to the original method of payment.</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection