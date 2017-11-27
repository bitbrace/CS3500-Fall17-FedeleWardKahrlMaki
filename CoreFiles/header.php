<header>
     <div class="container">
         <nav class="navbar navbar-inverse " role="navigation">
             <div class="navbar-header">
                <h1 class="navbar-text"><strong>Graet Help</strong></h1>
            </div>
           
            <div>
               <ul class="nav nav-tabs pull-right" role="tablist">
               
                    <li class="nav-item" role="presentation"><a href="Dashboard.php" class="nav-link">Dashboard</a></li>
                    <li class="nav-item" role="presentation"><a href="#" class="nav-link">About</a></li>
                    <li class="nav-item" role="presentation"><a href="#" class="nav-link">Contact Us</a></li>
                   <?php
                        if (isset($_POST['uid'])){
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