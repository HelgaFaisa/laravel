<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PredictDiabetes;

class PredictDiabetesController extends Controller
{
    // Simpan hasil prediksi ke MongoDB
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'input_data' => 'required|array',
            'prediction_result' => 'required|integer'
        ]);

        // Simpan ke database
        $prediction = PredictDiabetes::create([
            'input_data' => $request->input('input_data'),
            'prediction_result' => $request->input('prediction_result')
        ]);

        return response()->json([
            'message' => 'Hasil prediksi berhasil disimpan.',
            'data' => $prediction
        ]);
    }

    // Ambil semua hasil prediksi
    public function index()
    {
        $predictions = PredictDiabetes::all();
        return response()->json($predictions);
    }
}
