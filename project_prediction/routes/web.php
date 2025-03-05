<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DiabetesController;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/predict', [DiabetesController::class, 'predict']);
Route::get('/predict', function () {
    return view('predict');
});
