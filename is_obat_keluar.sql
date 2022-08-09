-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 09 Agu 2022 pada 04.00
-- Versi server: 5.7.33
-- Versi PHP: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `persediaan_obat`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `is_obat_keluar`
--

CREATE TABLE `is_obat_keluar` (
  `kode_transaksi` varchar(15) NOT NULL,
  `tanggal_keluar` date NOT NULL,
  `kode_obat` varchar(7) NOT NULL,
  `jumlah_keluar` int(11) NOT NULL,
  `created_user` int(3) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `is_obat_keluar`
--

INSERT INTO `is_obat_keluar` (`kode_transaksi`, `tanggal_keluar`, `kode_obat`, `jumlah_keluar`, `created_user`, `created_date`) VALUES
('TM-2017-0000001', '2017-04-01', 'B000358', 100, 3, '2017-04-01 11:59:46'),
('TM-2017-0000002', '2017-04-01', 'B000356', 50, 3, '2017-04-01 11:59:51'),
('TM-2017-0000003', '2017-04-01', 'B000323', 50, 3, '2017-04-01 11:59:56'),
('TM-2017-0000004', '2017-04-01', 'B000316', 150, 3, '2017-04-01 12:00:22'),
('TM-2017-0000005', '2017-04-01', 'B000297', 50, 3, '2017-04-01 12:00:22'),
('TM-2017-0000006', '2017-04-01', 'B000129', 80, 3, '2017-04-01 12:00:22'),
('TM-2017-0000007', '2017-04-01', 'B000128', 50, 3, '2017-04-01 12:00:22'),
('TM-2017-0000008', '2017-04-01', 'B000322', 50, 3, '2017-04-01 12:00:22'),
('TM-2017-0000009', '2017-04-01', 'B000017', 100, 3, '2017-04-01 12:00:22'),
('TM-2017-0000010', '2017-04-01', 'B000212', 50, 3, '2017-04-01 12:00:22'),
('TM-2017-0000011', '2017-04-01', 'B000255', 50, 3, '2017-04-01 12:00:22'),
('TM-2017-0000012', '2017-04-01', 'B000290', 30, 3, '2017-04-01 12:00:22'),
('TM-2017-0000013', '2017-04-01', 'B000181', 50, 3, '2017-04-01 12:00:22'),
('TM-2017-0000014', '2017-04-01', 'B000179', 50, 3, '2017-04-01 12:00:22'),
('TM-2017-0000015', '2017-04-01', 'B000111', 100, 3, '2017-04-01 12:00:22');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `is_obat_keluar`
--
ALTER TABLE `is_obat_keluar`
  ADD PRIMARY KEY (`kode_transaksi`),
  ADD KEY `id_barang` (`kode_obat`),
  ADD KEY `created_user` (`created_user`);

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `is_obat_keluar`
--
ALTER TABLE `is_obat_keluar`
  ADD CONSTRAINT `is_obat_keluar_ibfk_1` FOREIGN KEY (`kode_obat`) REFERENCES `is_obat` (`kode_obat`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `is_obat_keluar_ibfk_2` FOREIGN KEY (`created_user`) REFERENCES `is_users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
