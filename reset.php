<?php
if (empty($_GET['selector']) || empty($_GET['validator'])) {
    echo 'Could not validate your request!';
} else {
    $selector = $_GET['selector'];
    $validator = $_GET['validator'];

    if (ctype_xdigit($selector) && ctype_xdigit($validator)) { ?>
        <?php
        include_once './helper/session_helper.php';
        ?>
        <h1>Reset Password</h1>

        <?php flash('newReset') ?>

        <form method="post" action="./controllers/reset_controller.php">
            <input type="hidden" name="type" value="reset" />
            <input type="hidden" name="selector" value="<?php echo $selector ?>" />
            <input type="hidden" name="validator" value="<?php echo $validator ?>" />
            <input type="password" name="pwd" placeholder="Enter a new password...">
            <input type="password" name="pwd-repeat" placeholder="Repeat new password...">
            <button type="submit" name="submit">Reset Password</button>
        </form>

<?php
    } else {
        echo 'Could not validate your request!';
    }
}
?>