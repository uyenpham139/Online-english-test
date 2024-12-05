<?php
session_start(); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Grabbing the data
    $title = $_POST["title"];
    $level = $_POST["level"];
    $topic = $_POST["topic"];
    $timeLimit = $_POST["time-limit"];
    $questionNumber = $_POST["question-no"];
    $staffId = $_SESSION["user_id"];

    // Extract the numerical part (e.g., 30, 60, 90)
    preg_match('/\d+/', $timeLimit, $matches);
    if (!empty($matches)) { 
        $timeLimit = (int)$matches[0]; // Extracted number as an integer
    } else {
        // Handle invalid input gracefully
        header("location: ../index.php?/manage&error=InvalidTime");
        exit();
    }

    // Convert minutes to HH:MM:SS
    $hours = floor($timeLimit / 60);
    $minutes = $timeLimit % 60;
    $seconds = 0;

    $testTime = sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);

    // Instantiate Signup class
    include "../models/dbh.model.php";
    include "../models/test.model.php";
    include "../controllers/testController.php";
    $controller = new TestController($staffId, $title, $topic, $level, $testTime, $questionNumber);

    // Create a new test
    $testId = $controller->createTests();

    

    // Going back to front page
    header("location: ../index.php?/manage");
}
?>