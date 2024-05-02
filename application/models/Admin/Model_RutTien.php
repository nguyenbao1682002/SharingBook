<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_RutTien extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}

	public function checkNumber()
	{
		$sql = "SELECT ruttien.*, nguoidung.MaNguoiDung, nguoidung.TaiKhoan, nguoidung.AnhChinh FROM nguoidung, ruttien WHERE nguoidung.PhanQuyen = 0 AND nguoidung.MaNguoiDung = ruttien.MaNguoiDung";
		$result = $this->db->query($sql);
		return $result->num_rows();
	}

	public function getAll($start = 0, $end = 10){
		$sql = "SELECT ruttien.*, nguoidung.MaNguoiDung, nguoidung.TaiKhoan, nguoidung.AnhChinh FROM nguoidung, ruttien WHERE nguoidung.PhanQuyen = 0 AND nguoidung.MaNguoiDung = ruttien.MaNguoiDung ORDER BY ruttien.MaRutTien DESC LIMIT ?, ?";
		$result = $this->db->query($sql, array($start, $end));
		return $result->result_array();
	}

	public function getById($MaRutTien){
		$sql = "SELECT ruttien.*, nguoidung.TenNganHang, nguoidung.TaiKhoan, nguoidung.SoTaiKhoan, nguoidung.ChuTaiKhoan FROM nguoidung, ruttien WHERE nguoidung.PhanQuyen = 0 AND nguoidung.MaNguoiDung = ruttien.MaNguoiDung AND ruttien.MaRutTien = ?";
		$result = $this->db->query($sql, array($MaRutTien));
		return $result->result_array();
	}


	public function accept($MaRutTien){
		$sql = "UPDATE ruttien SET TrangThai = 2 WHERE MaRutTien = ?";
		$result = $this->db->query($sql, array($MaRutTien));
		return $result;
	}

	public function cancel($MaRutTien){
		$sql = "UPDATE ruttien SET TrangThai = 0 WHERE MaRutTien = ?";
		$result = $this->db->query($sql, array($MaRutTien));
		return $result;
	}

	public function checkNumberSearch($taikhoan,$trangthai){
		$taikhoan = "%".$taikhoan."%";
		$sql = "SELECT ruttien.*, nguoidung.MaNguoiDung, nguoidung.TaiKhoan, nguoidung.AnhChinh FROM nguoidung, ruttien WHERE nguoidung.PhanQuyen = 0 AND nguoidung.MaNguoiDung = ruttien.MaNguoiDung AND (nguoidung.TaiKhoan LIKE ? OR ruttien.TrangThai = ?)";
		$result = $this->db->query($sql, array($taikhoan,$trangthai));
		return $result->num_rows();
	}

	public function search($taikhoan, $trangthai, $start = 0, $end = 10){
		$taikhoan = "%".$taikhoan."%";
		$sql = "SELECT ruttien.*, nguoidung.MaNguoiDung, nguoidung.TaiKhoan, nguoidung.AnhChinh FROM nguoidung, ruttien WHERE nguoidung.PhanQuyen = 0 AND nguoidung.MaNguoiDung = ruttien.MaNguoiDung AND (nguoidung.TaiKhoan LIKE ? OR ruttien.TrangThai = ?) ORDER BY ruttien.MaRutTien DESC LIMIT ?, ?";
		$result = $this->db->query($sql, array($taikhoan,$trangthai,$start,$end));
		return $result->result_array();
	}

}

/* End of file Model_ChuyenMuc.php */
/* Location: ./application/models/Model_ChuyenMuc.php */