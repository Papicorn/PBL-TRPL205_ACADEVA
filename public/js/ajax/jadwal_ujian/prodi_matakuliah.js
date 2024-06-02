$(document).ready(function() {
    $("#kode_prodi").change(function() {
        var kode_prodi = $(this).val();

        var data = {
            kode_prodi: kode_prodi
        };

        $.ajax({
            url: '/ajax/ambil-matkul-prodi', // Ubah sesuai dengan rute yang benar
            data: data,
            type: 'POST',
            dataType: 'json',
            success: function(response) {
                // Mengaktifkan elemen select
                $("#kode_matkul").prop("disabled", false);
                $("#kode_matkul").empty().append('<option value="" selected disabled>-- Pilih -- </option>');
                $.each(response.options, function(index, value) {
                    $("#kode_matkul").append('<option value="' + value.kode_matkul + '">' + value.nama_matkul + ' (' + value.kode_matkul + ')</option>');
                });
            },
            error: function(xhr, status, error) {
                console.error('Error: ' + error);
            }
        });
    });
    function fetchData(kode_prodi, id_jadwal) {
        $.ajax({
            url: '/ajax/ambil-matkul-prodi', // Ubah sesuai dengan rute yang benar
            type: 'POST',
            data: {
                kode_prodi: kode_prodi
            },
            dataType: 'json',
            success: function(response) {
                var matkulSelect = $("#kode_matkul" + id_jadwal);
                var hiddenSelect = $("#hidden_kode_matkul" + id_jadwal);
                matkulSelect.prop("disabled", false);
                matkulSelect.empty().append('<option value="" selected disabled>-- Pilih --</option>');

                $.each(response.options, function(index, value) {
                    matkulSelect.append('<option value="' + value.kode_matkul + '">' + value.nama_matkul + ' (' + value.kode_matkul + ')</option>');
                });
                hiddenSelect.prop("disabled", true);
            },
            error: function(xhr, status, error) {
                console.error('Error: ' + error);
            }
        });
    }

    $("select[id='kode_prodi1']").change(function() {
        var kode_prodi = $(this).val();
        var id_jadwal = $(this).data("id_jadwal");

        fetchData(kode_prodi, id_jadwal);
    });
});