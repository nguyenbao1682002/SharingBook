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
              <li class="breadcrumb-item"><a href="<?php echo base_url('admin/nguoi-dung/'); ?>">Quản Lý Ví Tiền</a></li>
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
            <h5>Thông Tin Ví Tiền Người Dùng</h5>
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
                <hr>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="ten">Tổng Nạp</label>
                    <input type="text" class="form-control"  placeholder="Số dư khả dụng" value="<?php echo number_format($wallet[0]['TongNap']); ?> VND" disabled>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="ten">Số Dư Khả Dụng</label>
                    <input type="text" class="form-control"  placeholder="Số dư khả dụng" value="<?php echo number_format($wallet[0]['SoDuKhaDung']); ?> VND" disabled>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="ten">Đã Sử Dụng</label>
                    <input type="text" class="form-control"  placeholder="Đã sử dụng" value="<?php echo number_format($wallet[0]['DaSuDung']); ?> VND" disabled>
                  </div>
                </div>
              </div> 
              <a class="btn btn-success" href="<?php echo base_url('admin/nguoi-dung/'); ?>">Quay Lại</a>
            </form>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6">
            <div class="card card-default">
              <div class="card-header">
                <h5>Cộng Tiền Người Dùng</h5>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form action="<?php echo base_url('admin/nguoi-dung/vi-tien/cong/'); ?>" method="POST">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="ten">Tài Khoản</label>
                        <input type="text" class="form-control"  placeholder="Tài khoản" value="<?php echo $detail[0]['TaiKhoan']; ?>" disabled>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="ten">Số Dư Khả Dụng</label>
                        <input type="text" class="form-control"  placeholder="Số dư khả dụng" value="<?php echo number_format($wallet[0]['SoDuKhaDung']); ?> VND" disabled>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="ten">Số Tiền Cộng</label>
                        <input type="number" class="form-control" name="sotiencong" placeholder="Số tiền cộng">
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="ten">Nội Dung</label>
                        <textarea class="form-control" placeholder="Admin cộng tiền vào tài khoản" rows="3" name="noidung"></textarea>
                      </div>
                    </div>
                  </div> 
                  <div class="text-left">
                    <input type="hidden" name="manguoidung" value="<?php echo $detail[0]['MaNguoiDung']; ?>">
                    <button class="btn btn-primary" type="submit">Cộng Tiền</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card card-default">
              <div class="card-header">
                <h5>Trừ Tiền Người Dùng</h5>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form action="<?php echo base_url('admin/nguoi-dung/vi-tien/tru/'); ?>" method="POST">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="ten">Tài Khoản</label>
                        <input type="text" class="form-control"  placeholder="Tài khoản" value="<?php echo $detail[0]['TaiKhoan']; ?>" disabled>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="ten">Số Dư Khả Dụng</label>
                        <input type="text" class="form-control"  placeholder="Số dư khả dụng" value="<?php echo number_format($wallet[0]['SoDuKhaDung']); ?> VND" disabled>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="ten">Số Tiền Trừ</label>
                        <input type="number" class="form-control" name="sotientru" placeholder="Số tiền trừ">
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Nội Dung</label>
                        <textarea class="form-control" placeholder="Admin trừ tiền khỏi tài khoản" rows="3" name="noidung"></textarea>
                      </div>
                    </div>
                  </div> 
                  <div class="text-left">
                    <input type="hidden" name="manguoidung" value="<?php echo $detail[0]['MaNguoiDung']; ?>">
                    <button class="btn btn-primary" type="submit">Trừ Tiền</button>
                  </div>
                </form>
              </div>
            </div>
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
