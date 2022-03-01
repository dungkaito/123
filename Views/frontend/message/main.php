<div class="container" style="padding-bottom:100px;">
    <div class="row">
        <div class="col-md-4 mt-5 table-responsive">
            <table class="table table-hover">

                <tbody>
                    <?php foreach ($data['users'] as $user) { ?>
                        <tr class="d-flex select-user" id="<?= $user['id'] ?>">
                            <th class="col-2"><?php echo '<img class="rounded-circle img-fluid" alt="avatar" src="data:image/jpeg;base64,' . base64_encode($user['avatar']) . '">' ?></th>
                            <th class="col-10 align-text-bottom"><?= $user['name'] ?></th>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <div class="col-md-8 mt-5">
            <div id="messages-view">

            </div>
        </div>
    </div>
</div>

<script>
    function showMessage(user) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("messages-view").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "?controller=message&action=messenger&id=" + user.id, true);
        xmlhttp.send();
    }

    showMessage(document.getElementsByClassName('select-user').item(0));

    var users = document.querySelectorAll('.select-user');
    users.forEach(user => {
        user.addEventListener('click', () => {
            // user.style.color = "blue";
            showMessage(user);
        });
    });
</script>