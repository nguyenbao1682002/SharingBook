<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class BinhLuan extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->has_userdata('khachhang')){
			return redirect(base_url('dang-nhap/'));
		}

		$this->load->model('Web/Model_BinhLuan');
	}

	public function add()
	{	
		$masach = $this->input->post('masach');
		$manguoidung = $this->session->userdata('makhachhang');
		$noidung = $this->input->post('noidung');
		$sosao = $this->input->post('sosao');
		$thoigian = $this->input->post('thoigian');

		if($noidung != ""){
			$this->Model_BinhLuan->insert($manguoidung,$masach,$noidung,$sosao,$thoigian);
		}
	}

}

/* End of file BinhLuan.php */
/* Location: ./application/controllers/BinhLuan.php */