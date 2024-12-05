<?php

class Question extends Dbh {

    // Create a new question
    protected function createQuestion($content, $weight, $pictures, $testId) {
        // Ensure weight is a float
        $weight = (float)$weight;

        $query = $this->connect()->prepare("INSERT INTO Question (content, weight, pictures, test_id) VALUES (?, ?, ?, ?)");

        // Adjusting parameter binding type for weight (float)
        $query->bind_param("sdss", $content, $weight, $pictures, $testId);

        if (!$query->execute()) {
            $query->close();
            header("location: ../index.php?/manage&error=queryfailed");
            exit();
        }
        // Get the last inserted testId
        $questionId = $query->insert_id;

        $query->close();

        // Return the testId and numOfQuest
        return $questionId;
    }

    // Delete a question by ID
    protected function deleteQuestion($questionId) {
        $query = $this->connect()->prepare("DELETE FROM Question WHERE id = ?");
        $query->bind_param("i", $questionId);

        if (!$query->execute()) {
            $query->close();
            header("location: ../index.php?/manage&error=queryfailed");
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
            header("location: ../index.php?/manage&error=queryfailed");
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

    // Get the count of questions by test ID
    public function getQuestionsCountByTestId($testId) {
        $query = $this->connect()->prepare("SELECT COUNT(*) AS question_count FROM Question WHERE test_id = ?");
        $query->bind_param("i", $testId);

        if (!$query->execute()) {
            $query->close();
            header("location: ../index.php?/manage&error=queryfailed");
            exit();
        }

        $result = $query->get_result();
        $query->close();

        // Fetch the count from the result
        $row = $result->fetch_assoc();
        return $row['question_count']; // Return the count of questions
    }
}

