const flashData = $('.flash-data').data('flashdata');

if (flashData) {
    Swal({
        title: 'Data',
        text: 'Berhasil' + flashData,
        type: 'success'
    });
}