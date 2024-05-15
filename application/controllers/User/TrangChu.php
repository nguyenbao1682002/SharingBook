<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class TrangChu extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->has_userdata('khachhang')){
			return redirect(base_url('dang-nhap/'));
		}

		$this->load->model('User/Model_TrangChu');
	}

	public function index()
	{
		$data['title'] = "Trang quản trị cho người dùng";
		$data['countBook'] = $this->Model_TrangChu->countBook($this->session->userdata('makhachhang'));
		$data['doanhThuNgay'] = $this->Model_TrangChu->doanhThuNgay($this->session->userdata('makhachhang'));
		$data['choMuonNgay'] = $this->Model_TrangChu->choMuonNgay($this->session->userdata('makhachhang'));
		$data['traTrongNgay'] = $this->Model_TrangChu->traTrongNgay($this->session->userdata('makhachhang'));
		$data['doanhThuTuan'] = $this->Model_TrangChu->doanhThuTuan($this->session->userdata('makhachhang'));
		$data['choMuonTuan'] = $this->Model_TrangChu->choMuonTuan($this->session->userdata('makhachhang'));
		$data['traTrongTuan'] = $this->Model_TrangChu->traTrongTuan($this->session->userdata('makhachhang'));
		return $this->load->view('User/View_TrangChu', $data);
	}

	public function sumRevenue(){
		$data = array();

		for($i = 1; $i <= 12; $i++){
			$list = $this->Model_TrangChu->getSumRevenue($i,$this->session->userdata('makhachhang'));
			if(empty($list[0]['TongTien']) || !isset($list[0]['TongTien']) || $list[0]['TongTien'] == null){
				array_push($data,0);
			}else{
				array_push($data,(int)$list[0]['TongTien']);
			}
		}

		$data = json_encode($data);

		echo $data;
	}

	public function sumOrder(){
		$data = array();

		for($i = 1; $i <= 12; $i++){
			$list = $this->Model_TrangChu->getSumOrder($i,$this->session->userdata('makhachhang'));
			if(empty($list[0]['TongDon']) || !isset($list[0]['TongDon']) || $list[0]['TongDon'] == null){
				array_push($data,0);
			}else{
				array_push($data,(int)$list[0]['TongDon']);
			}
		}

		$data = json_encode($data);

		echo $data;
	}

}

/* End of file TrangChu.php */
/* Location: ./application/controllers/TrangChu.php */