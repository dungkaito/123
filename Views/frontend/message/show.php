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
            <p><?= $ms['date'] ?></p>
            <b><?= $ms['content'] ?></b>
        </div>
    <?php } else { ?>
        <div class="border border-primary" style="width: fit-content;">
            <p><?= $ms['date'] ?></p>
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