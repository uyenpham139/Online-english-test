<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Grabbing the data
    $username = $_POST['username'];
    $firstname = $_POST["fname"];
    $lastname = $_POST["lname"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $repeatPassword = $_POST["cpassword"];
    $role = $_POST['user_type']; 

    // Instantiate Signup class
    include "../models/dbh.model.php";
    include "../models/users.model.php";
    include "../controllers/registerController.php";
    $signup = new RegisterController($username, $firstname, $lastname, $email, $password, $repeatPassword, $role);

    // Running error handlers and user signup
    $signup->signupUser();

    // Going back to front page
    header("location: ../index.php?error=none");
}
?>