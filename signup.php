<?php
include_once './helper/session_helper.php';
?>
<?php flash('register'); ?>

<form class="form-signup" method="post" action="./controllers/auth_controller.php">
    <h1 class="h3 mb-3 fw-normal">Signup</h1>
    <input type="hidden" name="type" value="register">
    <div class="form-floating">
        <input type="text" class="form-control signup-name-field" name='usersName'>
        <label for="floatingInput">Username</label>
    </div>
    <div class="form-floating">
        <input type="email" class="form-control signup-email-field" name='usersEmail' id="floatingInput">
        <label for="floatingInput">Email address</label>
    </div>
    <div class="form-floating">
        <input type="password" class="form-control signup-pass-field" name='usersPwd' id="floatingPassword">
        <label for="floatingPassword">Password</label>
    </div>

    <button class="w-100 btn btn-lg btn-primary" type="submit" name="submit">Signup</button>
</form>