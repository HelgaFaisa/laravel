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

// Layouts
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/manajemen-user/admin', function () {
    return view('admin.index');
})->name('admin.index');

Route::get('/manajemen-user/pengguna', function () {
    return view('pengguna.index');
})->name('pengguna.index');

// Menampilkan halaman prediksi
Route::get('/predict', function () {
    return view('predict');
})->name('predict.index'); // Tambahkan nama route di sini
