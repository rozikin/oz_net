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
             
            <button class="btn btn-primary btn-sm" onclick="add_data()"><i class="glyphicon glyphicon-plus"></i> Add Data</button>
            <button class="btn btn-success btn-sm" onclick="reload_table()">Reload</button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                <table id="table" class="table table-hover">
                    <thead>
                        <tr>
                            <th scope=" col">No</th>
                            <th scope="col">Nrp</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Email</th>
                            <th scope="col">Jurusan</th>
                            <th scope="col">Gambar</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>

                </table>
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
                url: '<?php echo site_url('ajax/product_data') ?>',
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

    function add_data() {
        save_method = 'add';
        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
        $('#modal_form').modal('show'); // show bootstrap modal
        $('.modal-title').text('Add Data'); // Set Title to Bootstrap modal title

        $('#photo-preview').hide(); // hide photo preview modal

        $('#label-photo').text('Upload Photo'); // label photo upload
    }


    function edit_data(id) {
        save_method = 'update';
        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string

        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('sni/edit_mhs') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {

                $('[name="id"]').val(data.id);
                $('[name="nrp"]').val(data.nrp);
                $('[name="nama"]').val(data.nama);
                $('[name="email"]').val(data.email);
                $('[name="jurusan"]').val(data.jurusan);


                $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit Data'); // Set title to Bootstrap modal title $('#photo-preview').show(); // show photo preview modal


                if (data.image) {
                    $('#label-photo').text('Change Photo'); // label photo upload
                    $('#photo-preview div').html('<img src="' + base_url + 'assets/img/mahasiswa/' + data.image + '" class="img-responsive" width="100px" height="100px" > <br>'); // show photo
                    $('#photo-preview div').append('<input type="checkbox" name="remove_photo" value="' + data.image + '"/> Remove photo when saving'); // remove photo

                } else {
                    $('#label-photo').text('Upload Photo'); // label photo upload
                    $('#photo-preview div').text('(No photo)');
                }


            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    }

    function edit_data(id) {
        save_method = 'play';
        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string

        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('sni/play_video') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {

                $('[name="id"]').val(data.id);
                $('[name="nrp"]').val(data.nrp);
                $('[name="nama"]').val(data.nama);
                $('[name="email"]').val(data.email);
                $('[name="jurusan"]').val(data.jurusan);


                $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit Data'); // Set title to Bootstrap modal title $('#photo-preview').show(); // show photo preview modal


                if (data.image) {
                    $('#label-photo').text('Change Photo'); // label photo upload
                    $('#photo-preview div').html('<img src="' + base_url + 'assets/img/mahasiswa/' + data.image + '" class="img-responsive" width="100px" height="100px" > <br>'); // show photo
                    $('#photo-preview div').append('<input type="checkbox" name="remove_photo" value="' + data.image + '"/> Remove photo when saving'); // remove photo

                } else {
                    $('#label-photo').text('Upload Photo'); // label photo upload
                    $('#photo-preview div').text('(No photo)');
                }


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
            url = "<?php echo site_url('ajax/add_data') ?>";
        } else {
            url = "<?php echo site_url('ajax/update_data') ?>";
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
                url: "<?php echo site_url('ajax/delete_datax') ?>/" + id,
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
                        <div class="form-group">
                            <label for="nrp">nrp</label>
                            <input type="text" class="form-control" id="nrp" name="nrp" required>
                        </div>

                        <div class="form-group">
                            <label for="nama">nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>
                        <div class="form-group">
                            <label for="email">email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>

                        <div class="form-group">
                            <label for="jurusan">jurusan</label>
                            <input type="text" class="form-control" id="jurusan" name="jurusan" required>
                        </div>
                        <div class="form-group" id="photo-preview">
                            <label class="control-label col-md-3">Photo</label>
                            <div class="col-md-9">
                                (No photo)
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label id="label-photo">Upload Photo </label>
                            <div class="col-md-9">
                                <input name="image" type="file">
                                <span class="help-block"></span>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<!-- Delete -->
<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Delete</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <p class="text-center">Are you sure you want to Delete</p>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>

                <a href="<?= base_url(); ?>mahasiswa/hapus/<?= $x['id']; ?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Yes</a>
            </div>

        </div>
    </div>
</div>`