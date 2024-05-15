<?php require(APPPATH.'views/user/layouts/header.php'); ?>
<div class="content-wrapper" style="min-height: 1203.31px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Quản Lý Sách</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('user/'); ?>">Trang Chủ</a></li>
              <li class="breadcrumb-item active">Quản Lý Sách</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- /.row -->
        <div class="row">
          <div class="col-12">
            <div class="card">
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Hình Ảnh</th>
                      <th>Tên Sách</th>
                      <th>Chuyên Mục</th>
                      <th>Người Đăng</th>
                      <th>Giá Mượn</th>
                      <th>Số Lượng</th>
                      <th>Loại Sách</th>
                      <th>Trạng Thái</th>
                      <th>Trạng Thái Mượn</th>
                      <th>Cập Nhật Trạng Thái</th>
                      <th>Hành Động</th>
                    </tr>
                  </thead>
                  <tbody>
                  	<?php foreach ($list as $key => $value): ?>
	                    <tr>
	                      <td><?php echo $key + 1; ?></td>
	                      <td><img style="width: 130px; height: 160px" src="<?php echo $value['AnhChinh']; ?>"></td>
	                      <td>
                          <a href="<?php echo base_url('sach/'.$value['DuongDan'].'/'); ?>" target="_blank"><?php echo $value['TenSach']; ?></a>
                        </td>
                        <td>
                          <a href="<?php echo base_url('chuyen-muc/'); ?>" target="_blank"><?php echo $value['TenChuyenMuc']; ?></a>
                        </td>
                        <td>
                          <?php if($value['PhanQuyen'] == 1){ ?>
                            <?php echo "QTV: ".$value['TaiKhoan']; ?>
                          <?php }else{ ?>
                            <a href="<?php echo base_url('nguoi-dung/'.$value['TaiKhoan'].'/'); ?>"><?php echo $value['TaiKhoan']; ?></a>
                          <?php } ?>                            
                        </td>
                        <td><?php echo number_format($value['GiaMuon']); ?> VND</td>
                        <td><?php echo $value['SoLuong']; ?> Quyển</td>
                        <td>
                          <?php if($value['LoaiSach'] == 1){ ?>
                            Bình Thường
                          <?php }else if($value['LoaiSach'] == 2){ ?>
                            Khuyến Mãi
                          <?php }else if($value['LoaiSach'] == 3){ ?>
                            Nội Bật
                          <?php }else if($value['LoaiSach'] == 4){ ?>
                            Đang Hot
                          <?php } ?>
                        </td>
                        <td>
                          <?php if($value['TrangThai'] == 1){ ?>
                            Được Hiển Thị 
                          <?php }else if($value['TrangThai'] == 2){ ?>
                            Đang Chờ Duyệt
                          <?php }else if($value['TrangThai'] == 3){ ?>
                            Không Hiển Thị
                          <?php } ?>
                        </td>
                        <td>
                          <?php if($value['TrangThaiMuon'] == 0){ ?>
                            Chưa Được Mượn
                          <?php }else{ ?>
                            Đang Mượn <?php echo $value['TrangThaiMuon']; ?> Quyển
                          <?php } ?>
                        </td>
                        <td>
                          <a href="<?php echo base_url('user/sach/'.$value['MaSach'].'/trang-thai/'); ?>" class="btn btn-success" style="color: white;">
                          <i class="fa-solid fa-thumbtack"></i>
                            <span>ĐỔI TRẠNG THÁI</span>
                          </a>
                        </td>
	                      <td>
	                      	<a href="<?php echo base_url('user/sach/'.$value['MaSach'].'/sua/'); ?>" class="btn btn-primary" style="color: white;">
	                      	<i class="fas fa-edit"></i>
                            <span>SỬA</span>
                          </a>
                         	<a href="<?php echo base_url('user/sach/'.$value['MaSach'].'/xoa/'); ?>" class="btn btn-danger" style="color: white;">
                      		<i class="fas fa-trash"></i>
                          	<span>XÓA</span>
                         	</a>
	                      </td>
	                    </tr>
                    <?php endforeach ?>
                  </tbody>
                </table>
              </div>
              <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                	<?php for($i = 1; $i <= $totalPages; $i++){ ?>
                  		<li class="page-item"><a class="page-link" href="<?php echo base_url('user/sach/'.$i.'/trang/') ?>"><?php echo $i; ?></a></li>
                  	<?php } ?>      
                </ul>
              </div>
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
<?php require(APPPATH.'views/user/layouts/footer.php'); ?>
