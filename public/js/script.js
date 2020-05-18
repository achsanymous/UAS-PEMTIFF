$(function () {

    $('.tombolTambahData').on('click', function () {
        // Ubah judul form
        $('#judulModal').html('Tambah Data Bantuan');
        // Ubah teks button
        $('.modal-footer button[type=submit]').html('Tambah Data');

        // Ubah action form
        $('.modal form').attr('action', 'http://localhost/easrindi/public/bantu/add');

        // Kosongkan isi teks
        $('#nama').val("");
        $('#nama_bantuan').val("");
        $('#jumlah_bantuan').val("");
        // $('#time').val("");
        // $('#id').val("");
    });

});