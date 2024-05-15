<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class BinhLuan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->has_userdata('khachhang')){
			return redirect(base_url('dang-nhap/'));
		}

		$this->load->model('User/Model_BinhLuan');
	}

	public function index()
	{
		$totalRecords = $this->Model_BinhLuan->checkNumber($this->session->userdata('makhachhang'));
		$recordsPerPage = 10;
		$totalPages = ceil($totalRecords / $recordsPerPage); 

		$data['totalPages'] = $totalPages;
		$data['list'] = $this->Model_BinhLuan->getAll($this->session->userdata('makhachhang'));
		$data['title'] = "Danh sách bình luận";
		return $this->load->view('User/View_BinhLuan', $data);
	}

	public function page($trang){
		$data['title'] = "Danh sách bình luận";
		$totalRecords = $this->Model_BinhLuan->checkNumber($this->session->userdata('makhachhang'));
		$recordsPerPage = 10;
		$totalPages = ceil($totalRecords / $recordsPerPage); 

		if($trang < 1){
			return redirect(base_url('user/binh-luan/'));
		}

		if($trang > $totalPages){
			return redirect(base_url('user/binh-luan/'));
		}

		$start = ($trang - 1) * $recordsPerPage;


		if($start == 0){
			$data['totalPages'] = $totalPages;
			$data['list'] = $this->Model_BinhLuan->getAll($this->session->userdata('makhachhang'));
			return $this->load->view('User/View_BinhLuan', $data);
		}else{
			$data['totalPages'] = $totalPages;
			$data['list'] = $this->Model_BinhLuan->getAll($this->session->userdata('makhachhang'),$start);
			return $this->load->view('User/View_BinhLuan', $data);
		}
	}

	public function view($mabinhluan)
	{
		if(count($this->Model_BinhLuan->getById($this->session->userdata('makhachhang'),$mabinhluan)) <= 0){
			$this->session->set_flashdata('error', 'Bình luận không tồn tại!');
			return redirect(base_url('user/binh-luan/'));
		}

		$data['title'] = "Xem thông tin bình luận";
		$data['detail'] = $this->Model_BinhLuan->getById($this->session->userdata('makhachhang'),$mabinhluan);
		return $this->load->view('User/View_XemBinhLuan', $data);
	}

	public function search()
	{
		if(!isset($_GET['tensach']) && !isset($_GET['sosao'])){
			return redirect(base_url('user/binh-luan/'));
		}

		$tensach = $this->input->get('tensach');
		$sosao = $this->input->get('sosao');

		if(empty($tensach) && empty($sosao)){
			return redirect(base_url('user/binh-luan/'));
		}

		
		$data['post'] = array(
			'tensach' => $tensach,
			'sosao' => $sosao
		);

		if($sosao == -1){
			$sosao = 0;
		}

		$totalRecords = $this->Model_BinhLuan->checkNumberSearch($this->session->userdata('makhachhang'),$tensach,$sosao);
		$recordsPerPage = 10;
		$totalPages = ceil($totalRecords / $recordsPerPage); 

		$data['totalPages'] = $totalPages;
		$data['list'] = $this->Model_BinhLuan->search($this->session->userdata('makhachhang'),$tensach,$sosao);
		$data['title'] = "Danh sách bình luận";
		return $this->load->view('User/View_BinhLuanTimKiem', $data);

	}


	public function pageSearch($trang){
		if(!isset($_GET['tensach']) && !isset($_GET['sosao'])){
			return redirect(base_url('user/binh-luan/'));
		}

		$tensach = $this->input->get('tensach');
		$sosao = $this->input->get('sosao');

		if(empty($tensach) && empty($sosao)){
			return redirect(base_url('user/binh-luan/'));
		}

		
		$data['post'] = array(
			'tensach' => $tensach,
			'sosao' => $sosao
		);

		if($sosao == -1){
			$sosao = 0;
		}


		$data['title'] = "Danh sách bình luận";
		$totalRecords = $this->Model_BinhLuan->checkNumberSearch($this->session->userdata('makhachhang'),$tensach,$sosao);
		$recordsPerPage = 10;
		$totalPages = ceil($totalRecords / $recordsPerPage); 

		if($trang < 1){
			return redirect(base_url('user/binh-luan/'));
		}

		if($trang > $totalPages){
			return redirect(base_url('user/binh-luan/'));
		}

		$start = ($trang - 1) * $recordsPerPage;


		if($start == 0){
			$data['totalPages'] = $totalPages;
			$data['list'] = $this->Model_BinhLuan->search($this->session->userdata('makhachhang'),$tensach,$sosao);
			return $this->load->view('User/View_BinhLuanTimKiem', $data);
		}else{
			$data['totalPages'] = $totalPages;
			$data['list'] = $this->Model_BinhLuan->search($this->session->userdata('makhachhang'),$tensach,$sosao,$start);
			return $this->load->view('User/View_BinhLuanTimKiem', $data);
		}
	}
}

/* End of file BinhLuan.php */
/* Location: ./application/controllers/BinhLuan.php */
