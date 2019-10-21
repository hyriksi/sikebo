<div class="content-wrapper">
	<section class="content-header">
		<h1>Daftar Pengajuan</h1>
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
					<div class="box-header">
						<a href="<?php echo site_url('Peneliti/Pengajuan/buat') ?>" class="btn btn-success"><i class="fa fa-plus"></i> Ajukan</a>
					</div>
					<div class="box-body">
						<table class="table table-bordered table-striped" id="table">
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th class="text-center">Judul Penelitian</th>
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
										<td><?php echo $p->nama_komoditas ?></td>
										<td><?php echo $p->nama_lokasi ?></td>
										<td class="text-center "> <?php echo $p->status_pemesanan ?></td>
										<td class="text-center">
											<a href="<?php echo site_url('Peneliti/Pengajuan/edit/' . $p->id_pemesanan) ?>" class="btn btn-info btn-xs"><i class="fa fa-edit"></i></a>
											<a href="#" data-url="<?php echo site_url('Peneliti/Pengajuan/hapus/' . $p->id_pemesanan) ?>" class="btn btn-danger btn-xs confirm_delete"><i class="fa fa-trash"></i></a>
											<a href="<?php echo site_url('Peneliti/Pengajuan/cetak/' . $p->id_pemesanan) ?>" class="btn <?php if ($p->status_pemesanan == "diterima") echo "btn-success" ?> <?php if ($p->status_pemesanan != "diterima") echo "btn-default" ?> btn-xs"><i class="fa fa-print"></i></a>
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
<script type="text/javascript">
	$(document).ready(function() {
		$('.confirm_delete').on('click', function() {

			var delete_url = $(this).attr('data-url');

			swal({
				title: "Hapus Pengajuan",
				text: "Yakin ingin menghapus ?",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#FA041B",
				confirmButtonText: "Hapus !",
				cancelButtonText: "Batalkan",
				closeOnConfirm: false
			}, function() {
				window.location.href = delete_url;
			});

			return false;
		});
	});
</script>