<div class="container" style="padding-bottom:100px;">
    <form method="POST" action="?controller=message&action=edit">
        <input type="hidden" name="id" value="<?= $data['id'] ?>">
        <div class="form-row mt-5">
            <div class="form-group col-md-2">
                <label for="#">Nội dung:</label>
            </div>
            <div class="form-group col-md-10">
                <input type="text" class="form-control" value="<?= $data['content'] ?>" name="content" required minlength="1">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Sửa tin nhắn</button>
    </form>
</div>