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

                    <a href='<?= base_url('out/add_form') ?>' class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Add</a>
                    <button class="btn btn-success btn-sm" onclick="reload_table()"><i class="fas fa-sync"></i></button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table" class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Sale no</th>
                                    <th>Tanggal</th>

                                    <th>nama_barang</th>

                                    <th>Nama</th>

                                    <th>jumlah</th>
                                    <th>total</th>
                                    <th>status</th>
                                    <th>kasir</th>

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
<!-- /.container-fluid -->





<script type="text/javascript">
    var save_method; //for save method string
    var table;
    var base_url = '<?php echo base_url(); ?>';

    $(document).ready(function() {
        //call function show all product


        table = $('#table').DataTable({
            "ajax": {
                url: '<?php echo site_url('out/product_data') ?>',
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
                url: "<?php echo site_url('out/delete_datax') ?>/" + id,
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


    function edit(id) {
        var a = "<?php echo site_url('out/edit') ?>/" + id;
        window.location.assign(a);
    }



    function edit_data(id) {

        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string

        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('out/edit_data') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {

                $('[name="id"]').val(data.id);
                $('[name="kode"]').val(data.kode_in);

                $('[name="nama"]').val(data.kode_barang);
                $('[name="merk"]').val(data.kode_supplier);
                $('[name="warna"]').val(data.jumlah);

                $('[name="keterangan"]').val(data.keterangan);



                $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit Data'); // Set title to Bootstrap modal title $('#photo-preview').show(); // show photo preview modal



            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    }
</script>





<!-- Modal -->
<div class="modal fade" id="modal_form" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
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
                        <div class="row">
                            <div class="col lg-6">
                                <div class="form-group">
                                    <label for="kode">Kode</label>
                                    <input type="text" class="form-control form-control-sm" id="kode" name="kode" readonly>
                                </div>
                            </div>
                            <div class="col lg-6">
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" class="form-control form-control-sm" id="nama" name="nama" required>
                                </div>

                            </div>
                        </div>


                        <div class="col lg-6">
                            <div class="form-group">
                                <label for="merk">merk</label>
                                <input type="text" class="form-control form-control-sm" id="merk" name="merk" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col lg-6">
                            <div class="form-group">
                                <label for="warna">warna</label>
                                <input type="text" class="form-control form-control-sm" id="warna" name="warna" required>
                            </div>
                        </div>

                    </div>

                    <div class="form-group">
                        <label for="keterangan">keterangan</label>
                        <input type="text" class="form-control form-control-sm" id="keterangan" name="keterangan" required>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> Save</button>
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fas fa-window-close"></i> Cancel</button>
            </div>
            </form>
        </div>
    </div>
</div>
</div>