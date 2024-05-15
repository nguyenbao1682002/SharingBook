<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_ToCao extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}

	public function getReportByIdUser($manguoidung){
		$sql = "SELECT COALESCE(COUNT(*), 0) AS TrungBinhToCao FROM tocao WHERE TrangThai = 1 AND NanNhan = ?";
		$result = $this->db->query($sql, array($manguoidung));
		return $result->result_array()[0]['TrungBinhToCao'];
	}

	public function insert($manguoidung,$nannhan,$tieude,$noidung){
		$sql = "INSERT INTO `tocao`(`MaNguoiDung`, `NanNhan`, `TieuDe`, `NoiDung`) VALUES (?, ?, ?, ?)";
		$result = $this->db->query($sql, array($manguoidung,$nannhan,$tieude,$noidung));
		return $result;
	}

}

/* End of file Model_ToCao.php */
/* Location: ./application/models/Model_ToCao.php */