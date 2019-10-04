-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Okt 2019 pada 12.30
-- Versi server: 10.1.37-MariaDB
-- Versi PHP: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_survei_harga`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `sh_komoditas`
--

CREATE TABLE `sh_komoditas` (
  `id` int(11) NOT NULL,
  `id_pengelola` int(11) NOT NULL,
  `id_konfirmasi` int(11) DEFAULT NULL,
  `komoditas` varchar(255) NOT NULL,
  `satuan` varchar(20) NOT NULL,
  `harga` double NOT NULL,
  `tanggal` date NOT NULL,
  `konfirmasi` enum('YES','NO','WAIT') NOT NULL DEFAULT 'WAIT'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `sh_komoditas`
--

INSERT INTO `sh_komoditas` (`id`, `id_pengelola`, `id_konfirmasi`, `komoditas`, `satuan`, `harga`, `tanggal`, `konfirmasi`) VALUES
(1, 2, 1, 'BERAS', 'Kg', 8000, '2019-10-04', 'YES'),
(2, 3, 1, 'Padi', 'Kg', 5000, '2019-10-04', 'YES'),
(3, 3, 1, 'Air Mineral', 'Liter', 3000, '2019-10-04', 'NO');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sh_user`
--

CREATE TABLE `sh_user` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `keterangan` text,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','surveyor','pengunjung') DEFAULT NULL,
  `edited` datetime NOT NULL,
  `id_konfirmator` int(11) DEFAULT NULL,
  `allowed_visit` enum('YES','NO') NOT NULL DEFAULT 'NO'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `sh_user`
--

INSERT INTO `sh_user` (`id`, `nama`, `keterangan`, `username`, `password`, `role`, `edited`, `id_konfirmator`, `allowed_visit`) VALUES
(1, 'Admin Utama', 'Admin Utama', 'admin123', '$2a$08$8fFqSTVWRfzdiy0BgVBO6eCZgYq0w7FSkimrAGz1DrEB/lfMUZXyC', 'admin', '2019-10-03 17:58:08', NULL, 'NO'),
(2, 'Surveyor 1', 'Surveyor 1', 'surveyor1', '$2a$08$pBreF8yxmfHto2wPSTjQC..G6nWP3LAKSumYoHnKfi3tc0jQB/cMu', 'surveyor', '2019-10-04 12:27:08', 1, 'YES'),
(3, 'Mohamad Iqbal Musyaffa', 'Surveyer Baru', 'iqbalm1995', '$2a$08$HyEdoOIsyieKnDWkCbBiCeRtpBPvAT.kCJKs55.ZpA.17GDWR87uq', 'surveyor', '2019-10-03 14:44:33', 1, 'NO'),
(5, 'Mohamad Iqbal Musyaffa', '', 'iqbalm1995', '$2a$08$l/ng6W8PZG.GAZbnXg.PPOPFf0WsP5ZW/5zV5KziX1/W9WDNLo7pa', 'pengunjung', '2019-10-03 15:27:15', 1, 'NO'),
(6, 'pengunjung1', 'pengunjung1', 'pengunjung1', '$2a$08$Y4b7qmuCNzZh04yJ3eCer.Gi0xBWQOFD4mXvW0Qd9/N46OIaqgMxW', 'pengunjung', '2019-10-04 12:08:45', NULL, 'NO');

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `v_konfirm_sh`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `v_konfirm_sh` (
`id` int(11)
,`id_pengelola` int(11)
,`id_konfirmasi` int(11)
,`komoditas` varchar(255)
,`satuan` varchar(20)
,`harga` double
,`tanggal` date
,`konfirmasi` enum('YES','NO','WAIT')
,`nama` varchar(255)
,`username` varchar(255)
,`role` enum('admin','surveyor','pengunjung')
);

-- --------------------------------------------------------

--
-- Struktur untuk view `v_konfirm_sh`
--
DROP TABLE IF EXISTS `v_konfirm_sh`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_konfirm_sh`  AS  select `sh_komoditas`.`id` AS `id`,`sh_komoditas`.`id_pengelola` AS `id_pengelola`,`sh_komoditas`.`id_konfirmasi` AS `id_konfirmasi`,`sh_komoditas`.`komoditas` AS `komoditas`,`sh_komoditas`.`satuan` AS `satuan`,`sh_komoditas`.`harga` AS `harga`,`sh_komoditas`.`tanggal` AS `tanggal`,`sh_komoditas`.`konfirmasi` AS `konfirmasi`,`sh_user`.`nama` AS `nama`,`sh_user`.`username` AS `username`,`sh_user`.`role` AS `role` from (`sh_komoditas` join `sh_user` on((`sh_komoditas`.`id_pengelola` = `sh_user`.`id`))) ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `sh_komoditas`
--
ALTER TABLE `sh_komoditas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pengelola` (`id_pengelola`),
  ADD KEY `id_konfirmasi` (`id_konfirmasi`);

--
-- Indeks untuk tabel `sh_user`
--
ALTER TABLE `sh_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_konfirmator` (`id_konfirmator`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `sh_komoditas`
--
ALTER TABLE `sh_komoditas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `sh_user`
--
ALTER TABLE `sh_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `sh_komoditas`
--
ALTER TABLE `sh_komoditas`
  ADD CONSTRAINT `sh_komoditas_ibfk_1` FOREIGN KEY (`id_pengelola`) REFERENCES `sh_user` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `sh_komoditas_ibfk_2` FOREIGN KEY (`id_konfirmasi`) REFERENCES `sh_user` (`id`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `sh_user`
--
ALTER TABLE `sh_user`
  ADD CONSTRAINT `sh_user_ibfk_1` FOREIGN KEY (`id_konfirmator`) REFERENCES `sh_user` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
