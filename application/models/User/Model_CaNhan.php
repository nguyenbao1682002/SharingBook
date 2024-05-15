<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_CaNhan extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}

	public function getById($MaNguoiDung){
		$sql = "SELECT * FROM nguoidung WHERE MaNguoiDung = ? AND PhanQuyen = 0";
		$result = $this->db->query($sql, array($MaNguoiDung));
		return $result->result_array();
	}


	public function update($HoTen,$TaiKhoan,$MatKhau,$Email,$SoDienThoai,$anhchinh,$tennganhang,$sotaikhoan,$chutaikhoan,$MaNguoiDung){
		$sql = "UPDATE nguoidung SET HoTen = ?, TaiKhoan = ?, MatKhau = ?, Email = ?, SoDienThoai = ?, AnhChinh = ?, TenNganHang = ?, SoTaiKhoan = ?, ChuTaiKhoan = ?WHERE MaNguoiDung = ?";
		$result = $this->db->query($sql, array($HoTen,$TaiKhoan,$MatKhau,$Email,$SoDienThoai,$anhchinh,$tennganhang,$sotaikhoan,$chutaikhoan,$MaNguoiDung));
		return $result;
	}
}

/* End of file Model_NhanVien.php */
/* Location: ./application/models/Model_NhanVien.php */