<div class="container">
    <br>
    <h3>Giáo viên</h3>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Họ tên</th>
                    <th scope="col" style="width:1%;"></th>
                </tr>
            </thead>
            <tbody>
                <?php $count = 1 ?>
                <?php foreach ($data['users'] as $u) { ?>
                    <?php if ($u['role'] == 1) { ?>

                        <tr>
                            <th scope="row"><?= $count++; ?></th>
                            <td><?= $u['name']; ?></td>

                            <?php if ($u['id'] != $data['user']['id']) { ?>
                            <td><a href="#" class="btn btn-info btn-sm" style="white-space: nowrap">Xem thông tin</a></td>
                            <?php } ?>

                        </tr>

                    <?php } ?>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <br>
    <div class="row">
        <div class="col-6">
            <h3>Sinh viên</h3>
        </div>
        <div class="col-6 text-right pr-4">
            <?php if ($data['user']['role'] == 1) { ?>

            <a href="?controller=user&action=add" class="btn btn-primary btn-sm" role="button">Thêm sinh viên</a>

            <?php } ?>
        </div>
    </div>


    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Họ tên</th>
                    <th scope="col" style="width:1%;"></th>

                    <?php if ($data['user']['role'] == 1) { ?>
                    <th scope="col" style="width:1%;"></th>
                    <th scope="col" style="width:1%;"></th>
                    <?php } ?>
                </tr>
            </thead>
            <tbody>
                <?php $count = 1 ?>
                <?php foreach ($data['users'] as $u) { ?>
                    <?php if ($u['role'] == 2) { ?>

                        <tr>
                            <th scope="row"><?= $count++; ?></th>
                            <td><?= $u['name']; ?></td>
                            <?php if ($u['id'] != $data['user']['id']) { ?>
                                
                            <td><a href="#" class="btn btn-info btn-sm" style="white-space: nowrap">Xem thông tin</a></td>
                            
                            <?php if ($data['user']['role'] == 1) { ?>
                            <td><a href="#" class="btn btn-warning btn-sm" style="white-space: nowrap">Sửa thông tin</a></td>
                            <td><a href="#" class="btn btn-dark btn-sm" style="white-space: nowrap">Xoá sinh viên</a></td>
                            <?php } ?>
                            
                            <?php } ?>
                        </tr>

                    <?php } ?>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>