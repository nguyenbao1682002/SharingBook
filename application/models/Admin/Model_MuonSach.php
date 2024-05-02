<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_MuonSach extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}

	public function checkNumber()
	{	
		$sql = "SELECT * FROM muonsach";
		$result = $this->db->query($sql);
		return $result->num_rows();
	}

	public function getAll($start = 0, $end = 10){
		$sql = "SELECT muonsach.*, nguoidung.MaNguoiDung AS MNDMuon, nguoidung.TaiKhoan, sach.TenSach, sach.MaSach, sach.AnhChinh, sach.MaNguoiDung AS MNDSach FROM muonsach, sach, nguoidung WHERE muonsach.MaSach = sach.MaSach AND muonsach.MaNguoiDung = nguoidung.MaNguoiDung ORDER BY muonsach.MaMuonSach DESC LIMIT ?, ?";
		$result = $this->db->query($sql, array($start, $end));
		return $result->result_array();
	}

	public function getUserBook($mangoidung){
		$sql = "SELECT * FROM nguoidung WHERE MaNguoiDung = ?";
		$result = $this->db->query($sql, array($mangoidung));
		return $result->result_array();
	}

	public function getById($MaMuonSach){
		$sql = "SELECT muonsach.*, nguoidung.MaNguoiDung AS MNDMuon, nguoidung.TaiKhoan, sach.TenSach, sach.MaSach, sach.AnhChinh, sach.MaNguoiDung AS MNDSach FROM muonsach, sach, nguoidung WHERE muonsach.MaSach = sach.MaSach AND muonsach.MaNguoiDung = nguoidung.MaNguoiDung AND muonsach.MaMuonSach = ?";
		$result = $this->db->query($sql, array($MaMuonSach));
		return $result->result_array();
	}


	public function status($trangthai,$MaMuonSach){
		$sql = "UPDATE muonsach SET TrangThai = ? WHERE MaMuonSach = ?";
		$result = $this->db->query($sql, array($trangthai,$MaMuonSach));
		return $result;
	}

	public function getProductById($masanpham){
		$sql = "SELECT * FROM sanpham WHERE MaSanPham = ?";
		$result = $this->db->query($sql, array($masanpham));
		return $result->result_array();
	}

	public function updateNumberProduct($soluong,$masanpham){
		$sql = "UPDATE sanpham SET SoLuong = ? WHERE MaSanPham = ?";
		$result = $this->db->query($sql, array($soluong,$masanpham));
		return $result;
	}

	public function checkNumberSearch($mamuonsach,$ngaymuon,$ngaytra){
		$sql = "SELECT muonsach.*, nguoidung.MaNguoiDung AS MNDMuon, nguoidung.TaiKhoan, sach.TenSach, sach.MaSach, sach.AnhChinh, sach.MaNguoiDung AS MNDSach FROM muonsach, sach, nguoidung WHERE muonsach.MaSach = sach.MaSach AND muonsach.MaNguoiDung = nguoidung.MaNguoiDung AND (muonsach.MaMuonSach = ? OR DATE(muonsach.ThoiGian) = ? OR muonsach.ThoiGianTra = ?) GROUP BY muonsach.MaMuonSach";
		$result = $this->db->query($sql, array($mamuonsach,$ngaymuon,$ngaytra));
		return $result->num_rows();
	}

	public function search($mamuonsach,$ngaymuon,$ngaytra,$start = 0, $end = 10){
		$sql = "SELECT muonsach.*, nguoidung.MaNguoiDung AS MNDMuon, nguoidung.TaiKhoan, sach.TenSach, sach.MaSach, sach.AnhChinh, sach.MaNguoiDung AS MNDSach FROM muonsach, sach, nguoidung WHERE muonsach.MaSach = sach.MaSach AND muonsach.MaNguoiDung = nguoidung.MaNguoiDung AND (muonsach.MaMuonSach = ? OR DATE(muonsach.ThoiGian) = ? OR muonsach.ThoiGianTra = ?) GROUP BY muonsach.MaMuonSach ORDER BY muonsach.MaMuonSach DESC LIMIT ?, ?";
		$result = $this->db->query($sql, array($mamuonsach,$ngaymuon,$ngaytra,$start,$end));
		return $result->result_array();
	}

}

/* End of file Model_ChuyenMuc.php */
/* Location: ./application/models/Model_ChuyenMuc.php */