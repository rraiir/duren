-- ============================================================
-- duren_full.sql : Skema dan Data Lengkap Toko DuREN
-- ============================================================

CREATE DATABASE IF NOT EXISTS duren CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE duren;

SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(10) NOT NULL DEFAULT 'buyer',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_phone_unique` (`phone`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` (`id`, `name`, `phone`, `address`, `password`, `role`, `is_active`, `remember_token`, `created_at`, `updated_at`) VALUES
('2', 'Admin', '62881081111833', 'Kantor DuREN', '$2y$12$3xZZKHx6lQ/hmhl4pMPStORhr3DfGIbVODNuLjn4E.izCRMGu.zw2', 'admin', '1', NULL, '2026-10-21 11:45:35', '2026-10-21 12:24:45'),
('4', 'Nafis Ardiansyah', '628123456701', 'Jl. Merdeka No. 12, Kepanjenkidul, Blitar', '$2y$12$sJ1gYbrxxdcO1aQh/QLXDO0NWQ5tydyj/yJbwRBCOiQExOXwf/JxS', 'buyer', '1', NULL, '2026-11-05 08:58:44', '2026-11-05 08:59:31'),
('5', 'Nabil Al-Fath', '628123456702', 'Jl. Kyai Mojo No. 45, Kutoarjo, Purworejo', '$2y$12$4oLuWuK/n2NMmINZJlyjCeRnlDqUl8f6Ya.tiKvX5ufZkpk1ifN6K', 'buyer', '1', NULL, '2026-11-05 08:58:45', '2026-11-05 08:59:31'),
('6', 'Natha Pratama', '628123456703', 'Jl. Diponegoro No. 8, Sananwetan, Blitar', '$2y$12$ORSe.ID3Wvqbn6XliO.vs.A47Py5gM8wNUi7YLwxOZG0I3O1UBpWK', 'buyer', '1', NULL, '2026-11-05 08:58:45', '2026-11-05 08:59:32'),
('7', 'Mikel Santoso', '628123456704', 'Jl. Radio Dalam Raya No. 19, Kebayoran Baru, Jakarta Selatan', '$2y$12$TM4/GZgLs5BGAOhBVD7.reflvPpGFvlOi7YajY1saPrfUHsCR4mNy', 'buyer', '1', NULL, '2026-11-05 08:58:45', '2026-11-05 08:59:32'),
('8', 'Faruz Nugroho', '628123456705', 'Jl. Dr. Soeparno No. 22, Purwokerto Timur, Banyumas', '$2y$12$cglwKLJRIkJBiW0SPgMmQ.9gKDyacM7HW2Ut7MvRKLdtv1j8NjKz.', 'buyer', '1', NULL, '2026-11-05 08:58:45', '2026-11-05 08:59:32');

DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `size` varchar(10) NOT NULL,
  `est_weight_gram` int(10) unsigned NOT NULL,
  `price` int(10) unsigned NOT NULL,
  `stock` int(10) unsigned NOT NULL DEFAULT 0,
  `type` varchar(10) NOT NULL DEFAULT 'ready',
  `eta_text` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `products_is_active_index` (`is_active`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `products` (`id`, `name`, `size`, `est_weight_gram`, `price`, `stock`, `type`, `eta_text`, `description`, `is_active`, `created_at`, `updated_at`) VALUES
('1', 'Montong Parigi', 'L', '3200', '250000', '12', 'ready', NULL, 'Durian Montong berdaging tebal, manis legit, aroma harum khas, cocok untuk dinikmati bersama keluarga.', '1', '2026-11-05 08:58:45', '2026-11-05 08:58:45'),
('2', 'Montong Parigi', 'M', '2400', '190000', '20', 'ready', NULL, 'Ukuran medium dengan proporsi daging dan biji pas, rasa manis pulen berserat halus.', '1', '2026-11-05 08:58:45', '2026-11-05 08:58:45'),
('3', 'Musang King', 'M', '1800', '420000', '8', 'ready', NULL, 'Varian premium dengan citarasa manis pekat dan aftertaste sedikit pahit (bittersweet), daging creamy warna kuning kunyit.', '1', '2026-11-05 08:58:45', '2026-11-05 08:58:45'),
('4', 'Musang King', 'S', '1300', '310000', '5', 'ready', NULL, 'Ukuran compact, rasa manis legit tajam berkelas dengan biji kempes.', '1', '2026-11-05 08:58:45', '2026-11-05 08:58:45'),
('5', 'Black Thorn (Duri Hitam)', 'L', '2600', '580000', '4', 'preorder', 'Estimasi panen 18 November 2026', 'Raja durian dengan tekstur sangat lembut dan rasa manis creamy kompleks beraroma tajam menawan.', '1', '2026-11-05 08:58:46', '2026-11-05 08:58:46'),
('6', 'Bawor Banyumas', 'L', '3500', '230000', '10', 'ready', NULL, 'Durian lokal unggulan Jawa Tengah berdaging tebal oranye, biji kecil, rasa manis legit dan sedikit pahit.', '1', '2026-11-05 08:58:46', '2026-11-10 13:58:41'),
('7', 'Petruk Jepara', 'M', '2000', '160000', '6', 'ready', NULL, 'Durian lokal khas Jawa Tengah aroma wangi semerbak, rasa manis pulen khas citarasa nusantara.', '1', '2026-11-05 08:58:46', '2026-11-05 08:58:46'),
('8', 'Bawor Banyumas', 'M', '2200', '175000', '0', 'ready', NULL, 'Varian medium stok saat ini sedang habis dan dinonaktifkan sementara.', '1', '2026-11-05 08:58:46', '2026-11-10 13:58:34');

DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
  `id` tinyint(3) unsigned NOT NULL,
  `qris_image_path` varchar(255) DEFAULT NULL,
  `admin_whatsapp` varchar(20) DEFAULT NULL,
  `warranty_text` text NOT NULL,
  `shipping_rules_text` text NOT NULL,
  `shipping_fee_deadline_days` tinyint(3) unsigned NOT NULL DEFAULT 2,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `settings` (`id`, `qris_image_path`, `admin_whatsapp`, `warranty_text`, `shipping_rules_text`, `shipping_fee_deadline_days`, `created_at`, `updated_at`) VALUES
('1', NULL, NULL, 'Klaim wajib disertai video unboxing tanpa dipotong dan diajukan maksimal 24 jam setelah durian diterima. Durian busuk atau tidak layak makan diganti atau direfund setelah Admin memeriksa video. Selisih kecil dari estimasi berat dan selera rasa (misalnya kurang manis) tidak dijamin.', 'Ongkir dikonfirmasi Admin lewat WhatsApp setelah pembayaran durian diterima, lalu dibayar terpisah. Pesanan dikirim setelah ongkir lunas. (Isi aturan lengkap dan wilayah layanan di sini.)', '2', '2026-10-21 11:04:58', '2026-10-21 11:04:58');

DROP TABLE IF EXISTS `articles`;
CREATE TABLE `articles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(150) NOT NULL,
  `summary` varchar(255) NOT NULL,
  `cover_path` varchar(255) DEFAULT NULL,
  `body` text NOT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT 0,
  `published_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `articles_published_index` (`is_published`,`published_at`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `articles` (`id`, `title`, `summary`, `cover_path`, `body`, `is_published`, `published_at`, `created_at`, `updated_at`) VALUES
('1', 'Cara Memilih Durian Matang Alami', 'Kenali tanda durian yang siap dinikmati sebelum membeli: aroma, juring, dan bunyi ketukan.', NULL, 'Memilih durian utuh membutuhkan ketelitian karena buahnya tertutup kulit tebal berduri.\n\nPertama, periksa aroma dari bagian pantat buah. Durian yang matang pas akan mengeluarkan aroma harum manis tanpa bau asam atau alkohol yang menyengat.\n\nKedua, dengarkan bunyi ketukan pisau. Bila terdengar bunyi berongga (bluk-bluk), menandakan daging buah sudah empuk dan terpisah dari dinding kulit dalam.\n\nKetiga, amati tangkai buah. Tangkai yang masih basah dan seratnya segar menandakan durian baru saja dipanen atau jatuh dari pohon.', '1', '2026-10-30 08:59:32', '2026-11-05 08:58:46', '2026-11-05 08:59:32'),
('2', 'Perbedaan Karakter Rasa Musang King dan Duri Hitam', 'Membandingkan dua varian durian paling diburu oleh penikmat durian sejati.', NULL, 'Musang King dan Black Thorn sering menjadi perdebatan bagi penikmat durian.\n\nMusang King dikenal dengan warna daging kuning kunyit yang mencolok, tekstur lembut pekat, dan rasa manis legit dengan sentuhan aftertaste pahit yang nikmat.\n\nSementara Black Thorn memiliki warna oranye kemerahan dengan tekstur lebih halus meleleh di lidah, rasa manis creamy yang kaya, dan aroma harum semerbak.', '1', '2026-11-01 08:59:32', '2026-11-05 08:58:46', '2026-11-05 08:59:32'),
('3', 'Tips Menyimpan Durian Utuh Agar Kualitas Terjaga', 'Cara tepat menyimpan buah durian utuh sebelum dibuka agar tidak cepat asam.', NULL, 'Durian utuh sebaiknya disimpan pada suhu ruangan yang sejuk dan memiliki sirkulasi udara baik.\n\nHindari meletakkan durian langsung di lantai dingin atau terkena paparan sinar matahari langsung karena dapat memicu fermentasi berlebihan.\n\nJika belum ingin disantap dalam 1-2 hari, letakkan di wadah beralas kardus kering agar pori-pori kulit buah tetap bernapas.', '1', '2026-11-03 08:59:32', '2026-11-05 08:58:46', '2026-11-05 08:59:32'),
('4', 'Panduan Klaim Garansi dengan Video Unboxing', 'Langkah mudah mengajukan garansi jika durian yang Anda terima tidak layak konsumsi.', NULL, 'Di DuREN, setiap pembelian dilindungi oleh garansi kualitas.\n\nPastikan Anda membuat video unboxing tanpa jeda saat durian pertama kali dibuka. Jika ditemukan daging buah busuk, berulat, atau hambar total, kirimkan video tersebut ke nomor WhatsApp Admin dalam kurun waktu 24 jam setelah paket diterima.', '0', NULL, '2026-11-05 08:58:46', '2026-11-05 08:58:46');

DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(20) NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `status` varchar(30) NOT NULL DEFAULT 'waiting_payment',
  `type` varchar(10) NOT NULL DEFAULT 'ready',
  `total_price` int(10) unsigned NOT NULL,
  `shipping_address` text NOT NULL,
  `checkout_at` datetime NOT NULL,
  `pay_deadline` datetime NOT NULL,
  `proof_path` varchar(255) DEFAULT NULL,
  `proof_upload_count` tinyint(3) unsigned NOT NULL DEFAULT 0,
  `reject_reason` varchar(255) DEFAULT NULL,
  `verified_at` datetime DEFAULT NULL,
  `terms_accepted_at` datetime NOT NULL,
  `shipping_fee_paid_at` datetime DEFAULT NULL,
  `delivery_method` varchar(10) DEFAULT NULL,
  `courier_name` varchar(50) DEFAULT NULL,
  `tracking_number` varchar(50) DEFAULT NULL,
  `cancel_reason` varchar(255) DEFAULT NULL,
  `completed_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `orders_code_unique` (`code`),
  KEY `orders_user_id_index` (`user_id`),
  KEY `orders_status_index` (`status`),
  KEY `orders_status_pay_deadline_index` (`status`,`pay_deadline`),
  CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `orders` (`id`, `code`, `user_id`, `status`, `type`, `total_price`, `shipping_address`, `checkout_at`, `pay_deadline`, `proof_path`, `proof_upload_count`, `reject_reason`, `verified_at`, `terms_accepted_at`, `shipping_fee_paid_at`, `delivery_method`, `courier_name`, `tracking_number`, `cancel_reason`, `completed_at`, `created_at`, `updated_at`) VALUES
('1', 'DRN-0001', '4', 'completed', 'ready', '500000', 'Jl. Merdeka No. 12, Kepanjenkidul, Blitar', '2026-10-31 08:59:32', '2026-10-31 10:59:32', 'proofs/sample.jpg', '1', NULL, '2026-10-31 09:59:32', '2026-10-31 08:59:32', '2026-11-01 08:59:32', 'courier', 'Paxel', 'PXL-BLT-98124', NULL, '2026-11-01 08:59:32', '2026-11-05 08:59:32', '2026-11-05 08:59:32'),
('2', 'DRN-0002', '5', 'shipped', 'ready', '420000', 'Jl. Kyai Mojo No. 45, Kutoarjo, Purworejo', '2026-11-03 08:59:32', '2026-11-03 10:59:32', 'proofs/sample.jpg', '1', NULL, '2026-11-03 09:59:32', '2026-11-03 08:59:32', '2026-11-04 08:59:32', 'instant', 'GrabExpress', 'GE-PWR-55219', NULL, NULL, '2026-11-05 08:59:32', '2026-11-05 08:59:32'),
('3', 'DRN-0003', '6', 'waiting_verification', 'ready', '460000', 'Jl. Diponegoro No. 8, Sananwetan, Blitar', '2026-11-05 07:59:32', '2026-11-05 09:59:32', 'proofs/sample.jpg', '1', NULL, NULL, '2026-11-05 07:59:32', NULL, NULL, NULL, NULL, NULL, NULL, '2026-11-05 08:59:32', '2026-11-05 08:59:32'),
('4', 'DRN-0004', '7', 'waiting_payment', 'ready', '380000', 'Jl. Radio Dalam Raya No. 19, Kebayoran Baru, Jakarta Selatan', '2026-11-05 08:29:32', '2026-11-05 10:29:32', NULL, '0', NULL, NULL, '2026-11-05 08:29:32', NULL, NULL, NULL, NULL, NULL, NULL, '2026-11-05 08:59:32', '2026-11-05 08:59:32'),
('5', 'DRN-0005', '8', 'processing', 'ready', '310000', 'Jl. Dr. Soeparno No. 22, Purwokerto Timur, Banyumas', '2026-11-05 04:59:32', '2026-11-05 06:59:32', 'proofs/sample.jpg', '1', NULL, '2026-11-05 05:59:32', '2026-11-05 04:59:32', '2026-11-05 05:59:32', NULL, NULL, NULL, NULL, NULL, '2026-11-05 08:59:32', '2026-11-05 08:59:32');

DROP TABLE IF EXISTS `order_items`;
CREATE TABLE `order_items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) unsigned NOT NULL,
  `product_id` bigint(20) unsigned NOT NULL,
  `quantity` smallint(5) unsigned NOT NULL,
  `price_at_purchase` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_items_order_id_index` (`order_id`),
  KEY `order_items_product_id_index` (`product_id`),
  CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price_at_purchase`, `created_at`, `updated_at`) VALUES
('1', '1', '1', '2', '250000', '2026-11-05 08:59:32', '2026-11-05 08:59:32'),
('2', '2', '3', '1', '420000', '2026-11-05 08:59:32', '2026-11-05 08:59:32'),
('3', '3', '6', '2', '230000', '2026-11-05 08:59:32', '2026-11-05 08:59:32'),
('4', '4', '2', '2', '190000', '2026-11-05 08:59:32', '2026-11-05 08:59:32'),
('5', '5', '4', '1', '310000', '2026-11-05 08:59:32', '2026-11-05 08:59:32');

DROP TABLE IF EXISTS `cart_items`;
CREATE TABLE `cart_items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `product_id` bigint(20) unsigned NOT NULL,
  `quantity` smallint(5) unsigned NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cart_items_user_product_unique` (`user_id`,`product_id`),
  KEY `cart_items_product_id_index` (`product_id`),
  CONSTRAINT `cart_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  CONSTRAINT `cart_items_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

SET FOREIGN_KEY_CHECKS = 1;
