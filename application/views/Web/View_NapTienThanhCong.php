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
                    <li class="breadcrumb-item"><a href="<?php echo base_url('nap-tien/'); ?>">Nạp Tiền</a></li>
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
                    <h3>Nạp tiền thành công!</h3>
                    </div>
                    <p>Cảm ơn bạn đã nạp tiền vào hệ thống, chúng tôi sẽ cộng tiền vào tài khoản của bạn sớm nhất! Để xem lịch sử nạp tiền vui lòng truy cập <a href="<?php echo base_url('user/dong-tien/'); ?>">dòng tiền!</a></p>
                    <a href="<?php echo base_url(); ?>" class="btn btn-fill-out">Quay Về Trang Chủ</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require(APPPATH.'views/web/layouts/footer.php'); ?>
