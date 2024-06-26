<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	
	function __construct(){
	parent::__construct();
		$this->load->helper('tglindo_helper');
		$this->load->model('getkod_model');
		$this->getsecurity();
		date_default_timezone_set("Asia/Jakarta");
	}
	public function index(){
		$data['title'] = "Home";
		$data['order'] = $this->db->query("SELECT count(kd_siparis) FROM siparis WHERE durum_siparis ='1'")->result_array();
		$data['tiket'] = $this->db->query("SELECT count(kd_bilet) FROM bilet WHERE durum_bilet = '2'")->result_array();
		$data['konfirmasi'] = $this->db->query("SELECT count(kd_onaylama) FROM onaylama ")->result_array();
		$data['bus'] = $this->db->query("SELECT count(kd_otobus) FROM otobus WHERE durum_otobus = 1 ")->result_array();
		$data['terminal'] = $this->db->query("SELECT count(kd_varis) FROM varis")->result_array();
		$data['schedules'] = $this->db->query("SELECT count(kd_sefer) FROM sefer")->result_array();
		// die(print_r($data));
		$this->load->view('backend/home', $data);
	}
	function getsecurity($value=''){
		$username = $this->session->userdata('kullanici_adi_yonetici');
		if (empty($username)) {
			$this->session->sess_destroy();
			redirect('backend/giris');
		}
	}
}

/* End of file Home.php */
/* Log on to codeastro.com for more projects */
/* Location: ./application/controllers/backend/Home.php */