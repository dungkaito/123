<div class="container" style="padding-bottom:100px;">
    <div class="row">
        <div class="col-md-4 mt-5">
            <?php
            echo '<img class="rounded img-fluid" alt="avatar" src="data:image/jpeg;base64,' . base64_encode($data['avatar']) . '">';
            ?>
        </div>
        <div class="col-md-8 mt-5">
            <div class="form-row">
                <div class="form-group col-md-2">
                    <label for="#">Tài khoản:</label>
                </div>
                <div class="form-group col-md-6">
                    <input disabled type="text" class="form-control" value="<?php echo $data['username'] ?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-2">
                    <label for="#"><?php echo ($data['role'] == 1) ? 'Giáo viên' : 'Sinh viên'; ?>:</label>
                </div>
                <div class="form-group col-md-6">
                    <input disabled type="text" class="form-control" value="<?php echo $data['name'] ?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-2">
                    <label for="#">Email:</label>
                </div>
                <div class="form-group col-md-6">
                    <input disabled type="text" class="form-control" value="<?php echo $data['email'] ?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-2">
                    <label for="#">Số điện thoại:</label>
                </div>
                <div class="form-group col-md-6">
                    <input disabled type="text" class="form-control" value="<?php echo $data['phone'] ?>">
                </div>
            </div>
            <a href="?controller=user&action=update" class="btn btn-primary">Cập nhật thông tin</a>
        </div>
    </div>
</div>