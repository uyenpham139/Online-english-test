<?php

class Test extends Dbh {

    // Create a new test
    protected function createTest($name, $topic, $level, $startTime, $endTime, $staffId) {
        $query = $this->connect()->prepare("INSERT INTO Test (name, topic, level, start_time, end_time, staff_id) VALUES (?, ?, ?, ?, ?, ?)");

        $query->bind_param("sssssi", $name, $topic, $level, $startTime, $endTime, $staffId);

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
}
