<?php require(APPPATH.'views/user/layouts/header.php'); ?>
<div class="content-wrapper" style="min-height: 1203.31px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Rút Tiền</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('user/'); ?>">Trang Chủ</a></li>
              <li class="breadcrumb-item active">Rút Tiền</li>
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
            <h5>Thông Tin Rút Tiền</h5>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <form method="POST">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="ten">Tài Khoản</label>
                    <input type="text" class="form-control"  placeholder="Tài khoản" value="<?php echo $_SESSION['khachhang']; ?>" disabled>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="ten">Ngân Hàng</label>
                    <input type="text" class="form-control"  placeholder="Ngân hàng" value="<?php echo $_SESSION['nganhang']; ?>" disabled>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="ten">Số Tài Khoản</label>
                    <input type="text" class="form-control"  placeholder="Số tài khoản" value="<?php echo $_SESSION['sotaikhoan']; ?>" disabled>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="ten">Chủ Tài Khoản</label>
                    <input type="text" class="form-control"  placeholder="Chủ tài khoản" value="<?php echo $_SESSION['chutaikhoan']; ?>" disabled>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="ten">Số Dư Khả Dụng</label>
                    <input type="text" class="form-control"  placeholder="Số dư khả dụng" value="<?php echo number_format($_SESSION['sodukhadung']); ?> VND" disabled>
                  </div>
                </div>
                <div class="col-md-12">
                  <hr>
                  <div class="form-group">
                    <label for="ten">Số Tiền Yêu Cầu Rút</label>
                    <input type="number" class="form-control" name="sotienrut" id="sotien" placeholder="Số tiền rút" max="<?php echo $_SESSION['sodukhadung']; ?>">
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="ten">Thực Nhận</label>
                    <input type="text" class="form-control thucnhan"  placeholder="Thực nhận" value="0 VND" disabled>
                  </div>
                </div>
              </div> 
              <div class="mb-3">
                <span>
                <i>*Lưu ý: 
                  <br> + Bạn sẽ phải chịu <b><?php echo $config[0]['PhiRutTien'] ?>%</b> phí rút tiền cho hệ thống!
                  <br> + Hệ thống sẽ tự động trừ <b class="sodumoi">0 VND</b> khỏi tài khoản sau khi admin xác nhận rút tiền!
                </i>
                </span>
              </div>
              
              <button class="btn btn-primary" type="submit" >Yêu Cầu Rút Tiền</button>
            </form>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
<style type="text/css">
    .form-control:disabled, .form-control[readonly] {
        background-color: #ffffff;
        opacity: 1;
        cursor: not-allowed;
    }
</style>
<?php require(APPPATH.'views/user/layouts/footer.php'); ?>
<script type="text/javascript">
    $(document).ready(function(){
        var phirutien = '<?php echo $config[0]['PhiRutTien']; ?>';
        $('#sotien').on('keyup', function(){
            var sotienrut = $(this).val();
            var thucnhan = parseInt(sotienrut) * (1 - (parseInt(phirutien) / 100));
            $('.thucnhan').val(thucnhan.toLocaleString('en-US') + ' VND');
            $('.sodumoi').html(parseInt(sotienrut).toLocaleString('en-US') + ' VND');

            if((sotienrut == "") || (parseInt(sotienrut) <= 0)){
                $('.thucnhan').val('0 VND');
                $('.sodumoi').html('0 VND');
            }
        });
    });
</script>