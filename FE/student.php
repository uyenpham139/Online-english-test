<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Student Test</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

    <div class="timer-box">
        <div>Time Left:</div>
        <span id="timer">05:00</span>
    </div>

    <div class="container mt-5">
    <h1 class="text-center mb-4">Student Test</h1>
    <form id="testForm">
      <div id="questionsList">
        <!-- Dynamic questions will go here -->
      </div>
      <button type="submit" name="submit_test" class="btn btn-primary submit-btn">Submit Test</button>
    </form>
  </div>

  
<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/student_script.js"></script>

</body>
</html>