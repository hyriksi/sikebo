<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .line-title {
            border: 0;
            border-style: inset;
            border-top: 1px solid #000;
        }
    </style>
</head>

<body>
    <img src="assets/img/logo.jpg" style="position: absolute; width: 180px; height: auto;">
    <table style="width: 100%;">
        <tr>
            <td align="center">
                <span style="line-height: 1.5; font-weight: bold;">
                    KEBUN PERCOBAAN<br>
                    KOMPARTEMEN RISET<br>
                    PT PETROKIMIA GRESIK
                </span>
            </td>
        </tr>
    </table>
    <hr class="line-title">
    <h4 align="center">
        Pengajuan Penggunaan Lahan Kebun Percobaan <br>
    </h4>
    <table>
        <tr>
            <td>Judul Penelitian</td>
            <td>:</td>
            <td><?= $pemesanan['judul_penelitian'] ?></td>
        </tr>
        <tr>
            <td>Tanggal Penggunaan</td>
            <td>:</td>
            <td><?= $pemesanan['tgl_penelitian'] ?></td>
        </tr>
        <tr>
            <td>Komoditas</td>
            <td>:</td>
            <td><?= $pemesanan['nama_komoditas'] ?></td>
        </tr>
        <tr>
            <td>Lokasi</td>
            <td>:</td>
            <td><?= $pemesanan['nama_lokasi'] ?></td>
        </tr>
        <tr>
            <td>Luas lahan</td>
            <td>:</td>
            <td><?= $pemesanan['luas_pakai'] ?> m<sup>2</sup></td>
        </tr>
        <tr>
            <td>Kebutuhan</td>
            <td>:</td>
            <td><?php foreach ($detail_pemesanan as $d) { ?>
                    -<?php echo $d->nama_kebutuhan ?>
                <?php } ?></td>
        </tr>
        <tr>
            <td>Tanggal Penyemaian </td>
            <td>:</td>
            <td><?= $detail_kegiatan['semai'] ?></td>
        </tr>
        <tr>
            <td>Tanggal Pindah Tanam </td>
            <td>:</td>
            <td><?= $detail_kegiatan['pindah'] ?></td>
        </tr>
        <tr>
            <td>Tanggal Pengolahan lahan </td>
            <td>:</td>
            <td><?= $detail_kegiatan['pengolahan'] ?></td>
        </tr>
        <tr>
            <td>Tanggal Pemupukan-1</td>
            <td>:</td>
            <td><?= $detail_kegiatan['pemupukan1'] ?></td>
        </tr>
        <tr>
            <td>Tanggal Pemupukan-2</td>
            <td>:</td>
            <td><?= $detail_kegiatan['pemupukan2'] ?></td>
        </tr>
        <tr>
            <td>Tanggal Pemupukan-3</td>
            <td>:</td>
            <td><?= $detail_kegiatan['pemupukan3'] ?></td>
        </tr>
        <tr>
            <td>Tanggal Panen</td>
            <td>:</td>
            <td><?= $detail_kegiatan['panen'] ?></td>
        </tr>
        <tr>
            <td>Keterangan</td>
            <td>:</td>
            <td><?php echo $pemesanan['keterangan'] ?></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>
                <p align="right"><b><i>*Approved</i></b></p>
            </td>
        </tr>
    </table>
</body>

</html>