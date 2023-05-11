<?php

require_once dirname(__DIR__) . '../Models/user_model.php';
require_once dirname(__DIR__) . '../Helper/session_helper.php';

class EditController
{
    private $userModel;
    public function __construct()
    {
        $this->userModel = new User;
    }
    public function updateInfo()
    {
        $fileUrl = '';
        if (isset($_FILES['image'])) {
            $file_name = $_FILES['image']['name'];
            $file_tmp = $_FILES['image']['tmp_name'];

            $upload_dir = "./uploads/";
            if (!file_exists($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }
            move_uploaded_file($file_tmp, $upload_dir . $file_tmp);
        }

        $fileUrl = $upload_dir . $file_name;

        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $data = [
            'usersName' => trim($_POST['usersName']),
            'phoneNo' => trim($_POST['phoneNo']),
            'usersEmail' => trim($_POST['usersEmail']),
            'usersId' => trim($_POST['usersId']),
        ];

        if ($this->userModel->findUserByEmailOrUsername($data['usersEmail'], $data['usersEmail'])) {

            $this->userModel->updateUserInfo($data['usersName'], $data['usersEmail'], $data['phoneNo'], $data['usersId'], $fileUrl);
            $_SESSION['usersId'] = $data['usersId'];
            $_SESSION['usersName'] = $data['usersName'];
            $_SESSION['usersEmail'] = $data['usersEmail'];
            $_SESSION['phoneNo'] = $data['phoneNo'];
            $_SESSION['fileUrl'] = $fileUrl;
            redirect("../account");
        } else {
            flash("dashboard", "No user found");
            redirect("../dashboard");
        }
    }

    public function changePassword()
    {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $data = [
            'usersPwd' => trim($_POST['usersPwd']),
            'usersPwdConfirm' => trim($_POST['usersPwdConfirm']),
            'usersEmail' => trim($_POST['usersEmail']),
        ];

        if ($this->userModel->findUserByEmailOrUsername($data['usersEmail'], $data['usersEmail'])) {
            $this->userModel->changePassword($data['usersPwd'], $data['usersPwdConfirm'], $data['usersEmail']);
            redirect("../account");
        } else {
            flash("dashboard", "No user found");
            redirect("../dashboard");
        }
    }
}

$init = new EditController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    switch ($_POST['type']) {
        case 'update':
            $init->updateInfo();
            break;
        case 'change':
            $init->changePassword();
            break;
    }
} else {
    switch ($_GET['q']) {
        default:
            redirect("../dashboard");
    }
}
