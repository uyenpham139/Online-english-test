<?php

class Question extends Dbh {

    // Create a new question
    protected function createQuestion($content, $weight, $type, $pictures, $testId) {
        $query = $this->connect()->prepare("INSERT INTO Question (content, weight, type, pictures, test_id) VALUES (?, ?, ?, ?, ?)");

        $query->bind_param("sisss", $content, $weight, $type, $pictures, $testId);

        if (!$query->execute()) {
            $query->close();
            header("location: ../index.php?page=create-question&error=queryfailed");
            exit();
        }

        $query->close();
    }

    // Delete a question by ID
    protected function deleteQuestion($questionId) {
        $query = $this->connect()->prepare("DELETE FROM Question WHERE id = ?");
        $query->bind_param("i", $questionId);

        if (!$query->execute()) {
            $query->close();
            header("location: ../index.php?page=manage-questions&error=queryfailed");
            exit();
        }

        $query->close();
    }

    // Get all questions by test ID
    protected function getQuestionsByTestId($testId) {
        $query = $this->connect()->prepare("SELECT * FROM Question WHERE test_id = ?");
        $query->bind_param("i", $testId);

        if (!$query->execute()) {
            $query->close();
            header("location: ../index.php?page=questions&error=queryfailed");
            exit();
        }

        $result = $query->get_result();
        $query->close();

        $questions = [];
        while ($row = $result->fetch_assoc()) {
            $questions[] = $row;
        }

        return $questions;
    }
}
