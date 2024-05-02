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
        <form class="row" method="post">
            <div class="col-md-6">
                <div class="heading_s1">
                    <h4>Thông Tin Thanh Toán</h4>
                </div>
                <div class="form-group mb-3">
                    <input type="text" required="" class="form-control" name="hoten" placeholder="Họ tên *" value="<?php echo $_SESSION['hoten']; ?>" disabled>
                </div>
                <div class="form-group mb-3">
                    <input type="text" required="" class="form-control" name="sodienthoai" value="<?php echo $_SESSION['sodienthoai']; ?>" placeholder="Số điện thoại *" disabled>
                </div>
                <div class="form-group mb-3">
                    <input class="form-control" required="" type="email" name="email" value="<?php echo $_SESSION['email']; ?>" placeholder="Email *" disabled>
                </div>
                <div class="form-group mb-3">
                    <input type="text" class="form-control" name="tinh" required="" placeholder="Tỉnh / Thành Phố *">
                </div>
                <div class="form-group mb-3">
                    <input type="text" class="form-control" name="huyen" required="" placeholder="Quận / Huyện *">
                </div>
                <div class="form-group mb-3">
                    <input type="text" class="form-control" name="xa" required="" placeholder="Xã / Phường *">
                </div>
                <div class="form-group mb-3">
                    <input class="form-control" required="" type="text" name="diachi" placeholder="Địa chỉ nhận hàng *">
                </div>
            </div>
            <div class="col-md-6">
                <div class="order_review">
                    <div class="heading_s1">
                        <h4>Thông Tin Đơn Hàng</h4>
                    </div>
                    <div class="table-responsive order_table">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Sản Phẩm</th>
                                    <th>Thành Tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $tongtien = 0; ?>
                                <?php foreach($list as $key => $value): ?>
                                    <tr>
                                        <td><?php echo $value['name']; ?> <span class="product-qty">x <?php echo $value['number']; ?></span></td>
                                        <td><?php echo number_format($value['price'] * $value['number']); ?>đ</td>
                                    </tr>
                                    <?php $tongtien += $value['number'] * $value['price']; ?>
                                <?php endforeach ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Tạm Tính</th>
                                    <td class="product-subtotal"><?php echo number_format($tongtien); ?>đ</td>
                                </tr>
                                <tr>
                                    <th>Phí Giao Hàng</th>
                                    <td>
                                        <?php $phiship = 0; ?>
                                        <?php if($tongtien >= $config[0]['MienPhiShip']){ ?>
                                            + <?php echo $phiship; ?>đ
                                        <?php }else{ ?>
                                            + <?php 
                                                $phiship = $config[0]['PhiShip']; 
                                                echo number_format($config[0]['PhiShip'])
                                            ?>đ
                                        <?php } ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Giảm Giá</th>
                                    <td>
                                        <?php if(!isset($_SESSION['saleCode'])){ ?>
                                            - 0đ
                                        <?php }else{ ?>
                                            - <?php echo number_format($_SESSION['saleCode']) ?>đ
                                        <?php } ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Tổng Tiền</th>
                                    <td class="product-subtotal"><?php echo number_format($_SESSION['sumCart'] + $phiship) ?>đ</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="payment_method">
                        <div class="heading_s1">
                            <h4>Thanh Toán</h4>
                        </div>
                        <div class="payment_option">
                            <div class="custome-radio nhanhang">
                                <input class="form-check-input" required="" type="radio" name="payment_option" id="exampleRadios3" value="option3" checked="">
                                <label class="form-check-label" for="exampleRadios3">Trả Tiền Mặt</label>
                                <p data-method="option3" class="payment-text">Bạn sẽ thanh toán trực tiếp khi nhận được sản phẩm. </p>
                            </div>
                            <div class="custome-radio chuyenkhoan">
                                <input class="form-check-input" type="radio" name="payment_option" id="exampleRadios4" value="option4">
                                <label class="form-check-label" for="exampleRadios4">Chuyển Khoản</label>
                                <p data-method="option4" class="payment-text">Nội dung: KH <?php echo $_SESSION['khachhang'] ?> TTDH <?php echo $_SESSION['sumCart'] + $phiship ?> VND</p>
                                <div class="maqr"></div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" class="thanhtoan" name="thanhtoan" value="0">
                    <button type="submit" class="btn btn-fill-out btn-block">Đặt Hàng</button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php require(APPPATH.'views/web/layouts/footer.php'); ?>


<script type="text/javascript">
    $(document).ready(function(){
        $(".chuyenkhoan").click(function(e){
            $(".maqr").html('<img src="<?php echo $config[0]['QRNganHang']; ?>">');
            $(".thanhtoan").val(2);
        });

        $(".nhanhang").click(function(e){
            $(".maqr").empty();
            $(".thanhtoan").val(0);
        });
    });
</script>