<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class NapTien extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->has_userdata('taikhoan')){
			return redirect(base_url('admin/dang-nhap/'));
		}

		$this->load->model('Admin/Model_NapTien');
		$this->load->model('Admin/Model_NguoiDung');
	}

	public function index()
	{
		$totalRecords = $this->Model_NapTien->checkNumber();
		$recordsPerPage = 10;
		$totalPages = ceil($totalRecords / $recordsPerPage); 

		
		$data['totalPages'] = $totalPages;
		$data['list'] = $this->Model_NapTien->getAll();
		$data['title'] = "Danh sách yêu cầu nạp tiền";
		return $this->load->view('Admin/View_NapTien', $data);
	}

	public function page($trang){
		$data['title'] = "Danh sách yêu cầu nạp tiền";
		$totalRecords = $this->Model_NapTien->checkNumber();
		$recordsPerPage = 10;
		$totalPages = ceil($totalRecords / $recordsPerPage); 

		if($trang < 1){
			return redirect(base_url('admin/nap-tien/'));
		}

		if($trang > $totalPages){
			return redirect(base_url('admin/nap-tien/'));
		}

		$start = ($trang - 1) * $recordsPerPage;

		
		if($start == 0){
			$data['totalPages'] = $totalPages;
			$data['list'] = $this->Model_NapTien->getAll();
			return $this->load->view('Admin/View_NapTien', $data);
		}else{
			$data['totalPages'] = $totalPages;
			$data['list'] = $this->Model_NapTien->getAll($start);
			return $this->load->view('Admin/View_NapTien', $data);
		}
	}

	public function view($manaptien){
		if(count($this->Model_NapTien->getById($manaptien)) <= 0){
			$this->session->set_flashdata('error', 'Yêu cầu nạp tiền không tồn tại!');
			return redirect(base_url('admin/nap-tien/'));
		}

		$data['detail'] = $this->Model_NapTien->getById($manaptien);
		$data['wallet'] = $this->Model_NguoiDung->getWallet($this->Model_NapTien->getById($manaptien)[0]['MaNguoiDung']);
		$data['title'] = "Thông tin yêu cầu nạp tiền";
		return $this->load->view('Admin/View_XemNapTien', $data);
	}


	public function accept($manaptien)
	{
		if(count($this->Model_NapTien->getById($manaptien)) <= 0){
			$this->session->set_flashdata('error', 'Yêu cầu nạp tiền không tồn tại!');
			return redirect(base_url('admin/nap-tien/'));
		}

		if($this->Model_NapTien->getById($manaptien)[0]['TrangThai'] != 1){
			$this->session->set_flashdata('error', 'Không được phép thực hiện!');
			return redirect(base_url('admin/nap-tien/'.$manaptien.'/xem/'));
		}

		$manguoidung = $this->Model_NapTien->getById($manaptien)[0]['MaNguoiDung'];

		$sotiencong = $this->Model_NapTien->getById($manaptien)[0]['SoTienNap'];
		$noidung = "Admin cộng tiền nạp ".number_format($sotiencong)." VND vào tài khoản!";

		$sotiencu = $this->Model_NguoiDung->getWallet($manguoidung)[0]['SoDuKhaDung'];
	
		$sotienmoi = $sotiencu + $sotiencong;

		$tongnap = $this->Model_NguoiDung->getWallet($manguoidung)[0]['TongNap'] + $sotiencong;

		$this->Model_NguoiDung->updateMoneyWallet($sotienmoi,$tongnap,$manguoidung);

		$this->Model_NguoiDung->insertCashFlow($manguoidung,$sotiencu,$sotiencong,$sotienmoi,$noidung);

		$this->Model_NapTien->accept($manaptien);
		$this->session->set_flashdata('success', 'Xác nhận nạp '.number_format($sotiencong).' cho người dùng thành công!');
		return redirect(base_url('admin/nap-tien/'.$manaptien.'/xem/'));
	}

	public function cancel($manaptien)
	{
		if(count($this->Model_NapTien->getById($manaptien)) <= 0){
			$this->session->set_flashdata('error', 'Yêu cầu nạp tiền không tồn tại!');
			return redirect(base_url('admin/nap-tien/'));
		}

		if($this->Model_NapTien->getById($manaptien)[0]['TrangThai'] != 1){
			$this->session->set_flashdata('error', 'Không được phép thực hiện!');
			return redirect(base_url('admin/nap-tien/'.$manaptien.'/xem/'));
		}

		$this->Model_NapTien->cancel($manaptien);

		$this->session->set_flashdata('success', 'Hủy yêu cầu nạp tiền của người dùng thành công!');
		return redirect(base_url('admin/nap-tien/'.$manaptien.'/xem/'));
	}

	public function search(){
		if(!isset($_GET['taikhoan']) && !isset($_GET['trangthai'])){
			return redirect(base_url('admin/nap-tien/'));
		}

		$taikhoan = $this->input->get('taikhoan');
		$trangthai = $this->input->get('trangthai');

		if(empty($taikhoan) && empty($trangthai)){
			return redirect(base_url('admin/nap-tien/'));
		}

		$data['post'] = array(
			'taikhoan' => $taikhoan,
			'trangthai' => $trangthai
		);

		if($trangthai == -1){
			$trangthai = 0;
		}

		if(empty($taikhoan)){
			$taikhoan = -1;
		}

		$totalRecords = $this->Model_NapTien->checkNumberSearch($taikhoan,$trangthai);
		$recordsPerPage = 10;
		$totalPages = ceil($totalRecords / $recordsPerPage); 
		
		$data['totalPages'] = $totalPages;
		$data['list'] = $this->Model_NapTien->search($taikhoan,$trangthai);
		$data['title'] = "Danh sách yêu cầu nạp tiền";
		return $this->load->view('Admin/View_NapTienTimKiem', $data);
	}

	public function pageSearch($trang){
		if(!isset($_GET['taikhoan']) && !isset($_GET['trangthai'])){
			return redirect(base_url('admin/nap-tien/'));
		}

		$taikhoan = $this->input->get('taikhoan');
		$trangthai = $this->input->get('trangthai');

		if(empty($taikhoan) && empty($trangthai)){
			return redirect(base_url('admin/nap-tien/'));
		}

		
		$data['post'] = array(
			'taikhoan' => $taikhoan,
			'trangthai' => $trangthai
		);


		if($trangthai == -1){
			$trangthai = 0;
		}

		if(empty($taikhoan)){
			$taikhoan = -1;
		}

		$data['title'] = "Danh sách yêu cầu nạp tiền";
		$totalRecords = $this->Model_NapTien->checkNumberSearch($taikhoan,$trangthai);
		$recordsPerPage = 10;
		$totalPages = ceil($totalRecords / $recordsPerPage); 
		
		if($trang < 1){
			return redirect(base_url('admin/nap-tien/'));
		}

		if($trang > $totalPages){
			return redirect(base_url('admin/nap-tien/'));
		}

		$start = ($trang - 1) * $recordsPerPage;


		if($start == 0){
			$data['totalPages'] = $totalPages;
			$data['list'] = $this->Model_NapTien->search($taikhoan,$trangthai);
			return $this->load->view('Admin/View_NapTienTimKiem', $data);
		}else{
			$data['totalPages'] = $totalPages;
			$data['list'] = $this->Model_NapTien->search($taikhoan,$trangthai,$start);
			return $this->load->view('Admin/View_NapTienTimKiem', $data);
		}
	}
}

/* End of file RutTien.php */
/* Location: ./application/controllers/RutTien.php */