@extends('components.navbar-guest')

@section('content')
    <style>
        .icon-circle {
            background-color: #0F355A;
            color: white;
            border-radius: 50%;
            padding: 8px;
            width: 36px;
            height: 36px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
        }
    </style>
    <div class="container-fluid px-0">
        <div class="position-relative">
            <div class="fullscreen-hero">
                <img src="{{ asset('assets/img/landpage_cover/contact_cover.jpg') }}" alt="Header Image"
                    class="img-fluid w-100" style="max-height: 700px; object-fit: cover;">
            </div>
            <div class="position-absolute top-50 start-50 translate-middle text-white text-center text-nowrap">
                <h1 class="text-header">Reach out Anytime.</h1>
            </div>
        </div>
        <div class="bg-white py-5">
            <div class="text-center mb-4">
                <h2 class="fw-bold">Contact Us</h2>
            </div>
            <hr class="section-dashed my-5">
            <div class="container">
                <div class="row g-4">
                    <div class="col-md-8">
                        <form action="{{ route('submit.contact') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="bg-white p-4 shadow rounded">
                                <div class="mb-3 mt-3">
                                    <select name="email_type" class="form-select bg-main text-white">
                                        <option value="1" selected>General Inquiry</option>
                                        <option value="2">Partnership</option>
                                    </select>
                                </div>

                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('first_name') ? 'has-error' : '' }}">
                                            <h6 class="text-input fw-bold">First Name*</h6>
                                            <input type="text" name="first_name" class="form-control"
                                                placeholder="Enter First Name*" value="{{ old('first_name') }}" />
                                            @if ($errors->has('first_name'))
                                                <small id="emailHelp"
                                                    class="form-text text-muted">{{ $errors->first('first_name') }}</small>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('last_name') ? 'has-error' : '' }}">
                                            <h6 class="text-input fw-bold">Last Name*</h6>
                                            <input type="text" name="last_name" class="form-control"
                                                placeholder="Enter Last Name*" value="{{ old('last_name') }}" />
                                            @if ($errors->has('last_name'))
                                                <small id="emailHelp"
                                                    class="form-text text-muted">{{ $errors->first('last_name') }}</small>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group {{ $errors->has('subject') ? 'has-error' : '' }}">
                                            <h6 class="text-input fw-bold">Subject Event*</h6>
                                            <input type="text" name="subject" class="form-control"
                                                placeholder="Enter Subject Event*" value="{{ old('subject') }}" />
                                            @if ($errors->has('subject'))
                                                <small id="emailHelp"
                                                    class="form-text text-muted">{{ $errors->first('subject') }}</small>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
                                            <h6 class="text-input fw-bold">Phone Number</h6>
                                            <input type="text" name="phone" class="form-control"
                                                placeholder="Enter Phone Number" value="{{ old('phone') }}" />
                                            @if ($errors->has('phone'))
                                                <small id="emailHelp"
                                                    class="form-text text-muted">{{ $errors->first('phone') }}</small>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                            <h6 class="text-input fw-bold">Email*</h6>
                                            <input type="email" name="email" class="form-control"
                                                placeholder="Enter Email Address*" value="{{ old('email') }}" />
                                            @if ($errors->has('email'))
                                                <small id="emailHelp"
                                                    class="form-text text-muted">{{ $errors->first('email') }}</small>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group {{ $errors->has('message') ? 'has-error' : '' }}">
                                            <h6 class="text-input fw-bold">Message</h6>
                                            <textarea class="form-control" name="message" rows="4"
                                                placeholder="Input Message"></textarea>
                                            @if ($errors->has('message'))
                                                <small id="emailHelp"
                                                    class="form-text text-muted">{{ $errors->first('message') }}</small>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <div class="form-check align-items-start flex-wrap">
                                                <input type="checkbox" class="form-check-input mt-1 me-2" name="consent"
                                                    id="consentCheck">
                                                <p class="form-check-label flex-grow-1" for="consentCheck">
                                                    By clicking here, I give my consent to MediaOne Tix to collect and
                                                    process
                                                    my personal data according to its terms and conditions, and privacy
                                                    policy.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-12 text-end">
                                    <button class="btn w-100 text-white" type="submit"
                                        style="background-color: #0F355A;">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-4">
                        <div class="bg-white shadow rounded overflow-hidden">
                            <div class="bg-white text-center mt-5" style="border-radius: 0 0 20px 20px;">
                                <strong>FOR MORE INFORMATION & CUSTOMER SERVICE CONCERNS</strong>
                            </div>
                            <hr style="border-top: 3px dashed #0F355A;">
                            <div class="p-4">
                                <div class="d-flex mb-5">
                                    <span class="icon-circle me-3 flex-shrink-0">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </span>
                                    <div>
                                        <strong>Address:</strong> NHA Bangkal, Ground Floor Cordillera, Corner Waling
                                        Waling, Davao City, 8000
                                    </div>
                                </div>

                                <div class="d-flex mb-5">
                                    <span class="icon-circle me-3 flex-shrink-0">
                                        <i class="fas fa-phone"></i>
                                    </span>
                                    <div>
                                        <strong>Phone:</strong> 0912-345-6789
                                    </div>
                                </div>

                                <div class="d-flex mb-5">
                                    <span class="icon-circle me-3 flex-shrink-0">
                                        <i class="fas fa-envelope"></i>
                                    </span>
                                    <div>
                                        <strong>Email:</strong> media1tix@gmail.com
                                    </div>
                                </div>

                                <div class="d-flex mb-5">
                                    <span class="icon-circle me-3 flex-shrink-0">
                                        <i class="fab fa-facebook-f"></i>
                                    </span>
                                    <div>
                                        <strong>Facebook:</strong> MediaOneTix
                                    </div>
                                </div>

                                <div class="d-flex">
                                    <span class="icon-circle me-3 flex-shrink-0">
                                        <i class="fab fa-instagram"></i>
                                    </span>
                                    <div>
                                        <strong>Instagram:</strong> @MediaOneTix
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    @if($errors->has('email-error'))

    @endif
    @if(session('success'))
        <script>
            $(document).ready(function () {
                $.notify({
                    icon: 'fa fa-check',
                    title: 'Success',
                    message: {{ session('success') }}",
                }, {
                    type: 'success',
                    placement: { from: 'top', align: 'right' },
                    delay: 2000
                });
            });
        </script>
    @endif
@endsection