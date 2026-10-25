<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Join Village</title>

    <style>
        * {
            box-sizing: border-box;
        }

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

        .register-card {
            width: 100%;
            max-width: 430px;
            padding: 36px;
            background: #ffffff;
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

        .field {
            margin-bottom: 18px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            font-weight: 600;
        }

        input {
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

        .error {
            margin-top: 6px;
            color: #c0392b;
            font-size: 13px;
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

        button:hover {
            background: #20633f;
        }

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
    <main class="register-card">
        <div class="brand">Village</div>

        <h1>Create your account</h1>
        <p class="subtitle">
            Join Village and start building meaningful connections.
        </p>

        @if ($errors->any())
            <div class="error" role="alert">
                Please check the information you entered.
            </div>
        @endif

        <form method="POST" action="{{ route('register.store') }}">
            @csrf

            <div class="field">
                <label for="name">Full name</label>
                <input
                    id="name"
                    name="name"
                    type="text"
                    value="{{ old('name') }}"
                    autocomplete="name"
                    required
                >
                @error('name')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="field">
                <label for="email">Email address</label>
                <input
                    id="email"
                    name="email"
                    type="email"
                    value="{{ old('email') }}"
                    autocomplete="email"
                    required
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
                    autocomplete="new-password"
                    required
                >
                @error('password')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="field">
                <label for="password_confirmation">
                    Confirm password
                </label>
                <input
                    id="password_confirmation"
                    name="password_confirmation"
                    type="password"
                    autocomplete="new-password"
                    required
                >
            </div>

            <button type="submit">Create account</button>
        </form>

        <div class="footer">
            Already a member?
            <a href="{{ route('login') }}">Log in</a>
        </div>
    </main>
</body>
</html>
