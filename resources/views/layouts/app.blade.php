<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'ShoesLand')</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('storage/logo.svg') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            background: radial-gradient(ellipse at center, rgba(255, 254, 234, 1) 0%, rgba(255, 254, 234, 1) 35%, #B7E8EB 100%);
            overflow: hidden;
            background-image: url(https://static.vecteezy.com/system/resources/previews/010/617/206/original/landscape-cartoon-scene-with-green-trees-on-hills-and-white-fluffy-cloud-in-summer-blue-sky-background-vector.jpg);
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            width: 100%;

        }

        .top_link {
            position: absolute;
            height: 30px;
            width: 200px;
            left: -32px;
            /* text-align: left; */
            top: 32px;
        }

        .top_link a {
            text-decoration: none;
            color: black;
            position: absolute;
            right: 10px;
            bottom: 10px;
            font-size: 15px;
            display: flex;
            background-color: white;
            font-weight: bold;
            border-radius: 10px;
        }

        .ocean {
            height: 5%;
            width: 100%;
            position: absolute;
            bottom: 0;
            left: 0;
            background: #38d638;
        }

        .wave {
            background: url('/storage/wave.svg') repeat-x;
            position: absolute;
            top: -500px;
            width: 6240px;
            height: 500px;
            animation: wave 40s cubic-bezier(0.36, 0.45, 0.63, 0.53) infinite;
            transform: translate3d(0, 0, 0);
        }

        .wave:nth-of-type(2) {
            top: -324px;
            animation: wave 100s cubic-bezier(0.36, 0.45, 0.63, 0.53) -.125s infinite, swell 7s ease -1.25s infinite;
            opacity: 1;
        }

        @keyframes wave {
            0% {
                margin-left: 0;
            }

            100% {
                margin-left: -1600px;
            }
        }

        @keyframes swell {

            0%,
            100% {
                transform: translate3d(0, -25px, 0);
            }

            50% {
                transform: translate3d(0, 5px, 0);
            }
        }

        body {
            font-family: 'Montserrat', sans-serif;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: -20px 0 50px;
            position: relative;
        }

        h1 {
            font-weight: bold;
            margin: 0;
        }

        p {
            font-size: 14px;
            font-weight: 100;
            line-height: 20px;
            letter-spacing: .5px;
            margin: 20px 0 30px;
        }

        a {
            color: #0e263d;
            font-size: 14px;
            text-decoration: none;
            margin: 15px 0;
        }

        .container_login {
            background: #fff;
            border-radius: 90px;
            box-shadow: 30px 14px 28px rgba(0, 0, 5, .2), 0 10px 10px rgba(0, 0, 0, .2);
            position: relative;
            overflow: hidden;
            opacity: 85%;
            width: 768px;
            max-width: 100%;
            min-height: 480px;
            transition: 333ms;
            margin-top: 60px;
        }


        .form-container_login form {
            background: #fff;
            display: flex;
            flex-direction: column;
            padding: 0 50px;
            height: 100%;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .social-container_login {
            margin: 20px 0;
            display: block;
        }


        .social-container_login a {
            border: 1px solid rgb(3, 128, 12);
            border-radius: 50%;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            margin: 0 5px;
            height: 40px;
            width: 40px;
            transition: 333ms;
        }

        .social-container_login a:hover {
            transform: rotateZ(13deg);
            border: 1px solid rgb(0, 90, 34);
            color: #007306 !important;
        }

        .form-container_login input {
            background: #eee;
            border: none;
            border-radius: 50px;
            padding: 12px 15px;
            margin: 8px 0;
            width: 100%;
        }

        .form-container_login input:hover {
            transform: scale(101%);
        }

        button {
            border-radius: 50px;
            box-shadow: 0 1px 1px;
            border: 1px solid #00cf0a;
            background: #00950a;
            color: #fff;
            font-size: 12px;
            font-weight: bold;
            padding: 12px 45px;
            letter-spacing: 1px;
            text-transform: uppercase;
            transition: all linear 0.1s;
        }

        button:active {
            transform: scale(.95);
        }

        button:hover {
            background: #007a08;
        }

        button:focus {
            outline: none;
        }

        button.ghost {
            background: transparent;
            border-color: #fff;
        }

        .form-container_login {
            position: absolute;
            top: 0;
            height: 100%;
            transition: all .6s ease-in-out;
        }

        .sign-in-container_login {
            left: 0;
            width: 50%;
            z-index: 2;
        }

        .sign-up-container_login {
            left: 0;
            width: 50%;
            z-index: 1;
            opacity: 0;
        }

        .overlay-container_login {
            position: absolute;
            top: 0;
            left: 50%;
            width: 50%;
            height: 100%;
            overflow: hidden;
            transition: transform .6s ease-in-out;
            z-index: 100;
        }

        .overlay {
            background: #ff416c;
            background: linear-gradient(to right, #0be04f, #007306) no-repeat 0 0 / cover;
            color: #fff;
            position: relative;
            left: -100%;
            height: 100%;
            width: 200%;
            transform: translateY(0);
            transition: transform .6s ease-in-out;
        }

        .overlay-panel {
            position: absolute;
            top: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 0 40px;
            height: 100%;
            width: 50%;
            text-align: center;
            transform: translateY(0);
            transition: transform .6s ease-in-out;
        }

        .overlay-right {
            right: 0;
            transform: translateY(0);
        }

        .overlay-left {
            transform: translateY(-20%);
        }

        /* Move signin to right */
        .container_login.right-panel-active .sign-in-container_login {
            transform: translateY(100%);
        }

        /* Move overlay to left */
        .container_login.right-panel-active .overlay-container_login {
            transform: translateX(-100%);
        }

        /* Bring signup over signin */
        .container_login.right-panel-active .sign-up-container_login {
            transform: translateX(100%);
            opacity: 1;
            z-index: 5;
        }

        /* Move overlay back to right */
        .container_login.right-panel-active .overlay {
            transform: translateX(50%);
        }

        /* Bring back the text to center */
        .container_login.right-panel-active .overlay-left {
            transform: translateY(0);
        }

        /* Same effect for right */
        .container_login.right-panel-active .overlay-right {
            transform: translateY(20%);
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <main role="main">
            @yield('content')
        </main>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @yield('scripts')
</body>

<script>
    const signUpButton = document.getElementById('signUp');
    const signInButton = document.getElementById('signIn');
    const container_login = document.getElementById('container_login');

    signUpButton.addEventListener('click', () =>
        container_login.classList.add('right-panel-active'));

    signInButton.addEventListener('click', () =>
        container_login.classList.remove('right-panel-active'));
</script>

</html>
