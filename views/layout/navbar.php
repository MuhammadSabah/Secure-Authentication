<h1>NavBar</h1>

<nav>

    <ul>
        <?php if (!isset($_SESSION['usersId'])) : {
                echo '<a href="login">Login</a>
                      <a href="signup">Signup</a>';
            }
        else : {
                echo '<a href="dashboard">Dashboard</a>
                <a href="./controllers/auth_controller.php?q=logout"><li>Logout</li></a>';
            }
        endif; ?>
    </ul>
</nav>