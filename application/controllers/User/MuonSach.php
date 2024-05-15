<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MuonSach extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->has_userdata('khachhang')){
			return redirect(base_url('dang-nhap/'));
		}

		$this->load->model('User/Model_MuonSach');
		$this->load->model('User/Model_Sach');
	}

	public function index()
	{
		$totalRecords = $this->Model_MuonSach->checkNumber($this->session->userdata('makhachhang'));
		$recordsPerPage = 10;
		$totalPages = ceil($totalRecords / $recordsPerPage); 

		$data['totalPages'] = $totalPages;
		$data['list'] = $this->Model_MuonSach->getAll($this->session->userdata('makhachhang'));
		$data['title'] = "Danh sách đang mượn";
		return $this->load->view('User/View_MuonSach', $data);
	}

	public function page($trang){
		$data['title'] = "Danh sách hóa đơn";
		$totalRecords = $this->Model_MuonSach->checkNumber($this->session->userdata('makhachhang'));
		$recordsPerPage = 10;
		$totalPages = ceil($totalRecords / $recordsPerPage); 

		if($trang < 1){
			return redirect(base_url('User/muon-sach/'));
		}

		if($trang > $totalPages){
			return redirect(base_url('User/muon-sach/'));
		}

		$start = ($trang - 1) * $recordsPerPage;


		if($start == 0){
			$data['totalPages'] = $totalPages;
			$data['list'] = $this->Model_MuonSach->getAll($this->session->userdata('makhachhang'));
			return $this->load->view('User/View_MuonSach', $data);
		}else{
			$data['totalPages'] = $totalPages;
			$data['list'] = $this->Model_MuonSach->getAll($this->session->userdata('makhachhang'),$start);
			return $this->load->view('User/View_MuonSach', $data);
		}
	}

	public function status($mamuonsach){
		if(count($this->Model_MuonSach->getById($this->session->userdata('makhachhang'),$mamuonsach)) <= 0){
			$this->session->set_flashdata('error', 'Thông tin mượn sách không tồn tại!');
			return redirect(base_url('user/muon-sach/'));
		}

		$data['detail'] = $this->Model_MuonSach->getById($this->session->userdata('makhachhang'),$mamuonsach);
		$data['title'] = "Trạng thái mượn sách";

		if ($this->input->server('REQUEST_METHOD') === 'POST') {
			$trangthai = $this->input->post('trangthai');

			if(($trangthai != 0) && ($trangthai != 1) && ($trangthai != 2) && ($trangthai != 3) && ($trangthai != 4)){
				$this->session->set_flashdata('error', 'Trạng thái mượn sách không hợp lệ!');
				return redirect(base_url('User/muon-sach/'.$mamuonsach.'/trang-thai/'));
			}

			$soluong = $this->Model_MuonSach->getById($this->session->userdata('makhachhang'),$mamuonsach)[0]['SoLuong'];
			$masach = $this->Model_MuonSach->getById($this->session->userdata('makhachhang'),$mamuonsach)[0]['MaSach'];
			$trangthaihientai = $this->Model_MuonSach->getById($this->session->userdata('makhachhang'),$mamuonsach)[0]['TrangThai'];

			$soluonghientai = $this->Model_Sach->getById($this->session->userdata('makhachhang'),$masach)[0]['SoLuong'];

			$soluongmoi = $soluonghientai;

			if(($trangthai == 0) && ($trangthaihientai == 3)){
				$soluongmoi = $soluonghientai + $soluong;
				$this->Model_MuonSach->number($soluongmoi,$masach);
				$this->Model_MuonSach->bookMuon(0,$masach);
			}

			if(($trangthai == 4) && ($trangthaihientai == 3)){
				$soluongmoi = $soluonghientai + $soluong;
				$this->Model_MuonSach->number($soluongmoi,$masach);
				$this->Model_MuonSach->bookMuon(0,$masach);
			}

			if(($trangthai == 3) && (($trangthaihientai == 1) || ($trangthaihientai == 2))){
				$soluongmoi = $soluonghientai - $soluong;
				$this->Model_MuonSach->number($soluongmoi,$masach);
				$this->Model_MuonSach->bookMuon($soluong,$masach);
			}
			
			$this->Model_MuonSach->status($trangthai,$mamuonsach);
			
			$data['detail'] = $this->Model_MuonSach->getById($this->session->userdata('makhachhang'),$mamuonsach);
			$this->session->set_flashdata('success', 'Cập nhật trạng thái mượn sách thành công!');
			return $this->load->view('User/View_TrangThaiMuon', $data);
		}
		return $this->load->view('User/View_TrangThaiMuon', $data);
	}

	public function pay($mahoadon)
	{
		if(count($this->Model_MuonSach->getById($this->session->userdata('makhachhang'),$mahoadon)) <= 0){
			$this->session->set_flashdata('error', 'Hóa đơn không tồn tại!');
			return redirect(base_url('user/muon-sach/'));
		}

		$detail = $this->Model_MuonSach->getById($this->session->userdata('makhachhang'),$mahoadon);

		if(($detail[0]['ThanhToan'] != 1) && ($detail[0]['TrangThai'] != 0) && ($detail[0]['TrangThai'] != 4)){
			$this->Model_MuonSach->updatePay($mahoadon);
			$this->session->set_flashdata('success', 'Xác nhận thanh toán thành công!');
			return redirect(base_url('user/muon-sach/'.$mahoadon.'/xem/'));
		}else{
			$this->session->set_flashdata('error', 'Không được phép thực hiện!');
			return redirect(base_url('user/muon-sach/'.$mahoadon.'/xem/'));
		}
	}


	public function cancel($mahoadon){
		if(count($this->Model_MuonSach->getById($this->session->userdata('makhachhang'),$mahoadon)) <= 0){
			$this->session->set_flashdata('error', 'Hóa đơn không tồn tại!');
			return redirect(base_url('user/muon-sach/'));
		}

		$detail = $this->Model_MuonSach->getById($this->session->userdata('makhachhang'),$mahoadon);

		if(($detail[0]['TrangThai'] <= 2) && ($detail[0]['TrangThai'] != 0) && ($detail[0]['TrangThai'] != 4)){
			$this->Model_MuonSach->cancel($mahoadon);

			$detailOrder = $this->Model_MuonSach->getDetailById($mahoadon);

			foreach ($detailOrder as $key => $value) {
				$soluongmoi = $this->Model_MuonSach->getProductById($value['MaSanPham'])[0]['SoLuong'] + $value['SoLuong'];
				$this->Model_MuonSach->updateNumberProduct($soluongmoi,$value['MaSanPham']);
			}

			$this->session->set_flashdata('success', 'Hủy đơn hàng thành công!');
			return redirect(base_url('user/muon-sach/'.$mahoadon.'/xem/'));
		}else{
			$this->session->set_flashdata('error', 'Không được phép thực hiện!');
			return redirect(base_url('user/muon-sach/'.$mahoadon.'/xem/'));
		}
	}


	public function search()
	{
		if(!isset($_GET['mamuonsach']) && !isset($_GET['ngaymuon']) && !isset($_GET['ngaytra'])){
			return redirect(base_url('user/muon-sach/'));
		}

		$mamuonsach = $this->input->get('mamuonsach');
		$ngaymuon = $this->input->get('ngaymuon');
		$ngaytra = $this->input->get('ngaytra');

		if(empty($mamuonsach) && empty($ngaymuon) && empty($ngaytra)){
			return redirect(base_url('user/muon-sach/'));
		}

		
		$data['post'] = array(
			'mamuonsach' => $mamuonsach,
			'ngaymuon' => $ngaymuon,
			'ngaytra' => $ngaytra,
		);

		$totalRecords = $this->Model_MuonSach->checkNumberSearch($this->session->userdata('makhachhang'),$mamuonsach,$ngaymuon,$ngaytra);
		$recordsPerPage = 10;
		$totalPages = ceil($totalRecords / $recordsPerPage); 

		$data['totalPages'] = $totalPages;
		$data['list'] = $this->Model_MuonSach->search($this->session->userdata('makhachhang'),$mamuonsach,$ngaymuon,$ngaytra);
		$data['title'] = "Danh sách đang mượn";
		return $this->load->view('User/View_MuonSachTimKiem', $data);

	}


	public function pageSearch($trang){
		if(!isset($_GET['mamuonsach']) && !isset($_GET['ngaymuon']) && !isset($_GET['ngaytra'])){
			return redirect(base_url('user/muon-sach/'));
		}

		$mamuonsach = $this->input->get('mamuonsach');
		$ngaymuon = $this->input->get('ngaymuon');
		$ngaytra = $this->input->get('ngaytra');

		if(empty($mamuonsach) && empty($ngaymuon) && empty($ngaytra)){
			return redirect(base_url('user/muon-sach/'));
		}

		
		$data['post'] = array(
			'mamuonsach' => $mamuonsach,
			'ngaymuon' => $ngaymuon,
			'ngaytra' => $ngaytra,
		);


		$data['title'] = "Danh sách đang mượn";
		$totalRecords = $this->Model_MuonSach->checkNumberSearch($this->session->userdata('makhachhang'),$mamuonsach,$ngaymuon,$ngaytra);
		$recordsPerPage = 10;
		$totalPages = ceil($totalRecords / $recordsPerPage); 

		if($trang < 1){
			return redirect(base_url('user/muon-sach/'));
		}

		if($trang > $totalPages){
			return redirect(base_url('user/muon-sach/'));
		}

		$start = ($trang - 1) * $recordsPerPage;


		if($start == 0){
			$data['totalPages'] = $totalPages;
			$data['list'] = $this->Model_MuonSach->search($this->session->userdata('makhachhang'),$mamuonsach,$ngaymuon,$ngaytra);
			return $this->load->view('User/View_MuonSachTimKiem', $data);
		}else{
			$data['totalPages'] = $totalPages;
			$data['list'] = $this->Model_MuonSach->search($this->session->userdata('makhachhang'),$mamuonsach,$ngaymuon,$ngaytra,$start);
			return $this->load->view('User/View_MuonSachTimKiem', $data);
		}
	}

}

/* End of file ChuyenMuc.php */
/* Location: ./application/controllers/ChuyenMuc.php */