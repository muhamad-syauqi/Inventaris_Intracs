<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - Intracs</title>

    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --blue: #0b5874;
            --blue-light: #38b8e8;
            --white: #fff;
        }

        html, body {
            width: 100%;
            min-height: 100%;
        }

        body {
            min-height: 100vh;
            overflow: hidden;
            font-family: Arial, Helvetica, sans-serif;
            background: #020b10;
            color: #fff;
        }

        /* =========================================================
           ANIMATED BACKGROUND
        ========================================================= */

        .login-page {
            position: relative;
            min-height: 100vh;
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            isolation: isolate;
            background:
                radial-gradient(circle at 15% 20%, rgba(18, 125, 170, .16), transparent 27%),
                radial-gradient(circle at 85% 75%, rgba(18, 125, 170, .13), transparent 30%),
                #030303;
        }

        .login-page::before {
            content: "";
            position: absolute;
            inset: -45%;
            z-index: -4;
            background:
                repeating-linear-gradient(
                    125deg,
                    transparent 0 85px,
                    rgba(255, 255, 255, .035) 86px 90px,
                    transparent 91px 145px
                );
            transform: rotate(-7deg);
            animation: backgroundMove 18s linear infinite;
        }

        .light {
            position: absolute;
            width: 65vw;
            height: 130px;
            border-radius: 50%;
            filter: blur(18px);
            opacity: .72;
            pointer-events: none;
            z-index: -2;
        }

        .light.one {
            top: 18%;
            left: -18%;
            background: linear-gradient(
                90deg,
                transparent,
                rgba(20, 135, 180, .15),
                rgba(76, 202, 245, .9),
                rgba(20, 135, 180, .14),
                transparent
            );
            transform: rotate(23deg);
            animation: lightOne 9s ease-in-out infinite alternate;
        }

        .light.two {
            right: -25%;
            bottom: 17%;
            background: linear-gradient(
                90deg,
                transparent,
                rgba(255, 255, 255, .10),
                rgba(11, 88, 116, .85),
                rgba(56, 184, 232, .18),
                transparent
            );
            transform: rotate(-27deg);
            animation: lightTwo 11s ease-in-out infinite alternate;
        }

        .streak {
            position: absolute;
            width: 130vw;
            height: 2px;
            left: -15vw;
            background: linear-gradient(
                90deg,
                transparent,
                rgba(11, 88, 116, .1),
                rgba(76, 202, 245, .95),
                rgba(11, 88, 116, .18),
                transparent
            );
            box-shadow: 0 0 18px rgba(30, 154, 199, .45);
            z-index: -1;
            transform: rotate(24deg);
            animation: streakMove 8s ease-in-out infinite;
        }

        .streak.s1 { top: 30%; animation-delay: -2s; }
        .streak.s2 { top: 63%; opacity: .55; animation-delay: -5s; }
        .streak.s3 { top: 78%; opacity: .35; animation-delay: -1s; }

        .noise {
            position: absolute;
            inset: 0;
            z-index: -1;
            pointer-events: none;
            opacity: .08;
            background-image:
                radial-gradient(rgba(255,255,255,.5) .5px, transparent .5px);
            background-size: 4px 4px;
        }

        @keyframes backgroundMove {
            from { transform: rotate(-7deg) translate3d(-2%, -1%, 0); }
            to   { transform: rotate(-7deg) translate3d(2%, 2%, 0); }
        }

        @keyframes lightOne {
            from { transform: translateX(-5%) rotate(23deg); }
            to   { transform: translateX(35%) rotate(23deg); }
        }

        @keyframes lightTwo {
            from { transform: translateX(5%) rotate(-27deg); }
            to   { transform: translateX(-30%) rotate(-27deg); }
        }

        @keyframes streakMove {
            0%, 100% { transform: translateX(-4%) rotate(24deg); opacity: .25; }
            50%      { transform: translateX(8%) rotate(24deg); opacity: .95; }
        }

        /* =========================================================
           DECORATIVE ORBS
        ========================================================= */

        .orb {
            position: absolute;
            border-radius: 50%;
            pointer-events: none;
            filter: blur(1px);
            z-index: -1;
        }

        .orb.o1 {
            width: 280px;
            height: 280px;
            top: -170px;
            left: -130px;
            background: radial-gradient(circle, rgba(18, 125, 170, .38), transparent 68%);
            animation: orbFloat 7s ease-in-out infinite;
        }

        .orb.o2 {
            width: 350px;
            height: 350px;
            right: -190px;
            bottom: -210px;
            background: radial-gradient(circle, rgba(18, 125, 170, .34), transparent 68%);
            animation: orbFloat 9s ease-in-out infinite reverse;
        }

        @keyframes orbFloat {
            50% { transform: translate(18px, 12px) scale(1.08); }
        }

        /* =========================================================
           LOGIN CARD
        ========================================================= */

        .login-card {
            position: relative;
            width: min(410px, calc(100% - 32px));
            padding: 42px 42px 36px;
            border: 1px solid rgba(255, 255, 255, .18);
            border-radius: 28px;
            background: linear-gradient(
                145deg,
                rgba(255,255,255,.14),
                rgba(255,255,255,.055)
            );
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            box-shadow:
                0 30px 80px rgba(0,0,0,.62),
                inset 0 1px 0 rgba(255,255,255,.18),
                0 0 45px rgba(18, 125, 170, .12);
            animation: cardEnter .8s cubic-bezier(.2,.8,.2,1) both;
        }

        .login-card::before {
            content: "";
            position: absolute;
            inset: 1px;
            border-radius: 27px;
            pointer-events: none;
            background: linear-gradient(
                135deg,
                rgba(255,255,255,.10),
                transparent 30%,
                transparent 70%,
                rgba(18, 125, 170, .10)
            );
        }

        .login-card::after {
            content: "";
            position: absolute;
            width: 120px;
            height: 120px;
            right: -70px;
            top: -65px;
            border-radius: 50%;
            background: rgba(30, 154, 199, .22);
            filter: blur(35px);
            pointer-events: none;
        }

        @keyframes cardEnter {
            from {
                opacity: 0;
                transform: translateY(35px) scale(.96);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        /* =========================================================
           LOGO
        ========================================================= */

        .logo-wrap {
            position: relative;
            width: 116px;
            height: 116px;
            margin: 0 auto 20px;
            display: grid;
            place-items: center;
            border-radius: 50%;
            background: rgba(0,0,0,.22);
            border: 1px solid rgba(255,255,255,.16);
            box-shadow:
                0 0 0 7px rgba(30, 154, 199, .055),
                0 0 35px rgba(30, 154, 199, .20);
            animation: logoEnter 1s .15s both, logoGlow 3s 1.2s ease-in-out infinite;
        }

        .logo-wrap::before {
            content: "";
            position: absolute;
            inset: -7px;
            border-radius: 50%;
            border: 1px solid rgba(56, 184, 232, .30);
            animation: logoRing 4s linear infinite;
        }

        .logo {
            width: 86px;
            max-height: 86px;
            object-fit: contain;
            filter: drop-shadow(0 0 10px rgba(56, 184, 232, .22));
        }

        @keyframes logoEnter {
            from { opacity: 0; transform: scale(.55) rotate(-12deg); }
            to   { opacity: 1; transform: scale(1) rotate(0); }
        }

        @keyframes logoGlow {
            50% {
                box-shadow:
                    0 0 0 7px rgba(30, 154, 199, .08),
                    0 0 48px rgba(30, 154, 199, .38);
            }
        }

        @keyframes logoRing {
            to { transform: rotate(360deg); }
        }

        /* =========================================================
           TEXT
        ========================================================= */

        .welcome {
            position: relative;
            text-align: center;
            font-size: 25px;
            font-weight: 700;
            letter-spacing: -.4px;
            color: #fff;
            animation: textEnter .7s .25s both;
        }

        .welcome span {
            color: var(--blue-light);
        }

        .subtitle {
            text-align: center;
            margin: 8px 0 30px;
            color: rgba(255,255,255,.55);
            font-size: 12px;
            animation: textEnter .7s .35s both;
        }

        @keyframes textEnter {
            from { opacity: 0; transform: translateY(10px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* =========================================================
           FORM
        ========================================================= */

        .login-form {
            position: relative;
            z-index: 2;
        }

        .form-group {
            margin-bottom: 18px;
            animation: fieldEnter .6s both;
        }

        .form-group:nth-child(1) { animation-delay: .4s; }
        .form-group:nth-child(2) { animation-delay: .48s; }

        @keyframes fieldEnter {
            from { opacity: 0; transform: translateY(10px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .form-label {
            display: block;
            margin: 0 0 8px 2px;
            color: rgba(255,255,255,.75);
            font-size: 11px;
            font-weight: 600;
        }

        .input-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(255,255,255,.34);
            font-size: 15px;
            z-index: 2;
            transition: .25s ease;
        }

        .form-input {
            width: 100%;
            height: 48px;
            padding: 0 44px 0 43px;
            border: 1px solid rgba(255,255,255,.16);
            border-radius: 13px;
            outline: none;
            background: rgba(0,0,0,.25);
            color: #fff;
            font-size: 13px;
            transition: .25s ease;
        }

        .form-input::placeholder {
            color: rgba(255,255,255,.32);
        }

        .form-input:focus {
            border-color: rgba(56, 184, 232, .78);
            background: rgba(0,0,0,.36);
            box-shadow: 0 0 0 3px rgba(30, 154, 199, .12);
        }

        .form-input:focus ~ .input-icon {
            color: var(--blue-light);
        }

        .password-toggle {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            border: 0;
            background: transparent;
            color: rgba(255,255,255,.42);
            cursor: pointer;
            padding: 4px;
            transition: .2s;
        }

        .password-toggle:hover {
            color: var(--blue-light);
        }

        /* =========================================================
           ERROR
        ========================================================= */

        .error-message {
            margin-bottom: 18px;
            padding: 10px 12px;
            border: 1px solid rgba(255, 92, 92, .25);
            border-radius: 10px;
            background: rgba(255, 70, 70, .08);
            color: #ff9d9d;
            font-size: 11px;
            text-align: center;
        }

        /* =========================================================
           BUTTON
        ========================================================= */

        .login-button {
            position: relative;
            overflow: hidden;
            width: 100%;
            height: 49px;
            margin-top: 4px;
            border: 1px solid rgba(104, 214, 250, .46);
            border-radius: 14px;
            background: linear-gradient(135deg, #084761, #1596c7, #0b5874);
            color: #ffffff;
            font-size: 13px;
            font-weight: 800;
            letter-spacing: .3px;
            cursor: pointer;
            box-shadow:
                0 10px 25px rgba(18, 125, 170, .22),
                inset 0 1px 0 rgba(255,255,255,.30);
            transition: transform .2s, box-shadow .2s, filter .2s;
            animation: fieldEnter .6s .55s both;
        }

        .login-button::before {
            content: "";
            position: absolute;
            top: 0;
            left: -90px;
            width: 55px;
            height: 100%;
            transform: skewX(-20deg);
            background: rgba(255,255,255,.42);
            filter: blur(5px);
            animation: buttonShine 3.5s ease-in-out infinite;
        }

        @keyframes buttonShine {
            0%, 45% { left: -90px; }
            65%, 100% { left: calc(100% + 50px); }
        }

        .login-button:hover {
            filter: brightness(1.08);
            transform: translateY(-2px);
            box-shadow:
                0 14px 32px rgba(18, 125, 170, .34),
                inset 0 1px 0 rgba(255,255,255,.34);
        }

        .login-button:active {
            transform: translateY(0) scale(.985);
        }

        .login-button.loading {
            pointer-events: none;
            filter: grayscale(.1);
        }

        .button-content {
            position: relative;
            z-index: 2;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .spinner {
            display: none;
            width: 15px;
            height: 15px;
            border: 2px solid rgba(255,255,255,.35);
            border-top-color: #ffffff;
            border-radius: 50%;
            animation: spin .7s linear infinite;
        }

        .login-button.loading .spinner {
            display: inline-block;
        }

        .login-button.loading .button-text {
            display: none;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        .footer-text {
            margin-top: 22px;
            text-align: center;
            font-size: 10px;
            color: rgba(255,255,255,.32);
        }

        .footer-text span {
            color: rgba(56, 184, 232, .78);
        }

        /* =========================================================
           RESPONSIVE
        ========================================================= */

        @media (max-width: 520px) {
            body {
                overflow-y: auto;
            }

            .login-page {
                min-height: 100svh;
                padding: 20px 0;
            }

            .login-card {
                width: calc(100% - 28px);
                padding: 32px 24px 27px;
                border-radius: 24px;
            }

            .logo-wrap {
                width: 98px;
                height: 98px;
                margin-bottom: 17px;
            }

            .logo {
                width: 73px;
                max-height: 73px;
            }

            .welcome {
                font-size: 22px;
            }

            .subtitle {
                margin-bottom: 25px;
            }

            .light {
                width: 100vw;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                animation-duration: .01ms !important;
                animation-iteration-count: 1 !important;
            }
        }

        
    /* =========================================
        PORTFOLIO WATERMARK
        ========================================= */

        .portfolio-watermark {
            position: fixed;
            z-index: 99999;

            left: 50%;
            bottom: 18px;

            transform: translateX(-50%);

            display: flex;
            align-items: center;
            gap: 9px;

            padding: 7px 12px;

            color: rgba(210, 235, 245, .55);
            text-decoration: none;

            font-size: 11px;
            font-weight: 500;
            letter-spacing: .4px;

            background: rgba(3, 20, 28, .45);

            border: 1px solid rgba(55, 190, 235, .15);
            border-radius: 12px;

            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);

            box-shadow:
                0 5px 20px rgba(0, 0, 0, .18);

            transition:
                .3s ease;

            animation: watermarkIn .9s ease .5s both;
        }

        .portfolio-watermark img {
            width: 28px;
            height: 28px;

            object-fit: contain;

            opacity: .68;

            filter:
                drop-shadow(
                    0 0 8px
                    rgba(45, 200, 245, .35)
                );

            transition: .3s ease;
        }

        .portfolio-watermark span {
            white-space: nowrap;
        }

        .portfolio-watermark strong {
            color: #54d4ff;
            font-weight: 700;
        }

        /* Hover */

        .portfolio-watermark:hover {
            color: #ffffff;

            text-decoration: none;

            transform:
                translateX(-50%)
                translateY(-3px);

            background: rgba(5, 43, 57, .72);

            border-color:
                rgba(70, 210, 250, .40);

            box-shadow:
                0 8px 30px rgba(0, 0, 0, .25),
                0 0 25px rgba(25, 180, 230, .18);
        }

        .portfolio-watermark:hover img {
            opacity: 1;

            transform: scale(1.12);

            filter:
                drop-shadow(
                    0 0 14px
                    rgba(55, 215, 255, .75)
                );
        }

        .portfolio-watermark:hover strong {
            color: #70deff;
        }


        /* Animation */

        @keyframes watermarkIn {

            from {
                opacity: 0;

                transform:
                    translateX(-50%)
                    translateY(10px);
            }

            to {
                opacity: 1;

                transform:
                    translateX(-50%)
                    translateY(0);
            }
        }


        /* Mobile */

        @media (max-width: 576px) {

            .portfolio-watermark {
                bottom: 12px;

                padding: 6px 9px;

                font-size: 10px;
            }

            .portfolio-watermark img {
                width: 23px;
                height: 23px;
            }
        }
    </style>
</head>

<body>

<div class="login-page">

    {{-- Animated background --}}
    <div class="light one"></div>
    <div class="light two"></div>

    <div class="streak s1"></div>
    <div class="streak s2"></div>
    <div class="streak s3"></div>

    <div class="orb o1"></div>
    <div class="orb o2"></div>

    <div class="noise"></div>

    {{-- Login card --}}
    <main class="login-card">

        {{-- Logo dari public/images/intracs.png --}}
        <div class="logo-wrap">
            <img
                src="{{ asset('images/intracs (2).png') }}"
                alt="Logo Intracs"
                class="logo"
            >
        </div>

        <h1 class="welcome">
            Selamat <span>Datang</span>
        </h1>

        <p class="subtitle">
            Masuk ke akun Anda untuk melanjutkan
        </p>

        @if($errors->any())
            <div class="error-message">
                <i class="bi bi-exclamation-circle"></i>
                {{ $errors->first() }}
            </div>
        @endif

        <form
            action="{{ route('login.process') }}"
            method="POST"
            class="login-form"
            id="loginForm"
        >
            @csrf

            <div class="form-group">
                <label class="form-label" for="email">Email</label>

                <div class="input-wrapper">
                    <i class="bi bi-person input-icon"></i>

                    <input
                        id="email"
                        type="email"
                        name="email"
                        class="form-input"
                        placeholder="Masukkan email"
                        value="{{ old('email') }}"
                        autocomplete="email"
                        required
                        autofocus
                    >
                </div>
            </div>

            <div class="form-group">
                <label class="form-label" for="password">Password</label>

                <div class="input-wrapper">
                    <i class="bi bi-lock input-icon"></i>

                    <input
                        id="password"
                        type="password"
                        name="password"
                        class="form-input"
                        placeholder="Masukkan password"
                        autocomplete="current-password"
                        required
                    >

                    <button
                        type="button"
                        class="password-toggle"
                        id="togglePassword"
                        aria-label="Tampilkan password"
                    >
                        <i class="bi bi-eye" id="eyeIcon"></i>
                    </button>
                </div>
            </div>

            <button type="submit" class="login-button" id="loginButton">
                <span class="button-content">
                    <span class="button-text">
                        <i class="bi bi-box-arrow-in-right"></i>
                        Masuk
                    </span>

                    <span class="spinner"></span>
                </span>
            </button>
        </form>

        <p class="footer-text">
            Sistem Informasi <span>Intracs</span>
        </p>
    </main>
</div>

    <a
        href="https://muhamad-syauqi.github.io/My_Portofolio/"
        target="_blank"
        rel="noopener noreferrer"
        class="portfolio-watermark"
        aria-label="Kunjungi portfolio"
    >
        <img
            src="{{ asset('images/watermark-logo.png') }}"
            alt="Portfolio"
        >

        <span>
            Personal made by
            <strong>@M.Syauqi</strong>
        </span>
    </a>

<script>
    // Show / hide password
    const password = document.getElementById('password');
    const togglePassword = document.getElementById('togglePassword');
    const eyeIcon = document.getElementById('eyeIcon');

    togglePassword.addEventListener('click', function () {
        const isPassword = password.type === 'password';

        password.type = isPassword ? 'text' : 'password';
        eyeIcon.className = isPassword
            ? 'bi bi-eye-slash'
            : 'bi bi-eye';

        this.setAttribute(
            'aria-label',
            isPassword ? 'Sembunyikan password' : 'Tampilkan password'
        );
    });

    // Loading animation saat form dikirim
    const loginForm = document.getElementById('loginForm');
    const loginButton = document.getElementById('loginButton');

    loginForm.addEventListener('submit', function () {
        if (!loginForm.checkValidity()) return;

        loginButton.classList.add('loading');
    });
</script>

</body>
</html>
