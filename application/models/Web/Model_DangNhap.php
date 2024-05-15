<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_DangNhap extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
	}

	public function checkAccount($taikhoan, $matkhau){
		$sql = "SELECT * FROM nguoidung WHERE TaiKhoan = ? AND MatKhau = ? AND PhanQuyen = 0";
		$result = $this->db->query($sql, array($taikhoan, $matkhau));
		return $result->num_rows();
	}

	public function checkAccountBlock($taikhoan){
		$sql = "SELECT * FROM nguoidung WHERE TrangThai = 0 AND TaiKhoan = ?";
		$result = $this->db->query($sql, array($taikhoan));
		return $result->num_rows();
	}

	public function getInfoByUsername($taikhoan){
		$sql = "SELECT * FROM nguoidung WHERE TaiKhoan = ?";
		$result = $this->db->query($sql, array($taikhoan));
		return $result->result_array();
	}

	public function getInfoByPhone($sodienthoai){
		$sql = "SELECT * FROM nguoidung WHERE SoDienThoai = ?";
		$result = $this->db->query($sql, array($sodienthoai));
		return $result->result_array();
	}

	public function getInfoByEmail($email){
		$sql = "SELECT * FROM nguoidung WHERE Email = ?";
		$result = $this->db->query($sql, array($email));
		return $result->result_array();
	}


	public function getWallet($manguoidung){
		$sql = "SELECT * FROM vitien WHERE MaNguoiDung = ?";
		$result = $this->db->query($sql, array($manguoidung));
		return $result->result_array();
	}

}

/* End of file DangNhap.php */
/* Location: ./application/models/DangNhap.php */