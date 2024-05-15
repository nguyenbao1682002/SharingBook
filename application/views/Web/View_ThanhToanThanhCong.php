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
                    <li class="breadcrumb-item"><a href="<?php echo base_url('gio-hang/'); ?>">Giỏ Hàng</a></li>
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
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="text-center order_complete">
                    <i class="fas fa-check-circle"></i>
                    <div class="heading_s1">
                    <h3>Đặt sách thành công!</h3>
                    </div>
                    <p>Cảm ơn bạn đã mượn sách! Chúng tôi sẽ thông báo cho chủ sách để gửi sách đến cho bạn sớm nhất có thể, ngoài ra bạn có thể truy cập trang quản lý mượn sách của <a href="<?php echo base_url('user/muon-sach/'); ?>">người dùng!</a></p>
                    <a href="<?php echo base_url('sach/'); ?>" class="btn btn-fill-out">Tiếp Tục Chọn Sách</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require(APPPATH.'views/web/layouts/footer.php'); ?>
