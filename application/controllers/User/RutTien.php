<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class RutTien extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->has_userdata('khachhang')){
			return redirect(base_url('dang-nhap/'));
		}
		$this->load->model('User/Model_RutTien');
	}

	public function index()
	{
		$data['title'] = "Rút tiền về ngân hàng";
		if ($this->input->server('REQUEST_METHOD') === 'POST') {
			$sotienrut = $this->input->post('sotienrut');

			if(!is_numeric($sotienrut) || $sotienrut <= 0){
				$data['error'] = "Vui lòng nhập số tiền rút hợp lệ!";
				return $this->load->view('User/View_RutTien', $data);
			}

			if($sotienrut > $this->session->userdata('sodukhadung')){
				$data['error'] = "Số tiền rút không được lớn hơn số dư khả dụng!";
				return $this->load->view('User/View_RutTien', $data);
			}

        	$this->Model_RutTien->insert($this->session->userdata('makhachhang'),$sotienrut);

        	$data['success'] = "Yêu cầu rút tiền về ngân hàng thành công! Vui lòng chờ admin xử lý!";
			return $this->load->view('User/View_RutTien', $data);

		}
		return $this->load->view('User/View_RutTien', $data);
	}

}

/* End of file RutTien.php */
/* Location: ./application/controllers/RutTien.php */