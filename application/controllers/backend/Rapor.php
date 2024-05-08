<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rapor extends CI_Controller {
	function __construct(){
	parent::__construct();
		$this->load->helper('tglindo_helper');
		$this->load->model('getkod_model');
		$this->getsecurity();
		date_default_timezone_set("Asia/Jakarta");
	}
	function getsecurity($value=''){
		$username = $this->session->userdata('kullanici_adi_yonetici');
		if (empty($username)) {
			$this->session->sess_destroy();
			redirect('backend/giris');
		}
	}
	/* Log on to codeastro.com for more projects */
	public function index(){
		$data['title'] = 'Report';
		$data['bulan'] = $this->db->query("SELECT DISTINCT DATE_FORMAT(olusturma_tarih_bilet,'%M %Y') AS bulan FROM bilet")->result_array();
		$this->load->view('backend/rapor', $data);
	}
	public function laportanggal($value=''){
		$data['mulai'] = $this->input->post('mulai');
		$data['sampai'] = $this->input->post('sampai');
		$data['laporan'] = $this->db->query("SELECT * FROM bilet WHERE (olusturma_tarih_bilet BETWEEN '".$data['mulai']."' AND '".$data['sampai']."') AND status_tiket = 2")->result_array();
		for ($i=0; $i < count($data['laporan']) ; $i++) { 
			$total[$i] = $data['laporan'][$i]['harga_tiket'];
		}
		$data['total'] = array_sum($total);
		$this->load->view('backend/rapor/laporan_pertanggal', $data);		
	}
	public function laporbulan($value=''){
		$data['bulan'] = $this->input->post('bln');
		// $data['laporan'] = $this->db->query("SELECT olusturma_tarih_bilet,DATE_FORMAT(olusturma_tarih_bilet,'%M %Y') AS bulan,DATE_FORMAT(olusturma_tarih_bilet,'%d %M %Y') FROM bilet  WHERE DATE_FORMAT(jual_tanggal,'%M %Y')='$data['bulan']' ORDER BY kd_tiket DESC");
		die(print_r($data));
		// for ($i=0; $i < count($data['laporan']) ; $i++) { 
		// 	$total[$i] = $data['laporan'][$i]['harga_tiket'];
		// }
		// $data['total'] = array_sum($total);
		// $this->load->view('backend/rapor/laporan_pertanggal', $data);
	}
}

/* End of file Rapor.php */
/* Log on to codeastro.com for more projects */
/* Location: ./application/controllers/backend/rapor.php */