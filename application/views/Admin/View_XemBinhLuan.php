<?php require(APPPATH.'views/admin/layouts/header.php'); ?>
<div class="content-wrapper" style="min-height: 1203.31px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Quản Lý Bình Luận</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('admin/'); ?>">Trang Chủ</a></li>
              <li class="breadcrumb-item"><a href="<?php echo base_url('admin/binh-luan/'); ?>">Quản Lý Bình Luận</a></li>
              <li class="breadcrumb-item active"><?php echo $detail[0]['TenSach']; ?></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="card card-default">
          <!-- /.card-header -->
          <div class="card-body">
            <form method="post" enctype="multipart/form-data">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="ten">Tên Sách</label>
                    <input type="text" class="form-control" value="<?php echo $detail[0]['TenSach']; ?>" disabled>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="ten">Người Bình Luận</label>
                    <input type="text" class="form-control" value="<?php echo $detail[0]['TaiKhoan']; ?>" disabled> 
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="ten">Thời Gian</label>
                    <input type="text" class="form-control" value="<?php echo date("H:i:s d/m/Y", strtotime($detail[0]['ThoiGian'])); ?>" disabled>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="ten">Đánh Giá</label>
                    <br>
                    <?php if($detail[0]['SoSao'] != 0){ ?>
                      <span>
                        <?php for($i = 1; $i <= 5; $i++){ ?>
                          <?php if($i <= $detail[0]['SoSao']){ ?>
                            <i class="fa-solid fa-star"></i>
                          <?php }else{ ?>
                            <i class="fa-regular fa-star"></i>
                          <?php } ?>
                        <?php } ?>
                      </span>
                    <?php }else{ ?>
                      <span>
                        <i class="fa-regular fa-star"></i>
                        <i class="fa-regular fa-star"></i>
                        <i class="fa-regular fa-star"></i>
                        <i class="fa-regular fa-star"></i>
                        <i class="fa-regular fa-star"></i>
                      </span>
                    <?php } ?>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="ten">Nội Dung</label>
                    <textarea class="form-control" disabled rows="4"><?php echo $detail[0]['NoiDung']; ?></textarea>
                  </div>
                </div>
              </div> 
              <a class="btn btn-success" href="<?php echo base_url('admin/binh-luan/'); ?>">Quay Lại</a>
              <a class="btn btn-danger" href="<?php echo base_url('admin/binh-luan/'.$detail[0]['MaBinhLuan'].'/xoa/'); ?>">Xóa Bình Luận</a>
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

  .fa-star{
      color: #F6BC3E;
    }
</style>
<?php require(APPPATH.'views/admin/layouts/footer.php'); ?>
