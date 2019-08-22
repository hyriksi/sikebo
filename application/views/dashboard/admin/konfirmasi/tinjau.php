 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
     <!-- Content Header (Page header) -->
     <section class="content-header">
         <h1>
             Rincian Pengajuan
         </h1>
     </section>
     <section class="content">
         <div class="box">
             <div class="box-header with-border">
                 <h3 class="box-title"><?= $pemesanan['nama'] ?></h3>
             </div>
             <div class="box-body">
                 <table class="table">
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
                 </table>
                 <br>
                 <div class="form-group">
                     <?php echo form_open('Admin/Konfirmasi/terima') ?>
                     <div class="row">
                         <div class="col-md-1">
                             <input type="hidden" name="id" class="form-control" value="<?php echo $pemesanan['id_pemesanan'] ?>" required readonly>
                             <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Terima</button>
                         </div>
                         <?php echo form_close() ?>
                         <?php echo form_open('Admin/Konfirmasi/tolak') ?>
                         <div class="col-md-1">
                             <input type="hidden" name="id" class="form-control" value="<?php echo $pemesanan['id_pemesanan'] ?>" required readonly>
                             <button type="submit" class="btn btn-danger"><i class="fa fa-close"></i> Tolak</button>
                         </div>
                     </div>
                     <?php echo form_close(); ?>
                 </div>
             </div>
             <!-- /.box-body -->
         </div>
         <!-- /.box -->
     </section>
     <!-- /.content -->
 </div>
 <!-- /.content-wrapper -->