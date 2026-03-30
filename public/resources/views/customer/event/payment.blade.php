<style>
    .offcanvas-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }

    .ticket-info-card {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        border-radius: 12px;
        color: white;
        border: none;
    }

    .payment-summary {
        background-color: #f8f9fa;
        border-left: 4px solid #667eea;
    }

    .payment-method {
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .payment-method:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .payment-method.selected {
        border: 2px solid #667eea !important;
        background-color: #f8f9ff;
    }

    .btn-pay {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        padding: 12px 30px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .btn-pay:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
    }

    .form-control:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }

    .progress-bar {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
</style>
<div class="offcanvas offcanvas-end" tabindex="-1" id="paymentOffcanvas" style="width: 450px;">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title fw-bold">
            <i class="fas fa-ticket-alt me-2"></i>Complete Your Payment
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
    </div>

    <div class="offcanvas-body p-0">
        <!-- Ticket Information -->
        <div class="p-4">
            <div class="card ticket-info-card mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h6 class="card-title mb-1 fw-bold">Summer Music Festival 2024</h6>
                            <p class="card-text mb-2 opacity-90">
                                <i class="fas fa-calendar me-1"></i>Aug 25, 2024 • 7:00 PM
                            </p>
                            <p class="card-text mb-0 opacity-90">
                                <i class="fas fa-map-marker-alt me-1"></i>Central Park Arena
                            </p>
                        </div>
                        <div class="text-end">
                            <span class="badge bg-light text-dark">VIP</span>
                        </div>
                    </div>

                    <hr class="border-white-50">

                    <div class="row text-center">
                        <div class="col-4">
                            <small class="opacity-75">Ticket ID</small>
                            <div class="fw-bold">#TK-2024-001</div>
                        </div>
                        <div class="col-4">
                            <small class="opacity-75">Quantity</small>
                            <div class="fw-bold">2 Tickets</div>
                        </div>
                        <div class="col-4">
                            <small class="opacity-75">Section</small>
                            <div class="fw-bold">A-12</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payment Summary -->
            <div class="payment-summary p-3 rounded mb-4">
                <h6 class="fw-bold text-dark mb-3">Payment Summary</h6>
                <div class="d-flex justify-content-between mb-2">
                    <span>Ticket Price (2x)</span>
                    <span>$180.00</span>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span>Service Fee</span>
                    <span>$12.00</span>
                </div>
                <div class="d-flex justify-content-between mb-2 text-success">
                    <span>Amount Paid</span>
                    <span>-$96.00</span>
                </div>
                <hr>
                <div class="d-flex justify-content-between fw-bold h5 text-danger">
                    <span>Remaining Balance</span>
                    <span>$96.00</span>
                </div>

                <!-- Payment Progress -->
                <div class="mt-3">
                    <div class="d-flex justify-content-between mb-1">
                        <small>Payment Progress</small>
                        <small>50% Complete</small>
                    </div>
                    <div class="progress" style="height: 8px;">
                        <div class="progress-bar" role="progressbar" style="width: 50%"></div>
                    </div>
                </div>
            </div>

            <!-- Payment Method Selection -->
            <h6 class="fw-bold mb-3">Select Payment Method</h6>

            <div class="payment-method card mb-3 border" onclick="selectPaymentMethod(this)">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-credit-card fa-lg text-primary me-3"></i>
                        <div class="flex-grow-1">
                            <h6 class="mb-1">Credit/Debit Card</h6>
                            <small class="text-muted">Visa, Mastercard, American Express</small>
                        </div>
                        <i class="fas fa-check-circle text-success d-none"></i>
                    </div>
                </div>
            </div>

            <div class="payment-method card mb-3 border" onclick="selectPaymentMethod(this)">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center">
                        <i class="fab fa-paypal fa-lg text-info me-3"></i>
                        <div class="flex-grow-1">
                            <h6 class="mb-1">PayPal</h6>
                            <small class="text-muted">Pay with your PayPal account</small>
                        </div>
                        <i class="fas fa-check-circle text-success d-none"></i>
                    </div>
                </div>
            </div>

            <div class="payment-method card mb-4 border" onclick="selectPaymentMethod(this)">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-university fa-lg text-warning me-3"></i>
                        <div class="flex-grow-1">
                            <h6 class="mb-1">Bank Transfer</h6>
                            <small class="text-muted">Direct bank transfer</small>
                        </div>
                        <i class="fas fa-check-circle text-success d-none"></i>
                    </div>
                </div>
            </div>

            <!-- Payment Form (Initially Hidden) -->
            <div id="paymentForm" class="d-none">
                <h6 class="fw-bold mb-3">Payment Details</h6>
                <form id="cardPaymentForm">
                    <div class="row mb-3">
                        <div class="col-12">
                            <label class="form-label">Card Number</label>
                            <input type="text" class="form-control" placeholder="1234 5678 9012 3456" maxlength="19">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-6">
                            <label class="form-label">Expiry Date</label>
                            <input type="text" class="form-control" placeholder="MM/YY" maxlength="5">
                        </div>
                        <div class="col-6">
                            <label class="form-label">CVC</label>
                            <input type="text" class="form-control" placeholder="123" maxlength="3">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Cardholder Name</label>
                        <input type="text" class="form-control" placeholder="John Doe">
                    </div>

                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="saveCard">
                            <label class="form-check-label" for="saveCard">
                                Save card for future purchases
                            </label>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Footer with Payment Button -->
        <div class="border-top p-4 bg-white">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted">Total Amount:</span>
                <span class="h5 mb-0 fw-bold text-danger">$96.00</span>
            </div>

            <button class="btn btn-pay btn-primary w-100" onclick="processPayment()">
                <i class="fas fa-lock me-2"></i>Pay Now - $96.00
            </button>

            <div class="text-center mt-3">
                <small class="text-muted">
                    <i class="fas fa-shield-alt me-1"></i>
                    Secured by 256-bit SSL encryption
                </small>
            </div>
        </div>
    </div>
</div>
<script>
    let selectedPaymentMethod = null;

    function selectPaymentMethod(element) {
        // Remove selection from all payment methods
        document.querySelectorAll('.payment-method').forEach(method => {
            method.classList.remove('selected');
            method.querySelector('.fa-check-circle').classList.add('d-none');
        });

        // Add selection to clicked method
        element.classList.add('selected');
        element.querySelector('.fa-check-circle').classList.remove('d-none');

        // Store selected method
        selectedPaymentMethod = element.querySelector('h6').textContent;

        // Show payment form if credit card is selected
        const paymentForm = document.getElementById('paymentForm');
        if (selectedPaymentMethod === 'Credit/Debit Card') {
            paymentForm.classList.remove('d-none');
        } else {
            paymentForm.classList.add('d-none');
        }
    }

    function processPayment() {
        if (!selectedPaymentMethod) {
            alert('Please select a payment method');
            return;
        }

        // Simulate payment processing
        const payButton = document.querySelector('.btn-pay');
        const originalText = payButton.innerHTML;

        payButton.disabled = true;
        payButton.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Processing...';

        setTimeout(() => {
            // Hide the offcanvas
            const offcanvas = bootstrap.Offcanvas.getInstance(document.getElementById('paymentOffcanvas'));
            offcanvas.hide();

            // Show success modal
            setTimeout(() => {
                const successModal = new bootstrap.Modal(document.getElementById('successModal'));
                successModal.show();

                // Reset button
                payButton.disabled = false;
                payButton.innerHTML = originalText;
            }, 300);
        }, 2000);
    }

    // Format card number input
    document.addEventListener('input', function (e) {
        if (e.target.placeholder === '1234 5678 9012 3456') {
            let value = e.target.value.replace(/\s/g, '').replace(/[^0-9]/gi, '');
            let formattedValue = value.match(/.{1,4}/g)?.join(' ') || value;
            e.target.value = formattedValue;
        }

        if (e.target.placeholder === 'MM/YY') {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length >= 2) {
                value = value.substring(0, 2) + '/' + value.substring(2, 4);
            }
            e.target.value = value;
        }
    });
</script>