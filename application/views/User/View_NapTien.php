<?php require(APPPATH.'views/user/layouts/header.php'); ?>
<div class="content-wrapper" style="min-height: 1203.31px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Nạp Tiền</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('user/'); ?>">Trang Chủ</a></li>
              <li class="breadcrumb-item active">Nạp Tiền</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    
    <section class="content">
      <div class="container-fluid">
        <form class="row" method="POST">
          <div class="col-md-6">
            <div class="card card-default">
              <div class="card-header">
                <h5>Số Tiền Nạp</h5>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="ten">Tài Khoản</label>
                      <input type="text" class="form-control"  placeholder="Tài khoản" value="<?php echo $_SESSION['khachhang']; ?>" disabled>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="ten">Họ Tên</label>
                      <input type="text" class="form-control"  placeholder="Họ tên" value="<?php echo $_SESSION['hoten']; ?>" disabled>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="ten">Số Điện Thoại</label>
                      <input type="text" class="form-control" placeholder="Số điện thoại" value="<?php echo $_SESSION['sodienthoai']; ?>" disabled>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="ten">Email</label>
                      <input type="email" class="form-control" placeholder="Email" value="<?php echo $_SESSION['email']; ?>" disabled>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="ten">Số Dư Hiện Tại</label>
                      <input type="text" class="form-control" placeholder="Số dư hiện tại" value="<?php echo number_format($_SESSION['sodukhadung']) ?> VND" disabled>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="ten">Số Tiền Nạp</label>
                      <input id="sotien" type="number" name="sotiennap" class="form-control" placeholder="Số Tiền Nạp *" required>
                    </div>
                  </div>
                </div> 
                <label for="exampleRadios3" style="font-weight: unset;">* Lưu ý: Bạn cần chuyển khoản trước số tiền nạp theo mã QR bên phải, tiếp theo nhập "Số Tiền Nạp *" sau đó nhấn nút "Xác Nhận Nạp Tiền"!</label>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card card-default">
              <div class="card-header">
                <h5>Thông Tin Chuyển Khoản</h5>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <img src="<?php echo $config[0]['MaQRNapTien'] ?>" style="width: 50%;display: block; margin-left: auto; margin-right: auto;">
                <hr>
                <h4>Thanh Toán</h4>
                <label for="exampleRadios3" style="font-weight: unset;">Số Dư Tài Khoản: <?php echo number_format($_SESSION['sodukhadung']); ?> VND</label>
                <br>
                <label for="exampleRadios3" class="sotiensaunap" style="font-weight: unset;">Số Dư Sau Nạp Tiền: <?php echo number_format($_SESSION['sodukhadung']); ?> VND</label>
                <hr>
                <button type="submit" class="btn btn-primary w-100">Xác Nhận Nạp Tiền</button>
              </div>
            </div>
          </div>
        </form>
      </div><!-- /.container-fluid -->
    </section>
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
        var soduhientai = '<?php echo $_SESSION['sodukhadung']; ?>';
        var soduvnd = '<?php echo number_format($_SESSION['sodukhadung']); ?>';
        $('#sotien').on('keyup', function(){
            var sotiennap = $(this).val();
            var sotienmoi = parseInt(sotiennap) + parseInt(soduhientai);
            $('.sotiensaunap').html('Số Dư Sau Nạp Tiền: ' + sotienmoi.toLocaleString('en-US') + ' VND');

            if(sotiennap == ""){
                $('.sotiensaunap').html('Số Dư Sau Nạp Tiền: ' + soduvnd + ' VND');
            }
        });
    });
</script>