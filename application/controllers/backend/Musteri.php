<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Musteri extends CI_Controller {
	function __construct(){
	parent::__construct();
		$this->load->helper('tglindo_helper');
		$this->load->model('getkod_model');
		$this->getsecurity();
		date_default_timezone_set("Asia/Jakarta");
	}
	function getsecurity($value=''){
		$username = $this->session->userdata('level');
		if ($username == '2') {
			$this->session->sess_destroy();
			redirect('backend/home');
		}
	}
	public function index(){
		$data['title'] = "Customers List";
		$data['pelanggan'] = $this->db->query("SELECT * FROM musteri")->result_array();
		// die(print_r($data));
		$this->load->view('backend/musteri', $data);
	}

}

/* End of file Musteri.php */
/* Log on to codeastro.com for more projects */
/* Location: ./application/controllers/backend/musteri.php */