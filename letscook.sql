-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 20 Jun 2024 pada 11.12
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `letscook`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `gambar` varchar(1000) NOT NULL,
  `username` varchar(16) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`gambar`, `username`, `nama`, `password`) VALUES
('gambaradmin/anne.jpeg', 'admin1', 'Natasya', 'adminsatu'),
('gambaradmin/martha.jpeg', 'admin2', 'Martha', 'admindua'),
('gambaradmin/yohana.jpeg', 'admin3', 'Yohana', 'admintiga');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ganti_katasandi`
--

CREATE TABLE `ganti_katasandi` (
  `id_pengguna` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `kode` varchar(100) NOT NULL,
  `kadaluarsa` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` varchar(16) NOT NULL,
  `nama_kategori` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
('ktgr1', 'Makanan Berat'),
('ktgr2', 'Junk Food'),
('ktgr3', 'Sayur'),
('ktgr4', 'Daging'),
('ktgr5', 'Makanan Tradisional'),
('ktgr6', 'Makanan Internasional'),
('ktgr7', 'Seafood'),
('ktgr8', 'Kue'),
('ktgr9', 'Sambal');

-- --------------------------------------------------------

--
-- Struktur dari tabel `komentar`
--

CREATE TABLE `komentar` (
  `id_komentar` int(11) NOT NULL,
  `isi_komentar` text NOT NULL,
  `id_pengguna` varchar(50) NOT NULL,
  `nama` varchar(1000) NOT NULL,
  `id_resep` varchar(1000) NOT NULL,
  `tanggal` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `komentar`
--

INSERT INTO `komentar` (`id_komentar`, `isi_komentar`, `id_pengguna`, `nama`, `id_resep`, `tanggal`) VALUES
(1, 'otw mencoba', 'yerimiese', 'Yeri Kim', 'kukchwenotchew20240421002', '2024-06-15 10:00:41');

-- --------------------------------------------------------

--
-- Struktur dari tabel `lokasi`
--

CREATE TABLE `lokasi` (
  `id_lokasi` varchar(16) NOT NULL,
  `nama_lokasi` text NOT NULL,
  `alamat` text NOT NULL,
  `koordinat` varchar(50) NOT NULL,
  `gambar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `lokasi`
--

INSERT INTO `lokasi` (`id_lokasi`, `nama_lokasi`, `alamat`, `koordinat`, `gambar`) VALUES
('psr1', 'Pasar Gede Hardjonagoro', 'Jl. Jend. Urip Sumoharjo, Sudiroprajan, Kec. Jebres, Kota Surakarta, Jawa Tengah 57129', '-7.569354368640132, 110.83144496404407', 'gambar/pasar.png'),
('psr10', 'Pasar Rejosari', 'Jl. Sindutan, Purwodiningratan, Kec. Jebres, Kota Surakarta, Jawa Tengah 57128', '-7.563143144618396, 110.83826028599545', 'gambar/pasar.png'),
('psr11', 'Pasar Jongke', 'Jl. Dr. Rajiman, Pajang, Kec. Laweyan, Kota Surakarta, Jawa Tengah 57146', '-7.567551220264656, 110.78929815438552', 'gambar/pasar.png'),
('psr13', 'Pasar Mojosongo', 'CRWQ+HH5, Jl. Brigjend Katamso, Mojosongo, Kec. Jebres, Kota Surakarta, Jawa Tengah 57127', '-7.553614590172637, 110.83899081284609', 'gambaradmin/20240602230723_pasar.png'),
('psr2', 'Pasar Nusukan', 'Jl. Kapten Piere Tendean No.87b, Nusukan, Kec. Banjarsari, Kota Surakarta, Jawa Tengah 57135', '-7.547073286368981, 110.8210477977708', 'gambar/pasar.png'),
('psr3', 'Pasar Kadipolo', 'CRG8+W6R, Jl. Dr. Rajiman, Panularan, Kec. Laweyan, Kota Surakarta, Jawa Tengah 57149', '-7.57262662773744, 110.81552026517848', 'gambar/pasar.png'),
('psr4', 'Pasar Legi', 'Jl. Letjen S. Parman No.19, Setabelan, Kec. Banjarsari, Kota Surakarta, Jawa Tengah 57133', '-7.562764663012591, 110.82424332407388', 'gambar/pasar.png'),
('psr5', 'Pasar Kliwon', 'Jl. Kapten Mulyadi, Kedung Lumbu, Kec. Ps. Kliwon, Kota Surakarta, Jawa Tengah 57113', '-7.575516074629697, 110.83217126150753', 'gambar/pasar.png'),
('psr6', 'Pasar Nongko', 'Jl. Hasanudin, Mangkubumen, Kec. Banjarsari, Kota Surakarta, Jawa Tengah 57139', '-7.5585629999999675, 110.81491432944775', 'gambar/pasar.png'),
('psr7', 'Pasar Harjodaksino, Gemblegan', 'Jl. Yos Sudarso, Danukusuman, Kec. Serengan, Kota Surakarta, Jawa Tengah 57156', '-7.584161570627401, 110.82004859999999', 'gambar/pasar.png'),
('psr8', 'Pasar Gading', 'CR8G+HGH, Jl. Veteran, Gajahan, Kec. Ps. Kliwon, Kota Surakarta, Jawa Tengah 57118', '-7.583556791599758, 110.82635563396848', 'gambaradmin/20240602172326_pasar.png'),
('psr9', 'Pasar Sidodadi, Kleco', 'Jl. Slamet Riyadi, Kampung Kleco, Karangasem, Kec. Laweyan, Kota Surakarta, Jawa Tengah 57145', '-7.557253034528245, 110.77961274110446', 'gambar/pasar.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengguna`
--

CREATE TABLE `pengguna` (
  `id_pengguna` varchar(50) NOT NULL,
  `foto_profil` varchar(1000) NOT NULL,
  `email` varchar(1000) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `password` varchar(20) NOT NULL,
  `tanggal_gabung` datetime NOT NULL,
  `kode_verifikasi` varchar(255) NOT NULL,
  `terverifikasi` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pengguna`
--

INSERT INTO `pengguna` (`id_pengguna`, `foto_profil`, `email`, `nama`, `password`, `tanggal_gabung`, `kode_verifikasi`, `terverifikasi`) VALUES
('chwenotchew', '', '', 'Vernon Choi', '11111', '2024-04-15 03:48:59', '', 1),
('hannipham', 'gambar/1718384480_h.jpeg', 'haha@gmail.com', 'Hanni', '11111', '2024-06-14 19:01:20', '', 1),
('imyourjoy', '', '', 'Joy', '33333', '2024-04-21 16:20:33', '', 1),
('jeongwoo0928', 'gambar/1718859725_6673b7cddd196', 'marthachr16@gmail.com', 'Jeongwoo', 'hahaha111', '2024-06-20 12:02:05', '397204', 1),
('martha08', 'gambar/1718693486_zep-p.jpeg', 'marthachistianti@gmail.com', 'Martha', 'wkwkwk111', '2024-06-18 08:51:26', 'b6f4c0a85a6a3d63d71b41057f6ebfa7', 1),
('matchadepan', '', '', 'caca', '7890', '2024-04-30 07:18:02', '', 1),
('mayones', '', '', 'Asam Pedas', '44444', '2024-04-21 17:49:22', '', 1),
('nana09', '', '', 'ayana', '5678', '2024-04-30 07:47:18', '', 1),
('oklea', '', '', 'leana', '098', '2024-04-24 04:43:18', '', 1),
('onyourmark', '', '', 'Mark Lee', '44444', '2024-04-21 16:21:33', '', 1),
('yerimiese', 'gambar/1718390367_Yeri.jpeg', 'itu@gmail.com', 'Yeri Kim', '22222', '0000-00-00 00:00:00', '', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `resep`
--

CREATE TABLE `resep` (
  `id_resep` varchar(100) NOT NULL,
  `id_pengguna` varchar(50) NOT NULL,
  `judul_resep` varchar(100) NOT NULL,
  `tanggal` datetime NOT NULL,
  `gambar` text NOT NULL,
  `alat` text NOT NULL,
  `bahan` text NOT NULL,
  `langkah_langkah` text NOT NULL,
  `kategori` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `resep`
--

INSERT INTO `resep` (`id_resep`, `id_pengguna`, `judul_resep`, `tanggal`, `gambar`, `alat`, `bahan`, `langkah_langkah`, `kategori`) VALUES
('kukchwenotchew20240421001', 'chwenotchew', 'Nasi Goreng', '2024-04-21 14:23:34', 'gambar/nasigoreng.jpg', 'Wajan\r\nSutil\r\nPisau\r\nTalenan\r\nSendok\r\nPiring', '3 gelas nasi putih\r\n100g daging ayam, potong dadu kecil\r\n2 butir telur, kocok lepas\r\n3 siung bawang putih, cincang halus\r\n1 batang daun bawang, iris tipis\r\n2 sendok makan kecap manis\r\n1 sendok makan saus tiram\r\nGaram dan merica secukupnya\r\nMinyak untuk menumis', 'Panaskan sedikit minyak dalam wajan, tumis bawang putih hingga harum.\r\nTambahkan daging ayam, tumis hingga matang.\r\nMasukkan telur kocok, aduk hingga telur matang dan berbutir.\r\nMasukkan nasi putih, kecap manis, saus tiram, garam, dan merica. Aduk rata hingga semua bahan tercampur.\r\nTambahkan daun bawang, aduk sebentar hingga daun bawang layu.\r\nNasi goreng siap disajikan.', 'ktgr1'),
('kukchwenotchew20240421002', 'chwenotchew', 'Ayam Suwir', '2024-04-21 15:31:02', 'gambar/ayamsuwir.jpg', 'Wajan\r\nSutil\r\nSendok\r\nPiring\r\nPisau', '500g daging ayam, direbus dan disuwir-suwir\r\n3 siung bawang putih, cincang halus\r\n1 buah bawang bombay, iris tipis\r\n2 batang serai, memarkan\r\n3 lembar daun jeruk\r\n3 sendok makan kecap manis\r\n1 sendok makan kecap asin\r\n1 sendok teh garam\r\n1/2 sendok teh merica bubuk\r\nMinyak untuk menumis', 'Panaskan minyak dalam wajan, tumis bawang putih hingga harum.\r\nTambahkan bawang bombay, serai, dan daun jeruk. Tumis hingga bawang bombay layu.\r\nMasukkan ayam suwir, aduk rata dengan bumbu.\r\nTuangkan kecap manis, kecap asin, garam, dan merica bubuk. Aduk hingga bumbu meresap.\r\nTumis hingga ayam sedikit kering dan matang sempurna.\r\nAyam suwir siap disajikan.', 'ktgr4'),
('kukimyourjoy20240421001', 'imyourjoy', 'Opor ayam', '2024-04-21 22:31:22', 'gambar/oporayam.jpg', 'Wajan\r\nSutil\r\nPisau\r\nSendok', 'Ayam, potong menjadi bagian kecil\r\nSantan dari 1 butir kelapa\r\nBawang merah, haluskan\r\nBawang putih, haluskan\r\nKunyit, haluskan\r\nJahe, haluskan\r\nLengkuas, memarkan\r\nDaun salam\r\nSerai, memarkan\r\nGaram secukupnya\r\nGula secukupnya', 'Tumis bawang merah, bawang putih, kunyit, dan jahe hingga harum.\r\nMasukkan potongan ayam, aduk hingga berubah warna.\r\nTambahkan santan, lengkuas, daun salam, serai, garam, dan gula. Aduk rata.\r\nMasak dengan api kecil hingga ayam empuk dan bumbu meresap.\r\nAngkat dan hidangkan selagi hangat.', 'ktgr1'),
('kukimyourjoy20240430001', 'imyourjoy', 'omeltte', '2024-04-30 12:52:24', 'gambar/Omelette française (la meilleure) _ RICARDO.jpeg.jpg', 'sendok\r\ngarpu', 'telor\r\nsusu\r\ngrama\r\nmerica', 'kocok telur, garam, susu dalam mangkuk,\r\n\r\npanaskan wajan, tuang minyak goreng, sebarkan minyak goreng ke permukaan wajah (jangan terlalu banyak minyak),\r\n\r\ntuang telur ke atas wajan dengan api kecil,\r\n\r\nsebelum telur matang dan mengering tambah keju diatas telur,\r\n\r\nsambil dimasak lipat telur tsb,\r\n\r\nsesudah matang tiriskan, taruh pada piring,\r\n\r\npisah setengah omelette menjadi 2,\r\n\r\nomelette siap di sajikan.', 'ktgr6'),
('kukjeongwoo092820240620001', 'jeongwoo0928', 'Tongseng', '2024-06-20 13:47:23', 'gambar/kukjeongwoo092820240620001_tongseng.webp', 'Pisau\r\nWajan\r\nSendok', '500 gram daging kambing, potong-potong.\r\n200 ml santan kental.\r\n2 lembar daun salam.\r\n2 batang serai, memarkan.\r\n3 lembar daun jeruk.\r\n2 sdm kecap manis\r\n2 sdm kecap asin.\r\n1 sdm gula merah.\r\n2 cm lengkuas, memarkan.\r\n1/2 sdt garam.\r\n1/2 sdt teh merica bubuk.\r\n5 gelas air.\r\n2 sdm minyak goreng\r\n\r\nBumbu halus: (5 siung bawang merah, 3 siung bawang putih, 4 butir kemiri, sangrai, 2 cm jahe.', '1. Pertama, haluskan bumbu halus menggunakan blender atau ulekan hingga menjadi pasta halus.\r\n2. Panaskan minyak goreng dalam panci, tumis bumbu halus bersama dengan daun salam, serai, dan lengkuas hingga harum dan matang.\r\n3. Masukkan potongan daging kambing ke dalam tumisan bumbu, aduk hingga daging berubah warna dan tercampur rata dengan bumbu.\r\n4. Tambahkan air dan masak daging dengan api sedang hingga empuk. Jika perlu, tambahkan air secukupnya jika cairan mulai berkurang.\r\n5. Setelah daging empuk, tuangkan santan kental ke dalam panci. Aduk rata dan biarkan mendidih hingga bumbu meresap ke dalam daging.\r\n6. Masukkan daun jeruk, kecap manis, kecap asin, gula merah, garam, dan merica bubuk. Aduk kembali hingga semua bahan tercampur merata.\r\n7. Masak tongseng kambing dengan api kecil hingga santan mengental dan bumbu meresap sempurna ke dalam daging.\r\n8. Kemudian, koreksi rasa sesuai selera. Tambahkan garam atau gula, jika perlu.\r\n9. Angkat tongseng kambing dari api. Selanjutnya, sajikan dalam mangkuk, dan siap disantap selagi hangat bersama nasi putih atau lontong.', 'ktgr4'),
('kukyerimiese20240421001', 'yerimiese', 'Creme Brulee', '2024-04-21 19:05:22', 'gambar/cremebrulee.jpg', 'Oven\r\nMangkok\r\nPisau\r\nPanci\r\nSendok\r\nSaringan\r\nRamekin atau cangkir anti panas\r\nLoyang\r\nTorch (Alat Pemanggang)', '4 butir kuning telur\r\n500 ml krim kental\r\n100 gram gula pasir\r\n1 batang vanili\r\nGula halus untuk taburan', 'Panaskan oven hingga suhu 150°C.\r\nPisahkan kuning telur dan letakkan dalam mangkuk besar.\r\nPotong batang vanili dan ambil bagian dalamnya (biji vanili).\r\nMasukkan krim kental dan biji vanili ke dalam panci, panaskan dengan api kecil hingga hampir mendidih. Jangan sampai mendidih.\r\nCampur gula pasir ke dalam kuning telur, aduk hingga gula larut.\r\nSetelah krim kental hampir mendidih, tuangkan sedikit demi sedikit ke dalam campuran kuning telur sambil terus diaduk agar telur tidak menggumpal.\r\nSaring adonan menggunakan saringan halus untuk mendapatkan tekstur yang halus.\r\nTuangkan adonan ke dalam ramekin atau cangkir tahan panas.\r\nSiapkan loyang yang lebih besar, isi setengah penuh dengan air panas. Letakkan ramekin di dalam loyang tersebut.\r\nPanggang dalam oven selama 35-40 menit atau hingga kue set tapi masih sedikit gemetar di tengahnya.\r\nDinginkan dalam suhu ruangan, lalu simpan dalam lemari es minimal 2 jam atau semalam.\r\nSaat akan disajikan, taburi permukaan cream brulee dengan gula halus dan bakar menggunakan alat pemanggang (torch) hingga gula caramelized.\r\nBiarkan sebentar hingga gula mengeras, lalu sajikan.', 'ktgr6'),
('kukyerimiese20240422001', 'yerimiese', 'Red Velvet', '2024-04-22 04:32:47', 'gambar/redvelvet.jpg', 'Loyang\r\nOven', 'Tepung', 'Campurkan', 'ktgr8'),
('kukyerimiese20240422002', 'yerimiese', 'Puding Stroberi', '2024-04-22 04:34:53', 'gambar/pudingstroberi.jpg', 'Panci\r\nCetakan', '500 ml susu cair\r\n1 bungkus agar-agar bubuk (merah)\r\n100 gram gula pasir\r\n100 gram stroberi segar, haluskan\r\n100 ml air', 'Masak susu cair, agar-agar bubuk, dan gula pasir dalam panci sambil diaduk hingga mendidih.\r\nTambahkan puree stroberi, aduk rata. Matikan api.\r\nTuang puding ke dalam cetakan. Dinginkan hingga set.\r\nPuding Stroberi siap disajikan.', 'ktgr8');

-- --------------------------------------------------------

--
-- Struktur dari tabel `riwayat`
--

CREATE TABLE `riwayat` (
  `id_history` int(11) NOT NULL,
  `id_pengguna` varchar(50) NOT NULL,
  `id_resep` varchar(100) NOT NULL,
  `tanggal` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sampah`
--

CREATE TABLE `sampah` (
  `id_resep` varchar(100) NOT NULL,
  `id_pengguna` varchar(50) NOT NULL,
  `judul_resep` varchar(100) NOT NULL,
  `tanggal` datetime NOT NULL,
  `gambar` text NOT NULL,
  `alat` text NOT NULL,
  `bahan` text NOT NULL,
  `langkah_langkah` text NOT NULL,
  `kategori` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `sampah`
--

INSERT INTO `sampah` (`id_resep`, `id_pengguna`, `judul_resep`, `tanggal`, `gambar`, `alat`, `bahan`, `langkah_langkah`, `kategori`) VALUES
('kukchwenotchew20240421003', 'chwenotchew', 'Sayur Sop', '0000-00-00 00:00:00', 'gambar/sayursop.jpg', 'Panci\r\nSendok kuah', '300 gram wortel, potong dadu\r\n200 gram kentang, potong dadu\r\n100 gram buncis, potong-potong\r\n2 buah jagung manis, potong menjadi 4 bagian\r\n1 batang seledri, iris halus\r\n2 liter air\r\nGaram secukupnya\r\nMerica secukupnya\r\n1 sdm minyak sayur', 'Panaskan minyak sayur dalam panci. Tumis seledri hingga harum.\r\nMasukkan air ke dalam panci. Biarkan mendidih.\r\nMasukkan wortel, kentang, buncis, dan jagung ke dalam panci yang berisi air mendidih.\r\nTambahkan garam dan merica secukupnya. Aduk rata.\r\nMasak sayuran hingga empuk sesuai selera.\r\nAngkat sayur sop dari panci. Sajikan hangat.', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `simpan`
--

CREATE TABLE `simpan` (
  `id_simpan` int(11) NOT NULL,
  `id_pengguna` varchar(50) NOT NULL,
  `id_resep` varchar(100) NOT NULL,
  `tanggal` datetime NOT NULL,
  `status_simpan` enum('bookmarked','unbookmarked') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `simpan`
--

INSERT INTO `simpan` (`id_simpan`, `id_pengguna`, `id_resep`, `tanggal`, `status_simpan`) VALUES
(1, 'yerimiese', 'kukchwenotchew20240421002', '2024-06-15 00:55:33', 'unbookmarked');

-- --------------------------------------------------------

--
-- Struktur dari tabel `suka`
--

CREATE TABLE `suka` (
  `id_suka` int(11) NOT NULL,
  `id_pengguna` varchar(50) NOT NULL,
  `id_resep` varchar(100) NOT NULL,
  `tanggal` datetime NOT NULL,
  `status_suka` enum('liked','unliked') NOT NULL DEFAULT 'unliked'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `suka`
--

INSERT INTO `suka` (`id_suka`, `id_pengguna`, `id_resep`, `tanggal`, `status_suka`) VALUES
(17, 'yerimiese', 'kukchwenotchew20240421002', '2024-06-14 23:54:54', 'liked'),
(18, 'jeongwoo0928', 'kukchwenotchew20240421002', '2024-06-14 23:47:44', 'liked'),
(19, 'yerimiese', 'kukimyourjoy20240421001', '2024-06-14 23:55:02', 'liked'),
(20, 'yerimiese', 'kukyerimiese20240421001', '2024-06-15 03:34:10', 'liked'),
(21, 'jeongwoo0928', 'kukjeongwoo092820240620001', '2024-06-20 08:49:34', 'liked');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`username`);

--
-- Indeks untuk tabel `ganti_katasandi`
--
ALTER TABLE `ganti_katasandi`
  ADD PRIMARY KEY (`id_pengguna`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`),
  ADD UNIQUE KEY `id_kategori` (`id_kategori`);

--
-- Indeks untuk tabel `komentar`
--
ALTER TABLE `komentar`
  ADD PRIMARY KEY (`id_komentar`);

--
-- Indeks untuk tabel `lokasi`
--
ALTER TABLE `lokasi`
  ADD PRIMARY KEY (`id_lokasi`);

--
-- Indeks untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  ADD UNIQUE KEY `id_pengguna` (`id_pengguna`);

--
-- Indeks untuk tabel `resep`
--
ALTER TABLE `resep`
  ADD PRIMARY KEY (`id_resep`),
  ADD UNIQUE KEY `id_resep` (`id_resep`);

--
-- Indeks untuk tabel `riwayat`
--
ALTER TABLE `riwayat`
  ADD PRIMARY KEY (`id_history`);

--
-- Indeks untuk tabel `simpan`
--
ALTER TABLE `simpan`
  ADD PRIMARY KEY (`id_simpan`),
  ADD UNIQUE KEY `id_pengguna` (`id_pengguna`,`id_resep`);

--
-- Indeks untuk tabel `suka`
--
ALTER TABLE `suka`
  ADD PRIMARY KEY (`id_suka`),
  ADD KEY `id_pengguna` (`id_pengguna`),
  ADD KEY `id_resep` (`id_resep`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `ganti_katasandi`
--
ALTER TABLE `ganti_katasandi`
  MODIFY `id_pengguna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `komentar`
--
ALTER TABLE `komentar`
  MODIFY `id_komentar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `riwayat`
--
ALTER TABLE `riwayat`
  MODIFY `id_history` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `simpan`
--
ALTER TABLE `simpan`
  MODIFY `id_simpan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `suka`
--
ALTER TABLE `suka`
  MODIFY `id_suka` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
