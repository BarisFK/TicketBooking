-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 21, 2024 at 04:01 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `umuttepe_turizm`
--

-- --------------------------------------------------------

--
-- Table structure for table `alt_menu`
--

CREATE TABLE `alt_menu` (
  `kd_alt_menu` int(11) NOT NULL,
  `kd_menu` int(11) DEFAULT NULL,
  `baslik_alt_menu` varchar(128) DEFAULT NULL,
  `url_alt_menu` varchar(128) DEFAULT NULL,
  `aktif_alt_menu` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `alt_menu`
--

INSERT INTO `alt_menu` (`kd_alt_menu`, `kd_menu`, `baslik_alt_menu`, `url_alt_menu`, `aktif_alt_menu`) VALUES
(0, 1, 'Dashboard', 'backend/home', '1');

-- --------------------------------------------------------

--
-- Table structure for table `banka`
--

CREATE TABLE `banka` (
  `kd_banka` varchar(50) NOT NULL,
  `musteri_banka` varchar(50) DEFAULT NULL,
  `isim_banka` varchar(50) DEFAULT NULL,
  `hesapno_banka` varchar(50) DEFAULT NULL,
  `resim_banka` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `banka`
--

INSERT INTO `banka` (`kd_banka`, `musteri_banka`, `isim_banka`, `hesapno_banka`, `resim_banka`) VALUES
('BNK0001', 'DMB', 'Ziraat Bank', '600000521', 'assets/frontend/img/bank/dominionbank.png'),
('BNK0002', 'BVB', 'YapiKredi', '107556540', 'assets/frontend/img/bank/bvbank.png'),
('BNK0003', 'CBK', 'Is Bankasi', '800140000', 'assets/frontend/img/bank/cloverbank.png');

-- --------------------------------------------------------

--
-- Table structure for table `bilet`
--

CREATE TABLE `bilet` (
  `kd_bilet` varchar(50) NOT NULL,
  `kd_siparis` varchar(50) DEFAULT NULL,
  `isim_bilet` varchar(50) DEFAULT NULL,
  `koltuk_bilet` varchar(50) DEFAULT NULL,
  `yas_bilet` varchar(50) DEFAULT NULL,
  `alis_yeri_bilet` varchar(50) DEFAULT NULL,
  `fiyat_bilet` varchar(50) NOT NULL,
  `etiket_bilet` varchar(100) DEFAULT NULL,
  `durum_bilet` varchar(50) NOT NULL,
  `olusturma_tarih_bilet` date DEFAULT NULL,
  `olusturan_yonetici_bilet` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `bilet`
--

INSERT INTO `bilet` (`kd_bilet`, `kd_siparis`, `isim_bilet`, `koltuk_bilet`, `yas_bilet`, `alis_yeri_bilet`, `fiyat_bilet`, `etiket_bilet`, `durum_bilet`, `olusturma_tarih_bilet`, `olusturan_yonetici_bilet`) VALUES
('TORD00001J00012022122915', 'ORD00001', 'Ellen', '15', '31 Years', 'TJ019', '68', 'assets/backend/upload/ebilet/ORD00001.pdf', '2', '2022-12-28', 'admin'),
('TORD00002J00012022123018', 'ORD00002', 'Andie Sand', '18', '30 Years', 'TJ019', '68', 'assets/backend/upload/ebilet/ORD00002.pdf', '2', '2022-12-29', 'owner'),
('TORD00004J00052022123110', 'ORD00004', 'Delbert Rochelle', '10', '32 Years', 'TJ016', '40', 'assets/backend/upload/ebilet/ORD00004.pdf', '2', '2022-12-30', 'admin'),
('TORD00005J0003202212318', 'ORD00005', 'Ruth Russo', '8', '32 Years', 'TJ011', '89', 'assets/backend/upload/ebilet/ORD00005.pdf', '2', '2022-12-30', 'owner'),
('TORD00005J0003202212319', 'ORD00005', 'Jake Russo', '9', '35 Years', 'TJ011', '89', 'assets/backend/upload/ebilet/ORD00005.pdf', '2', '2022-12-30', 'owner'),
('TORD00006J00012022123123', 'ORD00006', 'Carl J. Montoya', '23', '25 Years', 'TJ019', '68', 'assets/backend/upload/ebilet/ORD00006.pdf', '2', '2022-12-30', 'owner'),
('TORD00007J0015202301023', 'ORD00007', 'Diana Kirk', '3', '39 Years', 'TJ013', '40', 'assets/backend/upload/ebilet/ORD00007.pdf', '2', '2022-12-30', 'owner'),
('TORD00008J00172023010122', 'ORD00008', 'Agnes Wonka', '22', '41 Years', 'TJ009', '59', 'assets/backend/upload/ebilet/ORD00008.pdf', '2', '2022-12-30', 'owner');

-- --------------------------------------------------------

--
-- Table structure for table `erisim_menusu`
--

CREATE TABLE `erisim_menusu` (
  `kd_erisim_menusu` int(11) DEFAULT NULL,
  `kd_seviye` int(11) DEFAULT NULL,
  `kd_menu` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `erisim_menusu`
--

INSERT INTO `erisim_menusu` (`kd_erisim_menusu`, `kd_seviye`, `kd_menu`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 2),
(1, 1, 1),
(2, 1, 2),
(3, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `kd_menu` int(11) NOT NULL,
  `isim_menu` varchar(50) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`kd_menu`, `isim_menu`) VALUES
(1, 'owner'),
(2, 'administrator');

-- --------------------------------------------------------

--
-- Table structure for table `musteri`
--

CREATE TABLE `musteri` (
  `kd_musteri` varchar(50) NOT NULL,
  `kullanici_adi_musteri` varchar(50) NOT NULL,
  `sifre_musteri` varchar(200) NOT NULL,
  `no_ktp_musteri` varchar(50) NOT NULL,
  `isim_musteri` varchar(100) NOT NULL,
  `adres_musteri` varchar(200) NOT NULL,
  `email_musteri` varchar(100) NOT NULL,
  `telpon_musteri` varchar(20) NOT NULL,
  `resim_musteri` varchar(200) NOT NULL,
  `durum_musteri` int(1) DEFAULT NULL,
  `olusturma_tarihi_musteri` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `musteri`
--

INSERT INTO `musteri` (`kd_musteri`, `kullanici_adi_musteri`, `sifre_musteri`, `no_ktp_musteri`, `isim_musteri`, `adres_musteri`, `email_musteri`, `telpon_musteri`, `resim_musteri`, `durum_musteri`, `olusturma_tarihi_musteri`) VALUES
('CA0006', 'tiffewis', '$2y$10$pwr/ZSCVcya8JOV1Xt13qeRzhz.nLsJGWYcWWZJgR5DFLUfjJeaGO', '', 'Tiffany G. Lewis', '72 Raintree Boulevard', 'tiffewis101@mail.com', '0978542255', 'assets/frontend/img/default.png', 1, '1554385261'),
('CA0004', 'danielw', '$2y$10$hHamfvIRbCNYiAvS289f0uj.T6kUfpfxTUcI210SLRqdTrxj4zyxG', '78456', 'Daniel Winkles', '52 Coplin Avenue', 'danielw@mail.com', '021212545', 'assets/frontend/img/default.png', 1, '1554017732'),
('CA0005', 'ellington', '$2y$10$PYDzqnOpzeGSo0ngK40Q1.M77oxnQ7fvhMYpI2q/JoZFS5r.g5FPG', '321963127368762639', 'Robert N. Ellington', '31 Andell Road', 'robelli@mail.com', '0147410147', 'assets/frontend/img/default.png', 1, '1554340197'),
('CA0003', 'ruffner', '$2y$10$N6imN8KmAhuw9rH.iJxGLeVaRCG.27UmhHVF7MaICMhYlm.TGJ9iy', '346454215172455', 'Pearl R. Ruffner', '93 Steele Street', 'ruffp@mail.com', '9458001455', 'assets/frontend/img/default.png', 1, '1552397128'),
('CA0001', 'oscarharrison', '$2y$10$PO4viVqheGgw7HPeozUih.V6qK4aWKbACLMe9UWOoSaJ8pSdaiISG', '021452125', 'Oscar A. Harrison', '59 Pine Tree Lane', 'oscar.harrison69@mail.com', '0455658500', 'assets/frontend/img/default.png', 1, '1552199781'),
('CA0002', 'bettyb', '$2y$10$wzz5.QSqiNfrc2JKuYK5huJHEvry340XZlspPACOJLf0TmU3yu30.', '02564651321564', 'Betty B. McMillan\n', '62 Limer Street', 'bettymcm@mail.com', '7014445450', 'assets/frontend/img/default.png', 1, '1552202266'),
('CA0024', 'baris', '$2y$10$mQMJ1dj21QzzHZAHfj7ipODlYQhKFPGUdnr3fheZppSjp0ndPAw4W', '1', 'b', 'b', 'b@gmail.com', '1', 'assets/frontend/img/default.png', 1, '1709741594'),
('CA0023', 'williams', '$2y$10$oU/PX/oEKmoxbUHJQvtKmOHYktfhyROtQYbwHUJiMVi.nCH49wgfG', '', 'Will Williams', '47 Wilson Street', 'williams@mail.com', '7014698500', 'assets/frontend/img/default.png', 1, '1672417879');

-- --------------------------------------------------------

--
-- Table structure for table `musteri_token`
--

CREATE TABLE `musteri_token` (
  `kd_musteri_token` int(11) NOT NULL,
  `isim_musteri_token` varchar(256) DEFAULT NULL,
  `email_musteri_token` varchar(50) DEFAULT NULL,
  `olusturma_tarih_musteri_token` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `musteri_token`
--

INSERT INTO `musteri_token` (`kd_musteri_token`, `isim_musteri_token`, `email_musteri_token`, `olusturma_tarih_musteri_token`) VALUES
(1, '65a01b40a0cc44076458f9d00ce94720', 'demo@mail.com', 1634359787),
(2, 'dd79d52fe9968f73fc66a1d481778655', 'john@mail.com', 1642506186),
(3, 'cd7b785a63c58898bfed23bab186ee1d', 'christine@mail.com', 1672227893),
(4, '616b4176a96b190073514fd3c154c2e0', 'ellen@mail.com', 1672229234),
(5, '87702b38ef9a5b80a98c077c43073182', 'andie@mail.com', 1672235116),
(6, '02a2fcb0be5250471a94142ed81d04df', 'robert@mail.com', 1672247531),
(7, '6f531b65df037f2f7ba0fb78231e577d', 'delbert@mail.com', 1672333316),
(8, '9d40b5ed83fc9cb3ce68f7050d69ee6a', 'ruth@mail.com', 1672336612),
(9, '0cb29395d911e02aba3a746691d7f5cf', 'carl@mail.com', 1672388181),
(10, '276466e9d4a5d8003fde3aa3990f46ae', 'demo@mail.com', 1672396084),
(11, '36c79fa8f57a423a794d8421be08e024', 'diana@mail.com', 1672401155),
(12, '51f91e83a25741a3626f99d0dbf0f5a0', 'agnes@mail.com', 1672401850),
(13, '2ec7e10ab13703d8817a2e74f712f45a', 'mary@mail.com', 1672402552),
(14, '3fed0f58dd880c8fa5f606e7a2b878bf', 'thomasf@mail.com', 1672402730),
(15, 'ca46de539fd1c62fa3614d0b18539233', 'shane@mail.com', 1672414382),
(16, 'a98db0cf72281841d03067c42ab953ac', 'basteven@mail.com', 1672414504),
(17, '6a05822bb349381f20ba0b464559879b', 'williams@mail.com', 1672417879),
(18, 'abaa3e25de15e00e80c166348487f163', 'b@gmail.com', 1709741594);

-- --------------------------------------------------------

--
-- Table structure for table `onaylama`
--

CREATE TABLE `onaylama` (
  `kd_onaylama` varchar(50) NOT NULL,
  `kd_siparis` varchar(50) DEFAULT NULL,
  `isim_onaylama` varchar(50) DEFAULT NULL,
  `isim_banka_onaylama` varchar(50) DEFAULT NULL,
  `hesapno_onaylama` varchar(50) DEFAULT NULL,
  `toplam_onaylama` varchar(50) DEFAULT NULL,
  `resim_onaylama` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `onaylama`
--

INSERT INTO `onaylama` (`kd_onaylama`, `kd_siparis`, `isim_onaylama`, `isim_banka_onaylama`, `hesapno_onaylama`, `toplam_onaylama`, `resim_onaylama`) VALUES
('KF0001', 'ORD00001', 'Ellen', 'New Leaf Bank', '197777450', '68', '/assets/frontend/upload/payment/sample_image.jpg'),
('KF0002', 'ORD00002', 'Andie Sand', 'RoyalCrown Bank', '701111458', '68', '/assets/frontend/upload/payment/sample_image.jpg'),
('KF0003', 'ORD00004', 'Delbert', 'New Leaf Bank', '1000008569', '40', '/assets/frontend/upload/payment/sample_image.jpg'),
('KF0004', 'ORD00005', 'Ruth Russo', 'Aurora', '001114547', '178', '/assets/frontend/upload/payment/sample_image.jpg'),
('KF0005', 'ORD00006', 'Carl J. Montoya', 'RoyalCrown Bank', '100045855', '68', '/assets/frontend/upload/payment/sample_image.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `otobus`
--

CREATE TABLE `otobus` (
  `kd_otobus` varchar(50) NOT NULL,
  `isim_otobus` varchar(50) DEFAULT NULL,
  `plaka_otobus` varchar(50) DEFAULT NULL,
  `kapasite_otobus` int(13) DEFAULT NULL,
  `durum_otobus` int(1) DEFAULT NULL,
  `aciklama_otobus` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `otobus`
--

INSERT INTO `otobus` (`kd_otobus`, `isim_otobus`, `plaka_otobus`, `kapasite_otobus`, `durum_otobus`, `aciklama_otobus`) VALUES
('B001', 'Umuttepe Seyahat', '41BSM0092', 20, 1, NULL),
('B002', 'Luks Samandag', '31BSM0092', 20, 1, NULL),
('B003', 'Rize Ses', '53BSM0092', 20, 1, NULL),
('B004', 'Öz Dadas Turizm', '25BSM0092', 20, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sefer`
--

CREATE TABLE `sefer` (
  `kd_sefer` varchar(50) NOT NULL,
  `kd_otobus` varchar(50) DEFAULT NULL,
  `kd_varis` varchar(50) DEFAULT NULL,
  `kd_kalkis` varchar(50) DEFAULT NULL,
  `sefer_alani` varchar(50) DEFAULT NULL,
  `kalkis_saati_sefer` time DEFAULT NULL,
  `varis_saati_sefer` time DEFAULT NULL,
  `fiyat_sefer` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `sefer`
--

INSERT INTO `sefer` (`kd_sefer`, `kd_otobus`, `kd_varis`, `kd_kalkis`, `sefer_alani`, `kalkis_saati_sefer`, `varis_saati_sefer`, `fiyat_sefer`) VALUES
('J0011', 'B006', 'TJ021', 'TJ020', 'Samandag', '12:00:00', '23:23:00', '850'),
('J0012', 'B006', 'TJ023', 'TJ020', 'Erzurum', '09:00:00', '18:30:00', '650'),
('J0013', 'B008', 'TJ022', 'TJ020', 'Rize', '10:30:00', '17:30:00', '500'),
('J0014', 'B001', 'TJ023', 'TJ020', 'Erzurum', '09:00:00', '18:30:00', '650'),
('J0015', 'B004', 'TJ020', 'TJ023', 'Izmit', '20:36:00', '22:36:00', '500');

-- --------------------------------------------------------

--
-- Table structure for table `seviye`
--

CREATE TABLE `seviye` (
  `kd_seviye` int(11) NOT NULL,
  `isim_seviye` varchar(50) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `seviye`
--

INSERT INTO `seviye` (`kd_seviye`, `isim_seviye`) VALUES
(1, 'owner'),
(2, 'administrator');

-- --------------------------------------------------------

--
-- Table structure for table `siparis`
--

CREATE TABLE `siparis` (
  `id_siparis` int(11) NOT NULL,
  `kd_siparis` varchar(50) DEFAULT NULL,
  `kd_bilet` varchar(50) DEFAULT NULL,
  `kd_sefer` varchar(50) DEFAULT NULL,
  `kd_musteri` varchar(50) DEFAULT NULL,
  `kd_banka` varchar(50) DEFAULT NULL,
  `kalkis_siparis` varchar(200) DEFAULT NULL,
  `isim_siparis` varchar(50) DEFAULT NULL,
  `tarih_alis_siparis` varchar(50) DEFAULT NULL,
  `tarih_kalkis_siparis` varchar(50) DEFAULT NULL,
  `isim_koltuk_siparis` varchar(50) DEFAULT NULL,
  `yas_koltuk_siparis` varchar(50) DEFAULT NULL,
  `no_koltuk_siparis` varchar(50) DEFAULT NULL,
  `no_ktp_siparis` varchar(50) DEFAULT NULL,
  `no_tel_siparis` varchar(50) DEFAULT NULL,
  `adres_siparis` varchar(100) DEFAULT NULL,
  `email_siparis` varchar(100) DEFAULT NULL,
  `gecerlilik_siparis` varchar(50) DEFAULT NULL,
  `qrcode_siparis` varchar(100) DEFAULT NULL,
  `durum_siparis` varchar(2) DEFAULT NULL,
  `cinsiyet` text NOT NULL,
  `fiyat` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `siparis`
--

INSERT INTO `siparis` (`id_siparis`, `kd_siparis`, `kd_bilet`, `kd_sefer`, `kd_musteri`, `kd_banka`, `kalkis_siparis`, `isim_siparis`, `tarih_alis_siparis`, `tarih_kalkis_siparis`, `isim_koltuk_siparis`, `yas_koltuk_siparis`, `no_koltuk_siparis`, `no_ktp_siparis`, `no_tel_siparis`, `adres_siparis`, `email_siparis`, `gecerlilik_siparis`, `qrcode_siparis`, `durum_siparis`, `cinsiyet`, `fiyat`) VALUES
(1, 'ORD00001', 'TORD00001J00012022122915', 'J0001', 'PL0011', 'BNK0004', 'TJ019', 'Ellen', 'Wednesday, 28 December 2022, 20:01', '2022-12-29', 'Ellen', '31', '15', '101111458666', '7774545555', '554 Southern Cross St', 'ellen@mail.com', '29-12-2022 20:01:02', 'assets/frontend/upload/qrcode/ORD00001.png', '2', '', 0),
(2, 'ORD00002', 'TORD00002J00012022123018', 'J0001', 'PL0012', 'BNK0004', 'TJ019', 'Andie Sand', 'Wednesday, 28 December 2022, 20:49', '2022-12-30', 'Andie Sand', '30', '18', '201145896969', '7458885454', '114 Allace Avenue', 'andie@mail.com', '29-12-2022 20:49:15', 'assets/frontend/upload/qrcode/ORD00002.png', '2', '', 0),
(3, 'ORD00003', 'TORD00003J00052022123020', 'J0005', 'PL0013', 'BNK0002', 'TJ016', 'Robert C. Frazier', 'Thursday, 29 December 2022, 00:25', '2022-12-30', 'Robert C. Frazier', '26', '20', '60145CASTR02', '7778545699', '11 Haymond Rocks Road', 'robert@mail.com', '30-12-2022 00:25:58', 'assets/frontend/upload/qrcode/ORD00003.png', '1', '', 0),
(83, 'ORD00012', '41ÖS20240321U41BSM0092', 'J0014', 'CA0024', 'BNK0001', 'TJ020', '1', 'Thursday, 21 March 2024, 20:59:11 ÖS', '2024-03-21', 'sda', '88', '11', '1', '1', '1', '1', '22-03-2024 20:59:11', 'assets/frontend/upload/qrcode/ORD00012.png', '1', 'Erkek', 552.5),
(84, 'ORD00013', '41ÖS20240406U41BSM0092', 'J0014', 'CA0024', 'BNK0001', 'TJ020', 'w', 'Thursday, 21 March 2024, 21:48:13 ÖS', '2024-04-06', 'sda', '7', '1', 'w', 'w', 'w', 'w', '22-03-2024 21:48:13', 'assets/frontend/upload/qrcode/ORD00013.png', '1', 'Erkek', 487.5),
(85, 'ORD00013', '41ÖS20240406U41BSM0092', 'J0014', 'CA0024', 'BNK0001', 'TJ020', 'w', 'Thursday, 21 March 2024, 21:48:13 ÖS', '2024-04-06', 'dsa', '89', '2', 'w', 'w', 'w', 'w', '22-03-2024 21:48:13', 'assets/frontend/upload/qrcode/ORD00013.png', '1', 'Erkek', 0),
(86, 'ORD00013', '41ÖS20240406U41BSM0092', 'J0014', 'CA0024', 'BNK0001', 'TJ020', 'w', 'Thursday, 21 March 2024, 21:48:13 ÖS', '2024-04-06', 'dsas', '88', '5', 'w', 'w', 'w', 'w', '22-03-2024 21:48:13', 'assets/frontend/upload/qrcode/ORD00013.png', '1', 'Erkek', 552.5);

-- --------------------------------------------------------

--
-- Table structure for table `varis`
--

CREATE TABLE `varis` (
  `kd_varis` varchar(50) NOT NULL,
  `sehir_varis` varchar(50) NOT NULL,
  `isim_terminal_varis` varchar(50) NOT NULL,
  `terminal_varis` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `varis`
--

INSERT INTO `varis` (`kd_varis`, `sehir_varis`, `isim_terminal_varis`, `terminal_varis`) VALUES
('TJ020', 'Izmit', '', 'Izmit Otogar'),
('TJ021', 'Samandag', '', 'Samandag Otogar'),
('TJ022', 'Rize', '', 'Rize Otogar'),
('TJ023', 'Erzurum', '', 'Erzurum Otogar');

-- --------------------------------------------------------

--
-- Table structure for table `yonetici`
--

CREATE TABLE `yonetici` (
  `kd_yonetici` varchar(50) NOT NULL,
  `isim_yonetici` varchar(35) DEFAULT NULL,
  `kullanici_adi_yonetici` varchar(30) DEFAULT NULL,
  `sifre_yonetici` varchar(256) DEFAULT NULL,
  `resim_yonetici` varchar(35) DEFAULT NULL,
  `email_yonetici` varchar(35) DEFAULT NULL,
  `seviye_yonetici` varchar(12) DEFAULT NULL,
  `durum_yonetici` int(1) DEFAULT NULL,
  `olusturma_tarihi_yonetici` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `yonetici`
--

INSERT INTO `yonetici` (`kd_yonetici`, `isim_yonetici`, `kullanici_adi_yonetici`, `sifre_yonetici`, `resim_yonetici`, `email_yonetici`, `seviye_yonetici`, `durum_yonetici`, `olusturma_tarihi_yonetici`) VALUES
('ADM0001', 'Administrator', 'admin', '$2y$10$nvmCaXC4Ohua5eW4fFAMauISafgwvPsoRXVNnToZpbF4vWfBw.xvu', 'assets/backend/img/default.png', 'adm@gmail.com', '2', 1, '1552276812'),
('ADM0002', 'Second Admin', 'admin2', '$2y$10$ADbNVZYgiDi8SqGl1bB2NOgCufT2sK5v/T3BSZcIpFPVljDSb2S2K', 'assets/backend/img/default.png', 'cbahyu@gmail.com', '1', 1, '1552819095'),
('ADM0003', 'BS Owner', 'owner', '$2y$10$nvmCaXC4Ohua5eW4fFAMauISafgwvPsoRXVNnToZpbF4vWfBw.xvu', 'assets/backend/img/default.png', 'owner@gmail.com', '1', 1, '1552819095'),
('ADM0004', 'Baris', 'baris', '$2y$10$6S4znoN/.Jd841SePnZjkeRt8ZK3HyLw2qnSRCvhQBFZZc9DcCxT6', 'assets/backend/img/default.png', 'b@gmail.com', '1', 1, '1710254316');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alt_menu`
--
ALTER TABLE `alt_menu`
  ADD PRIMARY KEY (`kd_alt_menu`),
  ADD KEY `kd_menu` (`kd_menu`);

--
-- Indexes for table `banka`
--
ALTER TABLE `banka`
  ADD PRIMARY KEY (`kd_banka`);

--
-- Indexes for table `bilet`
--
ALTER TABLE `bilet`
  ADD PRIMARY KEY (`kd_bilet`),
  ADD KEY `kod_siparis` (`kd_siparis`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`kd_menu`);

--
-- Indexes for table `musteri`
--
ALTER TABLE `musteri`
  ADD PRIMARY KEY (`kd_musteri`);

--
-- Indexes for table `musteri_token`
--
ALTER TABLE `musteri_token`
  ADD PRIMARY KEY (`kd_musteri_token`);

--
-- Indexes for table `onaylama`
--
ALTER TABLE `onaylama`
  ADD PRIMARY KEY (`kd_onaylama`),
  ADD KEY `kod_siparis` (`kd_siparis`);

--
-- Indexes for table `otobus`
--
ALTER TABLE `otobus`
  ADD PRIMARY KEY (`kd_otobus`);

--
-- Indexes for table `sefer`
--
ALTER TABLE `sefer`
  ADD PRIMARY KEY (`kd_sefer`),
  ADD KEY `kd_otobus` (`kd_otobus`),
  ADD KEY `kd_varis` (`kd_varis`);

--
-- Indexes for table `seviye`
--
ALTER TABLE `seviye`
  ADD PRIMARY KEY (`kd_seviye`);

--
-- Indexes for table `siparis`
--
ALTER TABLE `siparis`
  ADD PRIMARY KEY (`id_siparis`),
  ADD KEY `kd_sefer` (`kd_sefer`),
  ADD KEY `kd_musteri` (`kd_musteri`),
  ADD KEY `kd_bilet` (`kd_bilet`),
  ADD KEY `kd_banka` (`kd_banka`);

--
-- Indexes for table `varis`
--
ALTER TABLE `varis`
  ADD PRIMARY KEY (`kd_varis`);

--
-- Indexes for table `yonetici`
--
ALTER TABLE `yonetici`
  ADD PRIMARY KEY (`kd_yonetici`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `kd_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `musteri_token`
--
ALTER TABLE `musteri_token`
  MODIFY `kd_musteri_token` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `seviye`
--
ALTER TABLE `seviye`
  MODIFY `kd_seviye` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `siparis`
--
ALTER TABLE `siparis`
  MODIFY `id_siparis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
