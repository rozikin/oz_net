<style>
    p {
        font-size: 1.1em;
        width: 200px;
        line-height: 0.87;
        color: BLUE;
        font-weight: bold;
        margin-left: 10px;
    }

    @media print {
        .h5 {
            display: none;
        }

        .a {
            display: none;
        }

        .form-control {
            display: none;
        }

        .sidebar {
            display: none;
        }

        .navbar {
            display: none;
        }

        .topbar {
            display: none;
        }

        .btn {
            display: none;
        }

        .input-group {
            display: none;
        }

    }
</style>

<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h5 class="h5 mb-4 text-gray-800"><?= $title; ?></h5>

    </div>

    <!-- Page Heading -->
    <div class="row">

    </div>

    <div class="row">


        <div class="col-md-12">
            <?php echo form_open("skatch/searchUser", ['class' => 'form-inline']); ?>

            <div class="input-group">
                <input type="text" class="form-control form-control-sm" id="searchuser" name="search" placeholder="Search...">
                <div class="input-group-append">
                    <button type="submit" name="searchBtn" class="btn btn-primary btn-sm"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </div>
    </div>
    <hr>




    <!-- Content Row -->
    <div class="row">



        <!-- First Column -->
        <?php if (count($data)) : ?>
            <?php foreach ($data->result_array() as $xx) : ?>


                <div id="view" class="col-lg-4">
                    <div class="card shadow mb-2">
                        <div class="card-header py-2">
                            <div class="row">
                                <div class="col-md-7">
                                    <h6 class="m-0 font-weight-bold text-primary"><?= $xx['buyer']; ?>
                                    </h6>
                                </div>
                                <div class="col-md-5">
                                    <h6 class="m-0  text-primary text-right text-md "><?= $xx['date_analisa']; ?></h5>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="row no-gutters">



                                <div class="col-md-7">
                                    <img src="<?= base_url('assets/img/skatch/') . $xx['image']; ?>" class="card-img" height="210px">
                                </div>

                                <div class="col-md-5">


                                    <p>
                                        <font size="1">
                                            STYLE : <?= $xx['style']; ?><br>
                                            QTY : <?= $xx['qty']; ?><br>
                                            CM : <?= $xx['cm']; ?><br>
                                            DCD : <?= $xx['dcd']; ?><br>
                                            FTY : <?= $xx['factory']; ?><br>
                                            TYPE : <?= $xx['type']; ?><br>
                                            TTL PROCESS : <?= $xx['total_process']; ?><br>
                                            OP : <?= $xx['operator']; ?> | HP : <?= $xx['helper']; ?> | TTL : <?= $xx['total_manpower']; ?><br>
                                            SMV : <?= $xx['smv']; ?><br>
                                            LOSS : <?= $xx['loss']; ?><br>
                                            TOTAL SMV : <?= $xx['total_smv']; ?><br>
                                            EFFICIENCY : <?= $xx['efficiency']; ?><br>
                                            W.H (day) : <?= $xx['work_hour']; ?><br>
                                            TARGET : <?= $xx['target']; ?><br>

                                        </font>
                                    </p>



                                </div>



                            </div>
                        </div>


                    </div>
                </div>

            <?php endforeach; ?>

        <?php else : ?>
            <center>
                <p style="margin: 20px;">Not Found</p>
            </center>
        <?php endif ?>





    </div>

    <div class="row">
        <div class="col">
            <!--Tampilkan pagination-->
            <?php echo $pagination; ?>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->