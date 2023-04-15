<?php
include_once './helper/session_helper.php';

flash('reset')
?>

<form class="form-reset" method="post" action="./controllers/reset_controller.php">
    <h1 class="h3 mb-3 fw-normal">Reset Password</h1>
    <input type="hidden" name="type" value="send">
    <div class="form-floating" >
        <input class="form-control" type="email" id="floatingInput" name="usersEmail">
        <label for="floatingInput">Email address</label>
    </div>
    <button class="w-100 btn btn-lg btn-primary" type="submit" name="submit">Search for Email</button>
</form>