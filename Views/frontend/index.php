<h1 class="text-center mt-5">Đăng nhập</h1>

<div class="container">
    <form method="POST" action="?controller=user&action=login">
        <div class="form-group">
            <label for="username">Tài khoản</label>
            <input type="text" class="form-control" id="username" name="username" placeholder="Nhập tài khoản">
        </div>
        <div class="form-group">
            <label for="password">Mật khẩu</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu">
        </div>
        <?php
        if (isset($data['status']) && $data['status'] == 'failed')
            echo '<p>Tài khoản hoặc mật khẩu không chính xác.</p>';
        ?>
        <button type="submit" class="btn btn-primary">Đăng nhập</button>
    </form>
</div>