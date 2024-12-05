<?php

class QuestionController extends Question {

    private $content;
    private $weight;
    private $pictures;
    private $testId;

    // Constructor to initialize properties
    public function __construct($content, $weight, $pictures, $testId) {
        $this->content = $content;
        $this->weight = $weight;
        $this->pictures = $pictures;
        $this->testId = $testId;
    }

    // Create a new question
    public function createQuestions() {
        // Validate input data
        if (empty($this->content) || empty($this->weight) || empty($this->testId)) {
            header("location: ../index.php?/manage&error=emptyfieldsinquestions");
            exit();
        }

        // Call the model's createQuestion method
        $questionId = $this->createQuestion(
            $this->content,
            $this->weight,
            $this->pictures,
            $this->testId
        );

        return $questionId;
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

    public static function getQuestionsCount($testId) {
        $questionModel = new Question();
        return $questionModel->getQuestionsCountByTestId($testId);
    }
}
?>
