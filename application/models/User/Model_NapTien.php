<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_NapTien extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}

	public function checkNumber()
	{
		$sql = "SELECT naptien.*, nguoidung.MaNguoiDung, nguoidung.TaiKhoan, nguoidung.AnhChinh FROM nguoidung, naptien WHERE nguoidung.PhanQuyen = 0 AND nguoidung.MaNguoiDung = naptien.MaNguoiDung";
		$result = $this->db->query($sql);
		return $result->num_rows();
	}

	public function getAll($start = 0, $end = 10){
		$sql = "SELECT naptien.*, nguoidung.MaNguoiDung, nguoidung.TaiKhoan, nguoidung.AnhChinh FROM nguoidung, naptien WHERE nguoidung.PhanQuyen = 0 AND nguoidung.MaNguoiDung = naptien.MaNguoiDung ORDER BY naptien.Manaptien DESC LIMIT ?, ?";
		$result = $this->db->query($sql, array($start, $end));
		return $result->result_array();
	}

	public function getById($Manaptien){
		$sql = "SELECT naptien.*, nguoidung.TenNganHang, nguoidung.TaiKhoan, nguoidung.SoTaiKhoan, nguoidung.ChuTaiKhoan FROM nguoidung, naptien WHERE nguoidung.PhanQuyen = 0 AND nguoidung.MaNguoiDung = naptien.MaNguoiDung AND naptien.Manaptien = ?";
		$result = $this->db->query($sql, array($Manaptien));
		return $result->result_array();
	}


	public function accept($Manaptien){
		$sql = "UPDATE naptien SET TrangThai = 2 WHERE Manaptien = ?";
		$result = $this->db->query($sql, array($Manaptien));
		return $result;
	}

	public function cancel($Manaptien){
		$sql = "UPDATE naptien SET TrangThai = 0 WHERE Manaptien = ?";
		$result = $this->db->query($sql, array($Manaptien));
		return $result;
	}

	public function checkNumberSearch($taikhoan,$trangthai){
		$taikhoan = "%".$taikhoan."%";
		$sql = "SELECT naptien.*, nguoidung.MaNguoiDung, nguoidung.TaiKhoan, nguoidung.AnhChinh FROM nguoidung, naptien WHERE nguoidung.PhanQuyen = 0 AND nguoidung.MaNguoiDung = naptien.MaNguoiDung AND (nguoidung.TaiKhoan LIKE ? OR naptien.TrangThai = ?)";
		$result = $this->db->query($sql, array($taikhoan,$trangthai));
		return $result->num_rows();
	}

	public function search($taikhoan, $trangthai, $start = 0, $end = 10){
		$taikhoan = "%".$taikhoan."%";
		$sql = "SELECT naptien.*, nguoidung.MaNguoiDung, nguoidung.TaiKhoan, nguoidung.AnhChinh FROM nguoidung, naptien WHERE nguoidung.PhanQuyen = 0 AND nguoidung.MaNguoiDung = naptien.MaNguoiDung AND (nguoidung.TaiKhoan LIKE ? OR naptien.TrangThai = ?) ORDER BY naptien.Manaptien DESC LIMIT ?, ?";
		$result = $this->db->query($sql, array($taikhoan,$trangthai,$start,$end));
		return $result->result_array();
	}

}

/* End of file Model_ChuyenMuc.php */
/* Location: ./application/models/Model_ChuyenMuc.php */