-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 02, 2024 at 04:18 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `traodoisach`
--

-- --------------------------------------------------------

--
-- Table structure for table `binhluan`
--

CREATE TABLE `binhluan` (
  `MaBinhLuan` int(11) NOT NULL,
  `MaNguoiDung` int(11) NOT NULL,
  `MaSach` int(11) NOT NULL,
  `NoiDung` varchar(500) NOT NULL,
  `SoSao` int(11) NOT NULL DEFAULT 0,
  `ThoiGian` datetime NOT NULL DEFAULT current_timestamp(),
  `TrangThai` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `binhluan`
--

INSERT INTO `binhluan` (`MaBinhLuan`, `MaNguoiDung`, `MaSach`, `NoiDung`, `SoSao`, `ThoiGian`, `TrangThai`) VALUES
(1, 3, 1, 'Không tốt', 4, '2024-04-03 15:59:36', 1),
(2, 3, 1, 'ABCDE', 1, '2024-04-03 16:48:09', 1),
(3, 2, 3, 'Test cmt', 2, '2024-05-02 08:51:23', 1),
(4, 2, 1, 'đọc cũng bình thường', 3, '2024-05-02 18:15:49', 1),
(5, 2, 1, 'bình luận thứ 2', 5, '2024-05-02 18:17:44', 1),
(6, 2, 1, '111', 5, '2024-05-02 18:25:04', 1),
(7, 2, 1, 'tạm ổn', 3, '2024-05-02 18:26:17', 1),
(9, 2, 1, 'test lại', 5, '2024-05-02 18:31:50', 1),
(10, 2, 3, 'ok', 5, '2024-05-02 18:37:37', 1),
(11, 5, 3, 'hay', 5, '2024-05-02 21:12:20', 1),
(12, 5, 3, 'tệ\n', 1, '2024-05-02 21:13:57', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cauhinh`
--

CREATE TABLE `cauhinh` (
  `TenWebsite` text NOT NULL,
  `MoTaWeb` text NOT NULL,
  `Logo` text NOT NULL,
  `Favicon` text NOT NULL,
  `DiaChi` text NOT NULL,
  `SoDienThoai` text NOT NULL,
  `Email` text NOT NULL,
  `MaQRNapTien` text NOT NULL,
  `PhiRutTien` int(11) NOT NULL DEFAULT 1,
  `PhiShip` int(11) NOT NULL,
  `MienPhiShip` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cauhinh`
--

INSERT INTO `cauhinh` (`TenWebsite`, `MoTaWeb`, `Logo`, `Favicon`, `DiaChi`, `SoDienThoai`, `Email`, `MaQRNapTien`, `PhiRutTien`, `PhiShip`, `MienPhiShip`) VALUES
('Website ABC', 'Website ABC', 'http://localhost/book/uploads/logo_dark1.png', 'http://localhost/book/uploads/logo_dark2.png', 'Website ABC', '0999999999', 'chiasesach@gmail.com', 'http://localhost/book/uploads/qrson5.jpg', 20, 30000, 50000);

-- --------------------------------------------------------

--
-- Table structure for table `chuyenmuc`
--

CREATE TABLE `chuyenmuc` (
  `MaChuyenMuc` int(11) NOT NULL,
  `TenChuyenMuc` varchar(255) NOT NULL,
  `HinhAnh` text NOT NULL,
  `DuongDan` text NOT NULL,
  `HienThiTrenMenu` int(11) NOT NULL DEFAULT 0,
  `TrangThai` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `chuyenmuc`
--

INSERT INTO `chuyenmuc` (`MaChuyenMuc`, `TenChuyenMuc`, `HinhAnh`, `DuongDan`, `HienThiTrenMenu`, `TrangThai`) VALUES
(1, 'Mục mới', 'http://localhost/book/uploads/33000000266641.jpg', 'muc-moi', 1, 1),
(2, 'Mục mới 2', 'http://localhost/book/uploads/z4617362804277_275c9f23eb1124b7f6a8496671f60b2520.jpg', 'muc-moi-2', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `dongtien`
--

CREATE TABLE `dongtien` (
  `MaDongTien` int(11) NOT NULL,
  `MaNguoiDung` int(11) NOT NULL,
  `SoTienTruoc` int(11) NOT NULL,
  `SoTienThayDoi` int(11) NOT NULL,
  `SoTienHienTai` int(11) NOT NULL,
  `ThoiGian` datetime NOT NULL DEFAULT current_timestamp(),
  `NoiDung` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `dongtien`
--

INSERT INTO `dongtien` (`MaDongTien`, `MaNguoiDung`, `SoTienTruoc`, `SoTienThayDoi`, `SoTienHienTai`, `ThoiGian`, `NoiDung`) VALUES
(14, 2, 0, 5000000, 5000000, '2024-03-31 00:40:57', 'Admin cộng 5,000,000 VND vào tài khoản!'),
(15, 2, 5000000, 100000, 4900000, '2024-04-01 00:41:00', 'Admin trừ 100,000 VND khỏi tài khoản!'),
(16, 3, 150000, 100000, 50000, '2024-04-01 19:43:39', 'Admin trừ tiền rút 100,000 VND của tài khoản!'),
(17, 3, 50000, 500000, 550000, '2024-04-01 19:44:28', 'Admin cộng 500,000 VND vào tài khoản!'),
(18, 3, 550000, 100000, 450000, '2024-04-01 19:44:40', 'Admin trừ tiền rút 100,000 VND của tài khoản!'),
(19, 2, 4900000, 100000, 4800000, '2024-04-04 18:06:16', 'Admin trừ tiền rút 100,000 VND của tài khoản!'),
(20, 2, 4950000, 150000, 5100000, '2024-04-04 18:53:33', 'Admin cộng tiền nạp 150,000 VND vào tài khoản!'),
(21, 3, 450000, 100000, 550000, '2024-04-04 18:54:13', 'Admin cộng tiền nạp 100,000 VND vào tài khoản!'),
(22, 3, 550000, 100000, 650000, '2024-04-04 18:55:05', 'Admin cộng tiền nạp 100,000 VND vào tài khoản!'),
(23, 3, 650000, 400000, 250000, '2024-04-04 19:27:05', 'Admin trừ 400,000 VND khỏi tài khoản!'),
(24, 2, 720500, 150000, 870500, '2024-04-10 20:02:14', 'Admin cộng tiền nạp 150,000 VND vào tài khoản!'),
(25, 2, 870500, 150000, 1020500, '2024-04-10 20:12:35', 'Admin cộng tiền nạp 150,000 VND vào tài khoản!'),
(26, 2, 1020500, 20500, 1000000, '2024-05-02 00:24:26', 'Admin trừ 20,500 VND khỏi tài khoản!'),
(27, 2, 1000000, 150000, 1150000, '2024-05-02 16:29:07', 'Admin cộng tiền nạp 150,000 VND vào tài khoản!'),
(28, 2, 1150000, 1000000, 150000, '2024-05-02 17:13:53', 'Admin trừ tiền rút 1,000,000 VND của tài khoản!'),
(29, 2, 150000, 150000, 0, '2024-05-02 17:14:36', 'Admin trừ tiền rút 150,000 VND của tài khoản!'),
(30, 2, 0, 1500000, 1500000, '2024-05-02 17:23:10', 'Admin cộng tiền nạp 1,500,000 VND vào tài khoản!'),
(31, 2, 1500000, 500000, 2000000, '2024-05-02 20:47:43', 'Admin cộng tiền nạp 500,000 VND vào tài khoản!'),
(32, 2, 2000000, 200000, 2200000, '2024-05-02 20:48:05', 'Admin cộng tiền nạp 200,000 VND vào tài khoản!'),
(33, 5, 0, 500000, 500000, '2024-05-02 21:11:57', 'Admin cộng tiền nạp 500,000 VND vào tài khoản!');

-- --------------------------------------------------------

--
-- Table structure for table `giaodien`
--

CREATE TABLE `giaodien` (
  `MaGiaoDien` int(11) NOT NULL,
  `MaChuyenMuc` int(11) NOT NULL,
  `HinhAnh` text NOT NULL,
  `LoaiGiaoDien` int(11) NOT NULL,
  `TrangThai` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `giaodien`
--

INSERT INTO `giaodien` (`MaGiaoDien`, `MaChuyenMuc`, `HinhAnh`, `LoaiGiaoDien`, `TrangThai`) VALUES
(1, 1, 'http://localhost/book/uploads/z4617362817818_39cacdb57658e537cb0e22dc18e885d831.jpg', 2, 1),
(2, 1, 'http://localhost/book/uploads/z4617362745335_4456bfd0f397a69bb165e385ba8916cb4.jpg', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `muonsach`
--

CREATE TABLE `muonsach` (
  `MaMuonSach` int(11) NOT NULL,
  `MaSach` int(11) NOT NULL,
  `MaNguoiDung` int(11) NOT NULL,
  `TongTien` int(11) NOT NULL,
  `ThoiGian` datetime NOT NULL DEFAULT current_timestamp(),
  `ThoiGianTra` date NOT NULL,
  `DiaChi` text NOT NULL,
  `SoLuong` int(11) NOT NULL DEFAULT 1,
  `TrangThai` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `muonsach`
--

INSERT INTO `muonsach` (`MaMuonSach`, `MaSach`, `MaNguoiDung`, `TongTien`, `ThoiGian`, `ThoiGianTra`, `DiaChi`, `SoLuong`, `TrangThai`) VALUES
(8, 1, 3, 15000, '2024-04-27 21:58:20', '2024-04-28', 'Tầng 2 số nhà 3, Ngõ ABC, Đường XYZ, Mai Dịch, Cầu Giấy, Hà Nội', 1, 4),
(9, 2, 2, 15000, '2024-05-02 00:10:51', '2024-05-04', 'ABCDE', 1, 4),
(10, 3, 3, 100000, '2024-05-02 20:11:51', '2024-05-10', 'Tầng 2 số nhà 3, Ngõ ABC, Đường XYZ, Mai Dịch, Cầu Giấy, Hà Nội', 2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `naptien`
--

CREATE TABLE `naptien` (
  `MaNapTien` int(11) NOT NULL,
  `MaNguoiDung` int(11) NOT NULL,
  `SoTienNap` int(11) NOT NULL,
  `ThoiGian` datetime NOT NULL DEFAULT current_timestamp(),
  `TrangThai` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `naptien`
--

INSERT INTO `naptien` (`MaNapTien`, `MaNguoiDung`, `SoTienNap`, `ThoiGian`, `TrangThai`) VALUES
(1, 3, 100000, '2024-04-04 18:41:31', 2),
(2, 2, 150000, '2024-04-04 18:41:43', 0),
(4, 2, 150000, '2024-04-10 20:01:30', 2),
(5, 2, 150000, '2024-04-10 20:12:23', 2),
(6, 2, 150000, '2024-05-02 16:27:38', 2),
(7, 2, 1500000, '2024-05-02 17:22:57', 2),
(8, 2, 500000, '2024-05-02 20:47:36', 2),
(9, 2, 200000, '2024-05-02 20:47:55', 2),
(10, 5, 500000, '2024-05-02 21:11:31', 2);

-- --------------------------------------------------------

--
-- Table structure for table `nguoidung`
--

CREATE TABLE `nguoidung` (
  `MaNguoiDung` int(11) NOT NULL,
  `AnhChinh` text DEFAULT NULL,
  `TaiKhoan` varchar(255) NOT NULL,
  `MatKhau` varchar(255) NOT NULL,
  `SoDienThoai` varchar(11) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `HoTen` varchar(255) NOT NULL,
  `PhanQuyen` int(11) NOT NULL DEFAULT 0,
  `TenNganHang` varchar(255) DEFAULT NULL,
  `SoTaiKhoan` varchar(255) DEFAULT NULL,
  `ChuTaiKhoan` varchar(255) DEFAULT NULL,
  `NgayThamGia` datetime NOT NULL DEFAULT current_timestamp(),
  `TrangThai` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `nguoidung`
--

INSERT INTO `nguoidung` (`MaNguoiDung`, `AnhChinh`, `TaiKhoan`, `MatKhau`, `SoDienThoai`, `Email`, `HoTen`, `PhanQuyen`, `TenNganHang`, `SoTaiKhoan`, `ChuTaiKhoan`, `NgayThamGia`, `TrangThai`) VALUES
(1, NULL, 'admin', '21232f297a57a5a743894a0e4a801fc3', '0999888999', 'admin@gmail.com', 'Quản Trị Viên', 1, NULL, NULL, NULL, '2024-03-31 16:12:10', 1),
(2, 'http://localhost/book/uploads/qrson4.jpg', 'chuminhnam', '206dcce3f82cf8981d316e7900dc8e06', '0379962045', 'chuminhnam@gmail.com', 'Chu Minh Nam', 0, 'MB BANK', '050505050505', 'CHU MINH NAM', '2024-03-31 16:12:10', 1),
(3, 'https://vnn-imgs-a1.vgcloud.vn/image1.ictnews.vn/_Files/2020/03/17/trend-avatar-1.jpg', 'nguyenvanbinh', '8cfd26e7161b75586f17fb7a3fc6ad59', '0999999999', 'nguyenvanbinh@gmail.com', 'Nguyễn Văn Bình', 0, 'MB BANK', '1110001141662', 'NGUYEN VAN BINH', '2024-04-01 14:16:28', 1),
(5, 'https://vnn-imgs-a1.vgcloud.vn/image1.ictnews.vn/_Files/2020/03/17/trend-avatar-1.jpg', 'nguyenvanchung', '36a00d76edeef3128c3918786dc4e10d', '0568999666', 'nguyenvanchung@gmail.com', 'Nguyễn Văn Chung', 0, 'MB BANK', '1110110246810', 'NGUYEN VAN CHUNG', '2024-05-02 21:10:11', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ruttien`
--

CREATE TABLE `ruttien` (
  `MaRutTien` int(11) NOT NULL,
  `MaNguoiDung` int(11) NOT NULL,
  `SoTienRut` int(11) NOT NULL,
  `ThoiGian` datetime NOT NULL DEFAULT current_timestamp(),
  `TrangThai` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ruttien`
--

INSERT INTO `ruttien` (`MaRutTien`, `MaNguoiDung`, `SoTienRut`, `ThoiGian`, `TrangThai`) VALUES
(1, 2, 100000, '2024-04-01 18:41:15', 2),
(2, 3, 100000, '2024-04-01 18:41:15', 2),
(3, 2, 1000000, '2024-05-02 17:12:52', 2),
(4, 2, 150000, '2024-05-02 17:14:14', 1),
(5, 2, 150000, '2024-05-02 17:14:18', 2),
(6, 2, 1200000, '2024-05-02 17:23:37', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sach`
--

CREATE TABLE `sach` (
  `MaSach` int(11) NOT NULL,
  `TenSach` varchar(255) NOT NULL,
  `MaChuyenMuc` int(11) NOT NULL,
  `MaNguoiDung` int(11) NOT NULL,
  `TacGia` varchar(255) NOT NULL,
  `GiaMuon` int(11) NOT NULL,
  `GiaGoc` int(11) NOT NULL,
  `AnhChinh` text NOT NULL,
  `HinhAnh` text NOT NULL,
  `MoTaNgan` text NOT NULL,
  `MoTa` text NOT NULL,
  `LoaiSach` int(11) NOT NULL DEFAULT 1,
  `DuongDan` text NOT NULL,
  `SoLuong` int(11) NOT NULL DEFAULT 1,
  `TrangThaiMuon` int(11) NOT NULL DEFAULT 0,
  `TrangThai` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sach`
--

INSERT INTO `sach` (`MaSach`, `TenSach`, `MaChuyenMuc`, `MaNguoiDung`, `TacGia`, `GiaMuon`, `GiaGoc`, `AnhChinh`, `HinhAnh`, `MoTaNgan`, `MoTa`, `LoaiSach`, `DuongDan`, `SoLuong`, `TrangThaiMuon`, `TrangThai`) VALUES
(1, 'Sách Nối', 2, 2, 'Nam Chu Minh', 10000, 15000, 'http://localhost/book/uploads/33000000266644.jpg', 'http://localhost/book/uploads/33000000266645.jpg', '<p>abcde</p>', '<p>abcde</p>', 2, 'sach-noi-1', 5, 0, 1),
(2, 'Sách mới kiểm tra', 2, 2, 'Nguyễn Văn An', 10000, 15000, 'http://localhost/book/uploads/qrson2.jpg', 'http://localhost/book/uploads/qrson3.jpg', '<p>ABCDE</p>', '<p>ABCDE</p>', 3, 'sach-moi-kiem-tra', 15, 0, 1),
(3, 'Sách mới kiểm tra test', 2, 2, 'Nguyễn Văn An', 30000, 50000, 'http://localhost/book/uploads/z4617362764788_9dae16f7c421e020eeb4418f62eeb52e11.jpg', 'http://localhost/book/uploads/z4617362745335_4456bfd0f397a69bb165e385ba8916cb5.jpg', '<p>abcde</p>', '<p>abcde</p>', 1, 'sach-moi-kiem-tra-2', 2, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tocao`
--

CREATE TABLE `tocao` (
  `MaToCao` int(11) NOT NULL,
  `MaNguoiDung` int(11) NOT NULL,
  `NanNhan` int(11) NOT NULL,
  `TieuDe` varchar(255) NOT NULL,
  `NoiDung` text NOT NULL,
  `ThoiGian` datetime NOT NULL DEFAULT current_timestamp(),
  `TrangThai` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tocao`
--

INSERT INTO `tocao` (`MaToCao`, `MaNguoiDung`, `NanNhan`, `TieuDe`, `NoiDung`, `ThoiGian`, `TrangThai`) VALUES
(1, 2, 3, 'Tố cáo 1', 'Nội dung tố cáo 1', '2024-04-03 18:10:19', -1),
(2, 2, 3, 'ABCDE', 'ABCDE', '2024-04-03 19:27:29', -1),
(3, 3, 2, 'FGHG', 'abcde', '2024-04-03 19:28:19', 0),
(4, 3, 2, 'Tố cáo mẫu', 'tố cáo', '2024-04-27 22:30:46', 1),
(5, 3, 2, 'Tố cáo mẫu', 'tố cáo', '2024-04-27 22:32:16', 1),
(6, 3, 2, 'ABCDE', 'AAAA', '2024-04-27 22:32:41', 0),
(7, 3, 2, 'Tố cáo', 'tố cáo', '2024-05-02 00:49:56', 1);

-- --------------------------------------------------------

--
-- Table structure for table `vitien`
--

CREATE TABLE `vitien` (
  `MaViTien` int(11) NOT NULL,
  `MaNguoiDung` int(11) NOT NULL,
  `SoDuKhaDung` int(11) NOT NULL,
  `DaSuDung` int(11) NOT NULL,
  `TongNap` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `vitien`
--

INSERT INTO `vitien` (`MaViTien`, `MaNguoiDung`, `SoDuKhaDung`, `DaSuDung`, `TongNap`) VALUES
(1, 2, 2200000, 79500, 700000),
(2, 3, 93500, 170700, 1500000),
(3, 5, 500000, 0, 500000);

-- --------------------------------------------------------

--
-- Table structure for table `yeuthich`
--

CREATE TABLE `yeuthich` (
  `MaYeuThich` int(11) NOT NULL,
  `MaSach` int(11) NOT NULL,
  `MaNguoiDung` int(11) NOT NULL,
  `TrangThai` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `yeuthich`
--

INSERT INTO `yeuthich` (`MaYeuThich`, `MaSach`, `MaNguoiDung`, `TrangThai`) VALUES
(12, 0, 3, 1),
(19, 3, 3, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `binhluan`
--
ALTER TABLE `binhluan`
  ADD PRIMARY KEY (`MaBinhLuan`),
  ADD KEY `MaNguoiDung` (`MaNguoiDung`,`MaSach`),
  ADD KEY `MaSach` (`MaSach`);

--
-- Indexes for table `chuyenmuc`
--
ALTER TABLE `chuyenmuc`
  ADD PRIMARY KEY (`MaChuyenMuc`);

--
-- Indexes for table `dongtien`
--
ALTER TABLE `dongtien`
  ADD PRIMARY KEY (`MaDongTien`),
  ADD KEY `MaNguoiDung` (`MaNguoiDung`);

--
-- Indexes for table `giaodien`
--
ALTER TABLE `giaodien`
  ADD PRIMARY KEY (`MaGiaoDien`),
  ADD KEY `MaChuyenMuc` (`MaChuyenMuc`);

--
-- Indexes for table `muonsach`
--
ALTER TABLE `muonsach`
  ADD PRIMARY KEY (`MaMuonSach`),
  ADD KEY `MaNguoiDung` (`MaNguoiDung`),
  ADD KEY `MaSach` (`MaSach`);

--
-- Indexes for table `naptien`
--
ALTER TABLE `naptien`
  ADD PRIMARY KEY (`MaNapTien`),
  ADD KEY `MaNguoiDung` (`MaNguoiDung`);

--
-- Indexes for table `nguoidung`
--
ALTER TABLE `nguoidung`
  ADD PRIMARY KEY (`MaNguoiDung`);

--
-- Indexes for table `ruttien`
--
ALTER TABLE `ruttien`
  ADD PRIMARY KEY (`MaRutTien`),
  ADD KEY `MaNguoiDung` (`MaNguoiDung`);

--
-- Indexes for table `sach`
--
ALTER TABLE `sach`
  ADD PRIMARY KEY (`MaSach`),
  ADD KEY `MaChuyenMuc` (`MaChuyenMuc`),
  ADD KEY `MaNguoiDung` (`MaNguoiDung`);

--
-- Indexes for table `tocao`
--
ALTER TABLE `tocao`
  ADD PRIMARY KEY (`MaToCao`),
  ADD KEY `MaNguoiDung` (`MaNguoiDung`);

--
-- Indexes for table `vitien`
--
ALTER TABLE `vitien`
  ADD PRIMARY KEY (`MaViTien`),
  ADD KEY `MaNguoiDung` (`MaNguoiDung`);

--
-- Indexes for table `yeuthich`
--
ALTER TABLE `yeuthich`
  ADD PRIMARY KEY (`MaYeuThich`),
  ADD KEY `MaSach` (`MaSach`,`MaNguoiDung`),
  ADD KEY `MaNguoiDung` (`MaNguoiDung`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `binhluan`
--
ALTER TABLE `binhluan`
  MODIFY `MaBinhLuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `chuyenmuc`
--
ALTER TABLE `chuyenmuc`
  MODIFY `MaChuyenMuc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `dongtien`
--
ALTER TABLE `dongtien`
  MODIFY `MaDongTien` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `giaodien`
--
ALTER TABLE `giaodien`
  MODIFY `MaGiaoDien` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `muonsach`
--
ALTER TABLE `muonsach`
  MODIFY `MaMuonSach` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `naptien`
--
ALTER TABLE `naptien`
  MODIFY `MaNapTien` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `nguoidung`
--
ALTER TABLE `nguoidung`
  MODIFY `MaNguoiDung` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ruttien`
--
ALTER TABLE `ruttien`
  MODIFY `MaRutTien` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sach`
--
ALTER TABLE `sach`
  MODIFY `MaSach` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tocao`
--
ALTER TABLE `tocao`
  MODIFY `MaToCao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `vitien`
--
ALTER TABLE `vitien`
  MODIFY `MaViTien` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `yeuthich`
--
ALTER TABLE `yeuthich`
  MODIFY `MaYeuThich` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `binhluan`
--
ALTER TABLE `binhluan`
  ADD CONSTRAINT `binhluan_ibfk_1` FOREIGN KEY (`MaSach`) REFERENCES `sach` (`MaSach`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `binhluan_ibfk_2` FOREIGN KEY (`MaNguoiDung`) REFERENCES `nguoidung` (`MaNguoiDung`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `dongtien`
--
ALTER TABLE `dongtien`
  ADD CONSTRAINT `dongtien_ibfk_1` FOREIGN KEY (`MaNguoiDung`) REFERENCES `nguoidung` (`MaNguoiDung`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `giaodien`
--
ALTER TABLE `giaodien`
  ADD CONSTRAINT `giaodien_ibfk_1` FOREIGN KEY (`MaChuyenMuc`) REFERENCES `chuyenmuc` (`MaChuyenMuc`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `muonsach`
--
ALTER TABLE `muonsach`
  ADD CONSTRAINT `muonsach_ibfk_1` FOREIGN KEY (`MaNguoiDung`) REFERENCES `nguoidung` (`MaNguoiDung`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `muonsach_ibfk_2` FOREIGN KEY (`MaSach`) REFERENCES `sach` (`MaSach`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `naptien`
--
ALTER TABLE `naptien`
  ADD CONSTRAINT `naptien_ibfk_1` FOREIGN KEY (`MaNguoiDung`) REFERENCES `nguoidung` (`MaNguoiDung`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `ruttien`
--
ALTER TABLE `ruttien`
  ADD CONSTRAINT `ruttien_ibfk_1` FOREIGN KEY (`MaNguoiDung`) REFERENCES `nguoidung` (`MaNguoiDung`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `sach`
--
ALTER TABLE `sach`
  ADD CONSTRAINT `sach_ibfk_1` FOREIGN KEY (`MaNguoiDung`) REFERENCES `nguoidung` (`MaNguoiDung`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `sach_ibfk_2` FOREIGN KEY (`MaChuyenMuc`) REFERENCES `chuyenmuc` (`MaChuyenMuc`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tocao`
--
ALTER TABLE `tocao`
  ADD CONSTRAINT `tocao_ibfk_1` FOREIGN KEY (`MaNguoiDung`) REFERENCES `nguoidung` (`MaNguoiDung`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `vitien`
--
ALTER TABLE `vitien`
  ADD CONSTRAINT `vitien_ibfk_1` FOREIGN KEY (`MaNguoiDung`) REFERENCES `nguoidung` (`MaNguoiDung`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `yeuthich`
--
ALTER TABLE `yeuthich`
  ADD CONSTRAINT `yeuthich_ibfk_1` FOREIGN KEY (`MaNguoiDung`) REFERENCES `nguoidung` (`MaNguoiDung`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
