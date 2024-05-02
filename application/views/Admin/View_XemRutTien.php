<?php require(APPPATH.'views/admin/layouts/header.php'); ?>
<div class="content-wrapper" style="min-height: 1203.31px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Quản Lý Rút Tiền</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('admin/'); ?>">Trang Chủ</a></li>
              <li class="breadcrumb-item"><a href="<?php echo base_url('admin/rut-tien/'); ?>">Quản Lý Rút Tiền</a></li>
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
            <h5>Thông Tin Rút Tiền Người Dùng</h5>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <form>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="ten">Tài Khoản</label>
                    <input type="text" class="form-control"  placeholder="Tài khoản" value="<?php echo $detail[0]['TaiKhoan']; ?>" disabled>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="ten">Ngân Hàng</label>
                    <input type="text" class="form-control"  placeholder="Ngân hàng" value="<?php echo $detail[0]['TenNganHang']; ?>" disabled>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="ten">Số Tài Khoản</label>
                    <input type="text" class="form-control"  placeholder="Số tài khoản" value="<?php echo $detail[0]['SoTaiKhoan']; ?>" disabled>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="ten">Chủ Tài Khoản</label>
                    <input type="text" class="form-control"  placeholder="Chủ tài khoản" value="<?php echo $detail[0]['ChuTaiKhoan']; ?>" disabled>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="ten">Số Dư Khả Dụng</label>
                    <input type="text" class="form-control"  placeholder="Số dư khả dụng" value="<?php echo number_format($wallet[0]['SoDuKhaDung']); ?> VND" disabled>
                  </div>
                </div>
                
                <div class="col-md-12">
                  <hr>
                  <div class="form-group">
                    <label for="ten">Thời Gian Yêu Cầu Rút</label>
                    <input type="text" class="form-control"  placeholder="Thời gian yêu cầu rút" value="<?php echo date("h:m:s d/m/Y", strtotime($detail[0]['ThoiGian'])); ?>" disabled>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="ten">Số Tiền Yêu Cầu Rút</label>
                    <input type="text" class="form-control"  placeholder="Số tiền rút" value="<?php echo number_format($detail[0]['SoTienRut']); ?> VND" disabled>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="ten">Thực Nhận</label>
                    <input type="text" class="form-control"  placeholder="Số tiền rút" value="<?php echo number_format($detail[0]['SoTienRut'] * (1 - ($phiruttien / 100))); ?> VND" disabled>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="ten">Trạng Thái</label>
                    <input type="text" class="form-control"  placeholder="Số tiền rút" 
                      <?php if($detail[0]['TrangThai'] == 0){ ?>
                        value="Đã Hủy Rút Tiền"
                      <?php }else if($detail[0]['TrangThai'] == 1){ ?>
                        value="Chờ Admin Duyệt"
                      <?php }else if($detail[0]['TrangThai'] == 2){ ?>
                        value="Đã Rút Tiền"
                      <?php } ?>
                     disabled>
                  </div>
                </div>
              </div> 
              <div class="mb-3">
                <span>
                <i>*Lưu ý: 
                  <br> + Bạn cần chuyển khoản số tiền <b><?php echo number_format($detail[0]['SoTienRut'] * (1 - ($phiruttien / 100))); ?> VND</b> cho tài khoản <b><?php echo $detail[0]['TaiKhoan']; ?></b> trước khi xác nhận rút tiền!
                  <br> + Hệ thống sẽ tự động trừ <b><?php echo number_format($detail[0]['SoTienRut']); ?> VND</b> khỏi tài khoản <b><?php echo $detail[0]['TaiKhoan']; ?></b> sau khi xác nhận rút tiền!
                </i>
                </span>
              </div>
              
              <a class="btn btn-success" href="<?php echo base_url('admin/rut-tien/'); ?>">Quay Lại</a>
              <?php if($detail[0]['TrangThai'] == 1){ ?>
                <a class="btn btn-primary" href="<?php echo base_url('admin/rut-tien/'.$detail[0]['MaRutTien'].'/xac-nhan/'); ?>">Xác Nhận Rút Tiền</a>
              <?php } ?>
              <?php if($detail[0]['TrangThai'] == 1){ ?>
                <a class="btn btn-warning" href="<?php echo base_url('admin/rut-tien/'.$detail[0]['MaRutTien'].'/huy/'); ?>" style="color: white;">Hủy Yêu Cầu Rút Tiền</a>
              <?php } ?>
            </form>
          </div>
        </div>
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
