<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_MuonSach extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}

	public function insert($masach,$manguoidung,$tongtien,$thoigiantra,$diachi,$soluong){
		$sql = "INSERT INTO `muonsach`(`MaSach`, `MaNguoiDung`, `TongTien`, `ThoiGianTra`, `DiaChi`, `SoLuong`) VALUES (?, ?, ?, ?, ?, ?)";
		$result = $this->db->query($sql, array($masach,$manguoidung,$tongtien,$thoigiantra,$diachi,$soluong));
		return $result;
	}

}

/* End of file Model_MuonSach.php */
/* Location: ./application/models/Model_MuonSach.php */