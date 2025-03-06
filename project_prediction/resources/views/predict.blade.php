<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prediksi Diabetes</title>
</head>
<body>
    <h1>Prediksi Diabetes</h1>
    <form id="predictForm">
        <label>Kehamilan</label>
        <input type="number" name="kehamilan" min="0" required>
        <br>
        <label>Glukosa</label>
        <input type="number" step="any" name="glukosa" min="0" required>
        <br>
        <label>Tekanan Darah</label>
        <input type="number" name="tekanan_darah" min="0" required>
        <br>
        <label>Ketebalan Kulit</label>
        <input type="number" name="ketebalan_kulit" min="0" required>
        <br>
        <label>Insulin</label>
        <input type="number" name="insulin" min="0" required>
        <br>
        <label>BMI</label>
        <input type="number" step="any" name="bmi" min="0" required>
        <br>
        <label>Riwayat Diabetes Keluarga</label>
        <input type="number" step="any" name="riwayat_diabetes" min="0" required>
        <br>
        <label>Usia</label>
        <input type="number" name="usia" min="0" required>
        <br>
        <button type="submit">Prediksi</button>
    </form>

    <h2 id="predictionResult"></h2>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $('#predictForm').on('submit', function(e) {
            e.preventDefault();

            // Ambil data dari form
            let inputData = {
                kehamilan: parseFloat($('input[name="kehamilan"]').val()) || 0,
                glukosa: parseFloat($('input[name="glukosa"]').val()) || 0,
                tekanan_darah: parseFloat($('input[name="tekanan_darah"]').val()) || 0,
                ketebalan_kulit: parseFloat($('input[name="ketebalan_kulit"]').val()) || 0,
                insulin: parseFloat($('input[name="insulin"]').val()) || 0,
                bmi: parseFloat($('input[name="bmi"]').val()) || 0,
                riwayat_diabetes: parseFloat($('input[name="riwayat_diabetes"]').val()) || 0,
                usia: parseFloat($('input[name="usia"]').val()) || 0,
            };

            // Validasi data sebelum dikirim
            if (Object.values(inputData).some(value => isNaN(value) || value < 0)) {
                alert("Harap isi semua data dengan angka yang valid.");
                return;
            }

            // Kirim data ke API Flask
            $.ajax({
                url: 'http://127.0.0.1:5000/predict', // Ubah sesuai dengan API Flask
                method: 'POST',
                contentType: 'application/json',
                data: JSON.stringify(inputData),
                success: function(response) {
                    if (response.prediction == 1) {
                        $('#predictionResult').text('Pasien menderita diabetes.');
                    } else {
                        $('#predictionResult').text('Pasien tidak menderita diabetes.');
                    }
                },
                error: function(error) {
                    console.error(error);
                    alert('Terjadi kesalahan saat melakukan prediksi.');
                }
            });
        });
    </script>
</body>
</html>
