<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MediaoneTix - Login</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/mediaone_tix_1.png') }}">
    <script src="{{ asset('assets/js/plugin/jquery/jquery-3.7.1.min.js') }}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/plugins.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/kaiadmin.min.css') }}" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/css/login.css') }}">
</head>

<body class="bg-login">
    <div class="wrapper d-flex justify-content-center align-items-center">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-md-7">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <form id="login-form" method="POST">
                            @csrf
                            <div
                                class="d-flex flex-column col text-center !border-0 justify-content-center align-items-center">
                                <img src="{{ asset('assets/img/mediaone_tix_1.png') }}" alt="Logo"
                                    class="w-25 img-fluid !border-0">
                                <h1 class="fs-2 fw-bold">
                                    <!-- {{ Route::is('merchant.login') ? 'Merchant' : (Route::is('customer.login') ? 'Client' : 'Admin') }} -->
                                    Log In
                                </h1>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group @error('email') has-error has-feedback @enderror">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" class="form-control border-sta" id="email"
                                            placeholder="Email">
                                        <small id="emailHelp"
                                            class="form-text text-muted {{ $errors->has('email') ? 'd-block' : 'd-none' }}">
                                            @error('email')
                                                {{ $message }}
                                            @enderror
                                        </small>

                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group @error('password') has-error has-feedback @enderror">
                                        <label for="password">Password</label>
                                        <input type="password" name="password" class="form-control border-sta"
                                            id="password" placeholder="Password">
                                        <small id="passwordHelp"
                                            class="form-text text-muted {{ $errors->has('password') ? 'd-block' : 'd-none' }}">
                                            @error('password')
                                                {{ $message }}
                                            @enderror
                                        </small>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="flexCheckDefault" />
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Remember Me
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group d-flex justify-content-center">
                                        <button type="submit" class="btn btn-sta btn-md w-100 fw-bold">Login as
                                            {{ Route::is('merchant.login') ? 'Merchant' : (Route::is('customer.login') ? 'Client' : 'Admin') }}</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- include scripts once -->
    <script src="{{ asset('assets/js/plugin/jquery/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>

    <script>
        $(document).ready(function () {

            @if($errors->any())
                let errors = @json($errors->all());
                let delay = 0;
                errors.forEach(error => {
                    setTimeout(() => {
                        $.notify({
                            icon: 'fa fa-bell',
                            title: 'Error',
                            message: error
                        }, {
                            type: 'danger',
                            placement: { from: 'top', align: 'right' },
                            delay: 1500
                        });
                    }, delay);
                    delay += 500;
                });
            @endif


            @if(session('status'))
                $.notify({
                    icon: 'fa fa-check',
                    title: 'Success',
                    message: '{{ session('status') }}'
                }, {
                    type: 'success',
                    placement: { from: 'top', align: 'right' },
                    delay: 2000
                });
            @endif
  });
    </script>


    <script>
        $(document).ready(function () {
            $('#email, #password').on('input', function () {
                $(this).closest('.form-group').removeClass('has-error');
                $('#' + this.id + 'Help').addClass('d-none');
            });
        });
    </script>

    <script src="{{ asset('assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>
</body>

</html>