<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Lokasi extends CI_Controller
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
		$this->load->model('M_lokasi');
		$this->load->model('M_komoditas');
	}

	public function index()
	{
		$data = array(
			'lokasi' => $this->M_lokasi->list_lokasi('lokasi')->result(),
			'komoditas' => $this->M_komoditas->list_komoditas('komoditas')->result(),
		);

		$this->load->view('dashboard/sidebar');
		$this->load->view('dashboard/admin/master/lokasi/index', $data);
		$this->load->view('dashboard/footer');
	}

	public function tambah()
	{
		$lokasi = $this->input->post('lokasi');
		$check = $this->input->post('komoditas[]');
		$jumlah = count($check);
		$luas = $this->input->post('luas');

		$cek = $this->M_lokasi->cek($lokasi, 'lokasi');

		if ($cek->num_rows() > 0) {
			$notif = array(
				'status' => "gagal",
				'notif' => "Lokasi gagal ditambahkan. " . $lokasi . " sudah ada",
			);

			$this->session->set_flashdata($notif);
			redirect('Admin/Lokasi');
		} else {

			$data = array(
				'nama_lokasi' => $lokasi,
				'luas' => $luas,
			);

			$idlokasi = $this->M_lokasi->create($data, 'lokasi');

			for ($i = 0; $i < $jumlah; $i++) {
				$detail[$i] = array(
					'id_lokasi' => $idlokasi,
					'id_komoditas' => $check[$i],
				);
			};

			if ($jumlah == 0) {
				$notif = array(
					'status' => "gagal",
					'message' => "Gagal ditambahkan. Pilih setidaknya satu komoditas",
				);
				$where = array('id_lokasi' => $idlokasi);

				$this->session->set_flashdata($notif);
				$this->M_lokasi->trash($where, 'lokasi');
				redirect('Admin/Lokasi');
			} else {
				$notif = array(
					'status' => "berhasil",
					'message' => "Lokasi berhasil ditambahkan",
				);

				$this->session->set_flashdata($notif);
				$this->M_lokasi->komoditas($detail, 'detail_lokasi');
				redirect('Admin/Lokasi');
			}
		}
	}

	public function edit($id)
	{
		$where = array('id_lokasi' => $id);
		$data = array(
			'lokasi' => $this->M_lokasi->ambil($where, 'lokasi')->row_array(),
			'komoditas' => $this->M_komoditas->list_komoditas('komoditas')->result(),
		);

		$this->load->view('dashboard/sidebar');
		$this->load->view('dashboard/admin/master/lokasi/edit', $data);
		$this->load->view('dashboard/footer');
	}

	public function update()
	{
		$id = $this->input->post('id');
		$lokasi = $this->input->post('lokasi');
		$luas = $this->input->post('luas');
		$check = $this->input->post('komoditas[]');
		$jumlah = count($check);

		$where = array('id_lokasi' => $id);
		$data = array(
			'nama_lokasi' => $lokasi,
			'luas' => $luas,
		);

		for ($i = 0; $i < $jumlah; $i++) {
			$detail[$i] = array(
				'id_lokasi' => $id,
				'id_komoditas' => $check[$i],
			);
			// var_dump($detail);
		};
		if ($jumlah == 0) {
			$notif = array(
				'status' => "gagal",
				'message' => "Gagal diperbarui. Pilih setidaknya satu komoditas!",
			);
			$where = array('id_lokasi' => $idlokasi);

			$this->session->set_flashdata($notif);
			redirect('Admin/Lokasi');
		} else {
			$notif = array(
				'status' => "berhasil",
				'message' => "Lokasi berhasil diperbarui",
			);

			$this->session->set_flashdata($notif);
			$this->M_lokasi->trash($where, 'detail_lokasi');
			$this->M_lokasi->replace($where, $data, 'lokasi');
			$this->M_lokasi->komoditas($detail, 'detail_lokasi');
			redirect('Admin/Lokasi');
		}
	}

	public function hapus($id)
	{
		$notif = array(
			'status' => "berhasil",
			'message' => "Lokasi berhasil dihapus",
		);
		$where = array('id_lokasi' => $id);

		$this->session->set_flashdata($notif);
		$this->M_lokasi->trash($where, 'detail_lokasi');
		$this->M_lokasi->trash($where, 'lokasi');
		redirect('Admin/Lokasi');
	}
}

/* End of file Lokasi.php */
/* Location: ./application/controllers/Lokasi.php */
