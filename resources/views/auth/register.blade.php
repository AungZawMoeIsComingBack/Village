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

        .profile-picture-section {
            margin-bottom: 20px;
        }

        .picture-picker {
            display: flex;
            justify-content: center;
            margin: 16px 0;
        }

        .picture-picker-button {
            position: relative;
            width: 120px;
            height: 120px;
            padding: 0;
            border: 3px solid #d5e8d9;
            border-radius: 50%;
            background: #e4f2e8;
            color: #28784d;
            cursor: pointer;
            overflow: hidden;
        }

        .picture-picker-button img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .picture-picker-button .initial {
            display: flex;
            width: 100%;
            height: 100%;
            align-items: center;
            justify-content: center;
            font-size: 36px;
            font-weight: bold;
        }

        .picture-picker-button img[hidden],
        .picture-picker-button .initial[hidden] {
            display: none;
        }

        .picture-picker-hint {
            color: #68756d;
            font-size: 13px;
            text-align: center;
        }

        input[type="file"].hidden-file-input {
            display: none;
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

        <form
            method="POST"
            action="{{ route('register.store') }}"
            enctype="multipart/form-data"
        >
            @csrf

            <div class="profile-picture-section">
                <label for="profile_image">Profile Picture (Optional)</label>

                <div class="picture-picker">
                    <button
                        type="button"
                        class="picture-picker-button"
                        id="picture-picker-button"
                        aria-label="Choose profile picture"
                    >
                        <img id="picture-preview" src="" alt="Profile preview" hidden>

                        <span class="initial" id="picture-initial">
                            V
                        </span>
                    </button>
                </div>

                <input
                    id="profile_image"
                    class="hidden-file-input"
                    type="file"
                    name="profile_image"
                    accept="image/jpeg,image/png,image/webp"
                >

                <p class="picture-picker-hint">
                    Tap the picture to upload a photo. JPG, PNG or WebP, up to 10 MB.
                </p>

                @error('profile_image')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

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

    <script>
        const pictureButton = document.getElementById('picture-picker-button');
        const imageInput = document.getElementById('profile_image');
        const imagePreview = document.getElementById('picture-preview');
        const pictureInitial = document.getElementById('picture-initial');

        let previewUrl = null;

        pictureButton.addEventListener('click', function () {
            imageInput.click();
        });

        imageInput.addEventListener('change', function () {
            const file = this.files[0];

            if (!file) return;

            const allowedTypes = [
                'image/jpeg',
                'image/png',
                'image/webp'
            ];

            if (!allowedTypes.includes(file.type)) {
                alert('Please select a JPG, PNG, or WebP image.');
                this.value = '';
                return;
            }

            if (file.size > 10 * 1024 * 1024) {
                alert('Image size must not exceed 10 MB.');
                this.value = '';
                return;
            }

            if (previewUrl) {
                URL.revokeObjectURL(previewUrl);
            }

            previewUrl = URL.createObjectURL(file);

            imagePreview.src = previewUrl;
            imagePreview.hidden = false;
            pictureInitial.hidden = true;
        });
    </script>
</body>
</html>
