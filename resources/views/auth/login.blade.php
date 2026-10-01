<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - Sistem Absensi Karyawan</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            margin: 0;
            font-family: 'Poppins', sans-serif;

            background:
                radial-gradient(circle at top left, rgba(255, 255, 255, .18), transparent 35%),
                radial-gradient(circle at bottom right, rgba(255, 255, 255, .12), transparent 35%),
                linear-gradient(135deg, #193984, #2196f3);

            display: flex;
            align-items: center;
            justify-content: center;

            padding: 20px;
        }

        .login-wrapper {
            width: 100%;
            max-width: 430px;
        }

        .login-card {
            background: rgba(255, 255, 255, .98);
            border-radius: 24px;
            padding: 38px 35px;

            box-shadow:
                0 25px 60px rgba(0, 0, 0, .20);

            animation: fadeIn .5s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(15px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .logo-wrapper {
            width: 90px;
            height: 90px;

            margin: 0 auto 18px;

            display: flex;
            align-items: center;
            justify-content: center;

            background: #f5f8ff;
            border-radius: 20px;

            padding: 10px;
        }

        .login-logo {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .login-title {
            color: #193984;
            font-weight: 700;
            font-size: 22px;
            margin-bottom: 5px;
        }

        .login-subtitle {
            color: #7a8496;
            font-size: 13px;
            margin-bottom: 30px;
        }

        .form-label {
            color: #343a40;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .input-group {
            position: relative;
        }

        .input-group-text {
            width: 48px;
            justify-content: center;

            background: #f5f7fb;
            border: 1px solid #dee2e6;

            color: #193984;
        }

        .form-control {
            height: 48px;
            border: 1px solid #dee2e6;
            font-size: 13px;
        }

        .form-control:focus {
            border-color: #2196f3;

            box-shadow: 0 0 0 .2rem rgba(33, 150, 243, .10);
        }

        .input-group .form-control:first-child {
            border-radius: 0 10px 10px 0;
        }

        .password-toggle {
            border: 1px solid #dee2e6;
            border-left: 0;

            background: #fff;
            color: #6c757d;

            width: 48px;
        }

        .password-toggle:hover {
            color: #193984;
            background: #f8f9fa;
        }

        .remember-wrapper {
            display: flex;
            align-items: center;
            justify-content: space-between;

            margin-top: 5px;
            margin-bottom: 25px;
        }

        .form-check-label {
            color: #6c757d;
            font-size: 12px;
            cursor: pointer;
        }

        .form-check-input {
            cursor: pointer;
        }

        .form-check-input:checked {
            background-color: #193984;
            border-color: #193984;
        }

        .btn-login {
            height: 48px;

            border: none;
            border-radius: 10px;

            background: linear-gradient(135deg,
                    #193984,
                    #2196f3);

            font-size: 14px;
            font-weight: 600;

            box-shadow: 0 8px 20px rgba(25, 57, 132, .20);

            transition: .2s ease;
        }

        .btn-login:hover {
            transform: translateY(-1px);

            box-shadow: 0 10px 25px rgba(25, 57, 132, .30);
        }

        .alert {
            border: none;
            border-radius: 10px;
            font-size: 12px;
        }

        .invalid-feedback {
            font-size: 11px;
        }

        .footer {
            margin-top: 25px;
            text-align: center;
            color: #8a94a6;
            font-size: 11px;
        }

        @media (max-width: 480px) {

            body {
                padding: 15px;
            }

            .login-card {
                padding: 30px 22px;
                border-radius: 20px;
            }

            .login-title {
                font-size: 20px;
            }
        }
    </style>
</head>

<body>

    <div class="login-wrapper">

        <div class="login-card">

            {{-- Logo & Judul --}}
            <div class="text-center">

                <div class="logo-wrapper">

                    <img src="{{ asset('assets/images/logo ptt.png') }}" alt="Logo Sekolah" class="login-logo"
                        onerror="this.style.display='none';">

                </div>

                <h4 class="login-title">
                    Sistem Absensi Karyawan
                </h4>

                <p class="login-subtitle">
                    Silakan masuk menggunakan akun Anda
                </p>

            </div>


            {{-- Success Message --}}
            @if (session('success'))
                <div class="alert alert-success d-flex align-items-center mb-4">

                    <i class="bi bi-check-circle-fill me-2"></i>

                    <span>
                        {{ session('success') }}
                    </span>

                </div>
            @endif


            {{-- Error Message --}}
            @if ($errors->any())
                <div class="alert alert-danger d-flex align-items-start mb-4">

                    <i class="bi bi-exclamation-circle-fill me-2 mt-1"></i>

                    <div>
                        {{ $errors->first() }}
                    </div>

                </div>
            @endif


            {{-- Login Form --}}
            <form action="{{ route('login.process') }}" method="POST" autocomplete="off">

                @csrf


                {{-- Username --}}
                <div class="mb-3">

                    <label for="username" class="form-label">

                        Username

                    </label>

                    <div class="input-group">

                        <span class="input-group-text">
                            <i class="bi bi-person"></i>
                        </span>

                        <input type="text" id="name" name="name" value="{{ old('name') }}"
                            class="form-control @error('name') is-invalid @enderror" placeholder="Masukkan name"
                            autocomplete="name" autofocus required>

                    </div>

                    @error('name')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- Password --}}
                <div class="mb-3">

                    <label for="password" class="form-label">

                        Password

                    </label>

                    <div class="input-group">

                        <span class="input-group-text">
                            <i class="bi bi-lock"></i>
                        </span>

                        <input type="password" id="password" name="password"
                            class="form-control @error('password') is-invalid @enderror" placeholder="Masukkan password"
                            autocomplete="current-password" required>

                        <button type="button" class="password-toggle" id="togglePassword"
                            aria-label="Tampilkan password">

                            <i class="bi bi-eye" id="eyeIcon">
                            </i>

                        </button>

                    </div>

                    @error('password')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- Remember Me --}}
                <div class="remember-wrapper">

                    <div class="form-check">

                        <input type="checkbox" name="remember" value="1" class="form-check-input" id="remember">

                        <label class="form-check-label" for="remember">

                            Ingat saya

                        </label>

                    </div>

                </div>


                {{-- Login Button --}}
                <button type="submit" class="btn btn-primary btn-login w-100">

                    <i class="bi bi-box-arrow-in-right me-2"></i>

                    Masuk

                </button>

            </form>


            {{-- Footer --}}
            <div class="footer">

                &copy; {{ date('Y') }} Sistem Absensi Karyawan

            </div>

        </div>

    </div>


    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


    {{-- Toggle Password --}}
    <script>
        const togglePassword = document.getElementById('togglePassword');
        const password = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');

        togglePassword.addEventListener('click', function() {

            const isPassword = password.type === 'password';

            password.type = isPassword ? 'text' : 'password';

            eyeIcon.classList.toggle('bi-eye', !isPassword);
            eyeIcon.classList.toggle('bi-eye-slash', isPassword);

            togglePassword.setAttribute(
                'aria-label',
                isPassword ?
                'Sembunyikan password' :
                'Tampilkan password'
            );

        });
    </script>

</body>

</html>
