<header>
     <div class="container">
         
         
             <div class="banner">
                <h1><strong>Graet Help</strong></h1>
            </div>
        <nav class="navbar" role="navigation">
            <div>
               <ul class="nav nav-tabs" role="tablist">
               
                    <li class="nav-item" role="presentation">
                        <?php
                        if (isset($_COOKIE['sessionID'])){
                        //echo '<a href="dashboard.php?uid='. $_POST['uid'] .'&sub=Return+to+Dashboard" class="nav-link">Dashboard</a>';
                            echo '<a href="dashboard.php" class="nav-link">Dashboard</a>';
                        }
                            ?>
                   </li>
                    <li class="nav-item" role="presentation"><a href="about.php" class="nav-link">About</a></li>
                    <li class="nav-item" role="presentation"><a href="#" class="nav-link">Contact Us</a></li>
                   <?php
                        if (isset($_COOKIE['sessionID'])){
                            echo '<li class="nav-item" role="presentation"><a href="logout.php" class="nav-link">Log Out</a></li>';
                        }
                        else{
                            echo '<li class="nav-item" role="presentation"><a href="login.php" class="nav-link">Log In</a></li>';
                        }
                   ?>
                </ul>
            </div>
         </nav>
          <div style="border-bottom:1px solid #ccc;"></div>
      </div>
    <link href="../Resources/bootstrap-3.3.7/dist/css/bootstrap.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="../Resources/auxStyling.css">
</header>