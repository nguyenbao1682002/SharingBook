<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class NguoiDung extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->has_userdata('taikhoan')){
			return redirect(base_url('admin/dang-nhap/'));
		}

		$this->load->model('Admin/Model_NguoiDung');
	}

	public function index()
	{
		$totalRecords = $this->Model_NguoiDung->checkNumber();
		$recordsPerPage = 10;
		$totalPages = ceil($totalRecords / $recordsPerPage); 

		$data['totalPages'] = $totalPages;
		$data['list'] = $this->Model_NguoiDung->getAll();
		$data['title'] = "Danh sách người dùng";
		return $this->load->view('Admin/View_NguoiDung', $data);
	}

	public function page($trang){
		$data['title'] = "Danh sách người dùng";
		$totalRecords = $this->Model_NguoiDung->checkNumber();
		$recordsPerPage = 10;
		$totalPages = ceil($totalRecords / $recordsPerPage); 

		if($trang < 1){
			return redirect(base_url('admin/nguoi-dung/'));
		}

		if($trang > $totalPages){
			return redirect(base_url('admin/nguoi-dung/'));
		}

		$start = ($trang - 1) * $recordsPerPage;


		if($start == 0){
			$data['totalPages'] = $totalPages;
			$data['list'] = $this->Model_NguoiDung->getAll();
			return $this->load->view('Admin/View_NguoiDung', $data);
		}else{
			$data['totalPages'] = $totalPages;
			$data['list'] = $this->Model_NguoiDung->getAll($start);
			return $this->load->view('Admin/View_NguoiDung', $data);
		}
	}

	public function view($manguoidung){
		if(count($this->Model_NguoiDung->getById($manguoidung)) <= 0){
			$this->session->set_flashdata('error', 'Người dùng không tồn tại!');
			return redirect(base_url('admin/nguoi-dung/'));
		}

		$data['detail'] = $this->Model_NguoiDung->getById($manguoidung);
		$data['title'] = "Thông tin người dùng";
		return $this->load->view('Admin/View_XemNguoiDung', $data);
	}

	public function status($manguoidung)
	{
		if(count($this->Model_NguoiDung->getById($manguoidung)) <= 0){
			$this->session->set_flashdata('error', 'Người dùng không tồn tại!');
			return redirect(base_url('admin/nguoi-dung/'));
		}

		$trangthai = $this->Model_NguoiDung->getById($manguoidung)[0]['TrangThai'] == 0 ? 1 : 0;

		$this->Model_NguoiDung->updateStatus($trangthai,$manguoidung);

		if($trangthai == 1){
			$this->session->set_flashdata('success', 'Bỏ cấm người dùng thành công!');
		}else{
			$this->session->set_flashdata('success', 'Cấm người dùng thành công!');
		}
		return redirect(base_url('admin/nguoi-dung/'.$manguoidung.'/xem/'));
	}

	public function wallet($manguoidung){
		if(count($this->Model_NguoiDung->getById($manguoidung)) <= 0){
			$this->session->set_flashdata('error', 'Người dùng không tồn tại!');
			return redirect(base_url('admin/nguoi-dung/'));
		}

		$data['detail'] = $this->Model_NguoiDung->getById($manguoidung);
		$data['wallet'] = $this->Model_NguoiDung->getWallet($manguoidung);
		$data['title'] = "Thông tin ví tiền người dùng";
		return $this->load->view('Admin/View_ViTienNguoiDung', $data);
	}

	public function addMoney(){
		$manguoidung = $this->input->post('manguoidung');
		if(count($this->Model_NguoiDung->getById($manguoidung)) <= 0){
			$this->session->set_flashdata('error', 'Người dùng không tồn tại!');
			return redirect(base_url('admin/nguoi-dung/'));
		}

		$sotiencong = $this->input->post('sotiencong');
		$noidung = $this->input->post('noidung');

		if(!is_numeric($sotiencong) || $sotiencong <= 0){
			$this->session->set_flashdata('error', 'Vui lòng nhập số tiền cộng là một số và lớn hơn 0!');
			return redirect(base_url('admin/nguoi-dung/'.$manguoidung.'/vi-tien/'));
		}

		if(empty($noidung)){
			$noidung = "Admin cộng ".number_format($sotiencong)." VND vào tài khoản!";
		}

		$sotiencu = $this->Model_NguoiDung->getWallet($manguoidung)[0]['SoDuKhaDung'];

		$sotienmoi = $sotiencong + $sotiencu;

		$this->Model_NguoiDung->updateMoneyWallet($sotienmoi,$manguoidung);

		$this->Model_NguoiDung->insertCashFlow($manguoidung,$sotiencu,$sotiencong,$sotienmoi,$noidung);

		$this->session->set_flashdata('success', 'Cộng '.number_format($sotiencong).' VND cho người dùng thành công!');
		return redirect(base_url('admin/nguoi-dung/'.$manguoidung.'/vi-tien/'));
	}


	public function subMoney(){
		$manguoidung = $this->input->post('manguoidung');
		if(count($this->Model_NguoiDung->getById($manguoidung)) <= 0){
			$this->session->set_flashdata('error', 'Người dùng không tồn tại!');
			return redirect(base_url('admin/nguoi-dung/'));
		}

		$sotientru = $this->input->post('sotientru');
		$noidung = $this->input->post('noidung');

		if(!is_numeric($sotientru) || $sotientru <= 0){
			$this->session->set_flashdata('error', 'Vui lòng nhập số tiền trừ là một số và lớn hơn 0!');
			return redirect(base_url('admin/nguoi-dung/'.$manguoidung.'/vi-tien/'));
		}

		if(empty($noidung)){
			$noidung = "Admin trừ ".number_format($sotientru)." VND khỏi tài khoản!";
		}

		$sotiencu = $this->Model_NguoiDung->getWallet($manguoidung)[0]['SoDuKhaDung'];

		if($sotientru > $sotiencu){
			$this->session->set_flashdata('error', 'Số tiền trừ không được lớn hơn số dư khả dụng!');
			return redirect(base_url('admin/nguoi-dung/'.$manguoidung.'/vi-tien/'));
		}

		$sotienmoi = $sotiencu - $sotientru;

		$this->Model_NguoiDung->updateMoneyWallet($sotienmoi,$manguoidung);

		$this->Model_NguoiDung->insertCashFlow($manguoidung,$sotiencu,$sotientru,$sotienmoi,$noidung);

		$this->session->set_flashdata('success', 'Trừ '.number_format($sotientru).' VND cho người dùng thành công!');
		return redirect(base_url('admin/nguoi-dung/'.$manguoidung.'/vi-tien/'));
	}

	public function cashFlow($manguoidung){
		if(count($this->Model_NguoiDung->getById($manguoidung)) <= 0){
			$this->session->set_flashdata('error', 'Người dùng không tồn tại!');
			return redirect(base_url('admin/nguoi-dung/'));
		}

		$data['detail'] = $this->Model_NguoiDung->getById($manguoidung);

		$totalRecords = $this->Model_NguoiDung->checkNumberCashFlow($manguoidung);
		$recordsPerPage = 10;
		$totalPages = ceil($totalRecords / $recordsPerPage); 

		$data['totalPages'] = $totalPages;
		$data['list'] = $this->Model_NguoiDung->getCashFlow($manguoidung);
		$data['title'] = "Thông tin dòng tiền người dùng";
		return $this->load->view('Admin/View_DongTienNguoiDung', $data);
	}

	public function pageCashFlow($manguoidung,$trang){
		if(count($this->Model_NguoiDung->getById($manguoidung)) <= 0){
			$this->session->set_flashdata('error', 'Người dùng không tồn tại!');
			return redirect(base_url('admin/nguoi-dung/'));
		}

		$data['detail'] = $this->Model_NguoiDung->getById($manguoidung);

		$data['title'] = "Thông tin dòng tiền người dùng";
		$totalRecords = $this->Model_NguoiDung->checkNumberCashFlow($manguoidung);
		$recordsPerPage = 10;
		$totalPages = ceil($totalRecords / $recordsPerPage); 

		if($trang < 1){
			return redirect(base_url('admin/nguoi-dung/'.$manguoidung.'/dong-tien/'));
		}

		if($trang > $totalPages){
			return redirect(base_url('admin/nguoi-dung/'.$manguoidung.'/dong-tien/'));
		}

		$start = ($trang - 1) * $recordsPerPage;


		if($start == 0){
			$data['totalPages'] = $totalPages;
			$data['list'] = $this->Model_NguoiDung->getCashFlow($manguoidung);
			return $this->load->view('Admin/View_DongTienNguoiDung', $data);
		}else{
			$data['totalPages'] = $totalPages;
			$data['list'] = $this->Model_NguoiDung->getCashFlow($manguoidung,$start);
			return $this->load->view('Admin/View_DongTienNguoiDung', $data);
		}
	}

	public function search(){
		if(!isset($_GET['taikhoan']) && !isset($_GET['trangthai'])){
			return redirect(base_url('admin/nguoi-dung/'));
		}

		$taikhoan = $this->input->get('taikhoan');
		$trangthai = $this->input->get('trangthai');

		if(empty($taikhoan) && empty($trangthai)){
			return redirect(base_url('admin/nguoi-dung/'));
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

		$totalRecords = $this->Model_NguoiDung->checkNumberSearch($taikhoan,$trangthai);
		$recordsPerPage = 10;
		$totalPages = ceil($totalRecords / $recordsPerPage); 

		$data['totalPages'] = $totalPages;
		$data['list'] = $this->Model_NguoiDung->search($taikhoan,$trangthai);
		$data['title'] = "Danh sách người dùng";
		return $this->load->view('Admin/View_NguoiDungTimKiem', $data);
	}

	public function pageSearch($trang){
		if(!isset($_GET['taikhoan']) && !isset($_GET['trangthai'])){
			return redirect(base_url('admin/nguoi-dung/'));
		}

		$taikhoan = $this->input->get('taikhoan');
		$trangthai = $this->input->get('trangthai');

		if(empty($taikhoan) && empty($trangthai)){
			return redirect(base_url('admin/nguoi-dung/'));
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

		$data['title'] = "Danh sách người dùng";
		$totalRecords = $this->Model_NguoiDung->checkNumberSearch($taikhoan,$trangthai);
		$recordsPerPage = 10;
		$totalPages = ceil($totalRecords / $recordsPerPage); 

		if($trang < 1){
			return redirect(base_url('admin/nguoi-dung/'));
		}

		if($trang > $totalPages){
			return redirect(base_url('admin/nguoi-dung/'));
		}

		$start = ($trang - 1) * $recordsPerPage;


		if($start == 0){
			$data['totalPages'] = $totalPages;
			$data['list'] = $this->Model_NguoiDung->search($taikhoan,$trangthai);
			return $this->load->view('Admin/View_NguoiDungTimKiem', $data);
		}else{
			$data['totalPages'] = $totalPages;
			$data['list'] = $this->Model_NguoiDung->search($taikhoan,$trangthai,$start);
			return $this->load->view('Admin/View_NguoiDungTimKiem', $data);
		}
	}
}

/* End of file ChuyenMuc.php */
/* Location: ./application/controllers/ChuyenMuc.php */