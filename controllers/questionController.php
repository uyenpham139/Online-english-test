<?php

class QuestionController extends Question {

    private $content;
    private $weight;
    private $type;
    private $pictures;
    private $testId;

    // Constructor to initialize properties
    public function __construct($content, $weight, $type, $pictures, $testId) {
        $this->content = $content;
        $this->weight = $weight;
        $this->type = $type;
        $this->pictures = $pictures;
        $this->testId = $testId;
    }

    // Create a new question
    public function createQuestions() {
        // Validate input data
        if (empty($this->content) || empty($this->weight) || empty($this->type) || empty($this->testId)) {
            header("location: ../index.php?/manage&error=emptyfields");
            exit();
        }

        // Call the model's createQuestion method
        $this->createQuestion(
            $this->content,
            $this->weight,
            $this->type,
            $this->pictures,
            $this->testId
        );
    }

    // Static method to delete a question by ID
    public static function deleteQuestionById($questionId) {
        if (empty($questionId)) {
            header("location: ../index.php?/manage&error=emptyid");
            exit();
        }

        $questionModel = new Question();
        $questionModel->deleteQuestion($questionId);
    }

    // Static method to get all questions by test ID
    public static function getQuestions($testId) {
        if (empty($testId)) {
            header("location: ../index.php?/manage&error=emptyid");
            exit();
        }

        $questionModel = new Question();
        $questions = $questionModel->getQuestionsByTestId($testId);

        return $questions; // Return questions array to the caller
    }
}
?>
