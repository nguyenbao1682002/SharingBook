<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_BinhLuan extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}

	public function checkNumber($manguoidung)
	{
		$sql = "SELECT binhluan.*, nguoidung.MaNguoiDung, nguoidung.TaiKhoan, sach.TenSach, sach.MaSach FROM nguoidung, binhluan, sach WHERE binhluan.TrangThai = 1 AND binhluan.MaNguoiDung = nguoidung.MaNguoiDung AND binhluan.MaSach = sach.MaSach AND sach.MaNguoiDung = ?";
		$result = $this->db->query($sql, array($manguoidung));
		return $result->num_rows();
	}

	public function getAll($manguoidung, $start = 0, $end = 10){
		$sql = "SELECT binhluan.*, nguoidung.MaNguoiDung, nguoidung.TaiKhoan, sach.TenSach, sach.MaSach FROM nguoidung, binhluan, sach WHERE binhluan.TrangThai = 1 AND binhluan.MaNguoiDung = nguoidung.MaNguoiDung AND binhluan.MaSach = sach.MaSach AND sach.MaNguoiDung = ? ORDER BY binhluan.MaBinhLuan DESC LIMIT ?, ?";
		$result = $this->db->query($sql, array($manguoidung, $start, $end));
		return $result->result_array();
	}

	public function getById($manguoidung, $MaBinhLuan){
		$sql = "SELECT binhluan.*, nguoidung.MaNguoiDung, nguoidung.TaiKhoan, sach.TenSach, sach.MaSach FROM nguoidung, binhluan, sach WHERE binhluan.TrangThai = 1 AND binhluan.MaNguoiDung = nguoidung.MaNguoiDung AND binhluan.MaSach = sach.MaSach AND sach.MaNguoiDung = ? AND binhluan.MaBinhLuan = ?";
		$result = $this->db->query($sql, array($manguoidung,$MaBinhLuan));
		return $result->result_array();
	}


	public function search($manguoidung,$tensach, $sosao, $start = 0, $end = 10){
		$sql = "SELECT binhluan.*, nguoidung.MaNguoiDung, nguoidung.TaiKhoan, sach.TenSach, sach.MaSach FROM nguoidung, binhluan, sach WHERE binhluan.TrangThai = 1 AND binhluan.MaNguoiDung = nguoidung.MaNguoiDung AND binhluan.MaSach = sach.MaSach AND sach.MaNguoiDung = ? AND (sach.TenSach = ? OR binhluan.SoSao = ?) ORDER BY binhluan.MaBinhLuan DESC LIMIT ?, ?";
		$result = $this->db->query($sql, array($manguoidung, $tensach, $sosao, $start, $end));
		return $result->result_array();
	}

	public function checkNumberSearch($manguoidung,$tensach, $sosao){
		$sql = "SELECT binhluan.*, nguoidung.MaNguoiDung, nguoidung.TaiKhoan, sach.TenSach, sach.MaSach FROM nguoidung, binhluan, sach WHERE binhluan.TrangThai = 1 AND binhluan.MaNguoiDung = nguoidung.MaNguoiDung AND binhluan.MaSach = sach.MaSach AND sach.MaNguoiDung = ? AND (sach.TenSach = ? OR binhluan.SoSao = ?)";
		$result = $this->db->query($sql, array($manguoidung, $tensach, $sosao));
		return $result->num_rows();
	}

}

/* End of file Model_ChuyenMuc.php */
/* Location: ./application/models/Model_ChuyenMuc.php */