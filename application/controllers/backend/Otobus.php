<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Otobus extends CI_Controller {
	function __construct(){
	parent::__construct();
		$this->load->model('getkod_model');
		date_default_timezone_set("Asia/Jakarta");
	}
	public function index(){
	$data['title'] = "Otobus Management";
	$data['bus'] = $this->db->query("SELECT * FROM otobus ORDER BY isim_otobus asc")->result_array();
	// die(print_r($data));
	$this->load->view('backend/otobus', $data);	
	}
	public function viewbus($id=''){
		$data['title'] = "View Otobus";
		$data['bus'] = $this->db->query("SELECT * FROM otobus WHERE kd_otobus = '".$id."'")->row_array();
		$this->load->view('backend/view_otobus', $data);
	}
	public function tambahbus(){
		$kode = $this->getkod_model->get_kodbus();
		$data = array(
			'kd_otobus' => $kode,
			'isim_otobus' => $this->input->post('isim_otobus'),
			'plaka_otobus'		 => $this->input->post('plat_bus'),
			'kapasite_otobus'		 => $this->input->post('seat'),
			'durum_otobus'			=> '1'
			 );
		$this->db->insert('otobus', $data);
		$this->session->set_flashdata('message', 'swal("Succeed", "Otobus Data Saved", "success");');
		redirect('backend/otobus');
	}

}

/* End of file Otobus.php */
/* Log on to codeastro.com for more projects */
/* Location: ./application/controllers/backend/otobus.php */