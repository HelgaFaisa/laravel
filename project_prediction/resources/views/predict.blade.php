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
        <input type="text" name="input_data[]" required>
        <br>
        <label>Glukosa</label>
        <input type="text" name="input_data[]" required>
        <br>
        <label>Tekanan Darah</label>
        <input type="text" name="input_data[]" required>
        <br>
        <label>Ketebalan Kulit</label>
        <input type="text" name="input_data[]" required>
        <br>
        <label>Insulin</label>
        <input type="text" name="input_data[]" required>
        <br>
        <label>BMI</label>
        <input type="text" name="input_data[]" required>
        <br>
        <label>Riwayat Diabetes Keluarga</label>
        <input type="text" name="input_data[]" required>
        <br>
        <label>Usia</label>
        <input type="text" name="input_data[]" required>
        <br>
        <button type="submit">Prediksi</button>
    </form>

    <h2 id="predictionResult"></h2>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $('#predictForm').on('submit', function(e) {
            e.preventDefault();

            // Ambil data dari form
            const inputData = $(this).serializeArray().map(item => parseFloat(item.value));

            // Kirim data ke Laravel
            $.ajax({
                url: '/predict',
                method: 'POST',
                data: {
                    input_data: inputData
                },
                success: function(response) {
                    if (response.prediction == 1) {
                        $('#predictionResult').text('Pasien menderita diabetes.');
                    } else {
                        $('#predictionResult').text('Pasien tidak menderita diabetes.');
                    }
                },
                error: function(error) {
                    console.error(error);
                }
            });
        });
    </script>
</body>
</html>