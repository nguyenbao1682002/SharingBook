<?php require(APPPATH.'views/web/layouts/header.php'); ?>
<!-- START SECTION BREADCRUMB -->
<div class="breadcrumb_section bg_gray page-title-mini">
    <div class="container"><!-- STRART CONTAINER -->
        <div class="row align-items-center">
        	<div class="col-md-6">
                <div class="page-title">
            		<h1><?php echo $title; ?></h1>
                </div>
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb justify-content-md-end">
                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Trang Chủ</a></li>
                    <li class="breadcrumb-item active"><?php echo $title; ?></li>
                </ol>
            </div>
        </div>
    </div><!-- END CONTAINER-->
</div>
<!-- END SECTION BREADCRUMB -->

<div class="section pt-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="heading_s1 text-center">
                    <h2>Gửi Tố Cáo</h2>
                </div>
                <?php if(isset($error) || isset($success)){ ?>
                    <?php if(isset($error)){ ?>
                        <div id="alert-msg" class="alert-msg text-center" style="color: red;"><?php echo $error; ?></div>
                    <?php } ?>

                    <?php if(isset($success)){ ?>
                        <div id="alert-msg" class="alert-msg text-center"><?php echo $success; ?></div>
                    <?php } ?>
                <?php }else{ ?>
                    <?php if(isset($_SESSION['khachhang'])){ ?>
                        <p class="leads text-center">Gửi thông tin tố cáo cho chúng tôi biết để xử lý các tài khoản vi phạm trong hệ thống!</p>
                    <?php }else{ ?>
                        <p class="leads text-center">Bạn chỉ được phép gửi tố cáo khi đã <a href="<?php echo base_url('dang-nhap/') ?>">đăng nhập!</a> </p>
                    <?php } ?>
                <?php } ?>
                <div class="field_form">
                    <form method="post">
                        <div class="row">
                            <div class="form-group col-md-12 mb-3">
                                <label class="form-label">Tố Cáo Tài Khoản</label>
                                <input required placeholder="Họ tên *" class="form-control" type="text" value="<?php echo $taikhoan; ?>" disabled>
                            </div>
                            <div class="form-group col-md-12 mb-3">
                                <label class="form-label">Tiêu Đề</label>
                                <input placeholder="Tiêu đề tố cáo *" class="form-control" name="tieude">
                            </div>
                            <div class="form-group col-md-12 mb-3">
                                <label class="form-label">Nội Dung</label>
                                <textarea placeholder="Nội dung tố cáo *" id="description" class="form-control" name="noidung" rows="4"></textarea>
                            </div>
                            <div class="col-md-12 mb-3">
                                <button type="submit" class="btn btn-fill-out" >Tố Cáo</button>
                            </div>
                            
                        </div>
                    </form>     
                </div>
            </div>
        </div>
    </div>
</div>
<style type="text/css">
    .form-control:disabled, .form-control[readonly] {
        background-color: white;
        opacity: 1;
        cursor: not-allowed;
    }
</style>
<?php require(APPPATH.'views/web/layouts/footer.php'); ?>
