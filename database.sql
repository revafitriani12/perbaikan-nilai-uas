CREATE DATABASE IF NOT EXISTS db_akademik;
USE db_akademik;

CREATE TABLE IF NOT EXISTS mata_kuliah (
  IdMataKuliah INT AUTO_INCREMENT PRIMARY KEY,
  KodeMataKuliah VARCHAR(20) NOT NULL UNIQUE,
  NamaMataKuliah VARCHAR(100) NOT NULL UNIQUE,
  ProgramStudi VARCHAR(50) NOT NULL,
  Semester INT NOT NULL,
  SKS INT NOT NULL,
  Status ENUM('Aktif', 'Tidak Aktif') NOT NULL DEFAULT 'Aktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO mata_kuliah (KodeMataKuliah, NamaMataKuliah, ProgramStudi, Semester, SKS, Status) VALUES
('SKA-0309', 'Pemrograman Web Dasar', 'D3 Komputerisasi Akuntansi', 3, 3, 'Aktif'),
('SKA-0308', 'Akuntansi Keuangan Menengah', 'D3 Komputerisasi Akuntansi', 3, 3, 'Aktif'),
('SSI-0310', 'Basis Data Relasional', 'S1 Sistem Informasi', 3, 3, 'Aktif'),
('SKP-0102', 'Pengantar Aplikasi Komputer', 'D3 Komputerisasi Akuntansi', 1, 2, 'Tidak Aktif');