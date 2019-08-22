<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_profil extends CI_Model {

	function data($id,$table){
		$this->db->where('username',$id);
		return $this->db->get($table)->row_array();
	}

	function replace_data($id,$data,$table){
		$this->db->where('id_user',$id);
		$this->db->update($table,$data);
	}

	function replace_pict($id,$data,$table){
		$this->db->where('id_user',$id);
		$this->db->update($table,$data);
	}

	function replace_pass($id,$data,$table){
		$this->db->where('id_user',$id);
		$this->db->update($table,$data);
	}

}

/* End of file M_profil.php */
/* Location: ./application/models/M_profil.php */