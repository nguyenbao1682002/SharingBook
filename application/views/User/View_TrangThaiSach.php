<?php require(APPPATH.'views/user/layouts/header.php'); ?>
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
              <li class="breadcrumb-item"><a href="<?php echo base_url('user/'); ?>">Trang Chủ</a></li>
              <li class="breadcrumb-item"><a href="<?php echo base_url('user/sach/'); ?>">Quản Lý Sách</a></li>
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
            <h5>Trạng Thái Sách</h5>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <form method="post" enctype="multipart/form-data">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="ten">Tên Sách</label>
                    <input type="text" class="form-control" placeholder="Tên sách" value="<?php echo $detail[0]['TenSach']; ?>" disabled>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="ten">Tên Chuyên Mục</label>
                    <input type="text" class="form-control" placeholder="Tên chuyên mục" value="<?php echo $category; ?>" disabled>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="ten">Trạng Thái Hiển Thị</label>
                    <select class="form-control" aria-label="Default select example" name="trangthai">
                      <option value="1" <?php echo $detail[0]['TrangThai'] == 1 ? "selected" : ""; ?>>Được Hiển Thị</option>
                      <option value="3" <?php echo $detail[0]['TrangThai'] == 3 ? "selected" : ""; ?>>Không Hiển Thị</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="ten">Trạng Thái Mượn</label>
                    <select class="form-control" aria-label="Default select example" name="trangthaimuon">
                      <option value="0" <?php echo $detail[0]['TrangThaiMuon'] == 0 ? "selected" : ""; ?>>Chưa Được Mượn</option>
                      <?php for($i = 1; $i <= $detail[0]['SoLuong']; $i++){ ?>
                        <?php if($i == $detail[0]['TrangThaiMuon']){ ?>
                          <option value="<?php echo $i ?>" selected>Đang Mượn <?php echo $i ?> Quyển</option>
                        <?php }else{ ?>
                          <option value="<?php echo $i ?>">Đang Mượn <?php echo $i ?> Quyển</option>
                        <?php } ?>
                      <?php } ?>   
                    </select>
                  </div>
                </div>
              </div> 
              <a class="btn btn-success" href="<?php echo base_url('user/sach/'); ?>">Quay Lại</a>
              <button class="btn btn-primary">Cập Nhật Trạng Thái Sách</button>
            </form>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<style type="text/css">
  .form-control:disabled, .form-control[readonly] {
    background-color: white;
    opacity: 1;
  }
</style>
<?php require(APPPATH.'views/user/layouts/footer.php'); ?>
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