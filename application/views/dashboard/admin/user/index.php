<div class="content-wrapper">
	<section class="content-header">
		<h1>Daftar Peneliti</h1>
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
						<a href="#" data-toggle="modal" data-target="#tambah" class="btn btn-success"><i class="fa fa-plus"></i></a>
					</div>
					<div class="box-body">
						<table class="table table-bordered table-striped" id="table">
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th class="text-center">Nama</th>
									<th class="text-center">User ID</th>
									<th class="text-center">Email</th>
									<th class="text-center">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php $no = 1;
								foreach ($user as $u) { ?>
									<tr>
										<td class="text-center"><?php echo $no++ ?></td>
										<td><?php echo $u->nama ?></td>
										<td><?php echo $u->username ?></td>
										<td><?php echo $u->email ?></td>
										<td class="text-center">
											<a href="#" data-toggle="modal" data-target="#edit" class="btn btn-info btn-xs" onclick="edit(<?php echo $u->id_user ?>)"><i class="fa fa-edit"></i></a>
											<a href="#" data-url="<?php echo site_url('Admin/User/hapus/' . $u->id_user) ?>" class="btn btn-danger btn-xs confirm_delete"><i class="fa fa-trash"></i></a>
										</td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<!-- Modal Tambah -->
		<div class="modal fade" role="dialog" id="tambah">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><i class="fa fa-times"></i></button>
						<h4>Tambah User</h4>
					</div>
					<div class="modal-body">
						<?php echo form_open('Admin/User/tambah') ?>
						<div class="form-group">
							<label class="control-label" for="nlengkap">Nama Lengkap</label>
							<input type="text" name="nama" class="form-control" id="nlengkap" required>
						</div>
						<div class="form-group">
							<label class="control-label" for="username">Username</label>
							<input type="text" name="username" class="form-control" id="username" required>
						</div>
						<div class="form-group">
							<label class="control-label" for="email">Email</label>
							<input type="email" name="email" class="form-control" id="email" required>
						</div>
						<div class="form-group">
							<label class="control-label" for="password">Password</label>
							<input type="password" name="password" class="form-control" id="password" required>
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
						</div>
						<?php echo form_close(); ?>
					</div>
				</div>
			</div>
		</div>
		<!-- Modal Edit -->
		<div class="modal fade" role="dialog" id="edit">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><i class="fa fa-times"></i></button>
						<h4>Edit User</h4>
					</div>
					<div class="modal-body">
						<?php echo form_open('Admin/User/update') ?>
						<div class="form-group">
							<label class="control-label" for="nama">Nama Lengkap</label>
							<input type="text" name="nama" class="form-control" id="nama" required>
						</div>
						<div class="form-group">
							<label class="control-label" for="userid">Username</label>
							<input type="text" name="username" class="form-control" id="userid" required>
						</div>
						<div class="form-group">
							<label class="control-label" for="nemail">Email</label>
							<input type="email" name="email" class="form-control" id="nemail" required>
						</div>
						<div class="form-group">
							<input type="hidden" name="id" class="form-control" id="id" required readonly>
							<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
						</div>
						<?php echo form_close(); ?>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
<script type="text/javascript">
	//Edit
	function edit(iduser) {
		$.ajax({
			url: "<?php echo site_url('Admin/User/edit'); ?>",
			type: "post",
			dataType: 'json',
			data: {
				id: iduser
			},
			cache: false,
			success: function(result) {
				$('#id').val(result['id_user']);
				$('#nama').val(result['nama']);
				$('#userid').val(result['username']);
				$('#nemail').val(result['email']);
			}
		});
	}
	// Hapus
	$(document).ready(function() {
		$('.confirm_delete').on('click', function() {

			var delete_url = $(this).attr('data-url');

			swal({
				title: "Hapus User",
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