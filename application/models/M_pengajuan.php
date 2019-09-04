<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_pengajuan extends CI_Model
{

	function list_pengajuan_user($table)
	{
		$this->db->select('pemesanan.*,komoditas.nama_komoditas,user.nama, lokasi.nama_lokasi');
		$this->db->join('komoditas', 'komoditas.id_komoditas=pemesanan.id_komoditas');
		$this->db->join('lokasi', 'lokasi.id_lokasi=pemesanan.id_lokasi');
		$this->db->join('user', 'user.id_user=pemesanan.id_user');
		$this->db->where('pemesanan.id_user', $this->session->userdata('id'));
		return $this->db->get($table);
	}

	function cek_1($lokasi, $tanggal, $panen)
	{
		$status = "ditolak";
		$this->db->join('detail_kegiatan', 'detail_kegiatan.id_pemesanan=pemesanan.id_pemesanan');
		$this->db->where('pemesanan.id_lokasi', $lokasi);
		$this->db->where('pemesanan.status_pemesanan !=', $status);
		$this->db->where('pemesanan.tgl_penelitian >=', $tanggal);
		$this->db->where('pemesanan.tgl_penelitian <=', $panen);
		return $this->db->get('pemesanan');
	}

	function cek_2($lokasi, $tanggal, $panen)
	{
		$status = "ditolak";
		$this->db->join('detail_kegiatan', 'detail_kegiatan.id_pemesanan=pemesanan.id_pemesanan');
		$this->db->where('pemesanan.id_lokasi', $lokasi);
		$this->db->where('pemesanan.status_pemesanan !=', $status);
		$this->db->where('detail_kegiatan.panen >=', $tanggal);
		$this->db->where('detail_kegiatan.panen <=', $panen);
		return $this->db->get('pemesanan');
	}

	function cek_3($lokasi, $tanggal)
	{
		$status = "ditolak";
		$this->db->join('detail_kegiatan', 'detail_kegiatan.id_pemesanan=pemesanan.id_pemesanan');
		$this->db->where('pemesanan.id_lokasi', $lokasi);
		$this->db->where('pemesanan.status_pemesanan !=', $status);
		$this->db->where('pemesanan.tgl_penelitian <=', $tanggal);
		$this->db->where('detail_kegiatan.panen >=', $tanggal);
		return $this->db->get('pemesanan');
	}

	function cek_4($lokasi, $panen)
	{
		$status = "ditolak";
		$this->db->join('detail_kegiatan', 'detail_kegiatan.id_pemesanan=pemesanan.id_pemesanan');
		$this->db->where('pemesanan.id_lokasi', $lokasi);
		$this->db->where('pemesanan.status_pemesanan !=', $status);
		$this->db->where('pemesanan.tgl_penelitian <=', $panen);
		$this->db->where('detail_kegiatan.panen >=', $panen);
		return $this->db->get('pemesanan');
	}

	function ambil_lokasi($id)
	{
		$this->db->select('lokasi.*,komoditas.*,detail_lokasi.*');
		$this->db->join('detail_lokasi', 'detail_lokasi.id_lokasi=lokasi.id_lokasi');
		$this->db->join('komoditas', 'komoditas.id_komoditas=detail_lokasi.id_komoditas');
		$this->db->where('detail_lokasi.id_komoditas', $id);
		return $this->db->get('lokasi')->result();
	}

	function ambil($where, $table)
	{
		$this->db->where($where);
		return $this->db->get($table);
	}

	function code()
	{
		$this->db->select('Right(pemesanan.id_pemesanan,4) as kode ', false);
		$this->db->order_by('id_pemesanan', 'desc');
		$this->db->limit(1);
		$query = $this->db->get('pemesanan');
		if ($query->num_rows() <> 0) {
			$data = $query->row();
			$kode = intval($data->kode) + 1;
		} else {
			$kode = 1;
		}
		$kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT);
		$kodejadi  = "PES-" . $kodemax;
		return $kodejadi;
	}

	function pemesanan($pemesanan, $table)
	{
		$this->db->insert($table, $pemesanan);
	}

	function kebutuhan($detail, $table)
	{
		$this->db->insert_batch($table, $detail);
	}

	function kegiatan($kegiatan, $table)
	{
		$this->db->insert($table, $kegiatan);
	}

	function replace($where, $pemesanan, $table)
	{
		$this->db->where($where);
		$this->db->update($table, $pemesanan);
	}

	function replace_kegiatan($where, $kegiatan, $table)
	{
		$this->db->where($where);
		$this->db->update($table, $kegiatan);
	}

	function trash_lokasi($where, $n)
	{
		$this->db->where($where);
		$this->db->update('pemesanan', $n);
	}

	function trash($where, $table)
	{
		$this->db->where($where);
		$this->db->delete($table);
	}
}

/* End of file M_pengajuan.php */
/* Location: ./application/models/M_pengajuan.php */
