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
                    <th scope="col">Giáo viên</th>
                    <th scope="col" style="width:1%;"></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>bài tập php</td>
                    <td>Bùi Dương</td>
                    <td><a href="#" class="btn btn-info btn-sm" style="white-space: nowrap">Xem thông tin</a></td>

                </tr>
            </tbody>
        </table>
    </div>
</div>