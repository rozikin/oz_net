<style>
    h5 {
        color: red;
        text-align: center;

    }
</style>

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
                        <table id="table" class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col" width='10'>No</th>
                                    <th scope="col">Name Process</th>
                                    <th scope="col">Remark</th>
                                    <th scope="col">category</th>
                                    <th scope="col">smv</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Video</th>
                                    <th scope="col">Action</th>
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


</div>
<!-- End of Main Content -->

<!-- Button trigger modal -->

<script type="text/javascript">
    var save_method; //for save method string
    var table;
    var base_url = '<?php echo base_url(); ?>';

    $(document).ready(function() {
        //call function show all product


        table = $('#table').DataTable({
            "ajax": {
                url: '<?php echo site_url('sni/data_all') ?>',
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
        $('#video-preview').hide(); // hide video preview modal
        $('#videocek').hide();
        $('#label-video').text('Upload video'); //
    }


    function edit_data(id) {
        save_method = 'update';
        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string

        $('#photo-preview').show(); // show photo preview modal

        $('#label-photo').text('Upload Photo'); // label photo upload
        $('#video-preview').show(); // show video preview modal

        $('#videos').show(); // label photo upload

        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('sni/edit_mhs') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {

                $('[name="id"]').val(data.id);
                $('[name="name"]').val(data.process_name);
                $('[name="remark"]').val(data.remark);
                $('[name="category"]').val(data.category);
                $('[name="smv"]').val(data.smv);


                $('[name="videos"]').val(data.video);



                $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit Data'); // Set title to Bootstrap modal title $('#photo-preview').show(); // show photo preview modal


                if (data.image) {
                    $('#label-photo').text(' Remove when save?'); // label photo upload
                    $('#photo-preview div').html('<img src="' + base_url + 'assets/img/sni/' + data.image + '" class="img-responsive" width="30px" height="30px" > <br>'); // show photo
                    $('#photo-preview div').append('<input type="checkbox" name="remove_photo" checked value="' + data.image + '"/>'); // remove photo


                } else {
                    $('#label-photo').text('Upload Photo'); // label photo upload
                    $('#photo-preview div').text('(No photo)');
                }


                if (data.video) {
                    $('#label-video').text(' Remove when save?'); // label photo upload
                    $('#videocek').html('<src="' + base_url + 'assets/img/sni/' + data.image + '"> <br>');

                    $('#videocek').append('<input type="checkbox" name="remove_video"  checked value="' + data.video + '"/>'); // remove photo


                } else {
                    $('#label-video').text('Upload video'); // label photo upload

                }

            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    }




    function play_data(id) {
        save_method = 'play';

        $a = '<?php echo base_url('assets/img/sni/'); ?>';

        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('sni/play_video') ?>/" + id,
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



    function reload_table() {
        table.ajax.reload(null, false); //reload datatable ajax 
    }




    function save() {
        $('#btnSave').text('saving...'); //change button text
        $('#btnSave').attr('disabled', true); //set button disable 
        var url;

        if (save_method == 'add') {
            url = "<?php echo site_url('sni/add_data') ?>";
        } else {
            url = "<?php echo site_url('sni/update_data') ?>";
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
                alert('Error adding / update data (Check format gambar/ video)');
                $('#btnSave').text('save'); //change button text
                $('#btnSave').attr('disabled', false); //set button enable 

            }
        });
    }

    function delete_data(id) {
        if (confirm('Are you sure delete this data?')) {
            // ajax delete data to database
            $.ajax({
                url: "<?php echo site_url('sni/delete_datax') ?>/" + id,
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
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h7 class="modal-title">Form</h7>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="id" />



                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Name Process</label>
                                    <input type="text" class="form-control form-control-sm" id="name" name="name" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">

                                    <label for="remark">remark</label>
                                    <input type="text" class="form-control form-control-sm" id="remark" name="remark" required>
                                </div>
                            </div>

                        </div>


                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="category">category</label>
                                    <input type="category" class="form-control form-control-sm" id="category" name="category" required>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="smv">smv</label>
                                    <input type="number" class="form-control form-control-sm" id="smv" name="smv" required>
                                </div>
                            </div>
                        </div>
                        <hr>


                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">

                                    <div class="form-group" id="photo-preview">
                                        <label class="control-label col-md-3">Photo</label>
                                        <div class="col-md-9">
                                            (No photo)
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="image" id="label-photo">Upload Photo</label>
                                        <div class="custom-file">
                                            <input type="file" id="image" name="image">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">

                                <div class="row">
                                    <div class="form-group" id="video-preview">
                                        <label for="videos">Data Video</label>

                                        <div class="col-md-12">
                                            <input type="text" class="form-control form-control-sm" id="videos" name="videos">
                                        </div>
                                        <div id="videocek"></div>

                                    </div>

                                    <div class="form-group">

                                        <label for="video" id="label-video">Video max 50mb </label>
                                        <div class="custom-file">
                                            <input type="file" id="video" name="video">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <h5>Video type must be MP4 and size max 50 Mb</h5>
                    </div>




                    <div class="modal-footer">
                        <button type="submit" id="btnSave" onclick="save()" class="btn btn-primary btn-sm">Save</button>
                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<!-- Modal -->
<div class="modal fade" id="play_videox" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">


            <div class="modal-body">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

                <!-- 16:9 aspect ratio -->
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe id="xx" class="embed-responsive-item" src="" allowscriptaccess="always" allow="autoplay"></iframe>
                </div>


            </div>

        </div>
    </div>
</div>