<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pengajuan extends CI_Controller
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

		$this->load->model('M_pengajuan');
		$this->load->model('M_kebutuhan');
		$this->load->model('M_komoditas');
		$this->load->model('M_konfirmasi');
	}

	public function index()
	{
		$data['pengajuan'] = $this->M_pengajuan->list_pengajuan_user('pemesanan')->result();

		$this->load->view('dashboard/sidebar');
		$this->load->view('dashboard/peneliti/pengajuan/index', $data);
		$this->load->view('dashboard/footer');
	}

	public function buat()
	{
		$data = array(
			'komoditas' => $this->M_komoditas->list_komoditas('komoditas')->result(),
			'kebutuhan' => $this->M_kebutuhan->list_kebutuhan('kebutuhan')->result(),
		);

		$this->load->view('dashboard/sidebar');
		$this->load->view('dashboard/peneliti/pengajuan/create', $data);
		$this->load->view('dashboard/footer');
	}

	function get_lokasi()
	{
		$id = $this->input->post('id');
		$data = $this->M_pengajuan->ambil_lokasi($id);

		echo json_encode($data);
	}

	private function _notifFail()
	{
		$notif = array(
			'status' => "gagal",
			'message' => "Mohon maaf, lokasi yang anda pilih tidak tersedia.",
		);
		$this->session->set_flashdata($notif);
		$this->load->view('dashboard/sidebar');
		$this->load->view('dashboard/peneliti/pengajuan/lokasierror');
		$this->load->view('dashboard/footer');
	}

	public function tambah()
	{
		$judul = $this->input->post('judul');
		$tanggal = $this->input->post('tanggal');
		$lokasi = $this->input->post('lokasi');
		$komoditas = $this->input->post('komoditas');
		$luas = $this->input->post('luas');
		$check = $this->input->post('kebutuhan[]');
		$jumlah = count($check);
		$semai = $this->input->post('tsemai');
		$pindah = $this->input->post('tpindah');
		$pengolahan = $this->input->post('tpengolahan');
		$pemupukan1 = $this->input->post('tpemupukan1');
		$pemupukan2 = $this->input->post('tpemupukan2');
		$pemupukan3 = $this->input->post('tpemupukan3');
		$panen = $this->input->post('tpanen');
		$keterangan = $this->input->post('keterangan');

		// var_dump($cek);
		// die;
		$cek = $this->M_pengajuan->cek_1($lokasi, $tanggal, $panen);
		if ($cek->num_rows() > 0) {
			$this->_notifFail();
		} else {
			$cek = $this->M_pengajuan->cek_2($lokasi, $tanggal, $panen);
			if ($cek->num_rows() > 0) {
				$this->_notifFail();
			} else {
				$cek = $this->M_pengajuan->cek_3($lokasi, $tanggal);
				if ($cek->num_rows() > 0) {
					$this->_notifFail();
				} else {
					$cek = $this->M_pengajuan->cek_4($lokasi, $panen);
					if ($cek->num_rows() > 0) {
						$this->_notifFail();
					} else {
						$pemesanan = array(
							'id_pemesanan' => $this->M_pengajuan->code(),
							'id_user' => $this->session->userdata('id'),
							'id_lokasi' => $lokasi,
							'luas_pakai' => $luas,
							'judul_penelitian' => $judul,
							'tgl_penelitian' => $tanggal,
							'id_komoditas' => $komoditas,
							'status_pemesanan' => "pending",
							'keterangan' => $keterangan,
						);

						for ($i = 0; $i < $jumlah; $i++) {
							$detail[$i] = array(
								'id_pemesanan' => $this->M_pengajuan->code(),
								'id_kebutuhan' => $check[$i],
							);
						}

						$kegiatan = array(
							'id_pemesanan' => $this->M_pengajuan->code(),
							'semai' => $semai,
							'pindah' => $pindah,
							'pengolahan' => $pengolahan,
							'pemupukan1' => $pemupukan1,
							'pemupukan2' => $pemupukan2,
							'pemupukan3' => $pemupukan3,
							'panen' => $panen,
						);

						$this->M_pengajuan->pemesanan($pemesanan, 'pemesanan');
						$this->M_pengajuan->kebutuhan($detail, 'detail_pemesanan');
						$this->M_pengajuan->kegiatan($kegiatan, 'detail_kegiatan');
						$notif = array(
							'status' => "berhasil",
							'message' => "Pengajuan berhasil dikirim dan akan ditinjau oleh Admin.",
						);
						$this->session->set_flashdata($notif);
						redirect('Peneliti/Pengajuan');
					}
				}
			}
		}
	}

	public function edit($id)
	{
		$where = array('id_pemesanan' => $id);
		$data = array(
			'pemesanan' => $this->M_pengajuan->ambil($where, 'pemesanan')->row_array(),
			'detail_pemesanan' => $this->M_pengajuan->ambil($where, 'detail_pemesanan')->result(),
			'detail_kegiatan' => $this->M_pengajuan->ambil($where, 'detail_kegiatan')->row_array(),
			'komoditas' => $this->M_komoditas->list_komoditas('komoditas')->result(),
			'kebutuhan' => $this->M_kebutuhan->list_kebutuhan('kebutuhan')->result(),
		);

		$this->load->view('dashboard/sidebar');
		$this->load->view('dashboard/peneliti/pengajuan/edit', $data);
		$this->load->view('dashboard/footer');
	}

	public function update()
	{
		$id = $this->input->post('id');
		$judul = $this->input->post('judul');
		$tanggal = $this->input->post('tanggal');
		$lokasi = $this->input->post('lokasi');
		$komoditas = $this->input->post('komoditas');
		$luas = $this->input->post('luas');
		$check = $this->input->post('kebutuhan[]');
		$jumlah = count($check);
		$semai = $this->input->post('tsemai');
		$pindah = $this->input->post('tpindah');
		$pengolahan = $this->input->post('tpengolahan');
		$pemupukan1 = $this->input->post('tpemupukan1');
		$pemupukan2 = $this->input->post('tpemupukan2');
		$pemupukan3 = $this->input->post('tpemupukan3');
		$panen = $this->input->post('tpanen');
		$keterangan = $this->input->post('keterangan');

		$where = array('id_pemesanan' => $id);

		$cek = $this->M_pengajuan->cek_1($lokasi, $tanggal, $panen);
		if ($cek->num_rows() >= 1) {
			$this->_notifFail();
		} else {
			$cek = $this->M_pengajuan->cek_2($lokasi, $tanggal, $panen);
			if ($cek->num_rows() >= 1) {
				$this->_notifFail();
			} else {
				$cek = $this->M_pengajuan->cek_3($lokasi, $tanggal);
				if ($cek->num_rows() >= 1) {
					$this->_notifFail();
				} else {
					$cek = $this->M_pengajuan->cek_4($lokasi, $panen);
					if ($cek->num_rows() >= 1) {
						$this->_notifFail();
					} else {
						$pemesanan = array(
							'id_user' => $this->session->userdata('id'),
							'id_lokasi' => $lokasi,
							'luas_pakai' => $luas,
							'judul_penelitian' => $judul,
							'tgl_penelitian' => $tanggal,
							'id_komoditas' => $komoditas,
							'status_pemesanan' => "pending",
							'keterangan' => $keterangan,
						);

						for ($i = 0; $i < $jumlah; $i++) {
							$detail[$i] = array(
								'id_pemesanan' => $id,
								'id_kebutuhan' => $check[$i],
							);
						}

						$kegiatan = array(
							'id_pemesanan' => $id,
							'semai' => $semai,
							'pindah' => $pindah,
							'pengolahan' => $pengolahan,
							'pemupukan1' => $pemupukan1,
							'pemupukan2' => $pemupukan2,
							'pemupukan3' => $pemupukan3,
							'panen' => $panen,
						);

						$this->M_pengajuan->replace($where, $pemesanan, 'pemesanan');
						$this->M_pengajuan->trash($where, 'detail_pemesanan');
						$this->M_pengajuan->kebutuhan($detail, 'detail_pemesanan');
						$this->M_pengajuan->replace_kegiatan($where, $kegiatan, 'detail_kegiatan');
						$notif = array(
							'status' => "berhasil",
							'message' => "Pengajuan berhasil diperbarui, pengajuan akan diperiksa terlebih dahulu",
						);
						$this->session->set_flashdata($notif);
						redirect('Peneliti/Pengajuan');
					}
				}
			}
		}
	}


	public function hapus($id)
	{
		$notif = array(
			'status' => "berhasil",
			'message' => "Pengajuan berhasil dihapus",
		);

		$where = array('id_pemesanan' => $id);

		$this->session->set_flashdata($notif);
		$this->M_pengajuan->trash($where, 'pemesanan');
		$this->M_pengajuan->trash($where, 'detail_pemesanan');
		$this->M_pengajuan->trash($where, 'detail_kegiatan');
		redirect('Peneliti/Pengajuan');
	}

	public function cetak($id)
	{
		$where = array('id_pemesanan' => $id);
		$data = $this->M_pengajuan->ambil($where, 'pemesanan')->row_array();
		$status = $data['status_pemesanan'];

		if ($status != "diterima") {
			$notif = array(
				'status' => "gagal",
				'message' => "Mohon maaf pengajuan Anda belum bisa dicetak, harap periksa status pengajuan Anda!",
			);

			$this->session->set_flashdata($notif);
			redirect('Peneliti/Pengajuan');
		} else {
			$data = array(
				'pemesanan' => $this->M_konfirmasi->ambil_pengajuan($where, 'pemesanan')->row_array(),
				'detail_pemesanan' => $this->M_konfirmasi->ambil_kebutuhan($where, 'detail_pemesanan')->result(),
				'detail_kegiatan' => $this->M_pengajuan->ambil($where, 'detail_kegiatan')->row_array(),
			);
			// var_dump($data);
			$this->load->library('mypdf');
			$this->mypdf->generate('dashboard/peneliti/pengajuan/cetak', $data, ' pengjuan - lahan ', ' A4 ', ' landscape');
		}
	}
}

/* End of file Pengajuan.php */
/* Location: ./application/controllers/Pengajuan.php */
