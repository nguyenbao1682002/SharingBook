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
              <li class="breadcrumb-item"><a href="<?php echo base_url('admin/nguoi-dung/'); ?>">Quản Lý Người Dùng</a></li>
              <li class="breadcrumb-item active"><?php echo $detail[0]['TaiKhoan']; ?></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="card card-default">
          <div class="card-header">
            <h5>Thông Tin Người Dùng</h5>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <form>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="ten">Họ Tên</label>
                    <input type="text" class="form-control"  placeholder="Họ tên" value="<?php echo $detail[0]['HoTen']; ?>">
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="ten">Tài Khoản</label>
                    <input type="text" class="form-control"  placeholder="Tài khoản" value="<?php echo $detail[0]['TaiKhoan']; ?>">
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="ten">Số Điện Thoại</label>
                    <input type="text" class="form-control"  placeholder="Số điện thoại" value="<?php echo $detail[0]['SoDienThoai']; ?>">
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="ten">Email</label>
                    <input type="text" class="form-control"  placeholder="Email" value="<?php echo $detail[0]['Email']; ?>">
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="ten">Ngân Hàng</label>
                    <input type="text" class="form-control"  placeholder="Ngân hàng" value="<?php echo $detail[0]['TenNganHang']; ?>">
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="ten">Số Tài Khoản</label>
                    <input type="text" class="form-control"  placeholder="Số tài khoản" value="<?php echo $detail[0]['SoTaiKhoan']; ?>">
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="ten">Chủ Tài Khoản</label>
                    <input type="text" class="form-control"  placeholder="Chủ tài khoản" value="<?php echo $detail[0]['ChuTaiKhoan']; ?>">
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="ten">Ngày Tham Gia</label>
                    <input type="text" class="form-control"  placeholder="Ngày tham gia" value="<?php echo $detail[0]['NgayThamGia']; ?>">
                  </div>
                </div>
              </div> 
              <a class="btn btn-success" href="<?php echo base_url('admin/nguoi-dung/'); ?>">Quay Lại</a>
              <?php if($detail[0]['TrangThai'] == 0){ ?>
                <a href="<?php echo base_url('admin/nguoi-dung/'.$detail[0]['MaNguoiDung'].'/trang-thai/'); ?>" class="btn btn-primary">Bỏ Cấm Tài Khoản</a>
              <?php }else{ ?>
                <a href="<?php echo base_url('admin/nguoi-dung/'.$detail[0]['MaNguoiDung'].'/trang-thai/'); ?>" class="btn btn-danger">Cấm Tài Khoản</a>
              <?php } ?>
            </form>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<?php require(APPPATH.'views/admin/layouts/footer.php'); ?>
