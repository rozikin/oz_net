<!-- Begin Page Content -->
<div class="container-fluid">



    <div class="row">

        <div class="col-lg">
            <?php if (validation_errors()) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors(); ?></div>
            <?php endif; ?>
            <?= $this->session->flashdata('message'); ?>



            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><?= $title; ?></h6>
                </div>
                <div class="card-header py-2">

                    <a href='<?= base_url('employee/add') ?>' class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Add</a>
                    <button class="btn btn-success btn-sm" onclick="reload_table()"><i class="fas fa-sync"></i> Reload</button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table" class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nik</th>
                                    <th>KTP</th>
                                    <th>Nama</th>
                                    <th>Department</th>
                                    <th>Bagian</th>
                                    <th>Jabatan</th>
                                    <th>jenis_kelamin</th>
                                    <th>tempat_lahir</th>
                                    <th>tgl_lahir</th>
                                    <th>Action</th>


                                </tr>
                            </thead>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>




</div>
<!-- /.container-fluid -->





<script type="text/javascript">
    var save_method; //for save method string
    var table;
    var base_url = '<?php echo base_url(); ?>';

    $(document).ready(function() {
        //call function show all product


        table = $('#table').DataTable({
            "ajax": {
                url: '<?php echo site_url('employee/product_data') ?>',
                type: 'POST'
            },

            //Set column definition initialisation properties.
            "columnDefs": [{
                    "targets": [-1], //last column
                    "orderable": false, //set not orderable
                },
                {
                    "targets": [-2], //2 last column (photo)
                    "orderable": false, //set not orderable
                },
            ],
        });


        //set input/textarea/select event when change value, remove class error and remove text help block 
        $("input").change(function() {
            $(this).parent().parent().removeClass('has-error');
            $(this).next().empty();
        });
        $("textarea").change(function() {
            $(this).parent().parent().removeClass('has-error');
            $(this).next().empty();
        });
        $("select").change(function() {
            $(this).parent().parent().removeClass('has-error');
            $(this).next().empty();
        });




    });




    function reload_table() {
        table.ajax.reload(null, false); //reload datatable ajax 
    }





    function delete_data(id) {
        if (confirm('Are you sure delete this data?')) {
            // ajax delete data to database
            $.ajax({
                url: "<?php echo site_url('employee/delete_datax') ?>/" + id,
                type: "POST",
                dataType: "JSON",
                success: function(data) {
                    //if success reload ajax table

                    reload_table();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error deleting data');
                }
            });

        }
    }

    function detail(id) {
        var b = "<?php echo site_url('employee/detail') ?>/" + id;
        window.location.assign(b);
    }


    function edit(id) {
        var a = "<?php echo site_url('employee/edit') ?>/" + id;
        window.location.assign(a);
    }




    function detail_data(id) {
        save_method = 'Detail';
        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string

        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('employee/detail_data') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {

                $('[name="id"]').text(data.id);
                $('[name="nik"]').text(data.nik);
                $('[name="ktp"]').text(data.ktp);

                $('[name="nama"]').text(data.nama);
                $('[name="alamat"]').text(data.alamat);

                $('[name="department"]').text(data.department);
                $('[name="bagian"]').text(data.bagian);
                $('[name="jabatan"]').text(data.jabatan);
                $('[name="jenis_kelamin"]').text(data.jenis_kelamin);

                $('[name="tempat_lahir"]').text(data.tempat_lahir);
                $('[name="tgl_lahir"]').text(data.tgl_lahir);
                $('[name="umur"]').text(data.umur);
                $('[name="size_baju"]').text(data.size_baju);
                $('[name="tgl_masuk"]').text(data.tgl_masuk);
                $('[name="tgl_habis_kontrak"]').text(data.tgl_habis_kontrak);

                $('[name="status"]').text(data.status);
                $('[name="tgl_penggajian"]').text(data.tgl_penggajian);
                $('[name="keterangan"]').text(data.keterangan);

                $('[name="no_telp"]').text(data.no_telp);

                $a = '<?php echo base_url('assets/img/employee/'); ?>';


                $('#image-detil').attr('src', $a + data.image);




                $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Detail'); // Set title to Bootstrap modal title $('#photo-preview').show(); // show photo preview modal



            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    }

    function get_image(id) {
        save_method = 'play';

        $a = '<?php echo base_url('assets/img/sni/'); ?>';

        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('employee/get_image') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {

                $b = data.video;
                $videoSrc = $a + $b;
                $('#xx').attr('src', $videoSrc);


                $('#play_videox').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Play Data'); // Set title to Bootstrap modal title $('#photo-preview').show(); // show photo preview modal


                // stop playing the youtube video when I close the modal
                $('#play_videox').on('hide.bs.modal', function(e) {
                    // a poor man's stop video
                    $("#xx").attr('src', '');
                })




            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    }
</script>




<!-- Modal -->
<div class="modal fade" id="modal_form" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>


            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="id" />

                    <div class="modal-body">




                        <div class="container">
                            <div class="row">
                                <div class="col-12 main-section text-center">
                                    <div class="row">
                                        <div class="col-lg-12 col-sm-12 col-12 profile-header"></div>
                                    </div>
                                    <div class="row user-detail">
                                        <div class="col-lg-12 col-lg-12 col-12">
                                            <img src="" class="rounded-circle img-thumbnail" id="image-detil" width="150px">
                                            <br>

                                            <label name="nama" class="h5 mb-0 font-weight-bold text-gray-800"></label>





                                            <p><i class="fa fa-map-marker-alt" aria-hidden="true"></i>
                                                <label name="alamat" class="h6 text-gray-800"></label></p>

                                        </div>
                                    </div>



                                    <hr>

                                    <div class="container text-left">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <table width="100%" style="font-size:15px">

                                                    <tr>
                                                        <td width=" 100" class="h7 mb-0 font-weight-bold text-gray-800">Nik</td>
                                                        <td width="10" class="h7 mb-0 font-weight-bold text-gray-800">:</td>
                                                        <td><label type="text" class="h7 mb-0 font-weight-bold text-gray-800" name="nik"></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="h7 mb-0 font-weight-bold text-gray-800">KTP</td>
                                                        <td class="h7 mb-0 font-weight-bold text-gray-800">:</td>
                                                        <td><label type="text" name="ktp" class="h7 mb-0 font-weight-bold text-gray-800"></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="h7 mb-0 font-weight-bold text-gray-800">Nama</td>
                                                        <td class="h7 mb-0 font-weight-bold text-gray-800">:</td>
                                                        <td class="h7 mb-0 font-weight-bold text-gray-800">
                                                            <label name="nama" class="h7 mb-0 font-weight-bold text-gray-800">
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td class="h7 mb-0 font-weight-bold text-gray-800">Department</td>
                                                        <td class="h7 mb-0 font-weight-bold text-gray-800">:</td>
                                                        <td>
                                                            <label name="department" class="h7 mb-0 font-weight-bold text-gray-800">
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td class="h7 mb-0 font-weight-bold text-gray-800">Bagian</td>
                                                        <td class="h7 mb-0 font-weight-bold text-gray-800">:</td>
                                                        <td>
                                                            <label name="bagian" class="h7 mb-0 font-weight-bold text-gray-800">
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td class="h7 mb-0 font-weight-bold text-gray-800">jabatan</td>
                                                        <td class="h7 mb-0 font-weight-bold text-gray-800">:</td>
                                                        <td>
                                                            <label name="jabatan" class="h7 mb-0 font-weight-bold text-gray-800">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="h7 mb-0 font-weight-bold text-gray-800">Jenis Kelamin</td>
                                                        <td class="h7 mb-0 font-weight-bold text-gray-800">:</td>
                                                        <td>
                                                            <label name="jenis_kelamin" class="h7 mb-0 font-weight-bold text-gray-800">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="h7 mb-0 font-weight-bold text-gray-800">Tempat Lahir</td>
                                                        <td class="h7 mb-0 font-weight-bold text-gray-800">:</td>
                                                        <td>
                                                            <label name="tempat_lahir" class="h7 mb-0 font-weight-bold text-gray-800">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="h7 mb-0 font-weight-bold text-gray-800">Tgl Lahir</td>
                                                        <td class="h7 mb-0 font-weight-bold text-gray-800">:</td>
                                                        <td>
                                                            <label name="tgl_lahir" class="h7 mb-0 font-weight-bold text-gray-800">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="h7 mb-0 font-weight-bold text-gray-800">Umur</td>
                                                        <td class="h7 mb-0 font-weight-bold text-gray-800">:</td>
                                                        <td>
                                                            <label name="umur" class="h7 mb-0 font-weight-bold text-gray-800">
                                                        </td>
                                                    </tr>


                                                </table>
                                            </div>


                                            <div class="row">

                                                <div class="container text-left">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <table width="300%" style="font-size:15px">

                                                                <tr>
                                                                    <td class="h7 mb-0 font-weight-bold text-gray-800">Size Baju</td>
                                                                    <td class="h7 mb-0 font-weight-bold text-gray-800">:</td>
                                                                    <td>
                                                                        <label name="size_baju" class="h7 mb-0 font-weight-bold text-gray-800">
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="h7 mb-0 font-weight-bold text-gray-800">Tgl Masuk</td>
                                                                    <td class="h7 mb-0 font-weight-bold text-gray-800">:</td>
                                                                    <td>
                                                                        <label name="tgl_masuk" class="h7 mb-0 font-weight-bold text-gray-800">
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="h7 mb-0 font-weight-bold text-gray-800">Tgl Habis Kontrak</td>
                                                                    <td class="h7 mb-0 font-weight-bold text-gray-800">:</td>
                                                                    <td>
                                                                        <label name="tgl_habis_kontrak" class="h7 mb-0 font-weight-bold text-gray-800">
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="h7 mb-0 font-weight-bold text-gray-800">Status</td>
                                                                    <td class="h7 mb-0 font-weight-bold text-gray-800">:</td>
                                                                    <td>
                                                                        <label name="status" class="h7 mb-0 font-weight-bold text-gray-800">
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="h7 mb-0 font-weight-bold text-gray-800">Tgl Penggajian</td>
                                                                    <td class="h7 mb-0 font-weight-bold text-gray-800">:</td>
                                                                    <td>
                                                                        <label name="tgl_penggajian" class="h7 mb-0 font-weight-bold text-gray-800">
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="h7 mb-0 font-weight-bold text-gray-800">Keterangan</td>
                                                                    <td class="h7 mb-0 font-weight-bold text-gray-800">:</td>
                                                                    <td>
                                                                        <label name="keterangan" class="h7 mb-0 font-weight-bold text-gray-800">
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="h7 mb-0 font-weight-bold text-gray-800">No. Telp</td>
                                                                    <td class="h7 mb-0 font-weight-bold text-gray-800">:</td>
                                                                    <td>
                                                                        <label name="no_telp" class="h7 mb-0 font-weight-bold text-gray-800">
                                                                    </td>
                                                                </tr>


                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="row user-social-detail">
                                        <div class="col-lg-12 col-sm-12 col-12">
                                            <a href="#"><i class="fab fa-facebook-f" aria-hidden="true"></i></a>
                                            <a href="#"><i class="fab fa-google-plus" aria-hidden="true"></i></a>
                                            <a href="#"><i class="fab fa-twitter" aria-hidden="true"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>





                    </div>
                    <div class="modal-footer">

                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fas fa-window-close"></i> Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>