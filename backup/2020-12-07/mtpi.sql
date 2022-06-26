-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 07, 2020 at 03:41 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mtpi`
--

-- --------------------------------------------------------

--
-- Table structure for table `beban`
--

CREATE TABLE `beban` (
  `id` int(5) NOT NULL,
  `kode_akun_id` int(4) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `harga` decimal(13,2) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `delivery_order`
--

CREATE TABLE `delivery_order` (
  `id` int(11) NOT NULL,
  `penjualan_id` int(11) DEFAULT NULL,
  `tanggal_kirim` date DEFAULT NULL,
  `tanggal_terima_retur` date DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `tipe_delivery_order_id` int(5) NOT NULL,
  `status` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `delivery_order_tipe`
--

CREATE TABLE `delivery_order_tipe` (
  `id` int(5) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `keterangan` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `do`
--

CREATE TABLE `do` (
  `id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `penerima` varchar(100) NOT NULL,
  `penerima_hp` varchar(15) NOT NULL,
  `tujuan` text NOT NULL,
  `keterangan` varchar(30) NOT NULL,
  `catatan` text NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `disiapkan_oleh` varchar(100) NOT NULL,
  `disetujui_oleh` varchar(100) NOT NULL,
  `dikirim_oleh` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `do`
--

INSERT INTO `do` (`id`, `invoice_id`, `tanggal`, `penerima`, `penerima_hp`, `tujuan`, `keterangan`, `catatan`, `updated_at`, `created_at`, `disiapkan_oleh`, `disetujui_oleh`, `dikirim_oleh`) VALUES
(1, 6, '2020-09-17', 'Henny', '08123456', 'Jl. Makmur No. 95', 'dikirim', 'taruh depan pagar', '0000-00-00 00:00:00', '2020-10-26 06:54:31', 'Jenny', 'Leny', 'Kenny'),
(2, 6, '2020-09-17', 'Andy', '08123456', 'Jl. indah no.12', 'dikirim', '', '0000-00-00 00:00:00', '2020-10-30 15:44:44', 'beny', 'cindy', 'deddy');

-- --------------------------------------------------------

--
-- Table structure for table `do_pembelian`
--

CREATE TABLE `do_pembelian` (
  `id` int(11) NOT NULL,
  `no_do_pembelian` varchar(255) NOT NULL,
  `pembelian_id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `do_pembelian`
--

INSERT INTO `do_pembelian` (`id`, `no_do_pembelian`, `pembelian_id`, `tanggal`, `gambar`) VALUES
(1, 'DO/01/11', 17, '2020-09-29', 'uploads/do_pembelian/1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `id` int(11) NOT NULL,
  `produk_id` int(11) DEFAULT NULL,
  `lokasi_id` int(5) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `tanggal` date NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`id`, `produk_id`, `lokasi_id`, `qty`, `tanggal`, `updated_at`, `created_at`) VALUES
(6, 22, 3, 11, '2020-09-30', '2020-10-27 14:16:59', '0000-00-00 00:00:00'),
(8, 21, 2, 4, '0000-00-00', '2020-10-27 14:12:28', '0000-00-00 00:00:00'),
(9, 12, 3, 20, '2020-08-31', '2020-10-27 15:51:02', '2020-08-17 15:52:13'),
(10, 10, 2, 710, '2020-08-31', '2020-10-27 15:51:07', '2020-09-01 15:14:44'),
(11, 16, 2, 40, '2020-09-16', '2020-10-27 14:12:34', '2020-10-27 14:05:39'),
(12, 17, 2, 80, '2020-09-18', '0000-00-00 00:00:00', '2020-10-27 14:15:50');

-- --------------------------------------------------------

--
-- Table structure for table `inventory_riwayat`
--

CREATE TABLE `inventory_riwayat` (
  `id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `inventory_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventory_riwayat`
--

INSERT INTO `inventory_riwayat` (`id`, `tanggal`, `inventory_id`, `qty`) VALUES
(1, '2020-09-30', 10, 2),
(2, '2020-09-27', 9, -2),
(3, '2020-09-23', 9, 3),
(4, '2020-09-18', 8, -5);

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `id` int(11) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `perform_invoice_id` int(11) DEFAULT NULL,
  `status` varchar(30) DEFAULT 'aktif',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`id`, `tanggal`, `perform_invoice_id`, `status`, `updated_at`, `created_at`) VALUES
(5, '2020-09-22', 13, 'aktif', '0000-00-00 00:00:00', '2020-09-20 08:31:57'),
(6, '2020-09-15', 14, 'aktif', '0000-00-00 00:00:00', '2020-10-24 09:19:02');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_status_pembayaran`
--

CREATE TABLE `invoice_status_pembayaran` (
  `id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `status` varchar(30) NOT NULL,
  `invoice_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice_status_pembayaran`
--

INSERT INTO `invoice_status_pembayaran` (`id`, `tanggal`, `status`, `invoice_id`) VALUES
(1, '2020-09-21', 'aktif', 5),
(3, '2020-09-26', 'bayar', 5),
(4, '2020-09-30', 'lunas', 5),
(5, '2020-09-15', 'aktif', 6),
(6, '2020-09-16', 'bayar', 6),
(7, '2020-09-17', 'lunas', 6);

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `keterangan` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`id`, `nama`, `keterangan`) VALUES
(1, 'Elbow', 'Keterangan Elbow'),
(2, 'Pipa', 'Keterangan Pipa');

-- --------------------------------------------------------

--
-- Table structure for table `jenis`
--

CREATE TABLE `jenis` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `keterangan` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jenis`
--

INSERT INTO `jenis` (`id`, `nama`, `keterangan`) VALUES
(1, 'PVC', 'Pipa PVC (Poly Vinyl Chloride) adalah jenis pipa yang umum digunakan untuk mengalirkan air bersih, air bekas, drainase, serta air hujan.'),
(2, 'CPVC', 'Pipa CPVC atau dikenal juga dengan Chlorinate Poly Vinyl Chloride memiliki ketahanan suhu hingga 1.800 derajat Celsius.'),
(3, 'Tembaga', 'umumnya dipakai untuk instalasi refrigerant karena sifatnya yang tahan terhadap suhu panas dan dingin.'),
(7, 'HDPE', 'Pipa HDPE (High Density Polyethylene) merupakan pipa dengan material plastik non-toxic yang memiliki elastisitas tinggi.'),
(8, 'PP-R', 'Pipa dengan material polypropylene random ini diberkati dengan karakter unik karena sifatnya yang bisa menyalurkan air dengan tekanan dan suhu tinggi.'),
(11, 'PEX', 'PEX (Cross-linked Poyle Ethylene) adalah jenis pipa lainnya yang bisa digunakan untuk instalasi air dingin dan panas serta hidrolik karena sifatnya yang bisa menoleransi suhu dingin dan panas.'),
(13, 'Galvanis', 'bahan yang aman untuk dipakai di dalam dan di luar tanah, memasang pengaman pada instalasi dalam tanah masihlah dianjurkan.'),
(14, 'PVC-O', 'Varian pipa air selanjutnya adalah PVC-O. Pipa ini merupakan pengembangan dari bahan PVC yang diproduksi menggunakan metode bi-axial sehingga ikatan antar molekul bahan baku menjadi sangat kuat dengan material yang lebih tipis sehingga lebih efektif dalam menampung volume air.'),
(17, 'SDR-41', 'Berbeda dengan jenis pipa lainnya, pipa air SDR-41 dikhususkan untuk pembuangan limbah. Pipa SDR-41 ini memiliki ketebalan yang optimal untuk saluran fluorida berupa limbah tanpa tekanan, serta memiliki karakter berwarna cokelat sehingga memudahkan identifikasi jenis saluran air.');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int(8) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `keterangan` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `nama`, `keterangan`) VALUES
(2, 'S-6', ''),
(3, 'S-5', '');

-- --------------------------------------------------------

--
-- Table structure for table `kode_akun`
--

CREATE TABLE `kode_akun` (
  `id` int(4) NOT NULL,
  `kode` int(3) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `saldo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kode_akun`
--

INSERT INTO `kode_akun` (`id`, `kode`, `nama`, `saldo`) VALUES
(1, 1100, 'AKTIVA LANCAR', 0),
(2, 2100, 'UTANG LANCAR', 0),
(3, 1102, 'BANK BCA', 10000),
(4, 1101, 'KAS', 10000),
(8, 2104, 'PPN MASUKAN', 0),
(9, 2105, 'PPN KELUARAN', 0),
(10, 2101, 'UTANG USAHA', 10000),
(11, 5101, 'PEMBELIAN', 10000),
(12, 5104, 'UANG MUKA PEMBELIAN', 0),
(13, 5102, 'POTONGAN PEMBELIAN', 0),
(14, 4104, 'PENDAPATAN DITERIMA MUKA', 0),
(15, 4102, 'POTONGAN PENJUALAN', 0),
(16, 4101, 'PENJUALAN', 10000),
(17, 1111, 'PIUTANG USAHA', 0),
(18, 4100, 'PENDAPATAN', 0),
(19, 5100, 'HARGA POKOK PENJUALAN', 0);

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `aktivitas` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`id`, `user_id`, `aktivitas`, `created_at`) VALUES
(2, 4, 'Login website', '2020-06-14 06:08:40');

-- --------------------------------------------------------

--
-- Table structure for table `lokasi`
--

CREATE TABLE `lokasi` (
  `id` int(5) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `alamat` text,
  `keterangan` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lokasi`
--

INSERT INTO `lokasi` (`id`, `nama`, `alamat`, `keterangan`) VALUES
(2, 'Gudang Tangerang', 'Jl. Boulevard', 'Keterangan gudang tangerang'),
(3, 'Gudang BSD', 'Jl. BSD Raya Utama no. 10', 'Keterangan Gudang BSD');

-- --------------------------------------------------------

--
-- Table structure for table `merek`
--

CREATE TABLE `merek` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `keterangan` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `merek`
--

INSERT INTO `merek` (`id`, `nama`, `keterangan`) VALUES
(2, 'Wavin', ''),
(3, 'Champion', '');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` char(15) NOT NULL,
  `jenis_kelamin` varchar(20) NOT NULL,
  `pelanggan_info_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `nama`, `email`, `phone`, `jenis_kelamin`, `pelanggan_info_id`, `user_id`) VALUES
(11, 'Andy', 'andy@gmail.com', '0812', 'laki-laki', 6, NULL),
(14, 'Andy', 'andy@gmail.com', '0812', 'laki-laki', 6, NULL),
(15, 'Beny', 'beny@gmail.com', '081234', 'laki-laki', 6, NULL),
(16, 'Beny', 'beny@gmail.com', '0812121212', 'laki-laki', NULL, NULL),
(17, 'Tika', 'tika@gmai.com', '08456789', 'perempuan', 7, NULL),
(18, 'Mr Joko', 'joko@gmail.com', '081234', 'laki-laki', 6, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan_info`
--

CREATE TABLE `pelanggan_info` (
  `id` int(5) NOT NULL,
  `nama_org` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `no_telepon` varchar(15) NOT NULL,
  `alamat` text NOT NULL,
  `npwp` char(15) NOT NULL,
  `pelanggan_tipe_id` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelanggan_info`
--

INSERT INTO `pelanggan_info` (`id`, `nama_org`, `email`, `no_telepon`, `alamat`, `npwp`, `pelanggan_tipe_id`) VALUES
(6, 'PT ABC', 'abc@gmail.com', '0812', 'Jl. Sudriman', '081234', NULL),
(7, 'PT INDO JAYA', 'indojaya@gmail.com', '0812987654321', 'Jl. Indo Jaya', '99887766', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan_tipe`
--

CREATE TABLE `pelanggan_tipe` (
  `id` int(3) NOT NULL,
  `nama` varchar(200) DEFAULT NULL,
  `keterangan` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `id` int(11) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `vendor_id` int(11) DEFAULT NULL,
  `termin` int(8) DEFAULT NULL,
  `down_payment` int(3) DEFAULT NULL,
  `pajak` int(3) DEFAULT NULL,
  `lokasi_id` int(5) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `bukti_terima` varchar(255) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(30) DEFAULT 'aktif' COMMENT 'kyknya kolom ini ngak perlu'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`id`, `tanggal`, `vendor_id`, `termin`, `down_payment`, `pajak`, `lokasi_id`, `user_id`, `bukti_terima`, `updated_at`, `created_at`, `status`) VALUES
(17, '2020-08-24', 1, 40, 30, 20, 2, NULL, '', '2020-09-13 12:08:08', '2020-08-29 11:29:47', ''),
(21, '2020-09-09', 1, 0, 0, 10, 2, NULL, '', '0000-00-00 00:00:00', '2020-09-13 13:21:06', 'aktif'),
(22, '2020-09-05', 1, 14, 30, 10, 2, NULL, '', '0000-00-00 00:00:00', '2020-09-20 04:30:41', 'aktif'),
(23, '2020-09-19', 2, 45, 50, 10, 2, NULL, '', '0000-00-00 00:00:00', '2020-10-24 15:23:12', 'aktif');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian_detail`
--

CREATE TABLE `pembelian_detail` (
  `id` int(11) NOT NULL,
  `pembelian_id` int(11) DEFAULT NULL,
  `produk_id` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT '0',
  `diskon` int(11) DEFAULT '0',
  `status` varchar(30) DEFAULT 'aktif' COMMENT 'aktif=pesanan belum sampai, selesai = pesanan sampai'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembelian_detail`
--

INSERT INTO `pembelian_detail` (`id`, `pembelian_id`, `produk_id`, `qty`, `diskon`, `status`) VALUES
(3, 21, 10, 2, 5, 'selesai'),
(4, 17, 24, 3, 20, 'selesai'),
(5, 22, 25, 5, 20, 'aktif'),
(6, 23, 12, 3, 10, 'selesai'),
(7, 23, 25, 10, 10, 'aktif');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian_status_pembayaran`
--

CREATE TABLE `pembelian_status_pembayaran` (
  `id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `status` varchar(30) NOT NULL,
  `pembelian_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembelian_status_pembayaran`
--

INSERT INTO `pembelian_status_pembayaran` (`id`, `tanggal`, `status`, `pembelian_id`) VALUES
(2, '2020-09-07', 'aktif', 17),
(3, '2020-09-09', 'aktif', 21),
(4, '2020-09-16', 'lunas', 21),
(5, '2020-09-05', 'aktif', 22),
(6, '2020-09-12', 'bayar', 22),
(7, '2020-09-19', 'aktif', 23);

-- --------------------------------------------------------

--
-- Table structure for table `pembelian_terms_conditions`
--

CREATE TABLE `pembelian_terms_conditions` (
  `id` int(11) NOT NULL,
  `terms_conditions_id` int(8) DEFAULT NULL,
  `pembelian_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `id` int(11) NOT NULL,
  `pelanggan_id` int(11) DEFAULT NULL,
  `harga_ongkir` decimal(13,2) DEFAULT NULL,
  `diskon` decimal(13,2) DEFAULT NULL,
  `pajak` decimal(13,2) DEFAULT NULL,
  `termin` int(5) DEFAULT NULL,
  `rekening_id` int(3) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `penjualan_detail`
--

CREATE TABLE `penjualan_detail` (
  `id` int(11) NOT NULL,
  `penjualan_id` int(11) DEFAULT NULL,
  `produk_id` int(11) DEFAULT NULL,
  `diskon` decimal(13,2) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `penjualan_laporan`
--

CREATE TABLE `penjualan_laporan` (
  `id` char(11) NOT NULL,
  `penjualan_id` int(11) DEFAULT NULL,
  `tanggal` date NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `penjualan_terms_conditions`
--

CREATE TABLE `penjualan_terms_conditions` (
  `id` int(11) NOT NULL,
  `penjualan_id` int(11) DEFAULT NULL,
  `terms_conditions_id` int(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `perform_invoice`
--

CREATE TABLE `perform_invoice` (
  `id` int(11) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `purchase_order_pelanggan_id` int(11) DEFAULT NULL,
  `termin` int(3) DEFAULT NULL,
  `down_payment` int(3) DEFAULT NULL,
  `sales_quotation_id` int(11) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `perform_invoice`
--

INSERT INTO `perform_invoice` (`id`, `tanggal`, `purchase_order_pelanggan_id`, `termin`, `down_payment`, `sales_quotation_id`, `updated_at`, `created_at`) VALUES
(1, '2020-08-05', NULL, 60, 0, 3, '2020-08-09 16:15:29', '2020-08-09 14:47:50'),
(3, '2020-08-03', NULL, 0, 0, 2, '0000-00-00 00:00:00', '2020-08-13 14:34:55'),
(4, '2020-08-13', NULL, 50, 70, 11, '0000-00-00 00:00:00', '2020-08-17 15:52:47'),
(13, '2020-08-05', 4, 45, 50, 4, '2020-08-30 10:49:32', '2020-08-30 10:47:55'),
(14, '2020-09-14', 2, 30, 50, 13, '2020-10-24 09:17:43', '2020-10-24 09:17:16');

-- --------------------------------------------------------

--
-- Table structure for table `permintaan_barang`
--

CREATE TABLE `permintaan_barang` (
  `id` int(11) NOT NULL,
  `penjualan_laporan_id` char(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `permintaan_pembelian`
--

CREATE TABLE `permintaan_pembelian` (
  `id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `produk_id` int(11) NOT NULL,
  `qty` int(11) DEFAULT NULL,
  `status` varchar(30) NOT NULL DEFAULT 'aktif' COMMENT 'aktif, disetujui'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `item_id` int(11) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `jenis_id` int(11) DEFAULT NULL,
  `warna_id` int(8) DEFAULT NULL,
  `kategori_id` int(8) DEFAULT NULL,
  `merek_id` int(11) DEFAULT NULL,
  `diameter` float DEFAULT NULL,
  `panjang` float DEFAULT NULL,
  `satuan_id` int(11) DEFAULT NULL,
  `minimum_order` int(11) DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(30) DEFAULT 'aktif'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `item_id`, `harga`, `jenis_id`, `warna_id`, `kategori_id`, `merek_id`, `diameter`, `panjang`, `satuan_id`, `minimum_order`, `gambar`, `updated_at`, `created_at`, `status`) VALUES
(10, 2, 8000, 1, 2, 2, 2, 3, 2, 1, 1, 'uploads/produk/0.jpg', '2020-10-24 07:49:25', '2020-07-22 15:20:32', 'aktif'),
(12, 2, 1000, 2, 2, 2, 3, 1, 1, 1, 1, 'uploads/produk/0.jpg', '2020-10-24 07:50:02', '2020-07-22 15:31:15', 'aktif'),
(13, 2, 210, 7, 2, 2, 2, 3, 3, 1, 3, 'uploads/produk/contohpipa.jpg', '2020-10-24 07:50:48', '2020-07-22 15:33:06', 'aktif'),
(16, 2, 1232, 11, 2, 2, 3, 2, 3, 1, 4, 'uploads/produk/16.jpg', '2020-10-24 07:51:01', '2020-07-22 15:41:41', 'aktif'),
(17, 2, 150, 1, 2, 2, 3, 2, 3, 1, 4, 'uploads/produk/17.jpg', '2020-10-24 07:51:11', '2020-07-22 15:43:32', 'aktif'),
(18, 2, 1000, 14, 2, 2, 2, 3, 1, 1, 2, 'uploads/produk/18.jpg', '2020-10-24 07:51:31', '2020-07-24 15:48:09', 'aktif'),
(19, 2, 2000, 3, 2, 2, 3, 2, 31, 1, 1, 'uploads/produk/19.jpg', '2020-10-24 07:51:43', '2020-07-24 15:48:37', 'aktif'),
(21, 2, 15000, 11, 2, 2, 2, 1, 3, 1, 3, 'uploads/produk/21.jpg', '2020-10-24 07:52:04', '2020-07-25 14:56:47', 'aktif'),
(22, 2, 700, 11, 2, 2, 3, 7.2, 6.2, 1, 2, 'uploads/produk/22.jpg', '2020-10-24 07:52:19', '2020-07-25 14:58:28', 'aktif'),
(23, 2, 677, 13, 2, 2, 3, 9.2, 6.3, 1, 5, 'uploads/produk/23.jpg', '2020-10-24 07:52:30', '2020-07-25 15:02:23', 'aktif'),
(24, 2, 7000, 1, 2, 2, 3, 4, 3, 1, 2, 'uploads/produk/24.jpg', '2020-10-27 14:16:46', '2020-07-26 03:59:14', 'aktif'),
(25, 2, 8000, 1, 2, 2, 2, 8, 4, 1, 2, 'uploads/produk/25.jpg', '2020-10-24 07:54:25', '2020-08-10 14:45:04', 'aktif');

-- --------------------------------------------------------

--
-- Table structure for table `profil_perusahaan`
--

CREATE TABLE `profil_perusahaan` (
  `id` int(3) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `no_telepon` char(25) DEFAULT NULL,
  `alamat` text,
  `tanggal` date NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `rekening_id` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `profil_perusahaan`
--

INSERT INTO `profil_perusahaan` (`id`, `nama`, `email`, `no_telepon`, `alamat`, `tanggal`, `logo`, `rekening_id`) VALUES
(2, 'PT Mitra Tiga Perkasa Indonesia', 'mitratigaperkasa@gmail.com', '02122225352', 'RUKO ALICANTE BLOCK C No. 1 Jl. Boulevard Andalucia Gading Serpong Kel. Medang Kab. Tangerang - Banten 15334', '2020-08-01', 'uploads/profil_perusahaan/2.png', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order_pelanggan`
--

CREATE TABLE `purchase_order_pelanggan` (
  `id` int(11) NOT NULL,
  `no_po_pelanggan` varchar(255) DEFAULT NULL,
  `pelanggan_id` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase_order_pelanggan`
--

INSERT INTO `purchase_order_pelanggan` (`id`, `no_po_pelanggan`, `pelanggan_id`, `tanggal`, `gambar`) VALUES
(2, 'TWS/014/PO/V/2020', 17, '2020-08-05', 'uploads/purchase_order_pelanggan/2.png'),
(3, 'TYU/020/PO/VI/2019', 15, '2020-07-20', 'uploads/purchase_order_pelanggan/3.jpg'),
(4, 'LKJ/018/PO/VI/2019', 18, '2020-08-10', 'uploads/purchase_order_pelanggan/4.png'),
(5, NULL, NULL, '2020-09-30', 'uploads/purchase_order_pelanggan/5.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `rekening`
--

CREATE TABLE `rekening` (
  `id` int(3) NOT NULL,
  `nama_bank` varchar(255) NOT NULL,
  `nama_rekening` varchar(200) NOT NULL,
  `no_rekening` char(30) NOT NULL,
  `kode_akun_id` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rekening`
--

INSERT INTO `rekening` (`id`, `nama_bank`, `nama_rekening`, `no_rekening`, `kode_akun_id`) VALUES
(1, 'BCA', 'PT MITRA TIGA PERKASA INDONESIA', '4977 99 77797', 3);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(5) NOT NULL,
  `nama` varchar(80) DEFAULT NULL,
  `deskripsi` text,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(30) DEFAULT NULL COMMENT 'Isi dengan aktif atau arsip (nonaktif)'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `nama`, `deskripsi`, `updated_at`, `created_at`, `status`) VALUES
(1, 'Admin', 'Full power', '2020-08-02 11:12:09', '2020-06-14 06:02:01', 'aktif'),
(2, 'Purchasing', 'Membeli persediaan stok', '0000-00-00 00:00:00', '2020-08-02 11:05:37', 'aktif'),
(4, 'Marketing', 'Menjual produk', '2020-08-02 11:12:02', '2020-08-02 11:11:22', 'aktif'),
(5, 'Admin gudang', 'Administrasi Gudang', '0000-00-00 00:00:00', '2020-10-28 00:01:14', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sales_quotation`
--

CREATE TABLE `sales_quotation` (
  `id` int(11) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `pelanggan_id` int(11) DEFAULT NULL,
  `pajak` int(3) DEFAULT '0',
  `ongkir` int(13) NOT NULL DEFAULT '0',
  `lokasi_id` int(5) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales_quotation`
--

INSERT INTO `sales_quotation` (`id`, `tanggal`, `pelanggan_id`, `pajak`, `ongkir`, `lokasi_id`, `user_id`, `updated_at`, `created_at`) VALUES
(1, '2020-08-03', 11, 10, 0, 3, NULL, '2020-10-27 07:20:20', '2020-08-06 15:02:38'),
(2, '2020-08-02', 16, 10, 0, 2, NULL, '2020-10-27 07:04:17', '2020-08-06 15:05:54'),
(3, '2020-08-01', 14, 50, 0, 2, NULL, '2020-10-27 07:04:20', '2020-08-06 15:07:15'),
(4, '2020-08-01', 14, 50, 0, 2, NULL, '2020-10-27 07:04:22', '2020-08-06 15:07:48'),
(5, '2020-08-01', 14, 50, 0, 2, NULL, '2020-10-27 07:04:25', '2020-08-06 15:08:12'),
(6, '2020-07-07', 16, 20, 0, 2, NULL, '2020-10-27 07:04:29', '2020-08-06 15:09:34'),
(7, '2020-07-19', 14, 15, 0, 2, NULL, '2020-10-27 07:04:33', '2020-08-06 15:11:00'),
(9, '2020-07-25', 11, 10, 0, 2, NULL, '2020-10-27 07:04:38', '2020-08-06 15:12:53'),
(10, '2020-08-02', 11, 20, 1000000, 2, NULL, '2020-10-27 07:04:48', '2020-08-09 08:06:39'),
(11, '2020-08-10', 16, 10, 1000000, 2, NULL, '2020-10-27 07:04:44', '2020-08-17 14:04:21'),
(12, '2020-08-19', 18, 10, 10000000, 2, NULL, '2020-10-27 07:04:42', '2020-08-21 14:19:24'),
(13, '2020-09-13', 17, 10, 0, 2, NULL, '2020-10-27 07:04:41', '2020-10-24 09:13:47');

-- --------------------------------------------------------

--
-- Table structure for table `sales_quotation_detail`
--

CREATE TABLE `sales_quotation_detail` (
  `id` int(11) NOT NULL,
  `produk_id` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL DEFAULT '0',
  `qty` int(11) NOT NULL,
  `diskon` int(3) NOT NULL,
  `sales_quotation_id` int(11) NOT NULL,
  `status` varchar(30) NOT NULL DEFAULT 'aktif' COMMENT 'aktif=pesanan belum sampai, selesai = pesanan sampai'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales_quotation_detail`
--

INSERT INTO `sales_quotation_detail` (`id`, `produk_id`, `harga_jual`, `qty`, `diskon`, `sales_quotation_id`, `status`) VALUES
(2, 12, 8000, 3, 15, 3, 'aktif'),
(3, 16, 0, 5, 20, 3, 'aktif'),
(4, 16, 0, 10, 33, 3, 'aktif'),
(5, 12, 0, 0, 30, 3, 'aktif'),
(7, 0, 0, 0, 0, 2, 'selesai'),
(8, 10, 0, 8, 5, 11, 'aktif'),
(9, 21, 0, 5, 10, 11, 'aktif'),
(10, 10, 0, 5, 10, 12, 'selesai'),
(11, 21, 0, 20, 5, 12, 'aktif'),
(12, 21, 20000, 3, 10, 4, 'aktif'),
(13, 10, 20000, 5, 20, 13, 'selesai'),
(14, 12, 50000, 2, 10, 13, 'selesai');

-- --------------------------------------------------------

--
-- Table structure for table `sales_quotation_terms_conditions`
--

CREATE TABLE `sales_quotation_terms_conditions` (
  `id` int(4) NOT NULL,
  `terms_conditions_id` int(8) DEFAULT NULL,
  `sales_quotation_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales_quotation_terms_conditions`
--

INSERT INTO `sales_quotation_terms_conditions` (`id`, `terms_conditions_id`, `sales_quotation_id`) VALUES
(1, 2, 3),
(2, 1, 11),
(3, 1, 12),
(4, 2, 12),
(5, 1, 10),
(6, 1, 13);

-- --------------------------------------------------------

--
-- Table structure for table `satuan`
--

CREATE TABLE `satuan` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `keterangan` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `satuan`
--

INSERT INTO `satuan` (`id`, `nama`, `keterangan`) VALUES
(1, 'Btg', 'Batang');

-- --------------------------------------------------------

--
-- Table structure for table `standard`
--

CREATE TABLE `standard` (
  `id` int(8) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `jenis_id` int(11) DEFAULT NULL,
  `keterangan` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `standard`
--

INSERT INTO `standard` (`id`, `nama`, `jenis_id`, `keterangan`) VALUES
(3, 'ASTM', 17, 'American Society for Testing and Material'),
(4, 'BS', 8, 'British Standards'),
(7, 'SNI', 1, 'Standar Nasional Indonesia (SNI) adalah standarisasi industri yang dikeluarkan oleh otoritas Panitia Teknis yang ditetapkan oleh Badan Standarisasi Nasional (BSN).');

-- --------------------------------------------------------

--
-- Table structure for table `terms_conditions`
--

CREATE TABLE `terms_conditions` (
  `id` int(8) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `keterangan` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `terms_conditions`
--

INSERT INTO `terms_conditions` (`id`, `nama`, `keterangan`) VALUES
(1, 'Stok tidak mengikat', 'Keterangan stok tidak mengikat'),
(2, 'Cash Before Delivery', 'CBD');

-- --------------------------------------------------------

--
-- Table structure for table `tipe`
--

CREATE TABLE `tipe` (
  `id` int(8) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `standard_id` int(8) DEFAULT NULL,
  `keterangan` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tipe`
--

INSERT INTO `tipe` (`id`, `nama`, `standard_id`, `keterangan`) VALUES
(8, 'AW', 3, 'Tebal'),
(9, 'D', 4, 'Sedang'),
(10, 'C', 7, 'Tipis');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role_id` int(5) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` varchar(30) DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `username`, `password`, `role_id`, `updated_at`, `created_at`, `status`) VALUES
(4, 'Chatrin', 'chatrin@gmail.com', 'chatrin', 'chatrin123', 1, '2020-11-30 14:33:29', '0000-00-00 00:00:00', 'active'),
(5, 'Yunita', 'yunita@gmail.com', 'yunita', 'yunita123', 5, '2020-11-30 14:33:32', '0000-00-00 00:00:00', 'active'),
(6, 'Tono', 'tono@gmail.com', 'tono', 'tono123', 2, '2020-11-30 14:26:02', '0000-00-00 00:00:00', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `no_telepon` char(15) DEFAULT NULL,
  `alamat` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`id`, `nama`, `email`, `no_telepon`, `alamat`) VALUES
(1, 'PT JKT', 'jkt@gmail.com', '0831313131', 'Jl. Sudirman no.12'),
(2, 'PT Makmur', 'makmur@gmail.com', '0813478', 'Jl. Indah Makmur no. 12');

-- --------------------------------------------------------

--
-- Table structure for table `warna`
--

CREATE TABLE `warna` (
  `id` int(8) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `keterangan` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `warna`
--

INSERT INTO `warna` (`id`, `nama`, `keterangan`) VALUES
(2, 'Putih', ''),
(3, 'Merah', ''),
(4, 'Biru', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `beban`
--
ALTER TABLE `beban`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kode_akun_id` (`kode_akun_id`);

--
-- Indexes for table `delivery_order`
--
ALTER TABLE `delivery_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `penjualan_id` (`penjualan_id`);

--
-- Indexes for table `delivery_order_tipe`
--
ALTER TABLE `delivery_order_tipe`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `do`
--
ALTER TABLE `do`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice_id` (`invoice_id`);

--
-- Indexes for table `do_pembelian`
--
ALTER TABLE `do_pembelian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pembelian_id` (`pembelian_id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `produk_id` (`produk_id`),
  ADD KEY `lokasi_id` (`lokasi_id`);

--
-- Indexes for table `inventory_riwayat`
--
ALTER TABLE `inventory_riwayat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id`),
  ADD KEY `perform_invoice_id` (`perform_invoice_id`);

--
-- Indexes for table `invoice_status_pembayaran`
--
ALTER TABLE `invoice_status_pembayaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jenis`
--
ALTER TABLE `jenis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kode_akun`
--
ALTER TABLE `kode_akun`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `lokasi`
--
ALTER TABLE `lokasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `merek`
--
ALTER TABLE `merek`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `pelanggan_info_id` (`pelanggan_info_id`);

--
-- Indexes for table `pelanggan_info`
--
ALTER TABLE `pelanggan_info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pelanggan_tipe_id` (`pelanggan_tipe_id`);

--
-- Indexes for table `pelanggan_tipe`
--
ALTER TABLE `pelanggan_tipe`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vendor_id` (`vendor_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `lokasi_id` (`lokasi_id`);

--
-- Indexes for table `pembelian_detail`
--
ALTER TABLE `pembelian_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pembelian_id` (`pembelian_id`);

--
-- Indexes for table `pembelian_status_pembayaran`
--
ALTER TABLE `pembelian_status_pembayaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pembelian_id` (`pembelian_id`);

--
-- Indexes for table `pembelian_terms_conditions`
--
ALTER TABLE `pembelian_terms_conditions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `terms_conditions_id` (`terms_conditions_id`),
  ADD KEY `pembelian_id` (`pembelian_id`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `rekening_id` (`rekening_id`),
  ADD KEY `pelanggan_id` (`pelanggan_id`);

--
-- Indexes for table `penjualan_detail`
--
ALTER TABLE `penjualan_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `penjualan_id` (`penjualan_id`);

--
-- Indexes for table `penjualan_laporan`
--
ALTER TABLE `penjualan_laporan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `penjualan_id` (`penjualan_id`);

--
-- Indexes for table `penjualan_terms_conditions`
--
ALTER TABLE `penjualan_terms_conditions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `penjualan_id` (`penjualan_id`),
  ADD KEY `terms_conditions_id` (`terms_conditions_id`);

--
-- Indexes for table `perform_invoice`
--
ALTER TABLE `perform_invoice`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sales_quotation_id` (`sales_quotation_id`),
  ADD KEY `purchase_order_pelanggan_id` (`purchase_order_pelanggan_id`);

--
-- Indexes for table `permintaan_barang`
--
ALTER TABLE `permintaan_barang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `penjualan_laporan_id` (`penjualan_laporan_id`);

--
-- Indexes for table `permintaan_pembelian`
--
ALTER TABLE `permintaan_pembelian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice_id` (`invoice_id`),
  ADD KEY `produk_id` (`produk_id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jenis_id` (`jenis_id`),
  ADD KEY `warna_id` (`warna_id`),
  ADD KEY `kategori_id` (`kategori_id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `satuan_id` (`satuan_id`),
  ADD KEY `merek_id` (`merek_id`);

--
-- Indexes for table `profil_perusahaan`
--
ALTER TABLE `profil_perusahaan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rekening_id` (`rekening_id`);

--
-- Indexes for table `purchase_order_pelanggan`
--
ALTER TABLE `purchase_order_pelanggan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pelanggan_id` (`pelanggan_id`);

--
-- Indexes for table `rekening`
--
ALTER TABLE `rekening`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kode_akun_id` (`kode_akun_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_quotation`
--
ALTER TABLE `sales_quotation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pelanggan_id` (`pelanggan_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `sales_quotation_detail`
--
ALTER TABLE `sales_quotation_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sales_quotation_id` (`sales_quotation_id`);

--
-- Indexes for table `sales_quotation_terms_conditions`
--
ALTER TABLE `sales_quotation_terms_conditions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `terms_conditions_id` (`terms_conditions_id`),
  ADD KEY `sales_quotation_id` (`sales_quotation_id`);

--
-- Indexes for table `satuan`
--
ALTER TABLE `satuan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `standard`
--
ALTER TABLE `standard`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jenis_id` (`jenis_id`);

--
-- Indexes for table `terms_conditions`
--
ALTER TABLE `terms_conditions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tipe`
--
ALTER TABLE `tipe`
  ADD PRIMARY KEY (`id`),
  ADD KEY `standard_id` (`standard_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `warna`
--
ALTER TABLE `warna`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `beban`
--
ALTER TABLE `beban`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `delivery_order`
--
ALTER TABLE `delivery_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `delivery_order_tipe`
--
ALTER TABLE `delivery_order_tipe`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `do`
--
ALTER TABLE `do`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `do_pembelian`
--
ALTER TABLE `do_pembelian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `inventory_riwayat`
--
ALTER TABLE `inventory_riwayat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `invoice_status_pembayaran`
--
ALTER TABLE `invoice_status_pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `jenis`
--
ALTER TABLE `jenis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kode_akun`
--
ALTER TABLE `kode_akun`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `lokasi`
--
ALTER TABLE `lokasi`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `merek`
--
ALTER TABLE `merek`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `pelanggan_info`
--
ALTER TABLE `pelanggan_info`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pelanggan_tipe`
--
ALTER TABLE `pelanggan_tipe`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `pembelian_detail`
--
ALTER TABLE `pembelian_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pembelian_status_pembayaran`
--
ALTER TABLE `pembelian_status_pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pembelian_terms_conditions`
--
ALTER TABLE `pembelian_terms_conditions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `penjualan_detail`
--
ALTER TABLE `penjualan_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `penjualan_terms_conditions`
--
ALTER TABLE `penjualan_terms_conditions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `perform_invoice`
--
ALTER TABLE `perform_invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `permintaan_barang`
--
ALTER TABLE `permintaan_barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permintaan_pembelian`
--
ALTER TABLE `permintaan_pembelian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `profil_perusahaan`
--
ALTER TABLE `profil_perusahaan`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `purchase_order_pelanggan`
--
ALTER TABLE `purchase_order_pelanggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `rekening`
--
ALTER TABLE `rekening`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sales_quotation`
--
ALTER TABLE `sales_quotation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `sales_quotation_detail`
--
ALTER TABLE `sales_quotation_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `sales_quotation_terms_conditions`
--
ALTER TABLE `sales_quotation_terms_conditions`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `satuan`
--
ALTER TABLE `satuan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `standard`
--
ALTER TABLE `standard`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `terms_conditions`
--
ALTER TABLE `terms_conditions`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tipe`
--
ALTER TABLE `tipe`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `warna`
--
ALTER TABLE `warna`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `beban`
--
ALTER TABLE `beban`
  ADD CONSTRAINT `beban_ibfk_1` FOREIGN KEY (`kode_akun_id`) REFERENCES `kode_akun` (`id`);

--
-- Constraints for table `delivery_order`
--
ALTER TABLE `delivery_order`
  ADD CONSTRAINT `delivery_order_ibfk_1` FOREIGN KEY (`penjualan_id`) REFERENCES `penjualan` (`id`);

--
-- Constraints for table `do`
--
ALTER TABLE `do`
  ADD CONSTRAINT `do_ibfk_1` FOREIGN KEY (`invoice_id`) REFERENCES `invoice` (`id`);

--
-- Constraints for table `do_pembelian`
--
ALTER TABLE `do_pembelian`
  ADD CONSTRAINT `do_pembelian_ibfk_1` FOREIGN KEY (`pembelian_id`) REFERENCES `pembelian` (`id`);

--
-- Constraints for table `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `inventory_ibfk_1` FOREIGN KEY (`produk_id`) REFERENCES `produk` (`id`),
  ADD CONSTRAINT `inventory_ibfk_2` FOREIGN KEY (`lokasi_id`) REFERENCES `lokasi` (`id`);

--
-- Constraints for table `invoice`
--
ALTER TABLE `invoice`
  ADD CONSTRAINT `invoice_ibfk_2` FOREIGN KEY (`perform_invoice_id`) REFERENCES `perform_invoice` (`id`);

--
-- Constraints for table `log`
--
ALTER TABLE `log`
  ADD CONSTRAINT `log_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD CONSTRAINT `pelanggan_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `pelanggan_ibfk_2` FOREIGN KEY (`pelanggan_info_id`) REFERENCES `pelanggan_info` (`id`);

--
-- Constraints for table `pelanggan_info`
--
ALTER TABLE `pelanggan_info`
  ADD CONSTRAINT `pelanggan_info_ibfk_1` FOREIGN KEY (`pelanggan_tipe_id`) REFERENCES `pelanggan_tipe` (`id`);

--
-- Constraints for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD CONSTRAINT `pembelian_ibfk_1` FOREIGN KEY (`vendor_id`) REFERENCES `vendor` (`id`),
  ADD CONSTRAINT `pembelian_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `pembelian_ibfk_3` FOREIGN KEY (`lokasi_id`) REFERENCES `lokasi` (`id`);

--
-- Constraints for table `pembelian_detail`
--
ALTER TABLE `pembelian_detail`
  ADD CONSTRAINT `pembelian_detail_ibfk_1` FOREIGN KEY (`pembelian_id`) REFERENCES `pembelian` (`id`);

--
-- Constraints for table `pembelian_status_pembayaran`
--
ALTER TABLE `pembelian_status_pembayaran`
  ADD CONSTRAINT `pembelian_status_pembayaran_ibfk_1` FOREIGN KEY (`pembelian_id`) REFERENCES `pembelian` (`id`);

--
-- Constraints for table `pembelian_terms_conditions`
--
ALTER TABLE `pembelian_terms_conditions`
  ADD CONSTRAINT `pembelian_terms_conditions_ibfk_2` FOREIGN KEY (`terms_conditions_id`) REFERENCES `terms_conditions` (`id`),
  ADD CONSTRAINT `pembelian_terms_conditions_ibfk_3` FOREIGN KEY (`pembelian_id`) REFERENCES `pembelian` (`id`);

--
-- Constraints for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD CONSTRAINT `penjualan_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `penjualan_ibfk_3` FOREIGN KEY (`rekening_id`) REFERENCES `rekening` (`id`),
  ADD CONSTRAINT `penjualan_ibfk_4` FOREIGN KEY (`pelanggan_id`) REFERENCES `pelanggan` (`id`);

--
-- Constraints for table `penjualan_detail`
--
ALTER TABLE `penjualan_detail`
  ADD CONSTRAINT `penjualan_detail_ibfk_1` FOREIGN KEY (`penjualan_id`) REFERENCES `penjualan` (`id`);

--
-- Constraints for table `penjualan_laporan`
--
ALTER TABLE `penjualan_laporan`
  ADD CONSTRAINT `penjualan_laporan_ibfk_2` FOREIGN KEY (`penjualan_id`) REFERENCES `penjualan` (`id`);

--
-- Constraints for table `penjualan_terms_conditions`
--
ALTER TABLE `penjualan_terms_conditions`
  ADD CONSTRAINT `penjualan_terms_conditions_ibfk_1` FOREIGN KEY (`penjualan_id`) REFERENCES `penjualan` (`id`),
  ADD CONSTRAINT `penjualan_terms_conditions_ibfk_2` FOREIGN KEY (`terms_conditions_id`) REFERENCES `terms_conditions` (`id`);

--
-- Constraints for table `perform_invoice`
--
ALTER TABLE `perform_invoice`
  ADD CONSTRAINT `perform_invoice_ibfk_1` FOREIGN KEY (`sales_quotation_id`) REFERENCES `sales_quotation` (`id`),
  ADD CONSTRAINT `perform_invoice_ibfk_2` FOREIGN KEY (`purchase_order_pelanggan_id`) REFERENCES `purchase_order_pelanggan` (`id`);

--
-- Constraints for table `permintaan_barang`
--
ALTER TABLE `permintaan_barang`
  ADD CONSTRAINT `permintaan_barang_ibfk_1` FOREIGN KEY (`penjualan_laporan_id`) REFERENCES `penjualan_laporan` (`id`);

--
-- Constraints for table `permintaan_pembelian`
--
ALTER TABLE `permintaan_pembelian`
  ADD CONSTRAINT `permintaan_pembelian_ibfk_1` FOREIGN KEY (`invoice_id`) REFERENCES `invoice` (`id`),
  ADD CONSTRAINT `permintaan_pembelian_ibfk_2` FOREIGN KEY (`produk_id`) REFERENCES `produk` (`id`);

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_ibfk_1` FOREIGN KEY (`jenis_id`) REFERENCES `jenis` (`id`),
  ADD CONSTRAINT `produk_ibfk_2` FOREIGN KEY (`warna_id`) REFERENCES `warna` (`id`),
  ADD CONSTRAINT `produk_ibfk_3` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`id`),
  ADD CONSTRAINT `produk_ibfk_4` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`),
  ADD CONSTRAINT `produk_ibfk_5` FOREIGN KEY (`satuan_id`) REFERENCES `satuan` (`id`),
  ADD CONSTRAINT `produk_ibfk_6` FOREIGN KEY (`merek_id`) REFERENCES `merek` (`id`);

--
-- Constraints for table `profil_perusahaan`
--
ALTER TABLE `profil_perusahaan`
  ADD CONSTRAINT `profil_perusahaan_ibfk_1` FOREIGN KEY (`rekening_id`) REFERENCES `rekening` (`id`);

--
-- Constraints for table `purchase_order_pelanggan`
--
ALTER TABLE `purchase_order_pelanggan`
  ADD CONSTRAINT `purchase_order_pelanggan_ibfk_1` FOREIGN KEY (`pelanggan_id`) REFERENCES `pelanggan` (`id`);

--
-- Constraints for table `rekening`
--
ALTER TABLE `rekening`
  ADD CONSTRAINT `rekening_ibfk_1` FOREIGN KEY (`kode_akun_id`) REFERENCES `kode_akun` (`id`);

--
-- Constraints for table `sales_quotation`
--
ALTER TABLE `sales_quotation`
  ADD CONSTRAINT `sales_quotation_ibfk_1` FOREIGN KEY (`pelanggan_id`) REFERENCES `pelanggan` (`id`),
  ADD CONSTRAINT `sales_quotation_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `sales_quotation_detail`
--
ALTER TABLE `sales_quotation_detail`
  ADD CONSTRAINT `sales_quotation_detail_ibfk_1` FOREIGN KEY (`sales_quotation_id`) REFERENCES `sales_quotation` (`id`);

--
-- Constraints for table `sales_quotation_terms_conditions`
--
ALTER TABLE `sales_quotation_terms_conditions`
  ADD CONSTRAINT `sales_quotation_terms_conditions_ibfk_1` FOREIGN KEY (`terms_conditions_id`) REFERENCES `terms_conditions` (`id`),
  ADD CONSTRAINT `sales_quotation_terms_conditions_ibfk_2` FOREIGN KEY (`sales_quotation_id`) REFERENCES `sales_quotation` (`id`);

--
-- Constraints for table `standard`
--
ALTER TABLE `standard`
  ADD CONSTRAINT `standard_ibfk_1` FOREIGN KEY (`jenis_id`) REFERENCES `jenis` (`id`);

--
-- Constraints for table `tipe`
--
ALTER TABLE `tipe`
  ADD CONSTRAINT `tipe_ibfk_1` FOREIGN KEY (`standard_id`) REFERENCES `standard` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
