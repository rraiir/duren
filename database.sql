-- ============================================================
-- database.sql : Web Penjualan Durian (PRD v1.0, bagian 7)
-- Target : MySQL / MariaDB (XAMPP), diimpor lewat HeidiSQL
-- Aman diimpor ulang: memakai IF NOT EXISTS, tidak ada DROP.
-- Uang = bilangan bulat rupiah. Status = teks biasa (bukan ENUM).
-- ============================================================

CREATE DATABASE IF NOT EXISTS duren
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE duren;

-- ------------------------------------------------------------
-- users (PRD: Pengguna)
-- phone disimpan format 62xxx. role: 'buyer' atau 'admin'.
-- remember_token dibutuhkan autentikasi bawaan Laravel.
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS users (
  id              BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  name            VARCHAR(100)    NOT NULL,
  phone           VARCHAR(20)     NOT NULL,
  address         TEXT            NOT NULL,
  password        VARCHAR(255)    NOT NULL,
  role            VARCHAR(10)     NOT NULL DEFAULT 'buyer',
  remember_token  VARCHAR(100)    NULL,
  created_at      TIMESTAMP       NULL DEFAULT NULL,
  updated_at      TIMESTAMP       NULL DEFAULT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY users_phone_unique (phone)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------
-- products (PRD: Durian)
-- type: 'ready' atau 'preorder'. Untuk preorder, stock = kuota.
-- Produk tidak dihapus permanen, cukup is_active = 0.
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS products (
  id               BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  name             VARCHAR(100)    NOT NULL,
  size             VARCHAR(10)     NOT NULL,
  est_weight_gram  INT UNSIGNED    NOT NULL,
  price            INT UNSIGNED    NOT NULL,
  stock            INT UNSIGNED    NOT NULL DEFAULT 0,
  type             VARCHAR(10)     NOT NULL DEFAULT 'ready',
  eta_text         VARCHAR(255)    NULL,
  is_active        TINYINT(1)      NOT NULL DEFAULT 1,
  created_at       TIMESTAMP       NULL DEFAULT NULL,
  updated_at       TIMESTAMP       NULL DEFAULT NULL,
  PRIMARY KEY (id),
  KEY products_is_active_index (is_active)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------
-- cart_items (PRD: Keranjang)
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS cart_items (
  id          BIGINT UNSIGNED   NOT NULL AUTO_INCREMENT,
  user_id     BIGINT UNSIGNED   NOT NULL,
  product_id  BIGINT UNSIGNED   NOT NULL,
  quantity    SMALLINT UNSIGNED NOT NULL DEFAULT 1,
  created_at  TIMESTAMP         NULL DEFAULT NULL,
  updated_at  TIMESTAMP         NULL DEFAULT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY cart_items_user_product_unique (user_id, product_id),
  KEY cart_items_product_id_index (product_id),
  CONSTRAINT cart_items_user_id_foreign
    FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE,
  CONSTRAINT cart_items_product_id_foreign
    FOREIGN KEY (product_id) REFERENCES products (id) ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------
-- orders (PRD: Pesanan)
-- status (teks biasa):
--   waiting_payment, waiting_verification, payment_rejected,
--   waiting_shipping_fee, processing, shipped, completed,
--   auto_cancelled, buyer_cancelled, admin_cancelled
-- type            : 'ready' atau 'preorder'
-- delivery_method : NULL, 'self' (antar sendiri), 'courier'
-- proof_upload_count : maksimal 2 (1 unggah + 1 unggah ulang)
-- verified_at : diisi saat Admin menekan Terima (dasar hitung batas hari ongkir).
-- Dikirim dan Sedang Diantar sama-sama 'shipped'.
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS orders (
  id                    BIGINT UNSIGNED  NOT NULL AUTO_INCREMENT,
  code                  VARCHAR(20)      NOT NULL,
  user_id               BIGINT UNSIGNED  NOT NULL,
  status                VARCHAR(30)      NOT NULL DEFAULT 'waiting_payment',
  type                  VARCHAR(10)      NOT NULL DEFAULT 'ready',
  total_price           INT UNSIGNED     NOT NULL,
  shipping_address      TEXT             NOT NULL,
  checkout_at           DATETIME         NOT NULL,
  pay_deadline          DATETIME         NOT NULL,
  proof_path            VARCHAR(255)     NULL,
  proof_upload_count    TINYINT UNSIGNED NOT NULL DEFAULT 0,
  reject_reason         VARCHAR(255)     NULL,
  verified_at           DATETIME         NULL,
  terms_accepted_at     DATETIME         NOT NULL,
  shipping_fee_paid_at  DATETIME         NULL,
  delivery_method       VARCHAR(10)      NULL,
  courier_name          VARCHAR(50)      NULL,
  tracking_number       VARCHAR(50)      NULL,
  cancel_reason         VARCHAR(255)     NULL,
  completed_at          DATETIME         NULL,
  created_at            TIMESTAMP        NULL DEFAULT NULL,
  updated_at            TIMESTAMP        NULL DEFAULT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY orders_code_unique (code),
  KEY orders_user_id_index (user_id),
  KEY orders_status_index (status),
  KEY orders_status_pay_deadline_index (status, pay_deadline),
  CONSTRAINT orders_user_id_foreign
    FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------
-- order_items (PRD: Item Pesanan)
-- price_at_purchase menyimpan harga saat checkout.
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS order_items (
  id                 BIGINT UNSIGNED   NOT NULL AUTO_INCREMENT,
  order_id           BIGINT UNSIGNED   NOT NULL,
  product_id         BIGINT UNSIGNED   NOT NULL,
  quantity           SMALLINT UNSIGNED NOT NULL,
  price_at_purchase  INT UNSIGNED      NOT NULL,
  created_at         TIMESTAMP         NULL DEFAULT NULL,
  updated_at         TIMESTAMP         NULL DEFAULT NULL,
  PRIMARY KEY (id),
  KEY order_items_order_id_index (order_id),
  KEY order_items_product_id_index (product_id),
  CONSTRAINT order_items_order_id_foreign
    FOREIGN KEY (order_id) REFERENCES orders (id) ON DELETE CASCADE,
  CONSTRAINT order_items_product_id_foreign
    FOREIGN KEY (product_id) REFERENCES products (id) ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------
-- settings (PRD: Pengaturan) : satu baris saja, id = 1
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS settings (
  id                          TINYINT UNSIGNED NOT NULL,
  qris_image_path             VARCHAR(255)     NULL,
  admin_whatsapp              VARCHAR(20)      NULL,
  warranty_text               TEXT             NOT NULL,
  shipping_rules_text         TEXT             NOT NULL,
  shipping_fee_deadline_days  TINYINT UNSIGNED NOT NULL DEFAULT 2,
  created_at                  TIMESTAMP        NULL DEFAULT NULL,
  updated_at                  TIMESTAMP        NULL DEFAULT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Baris Pengaturan awal (hanya dibuat jika tabel masih kosong).
-- Admin mengubah teks dan nomor ini lewat dashboard.
INSERT INTO settings
  (id, qris_image_path, admin_whatsapp, warranty_text, shipping_rules_text, shipping_fee_deadline_days, created_at, updated_at)
SELECT
  1,
  NULL,
  NULL,
  'Klaim wajib disertai video unboxing tanpa dipotong dan diajukan maksimal 24 jam setelah durian diterima. Durian busuk atau tidak layak makan diganti atau direfund setelah Admin memeriksa video. Selisih kecil dari estimasi berat dan selera rasa (misalnya kurang manis) tidak dijamin.',
  'Ongkir dikonfirmasi Admin lewat WhatsApp setelah pembayaran durian diterima, lalu dibayar terpisah. Pesanan dikirim setelah ongkir lunas. (Isi aturan lengkap dan wilayah layanan di sini.)',
  2,
  NOW(),
  NOW()
FROM DUAL
WHERE NOT EXISTS (SELECT 1 FROM settings);

-- Akun Admin awal TIDAK dibuat di file ini karena butuh password hash.
-- Buat lewat seeder atau `php artisan tinker`, dengan Hash::make().
