from flask import Flask, request, jsonify, render_template
import numpy as np
import joblib
from pymongo import MongoClient
from flask_cors import CORS

app = Flask(__name__)
CORS(app)

# Load model and scaler
try:
    model = joblib.load('diabetes_best_model.sav')  # Gunakan model terbaik
    scaler = joblib.load('diabetes_scaler.sav')  # Gunakan scaler yang sesuai
    print("Model dan scaler berhasil dimuat!")
except Exception as e:
    print(f"Gagal memuat model atau scaler: {e}")
    model = None
    scaler = None

# Koneksi MongoDB
try:
    client = MongoClient('mongodb://localhost:27017/')
    db = client['diabetes_db']
    collection = db['diabetes_predictions']
    print("Berhasil terhubung ke MongoDB!")
except Exception as e:
    print(f"Gagal terhubung ke MongoDB: {e}")
    client = None

@app.route('/')
def home():
    # Render halaman HTML utama
    return render_template('index.html')

@app.route('/predict', methods=['GET', 'POST'])
def predict():
    if model is None or scaler is None:
        return jsonify({'error': 'Model atau scaler tidak tersedia'}), 500
    if client is None:
        return jsonify({'error': 'MongoDB tidak tersedia'}), 500

    try:
        # Ambil data dari request JSON (untuk API) atau form (untuk HTML)
        if request.method == 'POST':
            if request.is_json:
                data = request.json  # Ambil data dari JSON
            else:
                data = request.form  # Ambil data dari form HTML
        else:
            data = request.args  # Ambil data dari query parameters (untuk GET)

        # Validasi data
        features = [
            float(data.get('kehamilan', 0)), 
            float(data.get('glukosa', 0)), 
            float(data.get('tekanan_darah', 0)), 
            float(data.get('ketebalan_kulit', 0)), 
            float(data.get('insulin', 0)), 
            float(data.get('bmi', 0)), 
            float(data.get('riwayat_diabetes', 0)), 
            float(data.get('usia', 0))
        ]

        # Log data sebelum normalisasi
        print("Data sebelum normalisasi:", features)

        # Normalisasi data input menggunakan scaler
        final_features = np.array(features).reshape(1, -1)
        final_features = scaler.transform(final_features)

        # Log data setelah normalisasi
        print("Data setelah normalisasi:", final_features)
        
        # Prediksi
        prediction = model.predict(final_features)
        output = int(prediction[0])

        # Simpan ke MongoDB
        prediction_data = {
            'input_data': features,
            'prediction_result': output
        }

        # Log data yang disimpan ke MongoDB
        print("Data yang disimpan ke MongoDB:", prediction_data)
        collection.insert_one(prediction_data)

        # Kirim response
        if request.method == 'POST':
            return jsonify({'prediction': output})
        else:
            # Jika method GET, render hasil prediksi di halaman HTML
            return render_template('index.html', prediction_text=f'Hasil Prediksi: {output}')
    
    except Exception as e:
        return jsonify({'error': f'Gagal melakukan prediksi: {str(e)}'}), 500

if __name__ == '__main__':
    app.run(debug=True)