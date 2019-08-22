<div class="content-wrapper">
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<?php if ($this->session->flashdata('status') == "gagal") { ?>
					<div class="alert alert-danger"><?php echo $this->session->flashdata('message') ?></div>
				<?php } ?>
				<?php if ($this->session->flashdata('status') == "berhasil") { ?>
					<div class="alert alert-success"><?php echo $this->session->flashdata('message') ?></div>
				<?php } ?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="box">
					<div class="box-body">
						<?php echo form_open('Admin/Lokasi/update') ?>
						<div class="form-group">
							<label class="control-label" for="lokasi">Nama Lokasi</label>
							<input type="text" name="lokasi" class="form-control" value="<?php echo $lokasi['nama_lokasi'] ?>" id="lokasi" required>
						</div>
						<div class="form-group">
							<label class="control-label">Komoditas</label><br>
								<?php foreach ($komoditas as $k) { ?>
								<input type="checkbox" name="komoditas[]" class="flat-red" value="<?php echo $k->id_komoditas ?>"> <?php echo $k->nama_komoditas ?><br>
								<?php } ?>
						</div>
						<div class="form-group">
							<label class="control-label" for="luas">Luas (m<sup>2</sup>)</label>
							<input type="text" name="luas" class="form-control" value="<?php echo $lokasi['luas'] ?>" id="luas" required>
						</div>
						<div class="form-group">
							<input type="hidden" name="id" class="form-control" value="<?php echo $lokasi['id_lokasi'] ?>" required readonly>
							<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
						</div>
						<?php echo form_close(); ?>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>