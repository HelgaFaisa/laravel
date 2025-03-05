<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class PredictDiabetes extends Eloquent
{
    use HasFactory;

    protected $connection = 'mongodb'; // Gunakan koneksi MongoDB
    protected $collection = 'diabetes_predictions'; // Nama koleksi di MongoDB

    protected $fillable = [
        'input_data', // Data input pasien (array angka)
        'prediction_result' // Hasil prediksi (1 = diabetes, 0 = tidak diabetes)
    ];
}
