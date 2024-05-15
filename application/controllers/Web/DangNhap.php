<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DangNhap extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		if($this->session->has_userdata('khachhang')){
			return redirect(base_url('khach-hang/'));
		}

		$this->load->model('Web/Model_DangNhap');
		$this->load->model('Web/Model_NguoiDung');
	}

	public function index()
	{
		$data['title'] = "Đăng nhập";
		if ($this->input->server('REQUEST_METHOD') === 'POST') {
			$taikhoan = $this->input->post('taikhoan');
			$matkhau = $this->input->post('matkhau');

			if($taikhoan == "" || $matkhau == ""){
				$data["error"] = "Tài khoản hoặc mật khẩu không được trống!";
				return $this->load->view('Web/View_DangNhap', $data);
			}


			if (!preg_match('/^[a-zA-Z0-9_]{3,20}$/', $taikhoan)) {
			    $data["error"] = "Tài khoản không hợp lệ!";
				return $this->load->view('Web/View_DangNhap', $data);
			} 

			if($this->Model_DangNhap->checkAccount($taikhoan, md5($matkhau)) >= 1){
				if($this->Model_DangNhap->checkAccountBlock($taikhoan) >= 1){
					$data["error"] = "Tài khoản đã bị cấm khỏi hệ thống!";
					return $this->load->view('Web/View_DangNhap', $data);
				}else{
					$newdata = array(
						'makhachhang' => $this->Model_DangNhap->getInfoByUsername($taikhoan)[0]['MaNguoiDung'],
					    'khachhang'  => $taikhoan,
					    'hoten' => $this->Model_DangNhap->getInfoByUsername($taikhoan)[0]['HoTen'],
					    'anhchinh' => $this->Model_DangNhap->getInfoByUsername($taikhoan)[0]['AnhChinh'],
					    'sodienthoai' => $this->Model_DangNhap->getInfoByUsername($taikhoan)[0]['SoDienThoai'],
					    'email' => $this->Model_DangNhap->getInfoByUsername($taikhoan)[0]['Email'],
					    'diachi' => $this->Model_DangNhap->getInfoByUsername($taikhoan)[0]['DiaChi'],
					    'nganhang' => $this->Model_DangNhap->getInfoByUsername($taikhoan)[0]['TenNganHang'],
					    'sotaikhoan' => $this->Model_DangNhap->getInfoByUsername($taikhoan)[0]['SoTaiKhoan'],
					    'chutaikhoan' => $this->Model_DangNhap->getInfoByUsername($taikhoan)[0]['ChuTaiKhoan'],
					    'sodukhadung' => $this->Model_DangNhap->getWallet($this->Model_DangNhap->getInfoByUsername($taikhoan)[0]['MaNguoiDung'])[0]['SoDuKhaDung'],
					    'dasudung' => $this->Model_DangNhap->getWallet($this->Model_DangNhap->getInfoByUsername($taikhoan)[0]['MaNguoiDung'])[0]['DaSuDung'],
					    'tongnap' => $this->Model_DangNhap->getWallet($this->Model_DangNhap->getInfoByUsername($taikhoan)[0]['MaNguoiDung'])[0]['TongNap'],
					);
					$this->session->set_userdata($newdata);

			        if($this->session->has_userdata('thanhtoan')){
			            return redirect(base_url('thanh-toan/'));
			        }
					
					return redirect(base_url('nguoi-dung/'));
				}
				
			}else{
				$data["error"] = "Tài khoản hoặc mật khẩu không đúng";
				return $this->load->view('Web/View_DangNhap', $data);
			}
		}
		return $this->load->view('Web/View_DangNhap', $data);
	}

	public function register(){
		$data['title'] = "Đăng ký";
		if ($this->input->server('REQUEST_METHOD') === 'POST') {
			$hoten = $this->input->post('hoten');
			$sodienthoai = $this->input->post('sodienthoai');
			$email = $this->input->post('email');
			$taikhoan = $this->input->post('taikhoan');
			$tennganhang = $this->input->post('nganhang');
			$sotaikhoan = $this->input->post('sotaikhoan');
			$chutaikhoan = $this->input->post('chutaikhoan');
			$matkhau = $this->input->post('matkhau');

			if($taikhoan == "" || $matkhau == "" || $sodienthoai == "" || $hoten == "" || $email == "" || $tennganhang == "" || $sotaikhoan == "" || $chutaikhoan == ""){
				$data["error"] = "Vui lòng nhập đủ thông tin khách hàng!";
				return $this->load->view('Web/View_DangKy', $data);
			}

			if (!preg_match('/^[a-zA-Z0-9_]{3,20}$/', $taikhoan)) {
			    $data["error"] = "Tài khoản không hợp lệ!";
				return $this->load->view('Web/View_DangKy', $data);
			} 

			$pattern = '/^(0|\+84)[3|5|7|8|9]\d{8}$/';

			if (!preg_match($pattern, $sodienthoai)) {
			    $data['error'] = "Số điện thoại không hợp lệ!";
				return $this->load->view('Web/View_DangKy', $data);
			}

			if (!preg_match("/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/", $email)) {
			    $data['error'] = "Email không hợp lệ!";
				return $this->load->view('Web/View_DangKy', $data);
			}

			if(!is_numeric($sotaikhoan)){
				$data['error'] = "Số tài khoản không hợp lệ!";
				return $this->load->view('Web/View_DangKy', $data);
			}

			if(count($this->Model_DangNhap->getInfoByUsername($taikhoan)) >= 1){
				$data['error'] = "Tài khoản đã tồn tại trong hệ thống!";
				return $this->load->view('Web/View_DangKy', $data);
			}

			if(count($this->Model_DangNhap->getInfoByPhone($sodienthoai)) >= 1){
				$data['error'] = "Số điện thoại đã tồn tại trong hệ thống!";
				return $this->load->view('Web/View_DangKy', $data);
			}

			if(count($this->Model_DangNhap->getInfoByEmail($email)) >= 1){
				$data['error'] = "Email đã tồn tại trong hệ thống!";
				return $this->load->view('Web/View_DangKy', $data);
			}

			$this->Model_NguoiDung->insert($hoten,$taikhoan,md5($matkhau),$sodienthoai,$email,$tennganhang,$sotaikhoan,$chutaikhoan);

			$manguoidung = $this->Model_DangNhap->getInfoByUsername($taikhoan)[0]['MaNguoiDung'];

			$this->Model_NguoiDung->insertWallet($manguoidung);

			$newdata = array(
				'makhachhang' => $this->Model_DangNhap->getInfoByUsername($taikhoan)[0]['MaNguoiDung'],
			    'khachhang'  => $taikhoan,
			    'hoten' => $this->Model_DangNhap->getInfoByUsername($taikhoan)[0]['HoTen'],
			    'anhchinh' => $this->Model_DangNhap->getInfoByUsername($taikhoan)[0]['AnhChinh'],
			    'sodienthoai' => $this->Model_DangNhap->getInfoByUsername($taikhoan)[0]['SoDienThoai'],
			    'email' => $this->Model_DangNhap->getInfoByUsername($taikhoan)[0]['Email'],
			    'nganhang' => $tennganhang,
				'sotaikhoan' => $sotaikhoan,
				'chutaikhoan' => $chutaikhoan,
				'sodukhadung' => 0,
				'dasudung' => 0,
				'tongnap' => 0,
			);
			$this->session->set_userdata($newdata);
			return redirect(base_url('nguoi-dung/'));
		}
		return $this->load->view('Web/View_DangKy', $data);
	}

}

/* End of file DangNhap.php */
/* Location: ./application/controllers/DangNhap.php */