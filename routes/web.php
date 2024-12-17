<?php

use Illuminate\Support\Facades\Route;

Route::get('/{any}', function () {
    return view('home'); // 'welcome' is your Vue app's blade file
})->where('any', '.*');