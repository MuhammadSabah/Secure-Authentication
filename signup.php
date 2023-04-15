<?php
include_once './helper/session_helper.php';
?>
<h1>Signup</h1>
<?php flash('register'); ?>
<form method="post" action="./controllers/auth_controller.php">
    <input type="hidden" name="type" value="register">
    <input type="text" name='usersName'>
    <input type="email" name='usersEmail'>
    <input type="password" name='usersPwd'>

    <button type="submit" name="submit">Signup</button>
</form>