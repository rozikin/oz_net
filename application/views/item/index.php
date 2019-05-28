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

                    <button class="btn btn-primary btn-sm" onclick="add_data()"><i class="fas fa-plus"></i> Add</button>
                    <button class="btn btn-success btn-sm" onclick="reload_table()"><i class="fas fa-sync"></i></button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table" class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode</th>
                                    <th>Nama Barang</th>
                                    <th>Jenis</th>
                                    <th>Merk</th>
                                    <th>Warna</th>
                                    <th>Satuan</th>
                                    <th>Harga</th>
                                    <th>Total</th>
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
                url: '<?php echo site_url('item/product_data') ?>',
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

    function kd_otomatis() {
        $.ajax({
            url: "<?php echo site_url('item/kode_otomatis') ?>/",
            type: "GET",
            dataType: "JSON",
            success: function(data) {

                $('[name="kode"]').val(data);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });

    }



    function add_data() {
        save_method = 'add';
        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
        $('#modal_form').modal('show'); // show bootstrap modal
        $('.modal-title').text('Add Data'); // Set Title to Bootstrap modal title
        kd_otomatis();
    }


    function edit_data(id) {
        save_method = 'update';
        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string

        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('item/edit_data') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {

                $('[name="id"]').val(data.id);
                $('[name="kode"]').val(data.kode_barang);
                $('[name="nama"]').val(data.nama_barang);
                $('[name="jenis"]').val(data.jenis);
                $('[name="merk"]').val(data.merk);
                $('[name="warna"]').val(data.warna);
                $('[name="satuan"]').val(data.satuan);
                $('[name="keterangan"]').val(data.keterangan);



                $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit Data'); // Set title to Bootstrap modal title $('#photo-preview').show(); // show photo preview modal



            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    }


    function reload_table() {
        table.ajax.reload(null, false); //reload datatable ajax 
    }




    function save() {
        $('#btnSave').text('saving...'); //change button text
        $('#btnSave').attr('disabled', true); //set button disable 
        var url;

        if (save_method == 'add') {
            url = "<?php echo site_url('item/add_data') ?>";
        } else {
            url = "<?php echo site_url('item/update_data') ?>";
        }

        // ajax adding data to database

        var formData = new FormData($('#form')[0]);
        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success: function(data) {

                if (data.status) //if success close modal and reload ajax table
                {
                    $('#modal_form').modal('hide');
                    reload_table();
                } else {
                    for (var i = 0; i < data.inputerror.length; i++) {
                        $('[name="' + data.inputerror[i] + '"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                        $('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]); //select span help-block class set text error string
                    }
                }
                $('#btnSave').text('save'); //change button text
                $('#btnSave').attr('disabled', false); //set button enable 


            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error adding / update data');
                $('#btnSave').text('save'); //change button text
                $('#btnSave').attr('disabled', false); //set button enable 

            }
        });
    }

    function delete_data(id) {
        if (confirm('Are you sure delete this data?')) {
            // ajax delete data to database
            $.ajax({
                url: "<?php echo site_url('item/delete_datax') ?>/" + id,
                type: "POST",
                dataType: "JSON",
                success: function(data) {
                    //if success reload ajax table
                    $('#modal_form').modal('hide');
                    reload_table();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error deleting data');
                }
            });

        }
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

                        <div class="row">
                            <div class="col lg-6">
                                <label class="label-sm" for="buyer">Jenis</label>


                                <select class="custom-select custom-select-sm" name="jenis">
                                    <?php foreach ($jenis as $x) : ?>
                                        <option value="<?= $x ?>"><?= $x ?></option>
                                    <?php endforeach; ?>
                                </select>
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
                            <div class="col lg-6">
                                <div class="form-group">
                                    <label for="satuan">satuan</label>

                                    <select class="custom-select custom-select-sm" name="satuan">
                                        <?php foreach ($satuans as $x) : ?>
                                            <option value="<?= $x ?>"><?= $x ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col lg-6">
                                <div class="form-group">
                                    <label for="harga">harga</label>
                                    <input type="number" class="form-control form-control-sm" id="harga" name="harga" required>
                                </div>
                            </div>
                            <div class="col lg-6">

                                <div class="form-group">
                                    <label for="keterangan">keterangan</label>
                                    <input type="text" class="form-control form-control-sm" id="keterangan" name="keterangan" required>
                                </div>
                            </div>
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