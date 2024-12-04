<?php
if(isset($_POST['submit'])) {

    // Grabbing the data
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Instantiate Login class
    include "../models/dbh.model.php";
    include "../models/users.model.php";
    include "../controllers/loginController.php";
    $login = new LoginController($email, $password);

    // Running error handlers and user login
    $errors = [];
    
    if($login->emptyInput() == false) {
        $errors["empty_input"] = "Fill in all the fields!";
    }
    
    if($login->invalidEmail() == false) {
        $errors["invalid_username"] = "Invalid username";
    }
    
    if($login->validatePassword() == false) {
        $errors["invalid_password"] = "Invalid password";
    }
    
    if ($errors) {
        $_SESSION["errors_login"] = $errors;
        $error_message = implode(",", $errors); // Combine errors into a comma-separated string
        header("Location: ../index.php?page=login&error=$error_message");
        die();
    }

    $login->loginUser();

    // Going back to front page
    header("location: ../index.php?page=home");
}

?>