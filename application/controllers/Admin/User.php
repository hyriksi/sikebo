<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller
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

		$this->load->model('M_user');
	}

	public function index()
	{
		$data['user'] = $this->M_user->list_user('user')->result();

		$this->load->view('dashboard/sidebar');
		$this->load->view('dashboard/admin/user/index', $data);
		$this->load->view('dashboard/footer');
	}

	public function tambah()
	{
		$nama = $this->input->post('nama');
		$username = $this->input->post('username');
		$email = $this->input->post('email');
		$password = $this->input->post('password');

		$cek = $this->M_user->cek($username, 'user');

		if ($cek->num_rows() > 0) {
			$notif = array(
				'status' => "gagal",
				'message' => "Data gagal ditambahkan. Username " . $username . " sudah terdaftar",
			);

			$this->session->set_flashdata($notif);
			redirect('Admin/User');
		} else {
			$notif = array(
				'status' => "berhasil",
				'message' => "Data berhasil ditambahkan",
			);
			$data = array(
				'nama' => $nama,
				'username' => $username,
				'email' => $email,
				'password' => password_hash($password, PASSWORD_BCRYPT),
				'path' => "default.png",
				'akses' => "peneliti",
			);

			$this->session->set_flashdata($notif);
			$this->M_user->create($data, 'user');
			redirect('Admin/User');
		}
	}

	public function edit()
	{
		$id = $this->input->post('id');
		$result = $this->M_user->ambil($id, 'user');

		echo json_encode($result);
	}

	public function update()
	{
		$nama = $this->input->post('nama');
		$username = $this->input->post('username');
		$email = $this->input->post('email');
		$id = $this->input->post('id');

		
			$notif = array(
				'status' => "berhasil",
				'message' => "Data berhasil diperbarui",
			);
			$where = array('id_user' => $id);
			$data = array(
				'nama' => $nama,
				'username' => $username,
				'email' => $email,
			);

			// var_dump($data);

			$this->session->set_flashdata($notif);
			$this->M_user->replace($where, $data, 'user');
			redirect('Admin/User');
	}

	public function hapus($id)
	{
		$where = array('id_user' => $id);
		$notif = array(
			'status' => "berhasil",
			'message' => "Data berhasil dihapus",
		);

		$this->session->set_flashdata($notif);
		$this->M_user->trash($where, 'user');
		redirect('Admin/User');
	}
}

/* End of file User.php */
/* Location: ./application/controllers/User.php */
