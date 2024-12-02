<?php

class User extends Dbh {

    protected function getUser($username, $email, $pwd) {

        $query = $this->connect()->prepare("SELECT user_password FROM Users WHERE username=? OR email=?;");

        $query->bind_param("ss", $username, $email);

        if(!$query->execute()) {
            $query = null;
            header("location: ../index.php?page=login&error=queryfailed");
            exit();
        }

        $result = $query->get_result();
        $query->close();

        if(!$result->num_rows > 0) {
            $query = null;
            header("location: ../index.php?page=login&error=usernotfound");
            exit();
        }

        $user = $result->fetch_all(MYSQLI_ASSOC);
        $checkPwd = password_verify($pwd, $user[0]["user_password"]); // Return true = same OR false

        if($checkPwd == false) {
            $query = null;
            header("location: ../index.php?page=login&error=wrongpassword");
            exit();
        }
        elseif($checkPwd == true) {
            $query = null;
            $query = $this->connect()->prepare("SELECT * FROM Users WHERE email=?;");

            $query->bind_param("s", $email);

            if(!$query->execute()) {
                $query = null;
                header("location: ../index.php?page=login&error=queryfailed");
                exit();
            }

            $result = $query->get_result();
            $query->close();

            if($result->num_rows == 0) {
                $query = null;
                header("location: ../index.php?page=login&error=usernotfound1");
                exit();
            }

            $user = $result->fetch_all(MYSQLI_ASSOC);
            
            $hashedPassword = password_hash($pwd, PASSWORD_DEFAULT);
            // Send COOKIE
            if(isset($_REQUEST['remember-me'])){
                setcookie("username", $username, time() + 20, "/");
                setcookie("password", $hashedPassword, time() + 20, "/");
            }
            session_start();
            $_SESSION["userid"] = $user[0]["id"];
            $_SESSION["username"] = $user[0]["email"];
            $_SESSION["firstname"] = $user[0]["firstname"];
            $_SESSION["middlename"] = $user[0]["middlename"];
            $_SESSION["lastname"] = $user[0]["lastname"];

            $query = null;
        }
        $query = null;
    }

    protected function setUser($username, $pwd, $email, $firstname, $middlename, $lastname, $role, $student_level) {

        // Table users
        // $query = $this->connect()->prepare("INSERT INTO Users(username, user_password, email, first_name, middle_name, last_name) VALUES(?, ?, ?, ?, ?, ?);");

        $query = $this->connect()->prepare("CALL insert_user(?, ?, ?, ?, ?, ?, ?, ?)");

        $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
        
        $query->bind_param("ssssssss", $username, $hashedPwd, $email, $firstname, $middlename, $lastname, $role, $student_level);

        if(!$query->execute()) {
            $query = null;
            header("location: ../index.php?page=signup&error=queryfailed");
            exit();
        }
        $query = null;
    }
    
    protected function checkUser($email) {
        $query = $this->connect()->prepare("SELECT email FROM Users WHERE email=?;");
        $query->bind_param("s", $email);

        if(!$query->execute()) {
            $query = null;
            header("location: ../index.php?page=signup&error=queryfailed");
            exit();
        }

        $result = $query->get_result();
        $query->close();

        $resultCheck = true;
        if($result->num_rows > 0) {
            $resultCheck = false;
        }
        else {
            $resultCheck = true;
        }

        return $resultCheck;
    }
}