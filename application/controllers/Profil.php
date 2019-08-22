<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profil extends CI_Controller {

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
		}

		$this->load->model('M_profil');
	}

	public function index($id)
	{
		$data['profil'] = $this->M_profil->data($id,'user');

		$this->load->view('dashboard/sidebar');
		$this->load->view('dashboard/profil',$data);
		$this->load->view('dashboard/footer');
	}

	public function update_data(){
		$id = $this->session->userdata('id');
		$nama = $this->input->post('nama');
		$username = $this->input->post('username');
		$email = $this->input->post('email');

		$data = array(
			'nama' => $nama,
			'username' => $username,
			'email' => $email
		);
		$notif = array(
			'status' => "berhasil",
			'message' => "Profil berhasil diperbarui",
		);

		$this->session->set_flashdata($notif);
		$this->M_profil->replace_data($id,$data,'user');
		$this->session->set_userdata($data);
		redirect('profil/'.$username);
	}

	public function update_pict(){
		$id = $this->session->userdata('id');
		$img = $_FILES['gambar']['name'];

		$config['upload_path'] = 'assets/img/profil/';
		$config['allowed_types'] = 'jpg|png|jpeg';
		$config['file_name'] = $this->session->userdata('username');
		$config['overwrite'] = TRUE;
		$config['remove_spaces'] = TRUE;
		$config['file_ext_tolower'] = TRUE;

		$this->load->library('upload',$config);

		if(!$this->upload->do_upload('gambar')){
			$notif = array(
				'status' => "gagal",
				'message' => $this->upload->display_errors(),
			);

			$this->session->set_flashdata($notif);
			redirect('profil/'.$this->session->userdata('username'));
		}else{
			$data = array('path' => $this->upload->data('file_name'));
			$notif = array(
				'status' => "berhasil",
				'message' => "Foto profil berhasil diperbarui",
			);

			$this->session->set_flashdata($notif);
			$this->M_profil->replace_pict($id,$data,'user');
			$this->session->set_userdata($data);
			redirect('profil/'.$this->session->userdata('username'));
		}
	}

	public function update_pass(){
		$id = $this->session->userdata('id');
		$pass = $this->input->post('password');

		$data = array('password' => password_hash($pass, PASSWORD_BCRYPT));
		$notif = array(
			'status' => "berhasil",
			'message' => "Password berhasil diperbarui",
		);

		$this->session->set_flashdata($notif);
		$this->M_profil->replace_pass($id,$data,'user');
		redirect('profil/'.$this->session->userdata('username'));
	}

}

/* End of file Profil.php */
/* Location: ./application/controllers/Profil.php */