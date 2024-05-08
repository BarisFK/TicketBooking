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
	<title>Get Tickets</title>
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
				<div class="col-lg-6">
					<!-- Default Card Example -->
					<div class="card wobble animated">
						<div class="card-header">
							Ödeme Sayfası
						</div>
						<div class="card-body">
							<form action="<?= base_url() ?>bilet/insertkonfirmasi" method="post">
								<div class="form-group">
									<label for="exampleInputEmail1">Bilet Kodu</label>
									<input type="text" id="" class="form-control" id="" name="kd_siparis"
										value="<?= $id ?>" placeholder="Bilet Kodu" readonly>
								</div>
								<div class="form-group">
									<label for="exampleInputEmail1">Kart Sahibinin Adı</label>
									<input type="text" class="form-control" name="nama" value=""
										placeholder="Adı Soyadı" required>
								</div>
								<div class="form-group">
									<label for="exampleInputEmail1">Kart Numarası</label>
									<input type="number" class="form-control" name="nomrek" value=""
										placeholder="Kart numarasını giriniz" required>
								</div>
								<div class="form-group">
									<label for="exampleInputEmail1">Son Kullanma Tarihi (Ay/Yıl):</label>
									<div class="row">
										<div class="col-md-6">
											<input type="number" class="form-control" name="expiryMonth"
												placeholder="Ay" min="1" max="12" required>
										</div>
										<div class="col-md-6">
											<input type="number" class="form-control" name="expiryYear"
												placeholder="Yıl" min="<?= date('Y') ?>" max="<?= date('Y') + 15 ?>"
												required>
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="row">
										<div class="col-md-6">
											<label for="exampleInputEmail1">Ödeme Miktarı</label>
											<input type="number" class="form-control" name="total" value="<?= $total ?>"
												placeholder="Toplam Ödeme" readonly>
										</div>
									</div>
								</div>
								<button type="submit" class="btn btn-success pull-right">Onayla </button>
							</form>
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