<?php

class Submission extends Dbh {

    // Create a new submission
    protected function createSubmission($studentId, $testId, $questionId, $studentAns, $score) {
        $query = $this->connect()->prepare("INSERT INTO Submission (student_id, test_id, question_id, student_ans, score) VALUES (?, ?, ?, ?, ?)");

        $query->bind_param("iiisi", $studentId, $testId, $questionId, $studentAns, $score);

        if (!$query->execute()) {
            $query->close();
            header("location: ../index.php?page=create-submission&error=queryfailed");
            exit();
        }

        $query->close();
    }

    // Delete a submission by ID
    protected function deleteSubmission($submissionId) {
        $query = $this->connect()->prepare("DELETE FROM Submission WHERE id = ?");
        $query->bind_param("i", $submissionId);

        if (!$query->execute()) {
            $query->close();
            header("location: ../index.php?page=manage-submissions&error=queryfailed");
            exit();
        }

        $query->close();
    }

    // Get all submissions for a specific student by their ID
    protected function getSubmissionsByStudentId($studentId) {
        $query = $this->connect()->prepare("SELECT * FROM Submission WHERE student_id = ?");
        $query->bind_param("i", $studentId);

        if (!$query->execute()) {
            $query->close();
            header("location: ../index.php?page=submissions&error=queryfailed");
            exit();
        }

        $result = $query->get_result();
        $query->close();

        $submissions = [];
        while ($row = $result->fetch_assoc()) {
            $submissions[] = $row;
        }

        return $submissions;
    }

    // Get all submissions for a specific test by its ID
    protected function getSubmissionsByTestId($testId) {
        $query = $this->connect()->prepare("SELECT * FROM Submission WHERE test_id = ?");
        $query->bind_param("i", $testId);

        if (!$query->execute()) {
            $query->close();
            header("location: ../index.php?page=submissions&error=queryfailed");
            exit();
        }

        $result = $query->get_result();
        $query->close();

        $submissions = [];
        while ($row = $result->fetch_assoc()) {
            $submissions[] = $row;
        }

        return $submissions;
    }
}
