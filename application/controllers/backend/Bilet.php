<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bilet extends CI_Controller {
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
	public function index(){
	$data['title'] = "Ticket List";
	$data['tiket'] = $this->db->query("SELECT * FROM bilet WHERE durum_bilet = 2 ")->result_array();
	$this->load->view('backend/bilet', $data);	
	}
	/* Log on to codeastro.com for more projects */
	public function viewtiket($tiket){
		$data['title'] = "Ticket List";
		$data['tiket'] = $this->db->query("SELECT * FROM bilet WHERE kd_bilet = '".$tiket."' ")->row_array();
		if ($data['tiket']) {
			$this->load->view('backend/view_tiket', $data);
		}else{
			$this->session->set_flashdata('message', 'swal("Empty", "No Ticket", "error");');
    		redirect('backend/bilet');
		}	
	}

}

/* End of file Bilet.php */
/* Location: ./application/controllers/backend/bilet.php */