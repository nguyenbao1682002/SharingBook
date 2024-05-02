<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ThanhToan extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('cart')){
			return redirect(base_url('gio-hang/'));
		}

		if(!$this->session->userdata('khachhang')){
			$newdata = array(
				'thanhtoan' => TRUE
			);
			$this->session->set_userdata($newdata);
			$this->session->set_flashdata('redirect', 'Vui lòng đăng nhập để thanh toán!');
			return redirect(base_url('dang-nhap/'));
		}

		$array_items = array('thanhtoan');
        $this->session->unset_userdata($array_items);

        $this->load->model('Web/Model_HoaDon');
        $this->load->model('Web/Model_CauHinh');
        $this->load->model('Web/Model_SanPham');
	}

	public function index()
	{
		$data['title'] = "Thanh toán";
		$cart = $this->session->userdata('cart');
        $data['list'] = $cart;
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
        	$config = $this->Model_CauHinh->getAll();
        	$makhachhang = $this->session->userdata('makhachhang');
        	$diachi = $this->input->post('diachi').", ".$this->input->post('xa').", ".$this->input->post('huyen').", ".$this->input->post('tinh');
        	$soluong = 0;
        	$tongtien = 0;
        	$thanhtoan = $this->input->post('thanhtoan');

        	if(($thanhtoan != 0) && ($thanhtoan != 2)){
        		return redirect(base_url('thanh-toan/'));
        	}

        	foreach($cart as $key => $value){
        		$tongtien += $value['number'] * $value['price'];
        		$soluong += $value['number'];
        	}

        	if($tongtien < $config[0]['MienPhiShip']){
        		$tongtien += $config[0]['PhiShip'];
        	}

        	if($this->session->has_userdata('saleCode')){
        		$tongtien -= $this->session->userdata('saleCode');
        	}
        	
        	$mahoadon = 0;
        	if($this->session->has_userdata('idSaleCode')){
        		$magiamgia = $this->session->userdata('idSaleCode');
        		$mahoadon = $this->Model_HoaDon->addWithSale($makhachhang,$tongtien,$thanhtoan,$magiamgia,$soluong,$diachi);
        	}else{
        		$mahoadon = $this->Model_HoaDon->addWithoutSale($makhachhang,$tongtien,$thanhtoan,$soluong,$diachi);
        	}
        	
        	foreach($cart as $key => $value){
        		$this->Model_HoaDon->addDetail($mahoadon,$value['id'],$value['number']);

        		$soluongmoi = $this->Model_SanPham->getById($value['id'])[0]['SoLuong'] - $value['number'];

        		$this->Model_SanPham->updateNumber($value['id'],$soluongmoi);
        	}
        	if (isset($_SESSION['saleCode'])) {
                unset($_SESSION['saleCode']);
            }

            if (isset($_SESSION['idSaleCode'])) {
                unset($_SESSION['idSaleCode']);
            }

            unset($_SESSION['cart']);
            unset($_SESSION['sumCart']);
            unset($_SESSION['numberCart']);
        	
        	return $this->load->view('Web/View_ThanhToanThanhCong', $data);
        }
		return $this->load->view('Web/View_ThanhToan', $data);
	}

}

/* End of file ThanhToan.php */
/* Location: ./application/controllers/ThanhToan.php */