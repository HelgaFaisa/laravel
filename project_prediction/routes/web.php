<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PredictDiabetesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

Route::get('/', function () {
    return view('welcome');
});

// Menampilkan halaman prediksi
Route::get('/predict', function () {
    return view('predict');
});

// Simpan hasil prediksi
Route::post('/predict/store', [PredictDiabetesController::class, 'store']);

// Ambil semua prediksi
Route::get('/predict/all', [PredictDiabetesController::class, 'index']);

// Proxy Laravel ke Flask API
Route::post('/api/diabetes/predict', function (Request $request) {
    $flask_url = 'http://127.0.0.1:5000/predict';
    $response = Http::post($flask_url, $request->all());
    
    if ($response->successful()) {
        return response()->json($response->json());
    }
    
    return response()->json(['error' => 'Gagal menghubungi Flask API'], 500);
});
