<div class="content-wrapper">
	<section class="content-header">
		<h1>Daftar Lokasi</h1>
	</section>
	<section class="content">
		<div class="row">
			<?php if ($this->session->flashdata('status') == "gagal") { ?>
				<div class="alert alert-danger"><?php echo $this->session->flashdata('message') ?></div>
			<?php } ?>
			<?php if ($this->session->flashdata('status') == "berhasil") { ?>
				<div class="alert alert-success"><?php echo $this->session->flashdata('message') ?></div>
			<?php } ?>
			<div class="col-md-6">
				<div class="box">
					<div class="box-body">
						<?php echo form_open('Admin/Lokasi/tambah'); ?>
						<div class="form-group">
							<label class="control-label" for="lokasi">Lokasi :</label>
							<input type="text" name="lokasi" class="form-control" id="lokasi" placeholder="Nama Lahan" required>
						</div>
						<div class="form-group">
							<label class="control-label">Komoditas</label><br>
								<?php foreach ($komoditas as $k) { ?>
								<input type="checkbox" name="komoditas[]" class="flat-red" value="<?php echo $k->id_komoditas ?>"> <?php echo $k->nama_komoditas ?><br>
								<?php } ?>
						</div>
						<div class="form-group">
							<label class="control-label" for="luas">Luas (m<sup>2</sup>)</label>
							<input type="text" name="luas" class="form-control" id="luas" placeholder="(meter persegi)" required>
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
						</div>
						<?php echo form_close(); ?>
					</div>
				</div>
			</div>

			<div class="col-md-12">
				<div class="box">
					<div class="box-body">
						<table class="table table-bordered table-striped" id="table">
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th class="text-center">Nama Lokasi</th>
									<th class="text-center">Komoditas</th>
									<th class="text-center">Luas</th>
									<th class="text-center">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php $no = 1;
								foreach ($lokasi as $l) { ?>
									<tr>
										<td class="text-center"><?php echo $no++ ?></td>
										<td><?php echo $l->nama_lokasi ?></td>
										<td><?php echo $l->nama_komoditas ?></td>
										<td><?php echo $l->luas ?></td>
										<td class="text-center">
											<a href="<?php echo site_url('Admin/Lokasi/edit/' . $l->id_lokasi) ?>" class="btn btn-info btn-xs"><i class="fa fa-edit"></i></a>
											<a href="#" data-url="<?php echo site_url('Admin/Lokasi/hapus/' . $l->id_lokasi) ?>" class="btn btn-danger btn-xs confirm_delete"><i class="fa fa-trash"></i></a>
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
				title: "Hapus Lokasi",
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