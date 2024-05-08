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
	<title>My Profile</title>
	<link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet">
	<!--CSS-->
	<style type="text/css">
		.text-block {
			position: absolute;
			bottom: 20px;
			right: 20px;
			background-color: black;
			color: white;
			padding-left: 20px;
			padding-right: 20px;
		}
	</style>
	<?php $this->load->view('frontend/include/base_css'); ?>
</head>

<body>
	<!-- navbar -->
	<?php $this->load->view('frontend/include/base_nav'); ?>
	<section class="generic-banner relative">
		<div class="container">
			<div class="section-top-border">
				<h3 class="mb-30" align="center">Profilim</h3>
				<div class="row d-flex justify-content-center">
					<div class="col-lg-6">
						<!-- Default Card Example -->
						<div class="card" align="left">
							<div class="card-header">
								<i class="fas fa-user"></i> Hesap Bilgileri
							</div>
							<div class="card-body">
								<table>
									<tr>
										<center>
											<p class="card-title">
												<img src="<?php echo base_url($profile['resim_musteri']) ?>"
													alt="<?php echo $this->session->userdata('ktp') ?>"
													style="width:100px;height:100px">
											</p>
										</center>
									</tr>
									<tr>
										<td>
											<h5 class="card-title">Kimlik Numarası </h5>
										</td>
										<td>
											<p class="card-title">
												<?php echo $profile['no_ktp_musteri'] ?>
											</p>
										</td>
									</tr>
									<tr>
										<td>
											<h5 class="card-title">Ad-Soyad </h5>
										</td>
										<td>
											<p class="card-title">
												<?php echo $profile['isim_musteri'] ?>
											</p>
										</td>
									</tr>
									<tr>
										<td>
											<h5 class="card-title">Email </h5>
										</td>
										<td>
											<p class="card-title">
												<?php echo $profile['email_musteri'] ?>
											</p>
										</td>
									</tr>
									<tr>
										<td>
											<h5 class="card-title">Telefon Numarası </h5>
										</td>
										<td>
											<p class="card-title">
												<?php echo $profile['telpon_musteri'] ?>
											</p>
										</td>
									</tr>
									<tr>
										<td>
											<h5 class="card-title">Adres </h5>
										</td>
										<td>
											<p class="card-title">
												<?php echo $profile['adres_musteri'] ?>
											</p>
										</td>
									</tr>
								</table>
								<div class="row">
									<div class="col-sm-12" align="center">
										<button data-toggle="modal" data-target="#exampleModal"
											class="btn btn-primary">Bilgilerimi Düzenle</button>
										<a href="<?php echo base_url('profile/changepassword/' . $profile['kd_musteri']) ?>"
											class="btn btn-primary">Şifremi Değiştir</a>
									</div>
								</div>
							</div>

						</div>
					</div>
				</div>
	</section>
	<!-- Log on to codeastro.com for more projects -->
	<div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog"
		aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Bilgilerimi Düzenle</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="<?php echo base_url('profile/editprofile') ?>" method="post"
						enctype="multipart/form-data">
						<div class="card-body">
							<div class="row">
								<div class="col-sm-14">
									<div class="row form-group">
										<label for="nama" class="control-label">Kimlik Numarası</label>
										<input type="text" class="form-control" name="ktp"
											value="<?php echo $profile['no_ktp_musteri'] ?>">
										<input type="hidden" name="kode" value="<?php echo $profile['kd_musteri'] ?>">
									</div>
									<div class="row form-group">
										<label for="nama" class="control-label">Ad-Soyad</label>
										<input type="text" class="form-control" name="nama"
											value="<?php echo $profile['isim_musteri'] ?>">
									</div>
									<div class="row form-group">
										<label for="nama" class="control-label">Email</label>
										<input type="email" class="form-control" name="email"
											value="<?php echo $profile['email_musteri'] ?>">
									</div>
									<div class="row form-group">
										<label for="nama" class="control-label">Telefon Numarası</label>
										<input type="text" class="form-control" name="hp"
											value="<?php echo $profile['telpon_musteri'] ?>">
									</div>
									<div class="row form-group">
										<label for="nama" class="control-label">Adres</label>
										<input type="text" class="form-control" name="alamat"
											value="<?php echo $profile['adres_musteri'] ?>">
									</div>
									<div class="row form-group">
										<label for="" class="control-label">Profil Fotoğrafı</label>
										<img src="<?php echo base_url($profile['resim_musteri']) ?>"
											alt="<?php echo $this->session->userdata('ktp') ?>"
											style="width:150px;height:150px"><input type="file" class="form-control"
											value="<?php echo base_url($this->session->userdata('nama_lengkap')) ?>"
											name="img">
									</div>
								</div>
							</div>
						</div>
				</div>
				<button class="btn btn-danger" data-dismiss="modal">Vazgeç</button>
				<button type="submit" class="btn btn-primary">Değişiklikleri Kaydet</button>
				</form>
			</div>
		</div>
	</div>
	<!-- Log on to codeastro.com for more projects -->
	<?php $this->load->view('frontend/include/base_footer'); ?>
	<!-- js -->
	<?php $this->load->view('frontend/include/base_js'); ?>
</body>

</html>