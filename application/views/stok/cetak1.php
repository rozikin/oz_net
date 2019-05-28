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
        LAPORAN STOK <br>
        <b></b>
    </p>
    <table class="table table-bordered">
        <tr class="table-primary">
            <th>No</th>
            <th>Kode</th>
            <th>Nama</th>
            <th>Jenis</th>
            <th>Merk</th>
            <th>Warna</th>
            <th>Satuan</th>
            <th>Stok</th>
        </tr>
        <?php $no = 1;
        foreach ($data as $row) : ?>
            <tr>
                <td><?php echo $no++ ?></td>
                <td><?php echo $row['kode_barang'] ?></td>
                <td><?php echo $row['nama_barang'] ?></td>
                <td><?php echo $row['jenis'] ?></td>
                <td><?php echo $row['merk'] ?></td>
                <td><?php echo $row['warna'] ?></td>
                <td><?php echo $row['satuan'] ?></td>
                <td><?php echo $row['stok'] ?></td>
            </tr>
        <?php endforeach ?>
    </table>

</body>

</html>