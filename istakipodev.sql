-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 11 Kas 2014, 22:52:02
-- Sunucu sürümü: 5.6.17
-- PHP Sürümü: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Veritabanı: `istakipodev`
--
CREATE DATABASE IF NOT EXISTS `istakipodev` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `istakipodev`;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tbl_is`
--

CREATE TABLE IF NOT EXISTS `tbl_is` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `isin_adi` varchar(250) NOT NULL,
  `durum` varchar(250) NOT NULL,
  `sorumlu_personel` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sorumlu_personel` (`sorumlu_personel`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Tablo döküm verisi `tbl_is`
--

INSERT INTO `tbl_is` (`id`, `isin_adi`, `durum`, `sorumlu_personel`) VALUES
(1, 'Web Tasarımın Yapılması', 'Yapım Aşamasında', 1),
(2, 'Reklam Afişlerinin Basılması', 'Tamamlandı', 2),
(3, 'Halk Günü Düzenlenmesi', 'Yapım Aşamasında', 3),
(4, 'Bilim Fuarı Organizasyonu', 'Tamamlandı', 4),
(5, 'Personel Kayıtlarının İncelenmesi', 'Yapım Aşamasında', 5),
(7, 'HTML5 Araştırması', 'Yapım Aşamasında', 9),
(8, 'CSS3 Araştırılması', 'Yapım Aşamasında', 7);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tbl_koordinator`
--

CREATE TABLE IF NOT EXISTS `tbl_koordinator` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ad_soyad` varchar(250) NOT NULL,
  `maas` int(11) NOT NULL,
  `fotograf` varchar(250) NOT NULL,
  `eposta` varchar(250) NOT NULL,
  `sifre` varchar(250) NOT NULL,
  `sorumlu_mudur` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sorumlu_mudur` (`sorumlu_mudur`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Tablo döküm verisi `tbl_koordinator`
--

INSERT INTO `tbl_koordinator` (`id`, `ad_soyad`, `maas`, `fotograf`, `eposta`, `sifre`, `sorumlu_mudur`) VALUES
(1, 'Fatih Ayar', 2100, '../resimler/koordinator/1.jpg', 'fayar@gmail.com', '51eac6b471a284d3341d8c0c63d0f1a286262a18', 1),
(2, 'Derya Akan', 1900, 'resimler/koordinator/2.jpg', 'dakan@gmail.com', '51eac6b471a284d3341d8c0c63d0f1a286262a18', 2),
(3, 'Murat Cansu', 2200, 'resimler/koordinator/3.jpg', 'mcansu@gmail.com', '51eac6b471a284d3341d8c0c63d0f1a286262a18', 3),
(4, 'Kemal Eren', 1800, 'resimler/koordinator/4.jpg', 'keren@gmail.com', '51eac6b471a284d3341d8c0c63d0f1a286262a18', 4),
(5, 'Lale Işık', 2000, 'resimler/koordinator/5.jpg', 'lisik@gmail.com', '51eac6b471a284d3341d8c0c63d0f1a286262a18', 5),
(12, 'Ahmet Çalışkan', 2100, '../resimler/koordinator/indir.jpg', 'acaliskan@gmail.com', '51eac6b471a284d3341d8c0c63d0f1a286262a18', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tbl_kurum`
--

CREATE TABLE IF NOT EXISTS `tbl_kurum` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kurum` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Tablo döküm verisi `tbl_kurum`
--

INSERT INTO `tbl_kurum` (`id`, `kurum`) VALUES
(1, 'Bilgi İşlem Müdürlüğü'),
(2, 'Basın Yayın Müdürlüğü'),
(3, 'Halkla İlişkiler Müdürlüğü'),
(4, 'Fen İşleri Müdürlüğü'),
(5, 'Özel Kalem Müdürlüğü');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tbl_mudur`
--

CREATE TABLE IF NOT EXISTS `tbl_mudur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ad_soyad` varchar(250) NOT NULL,
  `maas` int(11) NOT NULL,
  `fotograf` varchar(250) NOT NULL,
  `eposta` varchar(250) NOT NULL,
  `sifre` varchar(250) NOT NULL,
  `kurum` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `kurum` (`kurum`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Tablo döküm verisi `tbl_mudur`
--

INSERT INTO `tbl_mudur` (`id`, `ad_soyad`, `maas`, `fotograf`, `eposta`, `sifre`, `kurum`) VALUES
(1, 'Hakan Cengiz', 3000, '../resimler/mudur/indir.jpg', 'hcengiz@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 1),
(2, 'Ecem Özkan', 2500, '../resimler/mudur/2.jpg', 'ecemzkan@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 2),
(3, 'Rabia Karadayı', 2300, '../resimler/mudur/3.jpg', 'rkaradayi@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 3),
(4, 'Murat Topal', 4000, '../resimler/mudur/4.jpg', 'mtopal@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 4),
(5, 'Fatih Kazdal', 3500, '../resimler/mudur/5.jpg', 'fkazdal@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 5);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tbl_personel`
--

CREATE TABLE IF NOT EXISTS `tbl_personel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ad_soyad` varchar(250) NOT NULL,
  `maas` int(11) NOT NULL,
  `fotograf` varchar(250) NOT NULL,
  `eposta` varchar(250) NOT NULL,
  `sifre` varchar(250) NOT NULL,
  `sorumlu_koordinator` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sorumlu_koordinator` (`sorumlu_koordinator`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Tablo döküm verisi `tbl_personel`
--

INSERT INTO `tbl_personel` (`id`, `ad_soyad`, `maas`, `fotograf`, `eposta`, `sifre`, `sorumlu_koordinator`) VALUES
(1, 'Gökhan Başarılı', 1000, 'resimler/personel/1.jpg', 'gbasarili@gmail.com', 'fc1200c7a7aa52109d762a9f005b149abef01479', 1),
(2, 'Kayhan Can', 950, 'resimler/personel/2.jpg', 'kcan@gmail.com', 'fc1200c7a7aa52109d762a9f005b149abef01479', 2),
(3, 'Sibel Topal', 850, 'resimler/personel/3.jpg', 'stopal@gmail.com', 'fc1200c7a7aa52109d762a9f005b149abef01479', 3),
(4, 'Nalan Uzun', 900, 'resimler/personel/4.jpg', 'nuzun@gmail.com', 'fc1200c7a7aa52109d762a9f005b149abef01479', 4),
(5, 'Mazhar Gören', 1100, 'resimler/personel/5.jpg', 'mgoren@gmail.com', 'fc1200c7a7aa52109d762a9f005b149abef01479', 5),
(7, 'Can Yılmaz', 900, '../resimler/personel/12.jpg', 'cyilmaz@gmail.com', 'fc1200c7a7aa52109d762a9f005b149abef01479', 12),
(9, 'Murat Altıncı', 1000, '../resimler/personel/isim54534364364543.jpg', 'maltinci@gmail.com', 'fc1200c7a7aa52109d762a9f005b149abef01479', 12);

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `tbl_is`
--
ALTER TABLE `tbl_is`
  ADD CONSTRAINT `tbl_is_ibfk_1` FOREIGN KEY (`sorumlu_personel`) REFERENCES `tbl_personel` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Tablo kısıtlamaları `tbl_koordinator`
--
ALTER TABLE `tbl_koordinator`
  ADD CONSTRAINT `tbl_koordinator_ibfk_1` FOREIGN KEY (`sorumlu_mudur`) REFERENCES `tbl_mudur` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Tablo kısıtlamaları `tbl_mudur`
--
ALTER TABLE `tbl_mudur`
  ADD CONSTRAINT `tbl_mudur_ibfk_1` FOREIGN KEY (`kurum`) REFERENCES `tbl_kurum` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Tablo kısıtlamaları `tbl_personel`
--
ALTER TABLE `tbl_personel`
  ADD CONSTRAINT `tbl_personel_ibfk_1` FOREIGN KEY (`sorumlu_koordinator`) REFERENCES `tbl_koordinator` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
