<?php
foreach ($data['messages'] as $ms) {
    if ($ms['idSender'] == $_SESSION['id']) {
        $idReceiver = $ms['idReceiver'];
        break;
    }
}
?>

<?php foreach ($data['messages'] as $ms) { ?>
    <?php if ($ms['idSender'] == $_SESSION['id']) { ?>
        <div class="border border-primary" style="width: fit-content; margin-left: auto;">
            <p class="mb-0"><?= $ms['date'] ?></p>
            <div class="d-flex" style="width: fit-content; margin-left: auto;">

                <form id="editForm<?= $ms['id'] ?>" method="POST" action="?controller=message&action=edit">
                    <input type="hidden" name="id" value="<?= $ms['id'] ?>">
                    <a class="pr-1" href="javascript:$('#editForm<?= $ms['id'] ?>').submit();">Sửa</a>
                </form>

                <form id="deleteForm<?= $ms['id'] ?>" method="POST" action="?controller=message&action=delete">
                    <input type="hidden" name="id" value="<?= $ms['id'] ?>">
                    <a href="javascript:$('#deleteForm<?= $ms['id'] ?>').submit();">Xoá</a>
                </form>
                
            </div>
            <b><?= $ms['content'] ?></b>
        </div>
    <?php } else { ?>
        <div class="border border-primary" style="width: fit-content;">
            <p class="mb-0"><?= $ms['date'] ?></p>
            <b><?= $ms['content'] ?></b>
        </div>
    <?php } ?>
<?php } ?>

<form method="POST" action="?controller=message&action=send">
    <div class="form-group pt-4 mb-2">
        <input type="hidden" name='idSender' id="idSender" value='<?= $data['user']['id'] ?>'>
        <input type="hidden" name='idReceiver' id="idReceiver" value='<?= $idReceiver ?>'>
        <input type="text" class="form-control" name='content' id="content" placeholder="Nhập tin nhắn" required minlength="1">
    </div>
    <button type="submit" class="btn btn-primary">Gửi</button>
</form>
