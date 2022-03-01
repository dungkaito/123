<div class="container" style="padding-bottom:100px;">
    <form method="POST" action="?controller=user&action=update" enctype="multipart/form-data">
        <input type="hidden" name='id' value="<?= $data['user']['id'] ?>">
        <input type="hidden" name='role' value="<?= $data['user']['role'] ?>">
        <div class="row">
            <div class="col-md-4 mt-5">
                <?php
                echo '<img id="img" class="rounded img-fluid" alt="avatar" src="data:image/jpeg;base64,' . base64_encode($data['user']['avatar']) . '">';
                ?>
                <input type="file" accept="image/*" name="avatar" id="file" onchange="loadFile(event)" style="display: none;">
                <label class="btn btn-primary btn-sm d-flex justify-content-center" for="file" style="cursor: pointer;">Tải lên ảnh đại diện</label>
            </div>
            <div class="col-md-8 mt-5">
                <div class="form-row">
                    <div class="form-group col-md-2">
                        <label for="#">Tài khoản:</label>
                    </div>
                    <div class="form-group col-md-6">
                        <input <?php
                                if ($data['user']['role'] == 2)
                                    echo 'readonly';
                                ?> type="text" class="form-control" name="username" value="<?php echo $data['user']['username'] ?>" required minlength="1">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-2">
                        <label for="#">Mật khẩu:</label>
                    </div>
                    <div class="form-group col-md-6">
                        <input type="text" class="form-control" name="password" value="<?php echo $data['user']['password'] ?>" required minlength="1">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-2">
                        <label for="#"><?php echo ($data['user']['role'] == 1) ? 'Giáo viên' : 'Sinh viên'; ?>:</label>
                    </div>
                    <div class="form-group col-md-6">
                        <input <?php
                                if ($data['user']['role'] == 2)
                                    echo 'readonly';
                                ?> type="text" class="form-control" name="name" value="<?php echo $data['user']['name'] ?>" required minlength="1">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-2">
                        <label for="#">Email:</label>
                    </div>
                    <div class="form-group col-md-6">
                        <input type="text" class="form-control" name="email" value="<?php echo $data['user']['email'] ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-2">
                        <label for="#">Số điện thoại:</label>
                    </div>
                    <div class="form-group col-md-6">
                        <input type="text" class="form-control" name="phone" value="<?php echo $data['user']['phone'] ?>">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Cập nhật</button>
            </div>
        </div>
    </form>
    <?php
    if (isset($data['status'])) {
        echo '<br>';
        if ($data['status'] == 1) {
            echo '<p style="text-align: center; font-size: 40px">Cập nhật thông tin thành công!</p>';
        } else {
            echo '<p style="text-align: center; font-size: 40px">Cập nhật thông tin thất bại!</p>';
        }
    }
    ?>
</div>

<script>
    function loadFile(event) {
        var image = document.getElementById('img');
        image.src = URL.createObjectURL(event.target.files[0]);
    }

    // function loadImgUrl() {
    //     var imgUrl = document.getElementById('img_url').value;
    //     document.getElementById('img').src = imgUrl;
    // }
    // function getImg() {
    //     var imgSrc = document.getElementById('img').src;
    //     if (imgSrc.includes('localhost')) {
    //         document.getElementById('img-post').value = document.getElementById('file').files[0];
    //     }
    //     else {
    //         document.getElementById('img-post').value = imgSrc;
    //     }
    // }
</script>