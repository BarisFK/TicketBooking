<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Giris extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->helper('tglindo_helper');
		$this->load->model('getkod_model');
		date_default_timezone_set("Asia/Jakarta");
	}
	function getsecurity($value=''){
		$username = $this->session->userdata('username');
		if ($username) {
			redirect('backend/home');
			$this->session->sess_destroy();
			redirect('backend/giris');
		}else{
			redirect('backend/giris');
		}
    }
    /* Log on to codeastro.com for more projects */
	function getUserIP()
    {
        $client  = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote  = $_SERVER['REMOTE_ADDR'];

        if(filter_var($client, FILTER_VALIDATE_IP))
        {
            $ip = $client;
        }
        elseif(filter_var($forward, FILTER_VALIDATE_IP))
        {
            $ip = $forward;
        }
        else
        {
            $ip = $remote;
        }

        return $ip;
        
    }
	public function index(){
		$data['ipaddres'] = $this->getUserIP();
		$this->load->view('backend/giris',$data);
	}
    
	public function logout(){
		$this->session->sess_destroy();
		redirect(base_url('backend/giris'));
	}
    /* Log on to codeastro.com for more projects */
	public function cekuser(){
    $username = strtolower($this->input->post('username'));
    $getUser = $this->db->query('select * from yonetici where kullanici_adi_yonetici = "'.$username.'"')->row();
    $password = $this->input->post('password');

    if (password_verify($password,$getUser->sifre_yonetici)) {
    	// $this->db->where('username_admin',$username);
        // $query = $this->db->get('tbl_admin');
        $sess = array(
            'kd_yonetici' => $getUser->kd_yonetici,
            'kullanici_adi_yonetici' => $getUser->kullanici_adi_yonetici,
            'sifre_yonetici' => $getUser->sifre_yonetici,
            'isim_yonetici'     => $getUser->isim_yonetici,
            'resim_yonetici'	=> $getUser->resim_yonetici,
            'email_yonetici'   => $getUser->email_yonetici,
            'seviye_yonetici'	=> $getUser->seviye_yonetici
        );
        // die(print_r($sess));
        $this->session->set_userdata($sess);
        redirect('backend/home');
        // }
    }else{
    	$this->session->set_flashdata('message', 'swal("Failed", "Incorrect Giris Details!", "error");');
    	redirect('backend/giris');
    	}
	}

}

/* End of file Giris.php */
/* Log on to codeastro.com for more projects */
/* Location: ./application/controllers/backend/giris.php */