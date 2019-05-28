
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

                            <?= form_open_multipart('skatch/edit'); ?>

                              <input type="hidden" id="id" class="form-control form-control-sm" name="id" value="<?= $skatch['id'];?>" required>
                            <div class="form-row">
                                <div class="col-md-3 mb-1">
                                    <label for="date_analisa">Date Analis</label>
                                    <input type="date" id="date" onload="getDate()" class="form-control form-control-sm" name="date_analisa" value="<?= $skatch['date_analisa'];?>" required>
                                </div>




                                <div class="col-md-3 mb-1">
                                    <label class="label-sm" for="buyer">Buyer</label>

                                    <select class="custom-select custom-select-sm" name="buyer">
                                    <option value="<?= $skatch['buyer'];?>"><?= $skatch['buyer'];?></option>

                                    <?php foreach ($buyers as $x) : ?>
                                        <option value="<?= $x['buyer'] ?>"><?= $x['buyer'] ?></option>
                                    <?php endforeach; ?>
                                </select>

                                  

                                </div>
                                <div class="col-md-3 mb-1">
                                    <label for="style">Style</label>
                                    <input type="text" class="form-control form-control-sm" id="style" name="style" value="<?= $skatch['style'];?>" required>
                                </div>

                                <div class="col-md-3 mb-1">
                                    <label for="factory">Factory</label>
                                    <select class="custom-select custom-select-sm" name="factory" >
                                         
                                        <option value="<?= $skatch['factory'];?>"><?= $skatch['factory'];?></option>
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
                                    <input type="text" class="form-control  form-control-sm" id="qty" min="0" data-bind="value:qty" name="qty" value="<?= $skatch['qty'];?>" required>

                                   

                                </div>
                                <div class="col-md-1 mb-1">
                                    <label for="cm">CM</label>
                                    <input type="text" class="form-control  form-control-sm" id="cm" name="cm" value="<?= $skatch['cm'];?>" required>

                                </div>
                                <div class="col-md-1 mb-1">
                                    <label for="dcd">DCD</label>
                                    <input type="text" class="form-control  form-control-sm" id="dcd" name="dcd" value="<?= $skatch['dcd'];?>" required>

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
                                    <input type="number" class="form-control  form-control-sm" id="total_process" name="total_process" value="<?= $skatch['total_process'];?>" required>

                                     <label for="op">OP</label>
                                    <input type="text" class="form-control  form-control-sm" id="op" name="op" value="<?= $skatch['operator'];?>" required>

                                   
                                </div>

                                  <div class="col-md-1 mb-1">
                                   

                                </div>

                                <div class="col-md-1 mb-1">
                                     <label for="hp">HP</label>
                                    <input type="number" class="form-control  form-control-sm" id="hp" name="hp" value="<?= $skatch['helper'];?>" required>

                                     <label for="total_manpower">Total MP</label>
                                    <input type="number" class="form-control  form-control-sm" id="total_manpower" name="total_manpower" value="<?= $skatch['total_manpower'];?>" required>



                                </div>

                                 <div class="col-md-1 mb-1">
                                   

                                </div>
                                
                                <div class="col-md-1 mb-1">
                                    <label for="cm">Type</label>
                                    <br />
                                    <div class="form-check">
                                     <?php $type = $skatch['type']; ?>
                                        <label class="form-check-label" for="check1">
                                            <input type="checkbox" class="form-check-input" id="SM" name="type" value="SM" <?php echo ($type == 'SM') ? "checked": "" ?> >SM
                                        </label>
                                        </div>
                                        <div class="form-check">
                                        <label class="form-check-label" for="check2">
                                            <input type="checkbox" class="form-check-input" id="SFM" name="type" value="SFM" <?php echo ($type == 'SFM') ? "checked": "" ?>>SFM
                                        </label>
                                        </div>
                                        <div class="form-check">
                                        <label class="form-check-label">
                                              <input type="checkbox" class="form-check-input" id="FM" name="type" value="FM" <?php echo ($type == 'FM') ? "checked": "" ?>>FM
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
                                    <input type="number" class="form-control  form-control-sm" id="smv" name="smv" value="<?= $skatch['smv'];?>" required>

                                    <label for="loss">Loss</label>
                                    <input type="text" class="form-control  form-control-sm" id="loss" name="loss" value="<?= $skatch['loss'];?>" required>

                                     <label for="total_smv">Total Smv</label>
                                    <input type="number" class="form-control  form-control-sm" id="total_smv" name="total_smv" value="<?= $skatch['total_smv'];?>" required>

                                </div>


                                <div class="col-md-1 mb-1">
                                    

                                </div>
                             
                                <div class="col-md-1 mb-1">
                                    <label for="efficiency">Efficiency</label>
                                    <input type="text" class="form-control  form-control-sm" id="efficiency" name="efficiency" value="<?= $skatch['efficiency'];?>" required>

                                     <label for="wh">WH</label>
                                    <input type="number" class="form-control  form-control-sm" id="wh" name="wh" value="<?= $skatch['work_hour'];?>" required>

                                      <label for="target">Target</label>
                                    <input type="text" class="form-control  form-control-sm" id="target" name="target" value="<?= $skatch['target'];?>" required>

                                </div>

                                   <div class="col-md-1 mb-1">
                                  

                                </div>
                                
                                <div class="col-md-4 mb-1">
                                    <label for="dcd">Photo</label>
                                    <br />

                                    <img src="<?= base_url('assets'); ?>/img/skatch/<?= $skatch["image"]; ?>" id="profile-img-tag" width="100px" class="img-thumbnail">
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

        