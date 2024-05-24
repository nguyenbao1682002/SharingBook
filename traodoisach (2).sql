-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 23, 2024 lúc 05:01 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `traodoisach`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `binhluan`
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
-- Đang đổ dữ liệu cho bảng `binhluan`
--

INSERT INTO `binhluan` (`MaBinhLuan`, `MaNguoiDung`, `MaSach`, `NoiDung`, `SoSao`, `ThoiGian`, `TrangThai`) VALUES
(13, 7, 4, 'hay', 5, '2024-05-06 20:55:08', 1),
(14, 7, 6, 'Sách hay', 4, '2024-05-08 20:55:59', 1),
(15, 6, 4, 'https://drive.google.com/drive/u/0/my-drive', 5, '2024-05-18 23:44:02', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cauhinh`
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
-- Đang đổ dữ liệu cho bảng `cauhinh`
--

INSERT INTO `cauhinh` (`TenWebsite`, `MoTaWeb`, `Logo`, `Favicon`, `DiaChi`, `SoDienThoai`, `Email`, `MaQRNapTien`, `PhiRutTien`, `PhiShip`, `MienPhiShip`) VALUES
('Da Nang Book Sharing', 'Website Cho thuê và Thuê Sách', 'http://localhost/book/uploads/rsz_z5421596391067_b8f71cfff52608b1b5602ed0fbf46578_preview_rev_1_1.png', 'http://localhost/book/uploads/Danang1.png', '52 Trưng nhị Đà Nẵng', '0935430059', 'chiasesach@gmail.com', 'http://localhost/book/uploads/anhQR.jpg', 20, 20000, 100000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chuyenmuc`
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
-- Đang đổ dữ liệu cho bảng `chuyenmuc`
--

INSERT INTO `chuyenmuc` (`MaChuyenMuc`, `TenChuyenMuc`, `HinhAnh`, `DuongDan`, `HienThiTrenMenu`, `TrangThai`) VALUES
(3, 'Thiếu Nhi', 'http://localhost/book/uploads/logosachthieunhi.jpg', 'thieu-nhi', 1, 1),
(4, 'Sách Giáo Khoa', 'http://localhost/book/uploads/hoa_hoc_9_500.png', 'sach-giao-khoa', 1, 1),
(5, 'Kinh Tế', 'http://localhost/book/uploads/images_(1).jpg', 'kinh-te', 1, 1),
(6, 'Kỹ Năng', 'http://localhost/book/uploads/kĩ_năng.jpg', 'ky-nang', 1, 1),
(7, 'Văn Học', 'http://localhost/book/uploads/văn_học.jpg', 'van-hoc', 1, 1),
(8, 'Trinh Thám', 'http://localhost/book/uploads/Mật_mã_davinci.jpg', 'trinh-tham', 1, 1),
(9, 'Truyện Ma', 'http://localhost/book/uploads/Book_sHARING_(1)_preview_rev_11.png', 'truyen-ma', 1, 1),
(10, 'Sách Công Nghệ Thông Tin', 'http://localhost/book/uploads/tải_xuống_(1).jpg', 'sach-cong-nghe-thong-tin', 1, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dongtien`
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
-- Đang đổ dữ liệu cho bảng `dongtien`
--

INSERT INTO `dongtien` (`MaDongTien`, `MaNguoiDung`, `SoTienTruoc`, `SoTienThayDoi`, `SoTienHienTai`, `ThoiGian`, `NoiDung`) VALUES
(34, 6, 0, 100000, 100000, '2024-05-06 16:35:13', 'Admin cộng tiền nạp 100,000 VND vào tài khoản!'),
(35, 7, 0, 200000, 200000, '2024-05-06 16:37:56', 'Admin cộng tiền nạp 200,000 VND vào tài khoản!'),
(36, 7, 11000, 10000, 21000, '2024-05-08 20:51:52', 'Admin cộng tiền nạp 10,000 VND vào tài khoản!'),
(37, 7, 21000, 10000, 11000, '2024-05-08 20:55:03', 'Admin trừ tiền rút 10,000 VND của tài khoản!'),
(38, 7, 11000, 1000, 12000, '2024-05-12 23:41:03', 'Admin cộng 1,000 VND vào tài khoản!'),
(39, 7, 12000, 300000, 312000, '2024-05-15 17:58:54', 'Admin cộng tiền nạp 300,000 VND vào tài khoản!'),
(40, 6, 100000, 200000, 300000, '2024-05-15 17:59:49', 'Admin cộng 200,000 VND vào tài khoản!'),
(41, 8, 0, 700000, 700000, '2024-05-23 21:14:44', 'Admin cộng tiền nạp 700,000 VND vào tài khoản!');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `giaodien`
--

CREATE TABLE `giaodien` (
  `MaGiaoDien` int(11) NOT NULL,
  `MaChuyenMuc` int(11) NOT NULL,
  `HinhAnh` text NOT NULL,
  `LoaiGiaoDien` int(11) NOT NULL,
  `TrangThai` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `giaodien`
--

INSERT INTO `giaodien` (`MaGiaoDien`, `MaChuyenMuc`, `HinhAnh`, `LoaiGiaoDien`, `TrangThai`) VALUES
(3, 3, 'http://localhost/book/uploads/11-15923689744271213595888-crop-159236964752361207729.png', 1, 1),
(4, 7, 'http://localhost/book/uploads/1.jpg', 1, 1),
(5, 4, 'http://localhost/book/uploads/sgk.png', 1, 1),
(6, 10, 'http://localhost/book/uploads/Bia_Nganh_CNTT.jpg', 2, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lienhe`
--

CREATE TABLE `lienhe` (
  `MaNguoiDung` int(11) NOT NULL,
  `TieuDe` text NOT NULL,
  `NoiDung` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `lienhe`
--

INSERT INTO `lienhe` (`MaNguoiDung`, `TieuDe`, `NoiDung`) VALUES
(7, '123', '123'),
(7, 'Làm hỏng sách', 'ssss'),
(6, 'Làm hỏng sách', '123');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `muonsach`
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
-- Đang đổ dữ liệu cho bảng `muonsach`
--

INSERT INTO `muonsach` (`MaMuonSach`, `MaSach`, `MaNguoiDung`, `TongTien`, `ThoiGian`, `ThoiGianTra`, `DiaChi`, `SoLuong`, `TrangThai`) VALUES
(11, 4, 7, 30000, '2024-05-06 16:39:40', '2024-05-31', '52 Trưng nhị, Hòa an, Thanh Khê, Đà Nẵng', 1, 4),
(12, 4, 7, 30000, '2024-05-06 16:43:07', '2024-05-31', '52 Trưng nhị, Hòa an, Thanh Khê, Đà Nẵng', 1, 1),
(13, 4, 7, 30000, '2024-05-06 16:44:06', '2024-05-31', '52 Trưng nhị, Hòa an, Thanh Khê, Đà Nẵng', 1, 0),
(14, 7, 7, 100000, '2024-05-15 18:01:27', '2024-05-17', 'Đại Học Duy Tân Đà Nẵng, Hải Châu, Hải Châu, Đà Nẵng', 1, 3),
(15, 5, 6, 68000, '2024-05-15 18:21:27', '2024-05-24', 'Đại Học Duy Tân Đà Nẵng, Hải Châu, Hải Châu, Đà Nẵng', 1, 3);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `naptien`
--

CREATE TABLE `naptien` (
  `MaNapTien` int(11) NOT NULL,
  `MaNguoiDung` int(11) NOT NULL,
  `SoTienNap` int(11) NOT NULL,
  `ThoiGian` datetime NOT NULL DEFAULT current_timestamp(),
  `TrangThai` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `naptien`
--

INSERT INTO `naptien` (`MaNapTien`, `MaNguoiDung`, `SoTienNap`, `ThoiGian`, `TrangThai`) VALUES
(11, 6, 100000, '2024-05-06 16:34:42', 2),
(12, 7, 200000, '2024-05-06 16:37:47', 2),
(13, 7, 2147483647, '2024-05-06 23:56:53', 1),
(14, 7, 10000, '2024-05-07 12:21:58', 1),
(15, 7, 22222, '2024-05-07 12:23:30', 1),
(16, 7, 10000, '2024-05-08 20:50:49', 1),
(17, 7, 10000, '2024-05-08 20:51:25', 2),
(18, 7, 10000, '2024-05-08 20:51:58', 1),
(19, 7, 300000, '2024-05-15 17:58:40', 2),
(20, 6, 30000, '2024-05-15 18:02:51', 1),
(21, 6, 20000, '2024-05-15 18:05:26', 1),
(22, 8, 700000, '2024-05-23 21:14:35', 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nguoidung`
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
-- Đang đổ dữ liệu cho bảng `nguoidung`
--

INSERT INTO `nguoidung` (`MaNguoiDung`, `AnhChinh`, `TaiKhoan`, `MatKhau`, `SoDienThoai`, `Email`, `HoTen`, `PhanQuyen`, `TenNganHang`, `SoTaiKhoan`, `ChuTaiKhoan`, `NgayThamGia`, `TrangThai`) VALUES
(1, NULL, 'admin', '21232f297a57a5a743894a0e4a801fc3', '0999888999', 'admin@gmail.com', 'Quản Trị Viên', 1, NULL, NULL, NULL, '2024-03-31 16:12:10', 1),
(6, 'http://localhost/book/uploads/2488932b-cb3d-4450-b0a5-c81680c4e13a.png', 'cong', '3de6a8f9608ddd4ba89f97b36d7587d6', '0987456123', 'letrieucong@gmail.com', 'LÊ TRIỆU CÔNG', 0, 'mb bank', '0336595933', 'LE TRIEU CONG', '2024-05-06 16:34:26', 1),
(7, 'https://vnn-imgs-a1.vgcloud.vn/image1.ictnews.vn/_Files/2020/03/17/trend-avatar-1.jpg', 'hoang', 'f82e62d7c3ea69cc12b5cdb8d621dab6', '0702343171', 'hoang@gmail.com', 'Duy Hoàng', 0, 'mb bank', '0702343171', 'THAI TRAN DUY  HOANG', '2024-05-06 16:37:29', 1),
(8, 'https://vnn-imgs-a1.vgcloud.vn/image1.ictnews.vn/_Files/2020/03/17/trend-avatar-1.jpg', 'bao123', 'b6c6cfe1a7ba5eac0f984f3ef97c8490', '0852461608', 'tnb160802@gmail.com', 'Trần Nguyên Bảo', 0, 'MB Bank', '0852461608', 'TRAN NGUYEN BAO', '2024-05-23 20:46:50', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ruttien`
--

CREATE TABLE `ruttien` (
  `MaRutTien` int(11) NOT NULL,
  `MaNguoiDung` int(11) NOT NULL,
  `SoTienRut` int(11) NOT NULL,
  `ThoiGian` datetime NOT NULL DEFAULT current_timestamp(),
  `TrangThai` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `ruttien`
--

INSERT INTO `ruttien` (`MaRutTien`, `MaNguoiDung`, `SoTienRut`, `ThoiGian`, `TrangThai`) VALUES
(7, 7, 10000, '2024-05-08 20:54:51', 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sach`
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
-- Đang đổ dữ liệu cho bảng `sach`
--

INSERT INTO `sach` (`MaSach`, `TenSach`, `MaChuyenMuc`, `MaNguoiDung`, `TacGia`, `GiaMuon`, `GiaGoc`, `AnhChinh`, `HinhAnh`, `MoTaNgan`, `MoTa`, `LoaiSach`, `DuongDan`, `SoLuong`, `TrangThaiMuon`, `TrangThai`) VALUES
(4, 'Nobita Lạc Vào Xứ Quỷ', 3, 6, 'Fujiko Fujo', 10000, 30000, 'http://localhost/book/uploads/images.jpg', 'http://localhost/book/uploads/images1.jpg', '<p>abc</p>', '<p><strong>abcd</strong></p>', 1, 'nobita-lac-vao-xu-quy', 1, 1, 1),
(5, 'Rich Dad, Poor Dad (Cha giàu, cha nghèo)', 8, 7, 'Robert Kiyosaki', 15000, 68000, 'http://localhost/book/uploads/rich_dad_poor_dad_by_robert_t__1607410877_44fb96ac-768x1024-1.jpg', 'http://localhost/book/uploads/th.jpg', '<p>“Cha giàu cha nghèo” là câu chuyện của Robert kể về quá trình lớn lên với hai người cha và cách hai người cha đã định hình suy nghĩ của ông về tiền bạc và đầu tư. Một người là cha ruột có học vấn cao nhưng nghèo khó. Người kia là cha của cậu bạn thân – bỏ học từ năm lớp tám nhưng lại sở hữu khối tài sản khổng lồ.</p>', '<p>Cuốn sách bác bỏ quan niệm sai lầm rằng bạn cần có nhu cầu thu nhập cao để trở nên giàu có và giải thích sự khác biệt giữa làm việc vì tiền và để tiền làm việc cho mình. Có thể coi đây như một quyển nhật ký kể về hồi ức và những bài học được đúc kết từ chính bản thân tác giả.</p>', 1, 'lam-giau', 0, 1, 1),
(6, 'Đắc Nhân Tâm', 10, 7, 'Dale Carnegie', 20000, 86000, 'http://localhost/book/uploads/dăc_nhân_tâm.jpg', 'http://localhost/book/uploads/dăc_nhân_tâm1.jpg', '<p>sách kỹ năng sống</p>', '<p>Đắc nhân tâm, tên tiếng Anh là How to Win Friends and Influence People là một quyển sách nhằm tự giúp bản thân (self-help) bán chạy nhất từ trước đến nay. Quyển sách này do Dale Carnegie viết và đã được xuất bản lần đầu vào năm 1936, nó đã được bán 15 triệu bản trên khắp thế giới. Nó cũng là quyển sách bán chạy nhất của New York Times trong 10 năm. Tác phẩm được đánh giá là cuốn sách đầu tiên và hay nhất trong thể loại này, có ảnh hưởng thay đổi cuộc đời đối với hàng triệu người trên thế giới.&nbsp;</p>', 4, 'dac-nhan-tam', 2, 0, 1),
(7, 'Vòng Tròn Máu', 10, 6, 'james beaardmore', 20000, 100000, 'http://localhost/book/uploads/vòng_tròn_máu.jpg', 'http://localhost/book/uploads/vòng_tròn_máu1.jpg', '<p>\"Vòng Tròn Máu\" của tác giả James Beaardmore</p>', '<p>Một Quyển sách vô cùng hay về trinh thám</p>', 4, 'vong-tron-mau', 1, 1, 1),
(8, 'Information Technology An Introduction for Today’s Digital World', 10, 8, 'Richard Fox', 30000, 50000, 'http://localhost/book/uploads/tải_xuống.jpg', 'http://localhost/book/uploads/tải_xuống1.jpg', '<p>Suitable for any introductory IT course, this classroom-tested text presents many of the topics recommended by the ACM Special Interest Group on IT Education (SIGITE). It offers a far more detailed examination of the computer and IT fields than computer literacy texts, focusing on concepts essential to all IT professionals – from system administration to scripting to computer organization. Four chapters are dedicated to the Windows and Linux operating systems so that students can gain hands-on experience with operating systems that they will deal with in the real world.</p>', '<p>This revised edition has more breadth and depth of coverage than the first edition. Information Technology: An Introduction for Today’s Digital World introduces undergraduate students to a wide variety of concepts that they will encounter throughout their IT studies and careers. The features of this edition include: Introductory system administration coverage of Windows 10 and Linux (Red Hat 7), both as general concepts and with specific hands-on instruction Coverage of programming and shell scripting, demonstrated through example code in several popular languages Updated information on modern IT careers Computer networks, including more content on cloud computing Improved coverage of computer security Ancillary material that includes a lab manual for hands-on exercises</p>', 3, 'information-technology-an-introduction-for-today’s-digital-world', 1, 0, 1),
(9, 'Lập trình và cuộc sống', 10, 8, 'Jeff Atwood', 30000, 60000, 'http://localhost/book/uploads/z4649417922496-7c58b0d2ed14cdb2933d0fe185edf550-1633.jpg', 'http://localhost/book/uploads/z4649417922496-7c58b0d2ed14cdb2933d0fe185edf550-16331.jpg', '<p>Là tác phẩm kết hợp giữa lĩnh vực CNTT và cuộc sống cá nhân, tạo nên một góc nhìn độc đáo về cách lập trình có thể ảnh hưởng đến cả khía cạnh con người. Không chỉ đơn thuần là một cuốn sách hướng dẫn về kỹ thuật lập trình, Jeff Atwood mang lại góc nhìn cá nhân và chân thành về cuộc hành trình của một lập trình viên. Tác giả kể chuyện mình bắt đầu học lập trình, những thách thức và bài học cùng với trải nghiệm thú vị trong quá trình phát triển sự nghiệp.</p>', '<p>Ông tận dụng các ví dụ và tình huống từ cuộc sống hàng ngày để minh họa cách lập trình có thể giải quyết những vấn đề thực tế. Từ quản lý thời gian đến làm việc nhóm, tất cả được nhấn mạnh trong bối cảnh của một lập trình viên. Tuy nhiên, nếu đang tìm kiếm một tài liệu tập trung nhiều vào khía cạnh kỹ thuật của lập trình, có thể bạn sẽ cảm thấy thiếu điều này trong cuốn sách của Jeff Atwood.</p>', 3, 'lap-trinh-va-cuoc-song', 1, 0, 1),
(10, 'Thinking In Java', 10, 8, 'Bruce Eckel', 25000, 45000, 'http://localhost/book/uploads/z4649417933097-b8c577cea69d94f387764b428dd89ea0-1634.jpg', 'http://localhost/book/uploads/61mOMxUuDBL__AC_UF1000,1000_QL80_.jpg', '<p><i>Thinking In Java</i> là một tài liệu quan trọng cho bất kỳ lập trình viên Java nào. Cuốn sách giúp bạn hiểu sâu về Java từ việc trình bày cú pháp và tính năng của ngôn ngữ, cách hình thành tư duy lập trình viên chất lượng và thấu hiểu về các nguyên tắc thiết kế lập trình.</p>', '<p>Cuốn sách này không chỉ giúp người đọc hiểu rõ về ngôn ngữ lập trình Java mà còn hỗ trợ hình thành tư duy lập trình hướng đối tượng.</p><p>Từ cách khai báo biến, quản lý bộ nhớ đến việc sử dụng các tính năng của Java như đa hình, kế thừa và giao diện, Bruce Eckel đã thể hiện khả năng giảng dạy rất tốt trong việc truyền đạt kiến thức một cách dễ hiểu. Không chỉ dừng lại ở cách viết mã nguồn, ông còn nói đến các nguyên tắc thiết kế và quy tắc trong lập trình, giúp người đọc phát triển khả năng viết mã sạch, dễ đọc và dễ bảo trì.</p>', 2, 'thinking-in-java', 1, 0, 1),
(11, 'Code dạo ký sự - Lập trình viên đâu chỉ biết Code', 10, 8, 'Phạm Huy Hoàng', 40000, 70000, 'http://localhost/book/uploads/2021_06_26_10_12_25_1-390x510.jpg', 'http://localhost/book/uploads/z4649417885638-4cbea84bb81a4d10097f95c1725e1928-1635.jpg', '<p>Sau quá trình du học, tác giả Phạm Huy Hoàng mong muốn chia sẻ những kinh nghiệm khi theo học lập trình và kỹ năng tích lũy được qua cuốn <i>Code dạo ký sự - Lập trình viên đâu chỉ biết Code</i> với giọng văn hài hước để người đọc có thể cảm nhận được những trải nghiệm thú vị về lập trình, những bài học từ thất bại và thành công nằm giữa dòng code.</p><p><br>&nbsp;</p>', '<p>Tác giả không chỉ giới hạn cuốn sách trong việc trình bày về mã nguồn và kiến thức kỹ thuật, mà còn đưa ra cái nhìn tổng thể về cuộc sống và sự phát triển của một lập trình viên, những trải nghiệm, suy tư và cảm xúc trong hành trình sáng tạo và học hỏi.&nbsp;</p><p>Phạm Huy Hoàng không ngần ngại chia sẻ thách thức mà một lập trình viên phải đối mặt, từ việc hiểu lầm đồng nghiệp cho đến khoảnh khắc cảm giác bế tắc với việc giải quyết vấn đề. Điểm ấn tượng của cuốn sách là cách người viết liên kết giữa lập trình và cuộc sống thường ngày.&nbsp;</p>', 2, 'code-dao-ky-su---lap-trinh-vien-dau-chi-biet-code', 1, 0, 1),
(12, 'Cảm xúc là kẻ thù số 1 của thành công', 6, 7, 'TS Lê Thẩm Dương', 40000, 60000, 'http://localhost/book/uploads/can-xuc.png', 'http://localhost/book/uploads/can-xuc1.png', '<p>Hay</p>', '<p>HAY</p>', 1, 'cam-xuc-la-ke-thu-so-1-cua-thanh-cong', 1, 0, 1),
(13, 'Dám Nghĩ Lớn', 6, 7, 'David J. Schwartz. Ph.D', 50000, 60000, 'http://localhost/book/uploads/nhasachmienphi-dam-nghi-lon2.jpg', 'http://localhost/book/uploads/nhasachmienphi-dam-nghi-lon3.jpg', '<p><strong>Dám Nghĩ Lớn</strong>! – tác phẩm nổi tiếng thế giới về những ý tưởng và phương pháp tư duy độc đáo và hiệu quả đã làm thay đổi một cách kỳ diệu cuộc đời của hàng triệu người qua nhiều thế hệ. Qua quyển sách này, Tiến sĩ David Schwartz trình bày một cách sinh động và dễ hiểu cách tư duy giúp bạn đạt được mục tiêu cao nhất trong công việc, cuộc sống và trong cộng đồng của bạn. Bạn không cần phải thông minh tuyệt đỉnh hay tài năng xuất chúng mới đạt được thành công lớn lao, bạn chỉ cần rèn luyện và áp dụng thường xuyên tư duy Dám Nghĩ Lớn. Và đây là những điều diệu kỳ mà cuốn sách sẽ mang đến cho bạn:</p><p>Đưa bạn đến thành công bằng sức mạnh của niềm tin của chính mình</p><p>&nbsp;</p><p>Giúp bạn vượt lên khỏi sự ám ảnh thất bại và nỗi sợ hãi</p><p>&nbsp;</p><p>Giúp bạn suy nghĩ và thực hiện ước mơ một cách sáng tạo nhất</p><p>Khám phá tại sao năng lực tư duy lại quan trọng hơn trí thông minh</p><p>Xác định rõ mục tiêu chiến lược từng giai đoạn cuộc đời</p><p>Cách suy nghĩ như một nhà lãnh đạo hàng đầu</p><p>Suy nghĩ đột phá, tin vào sự đột phá, thúc đẩy sự đột phá</p>', '<p><strong>Dám Nghĩ Lớn</strong>! – tác phẩm nổi tiếng thế giới về những ý tưởng và phương pháp tư duy độc đáo và hiệu quả đã làm thay đổi một cách kỳ diệu cuộc đời của hàng triệu người qua nhiều thế hệ. Qua quyển sách này, Tiến sĩ David Schwartz trình bày một cách sinh động và dễ hiểu cách tư duy giúp bạn đạt được mục tiêu cao nhất trong công việc, cuộc sống và trong cộng đồng của bạn. Bạn không cần phải thông minh tuyệt đỉnh hay tài năng xuất chúng mới đạt được thành công lớn lao, bạn chỉ cần rèn luyện và áp dụng thường xuyên tư duy Dám Nghĩ Lớn. Và đây là những điều diệu kỳ mà cuốn sách sẽ mang đến cho bạn:</p><p>Đưa bạn đến thành công bằng sức mạnh của niềm tin của chính mình</p><p>&nbsp;</p><p>Giúp bạn vượt lên khỏi sự ám ảnh thất bại và nỗi sợ hãi</p><p>&nbsp;</p><p>Giúp bạn suy nghĩ và thực hiện ước mơ một cách sáng tạo nhất</p><p>Khám phá tại sao năng lực tư duy lại quan trọng hơn trí thông minh</p><p>Xác định rõ mục tiêu chiến lược từng giai đoạn cuộc đời</p><p>Cách suy nghĩ như một nhà lãnh đạo hàng đầu</p><p>Suy nghĩ đột phá, tin vào sự đột phá, thúc đẩy sự đột phá</p>', 1, 'dam-nghi-lon', 2, 0, 1),
(14, 'Đàn ông sao hoả đàn bà sao kim', 6, 6, 'Jhone Gray', 70000, 80000, 'http://localhost/book/uploads/Đàn-ông-sao-hoả-đàn-bà-sao-kim.jpeg', 'http://localhost/book/uploads/Đàn-ông-sao-hoả-đàn-bà-sao-kim1.jpeg', '<p>Hầu hết những ai đọc cuốn sách này đều có thể cải thiện chất lượng mối quan hệ mà họ đang có. Chắc chắn bạn sẽ khám phá ra những ý niệm mới mẻ để cải thiện việc giao tiếp và đạt được những mục đích của riêng mình.</p><p>Thậm chí nếu một ý tưởng nào đó có thể giúp bạn thấu hiểu cũng như hỗ trợ cho bạn đời, bạn bè, đồng nghiệp, cha mẹ hoặc con cái, thì điều đó cũng xứng đáng với sự quan tâm và thời gian mà bạn đã đầu tư cho nó rồi.</p>', '<p>Hầu hết những ai đọc cuốn sách này đều có thể cải thiện chất lượng mối quan hệ mà họ đang có. Chắc chắn bạn sẽ khám phá ra những ý niệm mới mẻ để cải thiện việc giao tiếp và đạt được những mục đích của riêng mình.</p><p>Thậm chí nếu một ý tưởng nào đó có thể giúp bạn thấu hiểu cũng như hỗ trợ cho bạn đời, bạn bè, đồng nghiệp, cha mẹ hoặc con cái, thì điều đó cũng xứng đáng với sự quan tâm và thời gian mà bạn đã đầu tư cho nó rồi.</p>', 1, 'dan-ong-sao-hoa-dan-ba-sao-kim', 1, 0, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tocao`
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
-- Đang đổ dữ liệu cho bảng `tocao`
--

INSERT INTO `tocao` (`MaToCao`, `MaNguoiDung`, `NanNhan`, `TieuDe`, `NoiDung`, `ThoiGian`, `TrangThai`) VALUES
(8, 7, 6, 'ăn trộm sách', 'ăn trộm', '2024-05-06 20:56:15', 3),
(9, 7, 6, 'Làm hỏng sách', 'Người thuê này làm ướt sách của tôi vui lòng xem xét', '2024-05-08 21:00:33', 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `vitien`
--

CREATE TABLE `vitien` (
  `MaViTien` int(11) NOT NULL,
  `MaNguoiDung` int(11) NOT NULL,
  `SoDuKhaDung` int(11) NOT NULL,
  `DaSuDung` int(11) NOT NULL,
  `TongNap` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `vitien`
--

INSERT INTO `vitien` (`MaViTien`, `MaNguoiDung`, `SoDuKhaDung`, `DaSuDung`, `TongNap`) VALUES
(4, 6, 205200, 94800, 100000),
(5, 7, 202000, 299000, 510000),
(6, 8, 700000, 0, 700000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `yeuthich`
--

CREATE TABLE `yeuthich` (
  `MaYeuThich` int(11) NOT NULL,
  `MaSach` int(11) NOT NULL,
  `MaNguoiDung` int(11) NOT NULL,
  `TrangThai` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `yeuthich`
--

INSERT INTO `yeuthich` (`MaYeuThich`, `MaSach`, `MaNguoiDung`, `TrangThai`) VALUES
(23, 7, 6, 1);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `binhluan`
--
ALTER TABLE `binhluan`
  ADD PRIMARY KEY (`MaBinhLuan`),
  ADD KEY `MaNguoiDung` (`MaNguoiDung`,`MaSach`),
  ADD KEY `MaSach` (`MaSach`);

--
-- Chỉ mục cho bảng `chuyenmuc`
--
ALTER TABLE `chuyenmuc`
  ADD PRIMARY KEY (`MaChuyenMuc`);

--
-- Chỉ mục cho bảng `dongtien`
--
ALTER TABLE `dongtien`
  ADD PRIMARY KEY (`MaDongTien`),
  ADD KEY `MaNguoiDung` (`MaNguoiDung`);

--
-- Chỉ mục cho bảng `giaodien`
--
ALTER TABLE `giaodien`
  ADD PRIMARY KEY (`MaGiaoDien`),
  ADD KEY `MaChuyenMuc` (`MaChuyenMuc`);

--
-- Chỉ mục cho bảng `muonsach`
--
ALTER TABLE `muonsach`
  ADD PRIMARY KEY (`MaMuonSach`),
  ADD KEY `MaNguoiDung` (`MaNguoiDung`),
  ADD KEY `MaSach` (`MaSach`);

--
-- Chỉ mục cho bảng `naptien`
--
ALTER TABLE `naptien`
  ADD PRIMARY KEY (`MaNapTien`),
  ADD KEY `MaNguoiDung` (`MaNguoiDung`);

--
-- Chỉ mục cho bảng `nguoidung`
--
ALTER TABLE `nguoidung`
  ADD PRIMARY KEY (`MaNguoiDung`);

--
-- Chỉ mục cho bảng `ruttien`
--
ALTER TABLE `ruttien`
  ADD PRIMARY KEY (`MaRutTien`),
  ADD KEY `MaNguoiDung` (`MaNguoiDung`);

--
-- Chỉ mục cho bảng `sach`
--
ALTER TABLE `sach`
  ADD PRIMARY KEY (`MaSach`),
  ADD KEY `MaChuyenMuc` (`MaChuyenMuc`),
  ADD KEY `MaNguoiDung` (`MaNguoiDung`);

--
-- Chỉ mục cho bảng `tocao`
--
ALTER TABLE `tocao`
  ADD PRIMARY KEY (`MaToCao`),
  ADD KEY `MaNguoiDung` (`MaNguoiDung`);

--
-- Chỉ mục cho bảng `vitien`
--
ALTER TABLE `vitien`
  ADD PRIMARY KEY (`MaViTien`),
  ADD KEY `MaNguoiDung` (`MaNguoiDung`);

--
-- Chỉ mục cho bảng `yeuthich`
--
ALTER TABLE `yeuthich`
  ADD PRIMARY KEY (`MaYeuThich`),
  ADD KEY `MaSach` (`MaSach`,`MaNguoiDung`),
  ADD KEY `MaNguoiDung` (`MaNguoiDung`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `binhluan`
--
ALTER TABLE `binhluan`
  MODIFY `MaBinhLuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `chuyenmuc`
--
ALTER TABLE `chuyenmuc`
  MODIFY `MaChuyenMuc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `dongtien`
--
ALTER TABLE `dongtien`
  MODIFY `MaDongTien` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT cho bảng `giaodien`
--
ALTER TABLE `giaodien`
  MODIFY `MaGiaoDien` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `muonsach`
--
ALTER TABLE `muonsach`
  MODIFY `MaMuonSach` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `naptien`
--
ALTER TABLE `naptien`
  MODIFY `MaNapTien` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT cho bảng `nguoidung`
--
ALTER TABLE `nguoidung`
  MODIFY `MaNguoiDung` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `ruttien`
--
ALTER TABLE `ruttien`
  MODIFY `MaRutTien` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `sach`
--
ALTER TABLE `sach`
  MODIFY `MaSach` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `tocao`
--
ALTER TABLE `tocao`
  MODIFY `MaToCao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `vitien`
--
ALTER TABLE `vitien`
  MODIFY `MaViTien` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `yeuthich`
--
ALTER TABLE `yeuthich`
  MODIFY `MaYeuThich` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `binhluan`
--
ALTER TABLE `binhluan`
  ADD CONSTRAINT `binhluan_ibfk_1` FOREIGN KEY (`MaSach`) REFERENCES `sach` (`MaSach`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `binhluan_ibfk_2` FOREIGN KEY (`MaNguoiDung`) REFERENCES `nguoidung` (`MaNguoiDung`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Các ràng buộc cho bảng `dongtien`
--
ALTER TABLE `dongtien`
  ADD CONSTRAINT `dongtien_ibfk_1` FOREIGN KEY (`MaNguoiDung`) REFERENCES `nguoidung` (`MaNguoiDung`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Các ràng buộc cho bảng `giaodien`
--
ALTER TABLE `giaodien`
  ADD CONSTRAINT `giaodien_ibfk_1` FOREIGN KEY (`MaChuyenMuc`) REFERENCES `chuyenmuc` (`MaChuyenMuc`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Các ràng buộc cho bảng `muonsach`
--
ALTER TABLE `muonsach`
  ADD CONSTRAINT `muonsach_ibfk_1` FOREIGN KEY (`MaNguoiDung`) REFERENCES `nguoidung` (`MaNguoiDung`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `muonsach_ibfk_2` FOREIGN KEY (`MaSach`) REFERENCES `sach` (`MaSach`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Các ràng buộc cho bảng `naptien`
--
ALTER TABLE `naptien`
  ADD CONSTRAINT `naptien_ibfk_1` FOREIGN KEY (`MaNguoiDung`) REFERENCES `nguoidung` (`MaNguoiDung`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Các ràng buộc cho bảng `ruttien`
--
ALTER TABLE `ruttien`
  ADD CONSTRAINT `ruttien_ibfk_1` FOREIGN KEY (`MaNguoiDung`) REFERENCES `nguoidung` (`MaNguoiDung`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Các ràng buộc cho bảng `sach`
--
ALTER TABLE `sach`
  ADD CONSTRAINT `sach_ibfk_1` FOREIGN KEY (`MaNguoiDung`) REFERENCES `nguoidung` (`MaNguoiDung`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `sach_ibfk_2` FOREIGN KEY (`MaChuyenMuc`) REFERENCES `chuyenmuc` (`MaChuyenMuc`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `tocao`
--
ALTER TABLE `tocao`
  ADD CONSTRAINT `tocao_ibfk_1` FOREIGN KEY (`MaNguoiDung`) REFERENCES `nguoidung` (`MaNguoiDung`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Các ràng buộc cho bảng `vitien`
--
ALTER TABLE `vitien`
  ADD CONSTRAINT `vitien_ibfk_1` FOREIGN KEY (`MaNguoiDung`) REFERENCES `nguoidung` (`MaNguoiDung`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Các ràng buộc cho bảng `yeuthich`
--
ALTER TABLE `yeuthich`
  ADD CONSTRAINT `yeuthich_ibfk_1` FOREIGN KEY (`MaNguoiDung`) REFERENCES `nguoidung` (`MaNguoiDung`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
