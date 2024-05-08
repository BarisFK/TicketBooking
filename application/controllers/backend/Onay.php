<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Onay extends CI_Controller {
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
		$data['title'] = "Confirmation List";
		$data['konfirmasi'] = $this->db->query("SELECT * FROM onaylama group by kd_onaylama")->result_array();
		$this->load->view('backend/onay', $data);	
	}

	public function viewkonfirmasi($id=''){
	 $sqlcek = $this->db->query("SELECT * FROM onaylama WHERE kd_siparis ='".$id."'")->result_array();
	 $data['title'] = "View Confirmation";
	 if ($sqlcek == NULL) {
	 	$this->session->set_flashdata('message', 'swal("Empty", "Payments info not received yet!", "error");');
		redirect('backend/siparis/vieworder/'.$id);
	 }else{		
		$data['konfirmasi'] = $sqlcek;
	 	$this->load->view('backend/view_onay',$data);
		}
	}
	
}

/* End of file Onay.php */
/* Log on to codeastro.com for more projects */
/* Location: ./application/controllers/backend/onay.php */