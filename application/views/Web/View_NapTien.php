<?php require(APPPATH.'views/web/layouts/header.php'); ?>
<!-- START SECTION BREADCRUMB -->
<div class="breadcrumb_section bg_gray page-title-mini">
    <div class="container"><!-- STRART CONTAINER -->
        <div class="row align-items-center">
        	<div class="col-md-6">
                <div class="page-title">
            		<h1>
                        <?php echo $title; ?>
                    </h1>
                </div>
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb justify-content-md-end">
                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Trang Chủ</a></li>
                    <li class="breadcrumb-item"><a href="<?php echo base_url('nguoi-dung/'); ?>">Người Dùng</a></li>
                    <li class="breadcrumb-item active">
                        <?php echo $title; ?>
                    </li>
                </ol>
            </div>
        </div>
    </div><!-- END CONTAINER-->
</div>
<!-- END SECTION BREADCRUMB -->

<div class="section">
    <div class="container">
        <form class="row" method="post">
            <div class="col-md-6">
                <div class="heading_s1">
                    <h4>Thông Tin Nạp Tiền</h4>
                </div>
                <div class="form-group mb-3">
                    <label class="form-label">Tài Khoản</label>
                    <input type="text" required="" class="form-control" name="hoten" placeholder="Tài khoản *" value="<?php echo $_SESSION['khachhang']; ?>" disabled>
                </div>
                <div class="form-group mb-3">
                    <label class="form-label">Họ Tên</label>
                    <input type="text" required="" class="form-control" name="hoten" placeholder="Họ tên *" value="<?php echo $_SESSION['hoten']; ?>" disabled>
                </div>
                <div class="form-group mb-3">
                    <label class="form-label">Số Điện Thoại</label>
                    <input type="text" required="" class="form-control" name="sodienthoai" value="<?php echo $_SESSION['sodienthoai']; ?>" placeholder="Số điện thoại *" disabled>
                </div>
                <div class="form-group mb-3">
                    <label class="form-label">Email</label>
                    <input class="form-control" required="" type="email" name="email" value="<?php echo $_SESSION['email']; ?>" placeholder="Email *" disabled>
                </div>
                <div class="form-group mb-3">
                    <label class="form-label">Số Dư Hiện Tại</label>
                    <input type="text" class="form-control" value="<?php echo number_format($_SESSION['sodukhadung']) ?> VND" disabled>
                </div>
                <div class="form-group mb-3">
                    <label class="form-label">Số Tiền Nạp</label>
                    <input type="number" id="sotien" class="form-control" name="sotiennap" required="" placeholder="Số Tiền Nạp *">
                </div>
                <div class="custome-radio nhanhang">
                    <label for="exampleRadios3">* Lưu ý: Bạn cần chuyển khoản trước số tiền nạp theo mã QR bên phải, tiếp theo nhập "Số Tiền Nạp *" sau đó nhấn nút "Xác Nhận Nạp Tiền"!</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="order_review">
                    <div class="heading_s1">
                        <h4>Thông Tin Chuyển Khoản</h4>
                    </div>
                    <div class="heading_s1">
                        <img src="<?php echo $config[0]['MaQRNapTien']; ?>" style="display: block; margin-left: auto; margin-right: auto;">
                    </div>
                    <div class="payment_method">
                        <div class="heading_s1">
                            <h4>Thanh Toán</h4>
                        </div>
                        <div class="payment_option">
                            <div class="custome-radio nhanhang">
                                <label for="exampleRadios3">Số Dư Tài Khoản: <?php echo number_format($_SESSION['sodukhadung']); ?> VND</label>
                            </div>
                            <div class="custome-radio nhanhang">
                                <label for="exampleRadios3" class="sotiensaunap">Số Dư Sau Nạp Tiền: <?php echo number_format($_SESSION['sodukhadung']); ?> VND</label>
                            </div>
                        </div>
                    </div>  
                    <button type="submit" class="btn btn-fill-out btn-block">Xác Nhận Nạp Tiền</button>
                    <?php if(isset($error)){ ?>
                        <br>
                        <div class="custome-radio text-center">
                            <label for="exampleRadios3"><?php echo $error; ?></label>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </form>
    </div>
</div>
<style type="text/css">
    .form-control:disabled, .form-control[readonly] {
        background-color: #ffffff;
        opacity: 1;
        cursor: not-allowed;
    }
</style>
<?php require(APPPATH.'views/web/layouts/footer.php'); ?>
<script type="text/javascript">
    $(document).ready(function(){
        var soduhientai = '<?php echo $_SESSION['sodukhadung']; ?>';
        $('#sotien').on('keyup', function(){
            var sotiennap = $(this).val();
            var sotienmoi = parseInt(sotiennap) + parseInt(soduhientai);
            $('.sotiensaunap').html('Số Dư Sau Nạp Tiền: ' + sotienmoi.toLocaleString('en-US') + ' VND');

            if(sotiennap == ""){
                $('.sotiensaunap').html('Số Dư Sau Nạp Tiền: ' + soduhientai.toLocaleString('en-US') + ' VND');
            }
        });
    });
</script>