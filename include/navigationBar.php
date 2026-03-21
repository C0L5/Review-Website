 <!---For the navigation bar-->
 <nav class="navbar navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
     <div class="container-fluid my-2">
         <a class="navbar-brand" href="index.php"><img src="images/reviewLogoNav.png" alt="LOGO" class="img-fluid px-3" style="height:70px; width:auto;"></a>
         <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
             <span class="navbar-toggler-icon"></span>
         </button>
         <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
             <div class="navbar-nav" style="font-size: 1.2rem;">
                 <a class="nav-link" href="index.php">Home</a>
                 <a class="nav-link" href="reviews.php">Reviews</a>
                 <a class="nav-link" href="recommendations.php">Recommendations</a>
             </div>
             <form class="d-flex px-lg-4 flex-grow-1" role="search">
                 <input class="form-control" type="search" placeholder="Search" name="searchbar" aria-label="Search" />
             </form>
             <div class="d-flex pt-2 pt-lg-0 gap-2">
                 <a href="signup.php" class="btn btn-outline-light">Sign up</a>
                 <a href="login.php" class="btn btn-light">Login</a>
             </div>
         </div>
     </div>
 </nav>