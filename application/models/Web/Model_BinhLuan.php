<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_BinhLuan extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}

	public function getRateByIdUser($manguoidung){
		$sql = "SELECT COALESCE(ROUND(AVG(binhluan.SoSao), 1), 0) AS TrungBinhSoSao FROM nguoidung, sach, binhluan WHERE binhluan.MaSach = sach.MaSach AND sach.MaNguoiDung = nguoidung.MaNguoiDung AND nguoidung.MaNguoiDung = ? AND binhluan.SoSao != 0;";
		$result = $this->db->query($sql, array($manguoidung));
		return $result->result_array()[0]['TrungBinhSoSao'];
	}

	public function getRateByIdBook($MaSach){
		$sql = "SELECT COALESCE(ROUND(AVG(SoSao), 1), 0) AS TrungBinhSoSao FROM binhluan WHERE MaSach = ? AND SoSao != 0";
		$result = $this->db->query($sql, array($MaSach));
		$sosao = $result->result_array()[0]['TrungBinhSoSao'];

		return ($sosao / 5) * 100;
	}

	public function getNumberUserRateByIdBook($MaSach){
		$sql = "SELECT COALESCE(COUNT(*), 0) AS SoDanhGia FROM binhluan WHERE MaSach = ?";
		$result = $this->db->query($sql, array($MaSach));
		return $result->result_array()[0]['SoDanhGia'];
	}

	public function insert($manguoidung,$masach,$noidung,$sosao,$thoigian){
		$sql = "INSERT INTO `binhluan`(`MaNguoiDung`, `MaSach`, `NoiDung`, `SoSao`, `ThoiGian`) VALUES (?, ?, ?, ?, ?)";
		$result = $this->db->query($sql, array($manguoidung,$masach,$noidung,$sosao,$thoigian));
		return $result;
	}

	public function getByIdBook($masach){
		$sql = "SELECT nguoidung.AnhChinh, nguoidung.HoTen, binhluan.* FROM nguoidung, binhluan WHERE nguoidung.MaNguoiDung = binhluan.MaNguoiDung AND binhluan.MaSach = ? ORDER BY ThoiGian ASC";
		$result = $this->db->query($sql, array($masach));
		return $result->result_array();
	}

}

/* End of file Model_BinhLuan.php */
/* Location: ./application/models/Model_BinhLuan.php */