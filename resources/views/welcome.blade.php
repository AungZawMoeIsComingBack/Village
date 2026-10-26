
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Village — A place to belong</title>

    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f5f8f5;
            color: #20352a;
        }

        header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 22px 8%;
            background: white;
            border-bottom: 1px solid #e5ece6;
        }

        .logo {
            color: #28784d;
            font-size: 27px;
            font-weight: 800;
            letter-spacing: -1px;
        }

        .header-profile {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 44px;
            height: 44px;
            border-radius: 50%;
            overflow: hidden;
            text-decoration: none;
        }

        .header-profile img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
        }

        .header-avatar {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background: #e4f2e8;
            color: #28784d;
            font-weight: bold;
        }

        nav { display: flex; align-items: center; gap: 20px; }

        a {
            color: #28784d;
            text-decoration: none;
            font-weight: 600;
        }

        .button {
            display: inline-block;
            padding: 12px 19px;
            border-radius: 10px;
            background: #28784d;
            color: white;
            border: none;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
        }

        .button:hover { background: #20633f; }

        .button-outline {
            background: white;
            color: #28784d;
            border: 1px solid #28784d;
        }

        .hero {
            max-width: 1100px;
            margin: 0 auto;
            padding: 90px 24px 70px;
            text-align: center;
        }

        .eyebrow {
            display: inline-block;
            padding: 8px 13px;
            border-radius: 30px;
            background: #e4f2e8;
            color: #28784d;
            font-size: 13px;
            font-weight: 700;
        }

        h1 {
            max-width: 760px;
            margin: 25px auto 18px;
            font-size: clamp(38px, 6vw, 66px);
            line-height: 1.08;
            letter-spacing: -2px;
        }

        .highlight { color: #28784d; }

        .description {
            max-width: 610px;
            margin: 0 auto 30px;
            color: #68776d;
            font-size: 18px;
            line-height: 1.8;
        }

        .actions {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 12px;
        }

        .features {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            max-width: 1000px;
            margin: 0 auto;
            padding: 0 24px 70px;
        }

        .feature {
            padding: 27px;
            background: white;
            border: 1px solid #e4ebe5;
            border-radius: 18px;
        }

        .feature-icon { font-size: 28px; }

        .feature h2 { font-size: 19px; }

        .feature p {
            color: #68776d;
            line-height: 1.7;
            font-size: 14px;
        }

        .welcome-message {
            margin: 0 auto 25px;
            color: #28784d;
            font-weight: 700;
        }

        footer {
            padding: 25px;
            text-align: center;
            color: #718077;
            border-top: 1px solid #e4ebe5;
            font-size: 13px;
        }

        @media (max-width: 700px) {
            header { padding: 18px 5%; }
            nav { gap: 12px; }
            .hero { padding-top: 65px; }
            .features { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    <header>
        <a class="logo" href="{{ url('/') }}">Village</a>

        <nav>
            @auth
               
                <a href="{{ route('profile') }}" class="header-profile">
                    @if (auth()->user()->profile?->profile_image)
                        <img
                            src="{{ asset('storage/' . auth()->user()->profile->profile_image) }}"
                            alt="My Profile"
                        >
                    @else
                        <span class="header-avatar">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </span>
                    @endif
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="button" type="submit">Log out</button>
                </form>
            @else
                <a href="{{ route('login') }}">Log in</a>
                <a class="button" href="{{ route('register') }}">Join Village</a>
            @endauth
        </nav>
    </header>

    <main>
        <section class="hero">
            <span class="eyebrow">A community built around people</span>

            <h1>
                Your world is better
                <span class="highlight">together.</span>
            </h1>

            <p class="description">
                Village is a place to share your thoughts, discover new
                perspectives, and build meaningful connections with people
                around the world.
            </p>

            @auth
                <p class="welcome-message">
                    Welcome back, {{ Auth::user()->name }}!
                </p>

                <div class="actions">
                    <a class="button" href="#community">Explore Village</a>
                </div>
            @else
                <div class="actions">
                    <a class="button" href="{{ route('register') }}">
                        Get started
                    </a>
                    <a class="button button-outline" href="{{ route('login') }}">
                        I already have an account
                    </a>
                </div>
            @endauth
        </section>

        <section class="features" id="community">
            <article class="feature">
                <div class="feature-icon">🌱</div>
                <h2>Grow together</h2>
                <p>
                    Build connections with people who share your interests
                    and ideas.
                </p>
            </article>

            <article class="feature">
                <div class="feature-icon">💬</div>
                <h2>Share your voice</h2>
                <p>
                    Express yourself and take part in meaningful conversations.
                </p>
            </article>

            <article class="feature">
                <div class="feature-icon">🌍</div>
                <h2>Connect worldwide</h2>
                <p>
                    Discover different perspectives and make your world bigger.
                </p>
            </article>
        </section>
    </main>

    <footer>
        © {{ date('Y') }} Village. A place to connect and belong.
    </footer>
</body>
</html>
