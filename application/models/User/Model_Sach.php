<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_Sach extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}

	public function add($tensach,$machuyenmuc,$manguoidung,$tacgia,$giamuon,$giagoc,$anhchinh,$hinhanh,$motangan,$mota,$loaisach,$duongdan,$soluong){
		$data = array(
	        "tensach" => $tensach,
	        "machuyenmuc" => $machuyenmuc,
	        "manguoidung" => $manguoidung,
	        "tacgia" => $tacgia,
	        "giamuon" => $giamuon,
	        "giagoc" => $giagoc,
	        "anhchinh" => $anhchinh,
	        "hinhanh" => $hinhanh,
	        "motangan" => $motangan,
	        "mota" => $mota,
	        "loaisach" => $loaisach,
	        "duongdan" => $duongdan,
	        "soluong" => $soluong
	    );

	    $this->db->insert('sach', $data);
	    $lastInsertedId = $this->db->insert_id();

	    return $lastInsertedId;
	}

	public function checkNumber($manguoidung)
	{
		$sql = "SELECT * FROM sach WHERE TrangThai >= 1 AND MaNguoiDung = ?";
		$result = $this->db->query($sql, array($manguoidung));
		return $result->num_rows();
	}

	public function getAll($manguoidung, $start = 0, $end = 10){
		$sql = "SELECT sach.*, nguoidung.TaiKhoan, nguoidung.MaNguoiDung, nguoidung.PhanQuyen, chuyenmuc.TenChuyenMuc, chuyenmuc.MaChuyenMuc FROM sach, nguoidung, chuyenmuc WHERE sach.MaNguoiDung = nguoidung.MaNguoiDung AND chuyenmuc.MaChuyenMuc = sach.MaChuyenMuc AND sach.TrangThai >= 1 AND sach.MaNguoiDung = ? ORDER BY sach.MaSach DESC LIMIT ?, ?";
		$result = $this->db->query($sql, array($manguoidung, $start, $end));
		return $result->result_array();
	}

	public function getById($manguoidung, $MaSach){
		$sql = "SELECT * FROM sach WHERE MaNguoiDung = ? AND MaSach = ? AND TrangThai >= 1";
		$result = $this->db->query($sql, array($manguoidung,$MaSach));
		return $result->result_array();
	}

	public function update($tensach,$machuyenmuc,$manguoidung,$tacgia,$giamuon,$giagoc,$anhchinh,$hinhanh,$motangan,$mota,$loaisach,$duongdan,$soluong,$masach){
		$sql = "UPDATE sach SET tensach = ?, machuyenmuc = ?, manguoidung = ?, tacgia = ?, giamuon = ?, giagoc = ?, anhchinh = ?, hinhanh = ?, motangan = ?, mota = ?, loaisach = ?, duongdan = ?, soluong = ? WHERE masach = ?";
		$result = $this->db->query($sql, array($tensach,$machuyenmuc,$manguoidung,$tacgia,$giamuon,$giagoc,$anhchinh,$hinhanh,$motangan,$mota,$loaisach,$duongdan,$soluong,$masach));
		return $result;
	}

	public function delete($masach){
		$sql = "UPDATE sach SET TrangThai = 0 WHERE masach = ?";
		$result = $this->db->query($sql, array($masach));
		return $result;
	}

	public function status($trangthai,$trangthaimuon,$masach){
		$sql = "UPDATE sach SET trangthai = ?, trangthaimuon = ? WHERE masach = ?";
		$result = $this->db->query($sql, array($trangthai,$trangthaimuon,$masach));
		return $result;
	}

}

/* End of file Model_ChuyenMuc.php */
/* Location: ./application/models/Model_ChuyenMuc.php */