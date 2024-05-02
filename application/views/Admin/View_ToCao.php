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
              <li class="breadcrumb-item active">Quản Lý Tố Cáo</li>
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
                <form class="row" action="<?php echo base_url('admin/to-cao/tim-kiem/') ?>"> 
                  <div class="col-sm-2">
                    <label>Người Tố Cáo</label>
                    <input type="text" name="nguoitocao" class="form-control" placeholder="Tài khoản người tố cáo">
                  </div>
                  <div class="col-sm-2">
                    <label>Người Bị Tố Cáo</label>
                    <input type="text" name="nguoibitocao" class="form-control" placeholder="Tài khoản người bị tố cáo">
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
                      <th>Người Tố Cáo</th>
                      <th>Người Bị Tố Cáo</th>
                      <th>Tiêu Đề</th>
                      <th>Thời Gian</th>
                      <th>Trạng Thái</th>
                      <th>Xử Lý Tố Cáo</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($list as $key => $value): ?>
                      <tr>
                        <td><?php echo $key + 1; ?></td>
                        <td>
                          <a href="<?php echo base_url('admin/nguoi-dung/'.$value['MaNguoiDung'].'/xem/') ?>"><?php echo $value['TaiKhoan']; ?></a>
                        </td>
                        <td><a href="<?php echo base_url('admin/nguoi-dung/'.$this->Model_ToCao->getUserVictim($value['NanNhan'])[0]['MaNguoiDung'].'/xem/') ?>"><?php echo $this->Model_ToCao->getUserVictim($value['NanNhan'])[0]['TaiKhoan']; ?></a></td>
                        <td>
                          <?php if(strlen($value['TieuDe']) < 50){ ?>
                            <?php echo substr($value['TieuDe'], 0, 50); ?>
                          <?php }else{ ?>
                            <?php echo substr($value['TieuDe'], 0, 50); ?>...
                          <?php } ?>
                        </td>
                        <td>
                          <?php echo date("H:i:s d/m/Y", strtotime($value['ThoiGian'])); ?>
                        </td>
                        <td>
                          <?php if($value['TrangThai'] == 0){ ?>
                            Không Xử Lý
                          <?php }else if($value['TrangThai'] == 1){ ?>
                            Đang Chờ Xử Lý
                          <?php }else if($value['TrangThai'] == 2){ ?>
                            Cấm Người Tố Cáo
                          <?php }else if($value['TrangThai'] == 3){ ?>
                            Cấm Người Bị Tố Cáo
                          <?php } ?>
                        </td>
                        <td>
                          <a href="<?php echo base_url('admin/to-cao/'.$value['MaToCao'].'/xem/'); ?>" class="btn btn-primary" style="color: white;">
                            <i class="fa-solid fa-flag"></i>
                              <span>XỬ LÝ TỐ CÁO</span>
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
                      <li class="page-item"><a class="page-link" href="<?php echo base_url('admin/to-cao/'.$i.'/trang/') ?>"><?php echo $i; ?></a></li>
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
