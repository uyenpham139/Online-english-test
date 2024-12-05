

<header class="header">

   <div class="header-1">
      <div class="flex">
         <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
         </div>
         <p> new <a href="index.php?page=login">login</a> | <a href="index.php?page=register">register</a> </p>
      </div>
   </div>

   <div class="header-2">
      <div class="flex">
         <div>
            <a href="index.php?page=home" class="logo"><img src="FE/images/logo.jpg" alt=""><span>English Test</span></a>
         </div>
         
         <nav class="navbar">
            <a href="index.php?page=home">home</a>
            <a href="index.php?page=about">about</a>
            <a href="index.php?page=contact">contact</a>
         </nav>

         <div class="icons">
            <div id="menu-btn" class="fas fa-bars"></div>
            <a href="search_page.php" class="fas fa-search"></a>
            <div id="user-btn" class="fas fa-user"></div>
         </div>

         <div class="user-box.active">
            <?php if (isset($_SESSION['user_name']) && isset($_SESSION['user_email'])): ?>
               <p>username : <span><?php echo htmlspecialchars($_SESSION['user_name']); ?></span></p>
               <p>email : <span><?php echo htmlspecialchars($_SESSION['user_email']); ?></span></p>
               <a href="FE/logout.php" class="delete-btn">logout</a>
            <?php else: ?>
               <p>Please <a href="/index.php?page=login">login</a> to see your details.</p>
            <?php endif; ?>
         </div>
      </div>
   </div>

</header>

