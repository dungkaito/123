<div class="container" style="padding-bottom:100px;">
    <form method="POST" action="?controller=challenge&action=add" enctype="multipart/form-data">
        <div class="form-row mt-5">
            <div class="form-group col-md-2">
                <label for="#">Tiêu đề:</label>
            </div>
            <div class="form-group col-md-10">
                <input type="text" class="form-control" name="title" required minlength="1">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-2">
                <label for="#">Gợi ý:</label>
            </div>
            <div class="form-group col-md-10">
                <input type="text" class="form-control" name="hint" required minlength="1">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-2">
                <label for="#">File chứa bài thơ, văn...:</label>
            </div>
            <div class="form-group col-md-10">
                <input type="file" class="form-control-file" name="file">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Thêm câu đố</button>
    </form>
    <?php
    if (isset($data['error'])) {
        echo '<br>';
        echo '<p style="text-align: center; font-size: 40px">' . $data['error'] . '</p>';
    }
    ?>
</div>