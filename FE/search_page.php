

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
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>search page</h3>
   <p> <a href="home.php">home</a> / search </p>
</div>



<section class="search-form">
   <form id="searchForm">
      <input
         type="text"
         id="searchInput"
         name="keyword"
         placeholder="Search items..."
         class="box"
      />
      <select id="levels">
         <option value="">All Levels</option>
         <option value="Beginner">Beginner</option>
         <option value="Expert">Expert</option>
      </select>
      <button type="submit" class="btn">Search</button>
   </form>
</section>

<section id="searchResults" class="results">
   <!-- Search results will be displayed here -->
</section>




<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>