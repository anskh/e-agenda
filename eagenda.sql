-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 17, 2024 at 12:44 PM
-- Server version: 11.2.2-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eagenda`
--

-- --------------------------------------------------------

--
-- Table structure for table `dbo_akses`
--

CREATE TABLE `dbo_akses` (
  `kode` varchar(10) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `create_at` int(11) NOT NULL,
  `update_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `dbo_akses`
--

INSERT INTO `dbo_akses` (`kode`, `nama`, `create_at`, `update_at`) VALUES
('B', 'Biasa', 1704533715, 1705814331),
('R', 'Rahasia', 1704533715, NULL),
('T', 'Terbatas', 1704533715, 1705814336);

-- --------------------------------------------------------

--
-- Table structure for table `dbo_dinas_keluar`
--

CREATE TABLE `dbo_dinas_keluar` (
  `id` int(11) NOT NULL,
  `akses` varchar(10) NOT NULL,
  `nomor` varchar(10) NOT NULL,
  `fungsi` varchar(5) NOT NULL,
  `klasifikasi` varchar(10) NOT NULL,
  `tahun` varchar(4) NOT NULL,
  `nomor_naskah` varchar(50) NOT NULL,
  `perihal` varchar(255) NOT NULL,
  `tujuan` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `file` varchar(255) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `user_create` int(11) NOT NULL,
  `user_update` int(11) DEFAULT NULL,
  `create_at` int(11) NOT NULL,
  `update_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dbo_eksternal_keluar`
--

CREATE TABLE `dbo_eksternal_keluar` (
  `id` int(11) NOT NULL,
  `akses` varchar(10) NOT NULL,
  `nomor` varchar(10) NOT NULL,
  `fungsi` varchar(5) NOT NULL,
  `klasifikasi` varchar(10) NOT NULL,
  `tahun` varchar(4) NOT NULL,
  `nomor_naskah` varchar(50) NOT NULL,
  `perihal` varchar(255) NOT NULL,
  `tujuan` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `file` varchar(255) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `user_create` int(11) NOT NULL,
  `user_update` int(11) DEFAULT NULL,
  `create_at` int(11) NOT NULL,
  `update_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dbo_fungsi`
--

CREATE TABLE `dbo_fungsi` (
  `kode` varchar(5) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `create_at` int(11) NOT NULL,
  `update_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `dbo_fungsi`
--

INSERT INTO `dbo_fungsi` (`kode`, `nama`, `create_at`, `update_at`) VALUES
('14000', 'BPS Provinsi Riau', 1704199126, 1706461729),
('14510', 'Bagian Umum', 1704199126, NULL),
('14520', 'Fungsi Statistik Sosial', 1704199126, 1705684313),
('14530', 'Fungsi Statistik Produksi', 1704199126, NULL),
('14540', 'Fungsi Statistik Distribusi', 1704199126, NULL),
('14550', 'Fungsi Nerwilis', 1704199126, NULL),
('14560', 'Fungsi IPDS', 1704199126, 1718533030);

-- --------------------------------------------------------

--
-- Table structure for table `dbo_internal_keluar`
--

CREATE TABLE `dbo_internal_keluar` (
  `id` int(11) NOT NULL,
  `akses` varchar(10) NOT NULL,
  `nomor` varchar(10) NOT NULL,
  `fungsi` varchar(5) NOT NULL,
  `klasifikasi` varchar(10) NOT NULL,
  `tahun` varchar(4) NOT NULL,
  `nomor_naskah` varchar(50) NOT NULL,
  `perihal` varchar(255) NOT NULL,
  `tujuan` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `file` varchar(255) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `user_create` int(11) NOT NULL,
  `user_update` int(11) DEFAULT NULL,
  `create_at` int(11) NOT NULL,
  `update_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dbo_klasifikasi`
--

CREATE TABLE `dbo_klasifikasi` (
  `kode` varchar(10) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `is_item` int(11) NOT NULL DEFAULT 1,
  `create_at` int(11) NOT NULL,
  `update_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `dbo_klasifikasi`
--

INSERT INTO `dbo_klasifikasi` (`kode`, `nama`, `is_item`, `create_at`, `update_at`) VALUES
('DL', 'PENDIDIKAN DAN LATIHAN', 0, 1704189089, NULL),
('DL.000', 'PERENCANAAN DIKLAT', 1, 1704189089, 1704649865),
('DL.010', 'Analisa kebutuhan penyelenggaraan diklat', 1, 1704189089, NULL),
('DL.020', 'Sistem dan metode', 1, 1704189089, 1718533016),
('DL.030', 'Kurikulim', 1, 1704189089, 1705814453),
('DL.040', 'Bahan ajar/modul', 1, 1704189089, 1705682163),
('DL.050', 'Konsultasi penyelenggaraan diklat', 1, 1704189089, NULL),
('DL.100', 'AKREDITASI LEMBAGA DIKLAT', 1, 1704189089, NULL),
('DL.110', 'Surat permohonan akreditasi', 1, 1704189089, NULL),
('DL.120', 'Laporan hasil verifikasi lapangan', 1, 1704189089, NULL),
('DL.130', 'Berita acara rapat verifikasi', 1, 1704189089, NULL),
('DL.140', 'Berita acara raoat tim penilai', 1, 1704189089, NULL),
('DL.150', 'Surat keputusan penetapan akreditasi', 1, 1704189089, NULL),
('DL.160', 'Surat akreditasi', 1, 1704189089, NULL),
('DL.170', 'Laporan akreditasi lembaga diklat', 1, 1704189089, NULL),
('DL.200', 'PENYELENGGARAKAN DIKLAT', 1, 1704189089, NULL),
('DL.210', 'Prajabatan', 1, 1704189089, NULL),
('DL.220', 'Kepemimpinan', 1, 1704189089, NULL),
('DL.230', 'Teknis', 1, 1704189089, NULL),
('DL.240', 'Fungsional', 1, 1704189089, NULL),
('DL.250', 'Evaluasi pasca diklat', 1, 1704189089, NULL),
('DL.300', 'SERTIFIKAT SUMBERDAYA MANUSIA KEDIKLATAN', 1, 1704189089, NULL),
('DL.400', 'SISTEM INFORMASI DIKLAT', 1, 1704189089, NULL),
('DL.410', 'Data lembaga diklat', 1, 1704189089, NULL),
('DL.420', 'Data prasarana diklat', 1, 1704189089, NULL),
('DL.430', 'Data sarana diklat', 1, 1704189089, NULL),
('DL.440', 'Data pengelola diklat', 1, 1704189089, NULL),
('DL.450', 'Data penyelenggara diklat', 1, 1704189089, NULL),
('DL.460', 'Data widyaiswara', 1, 1704189089, NULL),
('DL.470', 'Data program diklat', 1, 1704189089, NULL),
('DL.500', 'REGISTRASI SERTIFIKAT/STTPL PESERTA DIKLAT', 1, 1704189089, NULL),
('DL.510', 'Surat permohonan kode registrasi', 1, 1704189089, NULL),
('DL.520', 'Buku Registrasi', 1, 1704189089, NULL),
('DL.530', 'Surat penyampaian kode registrasi', 1, 1704189089, NULL),
('DL.600', 'EVALUASI PENYELENGGARAAN DIKLAT', 1, 1704189089, NULL),
('DL.610', 'Evaluasi materi penyenggaraan', 1, 1704189089, NULL),
('DL.620', 'Evaluasi pengajar/instruktur/fasilitator', 1, 1704189089, NULL),
('DL.630', 'Evaluasi peserta', 1, 1704189089, NULL),
('DL.640', 'Evaluasi sarana dan prasarana', 1, 1704189089, NULL),
('DL.650', 'Evaluasi alumni peserta', 1, 1704189089, NULL),
('DL.660', 'Laporan penyelenggaran', 1, 1704189089, NULL),
('DL.670', 'Evaluasi alumni diklat', 1, 1704189089, 1718533011),
('ES', 'EVALUASI DAN PELAPORAN SENSUS, SURVEI DAN KONSOLIDASI DATA', 0, 1704189089, NULL),
('ES.000', 'EVALUASI DAN PELAPORAN SENSUS, SURVEI DAN KONSOLIDASI DATA', 1, 1704189089, NULL),
('HK', 'HUKUM', 0, 1704189089, NULL),
('HK.000', 'PROGRAM LEGILASI', 1, 1704189089, NULL),
('HK.010', 'Bahan/materi program legilasi nasional dan instansi', 1, 1704189089, NULL),
('HK.020', 'Program legilasi lembaga/instansi', 1, 1704189089, NULL),
('HK.100', 'PERATURAN PIMPINAN LEMBAGA/INSTANSI', 1, 1704189089, NULL),
('HK.1000', 'KASUS/SENGKETA HUKUM', 1, 1704189089, NULL),
('HK.1010', 'Pidana: berkas tentang kasus/sengketa pidana, baik kejahatan maupun pelanggaran', 1, 1704189089, NULL),
('HK.1011', 'Proses verbal mulai dari penyelidikan, penyidikan sampai dengan vonis', 1, 1704189089, NULL),
('HK.1012', 'Berkas pembelaan dan bantuan hukum', 1, 1704189089, NULL),
('HK.1013', 'Telaah hukum dan opini terbuka', 1, 1704189089, NULL),
('HK.1020', 'Perdata', 1, 1704189089, NULL),
('HK.1021', 'Proses gugatan sampai dengan putusan', 1, 1704189089, NULL),
('HK.1022', 'Berkas pembelaan dan bantuan hukum', 1, 1704189089, NULL),
('HK.1023', 'Telaah hukum dan opini hukum', 1, 1704189089, NULL),
('HK.1030', 'Tata Usaha Negara', 1, 1704189089, NULL),
('HK.1031', 'Proses gugatan sampai dengan putusan', 1, 1704189089, NULL),
('HK.1032', 'Berkas pembelaan dan bantuan hukum', 1, 1704189089, NULL),
('HK.1033', 'Telaah hukum dan opini hukum', 1, 1704189089, NULL),
('HK.1040', 'Arbitrase', 1, 1704189089, NULL),
('HK.1041', 'Proses gugatan sampai dengan putusan', 1, 1704189089, NULL),
('HK.1042', 'Berkas pembelaan dan bantuan hukum', 1, 1704189089, NULL),
('HK.1043', 'Telaah hukum dan opini hukum', 1, 1704189089, NULL),
('HK.110', 'Peraturan kepala BPS', 1, 1704189089, NULL),
('HK.200', 'KEPUTUSAN/KETETAPAN PIMPINAN LEMBAGA/INSTANSI Termasuk rancangan awal sampai dengan rancangan akhir dan telaah hukum', 1, 1704189089, NULL),
('HK.300', 'INSTRUKSI SURAT EDARAN Termasuk rancangan awal sampai dengan rancangan akhir dan telaah hukum', 1, 1704189089, NULL),
('HK.310', 'Istruksi/surat edaran kepala BPS', 1, 1704189089, NULL),
('HK.320', 'Instruksi/Surat edaran pejabat tinggi madya dan pejabat tinggi pratama', 1, 1704189089, NULL),
('HK.400', 'SURAT PERINTAH', 1, 1704189089, NULL),
('HK.410', 'Surat perintah kepala BPS', 1, 1704189089, NULL),
('HK.420', 'Surat perintah pejabat madya', 1, 1704189089, NULL),
('HK.430', 'Surat perintah pejabat pratama', 1, 1704189089, NULL),
('HK.500', 'PEDOMAN', 1, 1704189089, NULL),
('HK.600', 'NOTA KESEPAHAMAN', 1, 1704189089, NULL),
('HK.610', 'Dalam negeri', 1, 1704189089, NULL),
('HK.620', 'Luar negeri', 1, 1704189089, NULL),
('HK.700', 'DOKUMENTASI HUKUM', 1, 1704189089, NULL),
('HK.800', 'SOSIALISASI/PENYULUHAN/PEMBINAAN HUKUM', 1, 1704189089, NULL),
('HK.810', 'Berkas yang berhubungan dengan kegiatan sosialisasi atau penyuluhan hukum', 1, 1704189089, NULL),
('HK.820', 'Laporan hasil pelaksanaan sosialisasi penyukuhan hukum', 1, 1704189089, NULL),
('HK.900', 'BANTUAN KONSULTASI HUKUM/ADVOKASI', 1, 1704189089, NULL),
('HM', 'HUBUNGAN MASYARAKAT', 0, 1704189089, NULL),
('HM.000', 'KEPROTOKOLAN', 1, 1704189089, NULL),
('HM.010', 'Penyelenggarakan acara kedinasan (Upacara,pelantikan,peresmian dan jamuan termasuk acara peringatan hari-hari besar)', 1, 1704189089, NULL),
('HM.020', 'Agenda kegiatan pimpinan', 1, 1704189089, NULL),
('HM.030', 'Kunjungan Dinas', 1, 1704189089, NULL),
('HM.031', 'Kunjungan dinas dalam dan luar negeri', 1, 1704189089, NULL),
('HM.032', 'Kunjungan dinas pimpinan lembaga/instansi', 1, 1704189089, NULL),
('HM.033', 'Kunjungan dinas pejabat lembaga/instansi', 1, 1704189089, NULL),
('HM.040', 'Buku tamu', 1, 1704189089, NULL),
('HM.050', 'daftar nama/alamat kantor/pejabat', 1, 1704189089, NULL),
('HM.100', 'LIPUTAN MEDIA MASSA', 1, 1704189089, NULL),
('HM.200', 'PENYAJIAN INFORMASI KELEMBAGAAN', 1, 1704189089, NULL),
('HM.210', 'Kliping koran.', 1, 1704189089, NULL),
('HM.220', 'Penerbitan majalah,buletin,koran dan jurnal', 1, 1704189089, NULL),
('HM.230', 'Brosur/leaflet/poster/plakat', 1, 1704189089, NULL),
('HM.240', 'Pengumuman/pemberitaan', 1, 1704189089, NULL),
('HM.300', 'HUBUNGAN ANTAR LEMBAGA', 1, 1704189089, NULL),
('HM.310', 'Hubungan antar lembaga pemerintah', 1, 1704189089, NULL),
('HM.320', 'Hubungan dengan organisasi sosial/LSM', 1, 1704189089, NULL),
('HM.330', 'Hubungan dengan perusahaan', 1, 1704189089, NULL),
('HM.340', 'Hubungan dengan peguruan tinggi/sekolah : magang,pendidikan sistem ganga, praktek kerja lapangan (PKL)', 1, 1704189089, NULL),
('HM.350', 'Forum Kehumasan (Bakohumas/Perhumas)', 1, 1704189089, NULL),
('HM.360', 'Hubungan dengan media massa:', 1, 1704189089, NULL),
('HM.400', 'DENGAR PENDAPAT/HEARING DPR', 1, 1704189089, NULL),
('HM.500', 'PENYIAPAN BAHAN MATERI PIMPINAN', 1, 1704189089, NULL),
('HM.600', 'PUBLIKASI MELALUI MEDIA CETAK MAUPUN ELEKTRONIK', 1, 1704189089, NULL),
('HM.700', 'PAMERAN/SAYEMBARA/LOMBA/FESTIVAL,PEMBUATAN SPANDUK DAN IKLAN', 1, 1704189089, NULL),
('HM.800', 'PENGHARGAAN/KENANG-KENAGAN/CINDERA MATA', 1, 1704189089, NULL),
('HM.900', 'UCAPAN TERIMA KASIH,UCAPAN SELAMAT,BELA SUNGKAWA,PERMOHONAN MAAF', 1, 1704189089, NULL),
('IF', 'INFORMATIKA', 0, 1704189089, NULL),
('IF.000', 'RENCANA STRATEGIS MASTERPLAN PEMBANGUNAN SISTEM INFORMASI', 1, 1704189089, NULL),
('IF.100', 'DOKUMENTASI ARSITEKTUR', 1, 1704189089, NULL),
('IF.110', 'Sistem informasi', 1, 1704189089, NULL),
('IF.120', 'Sistem apliaksi', 1, 1704189089, NULL),
('IF.130', 'Infrastruktur', 1, 1704189089, NULL),
('IF.200', 'PEREKAMAN DAN PEMUTAKHIRAN DATA', 1, 1704189089, NULL),
('IF.210', 'Formulir isian', 1, 1704189089, NULL),
('IF.220', 'Daftar petugas perekaman', 1, 1704189089, NULL),
('IF.230', 'Jadwal pelaksanaan', 1, 1704189089, NULL),
('IF.240', 'Laporan hasil perekaman dan pemutakhiran data', 1, 1704189089, NULL),
('IF.300', 'MIGRASI SISTEM APLIAKSI DATA', 1, 1704189089, NULL),
('IF.400', 'DOKUMEN HOSTING', 1, 1704189089, NULL),
('IF.410', 'Formulir permintaan hosting', 1, 1704189089, NULL),
('IF.420', 'Layanan hasil uji kelayakan', 1, 1704189089, NULL),
('IF.430', 'Laporan pelaksanaan hosting', 1, 1704189089, NULL),
('IF.500', 'LAYANAN BACK-UP DATA DIGITAL', 1, 1704189089, NULL),
('KA', 'KEARSIPAN', 0, 1704189089, NULL),
('KA.000', 'PENCETAKAN', 1, 1704189089, NULL),
('KA.010', 'Penyiapan pembuatan buku kerja dan kalender BPS,', 1, 1704189089, NULL),
('KA.020', 'Penerimaan permintaan mencetak dan naskah yang akan dicetak', 1, 1704189089, NULL),
('KA.030', 'Menyusunan perencanaaan cetak', 1, 1704189089, NULL),
('KA.040', 'Pencetakan naskah,surat,dokumen secara digital dan risograph', 1, 1704189089, NULL),
('KA.100', 'PENGURUSAN SURAT', 1, 1704189089, NULL),
('KA.110', 'Surat masuk/surat keluar', 1, 1704189089, NULL),
('KA.120', 'Penggunaan aplikasi surat menyurat', 1, 1704189089, NULL),
('KA.200', 'PENGELOLAAN ARSIP DINAMIS', 1, 1704189089, NULL),
('KA.210', 'Penyusunan sisitem arsip', 1, 1704189089, NULL),
('KA.220', 'Penciptaan dan pemberkasan arsip', 1, 1704189089, NULL),
('KA.230', 'Pengelolahan data base menjadi informasi', 1, 1704189089, NULL),
('KA.240', 'Alih media', 1, 1704189089, NULL),
('KA.300', 'PENYIMPANGAN DAN PEMELIHARAAN ARSIP', 1, 1704189089, NULL),
('KA.310', 'Daftar arsip', 1, 1704189089, NULL),
('KA.320', 'Pemeliharan arsip dan ruang penyimpanan (seperti kegiatan fumigasi)', 1, 1704189089, NULL),
('KA.330', 'daftar pencarian arsip', 1, 1704189089, NULL),
('KA.340', 'daftar arsip informasi publik', 1, 1704189089, NULL),
('KA.350', 'Daftar arsip vital/aset', 1, 1704189089, NULL),
('KA.360', 'Layanan arsip (pemindahan,pengguna arsip)', 1, 1704189089, NULL),
('KA.370', 'Persetujuan jadwal retensi arsip', 1, 1704189089, NULL),
('KA.400', 'PEMINDAHAN ARSIP', 1, 1704189089, NULL),
('KA.410', 'Pemindahan Arsip Inaktif', 1, 1704189089, NULL),
('KA.420', 'Daftar Arsip yang Dimusnahkan', 1, 1704189089, NULL),
('KA.500', 'PEMUSNAHAN ARSIP YANG TIDAK BERNILAI GUNA', 1, 1704189089, NULL),
('KA.510', 'Berita Acara Pemusnahan', 1, 1704189089, NULL),
('KA.520', 'Daftar Arsip yang Dimusnahkan', 1, 1704189089, NULL),
('KA.530', 'Rekomendasi/Pertimbangan/Permusnahan Arsip dari ANRI', 1, 1704189089, NULL),
('KA.540', 'Surat Keputusan Pemusnahan', 1, 1704189089, NULL),
('KA.600', 'PENYERAHAN ARSIP STATIS', 1, 1704189089, NULL),
('KA.610', 'Berita Acara Serah Terima Arsip', 1, 1704189089, NULL),
('KA.620', 'Daftar Arsip yang Diserahkan', 1, 1704189089, NULL),
('KA.700', 'PEMBINAAN KEARSIPAN', 1, 1704189089, NULL),
('KA.710', 'Pembinaan Arsiparis', 1, 1704189089, NULL),
('KA.720', 'Aresiasi/Sosialisasi/Penyeluruhan Kearsipan,Diklat Profesi', 1, 1704189089, NULL),
('KA.730', 'Bimbingan Teknis', 1, 1704189089, NULL),
('KA.740', 'Penilaian dan sertifikasi SDM kearsipan', 1, 1704189089, NULL),
('KA.750', 'Supervisi dan Monitoring', 1, 1704189089, NULL),
('KA.760', 'penilaian Akreditasi Unit Kerja Kearsipan ', 1, 1704189089, NULL),
('KA.770', 'Implementasi Pengelolaan Arsip Elektronik', 1, 1704189089, NULL),
('KA.780', 'Penghargaan Kearsipan', 1, 1704189089, NULL),
('KA.790', 'Pengawasan Kearsipan', 1, 1704189089, NULL),
('KP', 'KEPEGAWAIAN', 0, 1704189089, NULL),
('KP.000', 'FORMASI PEGAWAI', 1, 1704189089, NULL),
('KP.010', 'Usulan dari Unit Kerja.', 1, 1704189089, NULL),
('KP.020', 'Usulan Permintaan Formasi kepada Menpan dan Kepala BKN.', 1, 1704189089, NULL),
('KP.030', 'Persetujuan Menpan', 1, 1704189089, NULL),
('KP.040', 'Penetapan Formasi', 1, 1704189089, NULL),
('KP.050', 'Penetapan Formasi Khusus.', 1, 1704189089, NULL),
('KP.100', 'PENGADAAN DAN PENGANGKATAN PEGAWAI', 1, 1704189089, NULL),
('KP.110', 'Proses Penerimaan Pegawai:', 1, 1704189089, NULL),
('KP.111', 'Pengumuman.', 1, 1704189089, NULL),
('KP.112', 'Seleksi Administrasi', 1, 1704189089, NULL),
('KP.113', 'Pemanggilan Peserta Tes', 1, 1704189089, NULL),
('KP.114', 'Pelaksanaa Ujian (tertulis, psikotes, wawancara).', 1, 1704189089, NULL),
('KP.115', 'Keputusan Hasil Ujian', 1, 1704189089, NULL),
('KP.120', 'Penetapan Pengumuman Kelulusan', 1, 1704189089, NULL),
('KP.130', 'Berkas Lamaran yang Tidak Diterima', 1, 1704189089, NULL),
('KP.140', 'Nota Usul dan Kelengkapan Penetapan NIP', 1, 1704189089, NULL),
('KP.150', 'Nota Usul Pengangkatan CPNS menjadi PNS.', 1, 1704189089, NULL),
('KP.160', 'Nota Usul Pengangkatan CPNS menjadi PNS lebih 2 Tahun', 1, 1704189089, NULL),
('KP.170', 'SK CPNS/PNS Kolektif', 1, 1704189089, NULL),
('KP.200', 'BERKAS PEGAWAI TIDAK TETAP/MITRA STATISTIK', 1, 1704189089, NULL),
('KP.300', 'PEMBINAAN KARIR PEGAWAI', 1, 1704189089, NULL),
('KP.310', 'Diklat Kursus/ Tugas Belajar/ Ujian Dinas/ Izin Belajar Pegawai:', 1, 1704189089, NULL),
('KP.311', 'Surat Perintah/ Surat Tugas/ SK/ Surat Izin.', 1, 1704189089, NULL),
('KP.312', 'Laporan Kegiatan Pengembangan Diri.', 1, 1704189089, NULL),
('KP.313', 'Surat Tanda Tamat Pendidikan dan Pelatihan.', 1, 1704189089, NULL),
('KP.320', 'Ujian Kompetensi', 1, 1704189089, NULL),
('KP.321', 'Assesment Tes Pegawai', 1, 1704189089, NULL),
('KP.322', 'Pemetaan/Mapping Talent Pegawai.', 1, 1704189089, NULL),
('KP.330', 'Daftar Penilaian Pelaksanaan Pekerjaan (DP3) dan Sasaran Kinerja Pegawai (SKP).', 1, 1704189089, NULL),
('KP.340', 'Pakta Integritas Pegawai', 1, 1704189089, NULL),
('KP.350', 'Laporan Hasil Kekayaan Penyelenggara Negara (LHKPN)', 1, 1704189089, NULL),
('KP.360', 'Daftar Usul Penetapan Angka Kredit Fungsional.', 1, 1704189089, NULL),
('KP.370', 'Disiplin Pegawai:', 1, 1704189089, NULL),
('KP.371', 'Daftar Hadir', 1, 1704189089, NULL),
('KP.372', 'Rekapitulasi Daftar Hadir', 1, 1704189089, NULL),
('KP.380', 'Berkas Hukum Disiplin.', 1, 1704189089, NULL),
('KP.390', 'Penghargaan dan Tanda Jasa (Satya Lencana/Bintang Jasa).', 1, 1704189089, NULL),
('KP.400', 'PENYELESAIAN PENGELOLAAN KEBERATAN PEGAWAI', 1, 1704189089, NULL),
('KP.500', 'MUTASI PEGAWAI', 1, 1704189089, NULL),
('KP.510', 'Alih Status, Pindah Instansi, Pindah Wilayah Kerja, Diperbantukan, Dipekerjakan, Penugasan Sementara, Mutasi Antar Perwakilan, Mutasi ke dan dari perwakilan Sementara, Mutasi antar Unit', 1, 1704189089, NULL),
('KP.520', 'Nota Persetujuan/Pertimbangan Kepala BKN', 1, 1704189089, NULL),
('KP.530', 'Mutasi Keluarga:', 1, 1704189089, NULL),
('KP.531', 'Surat Izin Pernikahan/Perceraian.', 1, 1704189089, NULL),
('KP.532', 'Surat Penolakan Izin Pernikahan/perceraian', 1, 1704189089, NULL),
('KP.533', 'Akte Nikah/Cerai', 1, 1704189089, NULL),
('KP.534', 'Surat Keterangan Meninggal Dunia', 1, 1704189089, NULL),
('KP.540', 'Usul Kenaikan Pangkat/Golongan/Jabatan.', 1, 1704189089, NULL),
('KP.550', 'Usul Pengangkatan dan Pemberhentian dalam Jabatan Struktural/Fungsional', 1, 1704189089, NULL),
('KP.560', 'Usul Penetapan Perubahan Data Dasar/Status/kedudukan Hukum pegawai', 1, 1704189089, NULL),
('KP.570', 'Peninjauan Masa Kerja', 1, 1704189089, NULL),
('KP.580', 'Berkas Baperjakat.', 1, 1704189089, NULL),
('KP.600', 'ADMINISTRASI PEGAWAI', 1, 1704189089, NULL),
('KP.610', 'Dokumentasi Identitas Pegawai:', 1, 1704189089, NULL),
('KP.611', 'Usul Penetapan Karpeg/KPE/Karis/Karsu.', 1, 1704189089, NULL),
('KP.612', 'Keanggotaan Organisasi Profesi/Kedinasan.', 1, 1704189089, NULL),
('KP.613', 'Laporan Pajak Penghasilan Pribadi (LP2P)', 1, 1704189089, NULL),
('KP.614', 'Keterangan Penerimaan Penghasilan Pegawai (KP4).', 1, 1704189089, NULL),
('KP.620', 'Berkas Kepegawaian dan Daftar Urut Kepangkatan (DUK)', 1, 1704189089, NULL),
('KP.630', 'Berkas Perorangan Pegawai Negeri Sipil:', 1, 1704189089, NULL),
('KP.640', 'Berkas Perseorangan Pejabat Negara', 1, 1704189089, NULL),
('KP.641', 'Kepala BPS;', 1, 1704189089, NULL),
('KP.642', 'Pejabat Negara Lain yang ditentukan oleh Undang-Undang;', 1, 1704189089, NULL),
('KP.650', 'Surat Perintah Dinas/Surat Tugas', 1, 1704189089, NULL),
('KP.660', 'Berkas Cuti Pegawai:', 1, 1704189089, NULL),
('KP.661', 'Cuti Sakit.', 1, 1704189089, NULL),
('KP.662', 'Cuti Bersalin.', 1, 1704189089, NULL),
('KP.663', 'Cuti Tahunan.', 1, 1704189089, NULL),
('KP.664', 'Cuti Alasan Penting.', 1, 1704189089, NULL),
('KP.665', 'Cuti Luar Tanggungan Negara (CLTN).', 1, 1704189089, NULL),
('KP.700', 'KESEJAHTERAAN PEGAWAI', 1, 1704189089, NULL),
('KP.710', 'Berkas Tentang Layanan Tunjangan/Gaji.', 1, 1704189089, NULL),
('KP.720', 'Berkas Tentang Pemeliharaan Kesehatan Pegawai.', 1, 1704189089, NULL),
('KP.730', 'Berkas Tentang Layanan Asuransi Pegawai.', 1, 1704189089, NULL),
('KP.740', 'Berkas Tentang Bantuan Sosial.', 1, 1704189089, NULL),
('KP.750', 'Berkas Tentang Layanan Olahraga Dan Rekreasi.', 1, 1704189089, NULL),
('KP.760', 'Berkas Tentang Layanan Pengurusan Jenazah.', 1, 1704189089, NULL),
('KP.770', 'Berkas Tentang Layanan Organisasi Non Kedinasan (Korpri, Dharma Wanita, Koperasi)', 1, 1704189089, NULL),
('KP.800', 'PEMBERHENTIAN PEGAWAI TANPA HAK PENSIUN', 1, 1704189089, NULL),
('KP.900', 'USUL PEMBERHENTIAN DAN PENETAPAN PENSIUN PEGAWAI/JANDA/DUDA & PNS YANG TEWAS', 1, 1704189089, NULL),
('KS', 'KONSOLIDASI DATA STATISTIK', 0, 1704189089, NULL),
('KS.000', 'KOMPILASI DATA', 1, 1704189089, NULL),
('KS.100', 'ANALISI DATA', 1, 1704189089, NULL),
('KS.200', 'PENYUSUNAN PUBLIKASI', 1, 1704189089, NULL),
('KU', 'KEUANGAN', 0, 1704189089, NULL),
('KU.000', 'PELAKSANAAN ANGGARAN', 1, 1704189089, NULL),
('KU.010', 'Ketentuan/Peraturan Menteri Keuangan Menyangkut Pelaksanaan dan Penatausahaan', 1, 1704189089, NULL),
('KU.100', 'REALISASI PENDAPATAN/PENERIMAAN NEGARA', 1, 1704189089, NULL),
('KU.110', 'Surat Setoran Pajak (SSP)', 1, 1704189089, NULL),
('KU.120', 'Surat Setoran Bukan Pajak (SSBP)', 1, 1704189089, NULL),
('KU.130', 'Bukti Penerimaan Bukan Pajak (PNBP)', 1, 1704189089, NULL),
('KU.140', 'Dana Bagi Hasil yang bersumber dari Pajak :', 1, 1704189089, NULL),
('KU.141', 'Pajak Bumi Bangunan', 1, 1704189089, NULL),
('KU.142', 'Bea Perolehan Hak Atas Tanah dan Bangunan (BPHTB)', 1, 1704189089, NULL),
('KU.143', 'Pajak Penghasilan (Pph) Pasal 21, 25 dan 29', 1, 1704189089, NULL),
('KU.150', 'Bukti Setor Sisa Anggaran Lebih atau Bukti Setor Pengembalian Belanja (SSPB)', 1, 1704189089, NULL),
('KU.160', 'Bunga dan atau Jasa Giro pada Bank', 1, 1704189089, NULL),
('KU.170', 'Piutang Negara', 1, 1704189089, NULL),
('KU.180', 'Pengelolaan Investasi dan Penyertaan Modal', 1, 1704189089, NULL),
('KU.200', 'PENGELOLAAN PERBENDAHARAAN', 1, 1704189089, NULL),
('KU.210', 'Pejabat Penguji dan Penandatanganan SPM', 1, 1704189089, NULL),
('KU.220', 'Bendahara Penerimaan', 1, 1704189089, NULL),
('KU.230', 'Bendahara Pengeluaran', 1, 1704189089, NULL),
('KU.240', 'Kartu Pengawasan Pembayaran Penghasilan Pegawai (PK4)', 1, 1704189089, NULL),
('KU.250', 'Pengembalian Belanja', 1, 1704189089, NULL),
('KU.260', 'Pembukuan Anggaran :', 1, 1704189089, NULL),
('KU.261', 'Buku Kas Umum (BKU)', 1, 1704189089, NULL),
('KU.262', 'Buku Kas Pembantu', 1, 1704189089, NULL),
('KU.263', 'Kartu Realisasi Anggaran dan Pengawasan Realisasi Anggaran', 1, 1704189089, NULL),
('KU.270', 'Berita Acara Pemeriksaan Kas', 1, 1704189089, NULL),
('KU.280', 'Datar Gaji/Kartu Gaji', 1, 1704189089, NULL),
('KU.300', 'PENGELUARAN ANGGARAN Naskah - naskah yang berkaitan dengan pelaksanaan anggaran pengeluaran mulai dari SPP-GU, SPP-LS, SPP-UP, SPP-UP, SPP-TUP, SPM, SP2D, Juklak mekanisme pengelolaan APB serta bahan nota keuangan', 1, 1704189089, NULL),
('KU.310', 'Belanja Bahan', 1, 1704189089, NULL),
('KU.320', 'Belanja Barang', 1, 1704189089, NULL),
('KU.330', 'Belanja Jasa (Konsultasi, Profesi)', 1, 1704189089, NULL),
('KU.340', 'Belanja Perjalanan', 1, 1704189089, NULL),
('KU.350', 'Belanja Pegawai', 1, 1704189089, NULL),
('KU.360', 'Belanja Paket Meeting Dalam Kota', 1, 1704189089, NULL),
('KU.370', 'Belanja Paket Meeting Luar Kota', 1, 1704189089, NULL),
('KU.380', 'Belanja Akun Kombinasi', 1, 1704189089, NULL),
('KU.400', 'VERIFIKASI ANGGARAN', 1, 1704189089, NULL),
('KU.410', 'Surat Permintaan Pembayaran (SPP) beserta lampirannya', 1, 1704189089, NULL),
('KU.420', 'Surat Perintah Membayar (SPM), Surat perintah Pencairan dana (SP2D)', 1, 1704189089, NULL),
('KU.500', 'PELAPORAN', 1, 1704189089, NULL),
('KU.510', 'Akuntansi Keuangan:', 1, 1704189089, NULL),
('KU.511', 'Berita Acara Pemeriksaan Kas', 1, 1704189089, NULL),
('KU.512', 'Kas/Registrasi Penutupan Kas', 1, 1704189089, NULL),
('KU.513', 'Laporan Pendapatan Negara', 1, 1704189089, NULL),
('KU.514', 'Arsip Data Komputer (ADK)', 1, 1704189089, NULL),
('KU.520', 'Pengumpulan, Pemantauan, Evaluasi dan laporan Keuangan:', 1, 1704189089, NULL),
('KU.521', 'Keadaan Kredit Anggaran (LKKA) Bulanan/ Triwulan/Semesteran ', 1, 1704189089, NULL),
('KU.530', 'Rekonsiliasi Data Laporan Keuangan', 1, 1704189089, NULL),
('KU.600', 'BANTUAN PINJAMAN LUAR NEGERI', 1, 1704189089, NULL),
('KU.610', 'Permohonan Pinjaman Luar Negeri (Blue Book)', 1, 1704189089, NULL),
('KU.620', 'Dokumen Kesanggupan negara donor (Gray Book)', 1, 1704189089, NULL),
('KU.630', 'Memorandum of Understand (MOU) dan dokumen sejenisnya', 1, 1704189089, NULL),
('KU.640', 'Loan Agreement  Pinjaman/Hibah Luar Negeri (PHLN), legal opinion, surat-menyuratnya dengan lender, konsultan.', 1, 1704189089, NULL),
('KU.650', 'Alokasi dan Relokasi Penggunaan Dana Pinjaman/Hibah Luar Negeri', 1, 1704189089, NULL),
('KU.660', 'Penarikan Dana Bantuan Luar Negeri (BLN) ', 1, 1704189089, NULL),
('KU.661', 'Aplikasi Penarikan Dana Bantuan Luar Negeri (BLN) berikut lampirannya', 1, 1704189089, NULL),
('KU.662', 'Otorisasi Penarikan Dana (Payment Advice)', 1, 1704189089, NULL),
('KU.663', 'Replenisment (permintaan penarikan dana dari negara donor) meliputi:', 1, 1704189089, NULL),
('KU.670', 'Realisasi Pencairan Dana Bantuan Luar Negeri:', 1, 1704189089, NULL),
('KU.680', 'Ketentuan/Peraturan yang Menyangkut Bantuan/Pinjaman Luar Negeri', 1, 1704189089, NULL),
('KU.690', 'Laporan-laporan Pelaksanaan Bantuan/Pinjaman Luar Negeri.', 1, 1704189089, NULL),
('KU.691', 'Staff Appraisal Report.', 1, 1704189089, NULL),
('KU.692', 'Report/Laporan yang terdiri dari:', 1, 1704189089, NULL),
('KU.693', 'Laporan Hutang Negara:', 1, 1704189089, NULL),
('KU.694', 'Completion Report/Annual Report', 1, 1704189089, NULL),
('KU.700', 'PENGELOLA APBN/DANA PINJAMAN/HIBAH LUAR NEGERI (PHLN)', 1, 1704189089, NULL),
('KU.710', 'Keputusan Kepala BPS tentang Penetapan:', 1, 1704189089, NULL),
('KU.711', 'Kuasa Pengguna Anggaran (KPA), pejabat Pembuat Komitmen (PKK);', 1, 1704189089, NULL),
('KU.712', 'Pejabat Pembuatan Daftar Gaji;', 1, 1704189089, NULL),
('KU.713', 'Penandatangan SPM;', 1, 1704189089, NULL),
('KU.714', 'Bendahara Penerimaan/Pengeluaran, Pengelola Barang.', 1, 1704189089, NULL),
('KU.800', 'SISTEM AKUNTANSI INSTANSI (SAI)', 1, 1704189089, NULL),
('KU.810', 'Manual Implementasi Sistem Akuntansi Instansi (SAI)', 1, 1704189089, NULL),
('KU.820', 'Arsip Data Komputer dan Berita Acara Rekonsiliasi', 1, 1704189089, NULL),
('KU.830', 'a. Daftar Transaksi (DT), Pengeluaran (PK), Penerimaan (PN).', 1, 1704189089, NULL),
('KU.840', 'Listing (Daftar Rekaman Penerimaan) Buku Temuan dan Tindakan Lain (SAI)', 1, 1704189089, NULL),
('KU.850', 'Laporan Realisasi Bulanan SAI', 1, 1704189089, NULL),
('KU.860', 'Laporan Realisasi Triwulanan SAI dari Unit Akuntansi Wilayah (UAW) dan Gabungan semua UAW/Unit Akuntansi Kantor Pusat Instansi (UAKPI)', 1, 1704189089, NULL),
('KU.900', 'PERTANGGUNGJAWABAN KEUANGAN NEGARA', 1, 1704189089, NULL),
('KU.910', 'Laporan Hasil Pemeriksaan atas Laporan Keuangan oleh BPK RI.', 1, 1704189089, NULL),
('KU.920', 'Hasil Pengawasan dan Pemeriksaan Internal.', 1, 1704189089, NULL),
('KU.930', 'Laporan Aparat Pemeriksa Fungsional', 1, 1704189089, NULL),
('KU.931', 'Laporan Hasil Pemeriksaan  (LHP). ', 1, 1704189089, NULL),
('KU.932', ' Memorandum Hasil Pemeriksaan (MHP).', 1, 1704189089, NULL),
('KU.933', ' Tindak Lanjut/Tanggapan LHP.', 1, 1704189089, NULL),
('KU.940', 'Dokumentasi Penyelesaian Keuangan Negara:', 1, 1704189089, NULL),
('KU.941', ' Tuntutan Perbendaharaan', 1, 1704189089, NULL),
('KU.942', ' Tuntutan Ganti Rugi', 1, 1704189089, NULL),
('OT', 'ORGANISASI DAN TATA LAKSANA', 0, 1704189089, NULL),
('OT .000', 'ORGANISASI', 1, 1704189089, NULL),
('OT .010', 'Pembentukan organisasi', 1, 1704189089, NULL),
('OT .020', 'Pengubahan organisasi', 1, 1704189089, NULL),
('OT .030', 'Pembubaran organisasi', 1, 1704189089, NULL),
('OT .040', 'Evaluasi kelembagaan meliputi naskah-naskah yang berkaitan dengan penilaian dan penyempurnaan organisasi', 1, 1704189089, NULL),
('OT .050', 'Uraian Jabatan : Meliputi hal-hal yang berkenaan dengan masalah klasifikasi kepegawaian/pekerjaan,penelitian,jabatan dan analisa jabatan', 1, 1704189089, NULL),
('OT .100', 'TATA LAKSANA', 1, 1704189089, NULL),
('OT .110', 'Standar kompetensi Jabatan Struktual dan fungsional. Meliputi hal-hal yang berkenaan dengan standar kompetensi jabatan struktual dan jabatan fungsional', 1, 1704189089, NULL),
('OT .120', 'Tata Hubungan Kerja : Meliputi hal-hal berkenaan dengan masalah penyusunan tata hubungan kerja baik intern maupun ekstern BPS', 1, 1704189089, NULL),
('OT .130', 'Sistem dan Prosedur : Meliputi hal-hal berkenaan dengan masalah penelahan tata cara dan metode kegiatan dibidang perstatistikan', 1, 1704189089, NULL),
('PK', 'KEPUTUSAN', 0, 1704189089, NULL),
('PK.000', 'PENYIMPANAN DEPOSIT BAHAN PUSTAKA', 1, 1704189089, NULL),
('PK.010', 'Bukti penerimaan koleksi bahan pustaka deposit', 1, 1704189089, NULL),
('PK.020', 'Administrasi pengelohan deposit bahan pustaka', 1, 1704189089, NULL),
('PK.100', 'PENGADAAN BAHAN PUSTAKA', 1, 1704189089, NULL),
('PK.110', 'Buku induk koleksi', 1, 1704189089, NULL),
('PK.120', 'daftar buku terseleksi', 1, 1704189089, NULL),
('PK.130', 'daftar buku dalam pemesanan', 1, 1704189089, NULL),
('PK.140', 'Daftar buku dalam permintaan', 1, 1704189089, NULL),
('PK.200', 'PENGOLAHAN BAHAN PUSTAKA', 1, 1704189089, NULL),
('PK.210', 'Lembar kerja pengelohan bahan pustaka (buram pengkatalogan)', 1, 1704189089, NULL),
('PK.220', 'Shell list/jajaran kartu utama (master list)', 1, 1704189089, NULL),
('PK.230', 'Daftar tambahan buku (assesion list)', 1, 1704189089, NULL),
('PK.240', 'Daftar/jajaran kemdali (subjek dan pengarang)', 1, 1704189089, NULL),
('PK.300', 'LAYANAN JASA PERPUSTAKAAN DAN INFORMASI', 1, 1704189089, NULL),
('PK.310', 'Data dan statistik anggota, pengunjung dan peminjaman bahan pustaka', 1, 1704189089, NULL),
('PK.320', 'Pertanyaan,rujukan dan jawaban', 1, 1704189089, NULL),
('PK.400', 'PRESERVASI BAHAN PUSTAKA', 1, 1704189089, NULL),
('PK.410', 'Survei kondisi bahan pustaka', 1, 1704189089, NULL),
('PK.420', 'Reprografi bahan pustaka', 1, 1704189089, NULL),
('PK.500', 'PEMBINAAN PERPUSTAKAAN', 1, 1704189089, NULL),
('PK.510', 'Bimbingan teknis', 1, 1704189089, NULL),
('PK.520', 'Penyuluhan', 1, 1704189089, NULL),
('PK.530', 'Sosialisasi', 1, 1704189089, NULL),
('PL', 'PERLENGKAPAN', 0, 1704189089, NULL),
('PL.000', 'Rencana Kebutuhan Barang dan Jasa', 1, 1704189089, NULL),
('PL.010', 'Usulan Unit Kerja', 1, 1704189089, NULL),
('PL.020', 'Rencana Kebutuhan Lembaga Pusat/Daerah', 1, 1704189089, NULL),
('PL.021', 'Daftar Opname Fisik Barang Inventaris(DOFBI)', 1, 1704189089, NULL),
('PL.022', 'Daftar Inventaris Barang(DIB)', 1, 1704189089, NULL),
('PL.023', 'Daftar Kartu Inventaris Barang', 1, 1704189089, NULL),
('PL.024', 'Buku Inventaris/pembantu Inventaris Barang', 1, 1704189089, NULL),
('PL.100', 'Berkas Perkenalan', 1, 1704189089, NULL),
('PL.200', 'Pengadaan Barang', 1, 1704189089, NULL),
('PL.210', 'Pengadaan/pembelian barang tidak melalui lelang(pengadaan langsung) Usulan Unit Kerja,Proses pengadaan barang,Serah terima barang', 1, 1704189089, NULL),
('PL.220', 'Pengadaan/pembelian barang melalui lelang', 1, 1704189089, NULL),
('PL.230', 'Perolehan barang melalui bantuan/hibah', 1, 1704189089, NULL),
('PL.240', 'Pengadaan barang melalui tukar menukar', 1, 1704189089, NULL),
('PL.250', 'Pemanfaatan barang melalui pinjam pakai', 1, 1704189089, NULL),
('PL.260', 'Pemanfaatan barang melalui sewa', 1, 1704189089, NULL),
('PL.270', 'Pemanfaatan barang melalui kerjasama pemanfaatan', 1, 1704189089, NULL),
('PL.280', 'Pemanfaatan barang melalui bangun serah guna/bangun serah guna', 1, 1704189089, NULL),
('PL.300', 'Pengadaan Jasa  Berkas pengadaan jasa oleh pihak ketiga terdiri dari berkas penawaran sampai dengan kontrak perjanjian', 1, 1704189089, NULL),
('PL.400', 'Laporan kemajuan pelaksanaan belanja modal', 1, 1704189089, NULL),
('PL.500', 'INVENTARISASI', 1, 1704189089, NULL),
('PL.510', 'Inventarisasi Ruangan/Gedung/Bangunan', 1, 1704189089, NULL),
('PL.530', 'Penyusunan Laporan Tahunan Inventaris BMN', 1, 1704189089, NULL),
('PL.540', 'Sensus BMN', 1, 1704189089, NULL),
('PL.600', 'PENYIMPANAN', 1, 1704189089, NULL),
('PL.610', 'Penatausahaan Penyimpanan Barng/Publikasi :', 1, 1704189089, NULL),
('PL.611', 'Tanda terima/surat pengantar/surat pengiriman barang', 1, 1704189089, NULL),
('PL.612', 'Surat pernyataan harga  dan mutu barang', 1, 1704189089, NULL),
('PL.613', 'Berita acara serah terima barang hasil pengadaan', 1, 1704189089, NULL),
('PL.614', 'Buku penerimaan', 1, 1704189089, NULL),
('PL.615', 'Buku persediaan barang/kartu stock barang', 1, 1704189089, NULL),
('PL.616', 'Kartu barang/kartu gudang', 1, 1704189089, NULL),
('PL.620', 'Penyusunan laporan persediaan barang', 1, 1704189089, NULL),
('PL.700', 'PENYALURAN', 1, 1704189089, NULL),
('PL.710', 'Penatausahaan penyaluran barang/publikasi', 1, 1704189089, NULL),
('PL.711', 'Surat permintaan dari unit kerja/formulir permintaan', 1, 1704189089, NULL),
('PL.712', 'Surat perintah mengeluarkan barang (SPMB)', 1, 1704189089, NULL),
('PL.713', 'Surat perintah mengeluarkan barang inventaris', 1, 1704189089, NULL),
('PL.714', 'Berita acara serah terima distribusi barang', 1, 1704189089, NULL),
('PL.800', 'PENGHAPUSAN BMN', 1, 1704189089, NULL),
('PL.810', 'Penghapusan barang bergerak/barang inventaris kantor ', 1, 1704189089, NULL),
('PL.900', 'BUKTI-BUKTI KEPEMILIKAN DAN KELENGKAPAN BMN', 1, 1704189089, NULL),
('PR', 'PERENCANAAN', 0, 1704189089, NULL),
('PR.000', 'POKOK-POKOK KEBIJAKAN DAN STRATEGI PEMBANGUNAN', 1, 1704189089, NULL),
('PR.010', 'Pengumpulan Data.', 1, 1704189089, NULL),
('PR.020', 'Rencana Pembangunan Jangka Panjang (RPJP).', 1, 1704189089, NULL),
('PR.030', 'Rencana Pembangunan Jangka Panjang (RPJP).', 1, 1704189089, NULL),
('PR.040', 'Rencana Kerja Pemerintah(RKP).', 1, 1704189089, NULL),
('PR.050', 'Penyelenggaraan Musyawarah Perencanaan Pembangunan(Musrenbang)', 1, 1704189089, NULL),
('PR.100', 'PENYUSUNAN RENCANA', 1, 1704189089, NULL),
('PR.110', 'Rencana Kegiatan Teknis', 1, 1704189089, NULL),
('PR.120', 'Rencana Kegiatan Non-Teknis', 1, 1704189089, NULL),
('PR.130', 'Keterpaduan Rencana Teknis dan Non Teknis', 1, 1704189089, NULL),
('PR.200', 'PROGRAM KERJA TAHUNAN', 1, 1704189089, NULL),
('PR.210', 'Usulan Unit Kerja beserta data penduduknya', 1, 1704189089, NULL),
('PR.220', 'Program Kerja Thunan Unit Kerja', 1, 1704189089, NULL),
('PR.230', 'Program Kerja Tahunan Instansi/Lembaga', 1, 1704189089, NULL),
('PR.300', 'RENCANA ANGGARAN PENDAPATAN DAN BELANJA NEGARA (RAPBN)', 1, 1704189089, NULL),
('PR.310', 'Penyusunan RAPBN', 1, 1704189089, NULL),
('PR.311', 'Arah kebijakan umum, strategi, prioritas, dan renstra:', 1, 1704189089, NULL),
('PR.312', 'Rencana kerja dan anggaran kementrian lembaga (RKAKL)', 1, 1704189089, NULL),
('PR.313', 'Lembaga satuan anggaran per satuan kerja (SAPSKI), satuan rincian alokasi anggaran', 1, 1704189089, NULL),
('PR.320', 'Penyampaian APBN kepada DPR RI', 1, 1704189089, NULL),
('PR.321', 'Nota keuangan pemerintah dan rancangan Undang-Undang RAPBN:', 1, 1704189089, NULL),
('PR.322', 'Pembahasan RAPBN oleh komisi DPR RI', 1, 1704189089, NULL),
('PR.323', 'Risalah rapat dengar pendapat dengan DPR RI', 1, 1704189089, NULL),
('PR.324', 'Nota jawaban DPR RI', 1, 1704189089, NULL),
('PR.330', 'Undang-Undang anggaranpendapatan dan belanja negara (APBN) dan rencana pembangunan tahunan (REPETA)', 1, 1704189089, NULL),
('PR.400', 'PENYUSUNAN ANGGARN PENDAPATAN NEGARA (APBN)', 1, 1704189089, NULL),
('PR.410', 'Ketetapan pagu indikatif/pagu sementara', 1, 1704189089, NULL),
('PR.420', 'ketetapan pagu definitif', 1, 1704189089, NULL),
('PR.430', 'Rencana kerja anggaran (RKA) lembaga negara dan badan pemerintah (LNBP)', 1, 1704189089, NULL),
('PR.440', 'Daftar isian pelaksanaan anggaran (DIPA) dan revisinya', 1, 1704189089, NULL),
('PR.450', 'Petunjuk operasional kegiatan (POK) dan revisinya', 1, 1704189089, NULL),
('PR.460', 'Petunjuk teknis tata laksana keterpaduan kegiatan dan pengelolaan anggaran', 1, 1704189089, NULL),
('PR.470', 'Target penerimaan negara bukan pajak', 1, 1704189089, NULL),
('PR.500', 'PENYUSUNAN STANDAR HARGA MONITORING PROGRAM', 1, 1704189089, NULL),
('PR.510', 'Pedoman pengumpulan dan pengolahan data standar harga', 1, 1704189089, NULL),
('PR.520', 'Pedoman teknis monitoring program dan kegiatan', 1, 1704189089, NULL),
('PR.530', 'Pedoman teknis evaluasi dan pelaporan program', 1, 1704189089, NULL),
('PR.600', 'LAPORAN', 1, 1704189089, NULL),
('PR.610', 'Laporan khusus', 1, 1704189089, NULL),
('PR.611', 'Pemantau prioritas', 1, 1704189089, NULL),
('PR.612', 'Laporan pelaksanaan kegiatan atas permintaan eksternal', 1, 1704189089, NULL),
('PR.613', 'Laporan atas pelaksanaan kegiatan/program tertentu', 1, 1704189089, NULL),
('PR.614', 'Rapat dengar pendapat dengan DPR RI', 1, 1704189089, NULL),
('PR.620', 'Laporan progress report', 1, 1704189089, NULL),
('PR.630', 'Laporan akuntabilitas kinerja instansi pemerintah (LAKIP)', 1, 1704189089, NULL),
('PR.640', 'Laporan berkala (harian,mingguan,triwulanan,semesteran,tahunan)', 1, 1704189089, NULL),
('PR.700', 'EVALUASI PROGRAM', 1, 1704189089, NULL),
('PR.710', 'Evaluasi program unit kerja', 1, 1704189089, NULL),
('PR.720', 'Evaluasi program lembaga/instansi', 1, 1704189089, NULL),
('PS', 'PERUMUSAN KEBIJAKAN DI BIDANG STATISTIK MELIPUTI : METODOLOGI DAN INFORMASI STATISTIK, STATISTIK SOSIAL, STATISTIK PRODUKSI, STATISTIK DISTRIBUSI DAN JASA, NERACA DAN ANALISA STATISTIK', 0, 1704189089, NULL),
('PS.000', 'Pengkajian dan Pengusulan Kebijakan', 1, 1704189089, NULL),
('PS.100', 'Penyiapan Kebijakan', 1, 1704189089, NULL),
('PS.200', 'Masukan dan Dukungan dalam Penyusunan Kebijakan', 1, 1704189089, NULL),
('PS.300', 'Pengembangan desain dan standardisasi', 1, 1704189089, NULL),
('PS.400', 'Penetapan Norma, Standar, Prosedur dan Kriteria (NSPK)', 1, 1704189089, NULL),
('PW', 'PENGAWASAN', 0, 1704189089, NULL),
('PW.000', 'RENCANA PENGAWASAN', 1, 1704189089, NULL),
('PW.010', 'Rencana strategis pengawasan', 1, 1704189089, NULL),
('PW.020', 'Rencana kerja tahunan', 1, 1704189089, NULL),
('PW.030', 'Rencana kinerja tahunan', 1, 1704189089, NULL),
('PW.040', 'Penetepan kinerja tahunan', 1, 1704189089, NULL),
('PW.050', 'Rakor pengawasan tingkat nasional', 1, 1704189089, NULL),
('PW.100', 'PELAKSANAAN PENGAWASAN', 1, 1704189089, NULL),
('PW.110', 'Naskah-naskah yang berkaitan dengan audit mulai dari surat penugasan sampai dengan surat menyurat', 1, 1704189089, NULL),
('PW.120', 'Laporan hasil audit (LHA),laporan hasil pemeriksaan operasional(LHPO),Laporan hasil evaluasi(LHE),Laporan akuntan (LA), laporan auditor indendent (LAI) yang memerlukan tindak lanjut (TL)', 1, 1704189089, NULL),
('PW.130', 'Laporan hasil audit investigasi (LHAI), Laporan hasil pemeriksaan operasionnal(LHPO), laporan hasil evaluasi (LHE), laporan akuntan (LA),Laporan auditor independent (LAI) yang memerlukan tindak lanjut (TL)', 1, 1704189089, NULL),
('PW.140', 'Laporan perkembangan penanganan surat pengaduan masyarakat', 1, 1704189089, NULL),
('PW.150', 'Laporan pemutakhitsn data', 1, 1704189089, NULL),
('PW.160', 'Laporan perkembangan BMN', 1, 1704189089, NULL),
('PW.170', 'Laporan kegiatan pendampingan penyusunan laporan keuangan dan reviu departmen/LPND', 1, 1704189089, NULL),
('PW.180', 'Good corporate governance (GCG)', 1, 1704189089, NULL),
('RT', 'KERUMAHTANGGAAN', 0, 1704189089, NULL),
('RT.000', 'TELEKOMUNIKASI', 1, 1704189089, NULL),
('RT.100', 'ADMINISTRASI PENGGUNAAN FASILITAS KANTOR', 1, 1704189089, NULL),
('RT.200', 'PENGURUSAN KENDARAAN DINAS', 1, 1704189089, NULL),
('RT.210', 'Pengurusan Surat kendaraan Dinas', 1, 1704189089, NULL),
('RT.220', 'Pemeliharaan dan Perbaikan', 1, 1704189089, NULL),
('RT.230', 'Pengurusan Kehilangan dan Masalah Kendaraan', 1, 1704189089, NULL),
('RT.300', 'PEMELIHARAAN GEDUNG DAN TAMAN', 1, 1704189089, NULL),
('RT.310', 'Pertamanan/Lanscaping', 1, 1704189089, NULL),
('RT.320', 'Penghijauan', 1, 1704189089, NULL),
('RT.330', 'Perbaiki Gedung', 1, 1704189089, NULL),
('RT.340', 'Perbaiki Rumah Dinas/Wisma', 1, 1704189089, NULL),
('RT.350', 'Kebersihan Gedung dan Taman', 1, 1704189089, NULL),
('RT.400', 'PENGELOLAAN JARINGAN LISTRIK,AIR,TELEPON,DAN KOMPUTER', 1, 1704189089, NULL),
('RT.410', 'Perbaikan/Pemeliharaan', 1, 1704189089, NULL),
('RT.420', 'Pemasangan', 1, 1704189089, NULL),
('RT.500', 'KETERTIBAN DAN KEAMANAN', 1, 1704189089, NULL),
('RT.510', 'Pengamanan,penjagaan dan pengawasan terhadap pejabat,kantor,dan rumah dinas:', 1, 1704189089, NULL),
('RT.511', 'Daftar Nama Satuan Pengamanan', 1, 1704189089, NULL),
('RT.512', 'Daftar Jaga/Daftar Piket', 1, 1704189089, NULL),
('RT.513', 'Surat Ijin Keluar Masuk Orang atau Barang', 1, 1704189089, NULL),
('RT.520', 'Laporan Ketertiban dan Keamanan', 1, 1704189089, NULL),
('RT.521', 'Kehilangan,kerusakan,kecelakaan,gangguan', 1, 1704189089, NULL),
('RT.600', 'ADMINISTRASI PENGELOLAAN PARKIR', 1, 1704189089, NULL),
('SS', 'SENSUS PENDUDUK, SENSUS PERTANIAN DAN SENSUS EKONOMI', 0, 1704189089, NULL),
('SS.000', 'PERENCANAAN', 1, 1704189089, NULL),
('SS.010', 'Master Plan dan Network Planing', 1, 1704189089, NULL),
('SS.020', 'Perumusan dan Penyusunan Bahan', 1, 1704189089, NULL),
('SS.021', 'Penyiapan bahan penyususnan rancangan sensus', 1, 1704189089, NULL),
('SS.022', 'Penyusunan metode pencacahan sensus', 1, 1704189089, NULL),
('SS.023', 'Penentuan volume sensus', 1, 1704189089, NULL),
('SS.024', 'Penyusunan desain penarikan sampel', 1, 1704189089, NULL),
('SS.025', 'penyusunan kerangka sampel', 1, 1704189089, NULL),
('SS.030', 'Studi Pendahuluan', 1, 1704189089, NULL),
('SS.100', 'PERSIAPAN SENSUS', 1, 1704189089, NULL),
('SS.110', 'Rancangan Organisasi', 1, 1704189089, NULL),
('SS.120', 'Penyusunan Kuesioner', 1, 1704189089, NULL),
('SS.130', 'Penyusunan Konsep dan Definisi', 1, 1704189089, NULL),
('SS.140', 'Penyusunan Metodologi (organisasi, lapangan, ukuran statistik)', 1, 1704189089, NULL),
('SS.150', 'Penyusunan Buku Pedoman (pencacahan, pengawasan, pengolahan)', 1, 1704189089, NULL),
('SS.160', 'Penyusunan Peta Wilayah Kerja dan Muatan Peta Wilayah', 1, 1704189089, NULL),
('SS.170', 'Penyusunan Pedoman Sosialisasi', 1, 1704189089, NULL),
('SS.180', 'Penyusunan Program Pengolahan (rule validasi pemeriksaan entri tabulasi)', 1, 1704189089, NULL),
('SS.190', 'Koordinasi Intern/Ekstrn', 1, 1704189089, NULL),
('SS.200', 'PELATIHAN/UJICOBA', 1, 1704189089, NULL),
('SS.210', 'Pelatihan Instruktur', 1, 1704189089, NULL),
('SS.220', 'Pelatihan Petugas', 1, 1704189089, NULL),
('SS.230', 'Pelatihan Petugas Pengolahan', 1, 1704189089, NULL),
('SS.240', 'Perancangan Tabel', 1, 1704189089, NULL),
('SS.250', 'Pelaksanaan Ujicoba Kuesioner Sensus (meliputi reliabititas kuesioner dan sistem pengolahan)', 1, 1704189089, NULL),
('SS.260', 'Pelaksanaan Ujicoba Kuesioner Metodologi Sensus (meliputi ujicoba pelaksanaan pencacahan, organisasi dan jumlah sempel)', 1, 1704189089, NULL),
('SS.300', 'PELAKSANAAN LAPANGAN', 1, 1704189089, NULL),
('SS.310', 'Listing', 1, 1704189089, NULL),
('SS.320', 'Pemilihan Sampel', 1, 1704189089, NULL),
('SS.330', 'Pengumpulan Data', 1, 1704189089, NULL),
('SS.340', 'Pemeriksaan Data', 1, 1704189089, NULL),
('SS.350', 'Pengawasan Lapangan', 1, 1704189089, NULL),
('SS.360', 'Monitoring Kualitas', 1, 1704189089, NULL),
('SS.400', 'PENGOLAHAN', 1, 1704189089, NULL),
('SS.410', 'Pengelolaan Dokumen (penerimaan/pengiriman, pengelompokan/batching)', 1, 1704189089, NULL),
('SS.420', 'Pemeriksaan Dokumen dan Pengkodean(editing/coding)', 1, 1704189089, NULL),
('SS.430', 'Perekam Data (entri/scanner)', 1, 1704189089, NULL),
('SS.440', 'Tabulasi Data', 1, 1704189089, NULL),
('SS.450', 'Pemeriksaan Tabulasi', 1, 1704189089, NULL),
('SS.460', 'Laporan Konsistensi Tabulasi', 1, 1704189089, NULL),
('SS.500', 'ANALISIS DAN PENYAJIAN HASIL SENSUS', 1, 1704189089, NULL),
('SS.510', 'Pembahasan Angka Hasil Pengolahan', 1, 1704189089, NULL),
('SS.520', 'Penyusunan Angka Sementara', 1, 1704189089, NULL),
('SS.530', 'Penyusunan Angka Tetap', 1, 1704189089, NULL),
('SS.540', 'Penyusunan/Pembahasan Draft Publikasi', 1, 1704189089, NULL),
('SS.550', 'Analisis Data Sensus', 1, 1704189089, NULL),
('SS.560', 'Penyusunan Diseminasi Hasil Sensus', 1, 1704189089, NULL),
('SS.600', 'DISEMINASI HASIL SENSUS', 1, 1704189089, NULL),
('SS.610', 'Penyusunan Bahan Diseminasi', 1, 1704189089, NULL),
('SS.620', 'Sosialisasi hasil Sensus melalui berbagai media', 1, 1704189089, NULL),
('SS.630', 'Layanan Promosi Statistik', 1, 1704189089, NULL),
('TS', 'TRANSFORMASI STATISTIK', 0, 1704189089, NULL),
('TS.000', 'PENYUSUNAN RENCANA KEGIATAN BIDANG TRANSFORMASI STATISTIK (TOR)', 1, 1704189089, NULL),
('TS.010', 'Transformasi proses bisnis statistik', 1, 1704189089, NULL),
('TS.020', 'Transformasi TIK dan Komunikasi', 1, 1704189089, NULL),
('TS.030', 'Transformasi manajemen sumberdaya manusia dan kelembagaan', 1, 1704189089, NULL),
('TS.100', 'PENYUSUNAN BAHAN TERKAIT TRANSFORMASI STATISTIK', 1, 1704189089, NULL),
('TS.110', 'Rencana Sarana dan Prasarana Transformasi Statistik', 1, 1704189089, NULL),
('TS.120', 'Statistical Business Frame Work and Architecture (SBFA)', 1, 1704189089, NULL),
('TS.130', 'Analysis Document', 1, 1704189089, NULL),
('TS.140', 'CSI', 1, 1704189089, NULL),
('TS.150', 'BPR', 1, 1704189089, NULL),
('TS.160', 'Sosialisasi, internalisasi, workshop terkait kegiatan transformasi', 1, 1704189089, NULL),
('TS.170', 'Deliverables', 1, 1704189089, NULL),
('TS.200', 'MANAJEMEN PERUBAHAN', 1, 1704189089, NULL),
('TS.210', 'Steering Committee (Dewan Pengarah)', 1, 1704189089, NULL),
('TS.220', 'Change Agent', 1, 1704189089, NULL),
('TS.230', 'Change Leader', 1, 1704189089, NULL),
('TS.240', 'Change Champion', 1, 1704189089, NULL),
('TS.250', 'Working Group', 1, 1704189089, NULL),
('TS.260', 'Evaluasi dan Monitoring Perkembangan Program STATCAP CERDAS; Sensus Daring/CPOC', 1, 1704189089, NULL),
('TS.270', 'Sosialisasi, Internalisasi, Workshop terkait kegiatan Manajemen Perubahan, Kick of Meeting', 1, 1704189089, NULL),
('TS.300', 'KETERPADUAN TRANSFORMASI', 1, 1704189089, NULL),
('TS.310', 'Mendukung Implementasi Transformasi: CAPI SAKERNAS, Continous Survey', 1, 1704189089, NULL),
('TS.400', 'LAPORAN TRANSFORMASI STATISTIK', 1, 1704189089, NULL),
('TS.410', 'Laporan Kemajuan', 1, 1704189089, NULL),
('TS.420', 'Laporan Bulanan', 1, 1704189089, NULL),
('TS.430', 'Laporan Triwulan', 1, 1704189089, NULL),
('TS.440', 'Laporan Tahunan', 1, 1704189089, NULL),
('VS', 'SURVEI', 0, 1704189089, NULL),
('VS.000', 'PERENCANAAN SURVEI', 1, 1704189089, NULL),
('VS.010', 'Master Plan dan Network Planing SURVEI', 1, 1704189089, NULL),
('VS.020', 'Perumusan dan Penyusunan Bahan SURVEI', 1, 1704189089, NULL),
('VS.021', 'Penyiapan bahan penyusunan rancangan survei', 1, 1704189089, NULL),
('VS.022', 'Penyusunan metode pencacahan survei', 1, 1704189089, NULL),
('VS.023', 'Penentuan volume survei', 1, 1704189089, NULL),
('VS.024', 'Penyusunan desain penarikan sampel', 1, 1704189089, NULL),
('VS.025', 'Penyusunan kerangka sampel', 1, 1704189089, NULL),
('VS.030', 'Studi Pendahuluan (desk study)', 1, 1704189089, NULL),
('VS.100', 'PERSIAPAN SURVEI', 1, 1704189089, NULL),
('VS.110', 'Rancangan Organisasi', 1, 1704189089, NULL),
('VS.120', 'Penyusunan Kuesioner', 1, 1704189089, NULL),
('VS.130', 'Penyusunan Konsep dan Definisi', 1, 1704189089, NULL),
('VS.140', 'Penyusunan Metodologi (organisasi, lapangan, ukuran statistik)', 1, 1704189089, NULL),
('VS.150', 'Penyusunan Buku Pedoman (pencacahan, pengawasan, pengolahan)', 1, 1704189089, NULL),
('VS.160', 'Penyusunan Peta Wilayah Kerja dan Muatan Peta Wilayah', 1, 1704189089, NULL),
('VS.170', 'Penyusunan Pedoman Sosialisasi', 1, 1704189089, NULL),
('VS.180', 'Penyusunan Program Pengolahan (rule validasi pemeriksaan entri tabulasi)', 1, 1704189089, NULL),
('VS.190', 'Koordinasi Intern/Ekstrn', 1, 1704189089, NULL),
('VS.200', 'PELATIHAN/UJICOBA', 1, 1704189089, NULL),
('VS.210', 'Pelatihan Instruktur', 1, 1704189089, NULL),
('VS.220', 'Pelatihan Petugas', 1, 1704189089, NULL),
('VS.230', 'Pelatihan Petugas Pengolahan', 1, 1704189089, NULL),
('VS.240', 'Perancangan Tabel', 1, 1704189089, NULL),
('VS.250', 'Pelaksanaan Ujicoba Kuesioner Survei (meliputi reliabilitas kuesioner dan sistem pengolahan)', 1, 1704189089, NULL),
('VS.260', 'Pelaksanaan Ujicoba Kuesioner Metodologi Survei (meliputi ujicoba pelaksanaan pencacahan, organisasi dan jumlah sempel)', 1, 1704189089, NULL),
('VS.300', 'PELAKSANAAN LAPANGAN', 1, 1704189089, NULL),
('VS.310', 'Listing', 1, 1704189089, NULL),
('VS.320', 'Pemilihan Sampel', 1, 1704189089, NULL),
('VS.330', 'Pengumpulan Data', 1, 1704189089, NULL),
('VS.340', 'Pemeriksaan Data', 1, 1704189089, NULL),
('VS.350', 'Pengawasan Lapangan', 1, 1704189089, NULL),
('VS.360', 'Monitoring Kualitas', 1, 1704189089, NULL),
('VS.400', 'PENGOLAHAN', 1, 1704189089, NULL),
('VS.410', 'Pengelolaan Dokumen (penerimaan/pengiriman, pengelompokan/batching)', 1, 1704189089, NULL),
('VS.420', 'Pemeriksaan Dokumen dan Pengkodean(editing/coding)', 1, 1704189089, NULL),
('VS.430', 'Perekam Data (entri/scanner)', 1, 1704189089, NULL),
('VS.440', 'Tabulasi Data', 1, 1704189089, NULL),
('VS.450', 'Pemeriksaan Tabulasi', 1, 1704189089, NULL),
('VS.460', 'Laporan Konsistensi Tabulasi', 1, 1704189089, NULL),
('VS.500', 'ANALISIS DAN PENYAJIAN HASIL SURVEI', 1, 1704189089, NULL),
('VS.510', 'Pembahasan Angka Hasil Pengolahan', 1, 1704189089, NULL),
('VS.520', 'Penyusunan Angka Sementara', 1, 1704189089, NULL),
('VS.530', 'Penyusunan Angka Proyeksi/Ramalan', 1, 1704189089, NULL),
('VS.540', 'Penyusunan Angka Tetap', 1, 1704189089, NULL),
('VS.550', 'Penyusunan/ Pembahasan Draft Publikasi', 1, 1704189089, NULL),
('VS.560', 'Analisis Dta Survei', 1, 1704189089, NULL),
('VS.570', 'Penyusunan Diseminasi Hasil Survei', 1, 1704189089, NULL),
('VS.600', 'DISEMINASI HASIL SURVEI', 1, 1704189089, NULL),
('VS.610', 'Penyusunan Bahan Diseminasi', 1, 1704189089, NULL),
('VS.620', 'Sosialisasi Hasil Survei melalui berbagai Media', 1, 1704189089, NULL),
('VS.630', 'Layanan Promosi Statistik', 1, 1704189089, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `dbo_memo_keluar`
--

CREATE TABLE `dbo_memo_keluar` (
  `id` int(11) NOT NULL,
  `nomor` varchar(10) NOT NULL,
  `fungsi` varchar(5) NOT NULL,
  `klasifikasi` varchar(10) NOT NULL,
  `tahun` varchar(4) NOT NULL,
  `nomor_naskah` varchar(50) NOT NULL,
  `perihal` varchar(255) NOT NULL,
  `tujuan` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `file` varchar(255) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `user_create` int(11) NOT NULL,
  `user_update` int(11) DEFAULT NULL,
  `create_at` int(11) NOT NULL,
  `update_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dbo_migrations`
--

CREATE TABLE `dbo_migrations` (
  `id` int(11) NOT NULL,
  `migration` varchar(255) NOT NULL,
  `action` varchar(20) NOT NULL,
  `create_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `dbo_migrations`
--

INSERT INTO `dbo_migrations` (`id`, `migration`, `action`, `create_at`) VALUES
(1, 'm0001_user.php', 'up', '2024-01-02 12:38:45'),
(2, 'm0002_fungsi.php', 'up', '2024-01-02 12:38:45'),
(3, 'm0003_klasifikasi.php', 'up', '2024-01-02 12:38:45'),
(4, 'm0001_user.php', 'seed', '2024-01-02 12:38:46'),
(5, 'm0002_fungsi.php', 'seed', '2024-01-02 12:38:46'),
(6, 'm0004_akses.php', 'up', '2024-01-06 09:35:15'),
(7, 'm0004_akses.php', 'seed', '2024-01-06 09:35:15'),
(8, 'm0005_memo_keluar.php', 'up', '2024-01-11 15:55:06'),
(9, 'm0006_nota_keluar.php', 'up', '2024-01-11 15:55:06'),
(10, 'm0007_tugas_keluar.php', 'up', '2024-01-21 06:07:12'),
(11, 'm0008_dinas_keluar.php', 'up', '2024-01-21 06:07:12'),
(12, 'm0009_internal_keluar.php', 'up', '2024-01-21 06:07:12'),
(13, 'm0010_eksternal_keluar.php', 'up', '2024-01-21 06:07:12'),
(14, 'm0011_naskah_masuk.php', 'up', '2024-01-28 13:05:27'),
(19, 'm0012_permission.php', 'up', '2024-01-28 18:18:51'),
(20, 'm0012_permission.php', 'seed', '2024-01-28 18:18:51');

-- --------------------------------------------------------

--
-- Table structure for table `dbo_naskah_masuk`
--

CREATE TABLE `dbo_naskah_masuk` (
  `id` int(11) NOT NULL,
  `nomor` varchar(10) NOT NULL,
  `tahun` varchar(4) NOT NULL,
  `nomor_naskah` varchar(50) NOT NULL,
  `perihal` varchar(255) NOT NULL,
  `asal` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `file` varchar(255) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `user_create` int(11) NOT NULL,
  `user_update` int(11) DEFAULT NULL,
  `create_at` int(11) NOT NULL,
  `update_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dbo_nota_keluar`
--

CREATE TABLE `dbo_nota_keluar` (
  `id` int(11) NOT NULL,
  `nomor` varchar(10) NOT NULL,
  `fungsi` varchar(5) NOT NULL,
  `klasifikasi` varchar(10) NOT NULL,
  `tahun` varchar(4) NOT NULL,
  `nomor_naskah` varchar(50) NOT NULL,
  `perihal` varchar(255) NOT NULL,
  `tujuan` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `file` varchar(255) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `user_create` int(11) NOT NULL,
  `user_update` int(11) DEFAULT NULL,
  `create_at` int(11) NOT NULL,
  `update_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dbo_permission`
--

CREATE TABLE `dbo_permission` (
  `nama` varchar(100) NOT NULL,
  `user` int(1) NOT NULL DEFAULT 0,
  `admin` int(1) NOT NULL DEFAULT 0,
  `create_at` int(11) NOT NULL,
  `update_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `dbo_permission`
--

INSERT INTO `dbo_permission` (`nama`, `user`, `admin`, `create_at`, `update_at`) VALUES
('akses', 1, 1, 1706465931, NULL),
('delete_akses', 0, 1, 1706465931, NULL),
('delete_dinas_keluar', 1, 0, 1706465931, NULL),
('delete_eksternal_keluar', 1, 0, 1706465931, NULL),
('delete_fungsi', 0, 1, 1706465931, NULL),
('delete_internal_keluar', 1, 0, 1706465931, NULL),
('delete_klasifikasi', 0, 1, 1706465931, NULL),
('delete_memo_keluar', 1, 0, 1706465931, NULL),
('delete_naskah_masuk', 1, 0, 1706465931, NULL),
('delete_nota_keluar', 1, 0, 1706465931, NULL),
('delete_tugas_keluar', 1, 0, 1706465931, NULL),
('delete_user', 0, 1, 1706465931, NULL),
('dinas_keluar', 1, 0, 1706465931, NULL),
('edit_akses', 0, 1, 1706465931, NULL),
('edit_dinas_keluar', 1, 0, 1706465931, NULL),
('edit_eksternal_keluar', 1, 0, 1706465931, NULL),
('edit_fungsi', 0, 1, 1706465931, NULL),
('edit_internal_keluar', 1, 0, 1706465931, NULL),
('edit_klasifikasi', 0, 1, 1706465931, NULL),
('edit_memo_keluar', 1, 0, 1706465931, NULL),
('edit_naskah_masuk', 1, 0, 1706465931, NULL),
('edit_nota_keluar', 1, 0, 1706465931, NULL),
('edit_password', 1, 1, 1706465931, NULL),
('edit_tugas_keluar', 1, 0, 1706465931, NULL),
('edit_user', 0, 1, 1706465931, NULL),
('eksternal_keluar', 1, 0, 1706465931, NULL),
('entri_akses', 0, 1, 1706465931, NULL),
('entri_dinas_keluar', 1, 0, 1706465931, NULL),
('entri_eksternal_keluar', 1, 0, 1706465931, NULL),
('entri_fungsi', 0, 1, 1706465931, NULL),
('entri_internal_keluar', 1, 0, 1706465931, NULL),
('entri_klasifikasi', 0, 1, 1706465931, NULL),
('entri_memo_keluar', 1, 0, 1706465931, NULL),
('entri_naskah_masuk', 1, 0, 1706465931, NULL),
('entri_nota_keluar', 1, 0, 1706465931, NULL),
('entri_tugas_keluar', 1, 0, 1706465931, NULL),
('entri_user', 0, 1, 1706465931, NULL),
('fungsi', 1, 1, 1706465931, NULL),
('home', 1, 1, 1706465931, NULL),
('internal_keluar', 1, 0, 1706465931, NULL),
('klasifikasi', 1, 1, 1706465931, NULL),
('laporan_keluar', 1, 0, 1706465931, NULL),
('laporan_masuk', 1, 0, 1706465931, NULL),
('login', 1, 1, 1706465931, NULL),
('logout', 1, 1, 1706465931, NULL),
('memo_keluar', 1, 0, 1706465931, NULL),
('naskah_masuk', 1, 0, 1706465931, NULL),
('nota_keluar', 1, 0, 1706465931, NULL),
('profil', 1, 1, 1706465931, NULL),
('tugas_keluar', 1, 0, 1706465931, NULL),
('user', 0, 1, 1706465931, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `dbo_tugas_keluar`
--

CREATE TABLE `dbo_tugas_keluar` (
  `id` int(11) NOT NULL,
  `akses` varchar(10) NOT NULL,
  `nomor` varchar(10) NOT NULL,
  `fungsi` varchar(5) NOT NULL,
  `klasifikasi` varchar(10) NOT NULL,
  `tahun` varchar(4) NOT NULL,
  `nomor_naskah` varchar(50) NOT NULL,
  `perihal` varchar(255) NOT NULL,
  `tujuan` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `file` varchar(255) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `user_create` int(11) NOT NULL,
  `user_update` int(11) DEFAULT NULL,
  `create_at` int(11) NOT NULL,
  `update_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `dbo_tugas_keluar`
--

INSERT INTO `dbo_tugas_keluar` (`id`, `akses`, `nomor`, `fungsi`, `klasifikasi`, `tahun`, `nomor_naskah`, `perihal`, `tujuan`, `tanggal`, `file`, `keterangan`, `user_create`, `user_update`, `create_at`, `update_at`) VALUES
(1, 'B', '1', '14000', 'DL.020', '2024', 'B-1/14000/DL.020/2024', 'Rapat persiapan pembentukan tim kerja', 'semua pegawai', '2024-01-21', '1705826533.pdf', NULL, 1, 1, 1705825599, 1705826646);

-- --------------------------------------------------------

--
-- Table structure for table `dbo_user`
--

CREATE TABLE `dbo_user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `fungsi` varchar(5) NOT NULL,
  `create_at` int(11) NOT NULL,
  `update_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `dbo_user`
--

INSERT INTO `dbo_user` (`id`, `username`, `password`, `nama`, `role`, `fungsi`, `create_at`, `update_at`) VALUES
(1, 'admin', '$2y$10$9bAKbkmsgE.EN2dKPxsAPe6esSIop2dEaa5bbx/9gqOaTF2MwohVu', 'Administrator', 'admin,user', '14000', 1704199125, 1718533063),
(2, 'ipds', '$2y$10$aF0K6x64WS8NFb5WdpmtfeEcn4wt42vsTqrtQL8iRVotRNIH0JJGy', 'User Fungsi IPDS', 'user', '14560', 1704199125, 1718533823),
(3, 'umum', '$2y$10$3zZVH8IkSt1FH6txmMx8/up00gAr8lt4NFE/HUCQu0T2V5snvKfie', 'User Bagian Umum', 'user', '14510', 1704199125, 1706461931),
(4, 'sosial', '$2y$10$ajMeu0a0egm4BZamLBfIxeQb3JEYT7.hMfB2sWBRPLKA1IIcoLtW.', 'User Fungsi Statistik Sosial', 'user', '14520', 1704199126, 1718533829),
(5, 'produksi', '$2y$10$2/zJNwG5y0tXlbsWW28eEOVJMnG4LLfMghUJJGzAhryIisLXvC3Ti', 'User Fungsi Statistik Produksi', 'user', '14530', 1704199126, 1706115852),
(6, 'distribusi', '$2y$10$/iVsvltpEExTHdxITD3yue2yaz.5sv2PBGNGKccNbMBKvLp6Ywsy2', 'User Fungsi Statistik Distribusi', 'user', '14540', 1704199126, 1706115823),
(7, 'neraca', '$2y$10$VOdrkleSy4RmhUMc2PGTK.2.FmanwADOzb1lzQRSC4VHLtCL4qkDC', 'User Fungsi Nerwilis', 'user', '14550', 1704199126, NULL),
(8, 'user', '$2y$10$Ckm5iMe96C8sMTYQcwKSvec7V3oc7BoK4rzmfdPG7mVXp0kmqCTma', 'User', 'user', '14000', 1704988853, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dbo_akses`
--
ALTER TABLE `dbo_akses`
  ADD PRIMARY KEY (`kode`);

--
-- Indexes for table `dbo_dinas_keluar`
--
ALTER TABLE `dbo_dinas_keluar`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nomor_naskah` (`nomor_naskah`);

--
-- Indexes for table `dbo_eksternal_keluar`
--
ALTER TABLE `dbo_eksternal_keluar`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nomor_naskah` (`nomor_naskah`);

--
-- Indexes for table `dbo_fungsi`
--
ALTER TABLE `dbo_fungsi`
  ADD PRIMARY KEY (`kode`);

--
-- Indexes for table `dbo_internal_keluar`
--
ALTER TABLE `dbo_internal_keluar`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nomor_naskah` (`nomor_naskah`);

--
-- Indexes for table `dbo_klasifikasi`
--
ALTER TABLE `dbo_klasifikasi`
  ADD PRIMARY KEY (`kode`);

--
-- Indexes for table `dbo_memo_keluar`
--
ALTER TABLE `dbo_memo_keluar`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nomor_naskah` (`nomor_naskah`);

--
-- Indexes for table `dbo_migrations`
--
ALTER TABLE `dbo_migrations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `migration` (`migration`,`action`);

--
-- Indexes for table `dbo_naskah_masuk`
--
ALTER TABLE `dbo_naskah_masuk`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nomor_naskah` (`nomor_naskah`);

--
-- Indexes for table `dbo_nota_keluar`
--
ALTER TABLE `dbo_nota_keluar`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nomor_naskah` (`nomor_naskah`);

--
-- Indexes for table `dbo_permission`
--
ALTER TABLE `dbo_permission`
  ADD PRIMARY KEY (`nama`);

--
-- Indexes for table `dbo_tugas_keluar`
--
ALTER TABLE `dbo_tugas_keluar`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nomor_naskah` (`nomor_naskah`);

--
-- Indexes for table `dbo_user`
--
ALTER TABLE `dbo_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dbo_dinas_keluar`
--
ALTER TABLE `dbo_dinas_keluar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dbo_eksternal_keluar`
--
ALTER TABLE `dbo_eksternal_keluar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dbo_internal_keluar`
--
ALTER TABLE `dbo_internal_keluar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dbo_memo_keluar`
--
ALTER TABLE `dbo_memo_keluar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dbo_migrations`
--
ALTER TABLE `dbo_migrations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `dbo_naskah_masuk`
--
ALTER TABLE `dbo_naskah_masuk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dbo_nota_keluar`
--
ALTER TABLE `dbo_nota_keluar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dbo_tugas_keluar`
--
ALTER TABLE `dbo_tugas_keluar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `dbo_user`
--
ALTER TABLE `dbo_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
