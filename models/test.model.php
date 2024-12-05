<?php

class Test extends Dbh {

    // Create a new test
    protected function createTest($title, $description, $topic, $level, $testTime, $numOfQuest, $staffId) {
        $query = $this->connect()->prepare(
            "INSERT INTO Test (title, description, topic, level, test_time, num_of_quest, staff_id) VALUES (?, ?, ?, ?, ?, ?, ?)"
        );

        $query->bind_param("ssssiii", $title, $description, $topic, $level, $testTime, $numOfQuest, $staffId);

        if (!$query->execute()) {
            $query->close();
            header("location: ../index.php?page=create-test&error=queryfailed");
            exit();
        }

        $query->close();
    }

    // Delete a test by ID
    protected function deleteTest($testId) {
        $query = $this->connect()->prepare("DELETE FROM Test WHERE id = ?");
        $query->bind_param("i", $testId);

        if (!$query->execute()) {
            $query->close();
            header("location: ../index.php?page=manage-tests&error=queryfailed");
            exit();
        }

        $query->close();
    }

    // Get all tests
    protected function getAllTests() {
        $query = $this->connect()->prepare("SELECT * FROM Test");

        if (!$query->execute()) {
            $query->close();
            header("location: ../index.php?page=tests&error=queryfailed");
            exit();
        }

        $result = $query->get_result();
        $query->close();

        $tests = [];
        while ($row = $result->fetch_assoc()) {
            $tests[] = $row;
        }

        return $tests;
    }

    // Get tests by filter level
    protected function getTestByLevel($level) {
        $query = $this->connect()->prepare("SELECT * FROM Test WHERE level = ?");
        $query->bind_param("s", $level);

        if (!$query->execute()) {
            $query->close();
            header("location: ../index.php?page=tests&error=queryfailed");
            exit();
        }

        $result = $query->get_result();
        $query->close();

        $tests = [];
        while ($row = $result->fetch_assoc()) {
            $tests[] = $row;
        }

        return $tests;
    }

    // Get test by ID
    protected function getTestById($testId) {
        $query = $this->connect()->prepare("SELECT * FROM Test WHERE id = ?");
        $query->bind_param("i", $testId);

        if (!$query->execute()) {
            $query->close();
            header("location: ../index.php?page=tests&error=queryfailed");
            exit();
        }

        $result = $query->get_result();
        $query->close();

        return $result->fetch_assoc(); // Return a single test as an associative array
    }

    // Update test by ID
    protected function updateTest($testId, $title, $description, $topic, $level, $testTime, $numOfQuest, $staffId) {
        $query = $this->connect()->prepare(
            "UPDATE Test SET title = ?, description = ?, topic = ?, level = ?, test_time = ?, num_of_quest = ?, staff_id = ? WHERE id = ?"
        );

        $query->bind_param("ssssiiii", $title, $description, $topic, $level, $testTime, $numOfQuest, $staffId, $testId);

        if (!$query->execute()) {
            $query->close();
            header("location: ../index.php?page=manage-tests&error=queryfailed");
            exit();
        }

        $query->close();
    }
}
