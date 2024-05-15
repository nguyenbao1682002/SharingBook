<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_NapTien extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}

	public function insert($manguoidung,$sotiennap){
		$sql = "INSERT INTO `naptien`(`MaNguoiDung`, `SoTienNap`) VALUES (?, ?)";
		$result = $this->db->query($sql, array($manguoidung,$sotiennap));
		return $result;
	}

	public function getPendingById($manguoidung){
		$sql = "SELECT * FROM naptien WHERE MaNguoiDung = ? AND TrangThai = 1";
		$result = $this->db->query($sql, array($manguoidung));
		return $result->result_array();
	}
}

/* End of file Model_NapTien.php */
/* Location: ./application/models/Model_NapTien.php */