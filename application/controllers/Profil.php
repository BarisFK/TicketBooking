<?php
defined('BASEPATH') or exit ('No direct script access allowed');

class Profil extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
	}
	public function index()
	{
		$this->load->view('frontend/profil');
	}
	public function profilesaya($id = '')
	{
		$id = $this->session->userdata('kd_musteri');
		// Mevcut kullanıcının profil bilgilerini veritabanından çek
		$data['profile'] = $this->db->query("SELECT * FROM musteri WHERE kd_musteri = '" . $id . "'")->row_array();
		$this->load->view('frontend/profil', $data);
	}


	public function editprofile($id = '')
	{
		$id = $this->input->post('kode');
		$where = array('kd_musteri' => $id);
		$update = array(
			'no_ktp_musteri' => $this->input->post('ktp'),
			'isim_musteri' => $this->input->post('nama'),
			'email_musteri' => $this->input->post('email'),
			'resim_musteri' => 'assets/frontend/img/default.png',
			'adres_musteri' => $this->input->post('alamat'),
			'telpon_musteri' => $this->input->post('hp'),
		);
		$this->db->update('musteri', $update, $where);
		$this->session->set_flashdata('message', 'swal("Başarılı", "Güncelleme Başarılı", "success");');
		redirect('profil/profilesaya/' . $id);
	}
	public function tiketsaya($id = '')
	{
		$id = $this->session->userdata('kd_musteri');
		$this->getsecurity();
		$data['tiket'] = $this->db->query("SELECT * FROM siparis WHERE kd_musteri ='" . $id . "' group by kd_siparis ")->result_array();
		// die(print_r($data));
		$this->load->view('frontend/tiketmu', $data);
	}
	public function tiketsaya2($id = '')
	{
		$this->getsecurity();
		$kd_siparis = $this->uri->segment(3); // Bilet ID'sini URI'den al
		// Kullanıcı "Evet" dediği takdirde veritabanındaki "siparis" tablosunda belirli biletin durumunu güncelle
		if ($this->input->post('confirm_cancel')) {
			$this->db->set('durum_siparis', '3');
			$this->db->where('kd_siparis', $kd_siparis);
			$this->db->update('siparis');
		}
		// Yönlendirme yap
		redirect('profil/tiketsaya/' . $this->session->userdata('kd_musteri'));
	}

	public function changepassword($id = '')
	{
		$this->load->library('form_validation');
		$pelanggan = $this->db->query("SELECT sifre_musteri FROM musteri where kd_musteri ='" . $id . "'")->row_array();
		// die(print_r($pelanggan));
		$this->form_validation->set_rules(
			'currentpassword',
			'currentpassword',
			'trim|required|min_length[8]',
			array(
				'required' => 'Enter Password',
			)
		);
		$this->form_validation->set_rules(
			'new_password1',
			'new_password1',
			'trim|required|min_length[8]|matches[new_password2]',
			array(
				'required' => 'Enter Password.',
				'matches' => 'Password Not Same.',
				'min_length' => 'Password Minimal 8 Characters.'
			)
		);
		$this->form_validation->set_rules(
			'new_password2',
			'new_password2',
			'trim|required|min_length[8]|matches[new_password1]',
			array(
				'required' => 'Enter Password.',
				'matches' => 'Password Not Same.',
				'min_length' => 'Password Minimal 8 Characters.'
			)
		);
		$this->form_validation->set_rules(
			'currentpassword',
			'currentpassword',
			'trim|required|min_length[8]',
			array(
				'required' => 'Enter Password',
			)
		);
		$this->form_validation->set_rules(
			'new_password1',
			'new_password1',
			'trim|required|min_length[8]|matches[new_password2]',
			array(
				'required' => 'Enter Password.',
				'matches' => 'Password Not Same.',
				'min_length' => 'Password Minimal 8 Characters.'
			)
		);
		$this->form_validation->set_rules(
			'new_password2',
			'new_password2',
			'trim|required|min_length[8]|matches[new_password1]',
			array(
				'required' => 'Enter Password.',
				'matches' => 'Password Not Same.',
				'min_length' => 'Password Minimal 8 Characters.'
			)
		);
		if ($this->form_validation->run() == false) {
			$this->load->view('frontend/sifredegis');
		} else {
			$currentpassword = $this->input->post('currentpassword');
			$newpassword = $this->input->post('new_password1');
			if (!password_verify($currentpassword, $pelanggan['sifre_musteri'])) {
				$this->session->set_flashdata('gagal', '<div class="alert alert-danger" role="alert">
				Previous Password Wrong
					</div>');
				redirect('profil/changepassword');
			} elseif ($currentpassword == $newpassword) {
				$this->session->set_flashdata('gagal', '<div class="alert alert-danger" role="alert">
				Passwords cant be the same before
					</div>');
				redirect('profil/changepassword');
			} else {
				$password_hash = password_hash($newpassword, PASSWORD_DEFAULT);
				$where = array('kd_musteri' => $id);
				$update = array(
					'sifre_musteri' => $password_hash,
				);
				$this->db->update('musteri', $update, $where);
				$this->session->set_flashdata('message', 'swal("Success", "Your password has been changed successfully", "success");');
				redirect('profil/profilesaya/' . $id);
			}
		}

	}
	function getsecurity($value = '')
	{
		$username = $this->session->userdata('username');
		if (empty ($username)) {
			$this->session->sess_destroy();
			redirect('backend/giris');
		}
	}
}

/* End of file Profil.php */
/* Location: ./application/controllers/Profil.php */