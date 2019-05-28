<style type="text/css">
    input {
        border: none
    }

    /* other style definitions go here */
</style>

<!-- Begin Page Content -->


<div class="container-fluid">

    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">SM</div>

                            <label class="h5 mb-0 font-weight-bold text-gray-800" name="sm_status">


                        </div>
                        <div class="col-auto">
                            <i class="fas fa-tshirt fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">SFM</div>
                            <label class="h5 mb-0 font-weight-bold text-gray-800" name="sfm_status">
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-tshirt fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">FM</div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <label class="h5 mb-0 font-weight-bold text-gray-800" name="fm_status">
                                </div>

                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-tshirt fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Page Heading -->
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
                    <a href='<?= base_url('skatch/add_form') ?>' class="btn btn-primary btn-sm">Add</a>
                    <button class="btn btn-success btn-sm" onclick="reload_table()">Reload</button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table" class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Date_Created</th>
                                    <th>Buyer</th>
                                    <th>style</th>
                                    <th>qty</th>
                                    <th>cm</th>
                                    <th>dcd</th>
                                    <th>factory</th>
                                    <th>type</th>
                                    <th>T_PRS</th>
                                    <th>OP</th>
                                    <th>HP</th>
                                    <th>T_MP</th>
                                    <th>SMV</th>
                                    <th>loss</th>
                                    <th>T_SMV</th>
                                    <th>EFCY</th>
                                    <th>W.H</th>
                                    <th>targets</th>
                                    <th>Image</th>
                                    <th>Action_Program</th>

                                </tr>
                            </thead>

                        </table>
                    </div>
                </div>
            </div>
            </section>
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
        hitung_sm();
        hitung_sfm();
        hitung_fm();

        table = $('#table').DataTable({
            "ajax": {
                url: '<?php echo site_url('skatch/product_data') ?>',
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




    });

    function hitung_sm() {
        $.ajax({
            url: "<?php echo site_url('Skatch/get_sm') ?>/",
            type: "GET",
            dataType: "JSON",
            success: function(data) {


                $('[name="sm_status"]').text(data);

            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });

    }

    function hitung_sfm() {
        $.ajax({
            url: "<?php echo site_url('Skatch/get_sfm') ?>/",
            type: "GET",
            dataType: "JSON",
            success: function(data) {


                $('[name="sfm_status"]').text(data);

            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });

    }

    function hitung_fm() {
        $.ajax({
            url: "<?php echo site_url('Skatch/get_fm') ?>/",
            type: "GET",
            dataType: "JSON",
            success: function(data) {


                $('[name="fm_status"]').text(data);

            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });

    }



    function reload_table() {
        table.ajax.reload(null, false); //reload datatable ajax 
    }

    function edit(id) {
        var a = "<?php echo site_url('skatch/edit') ?>/" + id;
        window.location.assign(a);
    }


    function delete_data(id) {
        if (confirm('Are you sure delete this data?')) {
            // ajax delete data to database
            $.ajax({
                url: "<?php echo site_url('skatch/delete_datax') ?>/" + id,
                type: "POST",
                dataType: "JSON",
                success: function(data) {
                    //if success reload ajax table
                    $('#modal_form').modal('hide');
                    reload_table();
                    hitung_sm();
                    hitung_sfm();
                    hitung_fm();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error deleting data');
                }
            });

        }
    }
</script>