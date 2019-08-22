<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_kebutuhan extends CI_Model {

	function list_kebutuhan($table){
		return $this->db->get($table);
	}

	function cek($kebutuhan,$table){
		$this->db->where('nama_kebutuhan',$kebutuhan);
		return $this->db->get($table);
	}

	function create($data,$table){
		$this->db->insert($table,$data);
	}

	function get($id,$table){
		$this->db->where('id_kebutuhan',$id);
		return $this->db->get($table)->row_array();
	}

	function replace($where,$data,$table){
		$this->db->where($where);
		$this->db->update($table,$data);
	}

	function trash($where,$table){
		$this->db->where($where);
		$this->db->delete($table);
	}

}

/* End of file M_kebutuhan.php */
/* Location: ./application/models/M_kebutuhan.php */