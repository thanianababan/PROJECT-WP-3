-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 14 Jun 2022 pada 12.45
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pembayaranspp`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_siswa`
--

CREATE TABLE `data_siswa` (
  `id` int(11) NOT NULL,
  `status_akun` int(11) DEFAULT NULL,
  `nik` bigint(20) NOT NULL,
  `nok` bigint(20) NOT NULL,
  `email_siswa` varchar(100) DEFAULT NULL,
  `nama_siswa` varchar(128) NOT NULL,
  `jenis_kelamin` varchar(128) NOT NULL,
  `kelas_id` int(11) NOT NULL,
  `nama_ayah` varchar(128) NOT NULL,
  `nama_ibu` varchar(128) NOT NULL,
  `alamat_ortu` varchar(258) NOT NULL,
  `date_created` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `data_siswa`
--

INSERT INTO `data_siswa` (`id`, `status_akun`, `nik`, `nok`, `email_siswa`, `nama_siswa`, `jenis_kelamin`, `kelas_id`, `nama_ayah`, `nama_ibu`, `alamat_ortu`, `date_created`) VALUES
(40, 2, 1111111111111116, 2211111111111111, NULL, 'Rizky R', 'Laki-laki', 3, 'Juna', 'Luna', 'Jakarta', NULL),
(41, 2, 1111111111111115, 3111111111111111, 'tina@gmail.com', 'Tina Dahlia', 'Perempuan', 1, 'Dudi Sudarto', 'Sifa Sandrina', 'Jakarta', 1655202373),
(42, NULL, 1111111111111112, 3111111111111119, NULL, 'Thania Nababan', 'Perempuan', 2, 'Juna', 'Juni', 'Jakarta', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `iuran`
--

CREATE TABLE `iuran` (
  `id` int(11) NOT NULL,
  `bulan_bayar` varchar(128) NOT NULL,
  `jmlh_bayar_lunas` bigint(20) NOT NULL,
  `tahun` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `iuran`
--

INSERT INTO `iuran` (`id`, `bulan_bayar`, `jmlh_bayar_lunas`, `tahun`) VALUES
(1, 'Januari', 600000, 2022),
(2, 'Februari', 600000, 2022),
(3, 'Maret', 600000, 2022),
(4, 'April', 600000, 2022),
(5, 'Mei', 600000, 2022),
(6, 'Juni', 600000, 2022),
(7, 'Juli', 600000, 2022),
(8, 'Agustus', 600000, 2022),
(9, 'September', 600000, 2022),
(10, 'Oktober', 600000, 2022),
(11, 'November', 600000, 2022),
(12, 'Desember', 600000, 2022);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(11) NOT NULL,
  `nama_kelas` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `nama_kelas`) VALUES
(1, 'Kelas X-1'),
(2, 'Kelas X-2'),
(3, 'Kelas XI-1'),
(4, 'Kelas XI-2'),
(5, 'Kelas XII-1'),
(6, 'Kelas XII-2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id_trans` int(11) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `id_siswa` int(11) NOT NULL,
  `bulan_bayar` varchar(128) NOT NULL,
  `tahun_bayar` bigint(20) NOT NULL,
  `jmlh_bayar` bigint(20) NOT NULL,
  `status` varchar(128) NOT NULL,
  `sisa` bigint(20) NOT NULL,
  `tgl_bayar` int(11) NOT NULL,
  `nama_petugas` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id_trans`, `email`, `id_siswa`, `bulan_bayar`, `tahun_bayar`, `jmlh_bayar`, `status`, `sisa`, `tgl_bayar`, `nama_petugas`) VALUES
(99, NULL, 40, 'Januari', 2022, 600000, 'Lunas', 0, 1655197803, 'admin'),
(101, 'tina@gmail.com', 41, 'Januari', 2022, 600000, 'Lunas', 0, 1655202598, 'Tina Dahlia');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `id_siswa` int(11) DEFAULT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `image` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(11) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `id_siswa`, `name`, `email`, `image`, `password`, `role_id`, `is_active`, `date_created`) VALUES
(9, NULL, 'admin', 'admin@admin.com', 'default2.jpg', '$2y$10$Ci0tKaMvPDb1tuyFyWrwSe7UWf.k4henA5iYyUJ7YUc1/G/fwDNDW', 1, 1, 1650336648),
(10, NULL, 'user', 'user@user.com', 'default3.jpg', '$2y$10$jEQdz7zx4aqcblGA8/6CRuOqelwUytwUl08FPBhVq7yYfiI7FYtN2', 2, 1, 1650340033),
(47, 41, 'Tina Dahlia', 'tina@gmail.com', 'default.jpg', '$2y$10$fER2UlEQngMmkvMDD00YPeFkCIXCwlMP1WMlYePqFpu8TFT/NAYGu', 2, 1, 1655202373);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(2, 1, 1),
(9, 2, 4),
(10, 1, 4),
(11, 2, 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`) VALUES
(1, 'admin'),
(4, 'user'),
(5, 'User');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'Admin'),
(2, 'Member');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `is_active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES
(1, 1, 'Dashboard', 'admin', 'fas fa-fw fa-tachometer-alt', 1),
(2, 4, 'Profile Saya', 'user', 'fas fa-fw fa-user', 1),
(3, 4, 'Edit Profile', 'user/edit', 'fas fa-fw fa-user-edit', 1),
(8, 4, 'Ubah Password', 'user/changepassword', 'fas fa-fw fa-key', 1),
(10, 1, 'Data Siswa', 'siswa', 'fas fa-fw fa-user-graduate', 1),
(12, 1, 'Transaksi', 'siswa/transaksi', 'fas fa-fw fa-cash-register', 1),
(18, 1, 'SPP', 'bayar', 'fas fa-fw fa-money-check', 0),
(21, 5, 'Bayar SPP', 'bayar_siswa', 'fas fa-fw fa-money-check', 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `data_siswa`
--
ALTER TABLE `data_siswa`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `iuran`
--
ALTER TABLE `iuran`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_trans`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `data_siswa`
--
ALTER TABLE `data_siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT untuk tabel `iuran`
--
ALTER TABLE `iuran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_trans` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
