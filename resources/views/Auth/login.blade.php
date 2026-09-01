<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Log In - Intracs</title>

    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            font-family: Arial, Helvetica, sans-serif;
            background: #7eb1ef;
            overflow: hidden;
        }

        /* =========================
           BACKGROUND
        ========================= */

        .login-page {
            width: 100%;
            min-height: 100vh;
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Lingkaran pojok */

        .circle {
            position: absolute;
            width: 145px;
            height: 145px;
            background: #105a70;
            border-radius: 50%;
        }

        .circle-top-left {
            top: -48px;
            left: -48px;
        }

        .circle-top-right {
            top: -48px;
            right: -48px;
        }

        .circle-bottom-left {
            bottom: -55px;
            left: -55px;
        }

        .circle-bottom-right {
            bottom: -55px;
            right: -55px;
        }


        /* =========================
           LOGIN CARD
        ========================= */

        .login-card {
            width: 350px;
            min-height: 560px;

            background: #ffffff;

            border-radius: 75px;

            padding: 50px 55px;

            position: relative;
            z-index: 2;

            display: flex;
            flex-direction: column;
            align-items: center;

            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.03);
        }


        /* =========================
           LOGO
        ========================= */

        .logo {
            width: 180px;
            height: auto;
            margin-top: 5px;
            margin-bottom: 30px;
            object-fit: contain;
        }


        /* =========================
           TEXT
        ========================= */

        .welcome {
            font-size: 20px;
            font-weight: 500;
            color: #111111;
            margin-bottom: 5px;
            text-align: center;
        }

        .subtitle {
            font-size: 11px;
            color: #333333;
            margin-bottom: 40px;
            text-align: center;
        }


        /* =========================
           FORM
        ========================= */

        .login-form {
            width: 100%;
        }

        .form-group {
            width: 100%;
            margin-bottom: 22px;
        }

        .form-label {
            display: block;
            font-size: 11px;
            color: #111111;
            margin-bottom: 6px;
        }

        .input-wrapper {
            position: relative;
            width: 100%;
        }

        .input-wrapper i {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);

            font-size: 14px;
            color: #222222;
        }

        .form-input {
            width: 100%;
            height: 42px;

            border: 1px solid #a9a9a9;
            border-radius: 0;

            padding: 8px 12px 8px 36px;

            font-size: 13px;

            outline: none;

            background: #fafafa;
        }

        .form-input:focus {
            border-color: #4652ff;
            box-shadow: 0 0 0 1px rgba(70, 82, 255, 0.15);
        }

        .form-input::placeholder {
            color: #888888;
        }


        /* =========================
           LOGIN BUTTON
        ========================= */

        .login-button {
            width: 100%;
            height: 44px;

            margin-top: 5px;

            border: none;
            border-radius: 25px;

            background: #4350ff;
            color: white;

            font-size: 13px;
            font-weight: 500;

            cursor: pointer;

            transition: 0.2s;
        }

        .login-button:hover {
            background: #303de8;
        }

        .login-button:active {
            transform: scale(0.98);
        }


        /* =========================
           ERROR
        ========================= */

        .error-message {
            width: 100%;
            font-size: 11px;
            color: #dc3545;
            margin-bottom: 15px;
            text-align: center;
        }


        /* =========================
           RESPONSIVE
        ========================= */

        @media (max-width: 500px) {

            .login-card {
                width: 90%;
                max-width: 350px;
                min-height: 520px;
                padding: 45px 35px;
            }

            .logo {
                width: 160px;
            }

            .circle {
                width: 110px;
                height: 110px;
            }

        }

    </style>
</head>


<body>

<div class="login-page">

    {{-- Lingkaran dekorasi --}}

    <div class="circle circle-top-left"></div>

    <div class="circle circle-top-right"></div>

    <div class="circle circle-bottom-left"></div>

    <div class="circle circle-bottom-right"></div>


    {{-- LOGIN CARD --}}

    <div class="login-card">

        {{-- LOGO --}}

        <img src="{{ asset('images/intracs.png') }}"
             alt="Intracs"
             class="logo">


        {{-- WELCOME --}}

        <h2 class="welcome">
            Selamat Datang
        </h2>

        <p class="subtitle">
            masuk ke akun anda
        </p>


        {{-- ERROR LOGIN --}}

        @if($errors->any())

            <div class="error-message">
                {{ $errors->first() }}
            </div>

        @endif


        {{-- FORM LOGIN --}}

        <form action="{{ route('login.process') }}"
              method="POST"
              class="login-form">

            @csrf


            {{-- EMAIL --}}

            <div class="form-group">

                <label class="form-label">
                    Log In
                </label>

                <div class="input-wrapper">

                    <i class="bi bi-person"></i>

                    <input type="email"
                           name="email"
                           class="form-input"
                           placeholder="Masukkan email"
                           value="{{ old('email') }}"
                           required
                           autofocus>

                </div>

            </div>


            {{-- PASSWORD --}}

            <div class="form-group">

                <div class="input-wrapper">

                    <i class="bi bi-lock"></i>

                    <input type="password"
                           name="password"
                           class="form-input"
                           placeholder="Masukkan password"
                           required>

                </div>

            </div>


            {{-- BUTTON --}}

            <button type="submit"
                    class="login-button">

                Log In

            </button>

        </form>

    </div>

</div>

</body>

</html>