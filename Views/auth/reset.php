<?php
if (empty($_GET['selector']) || empty($_GET['validator'])) {
    echo 'Could not validate your request!';
} else {
    $selector = $_GET['selector'];
    $validator = $_GET['validator'];

    if (ctype_xdigit($selector) && ctype_xdigit($validator)) { ?>
        <?php
        include_once "Helper\session_helper.php";
        ?>


        <?php flash('newReset') ?>
        <!--  -->
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
            <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
            <link rel="stylesheet" href="../../../public/asset/css/auth-form.css">
            <link rel="stylesheet" href="../../../public/asset/css/navbar.css">
            <script defer type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
            <script nomodule defer src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
            <title>Dashboard</title>

        </head>

        <body>
            <header>
                <?php require('../layout/header.php'); ?>
            </header>
            <main>
                <form class="form-reset" method="post" action="Controllers/reset_controller.php">
                    <h1 class="h3 mb-3 fw-normal">Reset Password</h1>
                    <input type="hidden" name="type" value="reset" />
                    <input type="hidden" name="selector" value="<?php echo $selector ?>" />
                    <input type="hidden" name="validator" value="<?php echo $validator ?>" />
                    <div class="form-floating">
                        <input class="form-control" type="password" name="pwd" id="floatingPassword" placeholder="Enter a new password...">
                        <label for="floatingPassword">New Password</label>
                    </div>
                    <div class="form-floating">
                        <input class="form-control" type="password" name="pwd-repeat" id="repeatedFloatingPassword" placeholder="Repeat new password...">
                        <label for="repeatedFloatingPassword">Confirm New Password</label>
                    </div>
                    <button class="w-100 btn btn-lg btn-primary" type="submit" name="submit">Reset Password</button>
                </form>
            </main>

        </body>

        </html>

<?php
    } else {
        echo 'Could not validate your request!';
    }
}
?>