<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_NguoiDung extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}

	public function checkNumber()
	{
		$sql = "SELECT * FROM nguoidung WHERE PhanQuyen = 0";
		$result = $this->db->query($sql);
		return $result->num_rows();
	}

	public function getAll($start = 0, $end = 10){
		$sql = "SELECT * FROM nguoidung WHERE PhanQuyen = 0 ORDER BY MaNguoiDung DESC LIMIT ?, ?";
		$result = $this->db->query($sql, array($start, $end));
		return $result->result_array();
	}

	public function getById($MaNguoiDung){
		$sql = "SELECT * FROM nguoidung WHERE MaNguoiDung = ? AND PhanQuyen = 0";
		$result = $this->db->query($sql, array($MaNguoiDung));
		return $result->result_array();
	}

	public function updateStatus($TrangThai,$MaNguoiDung){
		$sql = "UPDATE nguoidung SET TrangThai = ? WHERE MaNguoiDung = ?";
		$result = $this->db->query($sql, array($TrangThai,$MaNguoiDung));
		return $result;
	}

	public function getWallet($manguoidung){
		$sql = "SELECT * FROM vitien WHERE MaNguoiDung = ?";
		$result = $this->db->query($sql, array($manguoidung));
		return $result->result_array();
	}

	public function updateMoneyWallet($sotienmoi,$tongnap,$manguoidung){
		$sql = "UPDATE vitien SET SoDuKhaDung = ?, TongNap = ? WHERE MaNguoiDung = ?";
		$result = $this->db->query($sql, array($sotienmoi,$tongnap,$manguoidung));
		return $result;
	}

	public function insertCashFlow($manguoidung,$sotiencu,$sotiencong,$sotienmoi,$noidung){
		$sql = "INSERT INTO dongtien(MaNguoiDung,SoTienTruoc,SoTienThayDoi,SoTienHienTai,NoiDung) VALUES(?,?,?,?,?)";
		$result = $this->db->query($sql, array($manguoidung,$sotiencu,$sotiencong,$sotienmoi,$noidung));
		return $result;
	}

	public function getCashFlow($manguoidung,$start = 0, $end = 10)
	{
		$sql = "SELECT * FROM dongtien WHERE MaNguoiDung = ? ORDER BY MaDongTien DESC LIMIT ?, ?";
		$result = $this->db->query($sql, array($manguoidung, $start, $end));
		return $result->result_array();
	}

	public function checkNumberCashFlow($manguoidung)
	{
		$sql = "SELECT * FROM dongtien WHERE MaNguoiDung = ?";
		$result = $this->db->query($sql,array($manguoidung));
		return $result->num_rows();
	}

	public function checkNumberSearch($taikhoan,$trangthai){
		$taikhoan = '%'.$taikhoan.'%';
		$sql = "SELECT * FROM nguoidung WHERE PhanQuyen = 0 AND (TaiKhoan LIKE ? OR TrangThai = ?)";
		$result = $this->db->query($sql,array($taikhoan, $trangthai));
		return $result->num_rows();
	}

	public function search($taikhoan,$trangthai,$start = 0,$end = 10)
	{
		$taikhoan = '%'.$taikhoan.'%';
		$sql = "SELECT * FROM nguoidung WHERE PhanQuyen = 0 AND (TaiKhoan LIKE ? OR TrangThai = ?) ORDER BY MaNguoiDung DESC LIMIT ?, ?";
		$result = $this->db->query($sql, array($taikhoan, $trangthai, $start, $end));
		return $result->result_array();
	}

	public function getIdUser($TaiKhoan){
		$sql = "SELECT * FROM nguoidung WHERE TaiKhoan = ?";
		$result = $this->db->query($sql, array($TaiKhoan));
		return $result->result_array();
	}

}

/* End of file Model_ChuyenMuc.php */
/* Location: ./application/models/Model_ChuyenMuc.php */