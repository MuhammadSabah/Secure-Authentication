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
        $dirName = "uploads";
        if (!is_dir($dirName)) {
            mkdir($dirName);
        }

        $fileName = $_FILES['image']['name'];
        $fileTmpName = $_FILES['image']['tmp_name'];

        $fileDestination =  '../uploads/' . $fileName;
        if (file_exists($fileTmpName)) {
            move_uploaded_file($fileTmpName, $fileDestination);
        }

        $fileUrl = $fileDestination ?? "uploads/default.png";

        ///////////////////////////////////////////////////////////////////
        $data = [
            'usersName' => trim($_POST['usersName']),
            'phoneNo' => trim($_POST['phoneNo']),
            'usersEmail' => trim($_POST['usersEmail']),
            'usersId' => trim($_POST['usersId']),
            'fileUrl' => $fileUrl,
        ];

        if ($this->userModel->findUserByEmailOrUsername($data['usersEmail'], $data['usersEmail'])) {
            $this->userModel->updateUserInfo($data['usersName'], $data['usersEmail'], $data['phoneNo'], $data['usersId'], $fileUrl);
            $_SESSION['usersId'] = $data['usersId'];
            $_SESSION['usersName'] = $data['usersName'];
            $_SESSION['usersEmail'] = $data['usersEmail'];
            $_SESSION['phoneNo'] = $data['phoneNo'];
            $_SESSION['fileUrl'] = $fileUrl;
            // redirect("../account");
            echo json_encode($data);
        } else {
            flash("dashboard", "No user found");
            redirect("../dashboard");
        }
    }

    public function changePassword()
    {
        $data = [
            'usersPwd' => trim($_POST['usersPwd']),
            'usersPwdConfirm' => trim($_POST['usersPwdConfirm']),
            'usersEmail' => trim($_POST['usersEmail']),
        ];

        if ($this->userModel->findUserByEmailOrUsername($data['usersEmail'], $data['usersEmail'])) {
            $this->userModel->changePassword($data['usersPwd'], $data['usersPwdConfirm'], $data['usersEmail']);
            // redirect("../account");
            echo json_encode($data);
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
