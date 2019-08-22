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
			<div class="col-md-4">
				<div class="row">
					<div class="col-md-12">
						<div class="box box-info">
							<div class="box-body">
								<p class="text-center">
									<img src="<?php echo base_url('assets/img/profil/' . $profil['path']) ?>" class="profile-user-img img-responsive img-circle">
								</p>
								<p class="text-center">
									<button type="button" data-toggle="modal" data-target="#pict" class="btn btn-warning btn-xs"><i class="fa fa-picture-o"></i> Change Picture</button><br>
									<?php echo $profil['nama'] ?>
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-8">
				<div class="row">
					<div class="col-md-12">
						<div class="box">
							<div class="box-body">
								<?php echo form_open('Profil/update_data') ?>
								<div class="form-group">
									<label class="control-label" for="nama">Nama Lengkap :</label>
									<input type="text" name="nama" class="form-control" id="nama" value="<?php echo $profil['nama'] ?>" required>
								</div>
								<div class="form-group">
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label" for="username">Username :</label>
												<input type="text" name="username" class="form-control" id="username" value="<?php echo $profil['username'] ?>">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label" for="email">E-Mail :</label>
												<input type="email" name="email" class="form-control" id="email" value="<?php echo $profil['email'] ?>">
											</div>
										</div>
									</div>
								</div>
								<div class="form-group">
									<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#passw"><i class="fa fa-key"></i> Change Password</button>
									<button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i> Save</button>
								</div>
								<?php echo form_close(); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Modal Gambar -->
		<div class="modal fade" role="dialog" id="pict">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><i class="fa fa-times"></i></button>
						<h4>Ganti Foto Profil</h4>
					</div>
					<div class="modal-body">
						<?php echo form_open_multipart('Profil/update_pict') ?>
						<div class="form-group">
							<input type="file" name="gambar" class="gambar">
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-warning"><i class="fa fa-upload"></i></button>
						</div>
						<?php echo form_close(); ?>
					</div>
				</div>
			</div>
		</div>
		<!-- Modal Gambar -->
		<!-- Modal Password -->
		<div class="modal fade" role="dialog" id="passw">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><i class="fa fa-times"></i></button>
						<h4>Ganti Password</h4>
					</div>
					<div class="modal-body">
						<?php echo form_open('Profil/update_pass') ?>
						<div class="form-group">
							<label class="control-label" for="pass">Password Baru</label>
							<input type="password" name="password" class="form-control" id="pass" required>
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i></button>
						</div>
						<?php echo form_close(); ?>
					</div>
				</div>
			</div>
		</div>
		<!-- Modal Password -->
	</section>
</div>