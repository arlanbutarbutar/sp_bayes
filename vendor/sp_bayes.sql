-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Des 2023 pada 16.37
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sp_bayes`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `akuisisi`
--

CREATE TABLE `akuisisi` (
  `id_akuisisi` int(11) NOT NULL,
  `nama_table` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `akuisisi`
--

INSERT INTO `akuisisi` (`id_akuisisi`, `nama_table`, `created_at`, `updated_at`) VALUES
(50, 'akuisisi_p5', '2023-12-12 12:54:40', '2023-12-12 12:54:40'),
(51, 'probabilitas_g5', '2023-12-12 12:54:40', '2023-12-12 12:54:40'),
(52, 'pengamatan5', '2023-12-12 12:54:40', '2023-12-12 12:54:40');

-- --------------------------------------------------------

--
-- Struktur dari tabel `akuisisi_p5`
--

CREATE TABLE `akuisisi_p5` (
  `id_akuisisi5` int(11) NOT NULL,
  `id_gejala` int(11) DEFAULT NULL,
  `H1` char(20) DEFAULT NULL,
  `H2` char(20) DEFAULT NULL,
  `H3` char(20) DEFAULT NULL,
  `H4` char(20) DEFAULT NULL,
  `H5` char(20) DEFAULT NULL,
  `H6` char(20) DEFAULT NULL,
  `H7` char(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `akuisisi_p5`
--

INSERT INTO `akuisisi_p5` (`id_akuisisi5`, `id_gejala`, `H1`, `H2`, `H3`, `H4`, `H5`, `H6`, `H7`) VALUES
(1, 29, 'Checked', '', '', '', '', '', 'Checked'),
(2, 31, '', '', '', 'Checked', '', '', ''),
(3, 32, '', '', 'Checked', 'Checked', '', '', ''),
(4, 33, 'Checked', 'Checked', '', '', '', 'Checked', ''),
(5, 34, 'Checked', '', 'Checked', 'Checked', '', '', 'Checked'),
(6, 35, '', '', '', 'Checked', '', '', ''),
(7, 36, '', 'Checked', '', '', '', '', ''),
(8, 37, '', 'Checked', '', 'Checked', 'Checked', '', 'Checked'),
(9, 38, '', '', 'Checked', '', '', '', ''),
(10, 39, '', '', '', '', 'Checked', '', ''),
(11, 40, 'Checked', '', '', '', '', '', ''),
(12, 41, '', '', '', '', '', '', 'Checked'),
(13, 42, '', '', 'Checked', '', '', '', ''),
(14, 43, '', '', '', 'Checked', '', '', ''),
(15, 44, 'Checked', '', '', '', '', '', ''),
(16, 45, '', '', '', 'Checked', 'Checked', '', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth`
--

CREATE TABLE `auth` (
  `id` int(11) NOT NULL,
  `image` varchar(50) DEFAULT NULL,
  `bg` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `auth`
--

INSERT INTO `auth` (`id`, `image`, `bg`) VALUES
(1, 'auth.jpg', '#3057c9');

-- --------------------------------------------------------

--
-- Struktur dari tabel `diagnosa`
--

CREATE TABLE `diagnosa` (
  `id_diagnosa` int(11) NOT NULL,
  `penyakit` varchar(50) NOT NULL,
  `nilai` char(10) NOT NULL,
  `tanggal` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `diagnosa`
--

INSERT INTO `diagnosa` (`id_diagnosa`, `penyakit`, `nilai`, `tanggal`) VALUES
(1, '', '0', '2023-12-12'),
(2, '', '0', '2023-12-12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `diagnosa_gejala`
--

CREATE TABLE `diagnosa_gejala` (
  `id_dgejala` int(11) NOT NULL,
  `id_diagnosa` int(11) NOT NULL,
  `id_gejala` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `diagnosa_gejala`
--

INSERT INTO `diagnosa_gejala` (`id_dgejala`, `id_diagnosa`, `id_gejala`) VALUES
(17, 1, 29),
(18, 2, 31);

-- --------------------------------------------------------

--
-- Struktur dari tabel `gejala`
--

CREATE TABLE `gejala` (
  `id_gejala` int(11) NOT NULL,
  `id_jenis_tanaman` int(11) NOT NULL,
  `nama_gejala` varchar(75) NOT NULL,
  `kode_gejala` char(25) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `gejala`
--

INSERT INTO `gejala` (`id_gejala`, `id_jenis_tanaman`, `nama_gejala`, `kode_gejala`, `created_at`, `updated_at`) VALUES
(29, 5, 'Bercak kecil di bagian tengah berwarna putih', 'E1', '2023-12-06 07:57:32', '2023-12-06 07:57:32'),
(31, 5, 'Seluruh pinggiran daun berwarna gelap', 'E2', '2023-12-06 08:04:46', '2023-12-06 08:04:46'),
(32, 5, 'Daun menguning, layu, kering dan rontok', 'E3', '2023-12-06 08:05:44', '2023-12-06 08:05:44'),
(33, 5, 'Bercak coklatan pada permukaan buah, kemudian menjadi lunak sehingga daging', 'E4', '2023-12-06 08:08:28', '2023-12-06 08:08:28'),
(34, 5, 'Bagian tengah terdapat titik hitam yang merupakan kelompok spora', 'E5', '2023-12-06 08:09:04', '2023-12-06 08:09:04'),
(35, 5, 'Ukuran daun mengecil terpilin, pembungaanya sedikit', 'E6', '2023-12-06 08:09:56', '2023-12-06 08:09:56'),
(36, 5, 'Anak tulang daun membusuk dan berwarna keputihan', 'E7', '2023-12-06 08:13:23', '2023-12-06 08:13:23'),
(37, 5, 'Tanaman mengalami kekerdilan', 'E8', '2023-12-06 08:13:55', '2023-12-06 08:13:55'),
(38, 5, 'Daun-daun menguning', 'E9', '2023-12-06 08:14:20', '2023-12-06 08:14:20'),
(39, 5, 'Layunya daun pada ujung cabang tanaman', 'E10', '2023-12-06 08:15:27', '2023-12-06 08:15:27'),
(40, 5, 'Memiliki bentuk buah yang kecil-kecil', 'E11', '2023-12-06 08:15:52', '2023-12-06 08:15:52'),
(41, 5, 'Permukaan buah keriput dan mengering serta warna kulit buah seperti jeramih', 'E12', '2023-12-06 08:16:27', '2023-12-06 08:16:27'),
(42, 5, 'Terdapat bintik hitam coklat akibat gigitan kutu tersebut', 'E13', '2023-12-06 08:17:00', '2023-12-06 08:17:00'),
(43, 5, 'Daun-daun tua yang menguning kemudian menjalar ke pucuk tanaman', 'E14', '2023-12-06 08:17:32', '2023-12-06 08:17:32'),
(44, 5, 'Buah tomat berlubang', 'E15', '2023-12-06 08:17:59', '2023-12-06 08:17:59'),
(45, 5, 'Seluruh pinggiran  daun berwarna gelap pada daun', 'E16', '2023-12-06 08:19:42', '2023-12-06 08:19:42');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_tanaman`
--

CREATE TABLE `jenis_tanaman` (
  `id_jenis_tanaman` int(11) NOT NULL,
  `nama_tanaman` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `jenis_tanaman`
--

INSERT INTO `jenis_tanaman` (`id_jenis_tanaman`, `nama_tanaman`, `created_at`, `updated_at`) VALUES
(5, 'Tomat Laharus', '2023-12-06 07:32:32', '2023-12-06 07:32:32');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kontak`
--

CREATE TABLE `kontak` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` char(12) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `pesan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai_akuisisi`
--

CREATE TABLE `nilai_akuisisi` (
  `id_nilai_akuisisi` int(11) NOT NULL,
  `id_gejala` int(11) NOT NULL,
  `id_penyakit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `nilai_akuisisi`
--

INSERT INTO `nilai_akuisisi` (`id_nilai_akuisisi`, `id_gejala`, `id_penyakit`) VALUES
(27, 29, 1),
(28, 31, 4),
(29, 32, 1),
(30, 33, 2),
(31, 34, 1),
(32, 35, 4),
(33, 36, 2),
(34, 38, 3),
(35, 39, 5),
(36, 40, 1),
(37, 41, 7),
(38, 42, 3),
(39, 43, 5),
(40, 44, 2),
(41, 45, 4),
(42, 45, 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai_penyakit`
--

CREATE TABLE `nilai_penyakit` (
  `id_nilai` int(11) NOT NULL,
  `id_penyakit` int(11) NOT NULL,
  `bobot` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `nilai_penyakit`
--

INSERT INTO `nilai_penyakit` (`id_nilai`, `id_penyakit`, `bobot`) VALUES
(15, 1, '0.5'),
(16, 2, '0.5'),
(17, 3, '0.5'),
(18, 4, '0.5'),
(19, 5, '0.5'),
(20, 6, '0.5'),
(21, 7, '0.5');

-- --------------------------------------------------------

--
-- Struktur dari tabel `obat`
--

CREATE TABLE `obat` (
  `id_obat` int(11) NOT NULL,
  `id_penyakit` int(11) NOT NULL,
  `obat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `obat`
--

INSERT INTO `obat` (`id_obat`, `id_penyakit`, `obat`) VALUES
(10, 4, 'Dawatek'),
(11, 1, 'Dawatek'),
(12, 7, 'Dawatek'),
(13, 3, 'Napotek'),
(14, 6, 'Pupuk Fortune'),
(15, 5, 'Pupuk Fortune\\r\\n');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pencegahan`
--

CREATE TABLE `pencegahan` (
  `id_pencegahan` int(11) NOT NULL,
  `id_penyakit` int(11) NOT NULL,
  `pencegahan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengamatan5`
--

CREATE TABLE `pengamatan5` (
  `id_pengamatan5` int(11) NOT NULL,
  `nama_gejala` varchar(75) DEFAULT NULL,
  `nama_penyakit` varchar(75) DEFAULT NULL,
  `nilai_probabilitas` char(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `penyakit`
--

CREATE TABLE `penyakit` (
  `id_penyakit` int(11) NOT NULL,
  `id_jenis_tanaman` int(11) NOT NULL,
  `nama_penyakit` varchar(75) NOT NULL,
  `kode_penyakit` char(25) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `penyakit`
--

INSERT INTO `penyakit` (`id_penyakit`, `id_jenis_tanaman`, `nama_penyakit`, `kode_penyakit`, `created_at`, `updated_at`) VALUES
(1, 5, 'Busuk  buah  antraknos', 'H1', '2023-12-06 08:20:18', '2023-12-06 08:20:18'),
(2, 5, 'Bercak coklat pada daun', 'H2', '2023-12-06 08:20:42', '2023-12-06 08:20:42'),
(3, 5, 'Busuk Batang', 'H3', '2023-12-06 08:21:08', '2023-12-06 08:21:08'),
(4, 5, 'Layu fusarium', 'H4', '2023-12-06 08:21:37', '2023-12-06 08:21:37'),
(5, 5, 'Layu bakteri', 'H5', '2023-12-06 08:22:05', '2023-12-06 08:22:05'),
(6, 5, 'Tomato  yellow curl leaf virus', 'H6', '2023-12-06 08:22:38', '2023-12-06 08:22:38'),
(7, 5, 'Bercak daun  septoria', 'H7', '2023-12-06 08:23:02', '2023-12-06 08:23:02');

-- --------------------------------------------------------

--
-- Struktur dari tabel `probabilitas_g5`
--

CREATE TABLE `probabilitas_g5` (
  `id_probabilitas5` int(11) NOT NULL,
  `id_gejala` int(11) DEFAULT NULL,
  `H1` char(20) DEFAULT NULL,
  `kode_H1` char(20) DEFAULT NULL,
  `H2` char(20) DEFAULT NULL,
  `kode_H2` char(20) DEFAULT NULL,
  `H3` char(20) DEFAULT NULL,
  `kode_H3` char(20) DEFAULT NULL,
  `H4` char(20) DEFAULT NULL,
  `kode_H4` char(20) DEFAULT NULL,
  `H5` char(20) DEFAULT NULL,
  `kode_H5` char(20) DEFAULT NULL,
  `H6` char(20) DEFAULT NULL,
  `kode_H6` char(20) DEFAULT NULL,
  `H7` char(20) DEFAULT NULL,
  `kode_H7` char(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `probabilitas_g5`
--

INSERT INTO `probabilitas_g5` (`id_probabilitas5`, `id_gejala`, `H1`, `kode_H1`, `H2`, `kode_H2`, `H3`, `kode_H3`, `H4`, `kode_H4`, `H5`, `kode_H5`, `H6`, `kode_H6`, `H7`, `kode_H7`) VALUES
(1, 29, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 31, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 32, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 33, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 34, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 36, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 37, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 38, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 39, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 40, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 41, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(13, 42, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(14, 43, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15, 44, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, 45, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `solusi`
--

CREATE TABLE `solusi` (
  `id_solusi` int(11) NOT NULL,
  `id_penyakit` int(11) NOT NULL,
  `solusi` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tentang`
--

CREATE TABLE `tentang` (
  `id` int(11) NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tentang`
--

INSERT INTO `tentang` (`id`, `deskripsi`) VALUES
(1, '<p><strong>Lorem ipsum dolor sit amet consectetur adipisicing elit.</strong> Perspiciatis rerum quia omnis est inventore tenetur sequi ipsa neque sed, enim eos veniam labore ex quasi non eum et reprehenderit odit eaque sint laborum nihil eveniet laboriosam recusandae. Veniam provident, quasi commodi quis, voluptatibus, consequuntur fugiat dolorem quibusdam quidem iusto itaque.</p>\r\n\r\n<p><strong>Lorem ipsum dolor sit amet, consectetur adipisicing elit</strong>. Vitae cupiditate similique voluptatem accusamus dolore qui repudiandae veritatis nisi dicta labore. Doloremque, atque nulla nam impedit minima deserunt rerum culpa rem reprehenderit temporibus, quia optio? Dolores, non repudiandae <em>laborum voluptates</em> recusandae facere impedit eum quibusdam quaerat ea esse numquam sit sed distinctio error commodi illo sint modi animi minus vitae, velit dolor in. Accusamus voluptas maxime beatae, quibusdam debitis totam ut facilis sequi placeat id iure inventore? Aut doloremque natus quas, excepturi quaerat autem. Natus labore maxime dolorum aspernatur temporibus suscipit beatae ex consequuntur repellendus! Quo sunt voluptatem mollitia expedita <em>deserunt!</em></p>\r\n');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `id_role` int(11) DEFAULT 3,
  `id_active` int(11) DEFAULT 2,
  `en_user` varchar(75) DEFAULT NULL,
  `token` char(6) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `image` varchar(100) DEFAULT 'default.svg',
  `email` varchar(75) DEFAULT NULL,
  `password` varchar(75) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `id_role`, `id_active`, `en_user`, `token`, `name`, `image`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL, 'admin', '3424621975.jpg', 'admin@gmail.com', '$2y$10$FlYb2dMj9GyIbmqT5wZFxutHZN5l4ryXD4drV8a3OnqTGw6ypO6QC', '2023-12-05 20:04:05', '2023-12-05 20:04:05'),
(2, 2, 2, '2y106SkHgEOViSEGHT7yGy1M9Qgoosa29mBznwEVDd9SJuPzr5FC', '141988', 'Pakar@gmil.com', '1446888166.jpg', 'Pakar@gmil.com', '$2y$10$G1cBzIghoAnnORf4dYTkt.A.0tKq1xgAS6q0jRvfsE6rBDJpau5my', '2023-12-12 14:43:59', '2023-12-12 14:43:59'),
(3, 3, 1, '2y10xJRtttMMhTB2if3GhQTVuGOVBbDh2BW0aEYXlYEQq9FlpTzYDZG', '149261', 'Arlan Butar Butar', 'default.svg', 'arlan270899@gmail.com', '$2y$10$vBXX/D5QdRrI4ayDZ7GD8OX98k/6iJkLfm62PbNgvKAAeyuARLhFG', '2023-12-12 15:14:57', '2023-12-12 15:15:20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id_access_menu` int(11) NOT NULL,
  `id_role` int(11) DEFAULT NULL,
  `id_menu` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user_access_menu`
--

INSERT INTO `user_access_menu` (`id_access_menu`, `id_role`, `id_menu`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_access_sub_menu`
--

CREATE TABLE `user_access_sub_menu` (
  `id_access_sub_menu` int(11) NOT NULL,
  `id_role` int(11) DEFAULT NULL,
  `id_sub_menu` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user_access_sub_menu`
--

INSERT INTO `user_access_sub_menu` (`id_access_sub_menu`, `id_role`, `id_sub_menu`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(6, 1, 6),
(7, 1, 7),
(8, 1, 8),
(9, 1, 9),
(10, 1, 10),
(11, 1, 11),
(12, 1, 12),
(13, 1, 13),
(14, 1, 14),
(15, 1, 15),
(16, 1, 16);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_menu`
--

CREATE TABLE `user_menu` (
  `id_menu` int(11) NOT NULL,
  `menu` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user_menu`
--

INSERT INTO `user_menu` (`id_menu`, `menu`) VALUES
(1, 'User Management'),
(2, 'Menu Management'),
(3, 'Bayes'),
(4, 'Utilitas');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_role`
--

CREATE TABLE `user_role` (
  `id_role` int(11) NOT NULL,
  `role` varchar(35) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user_role`
--

INSERT INTO `user_role` (`id_role`, `role`) VALUES
(1, 'Administrator'),
(2, 'Pakar'),
(3, 'Member');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_status`
--

CREATE TABLE `user_status` (
  `id_status` int(11) NOT NULL,
  `status` varchar(35) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user_status`
--

INSERT INTO `user_status` (`id_status`, `status`) VALUES
(1, 'Active'),
(2, 'No Active');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id_sub_menu` int(11) NOT NULL,
  `id_menu` int(11) DEFAULT NULL,
  `id_active` int(11) DEFAULT 2,
  `title` varchar(50) DEFAULT NULL,
  `url` varchar(50) DEFAULT NULL,
  `icon` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id_sub_menu`, `id_menu`, `id_active`, `title`, `url`, `icon`) VALUES
(1, 1, 1, 'Users', 'users', 'fas fa-users'),
(2, 1, 1, 'Role', 'role', 'fas fa-user-cog'),
(3, 2, 1, 'Menu', 'menu', 'fas fa-fw fa-folder'),
(4, 2, 1, 'Sub Menu', 'sub-menu', 'fas fa-fw fa-folder-open'),
(5, 2, 1, 'Menu Access', 'menu-access', 'fas fa-user-lock'),
(6, 2, 1, 'Sub Menu Access', 'sub-menu-access', 'fas fa-user-lock'),
(7, 3, 1, 'Gejala', 'gejala', 'fas fa-list'),
(8, 3, 1, 'Penyakit', 'penyakit', 'fas fa-list'),
(9, 3, 1, 'Diagnosa', 'diagnosa', 'fas fa-list'),
(10, 3, 1, 'Akuisisi', 'akuisisi', 'fas fa-list'),
(11, 3, 1, 'Nilai Akuisisi', 'nilai-akuisisi', 'fas fa-list'),
(12, 3, 1, 'Pencegahan', 'pencegahan', 'fas fa-list'),
(13, 3, 1, 'Solusi', 'solusi', 'fas fa-list'),
(14, 3, 1, 'Obat', 'obat', 'fas fa-list'),
(15, 4, 1, 'Tentang', 'tentang', 'fas fa-list-ul'),
(16, 4, 1, 'Kontak', 'kontak', 'fas fa-list-ul');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `akuisisi`
--
ALTER TABLE `akuisisi`
  ADD PRIMARY KEY (`id_akuisisi`);

--
-- Indeks untuk tabel `akuisisi_p5`
--
ALTER TABLE `akuisisi_p5`
  ADD PRIMARY KEY (`id_akuisisi5`);

--
-- Indeks untuk tabel `auth`
--
ALTER TABLE `auth`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `diagnosa`
--
ALTER TABLE `diagnosa`
  ADD PRIMARY KEY (`id_diagnosa`);

--
-- Indeks untuk tabel `diagnosa_gejala`
--
ALTER TABLE `diagnosa_gejala`
  ADD PRIMARY KEY (`id_dgejala`),
  ADD KEY `id_diagnosa` (`id_diagnosa`),
  ADD KEY `id_gejala` (`id_gejala`);

--
-- Indeks untuk tabel `gejala`
--
ALTER TABLE `gejala`
  ADD PRIMARY KEY (`id_gejala`),
  ADD KEY `id_jenis_tanaman` (`id_jenis_tanaman`);

--
-- Indeks untuk tabel `jenis_tanaman`
--
ALTER TABLE `jenis_tanaman`
  ADD PRIMARY KEY (`id_jenis_tanaman`);

--
-- Indeks untuk tabel `kontak`
--
ALTER TABLE `kontak`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `nilai_akuisisi`
--
ALTER TABLE `nilai_akuisisi`
  ADD PRIMARY KEY (`id_nilai_akuisisi`),
  ADD KEY `id_gejala` (`id_gejala`),
  ADD KEY `id_penyakit` (`id_penyakit`);

--
-- Indeks untuk tabel `nilai_penyakit`
--
ALTER TABLE `nilai_penyakit`
  ADD PRIMARY KEY (`id_nilai`),
  ADD KEY `id_penyakit` (`id_penyakit`);

--
-- Indeks untuk tabel `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`id_obat`),
  ADD KEY `id_penyakit` (`id_penyakit`);

--
-- Indeks untuk tabel `pencegahan`
--
ALTER TABLE `pencegahan`
  ADD PRIMARY KEY (`id_pencegahan`),
  ADD KEY `id_penyakit` (`id_penyakit`);

--
-- Indeks untuk tabel `pengamatan5`
--
ALTER TABLE `pengamatan5`
  ADD PRIMARY KEY (`id_pengamatan5`);

--
-- Indeks untuk tabel `penyakit`
--
ALTER TABLE `penyakit`
  ADD PRIMARY KEY (`id_penyakit`),
  ADD KEY `id_jenis_tanaman` (`id_jenis_tanaman`);

--
-- Indeks untuk tabel `probabilitas_g5`
--
ALTER TABLE `probabilitas_g5`
  ADD PRIMARY KEY (`id_probabilitas5`);

--
-- Indeks untuk tabel `solusi`
--
ALTER TABLE `solusi`
  ADD PRIMARY KEY (`id_solusi`),
  ADD KEY `id_penyakit` (`id_penyakit`);

--
-- Indeks untuk tabel `tentang`
--
ALTER TABLE `tentang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_role` (`id_role`),
  ADD KEY `id_active` (`id_active`);

--
-- Indeks untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id_access_menu`),
  ADD KEY `id_role` (`id_role`),
  ADD KEY `id_menu` (`id_menu`);

--
-- Indeks untuk tabel `user_access_sub_menu`
--
ALTER TABLE `user_access_sub_menu`
  ADD PRIMARY KEY (`id_access_sub_menu`),
  ADD KEY `id_role` (`id_role`),
  ADD KEY `id_sub_menu` (`id_sub_menu`);

--
-- Indeks untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indeks untuk tabel `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indeks untuk tabel `user_status`
--
ALTER TABLE `user_status`
  ADD PRIMARY KEY (`id_status`);

--
-- Indeks untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id_sub_menu`),
  ADD KEY `id_menu` (`id_menu`),
  ADD KEY `id_active` (`id_active`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `akuisisi`
--
ALTER TABLE `akuisisi`
  MODIFY `id_akuisisi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT untuk tabel `akuisisi_p5`
--
ALTER TABLE `akuisisi_p5`
  MODIFY `id_akuisisi5` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `auth`
--
ALTER TABLE `auth`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `diagnosa`
--
ALTER TABLE `diagnosa`
  MODIFY `id_diagnosa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `diagnosa_gejala`
--
ALTER TABLE `diagnosa_gejala`
  MODIFY `id_dgejala` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `gejala`
--
ALTER TABLE `gejala`
  MODIFY `id_gejala` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT untuk tabel `jenis_tanaman`
--
ALTER TABLE `jenis_tanaman`
  MODIFY `id_jenis_tanaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `kontak`
--
ALTER TABLE `kontak`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `nilai_akuisisi`
--
ALTER TABLE `nilai_akuisisi`
  MODIFY `id_nilai_akuisisi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT untuk tabel `nilai_penyakit`
--
ALTER TABLE `nilai_penyakit`
  MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `obat`
--
ALTER TABLE `obat`
  MODIFY `id_obat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `pencegahan`
--
ALTER TABLE `pencegahan`
  MODIFY `id_pencegahan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `pengamatan5`
--
ALTER TABLE `pengamatan5`
  MODIFY `id_pengamatan5` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `penyakit`
--
ALTER TABLE `penyakit`
  MODIFY `id_penyakit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `probabilitas_g5`
--
ALTER TABLE `probabilitas_g5`
  MODIFY `id_probabilitas5` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `solusi`
--
ALTER TABLE `solusi`
  MODIFY `id_solusi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `tentang`
--
ALTER TABLE `tentang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id_access_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `user_access_sub_menu`
--
ALTER TABLE `user_access_sub_menu`
  MODIFY `id_access_sub_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `user_status`
--
ALTER TABLE `user_status`
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id_sub_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `diagnosa_gejala`
--
ALTER TABLE `diagnosa_gejala`
  ADD CONSTRAINT `diagnosa_gejala_ibfk_1` FOREIGN KEY (`id_diagnosa`) REFERENCES `diagnosa` (`id_diagnosa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `diagnosa_gejala_ibfk_2` FOREIGN KEY (`id_gejala`) REFERENCES `gejala` (`id_gejala`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `gejala`
--
ALTER TABLE `gejala`
  ADD CONSTRAINT `gejala_ibfk_1` FOREIGN KEY (`id_jenis_tanaman`) REFERENCES `jenis_tanaman` (`id_jenis_tanaman`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `nilai_akuisisi`
--
ALTER TABLE `nilai_akuisisi`
  ADD CONSTRAINT `nilai_akuisisi_ibfk_1` FOREIGN KEY (`id_gejala`) REFERENCES `gejala` (`id_gejala`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `nilai_akuisisi_ibfk_2` FOREIGN KEY (`id_penyakit`) REFERENCES `penyakit` (`id_penyakit`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `nilai_penyakit`
--
ALTER TABLE `nilai_penyakit`
  ADD CONSTRAINT `nilai_penyakit_ibfk_1` FOREIGN KEY (`id_penyakit`) REFERENCES `penyakit` (`id_penyakit`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `obat`
--
ALTER TABLE `obat`
  ADD CONSTRAINT `obat_ibfk_1` FOREIGN KEY (`id_penyakit`) REFERENCES `penyakit` (`id_penyakit`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pencegahan`
--
ALTER TABLE `pencegahan`
  ADD CONSTRAINT `pencegahan_ibfk_1` FOREIGN KEY (`id_penyakit`) REFERENCES `penyakit` (`id_penyakit`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `penyakit`
--
ALTER TABLE `penyakit`
  ADD CONSTRAINT `penyakit_ibfk_1` FOREIGN KEY (`id_jenis_tanaman`) REFERENCES `jenis_tanaman` (`id_jenis_tanaman`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `solusi`
--
ALTER TABLE `solusi`
  ADD CONSTRAINT `solusi_ibfk_1` FOREIGN KEY (`id_penyakit`) REFERENCES `penyakit` (`id_penyakit`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`id_active`) REFERENCES `user_status` (`id_status`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `users_ibfk_3` FOREIGN KEY (`id_role`) REFERENCES `user_role` (`id_role`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD CONSTRAINT `user_access_menu_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `user_role` (`id_role`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `user_access_menu_ibfk_2` FOREIGN KEY (`id_menu`) REFERENCES `user_menu` (`id_menu`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `user_access_sub_menu`
--
ALTER TABLE `user_access_sub_menu`
  ADD CONSTRAINT `user_access_sub_menu_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `user_role` (`id_role`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `user_access_sub_menu_ibfk_2` FOREIGN KEY (`id_sub_menu`) REFERENCES `user_sub_menu` (`id_sub_menu`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD CONSTRAINT `user_sub_menu_ibfk_1` FOREIGN KEY (`id_menu`) REFERENCES `user_menu` (`id_menu`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_sub_menu_ibfk_2` FOREIGN KEY (`id_active`) REFERENCES `user_status` (`id_status`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
