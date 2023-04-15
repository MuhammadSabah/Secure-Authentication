<?php
include_once './helper/session_helper.php';
?>

<h1>Login</h1>
<?php flash('login'); ?>

<form method="post" action="./controllers/auth_controller.php">
    <input type="hidden" name="type" value="login">
    <input type="email" name='usersEmail'>
    <input type="password" name='usersPwd'>

    <button type="submit" name="submit">Login</button>
</form>

<a href="forget">Forget Password?</a>