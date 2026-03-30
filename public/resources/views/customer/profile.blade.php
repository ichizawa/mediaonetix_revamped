@extends('layouts')
@section('content')
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h1 class="fw-bold mb-3">Profile</h1>
            </div>
        </div>
        <div class="container my-5">
            <div class="card shadow-sm rounded-3" style="max-width: 900px; margin: auto;">
                <div class="card-body">
                    <div class="container my-5 position-relative">
                        <div class="d-flex justify-content-center mb-4 position-relative">
                            <div class="position-relative" style="width: 120px; height: 120px;">
                                <!-- Image preview -->
                                <img id="profile-preview" src="https://via.placeholder.com/120"
                                    class="rounded-circle border" style="width: 120px; height: 120px; object-fit: cover;" />

                                <!-- Upload label -->
                                <label for="profile-upload"
                                    class="rounded-circle d-flex align-items-center justify-content-center"
                                    style="width: 120px; height: 120px; background-color: rgba(0,0,0,0.5); position: absolute; top: 0; left: 0; cursor: pointer;">
                                    <i class="bi bi-camera-fill text-white" style="font-size: 1.5rem;"></i>
                                </label>

                                <!-- Hidden file input -->
                                <input type="file" id="profile-upload" accept="image/*" style="display: none;"
                                    onchange="previewProfileImage(event)">
                            </div>

                            <!-- Optional Preview (add where you'd like to show the uploaded image) -->
                            <img id="profile-preview" class="rounded-circle mt-4" src="#" alt="Profile Preview"
                                style="display: none; width: 120px; height: 120px; object-fit: cover;">

                        </div>
                        <form action="{{ route('customer.profile.update') }}" method="POST">
                            @csrf
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="first-name" class="form-label fw-bold">First Name</label>
                                    <input type="text" class="form-control" id="first-name" name="first_name"
                                        placeholder="Enter first name" value="{{ Auth::user()->first_name }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="last-name" class="form-label fw-bold">Last Name</label>
                                    <input type="text" class="form-control" id="last-name" name="last_name"
                                        placeholder="Enter last name" value="{{ Auth::user()->last_name }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="username" class="form-label fw-bold">Username</label>
                                <input type="text" class="form-control" id="username" name="username"
                                    placeholder="Enter username" value="{{ Auth::user()->username }}">
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label fw-bold">Email Address</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter email"
                                    value="{{ Auth::user()->email }}">
                            </div>

                            <div class="mb-3">
                                <label for="phone" class="form-label fw-bold">Contact Number</label>
                                <input type="tel" class="form-control" id="phone" name="phone"
                                    placeholder="Enter contact number" value="{{ Auth::user()->phone }}">
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-9">
                                    <label for="password" class="form-label fw-bold">Password</label>
                                    <div class="position-relative">
                                        <input type="password" class="form-control pe-5" id="password" name="password"
                                            placeholder="Enter new password (leave blank to keep current)">
                                        <i class="bi bi-eye-fill position-absolute"
                                            style="right: 15px; top: 50%; transform: translateY(-50%); color: #6c757d; cursor: pointer;"
                                            onclick="togglePasswordVisibility()"></i>
                                    </div>
                                </div>
                                <div class="col-md-3 d-flex align-items-end">
                                    <a href="{{ route('customer.change_password') }}" class="btn w-100 text-white rounded-2"
                                        style="background-color: #0F355A;">
                                        Reset Password
                                    </a>
                                </div>
                            </div>

                            <div class="mb-3 mt-5 w-100">
                                <button type="submit" class="btn text-white w-100 fw-bold"
                                    style="background-color: #0F355A;">Save Changes</button>
                            </div>
                        </form>

                        <script>
                            function togglePasswordVisibility() {
                                const passwordInput = document.getElementById('password');
                                const icon = document.querySelector('.bi-eye-fill');

                                if (passwordInput.type === 'password') {
                                    passwordInput.type = 'text';
                                    icon.classList.remove('bi-eye-fill');
                                    icon.classList.add('bi-eye-slash-fill');
                                } else {
                                    passwordInput.type = 'password';
                                    icon.classList.remove('bi-eye-slash-fill');
                                    icon.classList.add('bi-eye-fill');
                                }
                            }
                        </script>
                    </div>


                </div>
            </div>
        </div>
    </div>

    </div>

    @if(session('success'))
        <script>
            $(document).ready(function () {
                $.notify({
                    icon: 'fa fa-bell',
                    title: 'Success!',
                    message: @json(session('success'))
                }, {
                    type: 'success',
                    placement: {
                        from: 'top',
                        align: 'right'
                    },
                    delay: 1500
                });
            });
        </script>
    @endif

    <script>
        function previewProfileImage(event) {
            const input = event.target;
            const preview = document.getElementById('profile-preview');

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    preview.src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

@endsection
