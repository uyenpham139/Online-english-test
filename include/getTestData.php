<?php
// Include required files
include "../models/dbh.model.php";
include "../models/test.model.php";
include "../models/question.model.php";
include "../controllers/questionController.php";

// Get the testId from the request (via GET or POST)
$testId = $_GET['testId'] ?? null;

if (!$testId) {
    echo json_encode(['error' => 'No test ID provided']);
    exit();
}

try {
    // Fetch test details and questions from TestController
    $testController = new TestController(null, null, null, null, null, null);
    $testDetails = TestController::getTestByTestId($testId);
    $questions = QuestionController::getQuestions($testId);

    // Combine test details and questions
    $response = [
        'timeLeft' => $testDetails['test_time'], // Assuming it's stored in seconds
        'questions' => $questions,
    ];

    echo json_encode($response);
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
