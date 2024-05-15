<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class NguoiDung extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Web/Model_NguoiDung');
		$this->load->model('Web/Model_Sach');
		$this->load->model('Web/Model_DangNhap');
		$this->load->model('Web/Model_BinhLuan');
		$this->load->model('Web/Model_ToCao');
		$this->load->model('Web/Model_GiaoDien');
	}

	public function index()
	{
		if(!$this->session->has_userdata('khachhang')){
			return redirect(base_url('dang-nhap/'));
		}
		
		$data['title'] = "Trang cá nhân";
		$data['detail'] = $this->Model_NguoiDung->getById($this->session->userdata('makhachhang'));
		$data['fullname'] = $this->session->userdata('hoten');
		$data['book'] = $this->Model_Sach->getByIdUser($this->session->userdata('makhachhang'));
		$data['avgRate'] = $this->Model_BinhLuan->getRateByIdUser($this->session->userdata('makhachhang'));
		$data['avgReport'] = $this->Model_ToCao->getReportByIdUser($this->session->userdata('makhachhang'));

		$data['banner1'] = $this->Model_GiaoDien->getByType(2);
		$data['new'] = $this->Model_Sach->getByType(1);
		$data['sale'] = $this->Model_Sach->getByType(2);
		$data['popular'] = $this->Model_Sach->getByType(3);
		return $this->load->view('Web/View_NguoiDung', $data);
	}

	public function detail($taikhoan){
		if(count($this->Model_DangNhap->getInfoByUsername($taikhoan)) <= 0){
			$data['title'] = "Không tìm thấy người dùng!";
			return $this->load->view('Web/404', $data);
		}

		$manguoidung = $this->Model_DangNhap->getInfoByUsername($taikhoan)[0]['MaNguoiDung'];

		$data['title'] = $this->Model_DangNhap->getInfoByUsername($taikhoan)[0]['HoTen'];
		$data['detail'] = $this->Model_NguoiDung->getById($manguoidung);
		$data['fullname'] = $this->Model_DangNhap->getInfoByUsername($taikhoan)[0]['HoTen'];
		$data['book'] = $this->Model_Sach->getByIdUser($manguoidung);
		$data['avgRate'] = $this->Model_BinhLuan->getRateByIdUser($manguoidung);
		$data['avgReport'] = $this->Model_ToCao->getReportByIdUser($manguoidung);

		$data['banner1'] = $this->Model_GiaoDien->getByType(2);
		$data['new'] = $this->Model_Sach->getByType(1);
		$data['sale'] = $this->Model_Sach->getByType(2);
		$data['popular'] = $this->Model_Sach->getByType(3);
		return $this->load->view('Web/View_NguoiDung', $data);
	}
}

/* End of file KhachHang.php */
/* Location: ./application/controllers/KhachHang.php */