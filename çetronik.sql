-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 19 May 2024, 00:49:54
-- Sunucu sürümü: 10.4.32-MariaDB
-- PHP Sürümü: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `çetronik`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `added_on` datetime DEFAULT current_timestamp(),
  `total` decimal(10,3) DEFAULT 0.000,
  `totalSum` decimal(10,5) DEFAULT 0.00000
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `price` decimal(10,3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Tablo döküm verisi `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `image`, `created_at`, `price`) VALUES
(60, 'Samsung S23', 'Renk: Pembe / Hafıza: 256 GB', 'SAMSUNGS23PEMBE.jpeg', '2024-05-15 19:49:16', 35.000),
(61, 'APPLE WATCH ', 'Renk: Gri / Kordon: Plastik', 'APPLEWATCHSERES9.jpeg', '2024-05-15 19:49:59', 20.000),
(62, 'Huaweı Bluetooth Kulaklık', 'Renk: Beyaz', 'HUAWEI.jpeg', '2024-05-15 19:50:55', 2.000),
(64, 'Acer Nitro 5', 'Nvidia RTX 3060\r\nRam: 32 GB\r\nİşlemci: İ5 12.nesil', 'ACERNTRO3.jpeg', '2024-05-15 19:53:29', 38.000),
(65, 'ASUS TUF GAMİNG', 'Nvidia RTX 4070\r\nRam: 64 GB\r\nİşlemci: İ9 13.Nesil', 'ASUSTUFGAMNG.jpeg', '2024-05-15 19:54:26', 66.000),
(66, 'Samsung S23', 'Renk: Sarı / Hafıza: 128 GB', 'S23SARI.jpeg', '2024-05-15 19:55:55', 34.000),
(67, 'JBL Kulak Üstü Bluetooth Kulaklık', 'Renk: Lacivert', 'JBL.jpeg', '2024-05-15 19:56:58', 5.000),
(69, 'Airpods', 'Renk: Beyaz', 'ARPODS3.jpeg', '2024-05-15 19:58:16', 25.000),
(70, 'Smartwatch 5 Pro', 'Renk: Siyah', 'SMARTWATCH5PRO.jpeg', '2024-05-15 19:59:24', 13.000),
(71, 'Lenovo İdeapad', 'Nvidia RTX 3050 Tİ\r\nRam: 32 GB\r\nİşlemci: İ5 12.NESİL', 'LENOVOGAMNG.jpeg', '2024-05-15 20:00:41', 34.000),
(72, 'APPLE WATCH ULTRA', 'Renk: Turuncu / Kordon: Deri', 'APPLEWATCHULTRA1.jpeg', '2024-05-15 20:01:23', 45.000),
(73, 'DELL GAMİNG LAPTOP', 'Nvidia RTX 4060 Ram: 16 GB\r\nİşlemci: İ7 12.Nesil', 'DELLGAMNG.jpeg', '2024-05-15 20:02:26', 50.000),
(74, 'Samsung Buds', 'Renk: Gri', 'SAMSUNGBUDS.jpeg', '2024-05-15 20:03:24', 2.000),
(75, 'Iphone 15 Pro Max', 'Renk: Mavi / Hafıza: 512 GB', 'Iphone15ProMax.jpeg', '2024-05-15 20:05:38', 80.000),
(76, 'Samsung S24', 'Renk: Siyah / Hafıza: 512 GB', 'S23SYAH.jpeg', '2024-05-15 20:07:06', 48.000),
(77, 'Samsung S24 Ultra', 'Renk: Gri / Hafıza: 512 GB', 'SAMSUNGS24ultragri.jpeg', '2024-05-15 20:09:24', 75.000);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `id` int(6) UNSIGNED NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `reg_date`) VALUES
(4, 'lequendfire@outlook.com', 'harun', '2024-05-14 12:50:39'),
(5, 'safa@gmail.com', 'safa', '2024-05-14 14:20:34'),
(6, 'emir@gmail.com', 'emir', '2024-05-14 14:47:20'),
(7, 'bora@gmail.com', 'bora', '2024-05-15 10:18:20'),
(8, 'murat@gmail.com', 'murat', '2024-05-15 10:19:31'),
(19, 'lequendfire@gmail.com', 'harun', '2024-05-15 21:24:31'),
(20, 'doruk@gmail.com', 'doruk', '2024-05-16 11:50:47'),
(25, 'harun@gmail.com', 'harun1', '2024-05-18 22:29:19');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD UNIQUE KEY `idx_product_user` (`product_id`,`user_id`);

--
-- Tablo için indeksler `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- Tablo için AUTO_INCREMENT değeri `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
