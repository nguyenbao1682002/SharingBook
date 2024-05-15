<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_Sach extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}

	public function getByIdUser($manguoidung, $start = 0, $end = 5){
		$sql = "SELECT * FROM sach WHERE MaNguoiDung = ? AND TrangThai = 1";
		$result = $this->db->query($sql, array($manguoidung));
		return $result->result_array();
	}

	public function getById($Masach){
		$sql = "SELECT * FROM sach WHERE Masach = ? AND TrangThai = 1";
		$result = $this->db->query($sql, array($Masach));
		return $result->result_array();
	}

	public function updateNumber($Masach,$SoLuong){
		$sql = "UPDATE sach SET SoLuong = ? WHERE Masach = ?";
		$result = $this->db->query($sql, array($SoLuong,$Masach));
		return $result;
	}

	public function checkNumber()
	{
		$sql = "SELECT sach.*, chuyenmuc.TenChuyenMuc FROM sach,chuyenmuc WHERE sach.MaChuyenMuc = chuyenmuc.MaChuyenMuc AND sach.TrangThai = 1";
		$result = $this->db->query($sql);
		return $result->num_rows();
	}

	public function getAll($start = 0, $end = 9){
		$sql = "SELECT sach.*, chuyenmuc.TenChuyenMuc, chuyenmuc.MaChuyenMuc FROM sach, chuyenmuc WHERE sach.MaChuyenMuc = chuyenmuc.MaChuyenMuc AND sach.TrangThai = 1 ORDER BY sach.Masach DESC LIMIT ?, ?";
		$result = $this->db->query($sql, array($start, $end));
		return $result->result_array();
	}

	public function getBySlug($DuongDan){
		$sql = "SELECT sach.*, chuyenmuc.TenChuyenMuc, chuyenmuc.DuongDan AS DuongDanChuyenMuc FROM sach, chuyenmuc WHERE sach.MaChuyenMuc = chuyenmuc.MaChuyenMuc AND sach.DuongDan = ? AND sach.TrangThai = 1";
		$result = $this->db->query($sql, array($DuongDan));
		return $result->result_array();
	}

	public function getByCategory($MaChuyenMuc,$Masach){
		$sql = "SELECT * FROM sach WHERE MaChuyenMuc = ? AND TrangThai = 1 AND Masach != ? ORDER BY RAND() LIMIT 9";
		$result = $this->db->query($sql, array($MaChuyenMuc,$Masach));
		return $result->result_array();
	}

	public function getCategoryNumber(){
		$sql = "SELECT cm.TenChuyenMuc, cm.DuongDan AS DuongDanChuyenMuc, COUNT(sp.Masach) AS SoLuongSach FROM chuyenmuc cm LEFT JOIN sach sp ON cm.MaChuyenMuc = sp.MaChuyenMuc WHERE cm.TrangThai = 1 GROUP BY cm.TenChuyenMuc, cm.DuongDan;";
		$result = $this->db->query($sql);
		return $result->result_array();
	}


	public function getByType($Loaisach){
		$sql = "SELECT * FROM sach WHERE Loaisach = ? AND TrangThai = 1 ORDER BY Masach DESC LIMIT 9";
		$result = $this->db->query($sql, array($Loaisach));
		return $result->result_array();
	}

	public function getSuggest(){
		$sql = "SELECT * FROM sach WHERE TrangThai = 1 ORDER BY RAND() LIMIT 9";
		$result = $this->db->query($sql);
		return $result->result_array();
	}

	public function getImage(){
		$sql = "SELECT * FROM sach WHERE TrangThai = 1 ORDER BY RAND() DESC LIMIT 8";
		$result = $this->db->query($sql);
		return $result->result_array();
	}

	public function search($Tensach){
		$Tensach = '%'.$Tensach.'%';
		$sql = "SELECT * FROM sach WHERE TrangThai = 1 AND Tensach LIKE ?";
		$result = $this->db->query($sql, array($Tensach));
		return $result->result_array();
	}
}

/* End of file Model_ChuyenMuc.php */
/* Location: ./application/models/Model_ChuyenMuc.php */