<?php

class AnswerController extends Answer {

    private $content;
    private $questionId;
    private $testId;
    private $correct;

    // Constructor to initialize properties
    public function __construct($content, $questionId, $testId, $correct) {
        $this->content = $content;
        $this->questionId = $questionId;
        $this->testId = $testId;
        $this->correct = $correct;
    }

    // Create a new answer
    public function createAnswers() {
        // Validate input data
        if (empty($this->content) || empty($this->questionId) || empty($this->testId)) {
            header("location: ../index.php?page=create-answer&error=emptyfields");
            exit();
        }

        // Call the model's createAnswer method
        $this->createAnswer(
            $this->content,
            $this->questionId,
            $this->testId,
            $this->correct
        );

        header("location: ../index.php?/manage&success=answercreated");
        exit();
    }

    // Static method to delete an answer by ID
    public static function deleteAnswerById($answerId) {
        if (empty($answerId)) {
            header("location: ../index.php?/manage&error=emptyid");
            exit();
        }

        $answerModel = new Answer();
        $answerModel->deleteAnswer($answerId);

        header("location: ../index.php?/manage&success=answerdeleted");
        exit();
    }

    // Static method to get all answers by question ID
    public static function getAnswers($questionId) {
        if (empty($questionId)) {
            header("location: ../index.php?page=answers&error=emptyid");
            exit();
        }

        $answerModel = new Answer();
        $answers = $answerModel->getAnswersByQuestionId($questionId);

        return $answers; // Return answers array to the caller
    }

    // Static method to get all correct answers by test ID
    public static function getCorrectAnswers($testId) {
        if (empty($testId)) {
            header("location: ../index.php?page=answers&error=emptyid");
            exit();
        }

        $answerModel = new Answer();
        $correctAnswers = $answerModel->getCorrectAnswersByTestId($testId);

        return $correctAnswers; // Return correct answers array to the caller
    }
}
?>
