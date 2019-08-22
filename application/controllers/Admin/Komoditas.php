<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Komoditas extends CI_Controller
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
		} else {
			if ($this->session->userdata('akses') != "admin") {
				$notif = array(
					'status' => "gagal",
					'message' => "Maaf anda tidak memiliki akses untuk ini !",
				);
				$this->session->set_flashdata($notif);
				redirect('Dashboard');
			}
		}
		$this->load->model('M_komoditas');
	}

	public function index()
	{
		$data['komoditas'] = $this->M_komoditas->list_komoditas('komoditas')->result();
		$this->load->view('dashboard/sidebar');
		$this->load->view('dashboard/admin/master/komoditas/index', $data);
		$this->load->view('dashboard/footer');
	}

	public function tambah()
	{
		$komoditas = $this->input->post('komoditas');

		$data = array('nama_komoditas' => $komoditas);
		$cek = $this->M_komoditas->cek($komoditas, 'komoditas');

		if ($cek->num_rows() > 0) {
			$notif = array(
				'status' => "gagal",
				'message' => "Data gagal ditambahkan, komoditas " . $komoditas . " sudah ada, silahkan cek kembali",
			);

			$this->session->set_flashdata($notif);
			redirect('Admin/Komoditas');
		} else {
			$notif = array(
				'status' => "berhasil",
				'message' => "Data berhasil disimpan",
			);

			$this->M_komoditas->create($data, 'komoditas');
			$this->session->set_flashdata($notif);
			redirect('Admin/Komoditas');
		}
	}

	public function edit()
	{
		$id = $this->input->post('id');

		$result = $this->M_komoditas->ambil($id,'komoditas');

		echo json_encode($result);
	}


	public function update()
	{
		$id = $this->input->post('id');
		$komoditas = $this->input->post('komoditas');

		$where = array('id_komoditas' => $id);
		$data = array('nama_komoditas' => $komoditas);
		$notif = array(
			'status' => "berhasil",
			'message' => "komoditas berhasil diperbarui",
		);

		$this->session->set_flashdata($notif);
		$this->M_komoditas->replace($where, $data, 'komoditas');
		redirect('Admin/komoditas');
	}

	public function hapus($id)
	{
		$notif = array(
			'status' => "berhasil",
			'message' => "Data berhasil dihapus",
		);
		$where = array('id_komoditas' => $id);

		$this->session->set_flashdata($notif);
		$this->M_komoditas->trash($where, 'komoditas');
		redirect('Admin/Komoditas');
	}
}

/* End of file Komoditas.php */
/* Location: ./application/controllers/Komoditas.php */
