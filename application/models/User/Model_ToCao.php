<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_ToCao extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}

	public function checkNumber($manguoidung)
	{
		$sql = "SELECT tocao.*, nguoidung.MaNguoiDung, nguoidung.TaiKhoan FROM nguoidung, tocao WHERE tocao.MaNguoiDung = nguoidung.MaNguoiDung AND tocao.MaNguoiDung = ?";
		$result = $this->db->query($sql, array($manguoidung));
		return $result->num_rows();
	}

	public function getAll($manguoidung, $start = 0, $end = 10){
		$sql = "SELECT tocao.*, nguoidung.MaNguoiDung, nguoidung.TaiKhoan FROM nguoidung, tocao WHERE tocao.MaNguoiDung = nguoidung.MaNguoiDung AND tocao.MaNguoiDung = ? ORDER BY tocao.MaToCao DESC LIMIT ?, ?";
		$result = $this->db->query($sql, array($manguoidung, $start, $end));
		return $result->result_array();
	}

	public function getById($manguoidung,$MaToCao){
		$sql = "SELECT tocao.*, nguoidung.MaNguoiDung, nguoidung.TaiKhoan FROM nguoidung, tocao WHERE tocao.MaNguoiDung = nguoidung.MaNguoiDung AND tocao.MaNguoiDung = ? AND tocao.MaToCao = ?";
		$result = $this->db->query($sql, array($manguoidung,$MaToCao));
		return $result->result_array();
	}

	public function status($trangthai,$MaToCao){
		$sql = "UPDATE tocao SET TrangThai = ? WHERE MaToCao = ?";
		$result = $this->db->query($sql, array($trangthai,$MaToCao));
		return $result;
	}

	public function search($manguoidung, $nannhan, $start = 0, $end = 10){
		$sql = "SELECT tocao.*, nguoidung.MaNguoiDung, nguoidung.TaiKhoan FROM nguoidung, tocao WHERE tocao.MaNguoiDung = nguoidung.MaNguoiDung AND tocao.MaNguoiDung = ? AND tocao.NanNhan = ? ORDER BY tocao.MaToCao DESC LIMIT ?, ?";
		$result = $this->db->query($sql, array($manguoidung, $nannhan, $start, $end));
		return $result->result_array();
	}

	public function checkNumberSearch($manguoidung, $nannhan){
		$sql = "SELECT tocao.*, nguoidung.MaNguoiDung, nguoidung.TaiKhoan FROM nguoidung, tocao WHERE tocao.MaNguoiDung = nguoidung.MaNguoiDung AND tocao.MaNguoiDung = ? AND tocao.NanNhan = ?";
		$result = $this->db->query($sql, array($manguoidung, $nannhan));
		return $result->num_rows();
	}

	public function getUserVictim($mangoidung){
		$sql = "SELECT * FROM nguoidung WHERE MaNguoiDung = ?";
		$result = $this->db->query($sql, array($mangoidung));
		return $result->result_array();
	}

}

/* End of file Model_ChuyenMuc.php */
/* Location: ./application/models/Model_ChuyenMuc.php */