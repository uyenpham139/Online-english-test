<?php

class TestController extends Test {
    private $staffId;
    private $title;
    private $topic;
    private $level;
    private $testTime;
    private $numOfQuest;

    public function __construct($staffId, $title, $topic, $level, $testTime, $numOfQuest) {
        $this->staffId = $staffId;
        $this->title = $title;
        $this->topic = $topic;
        $this->level = $level;
        $this->testTime = $testTime;
        $this->numOfQuest = $numOfQuest;
    }

    // Create a new test
    public function createTests() {
        // Validate the input data
        if (empty($this->title) || empty($this->level) || empty($this->testTime) || empty($this->numOfQuest) || empty($this->staffId)) {
            header("location: ../index.php?/manage&error=emptyfields");
            exit();
        }

        // Ensure the level is valid
        $validLevels = ['Beginner', 'Intermediate', 'Experienced', 'Advanced', 'Expert'];
        if (!in_array($this->level, $validLevels)) {
            header("location: ../index.php?/manage&error=invalidlevel");
            exit();
        }

        // Validate numOfQuest and testTime
        if (!is_numeric($this->numOfQuest) || $this->numOfQuest <= 0) {
            header("location: ../index.php?/manage&error=invalidnumofquest");
            exit();
        }

        if (!preg_match('/^\d{2}:\d{2}:\d{2}$/', $this->testTime)) {
            header("location: ../index.php?/manage&error=invalidtesttime");
            exit();
        }

        // Call the model's createTest method and capture the returned testId and numOfQuest
        $result = $this->createTest(
            $this->title,
            $this->topic,
            $this->level,
            $this->testTime,
            $this->numOfQuest,
            $this->staffId
        );

        // Retrieve testId and numOfQuest from the result
        $testId = $result['testId'];
        $numOfQuest = $result['numOfQuest'];

        // Return the testId and numOfQuest
        return ['testId' => $testId, 'numOfQuest' => $numOfQuest];
    }

    // Static method to delete a test by ID
    public static function deleteTestById($testId) {
        if (empty($testId)) {
            header("location: ../index.php?/manage&error=emptyid");
            exit();
        }

        $testModel = new Test();
        $testModel->deleteTest($testId);
    }

    // Static method to update a test by ID
    public static function updateTestById($testId, $title, $topic, $level, $testTime, $numOfQuest, $staffId) {
        if (empty($testId) || empty($title) || empty($level) || empty($testTime) || empty($numOfQuest) || empty($staffId)) {
            header("location: ../index.php?/manage&error=emptyfields");
            exit();
        }

        $validLevels = ['Beginner', 'Intermediate', 'Experienced', 'Advanced', 'Expert'];
        if (!in_array($level, $validLevels)) {
            header("location: ../index.php?/manage&error=invalidlevel");
            exit();
        }

        if (!is_numeric($numOfQuest) || $numOfQuest <= 0) {
            header("location: ../index.php?page=manage-tests&error=invalidnumofquest");
            exit();
        }

        if (!preg_match('/^\d{2}:\d{2}:\d{2}$/', $testTime)) {
            header("location: ../index.php?page=manage-tests&error=invalidtesttime");
            exit();
        }

        $testModel = new Test();
        $testModel->updateTest($testId, $title, $topic, $level, $testTime, $numOfQuest, $staffId);
    }

    // Search for tests by title (static method)
    public static function searchTestByTitle($title) {
        if (empty($title)) {
            header("location: ../index.php?page=search&error=emptysearchterm");
            exit();
        }

        $testModel = new Test();
        $results = $testModel->getTestByTitleSearch($title);

        return $results; // Return the list of matching tests
    }
}
