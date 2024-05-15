<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_RutTien extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}

	public function insert($manguoidung, $sotienrut)
	{
		$sql = "INSERT INTO `ruttien`(`MaNguoiDung`, `SoTienRut`) VALUES (?, ?)";
		$result = $this->db->query($sql, array($manguoidung,$sotienrut));
		return $result;
	}


}

/* End of file Model_ChuyenMuc.php */
/* Location: ./application/models/Model_ChuyenMuc.php */