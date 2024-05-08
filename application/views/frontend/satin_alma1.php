<!DOCTYPE html>
<html lang="tr" class="no-js">

<head>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAXVgMKtzaIxsMgtrq8KGCMRzNh4owWano"></script>
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



	<!--CSS-->
	<?php $this->load->view('frontend/include/base_css'); ?>


	<script>
		function initMap() {
			var directionsService = new google.maps.DirectionsService;
			var directionsDisplay = new google.maps.DirectionsRenderer;
			var map = new google.maps.Map(document.getElementById('map'), {
				zoom: 7,
				center: { lat: 41.0082, lng: 28.9784 } // İstanbul koordinatları, başlangıç noktası olarak kullanılabilir.
			});
			directionsDisplay.setMap(map);
			calculateAndDisplayRoute(directionsService, directionsDisplay);
		}

		function calculateAndDisplayRoute(directionsService, directionsDisplay) {
			var start = "<?php echo $asal['sehir_varis']; ?>" // Başlangıç şehri
			var end = "<?php echo $jadwal['sehir_varis']; ?>"     // Varış şehri


			directionsService.route({
				origin: start,
				destination: end,
				travelMode: 'DRIVING'
			}, function (response, status) {
				if (status === 'OK') {
					directionsDisplay.setDirections(response);
				} else {
					window.alert('Rota bulunamadı: ' + status);
				}
			});
		}
	</script>

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
					<div class="card mb-5">
						<div class="card-header">
							<i class="fas fa-info-circle"></i> Bilet Bilgileri
						</div>
						<div class="card-body">
							<ul>
								<li>► Rota <b>
										<?php echo $asal['sehir_varis'] . " - " . $jadwal['sehir_varis'] . " [" . $jadwal['kd_varis'] . "]"; ?>
									</b></li>
								<li>►Otobüs Firması <b>
										<?php echo $jadwal['isim_otobus']; ?>
									</b></li>
								<li>► Otobüs Plakası <b>
										<?php echo $jadwal['plaka_otobus']; ?>
									</b></li>
								<li>► Kalkış Noktası <b>
										<?php echo strtoupper($asal['sehir_varis']) . " - " . $asal['terminal_varis']; ?>
									</b></li>
								<li>► Varış Noktası <b>
										<?php echo strtoupper($jadwal['sehir_varis']) . " - " . $jadwal['terminal_varis']; ?>
									</b></li>
								<li>► Fiyat: <b>
										<?php echo number_format((float) ($jadwal['fiyat_sefer']), 0, ",", "."); ?>
									</b> TL</li>
								<li>► Kalkış Tarihi <b>
										<?php echo nama_hari($tanggal) . "," . tgl_indo($tanggal) ?>
									</b></li>
								<li>► Kalkış Saati <b>
										<?php echo $jadwal['kalkis_saati_sefer']; ?>
									</b></li>
								<li>► Varış Saati <b>
										<?php echo $jadwal['varis_saati_sefer']; ?>
									</b></li>
							</ul>
						</div>
					</div>
				</div>



				<div class="col-lg-4">
					<form action="<?php echo base_url('bilet/afterbeli') ?>" method="get">
						<input type="hidden" name="tgl" value="<?php echo $tanggal ?>">
						<!-- Default Card Example -->
						<div class="card mb-5">
							<div class="card-header">
								<i class="fas fa-bus"></i> Koltuk Seçimi
							</div>

							<center class="">
								<?php
								$total_seats = 20;
								$seats_per_row = 3;
								$driver_seat_position = 0; // Driver's seat position
								$seat_number = 1; // Initialize seat number starting from 1
								
								?>

								<table class="">
									<?php for ($i = 0; $i < $total_seats; $i += $seats_per_row): ?>
										<tr>
											<?php for ($j = $i; $j < $i + $seats_per_row; $j++): ?>
												<?php if ($j == $driver_seat_position): ?>
													<td class=''>
														<label class='btn btn-primary'>
															<a value='' autocomplete='off' disabled='disabled'>Sürücü
																Koltuğu</a>
														</label>
													</td>
												<?php else: ?>

													<td class=''>
														<div>
															<?php
															$isChecked = false;
															foreach ($kursi as $koltuk) {
																if ($koltuk['no_koltuk_siparis'] == $seat_number) {
																	if ($koltuk['cinsiyet'] == 'Erkek') {
																		echo "<label class='custom-checkbox checked-e'>";
																	} elseif ($koltuk['cinsiyet'] == 'Kadin') {
																		echo "<label class='custom-checkbox checked-k'>";
																	}
																	$isChecked = true;
																	break;
																}
															}

															if (!$isChecked) {
																echo "<label class='custom-checkbox'>";
															}

															?>
															<input name='kursi[]' value='<?php echo $seat_number; ?>'
																id='<?php echo $seat_number; ?>'
																onclick='cer(this); showGenderPopUp(<?php echo $seat_number; ?>);'
																autocomplete='off' type='checkbox' <?php if ($isChecked) {
																	echo "disabled";
																} ?>>
															<?php echo $seat_number; ?>
															</label>
															<div id="genderPopUp_<?php echo $seat_number; ?>" class="pop-up">
																<button type="button" class="male"
																	onclick="handleGenderSelection('<?php echo $seat_number; ?>', 'Erkek')">Erkek
																</button>
																<button type="button" class="female"
																	onclick="handleGenderSelection('<?php echo $seat_number; ?>', 'Kadin')">Kadın
																</button>
															</div>
															<?php $seat_number++; ?>
														</div>
													</td>
												<?php endif; ?>
											<?php endfor; ?>
										</tr>
									<?php endfor; ?>
								</table>

							</center>

						</div>
				</div>

				<!-- Log on to codeastro.com for more projects -->
				<div class="col-lg-4">
					<!-- Default Card Example -->
					<div class="card mb-5">
						<div class="card-header">
							<i class="fas fa-bookmark"></i>
						</div>
						<div class="alert alert-success" role="alert">
							<p>Bir koltuk seçtikten sonra, devam etmek için lütfen 'İleri' düğmesine tıklayın.</p>
							<div class='btn-group'>
								<a href="<?php echo base_url('bilet/cekjadwal/' . $tanggal . '/' . $asal['kd_varis'] . '/' . $jadwal['sehir_varis']) ?>"
									class='btn btn-default'>Geri</a>
								<input class="btn btn-info pull-right" disabled="disabled" type="submit" value="İleri">
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-4">
					<div id="map" style="height: 500px; width: 1000px; "></div>
					<script>initMap();</script>
				</div>
			</div>
		</div>
	</section>
	<!-- End banner Area -->
	<!-- End Generic Start -->
	<!-- Log on to codeastro.com for more projects -->
	<!-- start footer Area -->
	<?php $this->load->view('frontend/include/base_footer'); ?>
	<style>
		.custom-checkbox input {
			display: none;
		}

		.custom-checkbox::before {
			content: "";
			display: none;
			position: absolute;
			top: 50%;
			left: 50%;
			width: 8px;
			height: 8px;
			background-color: #007bff;
			transform: translate(-50%, -50%);
		}

		.custom-checkbox input:checked+label::before {
			display: block;
		}

		.custom-checkbox.checked-e input:checked+label::before {
			background-color: lightblue;
		}

		.custom-checkbox.checked-k input:checked+label::before {
			background-color: lightpink;
		}

		.custom-checkbox {
			width: 40px;
			height: 40px;
			display: inline-block;
			cursor: pointer;
			text-align: center;
			border: 1px solid transparent;
			padding: 5px;
			margin: 5px;
			background-image: url('<?php echo base_url('assets/frontend/img/armchair.png'); ?>');
			background-size: cover;
			/* Ensure the background image covers the entire area */
			background-clip: padding-box;
			/* Clip the background image to the padding box */
			border-radius: 7px;
			/* Rounded corners for the checkbox */

		}

		.pop-up {
			display: none;
			position: absolute;
			background-color: #fff;
			border: 1px solid #ccc;
			padding: 10px;
			box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
			z-index: 1;
		}

		.pop-up button {
			margin: 5px;
		}

		.custom-checkbox.checked-e {
			background-color: lightskyblue;
		}

		.custom-checkbox.checked-k {
			background-color: palevioletred;
		}
	</style>

	<!-- js -->
	<script>
		var selectedSeatsCount = 0;

		jQuery(document).ready(function () {
			var checkboxes = $("input[type='checkbox']"),
				submitButt = $("input[type='submit']");

			checkboxes.click(function () {
				selectedSeatsCount = $("input[type='checkbox']:checked").length;
				submitButt.attr("disabled", selectedSeatsCount === 0);
				submitButt.attr("disabled", selectedSeatsCount > 4);
			});
		});

		function cer(checkbox) {
			var checkboxParent = checkbox.parentNode;

			if (checkbox.checked) {
				if (selectedSeatsCount >= 4) {
					swal("En fazla 4 koltuk seçebilirsiniz!");
					checkbox.checked = false;
				} else {
					if (!checkboxParent.style.backgroundColor || checkboxParent.style.backgroundColor !== "lightgreen") {
						checkboxParent.style.backgroundColor = "";
						selectedSeatsCount++;
					}
				}
			} else {
				checkboxParent.style.backgroundColor = "";
				selectedSeatsCount--;
			}
			enableNextButton();
		}

		function showGenderPopUp(seatNumber) {
			var genderPopUp = document.getElementById('genderPopUp_' + seatNumber);
			var checkbox = document.getElementById(seatNumber);

			if (checkbox.checked && (!checkbox.parentNode.style.backgroundColor || checkbox.parentNode.style.backgroundColor !== "lightgreen")) {
				genderPopUp.style.display = 'block';
			} else {
				genderPopUp.style.display = 'none';
			}
		}

		function handleGenderSelection(seatNumber, selectedGender) {
			var checkbox = document.getElementById(seatNumber);
			var genderPopUp = document.getElementById('genderPopUp_' + seatNumber);

			if (selectedGender === 'Erkek') {
				checkbox.parentNode.style.backgroundColor = 'lightblue';
			} else if (selectedGender === 'Kadin') {
				checkbox.parentNode.style.backgroundColor = 'lightpink';
			}

			genderPopUp.style.display = 'none';
			enableNextButton();
			var hiddenGenderInput = document.createElement('input');
			hiddenGenderInput.type = 'hidden';
			hiddenGenderInput.name = 'selectedGender[' + seatNumber + ']';
			hiddenGenderInput.value = selectedGender;
			document.forms[0].appendChild(hiddenGenderInput);

		}

		function enableNextButton() {
			var submitButt = $("input[type='submit']");
			var checkboxes = $("input[type='checkbox']:checked");
			submitButt.attr("disabled", checkboxes.length === 0 || checkboxes.length > 4);
		}

	</script>
	<?php $this->load->view('frontend/include/base_js'); ?>
</body>

</html>