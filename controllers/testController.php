<?php

class TestController extends Test {
    private $staffId;
    private $title;
    private $description;
    private $topic;
    private $level;
    private $testTime;
    private $numOfQuest;

    public function __construct($staffId, $title, $description, $topic, $level, $testTime, $numOfQuest) {
        $this->staffId = $staffId;
        $this->title = $title;
        $this->description = $description;
        $this->topic = $topic;
        $this->level = $level;
        $this->testTime = $testTime;
        $this->numOfQuest = $numOfQuest;
    }

    // Create a new test
    public function createTests() {
        // Validate the input data
        if (empty($this->title) || empty($this->level) || empty($this->testTime) || empty($this->numOfQuest)) {
            header("location: ../index.php?page=create-test&error=emptyfields");
            exit();
        }

        // Ensure the level is valid
        $validLevels = ['Beginner', 'Intermediate', 'Experienced', 'Advanced', 'Expert'];
        if (!in_array($this->level, $validLevels)) {
            header("location: ../index.php?page=create-test&error=invalidlevel");
            exit();
        }

        // Call the model's createTest method
        $this->createTest(
            $this->title,
            $this->description,
            $this->topic,
            $this->level,
            $this->testTime,
            $this->numOfQuest,
            $this->staffId
        );

        header("location: ../index.php?page=manage-tests&success=testcreated");
        exit();
    }

    // Static method to delete a test by ID
    public static function deleteTestById($testId) {
        $testModel = new Test();
        if (empty($testId)) {
            header("location: ../index.php?page=manage-tests&error=emptyid");
            exit();
        }

        $testModel->deleteTest($testId);

        header("location: ../index.php?page=manage-tests&success=testdeleted");
        exit();
    }
}
