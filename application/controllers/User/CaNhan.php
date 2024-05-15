<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CaNhan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->has_userdata('khachhang')){
			return redirect(base_url('dang-nhap/'));
		}

		$this->load->model('User/Model_CaNhan');
	}

	public function index()
	{
		$data['title'] = "Thông tin cá nhân";
		$data['detail'] = $this->Model_CaNhan->getById($this->session->userdata('makhachhang'));
		if ($this->input->server('REQUEST_METHOD') === 'POST') {
			$hoten = $this->input->post('hoten');
			$email = $this->input->post('email');
			$sodienthoai = $this->input->post('sodienthoai');
			$taikhoan = $this->Model_CaNhan->getById($this->session->userdata('makhachhang'))[0]['TaiKhoan'];
			$tennganhang = $this->input->post('tennganhang');
			$sotaikhoan = $this->input->post('sotaikhoan');
			$chutaikhoan = $this->input->post('chutaikhoan');
			$matkhau = $this->Model_CaNhan->getById($this->session->userdata('makhachhang'))[0]['MatKhau'];
			$anhchinh = $this->Model_CaNhan->getById($this->session->userdata('makhachhang'))[0]['AnhChinh'];

			if(empty($hoten) || empty($email) || empty($sodienthoai) || empty($taikhoan) || empty($tennganhang) || empty($sotaikhoan) || empty($chutaikhoan)){
				$data['error'] = "Vui lòng nhập đủ thông tin!";
				return $this->load->view('User/View_CaNhan', $data);
			}

			$pattern = '/^(0|\+84)[3|5|7|8|9]\d{8}$/';

			if (!preg_match($pattern, $sodienthoai)) {
			    $data['error'] = "Vui lòng nhập số điện thoại hợp lệ!";
				return $this->load->view('User/View_CaNhan', $data);
			}

			$pattern = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';

			if (!preg_match($pattern, $email)) {
			    $data['error'] = "Vui lòng nhập email hợp lệ!";
				return $this->load->view('User/View_CaNhan', $data);
			}

			if(!is_numeric($sotaikhoan)){
				$data['error'] = "Vui lòng nhập số tài khoản hợp lệ!";
				return $this->load->view('User/View_CaNhan', $data);
			}

			if(isset($_POST['matkhau']) && !empty($_POST['matkhau'])){
				$matkhau = md5($this->input->post('matkhau'));
			}

			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';

			$this->load->library('upload', $config);

			if ($this->upload->do_upload('anhchinh')){
				$img = $this->upload->data();
				$anhchinh = base_url('uploads')."/".$img['file_name'];
			}

			$this->Model_CaNhan->update($hoten,$taikhoan,$matkhau,$email,$sodienthoai,$anhchinh,$tennganhang,$sotaikhoan,$chutaikhoan,$this->session->userdata('makhachhang'));

			$newdata = array(
			    'hoten' => $hoten,
			    'sodienthoai' => $sodienthoai,
			    'email' => $email,
			    'nganhang' => $tennganhang,
			    'sotaikhoan' => $sotaikhoan,
			    'chutaikhoan' => $chutaikhoan,
			);
			$this->session->set_userdata($newdata);

			$data['success'] = "Cập nhật thông tin cá nhân thành công!";
			$data['detail'] = $this->Model_CaNhan->getById($this->session->userdata('makhachhang'));
			return $this->load->view('User/View_CaNhan', $data);
		}
		return $this->load->view('User/View_CaNhan', $data);
	}

}

/* End of file CaNhan.php */
/* Location: ./application/controllers/CaNhan.php */