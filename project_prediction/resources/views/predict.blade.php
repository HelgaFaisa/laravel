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
        <input type="number" name="kehamilan" required>
        <br>
        <label>Glukosa</label>
        <input type="number" name="glukosa" required>
        <br>
        <label>Tekanan Darah</label>
        <input type="number" name="tekanan_darah" required>
        <br>
        <label>Ketebalan Kulit</label>
        <input type="number" name="ketebalan_kulit" required>
        <br>
        <label>Insulin</label>
        <input type="number" name="insulin" required>
        <br>
        <label>BMI</label>
        <input type="number" step="0.1" name="bmi" required>
        <br>
        <label>Riwayat Diabetes Keluarga</label>
        <input type="number" step="0.01" name="riwayat_diabetes" required>
        <br>
        <label>Usia</label>
        <input type="number" name="usia" required>
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
                kehamilan: parseFloat($('input[name="kehamilan"]').val()),
                glukosa: parseFloat($('input[name="glukosa"]').val()),
                tekanan_darah: parseFloat($('input[name="tekanan_darah"]').val()),
                ketebalan_kulit: parseFloat($('input[name="ketebalan_kulit"]').val()),
                insulin: parseFloat($('input[name="insulin"]').val()),
                bmi: parseFloat($('input[name="bmi"]').val()),
                riwayat_diabetes: parseFloat($('input[name="riwayat_diabetes"]').val()),
                usia: parseFloat($('input[name="usia"]').val()),
            };

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
