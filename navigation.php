
<section class="navigation">
  <header class="container">
    <div class="header-content">
      <div class="logo"><a href="index.php"><div class="logo-img"></div></a></div>
        <div class="header-nav pull-right">
          <nav>
            <ul class="primary-nav">
              <li><a href="index.php">Welcome</a></li>
              <li><a href="playlist.php">Discover</a></li>
               <?php
                if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                    echo '<li><a href="create_from_videos.php">Create Playlist</a></li>';
                    echo'<li><a href="profile.php?id='.$_SESSION['UserId'].'">Profile</a></li><li><a href="logout.php?logout=1">Logout</a></li>';
                  } else {
                    echo '<li><a href="signin.php">Sign In</a></li><li><a href="signup.php">Sign Up</a></li>';
                  }
               ?>
             
              <li><a href="#"><i class="fa fa-search"></i></a></li>
            </ul>
          </nav>
        </div>
        <div class="navicon">
          <a class="nav-toggle" href="#"><span></span></a>
        </div>
    </div>
  </header>
</section>