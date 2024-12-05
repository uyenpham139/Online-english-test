<?php
session_start(); 

function checkCorrectAnswer($answer, $correctAnswer) {
    if ((string)$answer === (string)$correctAnswer) {
        return true;
    }
    return false;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Instantiate Signup class
    include "../models/dbh.model.php";
    include "../models/test.model.php";
    include "../models/question.model.php";
    include "../models/answer.model.php";
    include "../controllers/testController.php";
    include "../controllers/questionController.php";
    include "../controllers/answerController.php";

    if (isset($_POST['submit_exam_info'])) {
        // Grabbing the test data 
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
    
        $controller = new TestController($staffId, $title, $topic, $level, $testTime, $questionNumber);
    
        // Create a new test and get the testId and numOfQuest
        $result = $controller->createTests();
    
        // Extract the testId and numOfQuest
        $testId = $result['testId'];
        $numOfQuest = $result['numOfQuest'];
    
        // Store testId in session
        $_SESSION['testId'] = $testId;
        $_SESSION['numOfQuest'] = $numOfQuest;

        header("location: ../index.php?/manage");
    }

    if (isset($_POST['submit_exam_questions'])) {
        // Access the testId from the session
        $testId = $_SESSION['testId'];
        $numOfQuest = $_SESSION['numOfQuest'];
    
        // Question
        $content = $_POST["question"];
        $weight = round((float)(10.00 / $numOfQuest), 2);
        $picture = $_POST['picture'];
    
        $questionController = new QuestionController($content, $weight, $picture, $testId);
        
        $currentQuestionsCount = $questionController->getQuestionsCount($testId);

        // If the required number of questions isn't reached, alert the user
        if ($currentQuestionsCount >= $numOfQuest) {
            // Test creation is complete, clear session
            unset($_SESSION['testId']);
            unset($_SESSION['numOfQuest']);
            unset($_SESSION['question_created']);
            // Redirect the user to create a new test
            header("location: ../index.php?/manage&success=full-questions");
            exit();
        }
    
        $questionId = $questionController->createQuestions();
    
        // echo $questionId;
        
        // Answers
        for ($i = 1; $i <= 4; $i++) {
            // Dynamically get the answer and correct answer for each index
            $answer = $_POST["answer_" . $i];
            $correctAnswer = $_POST["correct_answer"];
            $flag = checkCorrectAnswer($answer, $correctAnswer) ? 1 : 0;
            $answerController = new AnswerController($answer, $questionId, $testId, $flag);
            $answerController->createAnswers();
        }

        $_SESSION['question_created'] = $questionController->getQuestionsCount($testId);
    }

    // Going back to front page
    header("location: ../index.php?/manage");
}
?>