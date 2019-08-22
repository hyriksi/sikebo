<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Dashboard
      <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <?php if ($this->session->userdata('akses') == 'admin') { ?>
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>
                <?php
                $this->db->from('lokasi');
                echo $this->db->count_all_results();
                ?>
              </h3>
              <p>Lokasi</p>
            </div>
            <div class="icon">
              <i class="ion ion-navigate"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>
                <?php
                $this->db->from('user');
                $this->db->where('akses', 'peneliti');
                echo $this->db->count_all_results();
                ?>
              </h3>
              <p>Peneliti</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>
                <?php
                $this->db->from('komoditas');
                echo $this->db->count_all_results();
                ?>
              </h3>
              <p>Komoditas</p>
            </div>
            <div class="icon">
              <i class="fa fa-building"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>
                <?php
                $this->db->from('pemesanan');
                echo $this->db->count_all_results();
                ?>
              </h3>
              <p>Pengajuan</p>
            </div>
            <div class="icon">
              <i class="fa fa-laptop"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
    <?php } ?>
    <div class="box">
      <div class="box-header">
        <h4>Penggunaan lahan</h4>
      </div>
      <div class="box-body">
        <table class="table table-bordered table-striped" id="table">
          <thead>
            <tr>
              <th class="text-center">#</th>
              <th class="text-center">Peneliti</th>
              <th class="text-center">Komoditas</th>
              <th class="text-center">Lokasi</th>
              <th class="text-center">Tanggal Mulai</th>
              <th class="text-center">Tanggal Selesai</th>
              <th class="text-center">Status</th>
            </tr>
          </thead>
          <tbody>
            <?php $no = 1;
            foreach ($pengajuan as $p) { ?>
              <tr>
                <td class="text-center"><?php echo $no++ ?></td>
                <td><?php echo $p->nama ?></td>
                <td><?php echo $p->nama_komoditas ?></td>
                <td><?php echo $p->nama_lokasi ?></td>
                <td><?php echo $p->tgl_penelitian ?></td>
                <td><?php echo $p->panen ?></td>
                <td class="text-center"><?php echo $p->status_pemesanan ?></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->