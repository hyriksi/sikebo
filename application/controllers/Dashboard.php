<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('logged_in') != TRUE) {
			$notif = array(
				'status' => "gagal",
				'message' => "Silahkan login terlebih dahulu",
			);
			$this->session->set_flashdata($notif);
			redirect('login');
		}

		$this->load->model('M_dashboard');
	}

	public function index()
	{
		$datenow = date('y-m-d');
		$data['lokasi'] = $this->M_dashboard->lokasi_digunakan($datenow);
		$data['pengajuan'] = $this->M_dashboard->list_pengajuan('pemesanan')->result();

		$this->load->view('dashboard/sidebar');
		$this->load->view('dashboard/index', $data);
		$this->load->view('dashboard/footer');
	}
}

/* End of file Dashboard.php */
/* Location: ./application/controllers/Dashboard.php */
