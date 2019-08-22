<div class="content-wrapper">
	<section class="content-header">
		<h1>Daftar Kebutuhan</h1>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<?php if($this->session->flashdata('status') == "gagal"){ ?>
				<div class="alert alert-danger"><?php echo $this->session->flashdata('message') ?></div>
				<?php } ?>
				<?php if($this->session->flashdata('status') == "berhasil"){ ?>
				<div class="alert alert-success"><?php echo $this->session->flashdata('message') ?></div>
				<?php } ?>
				<div class="box">
					<div class="box-header">
						<a href="#" class="btn btn-success" data-toggle="modal" data-target="#tambah"><i class="fa fa-plus"></i></a>
					</div>
					<div class="box-body">
						<table class="table table-bordered table-striped" id="table">
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th class="text-center">Nama Kebutuhan</th>
									<th class="text-center">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php $no=1; foreach($kebutuhan as $k){ ?>
								<tr>
									<td class="text-center"><?php echo $no++ ?></td>
									<td><?php echo $k->nama_kebutuhan ?></td>
									<td class="text-center">
										<a href="#" data-toggle="modal" data-target="#edit" class="btn btn-info btn-xs" onclick="edit(<?php echo $k->id_kebutuhan ?>)"><i class="fa fa-edit"></i></a>
										<a href="#" data-url="<?php echo site_url('Admin/Kebutuhan/hapus/'.$k->id_kebutuhan) ?>" class="btn btn-danger btn-xs confirm_delete"><i class="fa fa-trash"></i></a>
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
						<h4>Form Tambah Kebutuhan</h4>
						<button type="button" data-dismiss="modal" class="close"><i class="fa fa-times"></i></button>
					</div>
					<div class="modal-body">
						<?php echo form_open('Admin/Kebutuhan/tambah') ?>
							<div class="form-group">
								<label class="control-label" for="kebutuhan">Nama Kebutuhan</label>
								<input type="text" name="kebutuhan" class="form-control" id="kebutuhan" required autofocus>
							</div>
							<div class="form-group">
								<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
							</div>
						<?php echo form_close() ?>
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
						<h4>Form Edit</h4>
					</div>
					<div class="modal-body">
						<?php echo form_open('Admin/Kebutuhan/update') ?>
						<div class="form-group">
							<label class="control-label" for="nam">Nama Kebutuhan</label>
							<input type="text" name="kebutuhan" class="form-control" id="nama" required autofocus>
						</div>
						<div class="form-group">
							<label class="control-label" for="id"></label>
							<input type="hidden" name="id" class="form-control" id="id" required readonly>
							<button type="submit" class="btn btn-info"><i class="fa fa-save"></i> Simpan</button>
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
	function edit(idkebutuhan){
        $.ajax({
            url:"<?php echo site_url('Admin/Kebutuhan/edit');?>",
            type:"post",
            dataType: 'json',
            data:{id:idkebutuhan},
            cache:false,
            success:function(result){
              $('#id').val(result['id_kebutuhan']);
              $('#nama').val(result['nama_kebutuhan']);
            }
        });
     }
    // Hapus
    $(document).ready(function(){
     	$('.confirm_delete').on('click', function(){
        
	        var delete_url = $(this).attr('data-url');

	        swal({
	          title: "Hapus Kebutuhan",
	          text: "Yakin ingin menghapus ?",
	          type: "warning",
	          showCancelButton: true,
	          confirmButtonColor: "#FA041B",
	          confirmButtonText: "Hapus !",
	          cancelButtonText: "Batalkan",
	          closeOnConfirm: false     
	        }, function(){
	          window.location.href = delete_url;
	        });

	        return false;
      	});
    });
</script>