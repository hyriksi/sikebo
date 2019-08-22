<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_komoditas extends CI_Model
{

	function list_komoditas($table)
	{
		return $this->db->get($table);
	}

	function cek($komoditas, $table)
	{
		$this->db->where('nama_komoditas', $komoditas);
		return $this->db->get($table);
	}

	function create($data, $table)
	{
		$this->db->insert($table, $data);
	}

	function ambil($id, $table)
	{
		$this->db->where('id_komoditas', $id);
		return $this->db->get($table)->row_array();
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

/* End of file M_komoditas.php */
/* Location: ./application/models/M_komoditas.php */
