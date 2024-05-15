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
                    <label class="form-label">Tỉnh / Thành Phố</label>
                    <input type="text" class="form-control" name="tinh" required="" placeholder="Tỉnh / Thành Phố *">
                </div>
                <div class="form-group mb-3">
                    <label class="form-label">Quận / Huyện</label>
                    <input type="text" class="form-control" name="huyen" required="" placeholder="Quận / Huyện *">
                </div>
                <div class="form-group mb-3">
                    <label class="form-label">Xã / Phường</label>
                    <input type="text" class="form-control" name="xa" required="" placeholder="Xã / Phường *">
                </div>
                <div class="form-group mb-3">
                    <label class="form-label">Địa Chỉ Nhận Sách</label>
                    <input class="form-control" required="" type="text" name="diachi" placeholder="Địa chỉ nhận sách *">
                </div>
                <div class="form-group mb-3">
                    <label class="form-label">Thời Gian Trả</label>
                    <input class="form-control" required type="date" name="thoigiantra">
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
                                        <td><?php echo number_format($value['price_root'] * $value['number']); ?>đ</td>
                                    </tr>
                                    <?php $tongtien += $value['number'] * $value['price_root']; ?>
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
                                    <th>Phí VAT(10%)</th>
                                    <td>
                                        <?php $vat = $tongtien * 0.10; ?>
                                        + <?php echo number_format($vat) ?>đ
                                    </td>
                                </tr>
                                <tr>
                                    <th>Tổng Tiền</th>
                                    <td class="product-subtotal"><?php echo number_format($tongtien + $phiship + $vat) ?>đ</td>
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
                                <label for="exampleRadios3" style="color: #141515;">Số Dư Tài Khoản: <?php echo $_SESSION['sodukhadung'] >= ($tongtien + $phiship + $vat) ? number_format($_SESSION['sodukhadung']) : number_format($_SESSION['sodukhadung']); ?> VND</label>
                            </div>
                            <div class="custome-radio nhanhang">
                                <label for="exampleRadios3" style="color: #141515;">Số Dư Sau Thanh Toán: <?php echo $_SESSION['sodukhadung'] >= ($tongtien + $phiship + $vat) ? number_format($_SESSION['sodukhadung'] - ($tongtien + $phiship + $vat)) : number_format($_SESSION['sodukhadung']); ?> VND</label>
                            </div>
                        </div>
                    </div>  
                    <?php if($_SESSION['sodukhadung'] >= ($tongtien + $phiship + $vat)){ ?>
                        <button type="submit" class="btn btn-fill-out btn-block">Thanh Toán</button>
                    <?php }else{ ?>
                        <button type="submit" class="btn btn-fill-out btn-block" disabled>Không Đủ Tiền</button>
                        <div class="mt-4">
                            <a href="<?php echo base_url('nap-tien/'); ?>" class="btn btn-fill-out btn-block">Nạp Tiền</a>
                        </div>
                    <?php } ?>
                    <?php if(isset($_SESSION['error'])){ ?>
                        <div class="text-center">
                            <br>
                            <span><?php echo $_SESSION['error'] ?></span>
                        </div>
                    <?php } ?>
                    
                </div>
            </div>
        </form>
    </div>
</div>
<?php require(APPPATH.'views/web/layouts/footer.php'); ?>