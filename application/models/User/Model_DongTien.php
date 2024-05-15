<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_DongTien extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}

	public function checkNumber($manguoidung)
	{
		$sql = "SELECT dongtien.*, nguoidung.TaiKhoan, nguoidung.AnhChinh FROM dongtien, nguoidung WHERE dongtien.MaNguoiDung = nguoidung.MaNguoiDung AND nguoidung.PhanQuyen = 0 AND dongtien.MaNguoiDung = ?";
		$result = $this->db->query($sql, array($manguoidung));
		return $result->num_rows();
	}

	public function getAll($manguoidung, $start = 0, $end = 10){
		$sql = "SELECT dongtien.*, nguoidung.TaiKhoan, nguoidung.AnhChinh FROM dongtien, nguoidung WHERE nguoidung.PhanQuyen = 0 AND dongtien.MaNguoiDung = nguoidung.MaNguoiDung AND dongtien.MaNguoiDung = ? ORDER BY dongtien.MaDongTien DESC LIMIT ?, ?";
		$result = $this->db->query($sql, array($manguoidung, $start, $end));
		return $result->result_array();
	}


	public function checkNumberSearch($manguoidung, $thoigian)
	{
		$sql = "SELECT dongtien.*, nguoidung.TaiKhoan FROM dongtien, nguoidung WHERE nguoidung.PhanQuyen = 0 AND dongtien.MaNguoiDung = nguoidung.MaNguoiDung AND dongtien.MaNguoiDung = ? AND DATE(dongtien.ThoiGian) = ?";
		$result = $this->db->query($sql, array($manguoidung, $thoigian));
		return $result->num_rows();
	}

	public function search($manguoidung, $thoigian, $start = 0, $end = 10){
		$sql = "SELECT dongtien.*, nguoidung.TaiKhoan, nguoidung.AnhChinh FROM dongtien, nguoidung WHERE nguoidung.PhanQuyen = 0 AND dongtien.MaNguoiDung = nguoidung.MaNguoiDung AND dongtien.MaNguoiDung = ? AND DATE(dongtien.ThoiGian) = ? ORDER BY dongtien.MaDongTien DESC LIMIT ?, ?";
		$result = $this->db->query($sql, array($manguoidung, $thoigian, $start, $end));
		return $result->result_array();
	}
}

/* End of file Model_ChuyenMuc.php */
/* Location: ./application/models/Model_ChuyenMuc.php */