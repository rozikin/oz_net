<!-- Begin Page Content -->
<div class="container-fluid">



    <div class="row">

        <div class="col-lg">
            <?php if (validation_errors()) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors(); ?></div>
            <?php endif; ?>




            <div class="card shadow mb-4">

                <div class="card-header py-2">
                    <h6 class="m-0 font-weight-bold text-primary"><?= $title; ?></h6>

                </div>
                <div class="card-body">








                    <div class="text-center">
                        <p id="date"></p>
                        <h1 id="time" class="bold text-primary"></h1>
                    </div>

                    <hr>


                    <div class="text-center">
                        <div class="login-box-body">
                            <h5>Enter Employee ID</h5>

                            <form id="form" action="<?= base_url('attendance/save'); ?>" method="post">
                                <div class="form-group">
                                    <select class="form-control" name="status">
                                        <option value="in">Time In</option>
                                        <option value="out">Time Out</option>
                                    </select>
                                </div>
                                <div class="form-group has-feedback">
                                    <input type="text" class="form-control input-lg" id="employee" name="employee" required>
                                    <span class="glyphicon glyphicon-calendar form-control-feedback"></span>
                                </div>


                                <div class="my-2"></div>
                                <button type="sumbit" class="btn btn-primary btn-icon-split" name="save">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-arrow-right"></i>
                                    </span>
                                    <span class="text">attendance</span>
                                </button>
                            </form>
                        </div>

                    </div>
                </div>

                <div class="card-footer py-1">
                    <?= $this->session->flashdata('message'); ?>

                </div>




            </div>
        </div>
    </div>
</div>






</div>
<!-- /.container-fluid -->

<script src="<?= base_url('assets/'); ?>moment/moment.js"></script>



<script type="text/javascript">
    var save_method; //for save method string
    $(function() {
        var interval = setInterval(function() {

            var momentNow = moment();
            $('#date').html(momentNow.format('dddd').substring(0, 3).toUpperCase() + ' - ' + momentNow.format('MMMM DD, YYYY'));
            $('#time').html(momentNow.format('hh:mm:ss A'));
        }, 100);

    });



    function save() {

        var url;

        url = "<?php echo site_url('attendance/save') ?>";


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
</script>