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
    function fetchData(kode_prodi, id_jadwal) {
        $.ajax({
            url: '/ajax/ambil-kelas-prodi', // Ubah sesuai dengan rute yang benar
            type: 'POST',
            data: {
                kode_prodi: kode_prodi
            },
            dataType: 'json',
            success: function(response) {
                console.log(response);
                var kelasSelect = $("#id_kelas" + id_jadwal);
                var hiddenSelect = $("#hidden_id_kelas" + id_jadwal);
                kelasSelect.prop("disabled", false);
                kelasSelect.empty().append('<option value="" selected disabled>-- Pilih --</option>');

                $.each(response.options, function(index, value) {
                    kelasSelect.append('<option value="' + value.id_kelas + '">' + value.nama_kelas + '</option>');
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