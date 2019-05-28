<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Laporan</title>
    <link rel="stylesheet" href="">
    <link href="<?= base_url('assets/'); ?>css/sb-admin-2.min.css" rel="stylesheet">

    <style>
        .line-title {
            border: 0;
            border-style: inset;
            border-top: 1px solid #000;
        }

        p {
            font-size: 1.1em;
            width: 200px;
            line-height: 0.87;
            color: BLUE;
            font-weight: bold;
            margin-left: 10px;
        }
    </style>
</head>

<body>
    <img src="assets/img/GG.jpg" style="position: absolute; width: 60px; height: auto;">
    <table style="width: 100%;">
        <tr>
            <td align="center">
                <span style="line-height: 1.6; font-weight: bold;">
                    PRODUCT ANALYSIS CENTER
                    <br>PAC
                </span>
            </td>
        </tr>
    </table>

    <hr class="line-title">
    <p align="center">
        Skatch All <br>
        <b></b>
    </p>
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
                            <img src="assets/img/GG.jpg" style="position: absolute; width: 60px; height: auto;">

                        </div>
                        <br>
                        <br>

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


</body>

</html>