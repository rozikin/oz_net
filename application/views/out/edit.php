<style>
    th {
        font-size: 13px;
    }

    td {
        font-size: 12px;
    }

    #jumlah {
        font-size: 20px;
    }
</style>



<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
   

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?= $title; ?></h6>
        </div>

        <div class="card-body">


            <div class="row">
                <div class="col-lg-12">
             

                    <form action="<?= base_url('out/edit'); ?>" method="post" id="form_material">
                        <div class="form-row">
                        <input type="hidden" class="form-control" id="id" name="id" value='<?= $in['id']; ?>'>

                            <div class="col-md-3 mb-1">
                                <label for="kode_out">kode out</label>
                                <input type="text" class="form-control form-control-sm" id="kode_out" name="kode_out" value="<?= $in['kode_out']; ?>" placeholder="" required readonly>
                            </div>

                            <div class="col-md-3 mb-1">
                                <label for="dates">Date</label>
                                <input type="text" id="dp1" class="form-control form-control-sm" name="dates" value="<?= $in['tanggal']; ?>" required>
                            </div>



                            <div class="col-md-3 mb-1">
                                <label for="keterangan">Keterangan</label>
                                <input type="text" class="form-control  form-control-sm" id="keterangan" name="keterangan" value="<?= $in['keterangan']; ?>" required>

                            </div>




                            <div class="col-lg-12">
                                <hr>
                            </div>


                        </div>
                        <div class="row">


                            <div class="col-md-4">
                                <label for="kode_barang">Kode Barang</label>
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-sm tb-f" name="kode_barang" id="kode_barang" value="<?= $in['kode_barang']; ?>">
                                    <div class="input-group-append">
                                        <button class="btn btn-secondary btn-sm" type="button" onclick="cari_data()">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                                <br>


                                <input type="text" class="form-control  form-control-sm tb-f" id="nama_barang" name="nama_barang" value="<?= $in['nama_barang']; ?>" readonly>

                            </div>



                            <div class="col-md-4">
                                <label for="nik">Nik Employee</label>
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-sm tb-f" name="nik" id="nik" value="<?= $in['nik']; ?>">
                                    <div class="input-group-append">
                                        <button class="btn btn-secondary btn-sm" type="button" onclick="cari_datas()">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                                <br>

                                <input type="text" class="form-control  form-control-sm tb-f" id="nama_supplier" name="nama_supplier" value="<?= $in['nama']; ?>" readonly>

                            </div>


                            <div class="col-md-2">
                                <label for="jumlah">Jumlah</label>
                                <input type="number" name="jumlah" id="jumlah" class="form-control form-control-sm tb-f" min="1" max="999999" rows="10" value="<?= $in['jumlah']; ?>">

        
                            </div>
                        </div>

                        <input type="hidden" name="row_id" id="hidden_row_id" />
                        <input type="hidden" class="form-control  form-control-sm" id="tabels" name="tabels">
                        
                  


                        <div class="col-lg-12">
                            <hr>
                        </div>
                        <hr>
                        


                      
                        <div class="col-lg-12">
                            <hr>
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm save" id="save">Save</button>
                        <a href="<?= base_url('out'); ?>" class="btn btn-danger btn-sm">Back</a>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->





<script type="text/javascript">
    var save_method; //for save method string
    var table;
    var base_url = '<?php echo base_url(); ?>';


    $(document).ready(function() {
        $('#tablex').DataTable();
        responsive: true




    });

    $(document).ready(function() {
        $('#tables').DataTable();
        responsive: true
    });


   
    function cari_data() {
        $('#modal_form').modal('show'); // show bootstrap modal
        $('.modal-title').text('Search data'); // Set Title to Bootstrap modal title
    }

    function cari_datas() {
        $('#modal_forms').modal('show'); // show bootstrap modal
        $('.modal-title').text('Search data'); // Set Title to Bootstrap modal title
    }
    //            jika dipilih, nim akan masuk ke input dan modal di tutup
    $(document).on('click', '.pilih', function(e) {

        document.getElementById("kode_barang").value = $(this).attr('data-kode');
        document.getElementById("nama_barang").value = $(this).attr('data-nama');


        $('#modal_form').modal('hide');
    });



    $(document).on('click', '.pilihs', function(e) {
        document.getElementById("nik").value = $(this).attr('data-kode');

        document.getElementById("nama_supplier").value = $(this).attr('data-nama');

        $('#modal_forms').modal('hide');
    });


    $('#dp1').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true,
        todayHighlight: true,
        orientation: "top auto",
        todayBtn: true,


    });


    function reload_table() {
        table.ajax.reload(null, false); //reload datatable ajax 
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
                    <div class="table-responsive">
                        <table id="tablex" class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode</th>
                                    <th>Nama</th>
                                    <th>Jenis</th>
                                    <th>Merk</th>
                                    <th>warna</th>
                                    <th>Satuan</th>
                                    <th>Keterangan</th>

                                </tr>
                            </thead>

                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($items as $sm) : ?>
                                    <tr class="pilih" data-kode="<?= $sm['kode_barang'] ?>" data-nama="<?= $sm['nama_barang'] ?>">
                                        <th scope="row"><?= $i; ?></th>
                                        <td><?= $sm['kode_barang']; ?></td>
                                        <td><?= $sm['nama_barang']; ?></td>
                                        <td><?= $sm['jenis']; ?></td>
                                        <td><?= $sm['merk']; ?></td>
                                        <td><?= $sm['warna']; ?></td>
                                        <td><?= $sm['satuan']; ?></td>
                                        <td><?= $sm['stok']; ?></td>

                                    </tr>
                                    <?php $i++; ?>
                                <?php endforeach; ?>

                            </tbody>

                        </table>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>










<!-- Modal -->
<div class="modal fade" id="modal_forms" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>


            <div class="modal-body forms">
                <form action="#" id="form" class="form-horizontal">
                    <div class="table-responsive">
                    <table id="tables" class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nik</th>
                                    <th>Nama</th>
                                    <th>Deparment</th>
                                    <th>Bagian</th>
                                    <th>Jenis Kelamin</th>


                                </tr>
                            </thead>

                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($employee as $sm) : ?>
                                    <tr class="pilihs" data-kode="<?= $sm['nik'] ?>" data-nama="<?= $sm['nama'] ?>">
                                        <th scope="row"><?= $i; ?></th>
                                        <td><?= $sm['nik']; ?></td>
                                        <td><?= $sm['nama']; ?></td>
                                        <td><?= $sm['department']; ?></td>
                                        <td><?= $sm['bagian']; ?></td>
                                        <td><?= $sm['jenis_kelamin']; ?></td>


                                    </tr>
                                    <?php $i++; ?>
                                <?php endforeach; ?>

                            </tbody>

                        </table>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>