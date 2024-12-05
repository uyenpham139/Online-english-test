<?php

class SubmissionController extends Submission {
    private $studentId;
    private $testId;
    private $questionId;
    private $studentAns;
    private $score;

    // Constructor to initialize properties for creating a submission
    public function __construct($studentId, $testId, $questionId, $studentAns, $score) {
        $this->studentId = $studentId;
        $this->testId = $testId;
        $this->questionId = $questionId;
        $this->studentAns = $studentAns;
        $this->score = $score;
    }

    // Create a new submission
    public function createSubmissionEntry() {
        // Validate inputs
        if (empty($this->studentId) || empty($this->testId) || empty($this->questionId) || $this->studentAns === null || $this->score === null) {
            header("location: ../index.php?page=create-submission&error=emptyfields");
            exit();
        }

        // Call the model's method to create the submission
        $this->createSubmission(
            $this->studentId,
            $this->testId,
            $this->questionId,
            $this->studentAns,
            $this->score
        );
    }

    // Delete a submission by its ID
    public static function deleteSubmissionEntry($submissionId) {
        // Validate the submission ID
        if (empty($submissionId)) {
            header("location: ../index.php?page=manage-submissions&error=emptyid");
            exit();
        }

        $submissionModel = new Submission();
        $submissionModel->deleteSubmission($submissionId);
    }

    // Get all submissions for a specific student by their ID
    public static function getSubmissionsForStudent($studentId) {
        // Validate the student ID
        if (empty($studentId)) {
            header("location: ../index.php?page=submissions&error=emptyid");
            exit();
        }

        $submissionModel = new Submission();
        return $submissionModel->getSubmissionsByStudentId($studentId);
    }

    // Get all submissions for a specific test by its ID
    public static function getSubmissionsForTest($testId) {
        // Validate the test ID
        if (empty($testId)) {
            header("location: ../index.php?page=submissions&error=emptyid");
            exit();
        }

        $submissionModel = new Submission();
        return $submissionModel->getSubmissionsByTestId($testId);
    }
}
