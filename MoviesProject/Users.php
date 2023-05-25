<?php

class Users {
    // attributes
    private $userID;
    private $userName;
    private $password;
    private $firstName;
    private $lastName;
    private $DOB;
    private $regDate;
    private $roleID;
    
    // constrcutor
    function __construct() {
        $this->userID = null;
        $this->userName = null;
        $this->password = null;
        $this->firstName = null;
        $this->lastName = null;
        $this->DOB = null;
        $this->regDate = null;
        $this->roleID = null;
    }
    
    // setters and getters
    public function setUserID($userID) {
        $this->userID = $userID;
    }
    
    public function setUserName($userName) {
        $this->userName = $userName;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function setFirstName($firstName) {
        $this->firstName = $firstName;
    }

    public function setLastName($lastName) {
        $this->lastName = $lastName;
    }

    public function setDOB($DOB) {
        $this->DOB = $DOB;
    }

    public function setRegDate($regDate) {
        $this->regDate = $regDate;
    }

    public function setRoleID($roleID) {
        $this->roleID = $roleID;
    }
    
    public function getUserID() {
        return $this->userID;
    }

    public function getUserName() {
        return $this->userName;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getFirstName() {
        return $this->firstName;
    }

    public function getLastName() {
        return $this->lastName;
    }

    public function getDOB() {
        return $this->DOB;
    }

    public function getRegDate() {
        return $this->regDate;
    }

    public function getRoleID() {
        return $this->roleID;
    }
    
    // method to delte user
    function deleteuser() {
        try {
            $db = Database::getInstance();
            $data = $db->querySql('Delete from dbProj_USER where userID=' . $this->userID);
            return true;
        } catch (Exception $e) {
            echo 'Exception: ' . $e;
            return false;
        }
    }
    
    // method to initilize user with userID
    function initWithUid($userID) {

        $db = Database::getInstance();
        $data = $db->singleFetch('SELECT * FROM dbProj_USER WHERE userID = ' . $userID);
        $this->initWith($data->userID, $data->userName, $data->password, $data->firstName, $data->lastName, $data->DOB, $data->regDate, $data->roleID);
    }
    
    // method to check if username exists in database for editing existing user
    function initWithUsername() {

        $db = Database::getInstance();
        $data = $db->singleFetch('SELECT * FROM dbProj_USER WHERE userName = \'' . $this->userName.'\' AND userID != \'' . $this->userID .'\'');
        if ($data != null) {
            return false;
        }
        return true;
    }
    
    // method to validate user login and initilize
    function checkUser($userName, $password){
        $db = Database::getInstance();
        $data = $db->singleFetch('SELECT * FROM dbProj_USER WHERE userName = \''.$userName.'\' AND password = AES_ENCRYPT('.$password.', \'P0ly\')');
        $this->initWith($data->userID, $data->userName, $data->password, $data->firstName, $data->lastName, $data->DOB, $data->regDate, $data->roleID);
    }
    
    // method to register new user
    function registerUser() {
        if ($this->isValid()) {
            try {
                $db = Database::getInstance();
                $data = $db->querySql('INSERT INTO dbProj_USER (userID, userName, password, firstName, lastName, DOB, regDate, roleID) VALUES (NULL, \'' . $this->userName . '\',AES_ENCRYPT('.$this->password.', \'P0ly\'),\'' . $this->firstName . '\', \'' . $this->lastName . '\',
                     \'' . $this->DOB . '\', \'' . $this->regDate . '\', \'' . $this->roleID . '\')');
                return true;
            } catch (Exception $e) {
                echo 'Exception: ' . $e;
                return false;
            }
        } else {
            return false;
        }
    }
    
    // method to initlize data
    private function initWith($userID, $userName, $password, $firstName, $lastName, $DOB, $regDate, $roleID) {
        $this->userID = $userID;
        $this->userName = $userName;
        $this->password = $password;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->DOB = $DOB;
        $this->regDate = $regDate;
        $this->roleID = $roleID;
    }

    // method to update database with edited details
    function updateDB() {
        if ($this->isValid()) {
            $db = Database::getInstance();
            $data = 'UPDATE dbProj_USER set
			userName = \'' . $this->userName . '\',
			password = \'' . $this->password . '\',
			firstName = \'' . $this->firstName . '\',
			lastName = \'' . $this->lastName . '\',
			DOB = \'' . $this->DOB . '\',
			regDate = \'' . $this->regDate . '\',
			roleID = \'' . $this->roleID . '\'
				WHERE userID = ' . $this->userID;
            $db->querySql($data);
        } 
    }
    
    // method to return all users
    function getAllUsers() {
        $db = Database::getInstance();
        $data = $db->multiFetch('Select * from dbProj_USER');
        return $data;
    }
    
    // methoid to return all users of a specific role
    function getAllUsersRole($roleID) {
        $db = Database::getInstance();
        $data = $db->multiFetch('Select * from dbProj_USER WHERE roleID = '. $roleID);
        return $data;
    }
    
    function login($username, $password) {

        try {
            
            $this->checkUser($username, $password);
            if ($this->getUserID() != null) {
                $this->ok = true;

                $_SESSION['userID'] = $this->getUserID();
                $_SESSION['userName'] = $this->getUserName();
                $_SESSION['roleID'] = $this->getRoleID();

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
    
    // method to validate input
    public function isValid() {
        $errors = true;

        if (empty($this->userName))
            $errors = false;
        else {
            if (!$this->initWithUsername())
                $errors = false;
        }
        
        if (empty($this->password))
            $errors = false;
        
        if (empty($this->firstName))
            $errors = false;
        
        if (empty($this->lastName))
            $errors = false;
        
        return $errors;
    }
}
