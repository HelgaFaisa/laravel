# -*- coding: utf-8 -*-

import joblib  # Menggunakan joblib untuk memuat model .sav
import numpy as np
from flask import Flask, request, jsonify, render_template
from pymongo import MongoClient
import os

# Inisialisasi Flask
app = Flask(__name__)

# Load model yang sudah disimpan
try:
    model = joblib.load('diabetes_model.sav')  # Pastikan path ke model benar
    print("Model berhasil dimuat!")
except Exception as e:
    print(f"Gagal memuat model: {e}")
    model = None

# Koneksi ke MongoDB
try:
    client = MongoClient('mongodb://localhost:27017/')
    db = client['diabetes_db']
    collection = db['diabetes_predictions']
    print("Berhasil terhubung ke MongoDB!")
except Exception as e:
    print(f"Gagal terhubung ke MongoDB: {e}")
    client = None

# Route untuk halaman utama
@app.route('/')
def home():
    return render_template('index.html')

# Route untuk prediksi
@app.route('/predict', methods=['POST'])
def predict():
    if model is None:
        return render_template('index.html', prediction_text='Model tidak tersedia.')
    if client is None:
        return render_template('index.html', prediction_text='MongoDB tidak tersedia.')

    # Ambil data dari form
    features = [float(x) for x in request.form.values()]
    final_features = [np.array(features)]

    # Lakukan prediksi
    try:
        prediction = model.predict(final_features)
        output = prediction[0]
    except Exception as e:
        return render_template('index.html', prediction_text=f'Gagal melakukan prediksi: {e}')

    # Simpan hasil prediksi ke MongoDB
    try:
        prediction_data = {
            'input_data': features,
            'prediction_result': int(output)
        }
        collection.insert_one(prediction_data)
    except Exception as e:
        return render_template('index.html', prediction_text=f'Gagal menyimpan hasil prediksi ke MongoDB: {e}')

    # Tampilkan hasil prediksi
    if output == 1:
        return render_template('index.html', prediction_text='Menderita Diabetes')
    else:
        return render_template('index.html', prediction_text='Tidak Menderita Diabetes')

# Jalankan aplikasi Flask
if __name__ == '__main__':
    app.run(debug=True)