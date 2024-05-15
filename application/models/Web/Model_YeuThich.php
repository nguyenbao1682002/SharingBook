<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_YeuThich extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}


	public function getByIdUser($manguoidung){
		$sql = "SELECT sach.* FROM yeuthich, sach WHERE sach.MaSach = yeuthich.MaSach AND yeuthich.MaNguoiDung = ?";
		$result = $this->db->query($sql, array($manguoidung));
		return $result->result_array();
	}

	public function checkIdBook($manguoidung,$masach){
		$sql = "SELECT * FROM yeuthich WHERE MaNguoiDung = ? AND MaSach = ?";
		$result = $this->db->query($sql, array($manguoidung,$masach));
		return $result->result_array();
	}

	public function insert($manguoidung,$masach){
		$sql = "INSERT INTO `yeuthich`(`MaSach`, `MaNguoiDung`) VALUES (?, ?)";
		$result = $this->db->query($sql, array($masach,$manguoidung));
		return $result;
	}

	public function delete($manguoidung,$masach){
		$sql = "DELETE FROM `yeuthich` WHERE MaSach = ? AND MaNguoiDung = ?";
		$result = $this->db->query($sql, array($masach,$manguoidung));
		return $result;
	}
}

/* End of file Model_YeuThich.php */
/* Location: ./application/models/Model_YeuThich.php */