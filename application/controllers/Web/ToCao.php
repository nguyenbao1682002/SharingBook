<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ToCao extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->has_userdata('khachhang')){
			$this->session->set_flashdata('redirect', 'Vui lòng đăng nhập để gửi tố cáo!');
			return redirect(base_url('dang-nhap/'));
		}
		$this->load->model('Web/Model_ToCao');
		$this->load->model('Web/Model_NguoiDung');
	}

	public function index()
	{
		$data['title'] = "Tố cáo";
		$nannhan = $this->input->get('id');

		if(count($this->Model_NguoiDung->getById($nannhan)) <= 0){
			return redirect(base_url('nguoi-dung/'));
		}

		$data['taikhoan'] = $this->Model_NguoiDung->getById($nannhan)[0]['TaiKhoan'];

		if ($this->input->server('REQUEST_METHOD') === 'POST') {
			$manguoidung = $this->session->userdata('makhachhang');
			$tieude = $this->input->post('tieude');
			$noidung = $this->input->post('noidung');

			if($tieude == "" || $noidung == ""){
				$data['error'] = "Vui lòng nhập đủ thông tin tố cáo!";
				return $this->load->view('Web/View_ToCao', $data);
			}

			$this->Model_ToCao->insert($manguoidung,$nannhan,$tieude,$noidung);
			$data['success'] = "Cảm ơn bạn đã gửi tố cáo với chúng tôi!";
			return $this->load->view('Web/View_ToCao', $data);
		}
		return $this->load->view('Web/View_ToCao', $data);
	}

}

/* End of file LienHe.php */
/* Location: ./application/controllers/LienHe.php */