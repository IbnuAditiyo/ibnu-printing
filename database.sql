CREATE DATABASE IF NOT EXISTS db_printing_kampus;
USE db_printing_kampus;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Password default: admin123 (sudah di-hash)
INSERT INTO `users` (`username`, `password`) VALUES
('admin', 'admin123');

CREATE TABLE `artikel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `judul` varchar(150) NOT NULL,
  `konten` text NOT NULL,
  `tanggal_upload` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;