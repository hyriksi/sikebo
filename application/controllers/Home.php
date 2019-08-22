<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->load->view('login');
	}

	public function forgotPassword()
	{
		$this->load->view('forgot-password');
	}

	public function changePassword()
	{
		$this->load->view('change-password');
	}
}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */