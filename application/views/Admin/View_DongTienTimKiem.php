<?php require(APPPATH.'views/admin/layouts/header.php'); ?>
<div class="content-wrapper" style="min-height: 1203.31px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Quản Lý Dòng Tiền</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('admin/'); ?>">Trang Chủ</a></li>
              <li class="breadcrumb-item active">Quản Lý Dòng Tiền</li>
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
                <form class="row" action="<?php echo base_url('admin/dong-tien/tim-kiem/') ?>"> 
                  <div class="col-sm-2">
                    <label>Tài Khoản</label>
                    <input type="text" name="taikhoan" class="form-control" placeholder="Tài khoản" value="<?php echo $post['taikhoan']; ?>">
                  </div>
                  <div class="col-sm-2">
                    <label>Thời Gian</label>
                    <input type="date" name="thoigian" class="form-control" placeholder="Thời gian" value="<?php echo $post['thoigian']; ?>">
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
                      <th>Người Dùng</th>
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
                        <td>
                          <img src="<?php echo $value['AnhChinh']; ?>" style="width: 100px; height: 100px;">
                        </td>
                        <td><a href="<?php echo base_url('admin/nguoi-dung/'.$value['MaNguoiDung'].'/dong-tien/') ?>"><?php echo $value['TaiKhoan']; ?></a></td>
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
                <a href="<?php echo base_url('admin/dong-tien/') ?>" class="btn btn-success">Quay Lại</a>
                <ul class="pagination pagination-sm m-0 float-right">
                  <?php for($i = 1; $i <= $totalPages; $i++){ ?>
                      <li class="page-item"><a class="page-link" href="<?php echo base_url('admin/dong-tien/tim-kiem/'.$i.'/trang/?taikhoan='.$post['taikhoan'].'&thoigian='.$post['thoigian']) ?>"><?php echo $i; ?></a></li>
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
