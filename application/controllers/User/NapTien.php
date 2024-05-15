<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class NapTien extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->has_userdata('khachhang')){
			return redirect(base_url('dang-nhap/'));
		}
		$this->load->model('Web/Model_NapTien');
	}

	public function index()
	{
		$data['title'] = "Nạp tiền vào tài khoản";
		if ($this->input->server('REQUEST_METHOD') === 'POST') {
			$sotiennap = $this->input->post('sotiennap');

			if(!is_numeric($sotiennap) || $sotiennap <= 0){
				$data['error'] = "Vui lòng nhập số tiền nạp hợp lệ!";
				return $this->load->view('User/View_NapTien', $data);
			}

        	$this->Model_NapTien->insert($this->session->userdata('makhachhang'),$sotiennap);

        	$data['success'] = "Nạp tiền thành công, vui lòng chờ admin cộng tiền!";
			return $this->load->view('User/View_NapTien', $data);

		}
		return $this->load->view('User/View_NapTien', $data);
	}

}

/* End of file NapTien.php */
/* Location: ./application/controllers/NapTien.php */