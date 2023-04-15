<?php
require_once dirname(__DIR__) . '/models/user.php';
require_once dirname(__DIR__) . '/helper/session_helper.php';

class Users
{
    private $userModel;
    public function __construct()
    {
        $this->userModel = new User;
    }

    public function register()
    {

        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $data = [
            'usersName' => trim($_POST['usersName']),
            'usersEmail' => trim($_POST['usersEmail']),
            'usersPwd' => trim($_POST['usersPwd']),
        ];

        if (
            empty($data['usersName']) || empty($data['usersEmail']) ||
            empty($data['usersPwd'])
        ) {
            flash("register", "Please fill out all inputs");
            redirect("../signup");
        }

        if (!preg_match("/^[a-zA-Z0-9]*$/", $data['usersName'])) {
            flash("register", "Invalid name");
            redirect("../signup");
        }

        if (!filter_var($data['usersEmail'], FILTER_VALIDATE_EMAIL)) {
            flash("register", "Invalid email");
            redirect("../signup");
        }

        if (strlen($data['usersPwd']) < 6) {
            flash("register", "Invalid password");
            redirect("../signup");
        }

        if ($this->userModel->findUserByEmailOrUsername($data['usersEmail'], $data['usersName'])) {
            flash("register", "Username or email already taken");
            redirect("../signup");
        }

        $data['usersPwd'] = password_hash($data['usersPwd'], PASSWORD_DEFAULT);

        if ($this->userModel->register($data)) {
            redirect("../login");
        } else {
            die("Something went wrong");
        }
    }

    public function login()
    {
        $data = [
            'usersEmail' => trim($_POST['usersEmail']),
            'usersPwd' => trim($_POST['usersPwd'])
        ];

        if (empty($data['usersEmail']) || empty($data['usersPwd'])) {
            flash("login", "Please fill out all inputs");
            header("location: ../login");
            exit();
        }

        if ($this->userModel->findUserByEmailOrUsername($data['usersEmail'], $data['usersEmail'])) {
            $loggedInUser = $this->userModel->login($data['usersEmail'], $data['usersPwd']);
            if ($loggedInUser) {
                $this->createUserSession($loggedInUser);
            } else {
                flash("login", "Password Incorrect");
                redirect("../login");
            }
        } else {
            flash("login", "No user found");
            redirect("../login");
        }
    }

    public function createUserSession($user)
    {
        $_SESSION['usersId'] = $user->usersId;
        $_SESSION['usersName'] = $user->usersName;
        $_SESSION['usersEmail'] = $user->usersEmail;
        redirect("../dashboard");
    }

    public function logout()
    {
        unset($_SESSION['usersId']);
        unset($_SESSION['usersName']);
        unset($_SESSION['usersEmail']);
        session_destroy();
        redirect("../login");
    }
}

$init = new Users();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    switch ($_POST['type']) {
        case 'register':
            $init->register();
            break;
        case 'login':
            $init->login();
            break;
    }
} else {
    switch ($_GET['q']) {
        case 'logout':
            $init->logout();
            break;

        default:
            redirect("../login");
    }
}
