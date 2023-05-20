<?php

Class Login extends Users {

    public $ok;
    public $salt;
    public $domain;

    function __construct() {
        parent::__construct();
        $this->ok = false;
        $this->salt = 'ENCRYPT';
        $this->domain = '';

        if (!$this->check_session())
            $this->check_cookie();

        return $this->ok;
    }

    function check_session() {

        if (!empty($_SESSION['userID'])) {
            $this->ok = true;
            return true;
        }
        else
            return false;
    }

    function check_cookie() {
        if (!empty($_COOKIE['userID'])) {
            $this->ok = true;
            return $this->check($_COOKIE['userID']);
        }
        else
            return false;
    }

    function check($userID) {
        global $error;
        $this->initWithUid($userID);
        if ($this->getUid() != null) {
            if ($natnoNew == $card_id) {
                $this->ok = true;

                $_SESSION['userID'] = $this->getUserID();
                $_SESSION['userName'] = $this->getUserName();
                $_SESSION['roleID'] = $this->getRoleID();
                setcookie('userID', $_SESSION['userID'], time() + 60 * 60 * 24 * 7, '/', $this->domain);
                setcookie('userName', $_SESSION['userName'], time() + 60 * 60 * 24 * 7, '/', $this->domain);
                setcookie('roleID', $_SESSION['roleID'], time() + 60 * 60 * 24 * 7, '/', $this->domain);

                return true;
            }
        }
        else
            $error[] = 'Wrong Username';


        return false;
    }

    function login($userName, $password) {

        try {
            $this->checkUser($userName, $password);
            
            if ($this->getUserID() != null) {
                $this->ok = true;

                $_SESSION['userID'] = $this->getUserID();
                $_SESSION['userName'] = $this->getUserName();
                $_SESSION['roleID'] = $this->getRoleID();
                setcookie('userID', $_SESSION['userID'], time() + 60 * 60 * 24 * 7, '/', $this->domain);
                setcookie('userName', $_SESSION['userName'], time() + 60 * 60 * 24 * 7, '/', $this->domain);
                setcookie('roleID', $_SESSION['roleID'], time() + 60 * 60 * 24 * 7, '/', $this->domain);

                return true;
            } else {
                $error[] = 'Wrong Username OR password';
            }
            return false;
        } catch (Exception $e) {
            $error[] = $e->getMessage();
        }

        return false;
    }
    
    function logout() {
        $this->ok = false;
        $_SESSION['userID'] = '';
        $_SESSION['userName'] = '';
        $_SESSION['roleID'] = '';
        setcookie('userID', '', time() - 3600, '/', $this->domain);
        setcookie('userName', '', time() - 3600, '/', $this->domain);
        setcookie('roleID', '', time() - 3600, '/', $this->domain);
        session_destroy();
    }

}
