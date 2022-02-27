<div class="container">
<form method="POST" action="?controller=user&action=add" enctype="multipart/form-data">

    <div class="row">
        <div class="col-md-4 mt-5">
            <img class="rounded img-fluid" id="img">
            <input type="file" accept="image/*" name="avatar" id="file" onchange="loadFile(event)" style="display: none;">
            <label class="btn btn-primary btn-sm d-flex justify-content-center" for="file" style="cursor: pointer;">Tải lên ảnh đại diện</label>
        </div>
        <div class="col-md-8 mt-5">
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="#">Tài khoản:</label>
                    </div>
                    <div class="form-group col-md-5">
                        <input type="text" class="form-control" name="username">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="#">Mật khẩu:</label>
                    </div>
                    <div class="form-group col-md-5">
                        <input type="text" class="form-control" name="password">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="#">Họ tên sinh viên:</label>
                    </div>
                    <div class="form-group col-md-5">
                        <input type="text" class="form-control" name="name">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="#">Email:</label>
                    </div>
                    <div class="form-group col-md-5">
                        <input type="text" class="form-control" name="email">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="#">Số điện thoại:</label>
                    </div>
                    <div class="form-group col-md-5">
                        <input type="text" class="form-control" name="phone">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Thêm sinh viên</button>
        </div>
    </div>
    </form>

</div>

<script>
    function loadFile(event) {
        var image = document.getElementById('img');
        image.src = URL.createObjectURL(event.target.files[0]);
    }
</script>