<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DongTien extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->has_userdata('khachhang')){
			return redirect(base_url('dang-nhap/'));
		}

		$this->load->model('User/Model_DongTien');
	}

	public function index()
	{
		$totalRecords = $this->Model_DongTien->checkNumber($this->session->userdata('makhachhang'));
		$recordsPerPage = 10;
		$totalPages = ceil($totalRecords / $recordsPerPage); 

		$data['totalPages'] = $totalPages;
		$data['list'] = $this->Model_DongTien->getAll($this->session->userdata('makhachhang'));
		$data['title'] = "Danh sách dòng tiền người dùng";
		return $this->load->view('User/View_DongTien', $data);
	}

	public function page($trang){
		$data['title'] = "Danh sách dòng tiền người dùng";
		$totalRecords = $this->Model_DongTien->checkNumber($this->session->userdata('makhachhang'));
		$recordsPerPage = 10;
		$totalPages = ceil($totalRecords / $recordsPerPage); 

		if($trang < 1){
			return redirect(base_url('User/dong-tien/'));
		}

		if($trang > $totalPages){
			return redirect(base_url('User/dong-tien/'));
		}

		$start = ($trang - 1) * $recordsPerPage;


		if($start == 0){
			$data['totalPages'] = $totalPages;
			$data['list'] = $this->Model_DongTien->getAll($this->session->userdata('makhachhang'));
			return $this->load->view('User/View_DongTien', $data);
		}else{
			$data['totalPages'] = $totalPages;
			$data['list'] = $this->Model_DongTien->getAll($this->session->userdata('makhachhang'),$start);
			return $this->load->view('User/View_DongTien', $data);
		}
	}

	public function search(){
		if(!isset($_GET['taikhoan']) && !isset($_GET['thoigian'])){
			return redirect(base_url('User/dong-tien/'));
		}

		$thoigian = $this->input->get('thoigian');

		if(empty($thoigian)){
			return redirect(base_url('User/dong-tien/'));
		}

		
		$data['post'] = array(
			'thoigian' => $thoigian
		);


		$totalRecords = $this->Model_DongTien->checkNumberSearch($this->session->userdata('makhachhang'),$thoigian);
		$recordsPerPage = 10;
		$totalPages = ceil($totalRecords / $recordsPerPage); 

		$data['totalPages'] = $totalPages;
		$data['list'] = $this->Model_DongTien->search($this->session->userdata('makhachhang'),$thoigian);
		$data['title'] = "Danh sách dòng tiền người dùng";
		return $this->load->view('User/View_DongTienTimKiem', $data);
	}

	public function pageSearch($trang){
		if(!isset($_GET['taikhoan']) && !isset($_GET['thoigian'])){
			return redirect(base_url('User/dong-tien/'));
		}

		$thoigian = $this->input->get('thoigian');

		if(empty($thoigian)){
			return redirect(base_url('User/dong-tien/'));
		}

		
		$data['post'] = array(
			'thoigian' => $thoigian
		);

		$data['title'] = "Danh sách dòng tiền người dùng";
		$totalRecords = $this->Model_DongTien->checkNumberSearch($this->session->userdata('makhachhang'),$thoigian);
		$recordsPerPage = 10;
		$totalPages = ceil($totalRecords / $recordsPerPage); 

		if($trang < 1){
			return redirect(base_url('User/dong-tien/'));
		}

		if($trang > $totalPages){
			return redirect(base_url('User/dong-tien/'));
		}

		$start = ($trang - 1) * $recordsPerPage;


		if($start == 0){
			$data['totalPages'] = $totalPages;
			$data['list'] = $this->Model_DongTien->search($this->session->userdata('makhachhang'),$thoigian);
			return $this->load->view('User/View_DongTienTimKiem', $data);
		}else{
			$data['totalPages'] = $totalPages;
			$data['list'] = $this->Model_DongTien->search($this->session->userdata('makhachhang'),$thoigian,$start);
			return $this->load->view('User/View_DongTienTimKiem', $data);
		}
	}

}

/* End of file ChuyenMuc.php */
/* Location: ./application/controllers/ChuyenMuc.php */