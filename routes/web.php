
<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');

Route::view('/gallery', 'gallery')->name('gallery');

Route::view('/services', 'services.index')->name('services.index');
