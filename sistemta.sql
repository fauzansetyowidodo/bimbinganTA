-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 18, 2023 at 10:37 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sistemta`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `Password` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `Password`) VALUES
(0, 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `ideta`
--

CREATE TABLE `ideta` (
  `IDIde` bigint(20) NOT NULL,
  `IDIdeMahasiswa` bigint(20) NOT NULL,
  `JudulIde` varchar(100) CHARACTER SET latin1 NOT NULL,
  `DeskripsiIde` text CHARACTER SET latin1 NOT NULL,
  `TanggalIde` varchar(30) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `kartubimbingan`
--

CREATE TABLE `kartubimbingan` (
  `IDKartu` int(11) NOT NULL,
  `IDKartuMahasiswa` bigint(30) NOT NULL,
  `IDDosenPembimbing` varchar(30) NOT NULL,
  `Catatan` text NOT NULL,
  `TanggalBimbingan` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kartubimbingan`
--

INSERT INTO `kartubimbingan` (`IDKartu`, `IDKartuMahasiswa`, `IDDosenPembimbing`, `Catatan`, `TanggalBimbingan`) VALUES
(5, 193140714111066, '2021118811301001', 'Bab 1 sudah bagus', '2022-06-29'),
(6, 193140714111066, '2021118811301001', 'bab 2 kurang', '2022-06-30'),
(7, 193140714111064, '2021119102201001', 'kurang bab 2 yaaa', '2022-06-30');

-- --------------------------------------------------------

--
-- Table structure for table `minat`
--

CREATE TABLE `minat` (
  `IDMinat` int(11) NOT NULL,
  `IDProdiMnt` int(11) NOT NULL,
  `IDDosen` bigint(20) NOT NULL,
  `Minat` varchar(40) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `minat`
--

INSERT INTO `minat` (`IDMinat`, `IDProdiMnt`, `IDDosen`, `Minat`) VALUES
(1, 1, 2014058711232002, 'Teknologi Informatika & Komputer'),
(2, 1, 0, 'Sistem Informasi');

-- --------------------------------------------------------

--
-- Table structure for table `notifikasi`
--

CREATE TABLE `notifikasi` (
  `IDNotifikasi` int(11) NOT NULL,
  `Notifikasi` varchar(300) NOT NULL,
  `Catatan` text NOT NULL,
  `TanggalNotifikasi` varchar(40) NOT NULL,
  `IDPenerima` bigint(20) NOT NULL,
  `IDPengirim` bigint(20) NOT NULL,
  `StatusNotifikasi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notifikasi`
--

INSERT INTO `notifikasi` (`IDNotifikasi`, `Notifikasi`, `Catatan`, `TanggalNotifikasi`, `IDPenerima`, `IDPengirim`, `StatusNotifikasi`) VALUES
(16, 'Sistem Informasi Proses Bimbingan Tugas Akhir Berbasis Website', 'Anda Di Tetapkan Sebagai Dosen Pembimbing Fauzan Athallah Setyowidodo Anda sekarang bisa melihat proposal maupun Tugas Akhir Fauzan Athallah Setyowidodo', '2022-06-29', 2021118811301001, 2021119102201001, 'Informasi'),
(17, 'Sistem Informasi Proses Bimbingan Tugas Akhir Berbasis Website', 'Ya sudah bagus, silahkan lanjutkan !', '2022-06-29', 193140714111066, 2021119102201001, 'Diterima'),
(18, ' File TA Sistem Informasi Proses Bimbingan Tugas Akhir Berbasis Website Telah Di ACC', ' Telah Di ACC Oleh : <br>Ir. Zikrie Pramudia Alfarhisi, ST.,MT Sebagai Pembimbing ', '2022-06-30', 193140714111066, 2021118811301001, 'Proposal'),
(19, 'test 1', 'Anda Di Tetapkan Sebagai Dosen Pembimbing Revanta Anda sekarang bisa melihat proposal maupun Tugas Akhir Revanta', '2022-06-30', 2021118811301001, 2021119102201001, 'Informasi'),
(20, 'test 1', 'sudah bagus', '2022-06-30', 193140714111065, 2021119102201001, 'Diterima'),
(21, 'anjay', 'Anda Di Tetapkan Sebagai Dosen Pembimbing Agassi Putra Anda sekarang bisa melihat proposal maupun Tugas Akhir Agassi Putra', '2022-06-30', 2021119102201001, 2021119102201001, 'Informasi'),
(22, 'anjay', 'Wah udah keren', '2022-06-30', 193140714111064, 2021119102201001, 'Diterima'),
(23, ' File TA Sistem Informasi Proses Bimbingan Tugas Akhir Berbasis Website Telah Di ACC', ' Telah Di ACC Oleh : <br>Ir. Zikrie Pramudia Alfarhisi, ST.,MT Sebagai Pembimbing ', '2022-07-05', 193140714111066, 2021118811301001, 'Ta'),
(24, ' File TA test 1 Telah Di ACC', ' Telah Di ACC Oleh : <br>Ir. Zikrie Pramudia Alfarhisi, ST.,MT Sebagai Pembimbing ', '2022-07-05', 193140714111065, 2021118811301001, 'Proposal'),
(25, ' File TA test 1 Telah Di ACC', ' Telah Di ACC Oleh : <br>Ir. Zikrie Pramudia Alfarhisi, ST.,MT Sebagai Pembimbing ', '2022-07-05', 193140714111065, 2021118811301001, 'Ta');

-- --------------------------------------------------------

--
-- Table structure for table `pembimbing`
--

CREATE TABLE `pembimbing` (
  `IDPembimbing` int(11) NOT NULL,
  `IDDosenPmb` bigint(20) NOT NULL,
  `IDTaPmb` int(11) NOT NULL,
  `StatusProposal` tinyint(1) NOT NULL,
  `StatusTa` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembimbing`
--

INSERT INTO `pembimbing` (`IDPembimbing`, `IDDosenPmb`, `IDTaPmb`, `StatusProposal`, `StatusTa`) VALUES
(5, 2021118811301001, 1656503100, 1, 1),
(6, 2021118811301001, 1656557997, 1, 1),
(7, 2021119102201001, 1656582771, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `prodi`
--

CREATE TABLE `prodi` (
  `IDProdi` bigint(20) NOT NULL,
  `Prodi` varchar(30) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `prodi`
--

INSERT INTO `prodi` (`IDProdi`, `Prodi`) VALUES
(1, 'Teknologi Informasi'),
(2, 'Manajemen Perhotelan');

-- --------------------------------------------------------

--
-- Table structure for table `tugasakhir`
--

CREATE TABLE `tugasakhir` (
  `IDTa` int(20) NOT NULL,
  `IDMahasiswaTa` bigint(20) NOT NULL,
  `JudulTa` varchar(200) CHARACTER SET latin1 NOT NULL,
  `FileProposal` varchar(100) CHARACTER SET latin1 NOT NULL,
  `FileTugasakhir` varchar(100) CHARACTER SET latin1 NOT NULL,
  `Uploader` bigint(20) DEFAULT NULL,
  `Deskripsi` text CHARACTER SET latin1 NOT NULL,
  `Tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tugasakhir`
--

INSERT INTO `tugasakhir` (`IDTa`, `IDMahasiswaTa`, `JudulTa`, `FileProposal`, `FileTugasakhir`, `Uploader`, `Deskripsi`, `Tanggal`) VALUES
(1656503100, 193140714111066, 'Sistem Informasi Proses Bimbingan Tugas Akhir Berbasis Website', '1656503100.pdf', '1656503100.pdf', 193140714111066, 'Bimbingan tugas akhir masih dilakukan dengan cara tatap muka memiliki kekurangan. Pada pelaksanaan bimbingan tersebut terdapat kendala yang dihadapi dalam prosesnya. Salah satu contoh kendala adalah dosen pembimbing diharuskan melakukan dinas ke luar kota sehingga membuat mahasiswa terpaksa menunda proses bimbingannya mengakibatkan tugas akhir tidak dapat selesai pada waktu yang telah ditentukan, dan beberapa tahun ini terdapat pandemi COVID-19 yang membuat semua kegiatan di universitas tidak dapat bertemu secara tatap muka. Berdasarkan masalah tersebut, dibutuhkan sebuah media yang dapat memfasilitasi proses bimbingan antara mahasiswa dengan dosen pembimbing.', '2022-06-29'),
(1656557997, 193140714111065, 'test 1', '1656557997.pdf', '1656557997.pdf', 193140714111065, 'Belum Mengajukan Ide Tugas AkhirBelum Mengajukan Ide Tugas AkhirBelum Mengajukan Ide Tugas AkhirBelum Mengajukan Ide Tugas AkhirBelum Mengajukan Ide Tugas AkhirBelum Mengajukan Ide Tugas AkhirBelum Mengajukan Ide Tugas AkhirBelum Mengajukan Ide Tugas AkhirBelum Mengajukan Ide Tugas Akhir', '2022-06-30'),
(1656582771, 193140714111064, 'anjay', '', '', 2021119102201001, 'Belum Mengajukan Ide Tugas AkhirBelum Mengajukan Ide Tugas AkhirBelum Mengajukan Ide Tugas AkhirBelum Mengajukan Ide Tugas AkhirBelum Mengajukan Ide Tugas AkhirBelum Mengajukan Ide Tugas AkhirBelum Mengajukan Ide Tugas AkhirBelum Mengajukan Ide Tugas AkhirBelum Mengajukan Ide Tugas AkhirBelum Mengajukan Ide Tugas Akhir', '2022-06-30');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` bigint(20) NOT NULL,
  `Nama` varchar(100) NOT NULL,
  `Password` varchar(200) NOT NULL,
  `IDProdiUser` bigint(20) NOT NULL,
  `IDMinatUser` bigint(20) NOT NULL,
  `NoHP` varchar(20) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `Foto` varchar(30) NOT NULL,
  `Status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `Nama`, `Password`, `IDProdiUser`, `IDMinatUser`, `NoHP`, `Email`, `Foto`, `Status`) VALUES
(193140714111049, 'Gandi Wirapeta', '827ccb0eea8a706c4c34a16891f84e7b', 1, 1, '', 'asd@gmail.com', '', 'Mahasiswa'),
(193140714111064, 'Agassi Putra', '827ccb0eea8a706c4c34a16891f84e7b', 1, 1, '', 'asd@asd', '', 'Mahasiswa'),
(193140714111065, 'Revanta', '827ccb0eea8a706c4c34a16891f84e7b', 1, 1, '', 'revanta@gmail.com', '193140714111065.jpg', 'Mahasiswa'),
(193140714111066, 'Fauzan Athallah Setyowidodo', '821ad6b80f8f70ca600c0be91949db60', 1, 1, '', 'fauzansetyowidodo@gmail.com', '', 'Mahasiswa'),
(2014058711232002, 'Novita Rosyida, S.Si., M.Si', '827ccb0eea8a706c4c34a16891f84e7b', 1, 1, '', 'novitarosyida@ub.ac.id', '2014058711232002.jpg', 'Dosen'),
(2021118811301001, 'Ir. Zikrie Pramudia Alfarhisi, ST.,MT', '827ccb0eea8a706c4c34a16891f84e7b', 1, 1, '', 'izzi.pramudia@gmail.com', '', 'Dosen'),
(2021119102201001, 'Rachmad Andri Atmoko, S.ST, M.T', '827ccb0eea8a706c4c34a16891f84e7b', 1, 1, '', 'ra.atmoko@ub.ac.id', '', 'Dosen');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ideta`
--
ALTER TABLE `ideta`
  ADD PRIMARY KEY (`IDIde`);

--
-- Indexes for table `kartubimbingan`
--
ALTER TABLE `kartubimbingan`
  ADD PRIMARY KEY (`IDKartu`);

--
-- Indexes for table `minat`
--
ALTER TABLE `minat`
  ADD PRIMARY KEY (`IDMinat`);

--
-- Indexes for table `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD PRIMARY KEY (`IDNotifikasi`);

--
-- Indexes for table `pembimbing`
--
ALTER TABLE `pembimbing`
  ADD PRIMARY KEY (`IDPembimbing`);

--
-- Indexes for table `prodi`
--
ALTER TABLE `prodi`
  ADD PRIMARY KEY (`IDProdi`);

--
-- Indexes for table `tugasakhir`
--
ALTER TABLE `tugasakhir`
  ADD PRIMARY KEY (`IDTa`),
  ADD KEY `Uploader` (`Uploader`),
  ADD KEY `IDMahasiswaTa` (`IDMahasiswaTa`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `id_jurusan_mhs` (`IDProdiUser`),
  ADD KEY `id_konsentrasi_mhs` (`IDMinatUser`),
  ADD KEY `IDProdiUser` (`IDProdiUser`),
  ADD KEY `IDMinatUser` (`IDMinatUser`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kartubimbingan`
--
ALTER TABLE `kartubimbingan`
  MODIFY `IDKartu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `minat`
--
ALTER TABLE `minat`
  MODIFY `IDMinat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `notifikasi`
--
ALTER TABLE `notifikasi`
  MODIFY `IDNotifikasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `pembimbing`
--
ALTER TABLE `pembimbing`
  MODIFY `IDPembimbing` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `prodi`
--
ALTER TABLE `prodi`
  MODIFY `IDProdi` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
