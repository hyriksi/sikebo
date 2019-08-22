<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_konfirmasi extends CI_Model
{

	function list_pengajuan($table)
	{
		$this->db->select('pemesanan.*,komoditas.nama_komoditas,user.nama,lokasi.nama_lokasi');
		$this->db->join('komoditas', 'komoditas.id_komoditas=pemesanan.id_komoditas');
		$this->db->join('lokasi', 'lokasi.id_lokasi=pemesanan.id_lokasi');
		$this->db->join('user', 'user.id_user=pemesanan.id_user');
		return $this->db->get($table);
	}

	function ambil($where, $table)
	{
		$this->db->where($where);
		return $this->db->get($table);
	}

	function ambil_kebutuhan($where, $table)
	{
		$this->db->select('detail_pemesanan.id_kebutuhan,kebutuhan.*');
		$this->db->join('kebutuhan', 'kebutuhan.id_kebutuhan=detail_pemesanan.id_kebutuhan');
		$this->db->where($where);
		return $this->db->get($table);
	}

	function ambil_pengajuan($where, $table)
	{
		$this->db->select('pemesanan.*,komoditas.nama_komoditas,user.nama,lokasi.*');
		$this->db->join('komoditas', 'komoditas.id_komoditas=pemesanan.id_komoditas');
		$this->db->join('user', 'user.id_user=pemesanan.id_user');
		$this->db->join('lokasi', 'lokasi.id_lokasi=pemesanan.id_lokasi');
		$this->db->where($where);
		return $this->db->get($table);
	}

	function replace($where, $status, $table)
	{
		$this->db->where($where);
		$this->db->update($table, $status);
	}
}

/* End of file M_konfirmasi.php */
/* Location: ./application/models/M_konfirmasi.php */
