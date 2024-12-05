<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>English Test Creation</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="FE/css/style.css">
</head>
<body>
<?php include 'header.php'; ?>
  <div class="container mt-5">
    <div class="row g-4">
      <!-- Exam Information Section -->
      <div class="col-lg-6">
        <div class="exam-info">
          <h4 class="mb-4">Exam Information</h4>
          <form id="examInfoForm" action="include/test.inc.php" method="post">
            
            <div class="mb-3">
              <label for="examTitle" class="form-label">Exam Title</label>
              <input type="text" name="title" id="examTitle" class="form-control" placeholder="Enter exam title" required>
            </div>
            <div class="mb-3">
              <label for="level" class="form-label">Level</label>
              <select id="level" name="level" class="form-control" required>
                <option value="">Select a level</option>
                <option value="Beginner">Beginner</option>
                <option value="Intermediate">Intermediate</option>
                <option value="Experienced">Experienced</option>
                <option value="Advanced">Advanced</option>
                <option value="Expert">Expert</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="Topic" class="form-label">Topic</label>
              <textarea id="Topic" name="topic" class="form-control" rows="1" placeholder="Enter exam topic" required></textarea>
            </div>
            <div class="mb-3">
              <label for="timeLimit" class="form-label">Exam Time Limit</label>
              <select id="timeLimit" name="time-limit" class="form-control" required>
                <option value="30">30 Minutes</option>
                <option value="60">60 Minutes</option>
                <option value="90">90 Minutes</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="displayLimit" class="form-label">Number of questions</label>
              <input type="number" name="question-no" id="displayLimit" class="form-control" placeholder="Number of questions to display" required>
            </div>
            <button type="submit" name="submit_exam_info" class="btn btn-primary">Update</button>
          </form>
          <?php if (isset($_SESSION['numOfQuest'])): ?>
              <!-- Display message for max number of questions -->
              <p class="text">Maximum number of questions: <span> <?php echo $_SESSION['numOfQuest']; ?></span></p>
              <p class="text">The number of questions created: <span> 
                <?php 
                    if (isset($_SESSION['question_created'])) {
                        echo $_SESSION['question_created']; 
                    } else {
                        echo "0"; 
                    }
                ?>
              </span></p>
              
              <!-- Check if the number of created questions equals the max questions -->
              <?php if (isset($_SESSION['question_created']) && $_SESSION['question_created'] == $_SESSION['numOfQuest']): ?>
                  <p class="text-success">Test successfully created! Please create a new test.</p>
              <?php endif; ?>
          <?php endif; ?>

        </div>
      </div>

      <!-- Exam Questions Section -->
      <div class="col-lg-6">
        <div class="exam-questions">
          <h4 class="mb-4">
            Exam Questions
            <button class="btn btn-primary btn-add-question" id="addQuestionBtn">Add Question</button>
          </h4>

          <?php if (!isset($_SESSION['testId']) || !isset($_SESSION['numOfQuest'])): ?>
              <!-- Display message if test is not created yet -->
              <p class="text-danger">Please create a new test before adding questions.</p>
          <?php endif; ?>
          
          <div id="questionsList">
            <!-- Placeholder for questions -->
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php include 'footer.php'; ?>
  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="FE/js/script_staff.js"></script>
</body>

</html>
