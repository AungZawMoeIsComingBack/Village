<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in | Village</title>

    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
            font-family: Arial, sans-serif;
            background: #f4f7f5;
            color: #24332b;
        }

        .login-card {
            width: 100%;
            max-width: 430px;
            padding: 36px;
            background: #fff;
            border: 1px solid #e0e8e2;
            border-radius: 20px;
            box-shadow: 0 12px 40px rgba(30, 60, 40, 0.08);
        }

        .brand {
            color: #28784d;
            font-size: 30px;
            font-weight: 700;
            letter-spacing: -1px;
        }

        .subtitle {
            margin: 10px 0 28px;
            color: #68756d;
            line-height: 1.6;
        }

        .field { margin-bottom: 18px; }

        label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            font-weight: 600;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 13px 14px;
            border: 1px solid #d5ded8;
            border-radius: 10px;
            font-size: 15px;
        }

        input:focus {
            outline: 2px solid #b4ddc3;
            border-color: #28784d;
        }

        .remember {
            display: flex;
            align-items: center;
            gap: 8px;
            margin: 4px 0 22px;
            color: #68756d;
            font-size: 14px;
        }

        .error {
            margin-top: 6px;
            color: #c0392b;
            font-size: 13px;
        }

        .error-summary {
            margin-bottom: 18px;
            padding: 12px;
            background: #fff1f0;
            border-radius: 8px;
            color: #c0392b;
            font-size: 14px;
        }

        button {
            width: 100%;
            padding: 14px;
            border: 0;
            border-radius: 10px;
            background: #28784d;
            color: white;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
        }

        button:hover { background: #20633f; }

        .footer {
            margin-top: 22px;
            text-align: center;
            color: #68756d;
            font-size: 14px;
        }

        a {
            color: #28784d;
            font-weight: 600;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <main class="login-card">
        <div class="brand">Village</div>

        <h1>Welcome back</h1>

        <p class="subtitle">
            Sign in to reconnect with your community.
        </p>

        @if ($errors->any())
            <div class="error-summary" role="alert">
                Please check your email and password.
            </div>
        @endif

        <form method="POST" action="{{ route('login.store') }}">
            @csrf

            <div class="field">
                <label for="email">Email address</label>
                <input
                    id="email"
                    name="email"
                    type="email"
                    value="{{ old('email') }}"
                    autocomplete="username"
                    required
                    autofocus
                >

                @error('email')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="field">
                <label for="password">Password</label>
                <input
                    id="password"
                    name="password"
                    type="password"
                    autocomplete="current-password"
                    required
                >

                @error('password')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <label class="remember">
                <input type="checkbox" name="remember" value="1">
                Remember me
            </label>

            <button type="submit">Log in</button>
        </form>

        <div class="footer">
            New to Village?
            <a href="{{ route('register') }}">Create an account</a>
        </div>
    </main>
</body>
</html>
