<?php

class Answer extends Dbh {

    // Create a new answer
    protected function createAnswer($content, $questionId, $testId, $correct) {
        $query = $this->connect()->prepare("INSERT INTO Answer (content, question_id, test_id, correct) VALUES (?, ?, ?, ?)");

        $query->bind_param("siib", $content, $questionId, $testId, $correct);

        if (!$query->execute()) {
            $query->close();
            header("location: ../index.php?page=create-answer&error=queryfailed");
            exit();
        }

        $query->close();
    }

    // Delete an answer by ID
    protected function deleteAnswer($answerId) {
        $query = $this->connect()->prepare("DELETE FROM Answer WHERE id = ?");
        $query->bind_param("i", $answerId);

        if (!$query->execute()) {
            $query->close();
            header("location: ../index.php?page=manage-answers&error=queryfailed");
            exit();
        }

        $query->close();
    }

    // Get all answers by question ID
    protected function getAnswersByQuestionId($questionId) {
        $query = $this->connect()->prepare("SELECT * FROM Answer WHERE question_id = ?");
        $query->bind_param("i", $questionId);

        if (!$query->execute()) {
            $query->close();
            header("location: ../index.php?page=answers&error=queryfailed");
            exit();
        }

        $result = $query->get_result();
        $query->close();

        $answers = [];
        while ($row = $result->fetch_assoc()) {
            $answers[] = $row;
        }

        return $answers;
    }

    // Get all correct answers by test ID
    protected function getCorrectAnswersByTestId($testId) {
        $query = $this->connect()->prepare("SELECT * FROM Answer WHERE test_id = ? AND correct = 1");
        $query->bind_param("i", $testId);

        if (!$query->execute()) {
            $query->close();
            header("location: ../index.php?page=answers&error=queryfailed");
            exit();
        }

        $result = $query->get_result();
        $query->close();

        $correctAnswers = [];
        while ($row = $result->fetch_assoc()) {
            $correctAnswers[] = $row;
        }

        return $correctAnswers;
    }
}
