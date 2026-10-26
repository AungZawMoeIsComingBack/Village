<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile — Village</title>

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
            max-width: 650px;
            margin: 45px auto;
            padding: 0 20px;
        }

        .card {
            padding: 30px;
            background: white;
            border: 1px solid #e2eae3;
            border-radius: 18px;
        }

        h1 { margin-top: 0; }

        .description {
            color: #718077;
            line-height: 1.6;
        }

        label {
            display: block;
            margin: 22px 0 8px;
            font-weight: bold;
        }

        input, textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #d5e0d7;
            border-radius: 9px;
            font: inherit;
        }

        textarea {
            min-height: 130px;
            resize: vertical;
        }

        input:focus, textarea:focus {
            outline: 2px solid #b4d8bf;
            border-color: #28784d;
        }

        .delete-picture-button {
            margin-top: 10px;
            padding: 10px 16px;
            border: 1px solid #dc3545;
            border-radius: 8px;
            background: white;
            color: #dc3545;
            cursor: pointer;
            font-weight: bold;
        }

        .delete-picture-button:hover {
            background: #dc3545;
            color: white;
        }

        .button {
            margin-top: 24px;
            padding: 13px 20px;
            background: #28784d;
            color: white;
            border: 0;
            border-radius: 9px;
            font-weight: bold;
            cursor: pointer;
        }

        .cancel {
            margin-left: 12px;
            color: #28784d;
            text-decoration: none;
        }

        .error {
            margin-top: 6px;
            color: #c0392b;
            font-size: 14px;
        }

        .success {
            padding: 12px;
            border-radius: 8px;
            background: #e4f2e8;
            color: #20633f;
        }

        .picture-action-area {
            position: relative;
            display: inline-block;
            margin-top: 12px;
        }

        .picture-click-button {
            position: relative;
            width: 120px;
            height: 120px;
            padding: 0;
            border: 3px solid #d5e8d9;
            border-radius: 50%;
            background: #e4f2e8;
            cursor: pointer;
            overflow: hidden;
        }

        .picture-click-button img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .picture-initial {
            display: flex;
            width: 100%;
            height: 100%;
            align-items: center;
            justify-content: center;
            color: #28784d;
            font-size: 36px;
            font-weight: bold;
        }

        .picture-menu {
            position: absolute;
            top: 125px;
            left: 0;
            z-index: 10;
            width: 220px;
            padding: 6px;
            background: white;
            border: 1px solid #e2eae3;
            border-radius: 10px;
            box-shadow: 0 6px 20px #20352a1a;
        }

        .picture-menu button {
            display: block;
            width: 100%;
            padding: 11px;
            border: none;
            background: white;
            text-align: left;
            border-radius: 6px;
            cursor: pointer;
        }

        .picture-menu button:hover {
            background: #f0f6f1;
        }

        .picture-menu .delete-menu-option {
            color: #dc3545;
        }
    </style>
</head>
<body>
    <header>
        <a class="logo" href="{{ url('/') }}">Village</a>
        <a class="back-link" href="{{ route('profile') }}">← Profile</a>
    </header>

    <main class="container">
        <section class="card">
            <h1>Edit your profile</h1>

            @if (session('success'))
                <p class="success">{{ session('success') }}</p>
            @endif

            <form method="POST"
                action="{{ route('profile.update') }}"
                enctype="multipart/form-data">
                @csrf
                @method('PATCH')

            <label>Profile Picture</label>

            <div class="picture-action-area">
                <button
                    type="button"
                    class="picture-click-button"
                    id="picture-menu-button"
                    aria-label="Manage profile picture"
                >
                    <img
                        id="picture-preview"
                        src="{{ auth()->user()->profile?->profile_image
                            ? asset('storage/' . auth()->user()->profile->profile_image)
                            : '' }}"
                        alt="Profile Picture"
                        @if (!auth()->user()->profile?->profile_image)
                            hidden
                        @endif
                    >

                    <span
                        id="picture-initial"
                        class="picture-initial"
                        @if (auth()->user()->profile?->profile_image)
                            hidden
                        @endif
                    >
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </span>

                </button>

                <div class="picture-menu" id="picture-menu" hidden>
                    <button type="button" id="update-picture-button">
                        Update Profile Picture
                    </button>

                    @if (auth()->user()->profile?->profile_image)
                        <button
                            type="button"
                            id="delete-picture-button"
                            class="delete-menu-option"
                        >
                            Delete Profile Picture
                        </button>
                    @endif
                </div>
            </div>

            <input
                id="profile_image"
                type="file"
                name="profile_image"
                accept="image/jpeg,image/png,image/webp"
                hidden
            >

            @error('profile_image')
                <p class="error">{{ $message }}</p>
            @enderror
                
                <label for="name">Full name</label>
                <input
                    id="name"
                    type="text"
                    name="name"
                    value="{{ old('name', $user->name) }}"
                    maxlength="255"
                    required
                >
                @error('name')
                    <p class="error">{{ $message }}</p>
                @enderror

                <label for="bio">Bio</label>
                <textarea
                    id="bio"
                    name="bio"
                    maxlength="1000"
                    placeholder="Tell us something about yourself..."
                >{{ old('bio', $profile?->bio) }}</textarea>
                @error('bio')
                    <p class="error">{{ $message }}</p>
                @enderror

                <button class="button" type="submit">Save changes</button>
                <a class="cancel" href="{{ route('profile') }}">Cancel</a>
            </form>

        </section>
    </main>

    <script>
        const pictureButton = document.getElementById('picture-menu-button');
        const pictureMenu = document.getElementById('picture-menu');
        const updateButton = document.getElementById('update-picture-button');
        const imageInput = document.getElementById('profile_image');
        const imagePreview = document.getElementById('picture-preview');
        const pictureInitial = document.getElementById('picture-initial');
        const deleteButton = document.getElementById('delete-picture-button');

        pictureButton.addEventListener('click', function () {
            pictureMenu.hidden = !pictureMenu.hidden;
        });

        updateButton.addEventListener('click', function () {
            pictureMenu.hidden = true;
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

            const previewUrl = URL.createObjectURL(file);

            imagePreview.src = previewUrl;
            imagePreview.hidden = false;
            pictureInitial.hidden = true;
        });

        if (deleteButton) {
            deleteButton.addEventListener('click', function () {
                if (confirm('Delete your profile picture?')) {
                    const deleteForm = document.createElement('form');

                    deleteForm.method = 'POST';
                    deleteForm.action = @json(route('profile.picture.delete'));

                    deleteForm.innerHTML = `
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="DELETE">
                    `;

                    document.body.appendChild(deleteForm);
                    deleteForm.submit();
                }
            });
        }

        document.addEventListener('click', function (event) {
        const pictureArea = document.querySelector('.picture-action-area');
        const pictureMenu = document.getElementById('picture-menu');

        if (
            pictureArea &&
            pictureMenu &&
            !pictureArea.contains(event.target)
        ) {
            pictureMenu.hidden = true;
        }
        });
    </script>

</body>
</html>