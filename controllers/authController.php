<?php

class AuthController extends User{
    private $username;
    private $password;
    private $email;
    private $firstname;
    private $middlename;
    private $lastname;
    private $role;
    private $studentLevel;
    private $repeatedPassword;

    public function __construct($username, $password, $email, $firstname, $middlename, $lastname, $role, $studentLevel, $repeatedPassword) {
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
        $this->firstname = $firstname;
        $this->middlename = $middlename;
        $this->lastname = $lastname;
        $this->role = $role;
        $this->studentLevel = $studentLevel;
        $this->repeatedPassword = $repeatedPassword;
    }

    public function loginUser() {
        $this->getUser($this->username, $this->password, $this->email);
    }

    public function signupUser() {
        $this->setUser($this->username, $this->password, $this->email, $this->firstname, $this->middlename, $this->lastname, $this->role, $this->studentLevel);
    }

    // Check whether the input is empty
    public function emptyLoginInput() {
        $result = true;
        // Check if these inputs are empty
        if(empty($this->username) || empty($this->password)) {
            $result = false;
        }
        else $result = true;
        return $result;
    }

    private function emptySignupInput() {
        // Check if these inputs are empty
        if(empty($this->firstname) || empty($this->middlename) || empty($this->lastname) || empty($this->email) || empty($this->password) || empty($this->repeatPassword)) {
            return false;
        }
        return true;
    }

    public function invalidEmail() {
        $result = true;
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $result = false;
        }
        return $result;
    }

    private function invalidName() {
        $result = true;
        if(!preg_match('/[a-zA-Z ]/', $this->firstname) || !preg_match('/[a-zA-Z ]/', $this->middlename) || !preg_match('/[a-zA-Z ]/', $this->lastname)) {
            $result = false;
        }
        else $result = true;
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

    private function passwordMatch() {
        $result = true;
        if($this->password !== $this->repeatedPassword) {
            $result = false;
        }
        return $result;
    }

    private function userTaken() {
        $result = true;
        if(!$this->checkUser($this->email)) {
            $result = false;
        }
        else $result = true;
        return $result;
    }
}