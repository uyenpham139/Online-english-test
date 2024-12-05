

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="FE/css/style.css">

</head>
<body>




   
<div class="form-container">

   <form action="include/register.inc.php" method="post">
   <h3>register now</h3>
      <input type="text" name="username" placeholder="enter your username" required class="box">
      <input type="email" name="email" placeholder="enter your email" required class="box">
      <input type="text" name="fname" placeholder="enter your first name" required class="box">
      <input type="text" name="lname" placeholder="enter your last name" required class="box">
      <input type="password" name="password" placeholder="enter your password" required class="box">
      <input type="password" name="cpassword" placeholder="confirm your password" required class="box">
      <select name="user_type" class="box">
         <option value="User">User</option>
         <option value="Staff">Staff</option>
         <option value="Admin">Admin</option>
      </select>
      <input type="submit" name="submit" value="register now" class="btn">
      <p>Already have an account? <a href="index.php?page=login">Login now</a></p>
   </form>

</div>

</body>
</html>
