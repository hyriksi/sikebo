<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_lokasi extends CI_Model
{

	function list_lokasi($table)
	{
		$this->db->select('lokasi.*,detail_lokasi.*,komoditas.nama_komoditas');
		$this->db->join('detail_lokasi', 'detail_lokasi.id_lokasi=lokasi.id_lokasi');
		$this->db->join('komoditas','komoditas.id_komoditas=detail_lokasi.id_komoditas');
		return $this->db->get($table);
	}

	function cek($lokasi, $table)
	{
		$this->db->where('nama_lokasi', $lokasi);
		return $this->db->get($table);
	}

	function create($data, $table)
	{
		$this->db->insert($table, $data);
		return $this->db->insert_id();
	}
	
	function komoditas($detail,$table)
	{
		$this->db->insert_batch($table,$detail);
	}

	function ambil($where, $table)
	{
		$this->db->where($where);
		return $this->db->get($table);
	}

	function replace($where, $data, $table)
	{
		$this->db->where($where);
		$this->db->update($table, $data);
	}

	function trash($where, $table)
	{
		$this->db->where($where);
		$this->db->delete($table);
	}

}

/* End of file M_lokasi.php */
/* Location: ./application/models/M_lokasi.php */
