<?php
include_once './helper/session_helper.php';
?>

<?php flash('login'); ?>

<form class="form-login" method="post" action="./controllers/auth_controller.php">
    <h1 class="h3 mb-3 fw-normal">Login</h1>
    <input type="hidden" name="type" value="login">
    <div class="form-floating">
        <input class="form-control" type="email" id="floatingInput" name='usersEmail'>
        <label for="floatingInput">Email address</label>
    </div>
    <div class="form-floating">
        <input class="form-control" id="floatingPassword" type="password" name='usersPwd'>
        <label for="floatingPassword">Password</label>
    </div>

    <button class="w-100 btn btn-lg btn-primary" type="submit" name="submit">Login</button>
    <a href="forget" class="pt-4">Forget Password?</a>
</form>