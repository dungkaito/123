<div class="container" style="padding-bottom:100px;">
    <div class="form-row mt-5">
        <div class="form-group col-md-2">
            <label for="#">Tiêu đề:</label>
        </div>
        <div class="form-group col-md-10">
            <input value="<?= $data['challenge']['title'] ?>" readonly type="text" class="form-control" name="title" required minlength="1">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-2">
            <label for="#">Gợi ý:</label>
        </div>
        <div class="form-group col-md-10">
            <textarea readonly class="form-control" name="hint" id="hint" rows="10" required minlength="1"><?= $data['challenge']['hint'] ?></textarea>
        </div>
    </div>

    <br>
    <br>
    <br>
    <div class="form-row">
        <div class="form-group col-md-2">
            <label class="h3" for="answer">Nhập đáp án:</label>
        </div>
        <div class="form-group col-md-10">
            <input type="text" class="form-control" name="answer" id="answer" rows="3" required minlength="1">
        </div>
    </div>
    <button onclick="submitAnswer()" class="btn btn-primary">Xác nhận</button>
    <div id="ajaxResponse"></div>
</div>

<script>
    function submitAnswer() {
        ans = document.getElementById("answer").value;
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("ajaxResponse").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "?controller=challenge&action=submit&a=" + <?= $data['challenge']['id'] ?> + "&ans=" + ans, true);
        xmlhttp.send();
    }
</script>