<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_auth extends CI_Model {

	function cek_user($username,$table){
		$this->db->where('username',$username);
		return $this->db->get($table);
		//syntax query rawnya sama dengan SELECT * FROM user WHERE username=$username
		//return fungsinya untuk mengembalikan nilai dari model ke controller
		//$username didapatkan dari controller cek di $cek
		//$table adalah inisiasi dari nama tabel yg diinputkan di controller cek di $cek
	}

	function create_account($data,$table){
		$this->db->insert($table,$data);
	}
	
	function cek_email($email,$table){
		$this->db->where('email',$email);
		return $this->db->get($table);
	}
	
	function cek_token($token,$table){
		$this->db->where('token',$token);
		return $this->db->get($table);
	}

	function create_token($data,$table){
		$this->db->insert($table,$data);
	}

	function ambil_token($email,$table){
		$this->db->where('email',$email);
		return $this->db->get($table)->row_array();
	}
}

/* End of file M_auth.php */
/* Location: ./application/models/M_auth.php */