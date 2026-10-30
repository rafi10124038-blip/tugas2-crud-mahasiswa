CREATE DATABASE IF NOT EXISTS db_mahasiswa CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE db_mahasiswa;

CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS mahasiswa (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nim VARCHAR(20) NOT NULL UNIQUE,
  nama VARCHAR(100) NOT NULL,
  jurusan VARCHAR(50) NOT NULL,
  email VARCHAR(100) NOT NULL
);

-- Login: admin / admin123
INSERT INTO users (username, password) VALUES ('admin', '$2y$10$YJFWV..EKmdpAOtKjuzf7uwn0C1OtSgfhm.XQJzsEOK21Q3cW9zbe');

INSERT INTO mahasiswa (nim, nama, jurusan, email) VALUES
('2026001', 'Budi Santoso', 'Teknik Informatika', 'budi@example.com'),
('2026002', 'Siti Aminah', 'Sistem Informasi', 'siti@example.com');
