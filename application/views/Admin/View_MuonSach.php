<?php require(APPPATH.'views/admin/layouts/header.php'); ?>
<div class="content-wrapper" style="min-height: 1203.31px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Quản Lý Mượn Sách</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('admin/'); ?>">Trang Chủ</a></li>
              <li class="breadcrumb-item active">Quản Lý Mượn Sách</li>
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
              <div class="card-header">
                <form class="row" action="<?php echo base_url('admin/muon-sach/tim-kiem/') ?>"> 
                  <div class="col-sm-2">
                    <label>Mã Mượn Sách</label>
                    <input type="text" name="mamuonsach" class="form-control" placeholder="Mã mượn sách">
                  </div>
                  <div class="col-sm-2">
                    <label>Ngày Mượn</label>
                    <input type="date" name="ngaymuon" class="form-control" placeholder="Ngày mượn">
                  </div>
                  <div class="col-sm-2">
                    <label>Ngày Trả</label>
                    <input type="date" name="ngaytra" class="form-control">
                  </div>
                  <div class="col-sm-2">
                    <label style="visibility:hidden;">Tìm Kiếm</label>
                    <br>
                    <button type="submit" class="btn btn-primary">Tìm Kiếm</button>
                  </div>
                </form>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>Mã Mượn</th>
                      <th>Hình Ảnh</th>
                      <th>Tên Sách</th>
                      <th>Chủ Sách</th>
                      <th>Người Mượn</th>
                      <th>Địa Chỉ</th>
                      <th>Số Lượng</th>
                      <th>Tổng Tiền</th>
                      <th>Ngày Mượn</th>
                      <th>Ngày Trả</th>
                      <th>Trạng Thái</th>
                      <th>Cập Nhật Trạng Thái</th>
                    </tr>
                  </thead>
                  <tbody>
                  	<?php foreach ($list as $key => $value): ?>
	                    <tr>
	                      <td>000<?php echo $value['MaMuonSach']; ?></td>
                        <td><img style="width: 130px; height: 160px" src="<?php echo $value['AnhChinh']; ?>"></td>
                        <td><a href="<?php echo base_url('admin/sach/'.$value['MaSach'].'/sua/'); ?>"><?php echo $value['TenSach']; ?></a></td>
	                      <td>
                          <a href="<?php echo base_url('admin/nguoi-dung/'.$value['MNDSach'].'/xem/'); ?>"><?php echo $this->Model_MuonSach->getUserBook($value['MNDSach'])[0]['TaiKhoan']; ?></a>
                        </td>
                        <td>
                          <a href="<?php echo base_url('admin/nguoi-dung/'.$value['MNDMuon'].'/xem/'); ?>"><?php echo $value['TaiKhoan']; ?></a>
                        </td>
                        <td><?php echo $value['DiaChi']; ?></td>
	                      <td><?php echo $value['SoLuong']; ?> Quyển</td>
	                      <td>
	                      	<?php echo number_format($value['TongTien']); ?> VND
	                      </td>
                        <td>
                          <?php echo date("H:i:s d/m/Y", strtotime($value['ThoiGian'])); ?>
                        </td>
                        <td>
                          <?php echo date("d/m/Y", strtotime($value['ThoiGianTra'])); ?>
                        </td>
                        <td>
                          <?php if($value['TrangThai'] == 0){ ?>
                            Đã hủy mượn sách
                          <?php }else if($value['TrangThai'] == 1){ ?>
                            Chờ chủ sách duyệt
                          <?php }else if($value['TrangThai'] == 2){ ?>
                            Chuẩn bị giao sách
                          <?php }else if($value['TrangThai'] == 3){ ?>
                            Đã giao sách
                          <?php }else if($value['TrangThai'] == 4){ ?>
                            Người mượn đã trả sách
                          <?php } ?>
                        </td>
	                      <td>
                          <a href="<?php echo base_url('admin/muon-sach/'.$value['MaMuonSach'].'/trang-thai/'); ?>" class="btn btn-primary" style="color: white;">
                            <i class="fa-solid fa-thumbtack"></i>
                              <span>ĐỔI TRẠNG THÁI</span>
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
                  		<li class="page-item"><a class="page-link" href="<?php echo base_url('admin/muon-sach/'.$i.'/trang/') ?>"><?php echo $i; ?></a></li>
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
<?php require(APPPATH.'views/admin/layouts/footer.php'); ?>
