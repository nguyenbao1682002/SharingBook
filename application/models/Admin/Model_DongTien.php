<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_DongTien extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}

	public function checkNumber()
	{
		$sql = "SELECT dongtien.*, nguoidung.TaiKhoan, nguoidung.AnhChinh FROM dongtien, nguoidung WHERE dongtien.MaNguoiDung = nguoidung.MaNguoiDung AND nguoidung.PhanQuyen = 0";
		$result = $this->db->query($sql);
		return $result->num_rows();
	}

	public function getAll($start = 0, $end = 10){
		$sql = "SELECT dongtien.*, nguoidung.TaiKhoan, nguoidung.AnhChinh FROM dongtien, nguoidung WHERE nguoidung.PhanQuyen = 0 AND dongtien.MaNguoiDung = nguoidung.MaNguoiDung ORDER BY dongtien.MaDongTien DESC LIMIT ?, ?";
		$result = $this->db->query($sql, array($start, $end));
		return $result->result_array();
	}


	public function checkNumberSearch($taikhoan, $thoigian)
	{
		$taikhoan = "%".$taikhoan."%";
		$sql = "SELECT dongtien.*, nguoidung.TaiKhoan FROM dongtien, nguoidung WHERE nguoidung.PhanQuyen = 0 AND dongtien.MaNguoiDung = nguoidung.MaNguoiDung AND (nguoidung.TaiKhoan LIKE ? OR DATE(dongtien.ThoiGian) = ?)";
		$result = $this->db->query($sql, array($taikhoan, $thoigian));
		return $result->num_rows();
	}

	public function search($taikhoan, $thoigian, $start = 0, $end = 10){
		$taikhoan = "%".$taikhoan."%";
		$sql = "SELECT dongtien.*, nguoidung.TaiKhoan, nguoidung.AnhChinh FROM dongtien, nguoidung WHERE nguoidung.PhanQuyen = 0 AND dongtien.MaNguoiDung = nguoidung.MaNguoiDung AND (nguoidung.TaiKhoan LIKE ? OR DATE(dongtien.ThoiGian) = ?) ORDER BY dongtien.MaDongTien DESC LIMIT ?, ?";
		$result = $this->db->query($sql, array($taikhoan, $thoigian, $start, $end));
		return $result->result_array();
	}
}

/* End of file Model_ChuyenMuc.php */
/* Location: ./application/models/Model_ChuyenMuc.php */