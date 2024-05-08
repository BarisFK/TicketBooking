<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Siparis extends CI_Controller {
	function __construct(){
	parent::__construct();
		$this->load->helper('tglindo_helper');
		$this->load->model('getkod_model');
		$this->getsecurity();
		date_default_timezone_set("Asia/Jakarta");
	}
	function getsecurity($value=''){
		if (empty($this->session->userdata('kullanici_adi_yonetici'))) {
			$this->session->sess_destroy();
			redirect('backend/giris');
		}
	}
	public function index(){
		$data['title'] = "Booking List";
 		$data['order'] = $this->db->query("SELECT * FROM siparis group by kd_siparis")->result_array();
		// die(print_r($data));
		$this->load->view('backend/siparis', $data);
	}
	/* Log on to codeastro.com for more projects */
	public function vieworder($id=''){
		// die(print_r($_GET));
		$cek = $this->input->get('order').$id;
	 	$sqlcek = $this->db->query("SELECT * FROM siparis LEFT JOIN sefer on siparis.kd_sefer = sefer.kd_sefer WHERE kd_siparis ='".$cek."' ")->result_array();
	 	if ($sqlcek) {
	 		$data['tiket'] = $sqlcek;
			$data['title'] = "View Bookings";
			// die(print_r($sqlcek));
			$this->load->view('backend/view_order',$data);
	 	}else{
	 		$this->session->set_flashdata('message', 'swal("Empty", "No Siparis", "error");');
    		redirect('backend/bilet');
	 	}
	}
	public function inserttiket($value=''){
		$id = $this->input->post('kd_siparis');
		$asal = $this->input->post('asal_beli');
		$tiket = $this->input->post('kd_tiket');
		$nama = $this->input->post('nama');
		$kursi = $this->input->post('no_kursi');
		$umur = $this->input->post('umur_kursi');
		$harga = $this->input->post('harga');
		$tgl = $this->input->post('tgl_beli');
		$status = $this->input->post('status');
		$where = array('kd_siparis' => $id );
		$update = array('status_order' => $status );
		$this->db->update('siparis', $update,$where);
		$data['asal'] = $this->db->query("SELECT * FROM tbl_tujuan WHERE kd_tujuan ='".$asal."'")->row_array();
		$data['cetak'] = $this->db->query("SELECT * FROM siparis LEFT JOIN sefer on siparis.kd_sefer = sefer.kd_sefer LEFT JOIN tbl_tujuan on sefer.kd_tujuan = tbl_tujuan.kd_tujuan WHERE kd_siparis ='".$id."'")->result_array();
		$pelanggan = $this->db->query("SELECT email_pelanggan FROM tbl_pelanggan WHERE kd_pelanggan ='".$data['cetak'][0]['kd_pelanggan']."'")->row_array();
		$pdfFilePath = "assets/backend/upload/ebilet/".$id.".pdf";
		$html = $this->load->view('frontend/biletyazdir', $data, TRUE);
		$this->load->library('m_pdf');
		$this->m_pdf->pdf->WriteHTML($html);
		$this->m_pdf->pdf->Output($pdfFilePath);
		for ($i=0; $i < count($nama) ; $i++) { 
			$simpan = array(
				'kd_tiket' => $tiket[$i],
				'kd_siparis' => $id,
				'nama_tiket' => $nama[$i],
				'kursi_tiket' => $kursi[$i],
				'umur_tiket' => $umur[$i],
				'asal_beli_tiket' => $asal,
				'harga_tiket' => $harga,
				'status_tiket' => $status,
				'etiket_tiket' => $pdfFilePath,
				'create_tgl_tiket' => date('Y-m-d'),
				'create_admin_tiket' => $this->session->userdata('username_admin')
			);
		$this->db->insert('tbl_tiket', $simpan);
		}
		$this->session->set_flashdata('message', 'swal("Succeed", "Ticket Siparis Processed Successfully", "success");');
		redirect('backend/siparis');

		
	}
	/* Log on to codeastro.com for more projects */
	public function kirimemail($id=''){
		$data['cetak'] = $this->db->query("SELECT * FROM siparis LEFT JOIN sefer on siparis.kd_sefer = sefer.kd_sefer LEFT JOIN tbl_tujuan on sefer.kd_tujuan = tbl_tujuan.kd_tujuan WHERE kd_siparis ='".$id."'")->result_array();
		$asal = $data['cetak'][0]['asal_order'];
		$kodeplg = $data['cetak'][0]['kd_pelanggan'];
		$data['asal'] = $this->db->query("SELECT * FROM tbl_tujuan WHERE kd_tujuan ='$asal'")->row_array();
		$pelanggan = $this->db->query("SELECT email_pelanggan FROM tbl_pelanggan WHERE kd_pelanggan ='$kodeplg'")->row_array();
		//email
		$subject = 'E-ticket - Siparis ID '.$id.' - '.date('dmY');
		$message = $this->load->view('frontend/biletyazdir', $data ,TRUE);
		$attach  = base_url("assets/backend/upload/ebilet/".$id.".pdf");
		$to 	= $pelanggan['email_pelanggan'];
		$config = array(
			   'mailtype'  => 'html',
               'charset'   => 'utf-8',
               'protocol'  => 'smtp',
               'smtp_host' => 'ssl://smtp.gmail.com',
               'smtp_user' => 'demo@email.com',    // Ganti dengan email gmail kamu
               'smtp_pass' => 'P@$$\/\/0RD',      // Password gmail kamu
               'smtp_port' => 465,
               'crlf'      => "rn",
               'newline'   => "rn"
		);
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from('BTBS');
        $this->email->to($to);
        $this->email->attach($attach);
        $this->email->subject($subject);
        $this->email->message($message);
        if ($this->email->send()) {
        	$this->session->set_flashdata('message', 'swal("Succeed", "E-Ticket sent!", "success");');
			redirect('backend/siparis/vieworder/'.$id);
        } else {
            $this->session->set_flashdata('message', 'swal("Failed", "E-Tickets Failed to Send Contact the IT Team", "error");');
			redirect('backend/siparis/vieworder/'.$id);
        }

	}

}

/* End of file Siparis.php */
/* Log on to codeastro.com for more projects */
/* Location: ./application/controllers/backend/siparis.php */