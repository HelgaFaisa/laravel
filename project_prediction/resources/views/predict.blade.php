@extends('layouts.app')

@section('title', 'Prediksi Diabetes')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h5>Prediksi Diabetes</h5>
        </div>
        <div class="card-body">
            <form id="predictForm" class="mt-4">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Kehamilan</label>
                            <input type="number" class="form-control" name="kehamilan" min="0" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Glukosa</label>
                            <input type="number" class="form-control" step="any" name="glukosa" min="0" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tekanan Darah</label>
                            <input type="number" class="form-control" name="tekanan_darah" min="0" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Ketebalan Kulit</label>
                            <input type="number" class="form-control" name="ketebalan_kulit" min="0" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Insulin</label>
                            <input type="number" class="form-control" name="insulin" min="0" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">BMI</label>
                            <input type="number" class="form-control" step="any" name="bmi" min="0" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Riwayat Diabetes Keluarga</label>
                            <input type="number" class="form-control" step="any" name="riwayat_diabetes" min="0" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Usia</label>
                            <input type="number" class="form-control" name="usia" min="0" required>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Prediksi</button>
                </div>
            </form>
            <h3 class="text-center mt-4 text-success" id="predictionResult"></h3>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
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

                    // Kosongkan form setelah sukses
                    $('#predictForm')[0].reset();
                },
                error: function(error) {
                    console.error(error);
                    alert('Terjadi kesalahan saat melakukan prediksi.');
                }
            });
        });
    });
</script>
@endsection