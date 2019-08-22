<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Konfirmasi extends CI_Controller
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

		$this->load->model('M_konfirmasi');
		$this->load->model('M_pengajuan');
		$this->load->model('M_kebutuhan');
		$this->load->model('M_komoditas');
		$this->load->model('M_user');
	}

	public function index()
	{
		$data['pengajuan'] = $this->M_konfirmasi->list_pengajuan('pemesanan')->result();

		$this->load->view('dashboard/sidebar');
		$this->load->view('dashboard/admin/konfirmasi/index', $data);
		$this->load->view('dashboard/footer');
	}

	public function tinjau($id)
	{
		$where = array('id_pemesanan' => $id);

		$data = array(
			'pemesanan' => $this->M_konfirmasi->ambil_pengajuan($where, 'pemesanan')->row_array(),
			'detail_pemesanan' => $this->M_konfirmasi->ambil_kebutuhan($where, 'detail_pemesanan')->result(),
			'detail_kegiatan' => $this->M_pengajuan->ambil($where, 'detail_kegiatan')->row_array(),
		);
		// var_dump($data['detail_pemesanan']);

		$this->load->view('dashboard/sidebar');
		$this->load->view('dashboard/admin/konfirmasi/tinjau', $data);
		$this->load->view('dashboard/footer');
	}

	public function terima()
	{
		$id = $this->input->post('id');

		$where['id_pemesanan'] = $id;
		$status['status_pemesanan'] = "diterima";
		// var_dump($status);
		$notif = array(
			'status' => "berhasil",
			'message' => "Pengajuan berhasil disetujui.",
		);

		$this->session->set_flashdata($notif);
		$this->M_konfirmasi->replace($where, $status, 'pemesanan');
		redirect('Admin/Konfirmasi');
	}

	public function tolak()
	{
		$id = $this->input->post('id');

		$where['id_pemesanan'] = $id;
		$status['status_pemesanan'] = "ditolak";

		$notif = array(
			'status' => "berhasil",
			'message' => "Pengajuan berhasil ditolak.",
		);

		$this->session->set_flashdata($notif);
		$this->M_konfirmasi->replace($where, $status, 'pemesanan');
		redirect('Admin/Konfirmasi');
	}
}

/* End of file Konfirmasi.php */
/* Location: ./application/controllers/Konfirmasi.php */
