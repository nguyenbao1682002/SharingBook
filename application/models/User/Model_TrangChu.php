<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_TrangChu extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}

	public function countBook($manguoidung){
		$sql = "SELECT COALESCE(COUNT(*), 0) AS TongSach FROM sach WHERE TrangThai = 1 AND MaNguoiDung = ?";
		$result = $this->db->query($sql, array($manguoidung));
		return $result->result_array();
	}

	public function doanhThuNgay($manguoidung){
		$sql = "SELECT COALESCE(SUM(muonsach.TongTien), 0) AS DoanhThuNgay FROM muonsach, sach, nguoidung WHERE muonsach.MaSach = sach.MaSach AND muonsach.MaNguoiDung = nguoidung.MaNguoiDung AND sach.MaNguoiDung = ? AND DAY(muonsach.ThoiGian) = DAY(CURDATE()) AND MONTH(muonsach.ThoiGian) = MONTH(CURDATE()) AND YEAR(muonsach.ThoiGian) = YEAR(CURDATE())";
		$result = $this->db->query($sql, array($manguoidung));
		return $result->result_array();
	}

	public function choMuonNgay($manguoidung){
		$sql = "SELECT COALESCE(SUM(muonsach.SoLuong), 0) AS ChoMuonNgay FROM muonsach, sach, nguoidung WHERE muonsach.MaSach = sach.MaSach AND muonsach.MaNguoiDung = nguoidung.MaNguoiDung AND sach.MaNguoiDung = ? AND DAY(muonsach.ThoiGian) = DAY(CURDATE()) AND MONTH(muonsach.ThoiGian) = MONTH(CURDATE()) AND YEAR(muonsach.ThoiGian) = YEAR(CURDATE())";
		$result = $this->db->query($sql, array($manguoidung));
		return $result->result_array();
	}

	public function traTrongNgay($manguoidung){
		$sql = "SELECT COALESCE(SUM(muonsach.SoLuong), 0) AS TraTrongNgay FROM muonsach, sach, nguoidung WHERE muonsach.MaSach = sach.MaSach AND muonsach.MaNguoiDung = nguoidung.MaNguoiDung AND sach.MaNguoiDung = ? AND DAY(muonsach.ThoiGian) = DAY(CURDATE()) AND MONTH(muonsach.ThoiGian) = MONTH(CURDATE()) AND YEAR(muonsach.ThoiGian) = YEAR(CURDATE()) AND muonsach.TrangThai = 4";
		$result = $this->db->query($sql, array($manguoidung));
		return $result->result_array();
	}

	public function doanhThuTuan($manguoidung){
		$sql = "SELECT COALESCE(SUM(muonsach.TongTien), 0) AS DoanhThuTuan FROM muonsach, sach, nguoidung WHERE muonsach.MaSach = sach.MaSach AND muonsach.MaNguoiDung = nguoidung.MaNguoiDung AND sach.MaNguoiDung = ? AND muonsach.ThoiGian BETWEEN DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND CURDATE() + 1";
		$result = $this->db->query($sql, array($manguoidung));
		return $result->result_array();
	}

	public function choMuonTuan($manguoidung){
		$sql = "SELECT COALESCE(SUM(muonsach.SoLuong), 0) AS ChoMuonTuan FROM muonsach, sach, nguoidung WHERE muonsach.MaSach = sach.MaSach AND muonsach.MaNguoiDung = nguoidung.MaNguoiDung AND sach.MaNguoiDung = ? AND muonsach.ThoiGian BETWEEN DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND CURDATE() + 1";
		$result = $this->db->query($sql, array($manguoidung));
		return $result->result_array();
	}

	public function traTrongTuan($manguoidung){
		$sql = "SELECT COALESCE(SUM(muonsach.SoLuong), 0) AS TraTrongTuan FROM muonsach, sach, nguoidung WHERE muonsach.MaSach = sach.MaSach AND muonsach.MaNguoiDung = nguoidung.MaNguoiDung AND sach.MaNguoiDung = ? AND muonsach.ThoiGian BETWEEN DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND CURDATE() + 1 AND muonsach.TrangThai = 4";
		$result = $this->db->query($sql, array($manguoidung));
		return $result->result_array();
	}

	public function getSumRevenue($thang, $manguoidung){
		$sql = "SELECT SUM(TongTien) AS TongTien FROM muonsach, sach WHERE sach.MaSach = muonsach.MaSach AND MONTH(ThoiGian) = ? AND YEAR(ThoiGian) = YEAR(CURDATE()) AND sach.MaNguoiDung = ?";
		$result = $this->db->query($sql, array($thang,$manguoidung));
		return $result->result_array();
	}

	public function getSumOrder($thang, $manguoidung){
		$sql = "SELECT SUM(muonsach.SoLuong) AS TongDon FROM muonsach, sach WHERE sach.MaSach = muonsach.MaSach AND MONTH(ThoiGian) = ? AND YEAR(ThoiGian) = YEAR(CURDATE()) AND sach.MaNguoiDung = ?";
		$result = $this->db->query($sql, array($thang,$manguoidung));
		return $result->result_array();
	}
}

/* End of file Model_TrangChu.php */
/* Location: ./application/models/Model_TrangChu.php */