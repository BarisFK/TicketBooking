<!DOCTYPE html>
<html lang="tr" class="no-js">

<head>
	<!-- Mobile Specific Meta -->
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Favicon-->
	<link rel="shortcut icon" href="img/elements/fav.png">
	<!-- Author Meta -->
	<meta name="author" content="colorlib">
	<!-- Meta Description -->
	<meta name="description" content="">
	<!-- Meta Keyword -->
	<meta name="keywords" content="">
	<!-- meta character set -->
	<meta charset="UTF-8">
	<!-- Log on to codeastro.com for more projects -->
	<!-- Site Title -->
	<title>Umuttepe Turizm</title>
	<link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet">
	<!--CSS-->
	<?php $this->load->view('frontend/include/base_css'); ?>
</head>

<body>
	<!-- navbar -->
	<?php $this->load->view('frontend/include/base_nav'); ?>
	<section class="service-area section-gap relative">
		<div class="overlay overlay-bg"></div>
		<div class="container">
			<div class="row">
				<div class="col-lg-4">
					<!-- Default Card Example -->
					<form action="<?php echo base_url() ?>bilet/gettiket/" method="post">
						<input type="hidden" name="tgl" value="<?php echo $tglberangkat ?>">

						<?php $i = 1;
						foreach ($kursi as $row) { ?>
							<div class="card mb-5">
								<div class="card-header">
									<i class="fas fa-id-card"></i>
									<?php echo $row; ?> Numaralı Koltuk
								</div>
								<div class="card-body">
									<div class="form-group">
										<label for="CN">Yolcunun İsmi</label>
										<input type="text" id="" class="form-control" id="" name="nama[]">
										<input type="hidden" name="kursi[]" value="<?php echo $row ?>">
									</div>
									<div class="form-group">
										<select name="tahun[]" class="form-control js-example-basic-single" required>
											<option value="" selected disabled="">Yolcunun Yaşı</option>

											<?php
											$thn_skr = 90;
											for ($x = $thn_skr; $x >= 1; $x--) {
												?>
												<option value="<?php echo $x ?>">
													<?php echo $x ?>
												</option>
												<?php
											}
											?>
										</select>
									</div>
									<div class="form-group">
										<label for="secenekler">Yolcu Tipi:</label>
										<div class="d-flex align-items-center">
											<select name="secenekler[]" class="form-control mr-2 secenekler">
												<option value="normal">Normal</option>
												<option value="ogrenci">Öğrenci(-%25)</option>
												<option value="memur">Memur(-%15)</option>
												<option value="yas65">65+ Yaş(-%15)</option>
												<option value="yas7">7 Yaş ve Altı</option>
											</select>

											<div class="form-control ml-1 fiyatGoster"
												style="width: 80%; background-color: limegreen;">
												<?php
												// $fiyat_sefer değerini burada gösterelim
												if (isset ($fiyat_sefer)) {
													echo 'Fiyat: <span class="fiyat">' . number_format((float) $fiyat_sefer, 0, ",", ".") . 'TL';
												}
												?>
											</div>
										</div>
									</div>

									<div class='form-group'>

										<label for="cinsiyet_<?php echo $row; ?>">Cinsiyet:
										</label>
										<select name='cinsiyet[]' id="cinsiyet_<?php echo $row; ?>" class='form-control'
											required>
											<option value='' disabled>Cinsiyet Seçiniz</option>
											<option value='Erkek' <?php echo (isset ($selectedGenders[$row]) && $selectedGenders[$row] == 'Erkek') ? 'selected' : ''; ?>>Erkek</option>
											<option value='Kadin' <?php echo (isset ($selectedGenders[$row]) && $selectedGenders[$row] == 'Kadin') ? 'selected' : ''; ?>>Kadın</option>
										</select>

									</div>
								</div>
							</div>
							<?php $i++;
						} ?>

				</div>
				<div class="col-sm-4">
					<?php
					foreach ($kursi as $index => $row) {
						// İlk geçişte selectedSeat'i güncelle
						if ($index === 0) {
							$selectedSeat = $row;
						}
						?>
						<div class="card mb-5">
							<div class="card-header">
								<i class="fas fa-user"></i> Yolcu Bilgileri
								<?php echo $row; ?>
							</div>
							<div class="card-body">
								<div class='form-group'>
									<div class='col-sm-12'>
										<input name='no_ktp' required="" maxlength='64' class='form-control required'
											placeholder='Kimlik Numarası' type='text' title='Zorunlu alan'
											value="<?php echo ($row == $selectedSeat) ? $this->session->userdata('ktp') : ''; ?>">
									</div>
								</div>
								<div class='form-group'>
									<div class='col-sm-12'>
										<input name='nama_pemesan' required="" maxlength='64' class='form-control required'
											placeholder='Müşteri Numarası' type='text' title='Zorunlu alan'
											value="<?php echo ($row == $selectedSeat) ? $this->session->userdata('nama_lengkap') : ''; ?>">
									</div>
								</div>
								<div class='form-group'>
									<div class='col-sm-12'>
										<input name='hp' required="" maxlength='16' class='form-control required'
											placeholder='Telefon Numarası' type='text' title='Zorunlu alan'
											value="<?php echo ($row == $selectedSeat) ? $this->session->userdata('telpon') : ''; ?>">
									</div>
								</div>
								<div class='form-group'>
									<div class='col-sm-12'>
										<textarea name='alamat' cols='20' rows='3' id='alamat' required="" maxlength='256'
											class='form-control required' placeholder='Adres'
											title='Zorunlu alan'><?php echo ($row == $selectedSeat) ? $this->session->userdata('alamat') : ''; ?></textarea>
									</div>
								</div>
								<div class='form-group'>
									<div class='col-sm-12'>
										<input name='email' required="" maxlength='64' class='form-control'
											placeholder='Email' type='text'
											value="<?php echo ($row == $selectedSeat) ? $this->session->userdata('email') : ''; ?>">
									</div>
								</div>



							</div>
							<!-- Diğer input alanları için aynı mantıkla devam edebilirsiniz -->
						</div>

					<?php } ?>
				</div>

				<div class="col">
					<div class="card">
						<div class="card-header">
							<i class="fas fa-dollar-sign"></i> Ödeme Yöntemi
						</div>
						<div class="card-body">
							<form action="<?php echo base_url() ?>bilet/cektiketmu" method="post">
								<div class="form-group">
									<label for="exampleInputEmail1">Banka </label>
									<select class="form-control" name="bank" required>
										<option value="" selected disabled="">Banka seçiniz</option>
										<?php foreach ($bank as $row) { ?>
											<option value="<?php echo $row['kd_banka'] ?>">
												<?php echo $row['isim_banka']; ?>
											</option>
										<?php } ?>
									</select>
								</div>
								<hr>
								<div class='form-group'>
									<a href='javascript:history.back()' class='btn btn-default pull-left'>Geri</a>
									<button class="btn btn-success pull-right">Bilet Onayı</button>
								</div>
							</form>
							<!-- Log on to codeastro.com for more projects -->
						</div>

					</div>
				</div>
			</div>
	</section>
	<!-- End banner Area -->
	<!-- End Generic Start -->
	<!-- start footer Area -->
	<?php $this->load->view('frontend/include/base_footer'); ?>
	<!-- js -->
	<?php $this->load->view('frontend/include/base_js'); ?>
	<script type="text/javascript">
		$(document).ready(function () {
			$('.js-example-basic-single').select2();
		});
	</script>
	<script>
		document.querySelectorAll('.secenekler').forEach(function (secenekler, index) {
			secenekler.addEventListener('change', function () {
				var fiyat = parseFloat(<?php echo json_encode($fiyat_sefer); ?>);
				var secenek = this.value;
				var indirimOrani = 0;

				if (secenek == 'ogrenci') {
					indirimOrani = 25;
				} else if (secenek != 'normal') {
					indirimOrani = 15;
				}

				var indirimMiktari = (fiyat * indirimOrani) / 100;
				fiyat -= indirimMiktari;

				var fiyatGosterElement = this.closest('.d-flex').querySelector('.fiyatGoster .fiyat');
				fiyatGosterElement.textContent = fiyat.toFixed(1) + 'TL';

				var yaşSeçimi = this.closest('.card-body').querySelector('select[name="tahun[]"]');
				if (secenek === 'yas7') {
					<?php $fiyat_sefer = 0; ?> // Fiyatı 0 yap
					fiyatGosterElement.textContent = '0TL'; // Fiyat gösterim alanına 0TL yaz
					yaşSeçimi.value = ''; // Yaş seçimini temizle
					yaşSeçimi.setAttribute('disabled', true); // Yaş seçimini devre dışı bırak
				} else if (secenek === 'yas65') {
					yaşSeçimi.value = ''; // Yaş seçimini temizle
					yaşSeçimi.setAttribute('disabled', true); // Diğer durumlarda yaş seçimini etkinleştir
				} else {
					yaşSeçimi.removeAttribute('disabled'); // Diğer durumlarda yaş seçimini etkinleştir
				}
			});
		});
	</script>

</body>

</html>