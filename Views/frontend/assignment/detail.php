<div class="container" style="padding-bottom:100px;">
    <!-- <form method="POST" action="?controller=classwork&action=add" enctype="multipart/form-data"> -->
    <div class="form-row mt-5">
        <div class="form-group col-md-2">
            <label for="#">Sinh viên:</label>
        </div>
        <div class="form-group col-md-10">
            <input value="<?= $data['assignment']['studentName'] ?>" readonly type="text" class="form-control" name="title" required minlength="1">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-2">
            <label for="#">Mô tả:</label>
        </div>
        <div class="form-group col-md-10">
            <textarea readonly class="form-control" name="description" id="description" rows="10" required minlength="1"><?= $data['assignment']['description'] ?></textarea>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-2">
            <label for="#">File đính kèm:</label>
        </div>
        <div class="form-group col-md-10">
        <?php if ($data['assignment']['attachment'] != "") { ?>
            <a href="?controller=assignment&action=download&id=<?= $data['assignment']['id'] ?>&filename=<?= $data['assignment']['attachment'] ?>">Tải xuống</a>
            <?php } else { ?>
            <span>Không có</span>
            <?php } ?>
        </div>
    </div>

</div>