<?php require(APPPATH.'views/admin/layouts/header.php'); ?>
<div class="content-wrapper" style="min-height: 1203.31px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Quản Lý Sách</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('admin/'); ?>">Trang Chủ</a></li>
              <li class="breadcrumb-item"><a href="<?php echo base_url('admin/sach/'); ?>">Quản Lý Sách</a></li>
              <li class="breadcrumb-item active"><?php echo $detail[0]['TenSach']; ?></li>
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
            <h5>Thông Tin Sách</h5>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <form method="post" enctype="multipart/form-data">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="ten">Tên Sách</label>
                    <input type="text" class="form-control tenchinh" id="ten" placeholder="Tên sách" name="tensach" value="<?php echo $detail[0]['TenSach']; ?>">
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="ten">Chuyên Mục</label>
                    <select class="form-control" aria-label="Default select example" name="machuyenmuc">
                      <?php foreach ($category as $key => $value): ?>
                        <option value="<?php echo $value['MaChuyenMuc']; ?>"><?php echo $value['TenChuyenMuc']; ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="ten">Tác Giả</label>
                    <input type="text" class="form-control tenchinh" id="ten" placeholder="Tên tác giả" name="tacgia" value="<?php echo $detail[0]['TacGia']; ?>">
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <div class="w-100">
                      <label for="ten">Đường Dẫn</label>
                      <span id="taoduongdan" class="float-right" style="cursor: pointer;">Tạo tự động?</span>
                    </div>
                    <input type="text" class="form-control" id="duongdan" placeholder="Đường dẫn" name="duongdan" value="<?php echo $detail[0]['DuongDan']; ?>">
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="ten">Ảnh Chính</label>
                    <input type="file" class="form-control" id="ten" name="anhchinh">
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="ten">Ảnh Phụ</label>
                    <input type="file" class="form-control" id="ten" name="hinhanh[]" multiple>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="ten">Giá Gốc</label>
                    <input type="number" class="form-control" name="giagoc" placeholder="Giá gốc" value="<?php echo $detail[0]['GiaGoc']; ?>">
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="ten">Giá Cho Mượn</label>
                    <input type="number" class="form-control" name="giamuon" placeholder="Giá cho mượn" value="<?php echo $detail[0]['GiaMuon']; ?>"> 
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="ten">Số Lượng</label>
                    <input type="number" class="form-control" name="soluong" placeholder="Số lượng sách" value="<?php echo $detail[0]['SoLuong']; ?>">
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="ten">Loại Sách</label>
                    <select class="form-control" aria-label="Default select example" name="loaisach">
                      <option value="1" <?php echo $detail[0]['LoaiSach'] == 1 ? "selected" : ""; ?>>Bình Thường</option>
                      <option value="2" <?php echo $detail[0]['LoaiSach'] == 2 ? "selected" : ""; ?>>Khuyến Mãi</option>
                      <option value="3" <?php echo $detail[0]['LoaiSach'] == 3 ? "selected" : ""; ?>>Nội Bật</option>
                      <option value="4" <?php echo $detail[0]['LoaiSach'] == 4 ? "selected" : ""; ?>>Đang Hot</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="ten">Mô Tả Ngắn</label>
                    <textarea id="editor" placeholder="Mô tả ngắn" name="motangan"><?php echo $detail[0]['MoTaNgan']; ?></textarea>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="ten">Mô Tả Chi Tiết</label>
                    <textarea id="editor2" placeholder="Mô tả chi tiết" name="mota"><?php echo $detail[0]['MoTa']; ?></textarea>
                  </div>
                </div>
              </div> 
              <a class="btn btn-success" href="<?php echo base_url('admin/sach/'); ?>">Quay Lại</a>
              <button class="btn btn-primary">Cập Nhật Sách</button>
            </form>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<?php require(APPPATH.'views/admin/layouts/footer.php'); ?>
<script>
    function createSlug(str) {
        // Chuyển đổi tiếng Việt thành dạng slug
        str = str.toLowerCase().trim();
        str = str.replace(/\s+/g, '-'); // Thay thế khoảng trắng bằng dấu gạch ngang
        str = convertVietnameseToSlug(str); // Xử lý các dấu tiếng Việt

        return str;
    }

    function convertVietnameseToSlug(str) {
        var slug = str;

        // Xử lý dấu tiếng Việt
        slug = slug.replace(/[áàảãạăắằẳẵặâấầẩẫậ]/g, 'a');
        slug = slug.replace(/[éèẻẽẹêếềểễệ]/g, 'e');
        slug = slug.replace(/[íìỉĩị]/g, 'i');
        slug = slug.replace(/[óòỏõọôốồổỗộơớờởỡợ]/g, 'o');
        slug = slug.replace(/[úùủũụưứừửữự]/g, 'u');
        slug = slug.replace(/[ýỳỷỹỵ]/g, 'y');
        slug = slug.replace(/đ/g, 'd');

        return slug;
    }

    $(document).ready(function(){
        $('#taoduongdan').click(function(){
            if($(".tenchinh").val() == ""){
                toastr.options = {
                  closeButton: true,
                  progressBar: true,
                  positionClass: 'toast-top-right', // Vị trí hiển thị
                  timeOut: 5000 // Thời gian tự động đóng
              };
              toastr.error('Vui lòng nhập tên Sách!', 'Thất Bại');
            }else{
                $("#duongdan").val(createSlug($(".tenchinh").val()))
            }
        })
    });
</script>
<script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#editor'))
        .catch(error => {
            console.error(error);
        });

    ClassicEditor
        .create(document.querySelector('#editor2'))
        .catch(error => {
            console.error(error);
        });
</script>

<style type="text/css">
  .ck-editor__editable {min-height: 300px;}

</style>