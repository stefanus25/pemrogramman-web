-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 06, 2025 at 05:15 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `pweb4`
--

CREATE TABLE `mahasiswa` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `mataKuliah` varchar(100) NOT NULL,
  `nilaiUTS` float NOT NULL,
  `nilaiUAS` float NOT NULL,
  `nilaiPraktikum` float NOT NULL,
  `nilaiAkhir` float GENERATED ALWAYS AS (0.35 * `nilaiUTS` + 0.45 * `nilaiUAS` + 0.2 * `nilaiPraktikum`) STORED,
  `grade` char(1) GENERATED ALWAYS AS (case when `nilaiAkhir` between 81 and 100 then 'A' when `nilaiAkhir` between 61 and 80 then 'B' when `nilaiAkhir` between 41 and 60 then 'C' when `nilaiAkhir` between 21 and 40 then 'D' when `nilaiAkhir` between 0 and 20 then 'E' else NULL end) STORED,
  `status` varchar(50) GENERATED ALWAYS AS (case when `grade` in ('A','B') then 'Lulus' when `grade` = 'C' then 'Harus Mengikuti UM' when `grade` in ('D','E') then 'Tidak Lulus dan Wajib Mengulang' else NULL end) STORED
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `mahasiswa` (`id`, `nama`, `mataKuliah`, `nilaiUTS`, `nilaiUAS`, `nilaiPraktikum`) VALUES
(1, 'Stefanus Andre', 'Pemrogramman Web', 90, 90, 90),
(6, 'Nanda', 'Pemrogramman Web', 90, 70, 70),
(7, 'Ammar', 'Pemrogramman Web', 70, 70, 10),
(8, 'Edo', 'Sistem Basis Data', 30, 30, 30),
(9, 'Licha', 'Pemrogramman Web', 20, 20, 10);

ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `mahasiswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;



-- Membuat tabel mahasiswa
-- CREATE TABLE mahasiswa (
--     id INT AUTO_INCREMENT PRIMARY KEY,
--     nama VARCHAR(100) NOT NULL,
--     mata_kuliah VARCHAR(100) NOT NULL,
--     nilai_uts FLOAT NOT NULL,
--     nilai_uas FLOAT NOT NULL,
--     nilai_praktikum FLOAT NOT NULL,
--     nilai_akhir FLOAT GENERATED ALWAYS AS (0.35 * nilai_uts + 0.45 * nilai_uas + 0.2 * nilai_praktikum) STORED,
--     grade CHAR(1) GENERATED ALWAYS AS (
--         CASE
--             WHEN nilai_akhir BETWEEN 81 AND 100 THEN 'A'
--             WHEN nilai_akhir BETWEEN 61 AND 80 THEN 'B'
--             WHEN nilai_akhir BETWEEN 41 AND 60 THEN 'C'
--             WHEN nilai_akhir BETWEEN 21 AND 40 THEN 'D'
--             WHEN nilai_akhir BETWEEN 0 AND 20 THEN 'E'
--             ELSE NULL
--         END
--     ) STORED,
--     status VARCHAR(50) GENERATED ALWAYS AS (
--         CASE
--             WHEN grade IN ('A', 'B') THEN 'Lulus'
--             WHEN grade = 'C' THEN 'Harus Mengikuti UM'
--             WHEN grade IN ('D', 'E') THEN 'Tidak Lulus dan Wajib Mengulang'
--             ELSE NULL
--         END
--     ) STORED
-- );
