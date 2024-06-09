-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 09, 2024 at 12:28 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pw2024_tubes_233040107`
--

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int NOT NULL,
  `nama_kategori` varchar(255) NOT NULL,
  `gambar` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `nama_kategori`, `gambar`) VALUES
(1, 'WOMAN', 'uploads/66617ff1ea6c6_1717665777.jpg'),
(2, 'MEN', 'uploads/666181bcd9ea6_1717666236.jpg'),
(3, 'EQUIPMENT', 'uploads/66617ffd022fd_1717665789.jpg'),
(4, 'ACCESORIES', 'uploads/6661820ee944d_1717666318.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `id_product` int NOT NULL,
  `id_user` int NOT NULL,
  `qty` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `keranjang`
--

INSERT INTO `keranjang` (`id_product`, `id_user`, `qty`, `created_at`) VALUES
(48, 6, 1, '2024-06-01 15:27:16'),
(74, 1, 2, '2024-06-09 11:55:48');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `produk_id` int NOT NULL,
  `kategori_id` int NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `harga_produk` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `deskripsi_produk` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`produk_id`, `kategori_id`, `nama_produk`, `harga_produk`, `image`, `deskripsi_produk`) VALUES
(46, 1, 'SUMMER HOLIDAY KNIT', '750.000', 'uploads/66608bc7a103f_1717603271.png', 'Warm days call for effortless style. Slip into this comfortable knit dress for casual charm that carries you from beach to brunch. Cotton and polyester interlock fabric provides comfort that is ideal for warmer weather, while adidas-inspired graphics connect you to brand heritage. '),
(48, 1, 'WHITE KNITT SKIRT', '900.000', 'uploads/66608d3e2e4e9_1717603646.png', 'Put comfort first, and focus on the game with this adidas golf skirt. adidas PRIMEKNIT is specifically designed to maximize mobility so you can bend, twist and move without distraction. This product is made from 100% recycled material.'),
(50, 1, 'TEE BABY 3-STRIPES', '850.000', 'uploads/665b1bc4c4af6_1717246916.png', 'This adidas tee that adapts to your body shape lets you embody the Originals heritage with a fresh and energetic style. Comfortable cotton blend with the iconic 3-Stripes that extend across the sleeves. Wear it to signal your connection to decades of athletic tradition. The cotton material in this product comes from Better Cotton.'),
(51, 1, 'M&EACUTE;LANGE', '700.000', 'uploads/66608d2d2ef66_1717603629.png', 'This lightweight lifestyle tee from adidas is designed to be comfortable and versatile. Crafted from soft melange cotton, this tee adapts to your movements whether you are meeting friends for coffee or exploring the city streets. Pair with jeans and sneakers for a casual adventure or look more stylish with special trousers.'),
(53, 2, 'TRAE FG T-SHIRT', '850.000', 'uploads/665de81a02b24_1717430298.png', 'Rep your teams star point guard in classic style. This soft cotton Trae Young t-shirt from adidas Basketball lets everyone know you are rooting for one of the games flashiest playmakers. Pull it on for game day or any day you want to show your Trae Young pride. '),
(54, 2, 'T-SHIRT AEROREADY ', '950.000', 'uploads/66615e00ec11d_1717657088.png', 'Maximize your training targets with this adidas AEROREADY t-shirt. Made to wick away moisture, this t-shirt feels soft and durable, the perfect combination for your next gym session. Slits in the hem of the elongated model help you move freely, whether you are lifting weights, running or intense jogging.'),
(56, 2, 'SHORT SLEEVE SHIRT', '750.000', 'uploads/665de8360d3c9_1717430326.png', 'This comfortable shirt is built on our sporting heritage, reimagined for today. An iconic design from the archives meets contemporary details for an authentic vibe with an edge. With 3-Stripes running down the sleeves, your adidas pride is on display. A classic fit keeps the tailored feel while disruptive details give it a modern twist. This product is made with at least 70% recycled materials.'),
(58, 4, 'VISOR FOR', '750.000', 'uploads/665deb6e07b95_1717431150.png', 'Cotton sun visor hat with fold away crown to wear as a visor or a cap. Elastic closure. Soft, lightweight cotton. Great for travel or just to carry with you. Small size, best fit 53-56 cm. 100% cotton. Postioned inside the iron head, the ECHO Damping System uses a soft polymer blend and multiple contact points across the face to channel away harsh vibrations creating a forged-like feel.'),
(59, 4, 'SUNDAY GOLF LOMA BAG', '950.000', 'uploads/665dfb3d6bea2_1717435197.png', ' This lightweight sunday stand carry bag can fit up to 6-7 clubs comfortably. The perfect bag for a evening Sunday round or at an executive course. Comes with a carry handle and strap.VALUABLES POCKET FOR EXTRA STORAGE: The Sunday Golf pitch n putt bag comes with a valuables pocket that is lined with velour on the inside for safe storage of your valuables such as your wallet, cellphone, keys etc.'),
(60, 4, 'LOMA XL STAND BAG', '975.000', 'uploads/665dfb6b5a835_1717435243.png', 'Mens Sunday Golf Loma XL Stand Bag 22Meet the Loma XL! The Lomas bigger brother and our second golf bag release. At 3.4 pounds, the Loma XL is a lightweight golf bag built to carry 8 clubs comfortably. We took the same iconic Loma design and made it slightly bigger to accommodate a couple more clubs while adding a double strap. '),
(61, 4, 'ANYDAY OREO BAG', '750.000', 'uploads/665dfc4c05e6b_1717435468.png', 'Perfect for new and improving golfers, this is a loaded golf set built to look and play the part without costing a fortune. This set, for right handed female golfers, includes a driver, a 3 wood, a hybrids, 6-7-8-9-PW irons, a putter and a stand bag. Manufactured by Prosimmon, and backed up with a 12 month warranty.'),
(62, 3, 'CALLAWAY IRON TENSEI #6-P R', '985.000', 'uploads/665ead9105368_1717480849.png', 'Introducing IRON PARADYM AI SMOKE TENSEI 50 #6-P R. Swiss-Armify your game with one tool for all the shots. Swiss-Armify your game with one tool for all the shots. Tricky shots around the green require deft touch, or a wedge artfully designed to navigate any situation. Tricky shots around the green require deft touch, or a wedge artfully designed to navigate any situation.'),
(63, 3, 'CALLAWAY HYBRID HL TENSEI 50', '975.000', 'uploads/665dff557a686_1717436245.png', 'This design offers improved sound and feel on shots struck across the face The raw surface and toe area works in conjunction with the new Spin Tread Grooves to provide the best spin properties in wet conditions. The reshaped top line, leading edge and hosel blend to create a smoother and fuller look for improved shot making.A light True Temper Tour Issue 115g shaft helps generate more feel. A fully machined sole ensures the exact grind and bounce geometry every time.'),
(64, 3, 'CALLAWAY HYBRID TENSEI 50', '999.000', 'uploads/665eb230dd3d4_1717482032.png', 'The low profile head has a shallow face height and a wide sole with a large step down to keep CG low for easier launch. Increased sole curvature assists with turf interaction. The multi-material Cap Back Design utilizes high-strength stainless steel and ultralight weight polymers. Designed to maximize distance, forgiveness and feel with an extremely low CG. '),
(65, 3, 'CALLAWAY DRIVER MAX TENSEI ', '890.000', 'uploads/665e011ba61da_1717436699.png', 'Designed and manufactured to the highest of standards available, the brand has built a strong and loyal following amongst some of today’s top golf professionals, including former number ones Luke Donald and Stacy Lewis. Over the years Mizuno Golf has learned to push the boundaries of golf club design and innovation.'),
(72, 4, 'NIKE AIR HYBRYD CARRY', '875.000', 'uploads/665ebd4cc5f13_1717484876.png', 'The smallest and lightest of the Callaway Golf Stand Bags, the Hyper Lite features a cell phone sleeve, a zippered valuables pocket, and a full-length apparel pouch for your rain jacket. Available in dual- and single-strap, this carry bag is great for playing golf and practice.'),
(74, 2, 'EMBROIDERED SZN ', '925.000', 'uploads/66608c997373c_1717603481.png', 'Made for easygoing days, this loose-fitting tee lets you express your adidas love. Slip into comfort with the soft cotton fabric and relaxed silhouette. Showcase your brand loyalty up front with a small adidas Badge of Sport on the upper chest. Pair with your favourite joggers for a laid-back look or jeans and sneakers for casual exploring. However the mood strikes, this tee keeps you stylishly supported. The cotton in this product has been sourced through Better Cotton.'),
(76, 2, 'ADICOLOR TREFOIL TEE', '750.000', 'uploads/666182de92c2c_1717666526.png', 'The Trefoil logo is steeped in sport and style history. But it is about more than that. It represents a fearless energy and a clan of creators striving to be their best at every step. Slip into the comfort of this adidas t-shirt and show it off. By buying cotton products from us, you are supporting more sustainable cotton farming.'),
(78, 3, 'CALLAWAY FAIRWAY FAST TENSEI', '750.000', 'uploads/66618b80214f1_1717668736.png', 'Cobra GolfColor: Matte Black-Gold FusionFeatures: Pwr-Cor Technology-Multi material weighting system positions mass low and forward to combine low spin with faster ball speed for enhanced distanceHOT Face-Highly Optimized Technology uses Artificial Intelligence & Machine Learning to design 15 HOT Zones to increase ball speed and smash factor across the faceLightweight Carbon Crown-A new carbon crown material is thinner and frees up more discretionary weight to improve CG/MOI'),
(79, 1, 'TEE WORKOUT HAT', '650.000', 'uploads/666565c686877_1717921222.png', 'Focus on fitness with this workout tee from adidas. The jersey cotton blend feels soft and comfortable, so you can stay focused. AEROREADY technology that adjusts humidity reduces sweat from the body so you can train harder.');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nama` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `nama`, `password`) VALUES
(1, 'test@mail.com', 'admin\r\n', '$2y$10$NIA.JkNhMvhdU4DAcPvCkuiHa5ON5sLTbec5g9dLzgL.2sYstTjS2'),
(2, 'silmatsaninurrasy@gmail.com', 'Silma Tsania ', '$2y$10$DFinCwO47LoTaAyABt/iKehh823k3U9Sx0jxt9FDwiHwZOPegINgq'),
(8, 'anna@gmail.com', 'ana', '$2y$10$QlWb0yQ80lanjOeylgnxkOJmVsPZglWEop3GpaA5XlI0SdVKGRMLq'),
(9, 'naila@gmail.com', 'naila', '$2y$10$QRFc2GE2lNOsbw1U8kmxrO6l3JYOjqto8JV04SRYLGdsHEEVAWj.i'),
(10, 'ama@gmail.com', 'ama', '$2y$10$bkaMXQu9yVgQVmIioWjCk.m5mtwLqg.PyGroc0/NseJL1J.427cMW');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nama_kategori` (`nama_kategori`);

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id_product`),
  ADD UNIQUE KEY `id_product_2` (`id_product`),
  ADD KEY `id_product` (`id_product`,`id_user`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`produk_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `produk_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
