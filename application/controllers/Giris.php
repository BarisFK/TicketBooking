<?php
defined('BASEPATH') or exit ('No direct script access allowed');

class Giris extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->database(); // Add this line to load the database library
	}

	public function index()
	{
		$this->autlogin();
	}

	public function autlogin()
	{
		$this->load->view('frontend/giris');
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url('login'));
	}

	public function cekuser()
	{
		$username = strtolower($this->input->post('username'));
		$password = $this->input->post('password');

		$sqlCheck = $this->db->query('SELECT * FROM musteri WHERE kullanici_adi_musteri = "' . $username . '" OR email_musteri = "' . $username . '" ')->row();

		if ($sqlCheck) {
			if ($sqlCheck->durum_musteri == 1) {
				if (password_verify($password, $sqlCheck->sifre_musteri)) {
					$sess = [
						'kd_musteri' => $sqlCheck->kd_musteri,
						'username' => $sqlCheck->kullanici_adi_musteri,
						'password' => $sqlCheck->sifre_musteri,
						'ktp' => $sqlCheck->no_ktp_musteri,
						'nama_lengkap' => $sqlCheck->isim_musteri,
						'img_musteri' => $sqlCheck->resim_musteri,
						'email' => $sqlCheck->email_musteri,
						'telpon' => $sqlCheck->telpon_musteri,
						'alamat' => $sqlCheck->adres_musteri
					];
					$this->session->set_userdata($sess);
					if ($this->session->userdata('jadwal') == NULL) {
						redirect('bilet');
					} else {
						redirect('bilet/beforebeli/' . $this->session->userdata('jadwal') . '/' . $this->session->userdata('asal') . '/' . $this->session->userdata('tanggal'));
					}
				} else {
					$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
                    Wrong Passworrrrrrd
                    </div>');

					// Add these lines for debugging
					echo 'Entered Password: ' . $password . '<br>';
					echo 'Hashed Password in Database: ' . $sqlCheck->sifre_musteri . '<br>';

				}
			} else {
				$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
                Account Not verified yet!!
                    </div>');
				redirect('login');
			}
		} else {
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
            Kullanıcı adı bulunamadı. Lütfen tekrar deneyiniz.
                    </div>');
			redirect('login');
		}
	}


	public function daftar()
	{
		$this->form_validation->set_rules(
			'nomor',
			'Nomor',
			'trim|required|is_unique[musteri.telpon_musteri]',
			array(
				'required' => 'Telefon numarası alanı boş olamaz',
				'is_unique' => 'Bu telefon numarası mevcut'
			)
		);
		$this->form_validation->set_rules(
			'name',
			'Name',
			'trim|required',
			array(
				'required' => 'Name Required.',
			)
		);
		$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
		$this->form_validation->set_rules(
			'username',
			'Username',
			'trim|required|min_length[5]|is_unique[musteri.kullanici_adi_musteri]',
			array(
				'required' => 'Kullanıcı adı alanı boş olamaz',
				'is_unique' => 'Bu kullanıcı adı mevcut'
			)
		);
		$this->form_validation->set_rules(
			'email',
			'Email',
			'trim|required|valid_email|is_unique[musteri.email_musteri]',
			array(
				'required' => 'Email Required.',
				'valid_email' => 'Enter Email Correctly',
				'is_unique' => 'Bu email mevcut'
			)
		);
		$this->form_validation->set_rules(
			'password1',
			'Password',
			'trim|required|min_length[8]|matches[password2]',
			array(
				'matches' => 'Şifreler aynı değil.',
				'min_length' => 'Şifreniz en az 8 karakterli olmalıdır'
			)
		);
		$this->form_validation->set_rules('password2', 'Password', 'trim|required|matches[password1]');
		if ($this->form_validation->run() == false) {
			$this->load->view('frontend/liste');
		} else {
			// die(print_r($_POST));
			$this->load->model('getkod_model');
			$data = array(
				'kd_musteri' => $this->getkod_model->get_kodpel(),
				'isim_musteri' => $this->input->post('name'),
				'email_musteri' => $this->input->post('email'),
				'resim_musteri' => 'assets/frontend/img/default.png',
				'adres_musteri' => $this->input->post('alamat'),
				'telpon_musteri' => $this->input->post('nomor'),
				'kullanici_adi_musteri' => $this->input->post('username'),
				'durum_musteri' => 1,
				'olusturma_tarihi_musteri' => time(),
				'sifre_musteri' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT)
			);
			$token = md5($this->input->post('email') . date("d-m-Y H:i:s"));
			$data1 = array(
				'isim_musteri_token' => $token,
				'email_musteri_token' => $this->input->post('email'),
				'olusturma_tarih_musteri_token' => time()
			);
			$this->db->insert('musteri', $data);
			$this->db->insert('musteri_token', $data1);
			$this->_sendmail($token, 'verify');
			$this->session->set_flashdata('message', 'swal("Başarılı", "Kayıt Başarılı.", "success");');
			redirect('login');
		}

	}
	private function _sendmail($token = '', $type = '')
	{
		$config = [
			'mailtype' => 'html',
			'charset' => 'utf-8',
			'protocol' => 'smtp',
			'smtp_host' => 'ssl://smtp.gmail.com',
			'smtp_user' => 'demo@email.com',    // Ganti dengan email gmail kamu
			'smtp_pass' => 'P@$$\/\/0RD',      // Password gmail kamu
			'smtp_port' => 465,
			'crlf' => "rn",
			'newline' => "rn"
		];
		$this->load->library('email', $config);
		$this->email->set_newline("\r\n");
		$this->email->from('BTBS');
		$this->email->to($this->input->post('email'));
		// $this->email->attach('https://masrud.com/content/images/20181215150137-codeigniter-smtp-gmail.png');
		if ($type == 'verify') {
			$this->email->subject('Account verify BTBS');
			$this->email->message('Click the link to verify your account <a href="' . base_url('login/verify?email=' . $this->input->post('email') . '&token=' . $token) . '" >Verification</a>');
		} elseif ($type == 'forgot') {
			$this->email->subject('BTBS Ticket Reset Account');
			$this->email->message('Click the link to Reset your account <a href="' . base_url('login/forgot?email=' . $this->input->post('email') . '&token=' . $token) . '" >Reset Password</a>');
		}
		if ($this->email->send()) {
			return true;
		} else {
			echo 'Error! email cant be sent.';
		}
	}
	/* Log on to codeastro.com for more projects */
	public function verify($value = '')
	{
		$email = $this->input->get('email');
		$token = $this->input->get('token');
		$sqlcek = $this->db->get_where('musteri', ['email_musteri' => $email])->row_array();
		if ($sqlcek) {
			$sqlcek_token = $this->db->get_where('musteri_token', ['isim_musteri_token' => $token])->row_array();
			if ($sqlcek_token) {
				if (time() - $sqlcek_token['olusturma_tarih_musteri_token'] < (60 * 60 * 24)) {
					$update = array('durum_musteri' => 1, );
					$where = array('email_musteri' => $email);
					$this->db->update('musteri', $update, $where);
					$this->db->delete('musteri_token', ['email_musteri_token' => $email]);
					$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
					Successfully Verify Your Account, Giris
					</div>');
					redirect('login');
				} else {
					$this->db->delete('musteri', ['email_musteri' => $email]);
					$this->db->delete('email_musteri_token', ['email_musteri_token' => $email]);
					$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
					Token Expired, Please re-register your account
						</div>');
					redirect('login');
				}
			} else {
				$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
				Incorrect Token Verification Failed
						</div>');
				redirect('login');
			}
		} else {
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
		Email Verification Failed
						</div>');
			redirect('login');
		}
	}
	/* Log on to codeastro.com for more projects */
	public function lupapassword($value = '')
	{
		$this->form_validation->set_rules(
			'email',
			'Email',
			'trim|required|valid_email',
			array(
				'required' => 'Email Required.',
				'valid_email' => 'Enter Email Correctly',
			)
		);
		if ($this->form_validation->run() == false) {
			$this->load->view('frontend/sifreunutma');
		} else {
			$email = $this->input->post('email');
			$sqlcek = $this->db->get_where('musteri', ['email_musteri' => $email], ['status_pelanggan' => 1])->row_array();
			if ($sqlcek) {
				$token = md5($email . date("d-m-Y H:i:s"));
				$data = array(
					'isim_musteri_token' => $token,
					'email_musteri_token' => $email,
					'olusturma_tarih_musteri_token' => time()
				);
				$this->db->insert('musteri_token', $data);
				$this->_sendmail($token, 'forgot');
				$this->session->set_flashdata('message', 'swal("Başarılı", "Şifre başarıyla sıfırlandı lütfen e-postanızı kontrol edin", "success");');
				redirect('login');
			} else {
				$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
						No Email Or Account Not Active
						</div>');
				redirect('giris/lupapassword');
			}
		}
	}
	public function forgot($value = '')
	{
		$email = $this->input->get('email');
		$token = $this->input->get('token');
		$sqlcek = $this->db->get_where('musteri', ['email_musteri' => $email])->row_array();
		if ($sqlcek) {
			$sqlcek_token = $this->db->get_where('musteri_token', ['isim_musteri_token' => $token])->row_array();
			if ($sqlcek_token) {
				$this->session->set_userdata('resetemail', $email);
				$this->changepassword();
			} else {
				$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
				Failed to Reset Wrong Email Token
						</div>');
				redirect('login');
			}
		} else {
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
		Failed to Reset Wrong Email
						</div>');
			redirect('login');
		}
	}
	/* Log on to codeastro.com for more projects */
	public function changepassword($value = '')
	{
		if ($this->session->userdata('resetemail') == NULL) {
			redirect('giris/daftar');
		}
		$this->form_validation->set_rules(
			'password1',
			'Password',
			'trim|required|min_length[8]|matches[password2]',
			array(
				'matches' => 'Password Not Same.',
				'min_length' => 'Password Minimum 8 Characters.'
			)
		);
		$this->form_validation->set_rules('password2', 'Password', 'trim|required|matches[password1]');
		if ($this->form_validation->run() == false) {
			$this->load->view('frontend/sifresifirla');
		} else {
			$email = $this->session->userdata('resetemail');
			$update = array(
				'durum_musteri' => 1,
				'sifre_musteri' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT)
			);
			$where = array('email_musteri' => $email);
			$this->db->update('musteri', $update, $where);
			$this->session->unset_userdata('resetemail');
			$this->db->delete('musteri_token', ['email_musteri_token' => $email]);
			$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
					Successfully Reset, Giris Your Account Back
					</div>');
			redirect('login');
		}
	}
}

/* End of file Giris.php */
/* Log on to codeastro.com for more projects */
/* Location: ./application/controllers/Giris.php */