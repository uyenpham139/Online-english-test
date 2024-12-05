<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Ranking</title>

   <!-- Font Awesome CDN link -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- Custom CSS file link -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="ranking-section">
  <h2>Leaderboard</h2>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Rank</th>
        <th>Student Name</th>
        <th>Level</th>
        <th>Score</th>
      </tr>
    </thead>
    <tbody id="leaderboard">
      <!-- Leaderboard rows will be dynamically added here -->
    </tbody>
  </table>
</div>




<?php include 'footer.php'; ?>

<!-- Custom JS file link -->
<script src="js/ranking_script.js"></script>

</body>
</html>