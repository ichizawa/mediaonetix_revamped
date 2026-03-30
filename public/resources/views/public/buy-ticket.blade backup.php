@extends('components.navbar-guest')

@section('content')
    @include('components.tac-priv-po')

    <div class="container py-5">
        <div class="row">
            <!-- Left Section: Booking Form -->
            <div class="col-md-7">
                <form action="{{ route('create.sale') }}" method="POST" id="form_1">
                    @csrf
                    <div class="step-container d-flex align-items-center mb-4">
                        <div class="step active" id="step-1-indicator">
                            <div class="circle">1</div>
                            <div class="step-text fw-bold">Book Your Ticket</div>
                        </div>
                        <div class="progress-line mx-2"></div>
                        <div class="step" id="step-2-indicator">
                            <div class="circle">2</div>
                            <div class="step-text">Payment</div>
                        </div>
                        <div class="progress-line mx-2"></div>
                        <div class="step" id="step-3-indicator">
                            <div class="circle">3</div>
                            <div class="step-text">Confirmation</div>
                        </div>
                    </div>

                    {{-- Step 1 Start --}}
                    <div class="card shadow-sm p-4 border-top border-5 border-dark" id="step-1">
                        <h5 class="fw-bold">Kindly fill out the form.</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="ticket_type" class="fw-bold" style="color: #0F355A !important;">Select
                                        Ticket Type</label>

                                    <select class="form-select form-control" id="selected_ticket" name="ticket_type">
                                        <option hidden selected value="">Select Ticket Type</option>
                                        @foreach ($event->tickets->reject(fn($t) => strtolower($t->ticket_type) === 'complimentary') as $ticket)
                                            <option value="{{ $ticket->id }}" data-price="{{ $ticket->ticket_price }}"
                                                data-type="{{ $ticket->ticket_type }}">
                                                {{ $ticket->ticket_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group has-feedback">
                                    <label for="quantity" class="fw-bold"
                                        style="color: #0F355A !important;">Quantity</label>
                                    <div class="input-group">
                                        <button type="button" class="btn btn-outline-secondary" id="decrease-quantity">
                                            <i class="bi bi-dash"></i>
                                        </button>
                                        <input type="number" name="quantity" class="form-control quantity text-center"
                                            value="1" min="1" max="10" readonly>
                                        <button type="button" class="btn btn-outline-secondary" id="increase-quantity">
                                            <i class="bi bi-plus"></i>
                                        </button>
                                        <small id="promoHelp" class="form-text text-muted d-none text-success">You are
                                            eligible for the
                                            promo 10 + 2 tickets</small>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label for="ticket_price" class="fw-bold" style="color: #0F355A !important;">Ticket
                                        Price</label>
                                    <div class="input-group">
                                        <span class="input-group-text">₱</span>
                                        <input type="text" class="form-control ticket_price" id="ticket_price"
                                            name="ticket_price" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label for="ticket_type" class="fw-bold" style="color: #0F355A !important;">Select
                                        Purchase Type</label>

                                    <select class="form-select form-control" id="selected_type" name="purchase_type">
                                        <option hidden selected value="">Select Purchase Type</option>
                                        <option value="student">Student</option>
                                        <option value="alumni">Alumni</option>
                                        <option value="employee">Employee</option>
                                        <option value="general_public">General Public</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group has-feedback">
                                    <label for="promo_code" class="fw-bold" style="color: #0F355A !important;">Promo Code
                                        (Optional)</label>
                                    <input type="text" class="form-control promo_code" id="promo_code" name="promo_code"
                                        placeholder="Enter Promo Code">
                                </div>
                                <small id="promoHelp" class="form-text text-muted d-none">
                                    Enter your promo code here to get discounts.
                                </small>
                                <small id="promoTrue" class="form-text text-muted d-none text-success">
                                    You are eligible for the discounted promo.
                                </small>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="full_name" class="fw-bold" style="color: #0F355A !important;">Full
                                        Name</label>
                                    <input type="text" class="form-control fname" name="full_name"
                                        placeholder="Enter Full Name">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="birthdate" class="fw-bold"
                                        style="color: #0F355A !important;">Birthdate</label>
                                    <input type="date" class="form-control" name="birthdate" id="birthdate">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="email" class="fw-bold" style="color: #0F355A !important;">Email
                                        Address</label>
                                    <input type="email" class="form-control email" name="email"
                                        placeholder="Enter Email Address">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="address" class="fw-bold" style="color: #0F355A !important;">Address</label>
                                    <input type="text" class="form-control address" name="address"
                                        placeholder="Enter Address">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="city" class="fw-bold" style="color: #0F355A !important;">City</label>
                                    <input type="text" class="form-control city" name="city" placeholder="Enter City">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="contact_num" class="fw-bold" style="color: #0F355A !important;">Contact
                                        Number</label>
                                    <input type="text" class="form-control phone" name="contact_num"
                                        placeholder="Enter Contact Number">
                                </div>
                            </div>

                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" id="terms_policy" required />
                                <label class="form-check-label" for="terms_policy">
                                    I agree to the <a href="#" data-bs-toggle="modal" data-bs-target="#PrivPoTaC"
                                        data-bs-toggle="tab" data-bs-target="#terms">Terms and
                                        Conditions</a> & <a href="#" data-bs-toggle="modal" data-bs-target="#PrivPoTaC"
                                        data-bs-toggle="tab" data-bs-target="#privacy">Privacy Policy</a>
                                </label>
                            </div>

                            <div class="col-md-12 mt-3">
                                <button type="button" id="next-1" class="btn btn-dark w-100 fw-bold" disabled="true"
                                    style="background-color: #0F355A !important;">Continue</button>
                            </div>
                        </div>
                    </div>

                    <script>
                        $(document).ready(function () {
                            $('#agreeTerms').click(function () {
                                $('#terms_policy').prop('checked', true);
                            });
                            $('#terms_policy').click(function () {
                                if ($(this).is(':checked')) {
                                    $('#next-1').prop('disabled', false);
                                }
                            });
                        });
                    </script>
                    {{-- Step 1 End --}}

                    {{-- Step 2 Start --}}
                    <div class="d-none" id="step-2">
                        <div class="card shadow-sm p-4 border-top border-5 border-dark">
                            <h5 class="fw-bold">Payment Amount:</h5>
                            <h3 class="text-sta fw-bold total_paymet">₱ </h3>
                            <p class="fw-bold mt-3">Payment for <strong id="event_title"></strong> Ticket</p>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Item Name</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                    </tr>
                                </thead>
                                <tbody id="payment_table">

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="2" class="text-end fw-bold">Total:</td>
                                        <td class="fw-bold text-sta total_paymet">₱ </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <div class="card shadow-sm p-4 payment-method-card">
                            <h5 class="fw-bold">Choose your Payment Method</h5>
                            <div class="payment-method-container">
                                <!-- <form id="payment_form">
                                 @csrf -->
                                <div id="payment_form">
                                    <div class="row g-2" id="payment-method-list">
                                        @php use Illuminate\Support\Str; @endphp
                                        @foreach ($processors as $processor)
                                            @if (Str::startsWith($processor['procId'], 'ABQR'))
                                                {{--@if (!Str::startsWith($processor['procId'], 'GC') &&
                                                !Str::startsWith($processor['procId'], 'PY')) --}}
                                                <div class="col-md-3">
                                                    <div class="card shadow-md payment-method-card-option w-100 h-50 d-flex flex-column justify-content-center align-items-center"
                                                        data-value="{{ $processor['procId'] }}">
                                                        <!-- {{ $processor['procId'] }} -->
                                                        <div
                                                            class="d-flex flex-column align-items-center justify-content-center text-center w-100">
                                                            <img width="100" class="mb-2" src="{{ $processor['logo'] }}" />
                                                            <span class="fs-6">{{ $processor['shortName'] }}</span>
                                                        </div>

                                                        <div class="checkmark d-none">
                                                            <i class="bi bi-check-circle-fill text-success fs-5"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach

                                        <script>
                                            $(document).ready(function () {
                                                $('.payment-method-card-option').on('click', function () {
                                                    $('.payment-method-card-option').removeClass('selected');
                                                    $('.checkmark').addClass('d-none');

                                                    $(this).addClass('selected');
                                                    $(this).find('.checkmark').removeClass('d-none');

                                                    $('#payment_method_input').val($(this).data('value'));
                                                });
                                            });
                                        </script>
                                        <input type="hidden" name="payment_method" id="payment_method_input" />
                                    </div>
                                </div>
                                <!-- </form> -->
                            </div>
                            <div class="d-flex justify-content-between gap-2">
                                <button type="button" class="btn btn-dark mt-3 flex-grow-1" id="prev-2">Back</button>
                                <button type="submit" class="btn btn-success fw-bold mt-3 flex-grow-1"
                                    id="next-2">Continue</button>
                            </div>
                        </div>

                        <!-- Include SweetAlert2 -->
                        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

                        <div class="card shadow-sm p-4 mt-4 d-none customer-contact-card">
                            <h5 class="fw-bold mb-3">Customer Contact Information</h5>

                            <div class="mb-3">
                                <label for="full_name" class="form-label fw-semibold">Full Name</label>
                                <input type="text" class="form-control" id="full_name" placeholder="Enter Full Name"
                                    readonly>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label fw-semibold">Email Address</label>
                                <input type="email" class="form-control" id="email" placeholder="Enter Email Address"
                                    readonly>
                            </div>

                            <div class="mb-3">
                                <label for="contact_number" class="form-label fw-semibold">Contact Number</label>
                                <input type="text" class="form-control" id="contact_number"
                                    placeholder="Enter Contact Number" readonly>
                            </div>

                            <div class="d-flex justify-content-between">
                                <button type="button" class="btn btn-outline-secondary px-4" id="btn-back">Back</button>
                                <button type="submit" class="btn btn-dark px-4 " id="complete_payment">Complete
                                    Payment</button>
                            </div>
                        </div>
                    </div>
                    {{-- Step 2 End --}}

                    {{-- Step 3 Start --}}
                    <div class="card shadow-sm p-4 border-top border-5 border-dark d-none" id="step-3">
                        <h4 class="fw-bold text-dark">Thank You For Your Purchase!</h4>
                        <h5 class="text-success">Your Ticket is Confirmed!</h5>
                        <p>Thank you for purchasing your ticket to <strong id="event-title"></strong> We're excited to have
                            you join us
                            for an unforgettable night of music and fun.</p>

                        <hr>

                        <!-- Event Details -->
                        <h5 class="fw-bold">Event Details:</h5>
                        <p><i class="fa-solid fa-calendar"></i> <strong
                                id="event-date">{{ date('F j, Y', strtotime($event->event_date)) }}</strong></p>
                        <p><i class="bi bi-clock"></i> <strong
                                id="event-time">{{ date('g:i A', strtotime($event->event_time)) }}</strong></p>
                        <p><i class="bi bi-geo-alt"></i> <strong id="event-loc">{{ $event->event_loc }}</strong></p>

                        <p>Your <strong>reference number</strong> has been sent to your email. Please check your inbox (and
                            spam
                            folder,
                            just in case!) for your ticket, reference number, and receipt.</p>

                        <!-- What's Next -->
                        <h5 class="fw-bold mt-4">What's Next?</h5>
                        <ul>
                            <li><strong>Bring Your Ticket:</strong> Don't forget to bring your digital or printed ticket on
                                the
                                day of the
                                event for entry.</li>
                            <li><strong>Reference Number:</strong> Keep your reference number handy for quick access or in
                                case
                                you need
                                support.</li>
                            <li><strong>Get Ready to Rock:</strong> We've got an amazing lineup waiting for you!</li>
                        </ul>

                        <p>We can't wait to see you at the event! If you have any questions or need assistance, feel free to
                            reach out to us
                            at <strong>ruinze@mediaoneph.com</strong> or call <strong>(082) 308 2126</strong>.</p>

                        <p class="fw-bold">Get ready for an epic night of music and memories!</p>

                        <button type="button" class="btn btn-sta mt-3" id="prev-3" onClick="window.location.href = '/'">Buy
                            Another Ticket</button>
                    </div>

                </form>
            </div>

            <!-- Right Section: Event Details -->
            <div class="col-md-5">
                <div class="card shadow-sm">
                    <div class="w-100 d-flex justify-content-center pt-5">
                        <img src="{{ $event->event_image ? (file_exists(storage_path('app/public/merchant/events/' . $event->event_image)) ? asset('storage/merchant/events/' . $event->event_image) : asset('storage/admin/events/' . $event->event_image)) : 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSH14L2EGQ7s9Pujw_3GBM63edV8TLiSDffRA&s' }}"
                            class="ticket-img card-img-top w-50 h-auto" alt="Event Poster">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title fw-bold">{{ $event->event_name }}</h5>
                        <p class="fw-light"> <i class="fa-solid fa-calendar me-2"></i>
                            {{ date('F j, Y', strtotime($event->event_date)) }}
                        </p>
                        <p class="fw-light"> <i class="fas fa-clock me-2"></i>
                            {{ date('g:i A', strtotime($event->event_time)) }}
                        </p>
                        <p class="fw-light"> <i class="fas fa-map-marker-alt me-2"></i> {{ $event->event_loc }}
                        </p>

                        <!-- <p><strong>Gate Fee:</strong> ₱350</p> -->
                    </div>
                </div>
                <div class="mt-3">
                    <h6 class="fw-bold" style="color: #0F355A99;">Ticket Information</h6>
                    <p style="color: #0F355A99;">A “Transaction Confirmation with Reference Number” will be sent via email
                        upon your completion of ticket booking with payment charged to your credit card. Note that it is
                        important that you provide us with a valid email address.</p>
                    <h6 class="fw-bold" style="color: #0F355A99;">Other Information</h6>
                    <ul>
                        <li style="color: #0F355A99;">No professional cameras or video recording equipment allowed.</li>
                        <li style="color: #0F355A99;">All ticket sales are final. No refunds or exchanges.</li>
                        <li style="color: #0F355A99;">In case of event cancellation, tickets will be refunded to the
                            original method of payment.</li>
                    </ul>
                </div>

            </div>
        </div>
    </div>

    @if($errors->any())
        <script>
            $(document).ready(function () {
                $.notify({
                    icon: 'fa fa-bell',
                    title: 'Error',
                    message: '{{ $errors->first() }}'
                }, {
                    type: 'danger',
                    placement: {
                        from: 'top',
                        align: 'right'
                    },
                    delay: 1500,
                    z_index: 9999
                })
            });
        </script>
    @endif

    <script>
        $(document).ready(function () {
            // Quantity selector functionality
            $('#increase-quantity').click(function () {
                var quantityInput = $('.quantity');
                var currentValue = parseInt(quantityInput.val()) || 1;
                var maxValue = parseInt(quantityInput.attr('max')) || 20;

                if (currentValue < maxValue) {
                    quantityInput.val(currentValue + 1).trigger('change');
                }
            });

            $('#decrease-quantity').click(function () {
                var quantityInput = $('.quantity');
                var currentValue = parseInt(quantityInput.val()) || 1;
                var minValue = parseInt(quantityInput.attr('min')) || 1;

                if (currentValue > minValue) {
                    quantityInput.val(currentValue - 1).trigger('change');
                }
            });

            $('.quantity').on('keydown', function (e) {
                e.preventDefault();
            });

            $('.quantity').on('blur', function () {
                var value = parseInt($(this).val()) || 1;
                var min = parseInt($(this).attr('min')) || 1;
                var max = parseInt($(this).attr('max')) || 10;

                if (value < min) {
                    $(this).val(min);
                } else if (value > max) {
                    $(this).val(max);
                }
            });

            // Bind change event to quantity once
            $('.quantity').on("change", function () {
                var selectedTicket = parseInt($('#selected_ticket').val());
                var qty = parseInt($(this).val()) || 0;

                if ((selectedTicket === 7 || selectedTicket === 8) && qty >= 10) {
                    $('#promoHelp').removeClass('d-none');
                } else {
                    $('#promoHelp').addClass('d-none');
                }
            });

            // Trigger quantity check when ticket changes
            $('#selected_ticket').on('change', function () {
                $('.quantity').trigger('change');
            });
        });
    </script>
@endsection
