<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Rentify</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/be/images/logos/favicon.png') }}" />
    <link rel="stylesheet" href="{{ asset('assets/be/css/styles.min.css') }}" />
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <div
            class="position-relative overflow-hidden text-bg-light min-vh-100 d-flex align-items-center justify-content-center">
            <div class="d-flex align-items-center justify-content-center w-100">
                <div class="row justify-content-center w-100">
                    <div class="col-md-8 col-lg-5 col-xl-4">
                        <div class="card mb-0">
                            <div class="card-body">
                                <a href="javascript:void(0)"
                                    class="text-nowrap logo-img text-center d-block py-3 w-100">
                                    <img src="{{ asset('assets/be/images/logos/logo.png') }}" alt="logo"
                                        width="100">
                                </a>
                                <div class="text-center">
                                    <h4 class="text-dark">Selamat Datang!</h4>
                                    <p>Senang bertemu denganmu lagi. Masuk ke akun Anda di bawah ini!</p>
                                    {{-- <p>Glad to see you again <br>Login to your account below</p> --}}
                                </div>
                                @include('be.layouts.app_session')
                                <form action="{{ route('auth.act_login') }}" method="post">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="username" class="form-label">Username</label>
                                        <input type="text" class="form-control" id="username" name="username"
                                            value="{{ old('username') }}">
                                    </div>
                                    <label for="password" class="form-label mb-3">Password</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="password" name="password">
                                        <button class="btn btn-light d-flex align-items-center" type="button"
                                            id="btn-show-hide" onclick="showHidePass()">
                                            <iconify-icon icon="solar:eye-broken" width="1.2em" height="1.2em"
                                                class="d-block" id="show-icon"></iconify-icon>
                                            <iconify-icon icon="solar:eye-closed-broken" width="1.2em" height="1.2em"
                                                class="d-none" id="hide-icon"></iconify-icon>
                                        </button>
                                    </div>
                                    <button type="submit"
                                        class="btn btn-primary fw-bolder w-100 py-8 fs-4 my-3 rounded-2">Login</button>
                                    {{-- <div class="text-center">
                                        <p class=" fw-bold">Dont have an account?
                                            <a class="text-primary fw-bold" href="{{ route('auth.registrasi') }}">Sign
                                                up for Free</a>
                                        </p>
                                    </div> --}}
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/be/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/be/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <!-- solar icons -->
    <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
    <script>
        function showHidePass() {
            var $password = $("#password");
            var $hideIcon = $("#hide-icon");
            var $showIcon = $("#show-icon");

            var isPassword = $password.attr("type") === "password";

            $password.attr("type", isPassword ? "text" : "password");

            $hideIcon.toggleClass("d-none d-block", !isPassword); // !isPassword -> isPassword == false
            $showIcon.toggleClass("d-none d-block", isPassword); // isPassword -> isPassword == true
        }
    </script>
</body>

</html>
