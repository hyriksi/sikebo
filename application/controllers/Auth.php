<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_auth');
	}

	public function login()
	{
		$username = $this->input->post('username');
		$pass = $this->input->post('password');

		$cek = $this->M_auth->cek_user($username, 'user');
		if ($cek->num_rows() > 0) {
			$r = $cek->row();
			if (password_verify($pass, $r->password)) {
				$session = array(
					'id' => $r->id_user,
					'nama' => $r->nama,
					'username' => $r->username,
					'akses' => $r->akses,
					'path' => $r->path,
					'logged_in' => TRUE,
				);

				$this->session->set_userdata($session); //deklarasi session
				redirect('Dashboard'); //mengalihkan ke controller dashboard
			} else { //jika password salah
				$notif = array(
					'status' => "gagal",
					'message' => "Password Salah !",
				);
				$this->session->set_flashdata($notif);
				redirect('Home');
			}
		} else { //jika username tidak ada
			$notif = array(
				'status' => "gagal",
				'message' => "Maaf Username " . $username . " Tidak terdaftar, silahkan hubungi pihak admin",
			);
			$this->session->set_flashdata($notif);
			redirect('Home');
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('login');
	}

	private function _sendEmail($token, $type)
	{
		$config = [
			'protocol' => 'smtp',
			'smtp_host' => 'ssl://smtp.googlemail.com',
			'smtp_user' => 'sikebo.buncob@gmail.com',
			'smtp_pass' => 'sikebo123',
			'smtp_port' => 465,
			'mailtype' => 'html',
			'charset' => 'utf-8',
			'newline' => "\r\n"
		];

		$this->email->initialize($config);

		$this->email->from('sikebo.buncob@gmail.com', 'SIKEBO');
		$this->email->to($this->input->post('email'));

		if ($type == 'forgot') {
			$this->email->subject('Reset Password');
			$this->email->message('Klik link berikut ini untuk mengatur ulang password : <a href="' . base_url() . 'auth/resetpassword?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Reset Password</a>');
		}

		$this->email->send();
	}

	public function forgotPassword()
	{
		$email = $this->input->post('email');

		$cek = $this->M_auth->cek_email($email, 'user');
		if ($cek->num_rows() > 0) {
			$notif = array(
				'status' => "berhasil",
				'message' => "Berhasil, Silahkan periksa email Anda!"
			);
			$token = base64_encode(random_bytes(32));
			$user_token = [
				'email' => $email,
				'token' => $token,
				'date_created' => time()
			];

			$this->M_auth->create_token($user_token, 'user_token');

			$this->_sendEmail($token, 'forgot');
			$this->session->set_flashdata($notif);
			redirect('Home/forgotPassword');
		} else {
			$notif = array(
				'status' => "gagal",
				'message' => "Mohon maaf, Email tidak terdaftar.",
			);
			$this->session->set_flashdata($notif);
			redirect('Home/forgotPassword');
		}
	}

	public function resetPassword()
	{
		$email = $this->input->get('email');
		$token = $this->input->get('token');

		$cekemail = $this->M_auth->cek_email($email, 'user');
		$cektoken = $this->M_auth->cek_token($token, 'user_token');

		if ($cekemail->num_rows() > 0) {
			$user_token = $this->M_auth->ambil_token($email, 'user_token');

			if ($cektoken->num_rows() > 0) {

				if (time() - $user_token['date_created'] < (60 * 60 * 12)) {
					$this->session->set_userdata('reset_email', $email);
					redirect('Home/changePassword');
				} else {
					$this->db->delete('user_token', ['email' => $email]);

					$notif = array(
						'status' => "gagal",
						'message' => "Reset Password gagal! Token salah atau tidak berlaku.",
					);
					$this->session->set_flashdata($notif);
					redirect('Home');
				}
			} else {
				$notif = array(
					'status' => "gagal",
					'message' => "Reset Password gagal! Token salah atau sudah tidak berlaku.",
				);
				$this->session->set_flashdata($notif);
				redirect('Home');
			}
		} else {
			$notif = array(
				'status' => "gagal",
				'message' => "Reset Password gagal! Email salah.",
			);
			$this->session->set_flashdata($notif);
			redirect('Home');
		}
	}

	public function changePassword()
	{
		if (!$this->session->userdata('reset_email')) {
			redirect('Home');
		}

		$pass1 = $this->input->post('password1');
		$pass2 = $this->input->post('password2');

		if ($pass1 != $pass2) {
			$notif = array(
				'status' => "gagal",
				'message' => "Reset Password gagal. Ulangi password dengan benar!",
			);
			$this->session->set_flashdata($notif);
			redirect('Home/changePassword');
		} else {
			$pass1 = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
			$email = $this->session->userdata('reset_email');

			$this->db->set('password', $pass1);
			$this->db->where('email', $email);
			$this->db->update('user');

			$this->session->unset_userdata('reset_email');
			$this->db->delete('user_token', ['email' => $email]);

			$notif = array(
				'status' => "berhasil",
				'message' => "Reset Password berhasil. silahkan login!",
			);
			$this->session->set_flashdata($notif);
			redirect('Home');
		}
	}
}

/* End of file Auth.php */
/* Location: ./application/controllers/Auth.php */
