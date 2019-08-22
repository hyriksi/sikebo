<div class="content-wrapper">
	<section class="content-header">
		<h1>Konfirmasi Pengajuan</h1>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<?php if ($this->session->flashdata('status') == "gagal") { ?>
					<div class="alert alert-danger"><?php echo $this->session->flashdata('message') ?></div>
				<?php } ?>
				<?php if ($this->session->flashdata('status') == "berhasil") { ?>
					<div class="alert alert-success"><?php echo $this->session->flashdata('message') ?></div>
				<?php } ?>
				<div class="box">
					<div class="box-body">
						<table class="table table-bordered table-striped" id="table">
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th class="text-center">Judul Penelitian</th>
									<th class="text-center">Nama Peneliti</th>
									<th class="text-center">Komoditas</th>
									<th class="text-center">Lokasi</th>
									<th class="text-center">Status</th>
									<th class="text-center">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php $no = 1;
								foreach ($pengajuan as $p) { ?>
									<tr>
										<td class="text-center"><?php echo $no++ ?></td>
										<td><?php echo $p->judul_penelitian ?></td>
										<td><?php echo $p->nama ?></td>
										<td><?php echo $p->nama_komoditas ?></td>
										<td><?php echo $p->nama_lokasi ?></td>
										<td class="text-center"><?php echo $p->status_pemesanan ?></td>
										<td class="text-center">
											<a href="<?php echo site_url('Admin/Konfirmasi/tinjau/' . $p->id_pemesanan) ?>" class="btn btn-info btn-xs"><i class="fa fa-file"></i> Tinjau</a>
										</td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>