<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_user extends CI_Model {

	function list_user($table){
		$this->db->not_like('akses','admin');
		return $this->db->get($table);
	}

	function cek($username,$table){
		$this->db->where('username',$username);
		return $this->db->get($table);
	}

	function create($data,$table){
		$this->db->insert($table,$data);
	}

	function ambil($id,$table){
		$this->db->where('id_user',$id);
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

/* End of file M_user.php */
/* Location: ./application/models/M_user.php */