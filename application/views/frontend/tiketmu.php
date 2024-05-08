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
	<!-- Site Title -->
	<!-- Log on to codeastro.com for more projects -->
	<title>Umuttepe Turizm</title>
	<link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet">
	<!--CSS-->
	<?php $this->load->view('frontend/include/base_css'); ?>
</head>

<body>
	<!-- navbar -->
	<?php $this->load->view('frontend/include/base_nav'); ?>
	<div class="generic-banner">
		<br>
		<div class="section-top-border">
			<h2 class="" align="center">Biletlerim </h2>
			<div class="container ">
				<div class="row d-flex justify-content-center">
					<?php foreach ($tiket as $row) { ?>
						<div class="col-sm-3">
							&nbsp;
							<div class="card " style="width: 18rem;">
								<img class="card-img-top" src="<?php echo base_url($row['qrcode_siparis']) ?>"
									alt="Card image cap">
								<div class="card-body" align="left">
									<?php if ($row['durum_siparis'] == '3') { ?>
										<a href="#" class="card-link">İptal Edildi</a>
									<?php } else { ?>
										<a href="<?php echo base_url() . $row['qrcode_siparis'] ?>" class="card-link"
											download>QR
											Kodu İndir</a>
									<?php } ?>
									<h5 class="card-title">PNR:
										<?php echo $row['kd_bilet']; ?>
									</h5>
									<p>İsim :
										<?php echo $row['isim_siparis']; ?>
										<br>Bilet Tarihi :
										<?php echo $row['tarih_kalkis_siparis']; ?></br>
										Ödeme Durumu:
										<?php if ($row['durum_siparis'] == '1') { ?>
											<i class='btn-danger'>Ödenmedi</i>
										<?php } else if ($row['durum_siparis'] == '3') { ?>
												<i class='btn-warning'>İptal Edildi</i>
										<?php } else { ?>

												<i class='btn-success'>Ödendi</i>
										<?php } ?>
										<hr>
										<?php if ($row['durum_siparis'] == '1') { ?>
											<a href="<?php echo base_url('bilet/payment/' . $row['kd_siparis']) ?>"
												class="btn btn-primary">Ödemeyi Tamamla</a>
										<?php } else if ($row['durum_siparis'] == '3') { ?>
												<a href="<?php echo base_url('tiket') ?>" class="btn btn-warning pull-right">Yeni
													Bilet
													Al</a>
										<?php } else { ?>
												<button class="btn btn-danger" id="iptalButton">İptal Et</button>
												<!-- İptal butonu eklendi -->

												<a href="<?php echo base_url('assets/backend/upload/ebilet/' . $row['kd_siparis'] . '.pdf') ?>"
													class="btn btn-success pull-right" download>Bileti Yazdır</a>
										<?php } ?>
								</div>
							</div>
						</div>
						&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
					<?php } ?>
				</div>
			</div>
			<br><br>
		</div>
	</div>
	<!-- Log on to codeastro.com for more projects -->
	<!-- End banner Area -->
	<!-- End Generic Start -->
	<!-- start footer Area -->
	<?php $this->load->view('frontend/include/base_footer'); ?>
	<!-- js -->
	<?php $this->load->view('frontend/include/base_js'); ?>
	<script>
		// İptal butonuna tıklandığında
		document.getElementById('iptalButton').addEventListener('click', function () {
			// Swal ile kullanıcıya onay mesajı göster
			swal({
				title: "Bileti iptal etmek istediğinize emin misiniz?",
				text: "Bu işlem geri alınamaz!",
				icon: "warning",
				buttons: true,
				dangerMode: true,
			})
				.then((willDelete) => {
					if (willDelete) {
						// Evet denildiğinde formu gönder
						var form = document.createElement("form");
						form.setAttribute("method", "post");
						form.setAttribute("action", "<?php echo base_url('profile/tiketsaya2/' . $row['kd_siparis']) ?>");

						// Gizli input oluştur
						var hiddenField = document.createElement("input");
						hiddenField.setAttribute("type", "hidden");
						hiddenField.setAttribute("name", "confirm_cancel");
						hiddenField.setAttribute("value", "1");
						form.appendChild(hiddenField);

						// Formu sayfaya ekle
						document.body.appendChild(form);

						// Formu gönder
						form.submit();
					}
				});
		});

	</script>
</body>

</html>