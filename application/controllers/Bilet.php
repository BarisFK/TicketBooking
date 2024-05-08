<?php
defined('BASEPATH') or exit ('No direct script access allowed');

class Bilet extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('tglindo_helper');
		$this->load->model('getkod_model');
		date_default_timezone_set("Asia/Jakarta");
	}
	function getsecurity($value = '')
	{
		$username = $this->session->userdata('username');
		if (empty ($username)) {
			redirect('giris');
		}
	}
	public function index()
	{
		$this->session->unset_userdata(array('jadwal', 'asal', 'tanggal'));
		$data['title'] = "Check Schedule";
		$data['asal'] = $this->db->query("SELECT * FROM `varis` ORDER BY sehir_varis ASC ")->result_array();
		$data['tujuan'] = $this->db->query("SELECT * FROM `varis` GROUP BY sehir_varis ORDER BY sehir_varis ASC ")->result_array();
		$data['list'] = $this->db->query("SELECT * FROM `varis` ORDER BY sehir_varis ASC ")->result_array();
		$this->load->view('frontend/tarihkontrol', $data);
	}
	/* Log on to codeastro.com for more projects */
	public function cektiket($value = '')
	{
		$this->load->view('frontend/biletkontrol');
	}
	public function cekjadwal($tgl = '', $asl = '', $tjn = '')
	{
		$this->session->unset_userdata(array('jadwal', 'asal', 'tanggal'));
		$data['title'] = 'Search Tickets';
		$data['tanggal'] = $this->input->get('tanggal') . $tgl;
		$asal = $this->input->get('asal') . $asl;
		$tujuan = $this->input->get('tujuan') . $tjn;
		$data['asal'] = $this->db->query("SELECT * FROM varis
               WHERE kd_varis ='$asal'")->row_array();
		$data['jadwal'] = $this->db->query("SELECT * FROM sefer LEFT JOIN otobus on sefer.kd_otobus = otobus.kd_otobus LEFT JOIN varis on sefer.kd_varis = varis.kd_varis WHERE sefer.sefer_alani ='$tujuan' AND sefer.kd_kalkis = '$asal'")->result_array();
		if (!empty ($data['jadwal'])) {
			if ($tujuan == $data['asal']['sehir_varis']) {
				$this->session->set_flashdata('message', 'swal("Cek", "Tujuan dan Asal tidak boleh sama", "error");');
				redirect('bilet');
			} else {
				for ($i = 0; $i < count($data['jadwal']); $i++) {
					$data['kursi'][$i] = $this->db->query("SELECT count(no_koltuk_siparis) FROM siparis WHERE kd_sefer = '" . $data['jadwal'][$i]['kd_sefer'] . "' AND tarih_kalkis_siparis = '" . $data['tanggal'] . "' AND kalkis_siparis = '" . $asal . "'")->result_array();
				}
				;
				$this->load->view('frontend/seferkontrol', $data);
			}
		} else {
			$this->session->set_flashdata('message', 'swal("Empty", "No Schedule", "error");');
			redirect('bilet');
		}
	}
	/* Log on to codeastro.com for more projects */
	public function beforebeli($jadwal = "", $asal = '', $tanggal = '')
	{
		$array = array(
			'jadwal' => $jadwal,
			'asal' => $asal,
			'tanggal' => $tanggal
		);
		$this->session->set_userdata($array);
		if ($this->session->userdata('username')) {
			$id = $jadwal;
			$asal = $asal;
			$data['tanggal'] = $tanggal;
			$data['asal'] = $this->db->query("SELECT * FROM varis
                   WHERE kd_varis ='" . $asal . "'")->row_array();
			$data['jadwal'] = $this->db->query("SELECT * FROM sefer LEFT JOIN otobus on sefer.kd_otobus = otobus.kd_otobus LEFT JOIN varis on sefer.kd_varis = varis.kd_varis WHERE kd_sefer ='" . $id . "'")->row_array();
			$data['kursi'] = $this->db->query("SELECT no_koltuk_siparis, cinsiyet FROM siparis WHERE kd_sefer = '" . $data['jadwal']['kd_sefer'] . "' AND tarih_kalkis_siparis = '" . $data['tanggal'] . "' AND kalkis_siparis = '" . $asal . "'")->result_array();

			$this->load->view('frontend/satin_alma1', $data);
		} else {
			redirect('giris/autgiris');
		}
	}

	public function afterbeli()
	{
		$data['kursi'] = $this->input->get('kursi');
		$data['bank'] = $this->db->query("SELECT * FROM `banka` ")->result_array();
		$data['kd_sefer'] = $this->session->userdata('jadwal');
		$data['asal'] = $this->session->userdata('asal');
		$data['tglberangkat'] = $this->input->get('tgl');
		$data['selectedGenders'] = $this->input->get('selectedGender');
		$data['fiyat_sefer'] = $this->db->query("SELECT fiyat_sefer FROM sefer WHERE kd_sefer = '" . $this->session->userdata('jadwal') . "'")->row_array()['fiyat_sefer'];


		if ($data['kursi']) {
			$this->load->view('frontend/satin_alma2', $data);
		} else {
			$this->session->set_flashdata('message', 'swal("Empty", "Choose Your Seat", "error");');
			redirect('bilet/beforebeli/' . $data['asal'] . '/' . $data['kd_sefer']);
		}
	}

	/* Log on to codeastro.com for more projects */
	public function gettiket($value = '')
	{
		include 'assets/phpqrcode/qrlib.php';
		$asal = $this->db->query("SELECT * FROM varis WHERE kd_varis ='" . $this->session->userdata('asal') . "'")->row_array();
		$getkode = $this->getkod_model->get_kodtmporder();
		$kd_sefer = $this->session->userdata('jadwal');
		$kd_musteri = $this->session->userdata('kd_musteri');
		$tglberangkat = $this->input->post('tgl');
		$jambeli = date("Y-m-d H:i:s");
		$gender = $this->input->post('cinsiyet');
		$nama = $this->input->post('nama');
		$kursi = $this->input->post('kursi');
		$tahun = $this->input->post('tahun');
		$no_ktp = $this->input->post('no_ktp');
		$nama_pemesan = $this->input->post('nama_pemesan');
		$hp = $this->input->post('hp');
		$alamat = $this->input->post('alamat');
		$email = $this->input->post('email');
		$bank = $this->input->post('bank');
		$satu_hari = mktime(0, 0, 0, date("n"), date("j") + 1, date("Y"));
		$expired = date("d-m-Y", $satu_hari) . " " . date('H:i:s');
		$status = '1';
		QRcode::png($getkode, 'assets/frontend/upload/qrcode/' . $getkode . ".png", "Q", 8, 8);
		$count = count($kursi);

		$saat = date("H", strtotime($jambeli));
		$dakika = date("i", strtotime($jambeli));
		$saniye = date("s", strtotime($jambeli));
		$zaman = ($saat < 12) ? "ÖÖ" : "ÖS";
		$tanggal = hari_indo(date('N', strtotime($jambeli))) . ', ' . tanggal_indo(date('Y-m-d', strtotime('' . $jambeli . ''))) . ', ' . date('H:i:s', strtotime($jambeli)) . ' ' . $zaman;

		$peron_no = chr(rand(65, 90)); // A-Z arasında rastgele bir harf oluşturur

		for ($i = 0; $i < $count; $i++) {
			// Calculate discounted price based on passenger type
			$fiyat = 0; // Default to 0 for "7 Yaş ve Altı"
			$secenek = $this->input->post('secenekler')[$i];
			if ($secenek == 'normal') {
				// Handle normal price
				$fiyat_query = $this->db->query("SELECT fiyat_sefer FROM sefer WHERE kd_sefer = '" . $kd_sefer . "'");
				$fiyat_row = $fiyat_query->row_array();
				$fiyat = $fiyat_row['fiyat_sefer'];
			} elseif ($secenek == 'ogrenci') {
				// Handle student discount
				$fiyat_query = $this->db->query("SELECT fiyat_sefer * 0.75 AS discounted_price FROM sefer WHERE kd_sefer = '" . $kd_sefer . "'");
				$fiyat_row = $fiyat_query->row_array();
				$fiyat = $fiyat_row['discounted_price'];
			} elseif ($secenek == 'memur' || $secenek == 'yas65') {
				// Handle other discounts
				$fiyat_query = $this->db->query("SELECT fiyat_sefer * 0.85 AS discounted_price FROM sefer WHERE kd_sefer = '" . $kd_sefer . "'");
				$fiyat_row = $fiyat_query->row_array();
				$fiyat = $fiyat_row['discounted_price'];
			}

			// Plaka değerini belirleme
			$plaka = '';
			if ($asal['kd_varis'] == 'TJ020') {
				$plaka = '41';
			} elseif ($asal['kd_varis'] == 'TJ021') {
				$plaka = '31';
			} elseif ($asal['kd_varis'] == 'TJ022') {
				$plaka = '53';
			} else {
				$plaka = '25';
			}

			// Veritabanından ilgili plaka ile başlayan otobüs plakasını sorgula
			$query = $this->db->query("SELECT * FROM otobus WHERE SUBSTRING(plaka_otobus, 1, 2) = '" . substr($plaka, 0, 2) . "'");
			$result = $query->row_array();

			if ($result) {
				// Eğer veri bulunduysa, plaka değerini al
				$otobus_plaka = $result['plaka_otobus'];
			} else {
				// Eğer veri bulunamadıysa, varsayılan bir değer ata veya hata mesajı gönder
				echo "Belirtilen plaka ile başlayan otobüs bulunamadı.";
			}

			$simpan = array(
				'kd_siparis' => $getkode,
				'kd_bilet' => $plaka . $zaman . str_replace('-', '', $tglberangkat) . $peron_no . $otobus_plaka,
				'kd_sefer' => $kd_sefer,
				'kd_musteri' => $kd_musteri,
				'kalkis_siparis' => $asal['kd_varis'],
				'isim_siparis' => $nama_pemesan,
				'tarih_alis_siparis' => $tanggal,
				'tarih_kalkis_siparis' => $tglberangkat,
				'no_koltuk_siparis' => $kursi[$i],
				'isim_koltuk_siparis' => $nama[$i],
				'yas_koltuk_siparis' => $tahun[$i],
				'no_ktp_siparis' => $no_ktp,
				'no_tel_siparis' => $hp,
				'adres_siparis' => $alamat,
				'email_siparis' => $email,
				'kd_banka' => $bank,
				'gecerlilik_siparis' => $expired,
				'qrcode_siparis' => 'assets/frontend/upload/qrcode/' . $getkode . '.png',
				'durum_siparis' => $status,
				'cinsiyet' => $gender[$i],
				'fiyat' => $fiyat,


			);
			$this->db->insert('siparis', $simpan);
		}
		redirect('bilet/checkout/' . $getkode);
	}
	/* Log on to codeastro.com for more projects */
	public function cekorder($id = '')
	{
		$id = $this->input->post('kodetiket');
		$sqlcek = $this->db->query("SELECT * FROM siparis LEFT JOIN sefer on siparis.kd_sefer = sefer.kd_sefer LEFT JOIN otobus on sefer.kd_otobus = otobus.kd_otobus LEFT JOIN banka on siparis.kd_banka = banka.kd_banka WHERE kd_bilet ='$id' AND durum_siparis != 3 AND durum_siparis != 2")->result_array();
		if ($sqlcek) {
			$data['tiket'] = $sqlcek;
			$data['count'] = count($sqlcek);
			$this->load->view('frontend/odeme', $data);
		} else {
			$this->session->set_flashdata('message', 'swal("Empty", "No Pending Tickets Found", "error");');
			redirect('bilet/cektiket');
		}
	}

	public function payment($id = '')
	{
		$this->getsecurity();
		$sqlcek = $this->db->query("SELECT * FROM siparis LEFT JOIN sefer on siparis.kd_sefer = sefer.kd_sefer LEFT JOIN otobus on sefer.kd_otobus = otobus.kd_otobus LEFT JOIN banka on siparis.kd_banka = banka.kd_banka WHERE kd_siparis ='$id'")->result_array();
		$data['count'] = count($sqlcek);
		$data['tiket'] = $sqlcek;
		$this->load->view('frontend/odeme', $data);
	}
	public function checkout($value = '')
	{
		$this->getsecurity();
		$data['tiket'] = $value;
		$send['sendmail'] = $this->db->query("SELECT * FROM siparis LEFT JOIN sefer on siparis.kd_sefer = sefer.kd_sefer LEFT JOIN varis on sefer.kd_varis = varis.kd_varis LEFT JOIN banka on siparis.kd_banka = banka.kd_banka WHERE kd_siparis ='$value'")->row_array();
		$send['count'] = count($send['sendmail']);
		//email
		$subject = 'BTBS';
		$message = $this->load->view('frontend/mailgonder', $send, TRUE);
		$to = $this->session->userdata('email');
		$config = [
			'mailtype' => 'html',
			'charset' => 'utf-8',
			'protocol' => 'smtp',
			'smtp_host' => 'ssl://smtp.gmail.com',
			'smtp_user' => 'demo@email.com',    // Ganti dengan email gmail kamu
			'smtp_pass' => 'P@$$\/\/0RD',      // Password gmail kamu
			'smtp_port' => 465,
		];
		$this->load->library('email', $config);
		$this->email->set_newline("\r\n");
		$this->email->from('BTBS');
		$this->email->to($to);
		$this->email->subject($subject);
		$this->email->message($message);
		if ($this->email->send()) {
			$this->session->set_flashdata('message', 'swal("Başarılı", "Lütfen ödeme onayına doğru ilerleyin!", "success");');
			$this->load->view('frontend/odemebitir', $data);
		} else {
			//    echo 'Error! Send an error email';
			$this->session->set_flashdata('message', 'swal("Başarılı", "Lütfen ödeme onayına doğru ilerleyin!", "success");');
			$this->load->view('frontend/odemebitir', $data);
		}
	}
	/* Log on to codeastro.com for more projects */
	public function caritiket()
	{
		$id = $this->input->post('kodetiket');
		$sqlcek = $this->db->query("SELECT * FROM siparis LEFT JOIN otobus on siparis.kd_otobus = otobus.kd_otobus LEFT JOIN sefer on siparis.kd_sefer = sefer.kd_sefer WHERE kd_siparis ='" . $id . "'")->result_array();
		if ($sqlcek == NULL) {
			$this->session->set_flashdata('message', 'swal("Kosong", "Tidak Ada Bilet", "error");');
			redirect('bilet/cektiket');
		} else {
			$data['tiket'] = $sqlcek;
			$this->load->view('frontend/odeme', $data);
		}
	}
	public function konfirmasi($value = '', $harga = '')
	{
		$this->getsecurity();
		$data['id'] = $value;
		$data['total'] = $harga;
		$this->load->view('frontend/onay', $data);
	}
	public function insertkonfirmasi($value = '')
	{
		$this->getsecurity();
		$data = array(
			'kd_onaylama' => $this->getkod_model->get_kodkon(),
			'kd_siparis' => $this->input->post('kd_siparis'),
			'isim_banka_onaylama' => '',
			'isim_onaylama' => $this->input->post('nama'),
			'hesapno_onaylama' => $this->input->post('nomrek'),
			'toplam_onaylama' => $this->input->post('total'),
			'resim_onaylama' => ''
		);
		$this->db->insert('onaylama', $data);

		$siparis_id = $this->input->post('kd_siparis');
		$this->db->set('durum_siparis', 2); // durum 2 olarak güncellenir
		$this->db->where('kd_siparis', $siparis_id);
		$this->db->update('siparis');

		// Başarılı mesaj gösterilir ve kullanıcı profil sayfasına yönlendirilir
		$this->session->set_flashdata('message', 'swal("Başarılı", "Ödeme Tamamlandı", "success");');
		redirect('profil/tiketsaya/' . $this->session->userdata('kd_musteri'));
	}
	/* Log on to codeastro.com for more projects */
	public function cetak($id = '')
	{
		$this->getsecurity();
		$order = $id;
		$data['cetak'] = $this->db->query("SELECT * FROM siparis LEFT JOIN otobus on siparis.kd_otobus = otobus.kd_otobus LEFT JOIN sefer on siparis.kd_sefer = sefer.kd_sefer LEFT JOIN varis on sefer.kd_varis = varis.kd_varis WHERE kd_siparis ='" . $id . "'")->result_array();
		$tiket = $this->db->query("SELECT email_pelanggan FROM tbl_pelanggan WHERE kd_musteri ='" . $data['cetak'][0]['kd_musteri'] . "'")->row_array();
		die (print_r($tiket));
	}

}

/* End of file Bilet.php */
/* Location: ./application/controllers/Bilet.php */
