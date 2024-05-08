<style>
	.nav-menu {
		display: flex;
		/* Flexbox modelini etkinleştir */
		justify-content: center;
		/* Öğeleri yatayda ortalar */
		list-style-type: none;
		/* Liste işaretlerini kaldırır */
		padding-left: 0;
		/* Varsayılan padding'i sıfırlar */
	}

	.nav-menu li {
		padding: 10px;
		/* Liste öğelerine padding ekler */
	}
</style>
<header id="header" id="home">
	<div class="container">
		<div class=" align-items-center justify-content-between ">
			<div id="logo" style="text-align:center; margin-bottom: 15px;">
				<a href="<?php echo base_url() ?>bilet">
					<h3> <b><i class=" fas fa-ticket-alt"></i> Umuttepe Turizm</b></h3>
				</a>
			</div>
			<nav id="nav-menu">
				<ul class="nav-menu">

					<li><a href="<?php echo base_url() ?>bilet">Bilet Al</a></li>
					<li class="menu"><a href="<?php echo base_url() ?>bilet/cektiket">Bilet Kontrol</a></li>
					<?php if ($this->session->userdata('username')) { ?>
						<li class="menu-has-children"><a href="#">Merhaba,
								<?php echo $this->session->userdata('nama_lengkap'); ?>
							</a>
							<ul>
								<li><a
										href="<?php echo base_url() ?>profil/profilesaya/<?php echo $this->session->userdata('kd_pelanggan') ?>"><i
											class="fas fa-id-card"></i> Profilim</a></li>
								<li><a
										href="<?php echo base_url() ?>profil/tiketsaya/<?php echo $this->session->userdata('kd_pelanggan') ?>"><i
											class="fas fa-ticket-alt"></i> Biletlerim</a></li>
								<li><a href="<?php echo base_url() ?>giris/logout"><i class="fas fa-sign-out-alt"></i>
										Çıkış</a></li>
							</ul>
						</li>
					<?php } else { ?>
						<li class="menu wobble animated"><a href="<?php echo base_url() ?>giris/daftar">Kayıt Ol</a></li>
						<li><a href="<?php echo base_url() ?>giris">Giriş</a></li>
					<?php } ?>
				</ul>
			</nav><!-- #nav-menu-container -->
		</div>
	</div>
</header><!-- #header -->