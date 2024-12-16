-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Des 2024 pada 05.15
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pharmasync`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `id_detail` int(11) NOT NULL,
  `no_struck` varchar(50) DEFAULT NULL,
  `id_obat` int(11) DEFAULT NULL,
  `jumlah` int(11) NOT NULL,
  `total_harga` decimal(15,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`id_detail`, `no_struck`, `id_obat`, `jumlah`, `total_harga`) VALUES
(1, '0968618107', 3, 4, 20000.00);

-- --------------------------------------------------------

--
-- Struktur dari tabel `obat`
--

CREATE TABLE `obat` (
  `id_obat` int(11) NOT NULL,
  `nama_obat` varchar(30) NOT NULL,
  `jenis_obat` varchar(20) NOT NULL,
  `dosis` varchar(20) NOT NULL,
  `bentuk` varchar(20) NOT NULL,
  `stock` int(11) NOT NULL,
  `kodeobat` varchar(20) NOT NULL,
  `harga_beli` double NOT NULL,
  `harga_jual` double NOT NULL,
  `editor` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `obat`
--

INSERT INTO `obat` (`id_obat`, `nama_obat`, `jenis_obat`, `dosis`, `bentuk`, `stock`, `kodeobat`, `harga_beli`, `harga_jual`, `editor`) VALUES
(1, 'Paracetamol', 'analgesik', '3x 1 tablet', 'tablet', 100, 'A01BC01', 1000, 2000, 'Angger Tirta Tetalen Mukti'),
(2, 'Ibuprofen', 'analgesik', '3x 1 tablet', 'tablet', 150, 'A02BC02', 1500, 3000, 'Rayhan Akbar'),
(3, 'Metronidazole', 'antibiotik', '3x 1 tablet', 'tablet', 50, 'J01XD01', 2500, 5000, 'Angger Tirta Tetalen Mukti'),
(4, 'Cloxacillin', 'antibiotik', '4x 1 kapsul', 'kapsul', 75, 'J01CF01', 3000, 6000, 'Rayhan Akbar'),
(5, 'Cetirizine', 'antihistamin', '1x 1 tablet', 'tablet', 200, 'R06AE07', 2000, 4000, 'Angger Tirta Tetalen Mukti'),
(6, 'Loratadine', 'antihistamin', '1x 1 tablet', 'tablet', 180, 'R06AX13', 2500, 5000, 'Rayhan Akbar'),
(7, 'Omeprazole', 'antiasam', '1x 1 kapsul', 'kapsul', 120, 'A02BC01', 3000, 6000, 'Angger Tirta Tetalen Mukti'),
(8, 'Ranitidine', 'antiasam', '2x 1 tablet', 'tablet', 140, 'A02BA02', 2000, 4000, 'Rayhan Akbar'),
(9, 'Amoxicillin', 'antibiotik', '3x 1 kapsul', 'kapsul', 60, 'J01CA04', 3500, 7000, 'Angger Tirta Tetalen Mukti'),
(10, 'Clarithromycin', 'antibiotik', '2x 1 tablet', 'tablet', 80, 'J01FA09', 4500, 9000, 'Rayhan Akbar'),
(11, 'Doxycycline', 'antibiotik', '1x 1 tablet', 'tablet', 95, 'J01AA02', 4000, 8000, 'Angger Tirta Tetalen Mukti'),
(12, 'Azithromycin', 'antibiotik', '1x 24 jam', 'tablet', 70, 'J01FA10', 5000, 10000, 'Rayhan Akbar'),
(13, 'Acyclovir', 'antiviral', '5x sehari', 'tablet', 150, 'J05AB01', 2000, 4000, 'Angger Tirta Tetalen Mukti'),
(14, 'Ketoconazole', 'antijamur', '2x sehari', 'krim', 130, 'D01AC08', 3000, 5000, 'Rayhan Akbar'),
(15, 'Miconazole', 'antijamur', '3x sehari', 'krim', 180, 'D01AC02', 2500, 4500, 'Angger Tirta Tetalen Mukti'),
(16, 'Fluconazole', 'antijamur', '1x sehari', 'tablet', 100, 'J02AC01', 4000, 8000, 'Rayhan Akbar'),
(17, 'Nystatin', 'antijamur', '3x sehari', 'krim', 170, 'A07AA02', 2000, 3500, 'Angger Tirta Tetalen Mukti'),
(18, 'Vitamin C', 'vitamin', '1x sehari', 'tablet', 300, 'A11GA01', 1000, 2000, 'Rayhan Akbar'),
(19, 'Vitamin D', 'vitamin', '1x sehari', 'tablet', 250, 'A11CC04', 1200, 2400, 'Angger Tirta Tetalen Mukti'),
(20, 'Vitamin B12', 'vitamin', '1x sehari', 'tablet', 200, 'A11HA03', 1500, 3000, 'Rayhan Akbar'),
(21, 'Calcium Carbonate', 'mineral', '1x sehari', 'tablet', 180, 'A12AA04', 2000, 4000, 'Angger Tirta Tetalen Mukti'),
(22, 'Magnesium Hydroxide', 'mineral', '1x sehari', 'tablet', 160, 'A02AA04', 1800, 3600, 'Rayhan Akbar'),
(23, 'Aluminium Hydroxide', 'antiasam', '2x sehari', 'tablet', 140, 'A02AB01', 2500, 5000, 'Angger Tirta Tetalen Mukti'),
(24, 'Simvastatin', 'hipolipidemik', '1x sehari', 'tablet', 110, 'C10AA01', 3000, 6000, 'Rayhan Akbar'),
(25, 'Atorvastatin', 'hipolipidemik', '1x sehari', 'tablet', 100, 'C10AA05', 4000, 8000, 'Angger Tirta Tetalen Mukti'),
(26, 'Losartan', 'antihipertensi', '1x sehari', 'tablet', 90, 'C09CA01', 3500, 7000, 'Rayhan Akbar'),
(27, 'Amlodipine', 'antihipertensi', '1x sehari', 'tablet', 120, 'C08CA01', 2500, 5000, 'Angger Tirta Tetalen Mukti'),
(28, 'Bisoprolol', 'antihipertensi', '1x sehari', 'tablet', 85, 'C07AB07', 3000, 6000, 'Rayhan Akbar'),
(29, 'Furosemide', 'diuretik', '1x sehari', 'tablet', 60, 'C03CA01', 2000, 4000, 'Angger Tirta Tetalen Mukti'),
(30, 'Spironolactone', 'diuretik', '1x sehari', 'tablet', 75, 'C03DA01', 2500, 5000, 'Rayhan Akbar');

-- --------------------------------------------------------

--
-- Struktur dari tabel `person`
--

CREATE TABLE `person` (
  `id_aktor` int(11) NOT NULL,
  `Username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `Nama` varchar(30) NOT NULL,
  `Jabatan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `person`
--

INSERT INTO `person` (`id_aktor`, `Username`, `password`, `Nama`, `Jabatan`) VALUES
(1, 'talenmuxzti002', '1029384756', 'Angger Tirta Tetalen Mukti', 'owner'),
(2, 'Gerixz', '12345678', 'Angger Gerii', 'apoteker'),
(7, 'SANTOS', 'ssempra', 'KAMAL SANTOSO', 'asisten_apoteker'),
(8, 'Ray12', 'homeless', 'Rayhan Akbar', 'kasir');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `no_struck` varchar(50) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp(),
  `total` decimal(15,2) DEFAULT 0.00,
  `pembeli` varchar(100) DEFAULT NULL,
  `id_aktor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`no_struck`, `tanggal`, `total`, `pembeli`, `id_aktor`) VALUES
('0968618107', '2024-12-10 07:11:45', 20000.00, 'Anonim', 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `no_struck` (`no_struck`),
  ADD KEY `id_obat` (`id_obat`);

--
-- Indeks untuk tabel `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`id_obat`);

--
-- Indeks untuk tabel `person`
--
ALTER TABLE `person`
  ADD PRIMARY KEY (`id_aktor`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`no_struck`),
  ADD KEY `id_aktor` (`id_aktor`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `obat`
--
ALTER TABLE `obat`
  MODIFY `id_obat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT untuk tabel `person`
--
ALTER TABLE `person`
  MODIFY `id_aktor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD CONSTRAINT `detail_transaksi_ibfk_1` FOREIGN KEY (`no_struck`) REFERENCES `transaksi` (`no_struck`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_transaksi_ibfk_2` FOREIGN KEY (`id_obat`) REFERENCES `obat` (`id_obat`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_aktor`) REFERENCES `person` (`id_aktor`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
