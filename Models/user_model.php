<?php


require_once dirname(__DIR__) . '../Config/Config.php';

class User
{
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }

    public function findUserByEmailOrUsername($email, $username)
    {
        $this->db->query('SELECT * FROM users WHERE usersEmail = :email');
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function register($data)
    {
        $this->db->query('INSERT INTO users (usersName, usersEmail, usersPwd) 
        VALUES (:name, :email, :password)');

        $this->db->bind(':name', $data['usersName']);
        $this->db->bind(':email', $data['usersEmail']);
        $this->db->bind(':password', $data['usersPwd']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function login($nameOrEmail, $password)
    {
        $row = $this->findUserByEmailOrUsername($nameOrEmail, $nameOrEmail);

        if ($row == false) return false;

        $hashedPassword = $row->usersPwd;
        if (password_verify($password, $hashedPassword)) {
            return $row;
        } else {
            return false;
        }
    }

    public function resetPassword($newPwdHash, $tokenEmail)
    {
        $this->db->query('UPDATE users SET usersPwd=:pwd WHERE usersEmail=:email');
        $this->db->bind(':pwd', $newPwdHash);
        $this->db->bind(':email', $tokenEmail);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function updateUserInfo($usersName, $usersEmail, $phoneNo, $usersId, $imageUrl)
    {
        $this->db->query('UPDATE users SET usersName=:usersName, usersEmail=:usersEmail, phoneNo=:phoneNo, imageUrl=:imageUrl WHERE usersId=:usersId');
        $this->db->bind(':usersName', $usersName);
        $this->db->bind(':usersEmail', $usersEmail);
        $this->db->bind(':phoneNo', $phoneNo);
        $this->db->bind(':usersId', $usersId);
        $this->db->bind(':imageUrl', $imageUrl);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function changePassword($oldPwdHash, $newPwdHash, $usersEmail)
    {
        $this->db->query('SELECT usersPwd FROM users WHERE usersEmail=:usersEmail');
        $this->db->bind(':usersEmail', $usersEmail);
        $row = $this->db->single();
        $hashedPassword = $row->usersPwd;

        if (password_verify($oldPwdHash, $hashedPassword)) {
            $this->db->query('UPDATE users SET usersPwd=:pwd WHERE usersEmail=:usersEmail');
            $newHashedPassword = password_hash($newPwdHash, PASSWORD_DEFAULT);
            $this->db->bind(':pwd', $newHashedPassword);
            $this->db->bind(':usersEmail', $usersEmail);

            if ($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}
