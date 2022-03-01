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
            <?php if ($data['classwork']['attachment'] != "") { ?>
                <a href="?controller=classwork&action=download&id=<?= $data['classwork']['id'] ?>&filename=<?= $data['classwork']['attachment'] ?>">Tải xuống</a>
            <?php } else { ?>
                <span>Không có</span>
            <?php } ?>
        </div>
    </div>
    <!-- <button type="submit" class="btn btn-primary">Thêm bài tập</button> -->
    <!-- </form> -->
    <?php
    if (isset($data['error'])) {
        echo '<br>';
        echo '<p style="text-align: center; font-size: 40px">' . $data['error'] . '</p>';
    }
    ?>

    <?php if ($data['user']['role'] == 2) { ?>
        <h2>Nộp bài</h2>
        <form method="POST" action="?controller=assignment&action=add" enctype="multipart/form-data">
            <input type="hidden" name="idClasswork" value="<?= $data['classwork']['id'] ?>">
            <div class="form-row">
                <div class="form-group col-md-2">
                    <label for="#">Mô tả:</label>
                </div>
                <div class="form-group col-md-10">
                    <textarea class="form-control" name="description" id="description" rows="3" required minlength="1"></textarea>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-2">
                    <label for="#">File đính kèm:</label>
                </div>
                <div class="form-group col-md-10">
                    <input type="file" class="form-control-file" name="file">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Nộp bài tập</button>
        </form>
    <?php } ?>

    <?php
    if (isset($data['error2'])) {
        echo '<br>';
        echo '<p style="text-align: center; font-size: 40px">' . $data['error2'] . '</p>';
    }
    ?>

    <?php if ($data['user']['role'] == 1) { ?>

        <div class="row">
            <div class="col-6">
                <h3>Danh sách bài nộp</h3>
            </div>
            <div class="col-6 text-right pr-4">

            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Sinh viên</th>
                        <th scope="col">Ngày nộp</th>
                        <th scope="col" style="width:1%;"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $count = 1 ?>
                    <?php foreach ($data['assignments'] as $a) { ?>

                        <tr>


                            <th scope="row"><?= $count++; ?></th>
                            <td><?= $a['studentName']; ?></td>
                            <td><?= $a['date']; ?></td>
                            <td><a href="?controller=assignment&action=detail&id=<?= $a['id'] ?>" class="btn btn-info btn-sm" style="white-space: nowrap">Xem chi tiết</a></td>


                        </tr>

                    <?php } ?>
                </tbody>
            </table>
        </div>
    <?php } ?>

</div>