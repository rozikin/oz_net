const flashData = $('.flash-data').data('flashdata');

if (flashData) {
    swal({
        title: 'Data',
        text: 'Berhasil' + flashData,
        type: 'success'
    });
}

$('.tombol-hapus').on('click', function (e) {

    e.preventDefault();



});