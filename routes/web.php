<?php

use Illuminate\Support\Facades\Route;
use App\Models\Gallery;
use App\Http\Controllers\CustomerAuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\SubscriptionController;

Route::get('/', function () {
    $homeGallery = Gallery::query()
        ->where('is_published', true)
        ->orderBy('sort_order')
        ->orderBy('created_at')
        ->take(5)
        ->get();

    return view('home', compact('homeGallery'));
})->name('home');

Route::middleware('guest')->group(function () {

    Route::get('/login', [CustomerAuthController::class, 'showLogin'])
        ->name('customer.login');

    Route::post('/login', [CustomerAuthController::class, 'login'])
        ->name('customer.login.store');

    Route::get('/register', [CustomerAuthController::class, 'showRegister'])
        ->name('customer.register');

    Route::post('/register', [CustomerAuthController::class, 'register'])
        ->name('customer.register.store');

});

Route::middleware('auth')->group(function () {

    Route::post('/logout', [CustomerAuthController::class, 'logout'])
        ->name('customer.logout');

    Route::get('/gallery', [GalleryController::class, 'index'])
        ->name('gallery');

    Route::get('/services', [ServicesController::class, 'index'])
        ->name('services.index');

    Route::get('/booking', [BookingController::class, 'index'])
        ->name('booking.index');

    Route::post('/booking', [BookingController::class, 'store'])
        ->name('booking.store');

    Route::get('/booking/availability', [BookingController::class, 'availability'])
        ->name('booking.availability');

    Route::get('/profile', [ProfileController::class, 'index'])
        ->name('profile.index');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::patch('/profile/password', [ProfileController::class, 'updatePassword'])
        ->name('profile.password.update');

    Route::get('/notifications', [NotificationController::class, 'index'])
        ->name('notifications.index');

    Route::post('/payments/checkout', [PaymentController::class, 'checkout'])
        ->name('payments.checkout');

    Route::post('/payments/{payment}/submit-proof', [PaymentController::class, 'submitProof'])
        ->name('payments.submit-proof');

    Route::post('/payments/{payment}/cancel', [PaymentController::class, 'cancel'])
        ->name('payments.cancel');

    Route::get('/subscription/renewal', [SubscriptionController::class, 'index'])
        ->name('subscription.renewal');

    Route::post('/subscription/renewal', [SubscriptionController::class, 'submit'])
        ->name('subscription.submit');

    Route::post('/subscription/cancel', [SubscriptionController::class, 'cancel'])
        ->name('subscription.cancel');

});
