<?php

class LoginController extends User{
    private $email;
    private $password;

    public function __construct($email, $password) {
        $this->email = $email;
        $this->password = $password;
    }

    public function loginUser() {
        $this->getUser($this->email, $this->password);
    }

    // Check whether the input is empty
    public function emptyInput() {
        $result = true;
        // Check if these inputs are empty
        if(empty($this->username) || empty($this->password)) {
            $result = false;
        }
        else $result = true;
        return $result;
    }

    public function invalidEmail() {
        $result = true;
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $result = false;
        }
        return $result;
    }

    public function validatePassword() {
        $result = true;
        // Check password length
        if(strlen($this->password) < 8) {
            $result = false;
        }

        // Check at least one uppercase
        if(!preg_match('/[A-Z]/', $this->password) || !preg_match('/[0-9]/', $this->password)) {
            $result = false;
        }
        return $result;
    }    
}