<div class="content-wrapper" id="edit">
	<section class="content-header">
		<h1>Edit Pengajuan</h1>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box">
					<div class="box-body">
						<?php echo form_open('Peneliti/Pengajuan/update') ?>
						<div class="form-group">
							<label class="control-label" for="Judul">Judul Penelitian</label>
							<input type="text" name="judul" class="form-control" id="judul" value="<?php echo $pemesanan['judul_penelitian'] ?>">
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label class="control_label">Tanggal Penggunaan</label>
										<input type="text" class="form-control pull-right datepicker" name="tanggal" placeholder="yyyy-mm-dd" value="<?php echo $pemesanan['tgl_penelitian'] ?>" required>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label class="control-label" for="komoditas">Komoditas</label>
										<select name="komoditas" class="form-control" style="width: 100%" id="komoditas">
											<option>-- Pilih Komoditas --</option>
											<?php foreach ($komoditas as $k) { ?>
												<option value="<?php echo $k->id_komoditas ?>" <?php if ($k->id_komoditas == $pemesanan['id_komoditas']) {
																									echo "selected";
																								} ?>>
													<?php echo $k->nama_komoditas ?>
												</option>
											<?php } ?>
										</select>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label class="control-label" for="lokasi">Lokasi</label>
										<select name="lokasi" class="form-control lokasi" style="width: 100%">
											<option>-- Pilih Lokasi --</option>
										</select>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label class="control-label" for="luas">Luas (m<sup>2</sup>)</label>
										<input type="text" name="luas" class="form-control" id="luas" placeholder="" value="<?php echo $pemesanan['luas_pakai'] ?>">
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label class="control_label">Tanggal Penyemaian</label>
										<input type="text" class="form-control pull-right datepicker" name="tsemai" placeholder="yyyy-mm-dd" value="<?php echo $detail_kegiatan['semai'] ?>">
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label class="control_label">Tanggal Pindah Tanam</label>
										<input type="text" class="form-control pull-right datepicker" name="tpindah" placeholder="yyyy-mm-dd" value="<?php echo $detail_kegiatan['pindah'] ?>">
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label class="control_label">Tanggal Pengolahan Lahan</label>
										<input type="text" class="form-control pull-right datepicker" name="tpengolahan" placeholder="yyyy-mm-dd" value="<?php echo $detail_kegiatan['pengolahan'] ?>">
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label class="control_label">Tanggal Pemupukan-1</label>
										<input type="text" class="form-control pull-right datepicker" name="tpemupukan1" placeholder="yyyy-mm-dd" value="<?php echo $detail_kegiatan['pemupukan1'] ?>">
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label class="control_label">Tanggal Pemupukan-2</label>
										<input type="text" class="form-control pull-right datepicker" name="tpemupukan2" placeholder="yyyy-mm-dd" value="<?php echo $detail_kegiatan['pemupukan2'] ?>">
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label class="control_label">Tanggal Pemupukan-3</label>
										<input type="text" class="form-control pull-right datepicker" name="tpemupukan3" placeholder="yyyy-mm-dd" value="<?php echo $detail_kegiatan['pemupukan3'] ?>">
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label class="control_label">Tanggal Panen</label>
										<input type="text" class="form-control pull-right datepicker" name="tpanen" placeholder="yyyy-mm-dd" value="<?php echo $detail_kegiatan['panen'] ?>" required>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label class="control-label">Kebutuhan</label><br>
										<?php foreach ($kebutuhan as $k) { ?>
											<input type="checkbox" name="kebutuhan[]" class="flat-red" value="<?php echo $k->id_kebutuhan ?>"> <?php echo $k->nama_kebutuhan ?><br>
										<?php } ?>
										<input type="hidden" name="kebutuhan[]" class="flat-red" checked>
									</div>
								</div>
								<div class="col-md-8">
									<div class="form-group">
										<label class="control-label">Keterangan</label>
										<textarea class="textarea" style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" name="keterangan"><?php echo $pemesanan['keterangan'] ?></textarea>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<input type="hidden" name="id" class="form-control" value="<?php echo $pemesanan['id_pemesanan'] ?>" required readonly>
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
	//select lokasi
	$(document).ready(function() {
		$('#komoditas').hover(function() {
			var id = $(this).val();
			$.ajax({
				url: "<?php echo base_url() ?>Peneliti/Pengajuan/get_lokasi",
				method: "POST",
				data: {
					id: id
				},
				dataType: 'json',
				success: function(data) {
					var html = '';
					var i;
					for (i = 0; i < data.length; i++) {
						//html += '<option>'+data[i].nama_kabupaten+'</option>';
						html += '<option value=' + data[i].id_lokasi + '>' + data[i].nama_lokasi + '</option>';
					}
					$('.lokasi').html(html);
				}
			});
		});
	});
</script>