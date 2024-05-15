<?php require(APPPATH.'views/user/layouts/header.php'); ?>
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
              <li class="breadcrumb-item"><a href="<?php echo base_url('user/'); ?>">Trang Chủ</a></li>
              <li class="breadcrumb-item"><a href="<?php echo base_url('user/muon-sach/'); ?>">Quản Lý Mượn Sách</a></li>
              <li class="breadcrumb-item active">Mã Mượn Sách 000<?php echo $detail[0]['MaMuonSach']; ?></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

        <section class="content">
      <div class="container-fluid">
        <div class="card card-default">
          <div class="card-header">
            <h5>Trạng Thái Mượn Sách</h5>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <form method="post" enctype="multipart/form-data">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="ten">Tên Sách</label>
                    <input type="text" class="form-control" placeholder="Tên sách" value="<?php echo $detail[0]['TenSach']; ?>" disabled>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="ten">Chủ Sách</label>
                    <input type="text" class="form-control" placeholder="Chủ sách" value="<?php echo $this->Model_MuonSach->getUserBook($detail[0]['MNDSach'])[0]['TaiKhoan']; ?>" disabled>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="ten">Người Mượn</label>
                    <input type="text" class="form-control" placeholder="Người mượn sách" value="<?php echo $detail[0]['TaiKhoan']; ?>" disabled>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="ten">Ngày Mượn</label>
                    <input type="text" class="form-control" placeholder="Ngày mượn sách" value="<?php echo date("H:i:s d/m/Y", strtotime($detail[0]['ThoiGian'])); ?>" disabled>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="ten">Ngày Trả</label>
                    <input type="text" class="form-control" placeholder="Ngày trả sách" value="<?php echo date("d/m/Y", strtotime($detail[0]['ThoiGianTra'])); ?>" disabled>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="ten">Trạng Thái Mượn</label>
                    <select class="form-control" aria-label="Default select example" name="trangthai">
                      <option value="0" <?php echo $detail[0]['TrangThai'] == 0 ? "selected" : ""; ?>>Đã hủy mượn sách</option>
                      <option value="1" <?php echo $detail[0]['TrangThai'] == 1 ? "selected" : ""; ?>>Đang chờ duyệt</option>
                      <option value="2" <?php echo $detail[0]['TrangThai'] == 2 ? "selected" : ""; ?>>Chuẩn bị giao sách</option>
                      <option value="3" <?php echo $detail[0]['TrangThai'] == 3 ? "selected" : ""; ?>>Đã giao sách</option>
                      <option value="4" <?php echo $detail[0]['TrangThai'] == 4 ? "selected" : ""; ?>>Đã trả sách</option>
                    </select>
                  </div>
                </div>
              </div> 
              <a class="btn btn-success" href="<?php echo base_url('user/muon-sach/'); ?>">Quay Lại</a>
              <button class="btn btn-primary">Cập Nhật Trạng Thái Mượn</button>
            </form>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
</div>
<style type="text/css">
  .form-control:disabled, .form-control[readonly] {
    background-color: white;
    opacity: 1;
  }
</style>
<?php require(APPPATH.'views/user/layouts/footer.php'); ?>

