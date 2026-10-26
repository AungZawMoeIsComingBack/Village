<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile — Village</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f5f8f5;
            color: #20352a;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 8%;
            background: white;
            border-bottom: 1px solid #e2eae3;
        }

        .logo {
            color: #28784d;
            font-size: 26px;
            font-weight: bold;
            text-decoration: none;
        }

        .back-link {
            color: #28784d;
            text-decoration: none;
            font-weight: bold;
        }

        .container {
            max-width: 760px;
            margin: 45px auto;
            padding: 0 20px;
        }

        .profile-card {
            padding: 35px;
            background: white;
            border: 1px solid #e2eae3;
            border-radius: 20px;
            text-align: center;
        }

        .avatar {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100px;
            height: 100px;
            margin: 0 auto 20px;
            border-radius: 50%;
            background: #e4f2e8;
            color: #28784d;
            font-size: 38px;
            font-weight: bold;
        }

        .avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
        }

        h1 {
            margin-bottom: 8px;
        }

        .bio-text {
            margin: 0 0 16px;
            color: #34483b;
            font-size: 15px;
            line-height: 1.6;
            white-space: pre-wrap;
            overflow-wrap: anywhere;
        }

        .button {
            display: inline-block;
            padding: 12px 20px;
            border: 0;
            border-radius: 10px;
            background: #28784d;
            color: white;
            text-decoration: none;
            font-weight: bold;
            margin-top: 25px;
        }

        .info {
            margin-top: 30px;
            padding: 20px;
            background: #f5f8f5;
            border-radius: 12px;
            text-align: left;
        }

        .info p {
            overflow-wrap: anywhere;
        }
    </style>
</head>
<body>
    <header>
        <a class="logo" href="{{ url('/') }}">Village</a>
        <a class="back-link" href="{{ url('/') }}">← Home</a>
    </header>

    <main class="container">
        <section class="profile-card">
            <div class="avatar">
                @if (auth()->user()->profile?->profile_image)
                    <img
                        src="{{ asset('storage/' . auth()->user()->profile->profile_image) }}"
                        alt="Profile Picture"
                    >
                @else
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                @endif
            </div>

            <h1>{{ auth()->user()->name }}</h1>

            @if (auth()->user()->profile?->bio)
                <p class="bio-text">{{ auth()->user()->profile->bio }}</p>
            @endif

            <div class="info">
                <h2>Account Information</h2>
                <p><strong>Name:</strong> {{ auth()->user()->name }}</p>
                <p><strong>Email:</strong> {{ auth()->user()->email }}</p>
                <p><strong>Member since:</strong>
                    {{ auth()->user()->created_at->format('F Y') }}
                </p>
            </div>

            <a class="button" href="{{ route('profile.edit') }}">
                Edit Profile
            </a>

        </section>
    </main>
</body>
</html>
