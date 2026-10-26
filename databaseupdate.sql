-- ============================================================
-- databaseupdate.sql
-- Pembaruan skema untuk database `duren` yang SUDAH diimpor dari database.sql.
-- Jalankan sekali di phpMyAdmin (tab SQL) atau HeidiSQL.
-- Aman dijalankan ulang. Sintaks IF NOT EXISTS untuk MariaDB (XAMPP).
-- ============================================================

USE duren;

-- Dari v1.1 (aman jika sudah pernah dijalankan)
ALTER TABLE orders
  ADD COLUMN IF NOT EXISTS verified_at DATETIME NULL AFTER reject_reason;

-- v1.2: akun pembeli bisa dinonaktifkan Admin
ALTER TABLE users
  ADD COLUMN IF NOT EXISTS is_active TINYINT(1) NOT NULL DEFAULT 1 AFTER role;

-- v1.2: deskripsi produk untuk halaman Detail Produk
ALTER TABLE products
  ADD COLUMN IF NOT EXISTS description TEXT NULL AFTER eta_text;

-- v1.2: tabel artikel
CREATE TABLE IF NOT EXISTS articles (
  id            BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  title         VARCHAR(150)    NOT NULL,
  summary       VARCHAR(255)    NOT NULL,
  cover_path    VARCHAR(255)    NULL,
  body          TEXT            NOT NULL,
  is_published  TINYINT(1)      NOT NULL DEFAULT 0,
  published_at  DATETIME        NULL,
  created_at    TIMESTAMP       NULL DEFAULT NULL,
  updated_at    TIMESTAMP       NULL DEFAULT NULL,
  PRIMARY KEY (id),
  KEY articles_published_index (is_published, published_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
