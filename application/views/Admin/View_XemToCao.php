<?php require(APPPATH.'views/admin/layouts/header.php'); ?>
<div class="content-wrapper" style="min-height: 1203.31px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Quản Lý Tố Cáo</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('admin/'); ?>">Trang Chủ</a></li>
              <li class="breadcrumb-item"><a href="<?php echo base_url('admin/to-cao/'); ?>">Quản Lý Tố Cáo</a></li>
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
          <!-- /.card-header -->
          <div class="card-body">
            <form method="post" enctype="multipart/form-data">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="ten">Người Tố Cáo</label>
                    <input type="text" class="form-control" value="<?php echo $detail[0]['TaiKhoan']; ?>" disabled>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="ten">Người Bị Tố Cáo</label>
                    <input type="text" class="form-control" value="<?php echo $this->Model_ToCao->getUserVictim($detail[0]['NanNhan'])[0]['TaiKhoan']; ?>" disabled> 
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
                    <label for="ten">Tiêu Đề</label>
                    <input type="text" class="form-control" value="<?php echo $detail[0]['TieuDe']; ?>" disabled> 
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="ten">Nội Dung</label>
                    <textarea class="form-control" disabled rows="4"><?php echo $detail[0]['NoiDung']; ?></textarea>
                  </div>
                </div>
              </div> 
              <a class="btn btn-success" href="<?php echo base_url('admin/to-cao/'); ?>">Quay Lại</a>
              <?php if($detail[0]['TrangThai'] == 1){ ?>
                <a class="btn btn-primary" href="<?php echo base_url('admin/to-cao/0/trang-thai/?matocao='.$detail[0]['MaToCao']); ?>">Không Xử Lý</a>
              <?php } ?>
              
              <?php if($detail[0]['TrangThai'] == 1){ ?>
                <a class="btn btn-info" href="<?php echo base_url('admin/to-cao/2/trang-thai/?matocao='.$detail[0]['MaToCao']); ?>">Cấm Người Tố Cáo</a>
                <a class="btn btn-danger" href="<?php echo base_url('admin/to-cao/3/trang-thai/?matocao='.$detail[0]['MaToCao']); ?>">Cấm Người Bị Tố Cáo</a>
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

  .fa-star{
      color: #F6BC3E;
    }
</style>
<?php require(APPPATH.'views/admin/layouts/footer.php'); ?>
