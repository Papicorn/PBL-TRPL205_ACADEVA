$(document).ready(function() {
    $("#kode_prodi").change(function() {
        var kode_prodi = $(this).val();

        var data = {
            kode_prodi: kode_prodi
        };

        $.ajax({
            url: '/ajax/ambil-kelas-prodi', // Ubah sesuai dengan rute yang benar
            data: data,
            type: 'POST',
            dataType: 'json',
            success: function(response) {
                $("#id_kelas").prop("disabled", false);
                $("#id_kelas").empty().append('<option value="" selected disabled>-- Pilih -- </option>');
                $.each(response.options, function(index, value) {
                    $("#id_kelas").append('<option value="' + value.id_kelas + '">' + value.nama_kelas + '</option>');
                });
            },
            error: function(xhr, status, error) {
                console.error('Error: ' + error);
            }
        });
    });
});