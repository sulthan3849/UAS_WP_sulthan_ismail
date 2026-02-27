CREATE DATABASE IF NOT EXISTS db_dealer_nim;
USE db_dealer_nim;

CREATE TABLE IF NOT EXISTS users (
    id_user INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS merk (
    id_merk INT AUTO_INCREMENT PRIMARY KEY,
    nama_merk VARCHAR(100) NOT NULL
);

CREATE TABLE IF NOT EXISTS tipe_kendaraan (
    id_tipe INT AUTO_INCREMENT PRIMARY KEY,
    nama_tipe VARCHAR(100) NOT NULL
);

CREATE TABLE IF NOT EXISTS kendaraan (
    id_kendaraan INT AUTO_INCREMENT PRIMARY KEY,
    id_merk INT NOT NULL,
    id_tipe INT NOT NULL,
    nama_unit VARCHAR(150) NOT NULL,
    no_rangka VARCHAR(50) NOT NULL,
    tahun_produksi INT NOT NULL,
    harga_jual INT NOT NULL,
    status_stok ENUM('Tersedia', 'Terjual') NOT NULL,
    foto_unit VARCHAR(255),
    FOREIGN KEY (id_merk) REFERENCES merk(id_merk) ON DELETE CASCADE,
    FOREIGN KEY (id_tipe) REFERENCES tipe_kendaraan(id_tipe) ON DELETE CASCADE
);

-- Reset Data
TRUNCATE TABLE users;
TRUNCATE TABLE kendaraan;
SET FOREIGN_KEY_CHECKS=0;
TRUNCATE TABLE merk;
TRUNCATE TABLE tipe_kendaraan;
SET FOREIGN_KEY_CHECKS=1;

-- Insert Dummy Data --
INSERT INTO users (username, password) VALUES ('admin', 'admin');
INSERT INTO merk (nama_merk) VALUES ('Honda'), ('Toyota'), ('Wuling');
INSERT INTO tipe_kendaraan (nama_tipe) VALUES ('MPV'), ('City Car'), ('Sedan');
