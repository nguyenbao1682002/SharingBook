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
              <li class="breadcrumb-item"><a href="<?php echo base_url('admin/nguoi-dung/'); ?>">Dòng Tiền Người Dùng</a></li>
              <li class="breadcrumb-item active"><?php echo $detail[0]['TaiKhoan'] ?></li>
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
                      <th>Số Tiền Cũ</th>
                      <th>Số Tiền Thay Đổi</th>
                      <th>Số Tiền Mới</th>
                      <th>Thời Gian</th>
                      <th>Nội Dung</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($list as $key => $value): ?>
                      <tr>
                        <td><?php echo $key + 1; ?></td>
                        <td><?php echo number_format($value['SoTienTruoc']); ?> VND</td>
                        <td><?php echo number_format($value['SoTienThayDoi']); ?> VND</td>
                        <td><?php echo number_format($value['SoTienHienTai']); ?> VND</td>
                        <td><?php echo date("H:i:s d/m/Y", strtotime($value['ThoiGian'])); ?></td>
                        <td><?php echo $value['NoiDung']; ?></td>                        
                      </tr>
                    <?php endforeach ?>
                  </tbody>
                </table>
              </div>
              <div class="card-footer clearfix">
                <a href="<?php echo base_url('admin/nguoi-dung/') ?>" class="btn btn-success">Quay Lại</a>
                <ul class="pagination pagination-sm m-0 float-right">
                  <?php for($i = 1; $i <= $totalPages; $i++){ ?>
                      <li class="page-item"><a class="page-link" href="<?php echo base_url('admin/nguoi-dung/'.$detail[0]['MaNguoiDung'].'/dong-tien/'.$i.'/trang/') ?>"><?php echo $i; ?></a></li>
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
