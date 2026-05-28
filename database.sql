CREATE DATABASE IF NOT EXISTS db_printing_kampus;
USE db_printing_kampus;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Password default: admin123 (sudah di-hash agar bisa login)
INSERT INTO `users` (`username`, `password`) VALUES
('ibnu', '$2y$10$16FSyfYmbV5OU/tRG2ckven32SRYQWhoM3JDWv4Q/TcRwIYcvqZKO');

CREATE TABLE `artikel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `judul` varchar(150) NOT NULL,
  `konten` text NOT NULL,
  `file_pdf` varchar(255) DEFAULT NULL,
  `tanggal_upload` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;