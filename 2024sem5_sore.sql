-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 10 Jan 2025 pada 21.25
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
-- Database: `2024sem5_sore`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `anggota`
--

CREATE TABLE `anggota` (
  `nik` varchar(16) NOT NULL,
  `nama` varchar(15) NOT NULL,
  `email` varchar(20) NOT NULL,
  `no_hp` varchar(18) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `foto` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `anggota`
--

INSERT INTO `anggota` (`nik`, `nama`, `email`, `no_hp`, `alamat`, `foto`) VALUES
('1234098754278903', 'Nama kedua', 'kedua@gmail.com', '87234723843', 'JL. SILIWANGI', '58083ccc01f63bbd3da6bf602c8be9b2.png'),
('563456456', 'Nama tiga', 'tiga@gmail.com', '7456456754', 'JL.SUDIRMAN', '152e96c3d05d0a947d6e24407460b7f4.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku`
--

CREATE TABLE `buku` (
  `kode` varchar(10) NOT NULL,
  `judul` varchar(30) NOT NULL,
  `kategori_kode` varchar(30) NOT NULL,
  `isbn` varchar(30) NOT NULL,
  `penulis` varchar(30) NOT NULL,
  `penerbit_kode` varchar(20) NOT NULL,
  `tahun` date NOT NULL,
  `cover` varchar(50) NOT NULL,
  `bahasa` varchar(20) NOT NULL,
  `sinopsis` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `buku`
--

INSERT INTO `buku` (`kode`, `judul`, `kategori_kode`, `isbn`, `penulis`, `penerbit_kode`, `tahun`, `cover`, `bahasa`, `sinopsis`) VALUES
('111', 'aaaaaa', 'CMC', '101010101', 'lkjlkjlkj', '23', '2025-01-02', '52ae960442c9aef06a8b5b9b8f5d27da.jpg', 'Indonesia', 'lkjhlkjhlkjhlkjh'),
('123', 'Buku baru', 'NVL', '34562345', 'penulis baru', 'ERL', '2025-01-05', 'c54182246d5faebeef4a89d97f5115a0.jpg', 'Indonesia', 'Coba input buku baru'),
('123123', 'qweqwe', 'CMC', '098098098', 'aqwaqwaqw', '111', '2025-01-01', 'f0a615281dd8bda5446bd3184fb9d4e9.png', 'Indonesia', 'aaaaaaaaa');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `id` int(11) NOT NULL,
  `id_transaksi` varchar(5) NOT NULL,
  `nik_anggota` varchar(16) NOT NULL,
  `kode_buku` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`id`, `id_transaksi`, `nik_anggota`, `kode_buku`) VALUES
(1, '1', '563456456', '123'),
(2, '1', '563456456', '123123'),
(4, '3', '1234098754278903', '111'),
(5, '3', '1234098754278903', '123'),
(6, '4', '563456456', '111'),
(7, '4', '563456456', '123'),
(8, '4', '563456456', '123123'),
(9, '5', '1234098754278903', '111'),
(10, '5', '1234098754278903', '123'),
(11, '5', '1234098754278903', '123123');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `kategori_kode` varchar(10) NOT NULL,
  `kategori_nama` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`kategori_kode`, `kategori_nama`) VALUES
('CMC', 'COMIC'),
('NVL', 'NOVEL');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penerbit`
--

CREATE TABLE `penerbit` (
  `penerbit_kode` varchar(10) NOT NULL,
  `penerbit_nama` varchar(15) NOT NULL,
  `penerbit_alamat` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `penerbit`
--

INSERT INTO `penerbit` (`penerbit_kode`, `penerbit_nama`, `penerbit_alamat`) VALUES
('111', 'SADASAS', 'popopopo'),
('12121212', 'asasasasas', 'wewewewewe'),
('123', 'ghghg', 'JL. KESUMA'),
('222', 'wewewew', 'aaaaaaa'),
('23', 'Dua agiT', 'Jalan Angka'),
('BPU', 'Bentang Pustaka', 'JL. BUDI KEMULIAAN'),
('ERL', 'ERLANGGA', 'JL.SUDIRMAN'),
('PB', 'Penerbit Baru', 'Jl. Sukajadi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `nik_anggota` varchar(16) NOT NULL,
  `tgl_pinjam` date NOT NULL,
  `tgl_kembali` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id`, `nik_anggota`, `tgl_pinjam`, `tgl_kembali`) VALUES
(1, '563456456', '2025-01-05', '2025-01-11'),
(3, '1234098754278903', '2025-01-10', '2025-01-11'),
(4, '563456456', '2025-01-11', NULL),
(5, '1234098754278903', '2025-01-11', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(16) NOT NULL,
  `password` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'budi', '123'),
(2, 'nina', '345');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`nik`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `no_hp` (`no_hp`);

--
-- Indeks untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`kode`);

--
-- Indeks untuk tabel `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`kategori_kode`),
  ADD UNIQUE KEY `nama` (`kategori_nama`);

--
-- Indeks untuk tabel `penerbit`
--
ALTER TABLE `penerbit`
  ADD UNIQUE KEY `kode` (`penerbit_kode`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
