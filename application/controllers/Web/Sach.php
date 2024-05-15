<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sach extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Web/Model_Sach');
		$this->load->model('Web/Model_GiaoDien');
		$this->load->model('Web/Model_NguoiDung');
		$this->load->model('Web/Model_BinhLuan');
	}

	public function index()
	{
		$data['title'] = "Thông tin sách";
		$data['banner1'] = $this->Model_GiaoDien->getByType(2);
		$data['new'] = $this->Model_Sach->getByType(1);
		$data['sale'] = $this->Model_Sach->getByType(2);
		$data['popular'] = $this->Model_Sach->getByType(3);
		$data['categoryNumber'] = $this->Model_Sach->getCategoryNumber();

		if(isset($_GET['s']) && !empty($_GET['s'])){
			$data['totalPages'] = 0;
			$data['list'] = $this->Model_Sach->search($_GET['s']);
			return $this->load->view('Web/View_Sach', $data);
		}

		$totalRecords = $this->Model_Sach->checkNumber();
		$recordsPerPage = 9;
		$totalPages = ceil($totalRecords / $recordsPerPage); 
		$data['totalPages'] = $totalPages;
		$data['list'] = $this->Model_Sach->getAll();

		return $this->load->view('Web/View_Sach', $data);
	}

	public function page($trang){
		$data['title'] = "Thông tin sách";
		$data['banner1'] = $this->Model_GiaoDien->getByType(2);
		$data['new'] = $this->Model_Sach->getByType(1);
		$data['sale'] = $this->Model_Sach->getByType(2);
		$data['popular'] = $this->Model_Sach->getByType(3);
		$data['categoryNumber'] = $this->Model_Sach->getCategoryNumber();
		
		$totalRecords = $this->Model_Sach->checkNumber();
		$recordsPerPage = 9;
		$totalPages = ceil($totalRecords / $recordsPerPage); 

		if($trang < 1){
			return redirect(base_url('sach/'));
		}

		if($trang > $totalPages){
			return redirect(base_url('sach/'));
		}

		$start = ($trang - 1) * $recordsPerPage;


		if($start == 0){
			$data['totalPages'] = $totalPages;
			$data['list'] = $this->Model_Sach->getAll();
			return $this->load->view('Web/View_Sach', $data);
		}else{
			$data['totalPages'] = $totalPages;
			$data['list'] = $this->Model_Sach->getAll($start);
			return $this->load->view('Web/View_Sach', $data);
		}
	}

	public function detail($duongdan){
		if(count($this->Model_Sach->getBySlug($duongdan)) <= 0){
			$data['title'] = "Không tìm thấy thông tin sách!";
			return $this->load->view('Web/404', $data);
		}

		$data['title'] = $this->Model_Sach->getBySlug($duongdan)[0]['TenSach'];
		$data['detail'] = $this->Model_Sach->getBySlug($duongdan);
		$data['categoryProduct'] = $this->Model_Sach->getByCategory($this->Model_Sach->getBySlug($duongdan)[0]['MaChuyenMuc'],$this->Model_Sach->getBySlug($duongdan)[0]['MaSach']);
		$data['user'] = $this->Model_NguoiDung->getById($this->Model_Sach->getBySlug($duongdan)[0]['MaNguoiDung']);
		$data['banner1'] = $this->Model_GiaoDien->getByType(2);
		$data['new'] = $this->Model_Sach->getByType(1);
		$data['sale'] = $this->Model_Sach->getByType(2);
		$data['popular'] = $this->Model_Sach->getByType(3);
		$data['hot'] = $this->Model_Sach->getByType(4);
		$data['suggest'] = $this->Model_Sach->getSuggest();
		$data['categoryNumber'] = $this->Model_Sach->getCategoryNumber();
		$data['comment'] = $this->Model_BinhLuan->getByIdBook($this->Model_Sach->getBySlug($duongdan)[0]['MaSach']);
		return $this->load->view('Web/View_ChiTietSach', $data);
	}

}

/* End of file SanPham.php */
/* Location: ./application/controllers/SanPham.php */