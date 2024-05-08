<!DOCTYPE html>
<html lang="tr" class="no-js">

<head>
	<!-- Mobile Specific Meta -->
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Favicon-->
	<link rel="shortcut icon" href="img/elemefav.png">
	<meta name="author" content="colorlib">
	<!-- Meta Description --> <!-- Author Meta -->

	<meta name="description" content="">
	<!-- Meta Keyword -->
	<meta name="keywords" content="">
	<!-- meta character set -->
	<meta charset="UTF-8">
	<!-- Log on to codeastro.com for more projects -->
	<!-- Site Title -->
	<title>Get Tickets</title>
	<link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet">
	<!--CSS-->
	<link rel="stylesheet" type="text/css"
		href="<?php echo base_url() ?>assets/frontend/datepicker/dcalendar.picker.css">
	<?php $this->load->view('frontend/include/base_css'); ?>
</head>

<body>
	<!-- navbar -->
	<?php $this->load->view('frontend/include/base_nav'); ?>
	<section class="service-area section-gap relative">
		<div class="overlay overlay-bg"></div>
		<div class="container">
			<div class="row d-flex justify-content-center">
				<div class="col-lg-7">
					<!-- Default Card Example -->
					<div class="card">
						<div class="card-header">
							<i class="fas fa-info-circle"></i> Rezervasyon tamamlandı, ödeme onayına doğru ilerleyiniz.
						</div>

						<?php

						?>
						<div class="card-body" align="center">
							<p class="card-text">Bilet Rezervasyon Kodu:</p>
							<h1 class="card-title"><b>
									<?php echo $tiket; ?>
								</b></h1>
							<?php
							// Veritabanından kd_bilet değerini almak için gerekli sorguyu çalıştır
							$query = $this->db->get_where('siparis', array('kd_siparis' => $tiket));
							// Eğer sorgudan sonuç döndüyse
							if ($query->num_rows() > 0) {
								// İlk satırı al ve kd_bilet değerini $kd_bilet değişkenine ata
								$row = $query->row();
								$kd_bilet = $row->kd_bilet;
								// Eğer kd_bilet değeri bulunduysa, ekrana yazdır
								if (!empty ($kd_bilet)) {
									echo '<p class="card-text">PNR Kodu:</p>';
									echo '<h1 class="card-title"><b>' . $kd_bilet . '</b></h1>';
								} else {
									// kd_bilet değeri bulunamadıysa bir hata mesajı yazdır
									echo '<p class="card-text">Ticket code not found for the given booking code.</p>';
								}
							} else {
								// Belirtilen booking code ile sipariş bulunamadıysa bir hata mesajı yazdır
								echo '<p class="card-text">No order found for the given booking code.</p>';
							}
							?>
							<p><img src="<?php echo base_url('assets/frontend/upload/qrcode/' . $tiket) ?>.png"></p>
							<a href="<?php echo base_url('assets/frontend/upload/qrcode/' . $tiket) ?>.png"
								class="btn btn-danger" download> Qr Kodu indir</a>
							<a href="<?php echo base_url('bilet/payment/' . $tiket) ?>" class="btn btn-success">Ödemeyi
								Tamamla</a>
							<br>
							<p class="card-text">Ödeme İşlemine Devam Etmek İçin Lütfen Rezervasyon Kodunuzu ve
								QrCode'unuzu Kaydedin.</p>
						</div>
					</div>
				</div>
	</section>
	<!-- End banner Area -->
	<!-- start footer Area -->
	<?php $this->load->view('frontend/include/base_footer'); ?>
	<!-- js -->
	<?php $this->load->view('frontend/include/base_js'); ?>
</body>

</html>