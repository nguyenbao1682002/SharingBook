<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_BinhLuan extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}

	public function checkNumber()
	{
		$sql = "SELECT binhluan.*, nguoidung.MaNguoiDung, nguoidung.TaiKhoan, sach.TenSach, sach.MaSach FROM nguoidung, binhluan, sach WHERE binhluan.TrangThai = 1 AND binhluan.MaNguoiDung = nguoidung.MaNguoiDung AND binhluan.MaSach = sach.MaSach";
		$result = $this->db->query($sql);
		return $result->num_rows();
	}

	public function getAll($start = 0, $end = 10){
		$sql = "SELECT binhluan.*, nguoidung.MaNguoiDung, nguoidung.TaiKhoan, sach.TenSach, sach.MaSach FROM nguoidung, binhluan, sach WHERE binhluan.TrangThai = 1 AND binhluan.MaNguoiDung = nguoidung.MaNguoiDung AND binhluan.MaSach = sach.MaSach ORDER BY binhluan.MaBinhLuan DESC LIMIT ?, ?";
		$result = $this->db->query($sql, array($start, $end));
		return $result->result_array();
	}

	public function getById($MaBinhLuan){
		$sql = "SELECT binhluan.*, nguoidung.MaNguoiDung, nguoidung.TaiKhoan, sach.TenSach, sach.MaSach FROM nguoidung, binhluan, sach WHERE binhluan.TrangThai = 1 AND binhluan.MaNguoiDung = nguoidung.MaNguoiDung AND binhluan.MaSach = sach.MaSach AND binhluan.MaBinhLuan = ?";
		$result = $this->db->query($sql, array($MaBinhLuan));
		return $result->result_array();
	}


	public function delete($MaBinhLuan){
		$sql = "UPDATE binhluan SET TrangThai = 0 WHERE MaBinhLuan = ?";
		$result = $this->db->query($sql, array($MaBinhLuan));
		return $result;
	}

	public function search($tensach, $sosao, $start = 0, $end = 10){
		$sql = "SELECT binhluan.*, nguoidung.MaNguoiDung, nguoidung.TaiKhoan, sach.TenSach, sach.MaSach FROM nguoidung, binhluan, sach WHERE binhluan.TrangThai = 1 AND binhluan.MaNguoiDung = nguoidung.MaNguoiDung AND binhluan.MaSach = sach.MaSach AND (sach.TenSach = ? OR binhluan.SoSao = ?) ORDER BY binhluan.MaBinhLuan DESC LIMIT ?, ?";
		$result = $this->db->query($sql, array($tensach, $sosao, $start, $end));
		return $result->result_array();
	}

	public function checkNumberSearch($tensach, $sosao){
		$sql = "SELECT binhluan.*, nguoidung.MaNguoiDung, nguoidung.TaiKhoan, sach.TenSach, sach.MaSach FROM nguoidung, binhluan, sach WHERE binhluan.TrangThai = 1 AND binhluan.MaNguoiDung = nguoidung.MaNguoiDung AND binhluan.MaSach = sach.MaSach AND (sach.TenSach = ? OR binhluan.SoSao = ?)";
		$result = $this->db->query($sql, array($tensach, $sosao));
		return $result->num_rows();
	}

}

/* End of file Model_ChuyenMuc.php */
/* Location: ./application/models/Model_ChuyenMuc.php */