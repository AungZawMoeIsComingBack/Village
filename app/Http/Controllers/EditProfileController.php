<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class EditProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        $profile = $user->profile;

        return view('profile.edit', compact('user', 'profile'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'bio' => ['nullable', 'string', 'max:1000'],
            'profile_image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:3072',
            ],
        ]);

        DB::transaction(function () use ($user, $validated, $request) {
            $user->update([
                'name' => $validated['name'],
            ]);

            $profileData = [
                'bio' => $validated['bio'] ?? null,
            ];

            if ($request->hasFile('profile_image')) {
                $path = $request->file('profile_image')
                    ->store('profile-images', 'public');

                $profileData['profile_image'] = $path;
            }

            $user->profile()->updateOrCreate(
                ['user_id' => $user->id],
                $profileData
            );
        });

    return redirect()
        ->route('profile')
        ->with('success', 'Profile updated successfully!');
    }

    public function deleteProfilePicture()
    {
    $user = Auth::user();
    $profile = $user->profile;

    if ($profile && $profile->profile_image) {
        Storage::disk('public')->delete($profile->profile_image);

        $profile->update([
            'profile_image' => null,
        ]);
        }

    return redirect()
        ->route('profile.edit')
        ->with('success', 'Profile picture deleted successfully!');
    }
}