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
<div class="section">
	<div class="container">
        <div class="row">
            <div class="col-12">
                <div class="table-responsive wishlist_table">
                	<table class="table">
                    	<thead>
                        	<tr>
                            	<th class="product-thumbnail">&nbsp;</th>
                                <th class="product-name">Tên Sách</th>
                                <th class="product-price">Giá Mượn</th>
                                <th class="product-stock-status">Giá Gốc</th>
                                <th class="product-add-to-cart"></th>
                                <th class="product-remove">Xóa</th>
                            </tr>
                        </thead>
                        <tbody>
                        	<?php foreach ($list as $key => $value): ?>
	                        	<tr>
	                            	<td class="product-thumbnail"><a href="#"><img style="max-width: 100px; height: 150px;" src="<?php echo $value['AnhChinh'] ?>" alt="product1"></a></td>
	                                <td class="product-name" data-title="Product"><a href="<?php echo base_url('sach/'.$value['DuongDan'].'/'); ?>"><?php echo $value['TenSach'] ?></a></td>
	                                <td class="product-price" data-title="Price"><?php echo number_format($value['GiaMuon']) ?>đ</td>
	                              	<td class="product-stock-status" data-title="Stock Status"><span class="badge badge-pill badge-success" style="color: black;"><?php echo number_format($value['GiaGoc']) ?>đ</span></td>
	                                <td class="product-add-to-cart"><a href="#" value="<?php echo $value['MaSach'] ?>" class="btn btn-fill-out add-to-cart"><i class="icon-basket-loaded"></i> Thêm Giỏ Hàng</a></td>
	                                <td class="product-remove" data-title="Remove"><a href="<?php echo base_url('yeu-thich/xoa/'.$value['MaSach'].'/'); ?>"><i class="ti-close"></i></a></td>
	                            </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                    <?php if(count($list) <= 0){ ?>
                    	<br>
                    	<p class="text-center">Chưa có sách nào được yêu thích!</p>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require(APPPATH.'views/web/layouts/footer.php'); ?>
<script type="text/javascript">
    $(document).ready(function(){
        $(".add-to-cart").click(function(e){
            e.preventDefault()
            var MaSach = $(this).attr("value");
            let urlThem = "<?php echo base_url('gio-hang/them/') ?>" + MaSach + "/" + "1";

            $.get(urlThem, function(data){
                var cart = JSON.parse(data);
                $(".cart_count").text(cart.numberCart)
                $(".price_symbole").text(cart.sumCart + "đ")

                $('.cart_list').empty();
                var cartList = cart.cart;

                for (const key in cartList) {
                    if (cartList.hasOwnProperty(key)) {
                        const item = cartList[key];
                        var formatter = new Intl.NumberFormat('en-US');
                        var price = formatter.format(item.price_root);
                        $('.cart_list').append('<li> <a href="<?php echo base_url('sach/') ?>'+item.slug+'/"><img src="'+item.image+'" style="height: 80px">'+item.name+'</a> <span class="cart_quantity"> '+item.number+' x <span class="cart_amount"> <span class="price_symbole"></span></span>'+price+'đ</span> </li>');
                    }
                }
            })

        });
    })
</script>