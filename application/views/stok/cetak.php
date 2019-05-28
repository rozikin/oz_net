<?php

$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
$pdf->SetTitle('Stok');
$pdf->SetHeaderMargin(30);
$pdf->SetTopMargin(20);
$pdf->setFooterMargin(20);
$pdf->SetAutoPageBreak(true);
$pdf->SetAuthor('Author');
$pdf->SetDisplayMode('real', 'default');
$pdf->SetFont('helvetica', '', 11, '', 'false');
$pdf->AddPage();

$i = 0;
$html = '



<h3 align="center">Stok Material</h3>
                    <table cellspacing="1" bgcolor="#666666" cellpadding="2">
                        <tr bgcolor="yellow">
                            <th width="5%" align="center">No</th>
                            <th width="15%" align="center">Kode Barang</th>
                            <th width="25%" align="center">Nama Produk</th>
                            <th width="15%" align="center">Jenis</th>
                            <th width="15%" align="center">Merk</th>
                            <th width="10%" align="center">Warna</th>
                            <th width="10%" align="center">Satuan</th>
                            <th width="5%" align="center">Stok</th>
                        </tr>';
foreach ($data as $row) {
    $i++;
    $html .= '<tr bgcolor="#ffffff">
                            <td align="center">' . $i . '</td>
                            <td align="center">' . $row['kode_barang'] . '</td>
                            <td align="left">' . $row['nama_barang'] . '</td>
                            <td align="center">' . $row['jenis'] . '</td>
                            <td align="center">' . $row['merk'] . '</td>
                            <td align="center">' . $row['warna'] . '</td>
                            <td align="center">' . $row['satuan'] . '</td>
                            <td align="center">' . $row['stok'] . '</td>
                           
                        </tr>';
}
$html .= '</table>';
$pdf->writeHTML($html, true, false, true, false, '');
$pdf->Output('stok.pdf', 'I');
