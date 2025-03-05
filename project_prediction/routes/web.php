<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DiabetesController;
use App\Http\Controllers\PredictDiabetesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/predict', [DiabetesController::class, 'predict']);
Route::get('/predict', function () {
    return view('predict');
});

Route::post('/predict/store', [PredictDiabetesController::class, 'store']); // Simpan hasil prediksi
Route::get('/predict/all', [PredictDiabetesController::class, 'index']); // Ambil semua prediksi

Route::post('/predict', function (Request $request) {
    $response = Http::post('http://127.0.0.1:5000/predict', $request->all());
    return $response->json();
});

