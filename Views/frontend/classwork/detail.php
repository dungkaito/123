<div class="container" style="padding-bottom:100px;">
    <!-- <form method="POST" action="?controller=classwork&action=add" enctype="multipart/form-data"> -->
        <div class="form-row mt-5">
            <div class="form-group col-md-2">
                <label for="#">Tiêu đề:</label>
            </div>
            <div class="form-group col-md-10">
                <input value="<?= $data['classwork']['title'] ?>" readonly type="text" class="form-control" name="title" required minlength="1">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-2">
                <label for="#">Mô tả:</label>
            </div>
            <div class="form-group col-md-10">
                <textarea readonly class="form-control" name="description" id="description" rows="10" required minlength="1"><?= $data['classwork']['description'] ?></textarea>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-2">
                <label for="#">File đính kèm:</label>
            </div>
            <div class="form-group col-md-10">
            <a href="downloads.php?file_id=<?php echo $file['id'] ?>">Tải xuống</a>
                <!-- <input type="file" class="form-control-file" name="file"> -->
            </div>
        </div>
        <!-- <button type="submit" class="btn btn-primary">Thêm bài tập</button> -->
    <!-- </form> -->
</div>