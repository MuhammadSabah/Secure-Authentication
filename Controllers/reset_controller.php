<?php

use PHPMailer\PHPMailer\PHPMailer;

require_once dirname(__DIR__) . '../PHPMailer/src/PHPMailer.php';
require_once dirname(__DIR__) . '../PHPMailer/src/Exception.php';
require_once dirname(__DIR__) . '../PHPMailer/src/SMTP.php';
require_once dirname(__DIR__) . '../Models/user_model.php';
require_once dirname(__DIR__) . '../Models/reset_password.php';
require_once dirname(__DIR__) . '../Helper/session_helper.php';


class ResetPasswords
{
    private $resetModel;
    private $userModel;
    private $mail;

    public function __construct()
    {
        $this->resetModel = new ResetPassword;
        $this->userModel = new User;

        $this->mail = new PHPMailer();
        $this->mail->isSMTP();
        $this->mail->Host = 'smtp.mailtrap.io';
        $this->mail->SMTPAuth = true;
        $this->mail->Port = 2525;
        $this->mail->Username = 'c70b647e09ca55';
        $this->mail->Password = '7831786fd5e64f';
    }

    public function sendEmail()
    {
        $usersEmail = trim($_POST['usersEmail']);

        if (empty($usersEmail)) {
            flash("reset", "Please input email");
            redirect("../reset");
        }

        if (!filter_var($usersEmail, FILTER_VALIDATE_EMAIL)) {
            flash("reset", "Invalid email");
            redirect("../reset");
        }
        $selector = bin2hex(random_bytes(8));
        $token = random_bytes(32);
        $url = 'http://localhost/b-muhammad-sabah-ibrahim-4/reset.php?selector=' . $selector . '&validator=' . bin2hex($token);
        $expires = date("U") + 1800;
        if (!$this->resetModel->deleteEmail($usersEmail)) {
            die("There was an error");
        }
        $hashedToken = password_hash($token, PASSWORD_DEFAULT);
        if (!$this->resetModel->insertToken($usersEmail, $selector, $hashedToken, $expires)) {
            die("There was an error");
        }
        $subject = "Reset your password";
        $message = "<p>We recieved a password reset request.</p>";
        $message .= "<p>Here is your password reset link: </p>";
        $message .= "<a href='" . $url . "'>" . $url . "</a>";

        $this->mail->setFrom('TheBoss@gmail.com');
        $this->mail->isHTML(true);
        $this->mail->Subject = $subject;
        $this->mail->Body = $message;
        $this->mail->addAddress($usersEmail);

        $this->mail->send();

        flash("reset", "Check your email", 'form-message form-message-green');
        redirect("../forget");
    }

    public function resetPassword()
    {
        $data = [
            'selector' => trim($_POST['selector']),
            'validator' => trim($_POST['validator']),
            'pwd' => trim($_POST['pwd']),
            'pwd-repeat' => trim($_POST['pwd-repeat'])
        ];
        $url = '../reset.php?selector=' . $data['selector'] . '&validator=' . $data['validator'];

        if (empty($_POST['pwd'] || $_POST['pwd-repeat'])) {
            flash("newReset", "Please fill out all fields");
            redirect($url);
        } else if ($data['pwd'] != $data['pwd-repeat']) {
            flash("newReset", "Passwords do not match");
            redirect($url);
        } else if (strlen($data['pwd']) < 6) {
            flash("newReset", "Invalid password");
            redirect($url);
        }

        $currentDate = date("U");
        if (!$row = $this->resetModel->resetPassword($data['selector'], $currentDate)) {
            flash("newReset", "Sorry. The link is no longer valid");
            redirect($url);
        }

        $tokenBin = hex2bin($data['validator']);
        $tokenCheck = password_verify($tokenBin, $row->pwdResetToken);
        if (!$tokenCheck) {
            flash("newReset", "You need to re-Submit your reset request");
            redirect($url);
        }

        $tokenEmail = $row->pwdResetEmail;
        if (!$this->userModel->findUserByEmailOrUsername($tokenEmail, $tokenEmail)) {
            flash("newReset", "There was an error");
            redirect($url);
        }

        $newPwdHash = password_hash($data['pwd'], PASSWORD_DEFAULT);
        if (!$this->userModel->resetPassword($newPwdHash, $tokenEmail)) {
            flash("newReset", "There was an error");
            redirect($url);
        }

        if (!$this->resetModel->deleteEmail($tokenEmail)) {
            flash("newReset", "There was an error");
            redirect($url);
        }

        flash("newReset", "Password Updated", 'form-message form-message-green');
        redirect($url);
    }
}

$init = new ResetPasswords;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    switch ($_POST['type']) {
        case 'send':
            $init->sendEmail();
            break;
        case 'reset':
            $init->resetPassword();
            break;
        default:
            header("location: ../login");
    }
} else {
    header("location: ../login");
}
