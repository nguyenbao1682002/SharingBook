<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_MuonSach extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}

	public function checkNumber($manguoidung)
	{	
		$sql = "SELECT muonsach.*, nguoidung.MaNguoiDung AS MNDMuon, nguoidung.TaiKhoan, sach.TenSach, sach.MaSach, sach.AnhChinh, sach.MaNguoiDung AS MNDSach FROM muonsach, sach, nguoidung WHERE muonsach.MaSach = sach.MaSach AND muonsach.MaNguoiDung = nguoidung.MaNguoiDung AND sach.MaNguoiDung = ?";
		$result = $this->db->query($sql, array($manguoidung));
		return $result->num_rows();
	}

	public function getAll($manguoidung, $start = 0, $end = 10){
		$sql = "SELECT muonsach.*, nguoidung.MaNguoiDung AS MNDMuon, nguoidung.TaiKhoan, sach.TenSach, sach.MaSach, sach.AnhChinh, sach.MaNguoiDung AS MNDSach FROM muonsach, sach, nguoidung WHERE muonsach.MaSach = sach.MaSach AND muonsach.MaNguoiDung = nguoidung.MaNguoiDung AND sach.MaNguoiDung = ? ORDER BY muonsach.MaMuonSach DESC LIMIT ?, ?";
		$result = $this->db->query($sql, array($manguoidung, $start, $end));
		return $result->result_array();
	}

	public function getUserBook($mangoidung){
		$sql = "SELECT * FROM nguoidung WHERE MaNguoiDung = ?";
		$result = $this->db->query($sql, array($mangoidung));
		return $result->result_array();
	}

	public function getById($manguoidung,$MaMuonSach){
		$sql = "SELECT muonsach.*, nguoidung.MaNguoiDung AS MNDMuon, nguoidung.TaiKhoan, sach.TenSach, sach.MaSach, sach.AnhChinh, sach.MaNguoiDung AS MNDSach FROM muonsach, sach, nguoidung WHERE muonsach.MaSach = sach.MaSach AND muonsach.MaNguoiDung = nguoidung.MaNguoiDung AND sach.MaNguoiDung = ? AND muonsach.MaMuonSach = ?";
		$result = $this->db->query($sql, array($manguoidung,$MaMuonSach));
		return $result->result_array();
	}


	public function status($trangthai,$MaMuonSach){
		$sql = "UPDATE muonsach SET TrangThai = ? WHERE MaMuonSach = ?";
		$result = $this->db->query($sql, array($trangthai,$MaMuonSach));
		return $result;
	}


	public function checkNumberSearch($manguoidung,$mamuonsach,$ngaymuon,$ngaytra){
		$sql = "SELECT muonsach.*, nguoidung.MaNguoiDung AS MNDMuon, nguoidung.TaiKhoan, sach.TenSach, sach.MaSach, sach.AnhChinh, sach.MaNguoiDung AS MNDSach FROM muonsach, sach, nguoidung WHERE muonsach.MaSach = sach.MaSach AND muonsach.MaNguoiDung = nguoidung.MaNguoiDung AND sach.MaNguoiDung = ? AND (muonsach.MaMuonSach = ? OR DATE(muonsach.ThoiGian) = ? OR muonsach.ThoiGianTra = ?) GROUP BY muonsach.MaMuonSach";
		$result = $this->db->query($sql, array($manguoidung,$mamuonsach,$ngaymuon,$ngaytra));
		return $result->num_rows();
	}

	public function search($manguoidung,$mamuonsach,$ngaymuon,$ngaytra,$start = 0, $end = 10){
		$sql = "SELECT muonsach.*, nguoidung.MaNguoiDung AS MNDMuon, nguoidung.TaiKhoan, sach.TenSach, sach.MaSach, sach.AnhChinh, sach.MaNguoiDung AS MNDSach FROM muonsach, sach, nguoidung WHERE muonsach.MaSach = sach.MaSach AND muonsach.MaNguoiDung = nguoidung.MaNguoiDung AND sach.MaNguoiDung = ? AND (muonsach.MaMuonSach = ? OR DATE(muonsach.ThoiGian) = ? OR muonsach.ThoiGianTra = ?) GROUP BY muonsach.MaMuonSach ORDER BY muonsach.MaMuonSach DESC LIMIT ?, ?";
		$result = $this->db->query($sql, array($manguoidung,$mamuonsach,$ngaymuon,$ngaytra,$start,$end));
		return $result->result_array();
	}

	public function number($soluong, $masach){
		$sql = "UPDATE sach SET SoLuong = ? WHERE MaSach = ?";
		$result = $this->db->query($sql, array($soluong,$masach));
		return $result;
	}

	public function bookMuon($soluong, $masach){
		$sql = "UPDATE sach SET TrangThaiMuon = ? WHERE MaSach = ?";
		$result = $this->db->query($sql, array($soluong,$masach));
		return $result;
	}

}

/* End of file Model_ChuyenMuc.php */
/* Location: ./application/models/Model_ChuyenMuc.php */