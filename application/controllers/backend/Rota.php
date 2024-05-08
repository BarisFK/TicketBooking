<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rota extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper('tglindo_helper');
		$this->load->model('getkod_model');
		$this->getsecurity();
		date_default_timezone_set("Asia/Jakarta");
	}
	function getsecurity($value = '')
	{
		$username = $this->session->userdata('kullanici_adi_yonetici');
		if (empty($username)) {
			$this->session->sess_destroy();
			redirect('backend/giris');
		}
	}
	public function index()
	{
		$data['title'] = "Destination/Terminal List";
		$data['tujuan'] = $this->db->query("SELECT * FROM varis")->result_array();
		// die(print_r($data));
		$this->load->view('backend/varis', $data);
	}
	/* Log on to codeastro.com for more projects */
	public function viewrute($id = '')
	{
		$data['title'] = "Destination/Terminal List";
		$data['rute'] = $this->db->query("SELECT * FROM varis WHERE kd_varis = '" . $id . "' ")->row_array();
		// die(print_r($data));
		$this->load->view('backend/view_tujuan', $data);
	}
	public function tambahtujuan()
	{
		$kode = $this->getkod_model->get_kodtuj();
		$data = array(
			'sehir_varis' => $this->input->post('tujuan'),
			'kd_varis' => $kode,
			'terminal_varis' => $this->input->post('terminal'),
		);
		// die(print_r($data));
		$this->db->insert('varis', $data);
		$this->session->set_flashdata('message', 'swal("Data Added Successfully");');
		redirect('backend/rute');
	}
}

/* End of file Rota.php */
/* Log on to codeastro.com for more projects */
/* Location: ./application/controllers/backend/Rota.php */