<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ToCao extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->has_userdata('taikhoan')){
			return redirect(base_url('admin/dang-nhap/'));
		}

		$this->load->model('Admin/Model_ToCao');
		$this->load->model('Admin/Model_NguoiDung');
	}

	public function index()
	{
		$totalRecords = $this->Model_ToCao->checkNumber();
		$recordsPerPage = 10;
		$totalPages = ceil($totalRecords / $recordsPerPage); 

		$data['totalPages'] = $totalPages;
		$data['list'] = $this->Model_ToCao->getAll();
		$data['title'] = "Danh sách tố cáo";
		return $this->load->view('Admin/View_ToCao', $data);
	}

	public function page($trang){
		$data['title'] = "Danh sách tố cáo";
		$totalRecords = $this->Model_ToCao->checkNumber();
		$recordsPerPage = 10;
		$totalPages = ceil($totalRecords / $recordsPerPage); 

		if($trang < 1){
			return redirect(base_url('admin/to-cao/'));
		}

		if($trang > $totalPages){
			return redirect(base_url('admin/to-cao/'));
		}

		$start = ($trang - 1) * $recordsPerPage;


		if($start == 0){
			$data['totalPages'] = $totalPages;
			$data['list'] = $this->Model_ToCao->getAll();
			return $this->load->view('Admin/View_ToCao', $data);
		}else{
			$data['totalPages'] = $totalPages;
			$data['list'] = $this->Model_ToCao->getAll($start);
			return $this->load->view('Admin/View_ToCao', $data);
		}
	}

	public function action($hanhdong){
		if(!isset($_GET['matocao'])){
			return redirect(base_url('admin/to-cao/'));
		}

		$matocao = $this->input->get('matocao');

		if(count($this->Model_ToCao->getById($matocao)) <= 0){
			$this->session->set_flashdata('error', 'Thông tin tố cáo không tồn tại!');
			return redirect(base_url('admin/to-cao/'));
		}

		if(($hanhdong != 0) && ($hanhdong != 2) && ($hanhdong != 3)){
			$this->session->set_flashdata('error', 'Vui lòng chọn hành động xử lý phù hợp!');
			return redirect(base_url('admin/to-cao/'.$matocao.'/xem/'));
		}

		$manguoitocao = $this->Model_ToCao->getById($matocao)[0]['MaNguoiDung'];
		$manguoibitocao = $this->Model_ToCao->getById($matocao)[0]['NanNhan'];

		$this->Model_ToCao->status($hanhdong,$matocao);

		if($hanhdong == 2){
			$this->Model_NguoiDung->updateStatus(0,$manguoitocao);
			$this->session->set_flashdata('success', 'Đã cấm tài khoản người tố cáo!');
			return redirect(base_url('admin/to-cao/'.$matocao.'/xem/'));
		}

		if($hanhdong == 3){
			$this->Model_NguoiDung->updateStatus(0,$manguoibitocao);
			$this->session->set_flashdata('success', 'Đã cấm tài khoản người tố bị cáo!');
			return redirect(base_url('admin/to-cao/'.$matocao.'/xem/'));
		}

	
		$this->session->set_flashdata('success', 'Xác nhận không xử lý thông tin tố cáo!');
		return redirect(base_url('admin/to-cao/'.$matocao.'/xem/'));
	}


	public function view($maToCao)
	{
		if(count($this->Model_ToCao->getById($maToCao)) <= 0){
			$this->session->set_flashdata('error', 'Thông tin tố cáo không tồn tại!');
			return redirect(base_url('admin/to-cao/'));
		}

		$data['title'] = "Xem thông tin tố cáo";
		$data['detail'] = $this->Model_ToCao->getById($maToCao);
		return $this->load->view('Admin/View_XemToCao', $data);
	}

	public function search()
	{
		if(!isset($_GET['nguoitocao']) && !isset($_GET['nguoibitocao'])){
			return redirect(base_url('admin/to-cao/'));
		}

		$nguoitocao = $this->input->get('nguoitocao');
		$nguoibitocao = $this->input->get('nguoibitocao');

		if(empty($nguoitocao) && empty($nguoibitocao)){
			return redirect(base_url('admin/to-cao/'));
		}

		$data['post'] = array(
			'nguoitocao' => $nguoitocao,
			'nguoibitocao' => $nguoibitocao
		);

		$manguoidung = count($this->Model_NguoiDung->getIdUser($nguoitocao)) == 0 ? -1 : $this->Model_NguoiDung->getIdUser($nguoitocao)[0]['MaNguoiDung'];
		$nannhan = count($this->Model_NguoiDung->getIdUser($nguoibitocao)) == 0 ? -1 : $this->Model_NguoiDung->getIdUser($nguoibitocao)[0]['MaNguoiDung'];

		$totalRecords = $this->Model_ToCao->checkNumberSearch($manguoidung,$nannhan);
		$recordsPerPage = 10;
		$totalPages = ceil($totalRecords / $recordsPerPage); 

		$data['totalPages'] = $totalPages;
		$data['list'] = $this->Model_ToCao->search($manguoidung,$nannhan);
		$data['title'] = "Danh sách tố cáo";
		return $this->load->view('Admin/View_ToCaoTimKiem', $data);

	}


	public function pageSearch($trang){
		if(!isset($_GET['nguoitocao']) && !isset($_GET['nguoibitocao'])){
			return redirect(base_url('admin/to-cao/'));
		}

		$nguoitocao = $this->input->get('nguoitocao');
		$nguoibitocao = $this->input->get('nguoibitocao');

		if(empty($nguoitocao) && empty($nguoibitocao)){
			return redirect(base_url('admin/to-cao/'));
		}

		$data['post'] = array(
			'nguoitocao' => $nguoitocao,
			'nguoibitocao' => $nguoibitocao
		);

		$manguoidung = count($this->Model_NguoiDung->getIdUser($nguoitocao)) == 0 ? -1 : $this->Model_NguoiDung->getIdUser($nguoitocao)[0]['MaNguoiDung'];
		$nannhan = count($this->Model_NguoiDung->getIdUser($nguoibitocao)) == 0 ? -1 : $this->Model_NguoiDung->getIdUser($nguoibitocao)[0]['MaNguoiDung'];

		$data['title'] = "Danh sách tố cáo";
		$totalRecords = $this->Model_ToCao->checkNumberSearch($manguoidung,$nannhan);
		$recordsPerPage = 10;
		$totalPages = ceil($totalRecords / $recordsPerPage); 

		if($trang < 1){
			return redirect(base_url('admin/to-cao/'));
		}

		if($trang > $totalPages){
			return redirect(base_url('admin/to-cao/'));
		}

		$start = ($trang - 1) * $recordsPerPage;


		if($start == 0){
			$data['totalPages'] = $totalPages;
			$data['list'] = $this->Model_ToCao->search($manguoidung,$nannhan);
			return $this->load->view('Admin/View_ToCaoTimKiem', $data);
		}else{
			$data['totalPages'] = $totalPages;
			$data['list'] = $this->Model_ToCao->search($manguoidung,$nannhan,$start);
			return $this->load->view('Admin/View_ToCaoTimKiem', $data);
		}
	}
}

/* End of file ToCao.php */
/* Location: ./application/controllers/ToCao.php */
