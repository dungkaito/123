<div class="container" style="padding-bottom:80px;">
    <br>
    <div class="row">
        <div class="col-6">
            <h3>Danh sách bài tập</h3>
        </div>
        <div class="col-6 text-right pr-4">
            <?php if ($data['user']['role'] == 1) { ?>

                <a href="?controller=classwork&action=add" class="btn btn-primary btn-sm" role="button">Thêm bài tập</a>

            <?php } ?>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tiêu đề</th>
                    <th scope="col">Ngày đăng</th>
                    <th scope="col" style="width:1%;"></th>
                </tr>
            </thead>
            <tbody>
            <?php $count = 1 ?>
                <?php foreach ($data['classworks'] as $cw) { ?>

                        <tr>


                            <th scope="row"><?= $count++; ?></th>
                            <td><?= $cw['title']; ?></td>
                            <td><?= $cw['date']; ?></td>
                            <td><a href="?controller=classwork&action=detail&id=<?= $cw['id'] ?>" class="btn btn-info btn-sm" style="white-space: nowrap">Xem chi tiết</a></td>
                            

                        </tr>

                <?php } ?>
            </tbody>
        </table>
    </div>
</div>