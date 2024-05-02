<?php require(APPPATH.'views/admin/layouts/header.php'); ?>
<div class="content-wrapper" style="min-height: 1203.31px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Quản Lý Người Dùng</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('admin/'); ?>">Trang Chủ</a></li>
              <li class="breadcrumb-item active">Quản Lý Người Dùng</li>
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
                <form class="row" action="<?php echo base_url('admin/nguoi-dung/tim-kiem/') ?>"> 
                  <div class="col-sm-2">
                    <label>Tài Khoản</label>
                    <input type="text" name="taikhoan" class="form-control" placeholder="Tài khoản" value="<?php if(isset($post['taikhoan'])) { echo $post['taikhoan']; } ?>">
                  </div>
                  <div class="col-sm-2">
                    <label>Trạng Thái</label>
                    <select class="form-control" name="trangthai">
                      <option value>Chọn Trạng Thái</option>
                      <option value="1" <?php if(isset($post['trangthai']) && ($post['trangthai'] == 1)){ echo "selected"; } ?>>Hoạt Động</option>
                      <option value="-1" <?php if(isset($post['trangthai']) && ($post['trangthai'] == -1)){ echo "selected"; } ?>>Bị Cấm</option>
                    </select>
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
                      <th>#</th>
                      <th>Hình Ảnh</th>
                      <th>Họ Tên</th>
                      <th>Tài Khoản</th>
                      <th>Số Điện Thoại</th>
                      <th>Email</th>
                      <th>Trạng Thái</th>
                      <th>Ví Tiền</th>
                      <th>Dòng Tiền</th>
                      <th>Hành Động</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($list as $key => $value): ?>
                      <tr>
                        <td><?php echo $key + 1; ?></td>
                        <td>
                          <img src="<?php echo $value['AnhChinh']; ?>" style="width: 100px; height: 100px;">
                        </td>
                        <td><?php echo $value['HoTen']; ?></td>
                        <td>
                          <a href="<?php echo base_url('nguoi-dung/'.$value['TaiKhoan'].'/') ?>" target="_blank"><?php echo $value['TaiKhoan']; ?></a>
                        </td>
                        <td>
                          <?php echo $value['SoDienThoai']; ?>
                        </td>
                        <td>
                          <?php echo $value['Email']; ?>
                        </td>
                        <td>
                          <?php echo $value['TrangThai'] == 0 ? "Bị cấm" : "Hoạt động"; ?>
                        </td>
                        <td>
                          <a href="<?php echo base_url('admin/nguoi-dung/'.$value['MaNguoiDung'].'/vi-tien/'); ?>" class="btn btn-success" style="color: white;">
                              <i class="fa-solid fa-credit-card"></i>
                                <span>VÍ TIỀN</span>
                            </a>
                        </td>
                        <td>
                          <a href="<?php echo base_url('admin/nguoi-dung/'.$value['MaNguoiDung'].'/dong-tien/'); ?>" class="btn btn-info" style="color: white;">
                              <i class="fa-solid fa-money-check-dollar"></i>
                                <span>DÒNG TIỀN</span>
                            </a>
                        </td>
                        <td>
                          <?php if($value['TrangThai'] == 0){ ?>
                            <a href="<?php echo base_url('admin/nguoi-dung/'.$value['MaNguoiDung'].'/xem/'); ?>" class="btn btn-primary" style="color: white;">
                              <i class="fa-solid fa-lock-open"></i>
                                <span>BỎ CẤM TÀI KHOẢN</span>
                            </a>
                          <?php }else{ ?>
                            <a href="<?php echo base_url('admin/nguoi-dung/'.$value['MaNguoiDung'].'/xem/'); ?>" class="btn btn-danger" style="color: white;">
                              <i class="fa-solid fa-ban"></i>
                                <span>CẤM TÀI KHOẢN</span>
                            </a>
                          <?php } ?>
                        </td>
                      </tr>
                    <?php endforeach ?>
                  </tbody>
                </table>
              </div>
              <div class="card-footer clearfix">
                <a href="<?php echo base_url('admin/nguoi-dung/'); ?>" class="btn btn-success">Quay Lại</a>
                <ul class="pagination pagination-sm m-0 float-right">
                  <?php for($i = 1; $i <= $totalPages; $i++){ ?>
                      <li class="page-item"><a class="page-link" href="<?php echo base_url('admin/nguoi-dung/tim-kiem/'.$i.'/trang/?taikhoan='.$post['taikhoan'].'&trangthai='.$post['trangthai']) ?>"><?php echo $i; ?></a></li>
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
  <style type="text/css">
  .form-control:disabled, .form-control[readonly] {
    background-color: white;
    opacity: 1;
  }
</style>
<?php require(APPPATH.'views/admin/layouts/footer.php'); ?>
