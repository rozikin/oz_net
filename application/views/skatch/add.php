<!-- /.container-fluid -->



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

                    <?= $this->session->flashdata('message'); ?>

                    <?= form_open_multipart('skatch/add_form'); ?>
                    <div class="form-row">
                        <div class="col-md-3 mb-1">
                            <label for="date_analisa">Date Analis</label>
                            <input type="date" id="date" onload="getDate()" class="form-control form-control-sm" name="date_analisa" placeholder="" required>
                        </div>



                        <div class="col-md-3 mb-1">
                            <label class="label-sm" for="buyer">Buyer</label>

                            <select class="custom-select custom-select-sm" name="buyer">
                                <option>--Select--</option>
                                <?php foreach ($buyers as $x) : ?>
                                    <option value="<?= $x['buyer'] ?>"><?= $x['buyer'] ?></option>
                                <?php endforeach; ?>
                            </select>



                        </div>
                        <div class="col-md-3 mb-1">
                            <label for="style">Style</label>
                            <input type="text" class="form-control form-control-sm" id="style" name="style" placeholder="" required>
                        </div>

                        <div class="col-md-3 mb-1">
                            <label for="factory">Factory</label>
                            <select class="custom-select custom-select-sm" name="factory">
                                <option>--Select--</option>
                                <?php foreach ($factorys as $x) : ?>
                                    <option value="<?= $x['factory'] ?>"><?= $x['factory'] ?></option>
                                <?php endforeach; ?>
                            </select>

                        </div>

                        <div class="col-lg-12">
                            <hr>
                        </div>


                    </div>
                    <div class="form-row">

                        <div class="col-md-1 mb-1">
                            <label for="qty">Qty</label>
                            <input type="text" class="form-control  form-control-sm" id="qty" min="0" data-bind="value:qty" name="qty" placeholder="" required>

                        </div>
                        <div class="col-md-1 mb-1">
                            <label for="cm">CM</label>
                            <input type="text" class="form-control  form-control-sm" id="cm" name="cm" placeholder="" required>

                        </div>
                        <div class="col-md-1 mb-1">
                            <label for="dcd">DCD</label>
                            <input type="text" class="form-control  form-control-sm" id="dcd" name="dcd" placeholder="" required>

                        </div>

                        <div class="col-md-1 mb-1">


                        </div>

                        <div class="col-md-4 mb-1">




                        </div>


                    </div>

                    <div class="col-lg-12">
                        <hr>
                    </div>

                    <div class="form-row">


                        <div class="col-md-1 mb-1">
                            <label for="total_process">TTL Process</label>
                            <input type="number" class="form-control  form-control-sm" id="total_process" name="total_process" placeholder="" required>

                            <label for="op">OP</label>
                            <input type="number" class="form-control  form-control-sm" id="op" name="op" value='0' required>


                        </div>

                        <div class="col-md-1 mb-1">


                        </div>

                        <div class="col-md-1 mb-1">
                            <label for="hp">HP</label>
                            <input type="number" class="form-control  form-control-sm" id="hp" name="hp" value='0' required>

                            <label for="total_manpower">Total MP</label>
                            <input type="number" class="form-control  form-control-sm" id="total_manpower" name="total_manpower" value='0' required>



                        </div>

                        <div class="col-md-1 mb-1">


                        </div>

                        <div class="col-md-1 mb-1">
                            <label for="cm">Type</label>
                            <br />
                            <div class="form-check">
                                <label class="form-check-label" for="check1">
                                    <input type="checkbox" class="form-check-input" id="SM" name="type" value="SM" checked>SM
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label" for="check2">
                                    <input type="checkbox" class="form-check-input" id="SFM" name="type" value="SFM">SFM
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" id="FM" name="type" value="FM">FM
                                </label>
                            </div>

                        </div>
                        <div class="col-md-1 mb-1">


                        </div>
                    </div>

                    <div class="col-lg-12">
                        <hr>
                    </div>

                    <div class="form-row">


                        <div class="col-md-1 mb-1">
                            <label for="smv">smv net</label>
                            <input type="number" class="form-control  form-control-sm" id="smv" name="smv" placeholder="" required>

                            <label for="loss">Loss</label>
                            <input type="text" class="form-control  form-control-sm" id="loss" name="loss" placeholder="" required>

                            <label for="total_smv">Total Smv</label>
                            <input type="number" class="form-control  form-control-sm" id="total_smv" name="total_smv" placeholder="" required>

                        </div>


                        <div class="col-md-1 mb-1">


                        </div>

                        <div class="col-md-1 mb-1">
                            <label for="efficiency">Efficiency</label>
                            <input type="text" class="form-control  form-control-sm" id="efficiency" name="efficiency" placeholder="" required>

                            <label for="wh">WH</label>
                            <input type="number" class="form-control  form-control-sm" id="wh" name="wh" placeholder="" required>

                            <label for="target">Target</label>
                            <input type="text" class="form-control  form-control-sm" id="target" name="target" placeholder="" required>

                        </div>

                        <div class="col-md-1 mb-1">


                        </div>

                        <div class="col-md-4 mb-1">
                            <label for="dcd">Photo</label>
                            <br />
                            <img src="" id="profile-img-tag" width="100px" class="img-thumbnail">
                            <br />
                            <input type="file" name="image" id="profile-img">
                        </div>





                    </div>



                    <div class="col-lg-12">
                        <hr>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm">Save</button>
                    <a href="<?= base_url('skatch'); ?>" class="btn btn-danger btn-sm">Back</a>
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
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#profile-img-tag').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#profile-img").change(function() {
        readURL(this);
    });
</script>


<script type="text/javascript">
    $(document).ready(function() {
        $('#hp').keyup(function() {
            <!-- Ambil nilai op dan hp !-->
            var op = parseInt($('#op').val());
            var hp = parseInt($('#hp').val());


            var total_mp = op + hp;
            $('#total_manpower').val(total_mp);
        });
    });
</script>