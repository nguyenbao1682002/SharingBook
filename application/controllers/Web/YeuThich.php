<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class YeuThich extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->has_userdata('khachhang')){
			return redirect(base_url('dang-nhap/'));
		}

		$this->load->model('Web/Model_YeuThich');
	}

	public function index()
	{
		$data['title'] = "Danh sách yêu thích";
		$data['list'] = $this->Model_YeuThich->getByIdUser($this->session->userdata('makhachhang'));
		return $this->load->view('Web/View_YeuThich', $data);
	}

	public function add($masach){
		if(count($this->Model_YeuThich->checkIdBook($this->session->userdata('makhachhang'),$masach)) >= 1){
			echo count($this->Model_YeuThich->getByIdUser($this->session->userdata('makhachhang')));
			return;
		}

		$this->Model_YeuThich->insert($this->session->userdata('makhachhang'),$masach);

		echo count($this->Model_YeuThich->getByIdUser($this->session->userdata('makhachhang')));
	}

	public function delete($masach){
		$this->Model_YeuThich->delete($this->session->userdata('makhachhang'),$masach);
		return redirect(base_url('yeu-thich/'));
	}

}

/* End of file YeuThich.php */
/* Location: ./application/controllers/YeuThich.php */