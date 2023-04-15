<?php
include_once './helper/session_helper.php';

flash('reset')
?>

<h1>Reset Password</h1>
<form method="post" action="./controllers/reset_controller.php">
    <input type="hidden" name="type" value="send">
    <input type="email" name="usersEmail">
    <button type="submit" name="submit">Search for Email</button>
</form>