<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class RutTien extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->has_userdata('taikhoan')){
			return redirect(base_url('admin/dang-nhap/'));
		}

		$this->load->model('Admin/Model_RutTien');
		$this->load->model('Admin/Model_NguoiDung');
		$this->load->model('Admin/Model_CauHinh');
	}

	public function index()
	{
		$totalRecords = $this->Model_RutTien->checkNumber();
		$recordsPerPage = 10;
		$totalPages = ceil($totalRecords / $recordsPerPage); 

		$data['phiruttien'] = $this->Model_CauHinh->getAll()[0]['PhiRutTien'];
		$data['totalPages'] = $totalPages;
		$data['list'] = $this->Model_RutTien->getAll();
		$data['title'] = "Danh sách yêu cầu rút tiền";
		return $this->load->view('Admin/View_RutTien', $data);
	}

	public function page($trang){
		$data['title'] = "Danh sách yêu cầu rút tiền";
		$totalRecords = $this->Model_RutTien->checkNumber();
		$recordsPerPage = 10;
		$totalPages = ceil($totalRecords / $recordsPerPage); 

		if($trang < 1){
			return redirect(base_url('admin/rut-tien/'));
		}

		if($trang > $totalPages){
			return redirect(base_url('admin/rut-tien/'));
		}

		$start = ($trang - 1) * $recordsPerPage;

		$data['phiruttien'] = $this->Model_CauHinh->getAll()[0]['PhiRutTien'];
		if($start == 0){
			$data['totalPages'] = $totalPages;
			$data['list'] = $this->Model_RutTien->getAll();
			return $this->load->view('Admin/View_RutTien', $data);
		}else{
			$data['totalPages'] = $totalPages;
			$data['list'] = $this->Model_RutTien->getAll($start);
			return $this->load->view('Admin/View_RutTien', $data);
		}
	}

	public function view($maruttien){
		if(count($this->Model_RutTien->getById($maruttien)) <= 0){
			$this->session->set_flashdata('error', 'Yêu cầu rút tiền không tồn tại!');
			return redirect(base_url('admin/rut-tien/'));
		}

		$data['detail'] = $this->Model_RutTien->getById($maruttien);
		$data['wallet'] = $this->Model_NguoiDung->getWallet($this->Model_RutTien->getById($maruttien)[0]['MaNguoiDung']);
		$data['phiruttien'] = $this->Model_CauHinh->getAll()[0]['PhiRutTien'];
		$data['title'] = "Thông tin yêu cầu rút tiền";
		return $this->load->view('Admin/View_XemRutTien', $data);
	}


	public function accept($maruttien)
	{
		if(count($this->Model_RutTien->getById($maruttien)) <= 0){
			$this->session->set_flashdata('error', 'Yêu cầu rút tiền không tồn tại!');
			return redirect(base_url('admin/rut-tien/'));
		}

		if($this->Model_RutTien->getById($maruttien)[0]['TrangThai'] != 1){
			$this->session->set_flashdata('error', 'Không được phép thực hiện!');
			return redirect(base_url('admin/rut-tien/'.$maruttien.'/xem/'));
		}

		$manguoidung = $this->Model_RutTien->getById($maruttien)[0]['MaNguoiDung'];

		$sotientru = $this->Model_RutTien->getById($maruttien)[0]['SoTienRut'];
		$noidung = "Admin trừ tiền rút ".number_format($sotientru)." VND của tài khoản!";

		$sotiencu = $this->Model_NguoiDung->getWallet($manguoidung)[0]['SoDuKhaDung'];
		$tongnap = $this->Model_NguoiDung->getWallet($manguoidung)[0]['TongNap'];

		if($sotientru > $sotiencu){
			$this->session->set_flashdata('error', 'Số tiền rút không được lớn hơn số dư khả dụng!');
			return redirect(base_url('admin/rut-tien/'.$maruttien.'/xem/'));
		}

		$sotienmoi = $sotiencu - $sotientru;

		$this->Model_NguoiDung->updateMoneyWallet($sotienmoi,$tongnap,$manguoidung);

		$this->Model_NguoiDung->insertCashFlow($manguoidung,$sotiencu,$sotientru,$sotienmoi,$noidung);

		$this->Model_RutTien->accept($maruttien);
		$this->session->set_flashdata('success', 'Xác nhận rút '.number_format($sotientru).' cho người dùng thành công!');
		return redirect(base_url('admin/rut-tien/'.$maruttien.'/xem/'));
	}

	public function cancel($maruttien)
	{
		if(count($this->Model_RutTien->getById($maruttien)) <= 0){
			$this->session->set_flashdata('error', 'Yêu cầu rút tiền không tồn tại!');
			return redirect(base_url('admin/rut-tien/'));
		}

		if($this->Model_RutTien->getById($maruttien)[0]['TrangThai'] != 1){
			$this->session->set_flashdata('error', 'Không được phép thực hiện!');
			return redirect(base_url('admin/rut-tien/'.$maruttien.'/xem/'));
		}

		$this->Model_RutTien->cancel($maruttien);

		$this->session->set_flashdata('success', 'Hủy yêu cầu rút tiền của người dùng thành công!');
		return redirect(base_url('admin/rut-tien/'.$maruttien.'/xem/'));
	}

	public function search(){
		if(!isset($_GET['taikhoan']) && !isset($_GET['trangthai'])){
			return redirect(base_url('admin/rut-tien/'));
		}

		$taikhoan = $this->input->get('taikhoan');
		$trangthai = $this->input->get('trangthai');

		if(empty($taikhoan) && empty($trangthai)){
			return redirect(base_url('admin/rut-tien/'));
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

		$totalRecords = $this->Model_RutTien->checkNumberSearch($taikhoan,$trangthai);
		$recordsPerPage = 10;
		$totalPages = ceil($totalRecords / $recordsPerPage); 
		$data['phiruttien'] = $this->Model_CauHinh->getAll()[0]['PhiRutTien'];
		$data['totalPages'] = $totalPages;
		$data['list'] = $this->Model_RutTien->search($taikhoan,$trangthai);
		$data['title'] = "Danh sách yêu cầu rút tiền";
		return $this->load->view('Admin/View_RutTienTimKiem', $data);
	}

	public function pageSearch($trang){
		if(!isset($_GET['taikhoan']) && !isset($_GET['trangthai'])){
			return redirect(base_url('admin/rut-tien/'));
		}

		$taikhoan = $this->input->get('taikhoan');
		$trangthai = $this->input->get('trangthai');

		if(empty($taikhoan) && empty($trangthai)){
			return redirect(base_url('admin/rut-tien/'));
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

		$data['title'] = "Danh sách yêu cầu rút tiền";
		$totalRecords = $this->Model_RutTien->checkNumberSearch($taikhoan,$trangthai);
		$recordsPerPage = 10;
		$totalPages = ceil($totalRecords / $recordsPerPage); 
		$data['phiruttien'] = $this->Model_CauHinh->getAll()[0]['PhiRutTien'];
		if($trang < 1){
			return redirect(base_url('admin/rut-tien/'));
		}

		if($trang > $totalPages){
			return redirect(base_url('admin/rut-tien/'));
		}

		$start = ($trang - 1) * $recordsPerPage;


		if($start == 0){
			$data['totalPages'] = $totalPages;
			$data['list'] = $this->Model_RutTien->search($taikhoan,$trangthai);
			return $this->load->view('Admin/View_RutTienTimKiem', $data);
		}else{
			$data['totalPages'] = $totalPages;
			$data['list'] = $this->Model_RutTien->search($taikhoan,$trangthai,$start);
			return $this->load->view('Admin/View_RutTienTimKiem', $data);
		}
	}
}

/* End of file RutTien.php */
/* Location: ./application/controllers/RutTien.php */