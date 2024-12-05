<?php

class User extends Dbh {

    protected function getUser($email, $pwd) {

        $query = $this->connect()->prepare("SELECT user_password FROM Users WHERE email=?;");

        $query->bind_param("s", $email);

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
                setcookie("email", $email, time() + 20, "/");
                setcookie("password", $hashedPassword, time() + 20, "/");
            }
            
            session_start();
            $_SESSION["user_id"] = $user[0]["id"];
            $_SESSION["user_name"] = $user[0]["user_name"];
            $_SESSION["firstname"] = $user[0]["firstname"];
            $_SESSION["lastname"] = $user[0]["lastname"];
            $_SESSION["user_email"] = $user[0]["email"];
            $_SESSION["user_role"] = $user[0]["role"];

            $query = null;
        }
        $query = null;
    }

    protected function setUser($username, $pwd, $email, $firstname, $lastname, $role) {

        $query = $this->connect()->prepare("CALL insert_user(?, ?, ?, ?, ?, ?, ?, ?)");

        $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
        
         // Define variables for the literals
        $defaultStatus = 0;
        $defaultLevel = "Beginner";

        // Bind variables instead of literals
        $query->bind_param("ssssssis", $username, $hashedPwd, $email, $firstname, $lastname, $role, $defaultStatus, $defaultLevel);

        if(!$query->execute()) {
            $query = null;
            header("location: ../index.php?page=register&error=queryfailed");
            exit();
        }
        $query = null;
    }
    
    protected function checkUser($email) {
        $query = $this->connect()->prepare("SELECT email FROM Users WHERE email=?;");
        $query->bind_param("s", $email);

        if(!$query->execute()) {
            $query = null;
            header("location: ../index.php?page=register&error=queryfailed");
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