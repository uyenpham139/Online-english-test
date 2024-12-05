

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>search page</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="FE/css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>search page</h3>
   <p> <a href="index.php?page=home">home</a> / search </p>
</div>

<section class="search-form">
   <form action="include/student.inc.php" method="post">
      <input type="text" name="search" placeholder="search tests..." class="box">
      <input type="submit" name="submit_search" value="search" class="btn">
   </form>
</section>


<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="FE/js/script.js"></script>

</body>
</html>