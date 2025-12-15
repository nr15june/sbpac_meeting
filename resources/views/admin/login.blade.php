<!doctype html>
<html lang="th">
<head>
    <meta charset="utf-8">
    <title>@yield('title', 'เพิ่มห้องประชุม | ศอ.บต.')</title>
    <link rel="icon" type="image/png" href="{{ asset('images/sbpac-logo.png') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- ฟอนต์ Sarabun -->
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
        }
        body {
            margin: 0;
            min-height: 100vh;
            font-family: "Sarabun", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            background-color: #ffffff;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-wrapper {
            background-color: #FFFBFB;
            border-radius: 10px;
            width: 470px;
            max-width: 90%;
            padding: 40px 40px 45px;
            box-shadow: 0 8px 18px rgba(0,0,0,0.08);
        }

        .logo-row {
            display: flex;
            align-items: center;
            margin-bottom: 28px;
        }

        .logo-row img {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 18px;
        }

        .logo-text-th {
            font-size: 16px;
            font-weight: 700;
            line-height: 1.35;
        }

        .logo-text-en {
            font-size: 12px;
            color: #555;
            margin-top: 3px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-label {
            font-size: 14px;
            margin-bottom: 5px;
            color: #444;
        }

        .form-control {
            width: 100%;
            padding: 10px 12px;
            font-size: 14px;
            border-radius: 3px;
            border: 1px solid #ddd;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .form-control::placeholder {
            color: #bbb;
        }

        .form-control:focus {
            border-color: #999;
            box-shadow: 0 0 0 2px rgba(0,0,0,0.05);
        }

        .btn-login {
            margin-top: 40px;
            width: 140px;
            display: block;
            margin-left: auto;
            margin-right: auto;
            padding: 10px 0;
            border-radius: 15px;
            border: none;
            font-size: 15px;
            font-weight: 600;
            color: #fff;
            background-color: #787878;
            letter-spacing: 1px;
        }

        .btn-login:hover {
            background-color: #5f5f5f;
        }

        .btn-login:active {
            transform: translateY(1px);
        }

        .error-msg {
            color: #d00;
            font-size: 13px;
            margin-bottom: 10px;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="login-wrapper">
    <div class="logo-row">
        <img src="{{ asset('images/sbpac-logo.png') }}" alt="SBPAC Logo">
        <div>
            <div class="logo-text-th">
                ศูนย์อำนวยการบริหารจังหวัดชายแดนภาคใต้
            </div>
            <div class="logo-text-en">
                Southern Border Provinces Administrative Centre
            </div>
        </div>
    </div>

    {{-- แสดง error ถ้า login ไม่ผ่าน --}}
    @if (session('error'))
        <div class="error-msg">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('admin.login.submit') }}" method="POST">
        @csrf
        <div class="form-group">
            <div class="form-label">Email</div>
            <input type="email" name="email" class="form-control" placeholder="email" required>
        </div>

        <div class="form-group">
            <div class="form-label">Password</div>
            <input type="password" name="password" class="form-control" placeholder="password" required>
        </div>

        <button type="submit" class="btn-login">LOGIN</button>
    </form>
</div>

</body>
</html>
