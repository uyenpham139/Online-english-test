<?php

class Test extends Dbh {

    // Create a new test
    protected function createTest($title, $topic, $level, $testTime, $numOfQuest, $staffId) {
        $query = $this->connect()->prepare(
            "INSERT INTO Test (title, topic, level, test_time, num_of_quest, staff_id) VALUES (?, ?, ?, ?, ?, ?)"
        );

        $query->bind_param("ssssii", $title, $topic, $level, $testTime, $numOfQuest, $staffId);

        if (!$query->execute()) {
            $error = $query->error;
            $query->close();
            header("location: ../index.php?/manage&error=queryfailed&message=" . urlencode($error));
            exit();
        }

        // Get the last inserted testId
        $testId = $query->insert_id;

        $query->close();

        // Return the testId and numOfQuest
        return ['testId' => $testId, 'numOfQuest' => $numOfQuest];
    }

    // Delete a test by ID
    protected function deleteTest($testId) {
        $query = $this->connect()->prepare("DELETE FROM Test WHERE id = ?");
        $query->bind_param("i", $testId);

        if (!$query->execute()) {
            $error = $query->error;
            $query->close();
            header("location: ../index.php?/manage&error=queryfailed&message=" . urlencode($error));
            exit();
        }

        $query->close();
    }

    // Get all tests
    protected function getAllTests() {
        $query = $this->connect()->prepare("SELECT * FROM Test");

        if (!$query->execute()) {
            $error = $query->error;
            $query->close();
            header("location: ../index.php?page=search&error=queryfailed&message=" . urlencode($error));
            exit();
        }

        $result = $query->get_result();
        $query->close();

        return $result->fetch_all(MYSQLI_ASSOC); // Fetch all tests as an array of associative arrays
    }

    // Get tests by level
    protected function getTestByLevel($level) {
        $query = $this->connect()->prepare("SELECT * FROM Test WHERE level = ?");
        $query->bind_param("s", $level);

        if (!$query->execute()) {
            $error = $query->error;
            $query->close();
            header("location: ../index.php?/manage&error=queryfailed&message=" . urlencode($error));
            exit();
        }

        $result = $query->get_result();
        $query->close();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Get a single test by ID
    protected function getTestById($testId) {
        $query = $this->connect()->prepare("SELECT * FROM Test WHERE id = ?");
        $query->bind_param("i", $testId);

        if (!$query->execute()) {
            $error = $query->error;
            $query->close();
            header("location: ../index.php?page=....&error=queryfailed&message=" . urlencode($error));
            exit();
        }

        $result = $query->get_result();
        $query->close();

        return $result->fetch_assoc(); // Fetch as a single associative array
    }

    // Update a test by ID
    protected function updateTest($testId, $title, $topic, $level, $testTime, $numOfQuest, $staffId) {
        $query = $this->connect()->prepare(
            "UPDATE Test SET title = ?, topic = ?, level = ?, test_time = ?, num_of_quest = ?, staff_id = ? WHERE id = ?"
        );

        $query->bind_param("sssiiii", $title, $topic, $level, $testTime, $numOfQuest, $staffId, $testId);

        if (!$query->execute()) {
            $error = $query->error;
            $query->close();
            header("location: ../index.php?/manage&error=queryfailed&message=" . urlencode($error));
            exit();
        }

        $query->close();
    }

    // Validate test level
    protected function isValidLevel($level) {
        $validLevels = ['Beginner', 'Intermediate', 'Experienced', 'Advanced', 'Expert'];
        return in_array($level, $validLevels, true);
    }

    // Get tests by title containing a specific string
    protected function getTestByTitleSearch($title) {
        $query = $this->connect()->prepare("SELECT * FROM Test WHERE title LIKE ?");
        $searchTerm = '%' . $title . '%';
        $query->bind_param("s", $searchTerm);

        if (!$query->execute()) {
            $error = $query->error;
            $query->close();
            header("location: ../index.php?page=search&error=queryfailed&message=" . urlencode($error));
            exit();
        }

        $result = $query->get_result();
        $query->close();

        return $result->fetch_all(MYSQLI_ASSOC); // Return all matching tests as an associative array
    }
}
