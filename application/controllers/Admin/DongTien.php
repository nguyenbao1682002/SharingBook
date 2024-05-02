<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DongTien extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->has_userdata('taikhoan')){
			return redirect(base_url('admin/dang-nhap/'));
		}

		$this->load->model('Admin/Model_DongTien');
	}

	public function index()
	{
		$totalRecords = $this->Model_DongTien->checkNumber();
		$recordsPerPage = 10;
		$totalPages = ceil($totalRecords / $recordsPerPage); 

		$data['totalPages'] = $totalPages;
		$data['list'] = $this->Model_DongTien->getAll();
		$data['title'] = "Danh sách dòng tiền người dùng";
		return $this->load->view('Admin/View_DongTien', $data);
	}

	public function page($trang){
		$data['title'] = "Danh sách dòng tiền người dùng";
		$totalRecords = $this->Model_DongTien->checkNumber();
		$recordsPerPage = 10;
		$totalPages = ceil($totalRecords / $recordsPerPage); 

		if($trang < 1){
			return redirect(base_url('admin/dong-tien/'));
		}

		if($trang > $totalPages){
			return redirect(base_url('admin/dong-tien/'));
		}

		$start = ($trang - 1) * $recordsPerPage;


		if($start == 0){
			$data['totalPages'] = $totalPages;
			$data['list'] = $this->Model_DongTien->getAll();
			return $this->load->view('Admin/View_DongTien', $data);
		}else{
			$data['totalPages'] = $totalPages;
			$data['list'] = $this->Model_DongTien->getAll($start);
			return $this->load->view('Admin/View_DongTien', $data);
		}
	}

	public function search(){
		if(!isset($_GET['taikhoan']) && !isset($_GET['thoigian'])){
			return redirect(base_url('admin/dong-tien/'));
		}

		$taikhoan = $this->input->get('taikhoan');
		$thoigian = $this->input->get('thoigian');

		if(empty($taikhoan) && empty($thoigian)){
			return redirect(base_url('admin/dong-tien/'));
		}

		
		$data['post'] = array(
			'taikhoan' => $taikhoan,
			'thoigian' => $thoigian
		);

		if(empty($taikhoan)){
			$taikhoan = -1;
		}

		$totalRecords = $this->Model_DongTien->checkNumberSearch($taikhoan,$thoigian);
		$recordsPerPage = 10;
		$totalPages = ceil($totalRecords / $recordsPerPage); 

		$data['totalPages'] = $totalPages;
		$data['list'] = $this->Model_DongTien->search($taikhoan,$thoigian);
		$data['title'] = "Danh sách dòng tiền người dùng";
		return $this->load->view('Admin/View_DongTienTimKiem', $data);
	}

	public function pageSearch($trang){
		if(!isset($_GET['taikhoan']) && !isset($_GET['thoigian'])){
			return redirect(base_url('admin/dong-tien/'));
		}

		$taikhoan = $this->input->get('taikhoan');
		$thoigian = $this->input->get('thoigian');

		if(empty($taikhoan) && empty($thoigian)){
			return redirect(base_url('admin/dong-tien/'));
		}

		
		$data['post'] = array(
			'taikhoan' => $taikhoan,
			'thoigian' => $thoigian
		);

		if(empty($taikhoan)){
			$taikhoan = -1;
		}

		$data['title'] = "Danh sách dòng tiền người dùng";
		$totalRecords = $this->Model_DongTien->checkNumberSearch($taikhoan,$thoigian);
		$recordsPerPage = 10;
		$totalPages = ceil($totalRecords / $recordsPerPage); 

		if($trang < 1){
			return redirect(base_url('admin/dong-tien/'));
		}

		if($trang > $totalPages){
			return redirect(base_url('admin/dong-tien/'));
		}

		$start = ($trang - 1) * $recordsPerPage;


		if($start == 0){
			$data['totalPages'] = $totalPages;
			$data['list'] = $this->Model_DongTien->search($taikhoan,$thoigian);
			return $this->load->view('Admin/View_DongTienTimKiem', $data);
		}else{
			$data['totalPages'] = $totalPages;
			$data['list'] = $this->Model_DongTien->search($taikhoan,$thoigian,$start);
			return $this->load->view('Admin/View_DongTienTimKiem', $data);
		}
	}

}

/* End of file ChuyenMuc.php */
/* Location: ./application/controllers/ChuyenMuc.php */