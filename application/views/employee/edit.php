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

                    <?= form_open_multipart('employee/edit'); ?>
                    <div class="form-row">






                        <div class="col-md-4 mb-1">
                            <input type="hidden" id="nik" name="id" placeholder="id" value="<?= $employee['id']; ?>" required>

                            <div class="input-group">
                                <label for="" class="label-alt">Data Diri</label>

                            </div>

                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-user fas-sm"></i></span>
                                </div>
                                <input type="text" class="form-control" id="nik" name="nik" placeholder="nik" value="<?= $employee['nik']; ?>" required aria-describedby="basic-addon1">
                            </div>

                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-id-badge fas-xs"></i></span>
                                </div>
                                <input type="text" class="form-control" id="ktp" name="ktp" placeholder="ktp" value="<?= $employee['ktp']; ?>" required aria-describedby="basic-addon1">
                            </div>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-user fas-sm"></i></span>
                                </div>
                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama" value="<?= $employee['nama']; ?>" required aria-describedby="basic-addon1">
                            </div>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-map-marker fas-sm"></i></span>
                                </div>
                                <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat" value="<?= $employee['alamat']; ?>">
                            </div>





                            <span class="input-group-addon" id="basic-addon1"></i></span>
                            <?php $jenis = $employee['jenis_kelamin']; ?>

                            <label for="cm">Jenis Kelamin</label>
                            <br />
                            <div class="form-check">
                                <label class="form-check-label" for="check1">
                                    <input type="checkbox" class="form-check-input" id="L" name="jenis_kelamin" value="L" <?php echo ($jenis == 'L') ? "checked" : "" ?>>Laki-Laki
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label" for="check2">
                                    <input type="checkbox" class="form-check-input" id="P" name="jenis_kelamin" value="P" <?php echo ($jenis == 'P') ? "checked" : "" ?>>Perempuan
                                </label>
                            </div>
                            <br>


                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-map-marker fas-sm"></i></span>
                                </div>
                                <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" placeholder="tempat_lahir" required value="<?= $employee['tempat_lahir']; ?>" aria-describedby="basic-addon1">
                            </div>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-calendar-week fas-sm"></i></span>
                                </div>
                                <input type="text" class="form-control" id="dp1" name="tgl_lahir" placeholder="tgl_lahir" required value="<?= $employee['tgl_lahir']; ?>" aria-describedby="basic-addon1">
                            </div>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-birthday-cake fas-sm"></i></span>
                                </div>
                                <input type="text" class="form-control" id="umur" name="umur" placeholder="umur" required value="<?= $employee['umur']; ?>" aria-describedby="basic-addon1">
                            </div>



                        </div>



                        <div class="col-md-1 mb-1">
                        </div>


                        <div class="col-md-4 mb-1">


                            <div class="input-group">
                                <label for="" class="label-alt">Data Detail</label>

                            </div>

                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-building fas-sm"></i></span>
                                </div>
                                <input type="text" class="form-control" id="department" name="department" placeholder="department" required value="<?= $employee['department']; ?>" aria-describedby="basic-addon1">
                            </div>

                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-user fas-sm"></i></span>

                                    <select class="form-control form-control-sm" name="bagian">
                                        <option><?= $employee['bagian']; ?></option>

                                        <option value="PA">ADM</option>
                                        <option value="PROCESS ANALYSIS">PROCESS ANALYSIS</option>
                                        <option value="MOTION ANALYSIS">MOTION ANALYSIS</option>
                                        <option value="GSD">GSD</option>
                                        <option value="MD">MD</option>
                                        <option value="SEWING">SEWING</option>
                                        <option value="PPIC">PPIC</option>
                                        <option value="CLEANING">CLEANING</option>
                                        <option value="IT">IT</option>


                                    </select>

                                </div>
                            </div>

                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-user fas-sm"></i></span>
                                </div>
                                <input type="text" class="form-control" id="jabatan" name="jabatan" placeholder="jabatan" required value="<?= $employee['jabatan']; ?>" aria-describedby="basic-addon1">
                            </div>

                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-tshirt fas-sm"></i></span>
                                    <select class="form-control form-control-sm" name="size_baju">
                                        <option><?= $employee['size_baju']; ?></option>


                                        <option value="M">M</option>
                                        <option value="L">L</option>
                                        <option value="XL">XL</option>
                                        <option value="XXL">XXL</option>

                                    </select>
                                </div>
                            </div>


                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-calendar fas-sm"></i></span>
                                </div>
                                <input type="text" class="form-control" id="dp2" name="tgl_masuk" placeholder="tgl_masuk" required value="<?= $employee['tgl_masuk']; ?>" aria-describedby="basic-addon1">
                            </div>

                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-calendar fas-sm"></i></span>
                                </div>
                                <input type="text" class="form-control" id="dp3" name="tgl_habis_kontrak" placeholder="tgl_habis_kontrak" value="<?= $employee['tgl_habis_kontrak']; ?>" required aria-describedby="basic-addon1">
                            </div>

                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-user fas-sm"></i></span>
                                </div>
                                <input type="text" class="form-control" id="status" name="status" placeholder="status" required value="<?= $employee['status']; ?>" aria-describedby="basic-addon1">
                            </div>

                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-calendar fas-sm"></i></span>
                                </div>
                                <input type="text" class="form-control" id="tgl_penggajian" name="tgl_penggajian" placeholder="tgl_penggajian" value="<?= $employee['tgl_penggajian']; ?>" required aria-describedby="basic-addon1">
                            </div>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-calendar fas-sm"></i></span>
                                </div>
                                <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="keterangan" required value="<?= $employee['keterangan']; ?>" aria-describedby="basic-addon1">
                            </div>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fab fa-whatsapp fab-sm"></i></span>
                                </div>
                                <input type="text" class="form-control" id="no_telp" name="no_telp" placeholder="no_telp" placeholder="keterangan" value="<?= $employee['no_telp']; ?>" required aria-describedby="basic-addon1">
                            </div>




                        </div>

                        <div class="col-md-12 mb-1">
                            <hr>
                        </div>





                        <div class="col-md-4 mb-1">
                            <label for="dcd">Photo</label>
                            <br />

                            <img src="<?= base_url('assets'); ?>/img/employee/<?= $employee["image"]; ?>" id="profile-img-tag" width="100px" class="img-thumbnail">
                            <br />
                            <input type="file" name="image" id="profile-img">
                        </div>



                        <div class="col-lg-12">
                            <hr>
                        </div>

                        <button type="submit" class="btn btn-primary btn-sm">Save</button>
                        <a href="<?= base_url('employee'); ?>" class="btn btn-danger btn-sm">Back</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




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







    $('#dp1').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true,
        todayHighlight: true,
        orientation: "top auto",
        todayBtn: true,


    });
    $('#dp2').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true,
        todayHighlight: true,
        orientation: "top auto",
        todayBtn: true,


    });
    $('#dp3').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true,
        todayHighlight: true,
        orientation: "top auto",
        todayBtn: true,


    });
    $('#dp4').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true,
        todayHighlight: true,
        orientation: "top auto",
        todayBtn: true,


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