<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_CauHinh extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}

	public function getAll(){
		$sql = "SELECT * FROM cauhinh";
		$result = $this->db->query($sql);
		return $result->result_array();
	}

	public function update($tenwebsite,$motaweb,$logo,$favicon,$diachi,$email,$sodienthoai,$maqrnaptien,$phiruttien){
		$sql = "UPDATE cauhinh SET TenWebsite = ?, MoTaWeb = ?, Logo = ?, Favicon = ?, DiaChi = ?, Email = ?, SoDienThoai = ?, MaQRNapTien = ?, PhiRutTien = ?";
		$result = $this->db->query($sql, array($tenwebsite,$motaweb,$logo,$favicon,$diachi,$email,$sodienthoai,$maqrnaptien,$phiruttien));
		return $result;
	}
}

/* End of file Model_CauHinh.php */
/* Location: ./application/models/Model_CauHinh.php */