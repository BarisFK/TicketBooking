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
	<title>Payment</title>
	<link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet">
	<!--CSS-->
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/frontend/datepicker/dcalendar.picker.css">
	<?php $this->load->view('frontend/include/base_css'); ?>
</head>

<body>
	<!-- navbar -->
	<?php $this->load->view('frontend/include/base_nav'); ?>
	<section class="service-area section-gap relative">
		<div class="overlay overlay-bg"></div>
		<div class="container">
			<div class="row d-flex justify-content-center">
				<div class="col-lg-10">
					<!-- Default Card Example -->
					<div class="card mb-5">
						<div class="card-header" align="center">
							<b><i class="fas fa-ticket-alt"></i> Rezervasyon Kodu
								<?= $tiket[0]['kd_siparis']; ?>
							</b>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-striped table-bordered">
									<thead>
										<tr>
											<th scope="col">PNR Kodu</th>
											<th scope="col">Sefer Kodu [Otobüs Kodu]</th>
											<th scope="col">Tarih</th>
											<th scope="col">Koltuk Numarası</th>
											<th scope="col">Fiyat</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$total = 0;
										foreach ($tiket as $row) {
											$total += $row['fiyat'];
											?>
											<tr>
												<?php
												$now = hari_indo(date('N', strtotime($row['tarih_kalkis_siparis']))) . ', ' . tanggal_indo(date('Y-m-d', strtotime('' . $row['tarih_kalkis_siparis'] . ''))) . ', ' . date('H:i', strtotime($row['kalkis_saati_sefer']));
												?>
												<th scope="row">
													<?= $row['kd_bilet']; ?>
												</th>
												<td>
													<?= $row['kd_sefer'] . " [" . $row['kd_otobus'] . ']' ?>
												</td>
												<td>
													<?= $now ?>
												</td>
												<td>
													<?= $row['no_koltuk_siparis']; ?>
												</td>
												<td>
													<?= $row['fiyat']; ?> TL
												</td>
											</tr>
										<?php } ?>
										<td colspan="5"> <b class="pull-right">Toplam
												<?= $total ?> TL
											</b></td>

									</tbody>
								</table>
								<div class="card-body" align="center">
									<a href="<?= base_url('bilet/konfirmasi/' . $tiket[0]['kd_siparis'] . '/' . $total) ?>"
										class="btn btn-primary pull-center">Ödeme Onayı</a>
								</div>
							</div>
						</div>
					</div>
				</div>
	</section>
	<!-- End banner Area -->
	<!-- Log on to codeastro.com for more projects -->
	<!-- start footer Area -->
	<?php $this->load->view('frontend/include/base_footer'); ?>
	<!-- js -->
	<?php $expired1 = tanggal_ing(date('Y-m-d', strtotime($tiket[0]['gecerlilik_siparis']))) . ', ' . date('Y', strtotime($tiket[0]['gecerlilik_siparis'])) . ' ' . date('H:i', strtotime($tiket[0]['gecerlilik_siparis'])) ?>
	<script>
		function myFunction() {
			var copyText = document.getElementById("myInput");
			copyText.select();
			document.execCommand("copy");
			swal("Copy", "Successfully Copied Account Number", "info");
		}
	</script>
	<script>
		// Set the date we're counting down to
		var countDownDate = new Date("<?= $expired1 ?>").getTime();
		// Update the count down every 1 second
		var x = setInterval(function () {
			// Get todays date and time
			var now = new Date().getTime();
			// Find the distance between now and the count down date
			var distance = countDownDate - now;
			// Time calculations for days, hours, minutes and seconds
			var days = Math.floor(distance / (1000 * 60 * 60 * 24));
			var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
			var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
			var seconds = Math.floor((distance % (1000 * 60)) / 1000);
			// Output the result in an element with id="demo"
			document.getElementById("expired").innerHTML = hours + " Hour : "
				+ minutes + " Minute : " + seconds + " Seconds ";
			// If the count down is over, write some text
			if (distance < 0) {
				clearInterval(x);
				document.getElementById("expired").innerHTML = "Payment Time Complete";
			}
		}, 1000);
	</script>
	<?php $this->load->view('frontend/include/base_js'); ?>
</body>

</html>