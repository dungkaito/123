<div class="container">
    <div class="row">
        <div class="col-md-4 mt-5">
            <?php
            echo '<img class="rounded img-fluid" alt="avatar" src="data:image/jpeg;base64,' . base64_encode($data['user']['avatar']) . '">';
            ?>
        </div>
        <div class="col-md-8 mt-5">
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="#">Tài khoản:</label>
                </div>
                <div class="form-group col-md-9">
                    <input disabled type="text" class="form-control" value="<?php echo $data['user']['username'] ?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="#"><?php echo ($data['user']['role'] == 1) ? 'Giáo viên' : 'Sinh viên'; ?>:</label>
                </div>
                <div class="form-group col-md-9">
                    <input disabled type="text" class="form-control" value="<?php echo $data['user']['name'] ?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="#">Email:</label>
                </div>
                <div class="form-group col-md-9">
                    <input disabled type="text" class="form-control" value="<?php echo $data['user']['email'] ?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="#">Số điện thoại:</label>
                </div>
                <div class="form-group col-md-9">
                    <input disabled type="text" class="form-control" value="<?php echo $data['user']['phone'] ?>">
                </div>
            </div>

            <form method="POST" action="?controller=message&action=send">
                <div class="form-group pt-4 mb-2">
                    <input type="hidden" name='idSender' id="idSender" value='<?= $data['currentUser']['id'] ?>'>
                    <input type="hidden" name='idReceiver' id="idReceiver" value='<?= $data['user']['id'] ?>'>
                    <input type="text" class="form-control" name='content' id="content" placeholder="Nhập tin nhắn" required minlength="1">
                </div>
                <!-- <div class="btn btn-primary">Gửi</div> -->
                <button type="submit" class="btn btn-primary">Trò chuyện</button>
            <!-- </form> -->
        </div>
    </div>
</div>