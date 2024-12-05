<?php
session_start(); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Instantiate Signup class
    include "../models/dbh.model.php";
    include "../models/test.model.php";
    include "../controllers/testController.php";

// Check if the form was submitted
    if (isset($_POST['submit_search'])) {
        $searchTerm = trim($_POST['search']); // Retrieve and sanitize the input

        // Check if the search term is empty
        if (empty($searchTerm)) {
            header("location: ../index.php?page=search&error=emptysearch");
            exit();
        }

        // Use the TestController to search for tests
        $results = TestController::searchTestByTitle($searchTerm);

        // Redirect to the search results page (or include the search results directly)
        session_start();
        $_SESSION['search_results'] = $results; // Store results in session to use them on another page
        header("location: ../index.php?page=search&success=search-success");
        exit();
    }

    if (isset($_POST['submit_test'])) {
        
    }
}
?>