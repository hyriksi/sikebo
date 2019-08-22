<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kebutuhan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('logged_in') != TRUE){
			$notif = array(
				'status' => "gagal",
				'message' => "Silahkan login terlebih dahulu",
			);
			$this->session->set_flashdata($notif);
			redirect('login');
		}else{
			if($this->session->userdata('akses') != "admin"){
				$notif = array(
					'status' => "gagal",
					'message' => "Maaf anda tidak memiliki akses untuk ini !",
				);
				$this->session->set_flashdata($notif);
				redirect('Dashboard');
			}
		}
		$this->load->model('M_kebutuhan');
	}

	public function index()
	{
		$data['kebutuhan'] = $this->M_kebutuhan->list_kebutuhan('kebutuhan')->result();
		$this->load->view('dashboard/sidebar');
		$this->load->view('dashboard/admin/master/kebutuhan/index',$data);
		$this->load->view('dashboard/footer');
	}

	public function tambah(){
		$kebutuhan = $this->input->post('kebutuhan');

		$data = array('nama_kebutuhan' => $kebutuhan);
		$cek = $this->M_kebutuhan->cek($kebutuhan,'kebutuhan');

		if($cek->num_rows() > 0){
			$notif = array(
				'status' => "gagal",
				'message' => "Data gagal ditambahkan, kebutuhan ".$kebutuhan." sudah ada, silahkan cek kembali",
			);

			$this->session->set_flashdata($notif);
			redirect('Admin/Kebutuhan');
		}else{
			$notif = array(
				'status' => "berhasil",
				'message' => "Data berhasil disimpan",
			);

			$this->M_kebutuhan->create($data,'kebutuhan');
			$this->session->set_flashdata($notif);
			redirect('Admin/Kebutuhan');
		}
	}

	public function edit(){
		$id = $this->input->post('id');

		$result = $this->M_kebutuhan->get($id,'kebutuhan');

		echo json_encode($result);
	}

	public function update(){
		$kebutuhan = $this->input->post('kebutuhan');

		$where = array('id_kebutuhan' => $this->input->post('id'));
		$data = array('nama_kebutuhan' => $kebutuhan);

		$cek = $this->M_kebutuhan->cek($kebutuhan,'kebutuhan');

		if($cek->num_rows() > 0){
			$notif = array(
				'status' => "gagal",
				'message' => "Data gagal diperbarui, kebutuhan ".$kebutuhan." sudah ada, silahkan cek kembali",
			);

			$this->session->set_flashdata($notif);
			redirect('Admin/Kebutuhan'); 
		}else{
			$notif = array(
				'status' => "berhasil",
				'message' => "Data berhasil diperbarui",
			);

			$this->session->set_flashdata($notif);
			$this->M_kebutuhan->replace($where,$data,'kebutuhan');
			redirect('Admin/Kebutuhan');
		}
	}

	public function hapus($id){
		$notif = array(
			'status' => "berhasil",
			'message' => "Data berhasil dihapus",
		);
		$where = array('id_kebutuhan' => $id);

		$this->session->set_flashdata($notif);
		$this->M_kebutuhan->trash($where,'kebutuhan');
		redirect('Admin/Kebutuhan');
	}

}

/* End of file kebutuhan.php */
/* Location: ./application/controllers/Kebutuhan.php */