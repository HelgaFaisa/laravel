from flask import Flask, request, jsonify
import numpy as np
import joblib
from pymongo import MongoClient
from flask_cors import CORS  # Tambahkan CORS

app = Flask(__name__)
CORS(app)  # Aktifkan CORS untuk semua rute

# Load model
try:
    model = joblib.load('diabetes_model.sav')
    print("Model berhasil dimuat!")
except Exception as e:
    print(f"Gagal memuat model: {e}")
    model = None

# Koneksi MongoDB
try:
    client = MongoClient('mongodb://localhost:27017/')
    db = client['diabetes_db']
    collection = db['diabetes_predictions']
    print("Berhasil terhubung ke MongoDB!")
except Exception as e:
    print(f"Gagal terhubung ke MongoDB: {e}")
    client = None

@app.route('/predict', methods=['POST'])
def predict():
    if model is None:
        return jsonify({'error': 'Model tidak tersedia'}), 500
    if client is None:
        return jsonify({'error': 'MongoDB tidak tersedia'}), 500

    try:
        # Ambil data dari request JSON
        data = request.json
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
        final_features = [np.array(features)]
        
        # Prediksi
        prediction = model.predict(final_features)
        output = int(prediction[0])

        # Simpan ke MongoDB
        prediction_data = {
            'input_data': features,
            'prediction_result': output
        }
        collection.insert_one(prediction_data)

        # Kirim response
        return jsonify({'prediction': output})
    
    except Exception as e:
        return jsonify({'error': f'Gagal melakukan prediksi: {str(e)}'}), 500

if __name__ == '__main__':
    app.run(debug=True)
