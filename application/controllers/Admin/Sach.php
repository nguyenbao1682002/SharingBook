<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sach extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->has_userdata('taikhoan')){
			return redirect(base_url('admin/dang-nhap/'));
		}

		$this->load->model('Admin/Model_Sach');
		$this->load->model('Admin/Model_ChuyenMuc');
	}

	public function index()
	{
		$totalRecords = $this->Model_Sach->checkNumber();
		$recordsPerPage = 10;
		$totalPages = ceil($totalRecords / $recordsPerPage); 

		$data['totalPages'] = $totalPages;
		$data['list'] = $this->Model_Sach->getAll();
		$data['title'] = "Danh sách thông tin sách";
		return $this->load->view('Admin/View_Sach', $data);
	}

	public function page($trang){
		$data['title'] = "Danh sách thông tin sách";
		$totalRecords = $this->Model_Sach->checkNumber();
		$recordsPerPage = 10;
		$totalPages = ceil($totalRecords / $recordsPerPage); 

		if($trang < 1){
			return redirect(base_url('admin/sach/'));
		}

		if($trang > $totalPages){
			return redirect(base_url('admin/sach/'));
		}

		$start = ($trang - 1) * $recordsPerPage;


		if($start == 0){
			$data['totalPages'] = $totalPages;
			$data['list'] = $this->Model_Sach->getAll();
			return $this->load->view('Admin/View_Sach', $data);
		}else{
			$data['totalPages'] = $totalPages;
			$data['list'] = $this->Model_Sach->getAll($start);
			return $this->load->view('Admin/View_Sach', $data);
		}
	}


	public function add()
	{
		$data['title'] = "Thêm thông tin sách mới";
		$data['category'] = $this->Model_ChuyenMuc->getAll();
		if ($this->input->server('REQUEST_METHOD') === 'POST') {
			$tensach = $this->input->post('tensach');
			$duongdan = $this->input->post('duongdan');
			$machuyenmuc = $this->input->post('machuyenmuc');
			$giagoc = $this->input->post('giagoc');
			$giamuon = $this->input->post('giamuon');
			$soluong = $this->input->post('soluong');
			$loaisach = $this->input->post('loaisach');
			$mota = $this->input->post('mota');
			$motangan = $this->input->post('motangan');
			$tacgia = $this->input->post('tacgia');
			$anhchinh = "";

			if(empty($tensach) || empty($duongdan) || empty($giagoc) || empty($soluong) || empty($giamuon) || empty($tacgia) || empty($motangan) || empty($mota)){
				$data['error'] = "Vui lòng nhập đủ thông tin!";
				return $this->load->view('Admin/View_ThemSach', $data);
			}

			if(count($this->Model_ChuyenMuc->getById($machuyenmuc)) <= 0){
				$data['error'] = "Chuyên mục không hợp lê!";
				return $this->load->view('Admin/View_ThemSach', $data);
			}

			if(!is_numeric($giagoc) || ($giagoc <= 0)){
				$data['error'] = "Giá gốc phải là kiểu số và lớn hơn 0!";
				return $this->load->view('Admin/View_ThemSach', $data);
			}

			if(!is_numeric($giamuon) || ($giamuon <= 0)){
				$data['error'] = "Giá bán phải là kiểu số và lớn hơn 0!";
				return $this->load->view('Admin/View_ThemSach', $data);
			}

			if(!is_numeric($soluong) || ($soluong <= 0)){
				$data['error'] = "Số lượng phải là kiểu số và lớn hơn 0!";
				return $this->load->view('Admin/View_ThemSach', $data);
			}

			if(($loaisach != 1) && ($loaisach != 2) &&  ($loaisach != 3) &&  ($loaisach != 4)){
				$data['error'] = "Chuyên mục sách không hợp lệ!";
				return $this->load->view('Admin/View_ThemSach', $data);
			}

			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';

			$this->load->library('upload', $config);

			if ($this->upload->do_upload('anhchinh')){
				$img = $this->upload->data();
				$anhchinh = base_url('uploads')."/".$img['file_name'];
			}else{
				$data['error'] = "Vui lòng chọn ảnh chính!";
				return $this->load->view('Admin/View_ThemSach', $data);
			}


			$hinhanh = "";

			if (!empty($_FILES['hinhanh']['name'][0])) {
				$filesCount = count($_FILES['hinhanh']['name']);
        
		        // Loop qua từng file để upload
		        for ($i = 0; $i < $filesCount; $i++) {
		            $_FILES['userfile']['name']     = $_FILES['hinhanh']['name'][$i];
		            $_FILES['userfile']['type']     = $_FILES['hinhanh']['type'][$i];
		            $_FILES['userfile']['tmp_name'] = $_FILES['hinhanh']['tmp_name'][$i];
		            $_FILES['userfile']['error']    = $_FILES['hinhanh']['error'][$i];
		            $_FILES['userfile']['size']     = $_FILES['hinhanh']['size'][$i];

		            // Thực hiện upload
		            if ($this->upload->do_upload()) {
		                $img = $this->upload->data();
		                $hinhanh .= base_url('uploads')."/".$img['file_name']."#";
		            } 
		        }
			}else{
				$data['error'] = "Vui lòng chọn hình ảnh!";
				return $this->load->view('Admin/View_ThemSach', $data);
			}


			if($hinhanh == ""){
				$data['error'] = "Vui lòng chọn hình ảnh!";
				return $this->load->view('Admin/View_ThemSach', $data);
			}

			$hinhanh = rtrim($hinhanh, '#');

			$this->Model_Sach->add($tensach,$machuyenmuc,$this->session->userdata('manguoidung'),$tacgia,$giamuon,$giagoc,$anhchinh,$hinhanh,$motangan,$mota,$loaisach,$duongdan,$soluong);

			$this->session->set_flashdata('success', 'Thêm sách thành công!');
			return redirect(base_url('admin/sach/'));
		}
		return $this->load->view('Admin/View_ThemSach', $data);
	}

	public function update($masach)
	{
		if(count($this->Model_Sach->getById($masach)) <= 0){
			$this->session->set_flashdata('error', 'Sách không tồn tại!');
			return redirect(base_url('admin/sach/'));
		}

		$data['title'] = "Cập nhật Sách";
		$data['detail'] = $this->Model_Sach->getById($masach);
		$data['category'] = $this->Model_ChuyenMuc->getAll();
		if ($this->input->server('REQUEST_METHOD') === 'POST') {
			$tensach = $this->input->post('tensach');
			$duongdan = $this->input->post('duongdan');
			$machuyenmuc = $this->input->post('machuyenmuc');
			$giagoc = $this->input->post('giagoc');
			$giamuon = $this->input->post('giamuon');
			$soluong = $this->input->post('soluong');
			$loaisach = $this->input->post('loaisach');
			$mota = $this->input->post('mota');
			$motangan = $this->input->post('motangan');
			$tacgia = $this->input->post('tacgia');
			$anhchinh = $this->Model_Sach->getById($masach)[0]['AnhChinh'];
			$hinhanh = $this->Model_Sach->getById($masach)[0]['HinhAnh'];
			$manguoidung = $this->Model_Sach->getById($masach)[0]['MaNguoiDung'];

			if(empty($tensach) || empty($duongdan) || empty($giagoc) || empty($soluong) || empty($giamuon) || empty($tacgia) || empty($motangan) || empty($mota)){
				$data['error'] = "Vui lòng nhập đủ thông tin!";
				return $this->load->view('Admin/View_ThemSach', $data);
			}

			if(count($this->Model_ChuyenMuc->getById($machuyenmuc)) <= 0){
				$data['error'] = "Chuyên mục không hợp lê!";
				return $this->load->view('Admin/View_ThemSach', $data);
			}

			if(!is_numeric($giagoc) || ($giagoc <= 0)){
				$data['error'] = "Giá gốc phải là kiểu số và lớn hơn 0!";
				return $this->load->view('Admin/View_ThemSach', $data);
			}

			if(!is_numeric($giamuon) || ($giamuon <= 0)){
				$data['error'] = "Giá bán phải là kiểu số và lớn hơn 0!";
				return $this->load->view('Admin/View_ThemSach', $data);
			}

			if(!is_numeric($soluong) || ($soluong <= 0)){
				$data['error'] = "Số lượng phải là kiểu số và lớn hơn 0!";
				return $this->load->view('Admin/View_ThemSach', $data);
			}

			if(($loaisach != 1) && ($loaisach != 2) &&  ($loaisach != 3) &&  ($loaisach != 4)){
				$data['error'] = "Chuyên mục sách không hợp lệ!";
				return $this->load->view('Admin/View_ThemSach', $data);
			}

			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';

			$this->load->library('upload', $config);

			if ($this->upload->do_upload('anhchinh')){
				$img = $this->upload->data();
				$anhchinh = base_url('uploads')."/".$img['file_name'];
			}

			if (!empty($_FILES['hinhanh']['name'][0])) {
				$hinhanh = "";
				$filesCount = count($_FILES['hinhanh']['name']);
        
		        // Loop qua từng file để upload
		        for ($i = 0; $i < $filesCount; $i++) {
		            $_FILES['userfile']['name']     = $_FILES['hinhanh']['name'][$i];
		            $_FILES['userfile']['type']     = $_FILES['hinhanh']['type'][$i];
		            $_FILES['userfile']['tmp_name'] = $_FILES['hinhanh']['tmp_name'][$i];
		            $_FILES['userfile']['error']    = $_FILES['hinhanh']['error'][$i];
		            $_FILES['userfile']['size']     = $_FILES['hinhanh']['size'][$i];

		            // Thực hiện upload
		            if ($this->upload->do_upload()) {
		                $img = $this->upload->data();
		                $hinhanh .= base_url('uploads')."/".$img['file_name']."#";
		            } 
		        }

		        $hinhanh = rtrim($hinhanh, '#');
			}

			$this->Model_Sach->update($tensach,$machuyenmuc,$manguoidung,$tacgia,$giamuon,$giagoc,$anhchinh,$hinhanh,$motangan,$mota,$loaisach,$duongdan,$soluong,$masach);
			$data['success'] = "Cập nhật sách thành công!";
			$data['detail'] = $this->Model_Sach->getById($masach);
			return $this->load->view('Admin/View_SuaSach', $data);
		}

		return $this->load->view('Admin/View_SuaSach', $data);
	}



	public function delete($masach)
	{
		if(count($this->Model_Sach->getById($masach)) <= 0){
			$this->session->set_flashdata('error', 'Sách không tồn tại!');
			return redirect(base_url('admin/sach/'));
		}
		$this->Model_Sach->delete($masach);

		$this->session->set_flashdata('success', 'Xóa sách thành công!');
		return redirect(base_url('admin/sach/'));
	}

	public function status($masach)
	{
		if(count($this->Model_Sach->getById($masach)) <= 0){
			$this->session->set_flashdata('error', 'Sách không tồn tại!');
			return redirect(base_url('admin/sach/'));
		}

		$data['title'] = "Cập nhật Sách";
		$data['detail'] = $this->Model_Sach->getById($masach);	
		$data['category'] = $this->Model_ChuyenMuc->getById($data['detail'][0]['MaChuyenMuc'])[0]['TenChuyenMuc'];	

		if ($this->input->server('REQUEST_METHOD') === 'POST') {
			$trangthai = $this->input->post('trangthai');
			$trangthaimuon = $this->input->post('trangthaimuon');

			if(($trangthai != 1) && ($trangthai != 2) && ($trangthai != 3)){
				$this->session->set_flashdata('error', 'Trạng thái sách không hợp lệ!');
				return redirect(base_url('admin/sach/'.$masach.'/trang-thai/'));
			}

			$this->Model_Sach->status($trangthai,$trangthaimuon,$masach);

			$data['detail'] = $this->Model_Sach->getById($masach);	
			$this->session->set_flashdata('success', 'Cập nhật trạng thái sách thành công!');
			return $this->load->view('Admin/View_TrangThaiSach', $data);
		}
		return $this->load->view('Admin/View_TrangThaiSach', $data);
	}

}

/* End of file Sach.php */
/* Location: ./application/controllers/Sach.php */