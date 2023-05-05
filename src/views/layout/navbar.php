<ul class="navbar-nav">
    <?php if (!isset($_SESSION['usersId'])) : {
            echo '<li class="nav-item"><a class="nav-link " href="login">Login</a></li>
                                 <li class="nav-item"><a class="nav-link " href="signup">Signup</a></li>';
        }
    else : {
            $userName = $_SESSION["usersName"];
            echo '<li class="nav-item"><a class="nav-link" href="dashboard">Blogs</a></li>
                            <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <ion-icon class="ion-icon ion-nav-icon" name="person-circle-outline"></ion-icon>
                            ' . $userName . '
                             </a>
                            <ul class="dropdown-menu">
                            <li><a  href="account" class="dropdown-item" href="#">
                                    <ion-icon class="ion-icon drop-down-icon" name="settings"></ion-icon> Account
                                </a></li>
                            <li class="nav-item"> <a class="dropdown-item logout-btn" href="./controllers/auth_controller.php?q=logout"><ion-icon class="ion-icon drop-down-icon" name="log-out-outline"></ion-icon>Logout</a></li>
                            </ul>
                            </li>';
        }
    endif; ?>
</ul>