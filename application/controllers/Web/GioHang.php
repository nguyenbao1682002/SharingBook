<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class GioHang extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Web/Model_Sach');
	}

	public function index()
	{
        $data['title'] = "Giỏ hàng";
        $cart = $this->session->userdata('cart');
        $data['list'] = $cart;
		return $this->load->view('Web/View_GioHang', $data);
	}

	public function add($product_id, $quantity) {
        $cart = $this->session->userdata('cart');
        
        if (!$cart) {
            $cart = array();
        }

        if(empty($quantity) || $quantity <= 0){
        	return;
        }
        
        if(count($this->Model_Sach->getById($product_id)) == 0){
        	return;
        }

        if($quantity > $this->Model_Sach->getById($product_id)[0]['SoLuong']){
            return;
        }

        if(isset($cart[$product_id]['number'])){
            if(($cart[$product_id]['number'] + $quantity) > $this->Model_Sach->getById($product_id)[0]['SoLuong']){
                return;
            }
        }

        if($this->session->userdata('makhachhang') == $this->Model_Sach->getById($product_id)[0]['MaNguoiDung']){
            return;
        }
        
        $price = $this->Model_Sach->getById($product_id)[0]['GiaMuon'];
        $price_root = $this->Model_Sach->getById($product_id)[0]['GiaGoc'];
        $image = $this->Model_Sach->getById($product_id)[0]['AnhChinh'];
        $name =  $this->Model_Sach->getById($product_id)[0]['TenSach'];
        $slug = $this->Model_Sach->getById($product_id)[0]['DuongDan'];
        if (isset($cart[$product_id])) {
            $cart[$product_id]['number'] += $quantity;
        } else {
            $cart[$product_id] = array(
                'id' => $product_id,
                'number' => $quantity,
                'price_root' => $price_root, 
                'price' => $price,
                'image' => $image,
                'name' => $name,
                'slug' => $slug, 
            );
        }

        $sumCart = 0;

        foreach ($cart as $key => $value) {
        	$sumCart += $value['price_root'] * $value['number'];
        }


        $this->session->set_userdata('cart', $cart);
        $this->session->set_userdata('sumCart', $sumCart);
        $this->session->set_userdata('numberCart', count($cart));

        $data = array(
		    'sumCart' => number_format($sumCart),
		    'numberCart' => count($cart),
            'cart' => $cart
		);

		$json = json_encode($data);

		echo $json;
    }

    public function updateNumber($product_id, $number){
        if(count($this->Model_Sach->getById($product_id)) == 0){
            return;
        }

        if(empty($number) || $number <= 0){
            return;
        }
        
        if($number > $this->Model_Sach->getById($product_id)[0]['SoLuong']){
            return;
        }

        if(($cart[$product_id]['number'] + $number) > $this->Model_Sach->getById($product_id)[0]['SoLuong']){
            return;
        }

        if($product_id == 0){
            $product_id = 1;
        }

        $cart = $this->session->userdata('cart');
        $cart[$product_id]['number'] = $number;
        $this->session->set_userdata('cart', $cart);

        $sumCart = 0;

        foreach ($cart as $key => $value) {
            $sumCart += $value['price'] * $value['number'];
        }

        if(isset($_SESSION['saleCode'])){
            $saleCode = $this->session->userdata('saleCode');
            $sumCart = $sumCart - $saleCode;
        }

        $this->session->set_userdata('sumCart', $sumCart);
    }

    public function delete($product_id) {
        if(count($this->Model_Sach->getById($product_id)) == 0){
            return;
        }

        $cart = $this->session->userdata('cart');
        if (isset($cart[$product_id])) {
            unset($cart[$product_id]);
        }
        $this->session->set_userdata('cart', $cart);

        $sumCart = 0;
        foreach ($cart as $key => $value) {
            $sumCart += $value['price'] * $value['number'];
        }

        if(isset($_SESSION['saleCode'])){
            $saleCode = $this->session->userdata('saleCode');
            $sumCart = $sumCart - $saleCode;
        }
        $this->session->set_userdata('sumCart', $sumCart);
        $this->session->set_userdata('numberCart', count($cart));

        if(count($cart) == 0){
            if (isset($_SESSION['saleCode'])) {
                unset($_SESSION['saleCode']);
            }

            if (isset($_SESSION['idSaleCode'])) {
                unset($_SESSION['idSaleCode']);
            }

            unset($_SESSION['cart']);
            unset($_SESSION['sumCart']);
            unset($_SESSION['numberCart']);
        }
    }
}

/* End of file GioHang.php */
/* Location: ./application/controllers/GioHang.php */