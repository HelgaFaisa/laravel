<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DiabetesController extends Controller
{
    public function predict(Request $request)
    {
        // Validasi input
        $request->validate([
            'input_data' => 'required|array',
        ]);

        // Kirim data ke Flask
        $response = Http::post('http://127.0.0.1:5000/api/predict', [
            'input_data' => $request->input_data,
        ]);

        // Kembalikan respons
        return response()->json($response->json());
    }
}