<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EditProfileController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', [RegisteredUserController::class, 'show'])
    ->name('register');

Route::post('/register', [RegisteredUserController::class, 'store'])
    ->name('register.store');

Route::get('/login', [AuthenticatedSessionController::class, 'create'])
    ->name('login');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])
    ->name('login.store');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

Route::get('/profile', [ProfileController::class, 'show'])
    ->middleware('auth')
    ->name('profile');

Route::middleware('auth')->group(function () {
    Route::get('/profile/edit', [EditProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [EditProfileController::class, 'update'])
        ->name('profile.update');
});

Route::delete('/profile/picture', [
    EditProfileController::class,
    'deleteProfilePicture'
])->middleware('auth')->name('profile.picture.delete');