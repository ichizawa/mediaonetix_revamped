@extends('layouts')
@extends('components.sidebar')

@section('content')
    <div class="container py-5">
        <div class="d-flex align-items-left flex-column flex-md-row pt-2 pb-4">
            <div>
                <h1 class="fw-bold">Change Password</h1>
            </div>
        </div>
        <div class="row  min-vh-auto">
            <div class="col-lg-8 col-md-10 col-12 mb-lg-0">
                <div class="card shadow-sm p-4 border-top border-5 border-dark">
                    <h5 class="fw-bold mb-3">Change Password</h5>
                    <p class="mb-4">Enter your new password below to complete your setup.</p>
                    <form method="POST" action="{{ route('reset.password', session('token')->id) }}">
                        @csrf
                        <div class="mb-3">
                            <label for="password" class="form-label fw-bold">New Password<span
                                    class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Enter New Password" required minlength="10">
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label fw-bold">Confirm New Password<span
                                    class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="password_confirmation"
                                name="password_confirmation" placeholder="Re-enter New Password" required minlength="10">
                        </div>
                        <div class="mb-4">
                            <div class="border rounded bg-light p-3">
                                <span class="fw-bold">Your password must contain:</span>
                                <ul class="mb-0 mt-2" style="font-size: 0.97rem;">
                                    <li>At least 10 characters in length</li>
                                    <li>At least 1 numeric digit (0-9)</li>
                                    <li>At least 1 special character (@ # $ %)</li>
                                </ul>
                            </div>
                        </div>
                        <button type="submit" class="btn w-100 fw-bold" style="background-color: #0F355A; color: #fff;">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
