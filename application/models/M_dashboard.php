<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_dashboard extends CI_Model
{

    function list_pengajuan($table)
    {
        $this->db->select('pemesanan.*,komoditas.nama_komoditas,user.nama,lokasi.nama_lokasi,detail_kegiatan.panen');
        $this->db->join('komoditas', 'komoditas.id_komoditas=pemesanan.id_komoditas');
        $this->db->join('lokasi', 'lokasi.id_lokasi=pemesanan.id_lokasi');
        $this->db->join('user', 'user.id_user=pemesanan.id_user');
        $this->db->join('detail_kegiatan', 'detail_kegiatan.id_pemesanan=pemesanan.id_pemesanan');
        return $this->db->get($table);
    }

    function lokasi_digunakan($datenow)
    {
        $this->db->select('pemesanan.*,detail_kegiatan.panen');
        $this->db->from('pemesanan');
        $this->db->join('detail_kegiatan', 'detail_kegiatan.id_pemesanan=pemesanan.id_pemesanan');
        $this->db->where('status_pemesanan !=', 'ditolak');
        $this->db->where('pemesanan.tgl_penelitian <=', $datenow);
        $this->db->where('detail_kegiatan.panen >=', $datenow);
        return $this->db->count_all_results();
    }
}

/* End of file M_dashboard.php */
/* Location: ./application/models/M_dashboard.php */
