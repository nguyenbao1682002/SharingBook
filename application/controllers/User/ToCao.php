<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ToCao extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->has_userdata('khachhang')){
			return redirect(base_url('dang-nhap/'));
		}

		$this->load->model('User/Model_ToCao');
		$this->load->model('Admin/Model_NguoiDung');
	}

	public function index()
	{
		$totalRecords = $this->Model_ToCao->checkNumber($this->session->userdata('makhachhang'));
		$recordsPerPage = 10;
		$totalPages = ceil($totalRecords / $recordsPerPage); 

		$data['totalPages'] = $totalPages;
		$data['list'] = $this->Model_ToCao->getAll($this->session->userdata('makhachhang'));
		$data['title'] = "Danh sách tố cáo";
		return $this->load->view('User/View_ToCao', $data);
	}

	public function page($trang){
		$data['title'] = "Danh sách tố cáo";
		$totalRecords = $this->Model_ToCao->checkNumber($this->session->userdata('makhachhang'));
		$recordsPerPage = 10;
		$totalPages = ceil($totalRecords / $recordsPerPage); 

		if($trang < 1){
			return redirect(base_url('user/to-cao/'));
		}

		if($trang > $totalPages){
			return redirect(base_url('user/to-cao/'));
		}

		$start = ($trang - 1) * $recordsPerPage;


		if($start == 0){
			$data['totalPages'] = $totalPages;
			$data['list'] = $this->Model_ToCao->getAll($this->session->userdata('makhachhang'));
			return $this->load->view('User/View_ToCao', $data);
		}else{
			$data['totalPages'] = $totalPages;
			$data['list'] = $this->Model_ToCao->getAll($this->session->userdata('makhachhang'),$start);
			return $this->load->view('User/View_ToCao', $data);
		}
	}

	public function action($hanhdong){
		if(!isset($_GET['matocao'])){
			return redirect(base_url('user/to-cao/'));
		}

		$matocao = $this->input->get('matocao');

		if(count($this->Model_ToCao->getById($this->session->userdata('makhachhang'),$matocao)) <= 0){
			$this->session->set_flashdata('error', 'Thông tin tố cáo không tồn tại!');
			return redirect(base_url('user/to-cao/'));
		}

		if($hanhdong != -1){
			$this->session->set_flashdata('error', 'Vui lòng chọn hành động xử lý phù hợp!');
			return redirect(base_url('user/to-cao/'.$matocao.'/xem/'));
		}

		$manguoitocao = $this->Model_ToCao->getById($this->session->userdata('makhachhang'),$matocao)[0]['MaNguoiDung'];
		$manguoibitocao = $this->Model_ToCao->getById($this->session->userdata('makhachhang'),$matocao)[0]['NanNhan'];

		$this->Model_ToCao->status($hanhdong,$matocao);

		$this->session->set_flashdata('success', 'Xác nhận hủy tố cáo thành công!');
		return redirect(base_url('user/to-cao/'.$matocao.'/xem/'));
	}


	public function view($maToCao)
	{
		if(count($this->Model_ToCao->getById($this->session->userdata('makhachhang'),$maToCao)) <= 0){
			$this->session->set_flashdata('error', 'Thông tin tố cáo không tồn tại!');
			return redirect(base_url('user/to-cao/'));
		}

		$data['title'] = "Xem thông tin tố cáo";
		$data['detail'] = $this->Model_ToCao->getById($this->session->userdata('makhachhang'),$maToCao);
		return $this->load->view('User/View_XemToCao', $data);
	}

	public function search()
	{
		if(!isset($_GET['nguoibitocao'])){
			return redirect(base_url('user/to-cao/'));
		}

		$nguoibitocao = $this->input->get('nguoibitocao');

		if(empty($nguoibitocao)){
			return redirect(base_url('user/to-cao/'));
		}

		$data['post'] = array(
			'nguoibitocao' => $nguoibitocao
		);

		$nannhan = count($this->Model_NguoiDung->getIdUser($nguoibitocao)) == 0 ? -1 : $this->Model_NguoiDung->getIdUser($nguoibitocao)[0]['MaNguoiDung'];

		$totalRecords = $this->Model_ToCao->checkNumberSearch($this->session->userdata('makhachhang'),$nannhan);
		$recordsPerPage = 10;
		$totalPages = ceil($totalRecords / $recordsPerPage); 

		$data['totalPages'] = $totalPages;
		$data['list'] = $this->Model_ToCao->search($this->session->userdata('makhachhang'),$nannhan);
		$data['title'] = "Danh sách tố cáo";
		return $this->load->view('User/View_ToCaoTimKiem', $data);

	}


	public function pageSearch($trang){
		if(!isset($_GET['nguoibitocao'])){
			return redirect(base_url('user/to-cao/'));
		}

		$nguoibitocao = $this->input->get('nguoibitocao');

		if(empty($nguoibitocao)){
			return redirect(base_url('user/to-cao/'));
		}

		$data['post'] = array(
			'nguoibitocao' => $nguoibitocao
		);

		$nannhan = count($this->Model_NguoiDung->getIdUser($nguoibitocao)) == 0 ? -1 : $this->Model_NguoiDung->getIdUser($nguoibitocao)[0]['MaNguoiDung'];

		$data['title'] = "Danh sách tố cáo";
		$totalRecords = $this->Model_ToCao->checkNumberSearch($this->session->userdata('makhachhang'),$nannhan);
		$recordsPerPage = 10;
		$totalPages = ceil($totalRecords / $recordsPerPage); 

		if($trang < 1){
			return redirect(base_url('user/to-cao/'));
		}

		if($trang > $totalPages){
			return redirect(base_url('user/to-cao/'));
		}

		$start = ($trang - 1) * $recordsPerPage;


		if($start == 0){
			$data['totalPages'] = $totalPages;
			$data['list'] = $this->Model_ToCao->search($this->session->userdata('makhachhang'),$nannhan);
			return $this->load->view('User/View_ToCaoTimKiem', $data);
		}else{
			$data['totalPages'] = $totalPages;
			$data['list'] = $this->Model_ToCao->search($this->session->userdata('makhachhang'),$nannhan,$start);
			return $this->load->view('User/View_ToCaoTimKiem', $data);
		}
	}
}

/* End of file ToCao.php */
/* Location: ./application/controllers/ToCao.php */
