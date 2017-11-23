<header>
     <div class="container">
         <nav class="navbar navbar-inverse " role="navigation">
             <div class="navbar-header">
                <?php echo '<h1 class="navbar-text"><strong>Graet Help</strong></h1>'; ?>
            </div>
           

            <div>
               <ul class="nav">
                    <?php echo'<li class="nav-item"><a href="Dashboard.php" class="nav-link" >Dashboard</a></li>
                    <li class="nav-item"><a href="#" class="nav-link" >About</a></li>
                    <li class="nav-item"><a href="#" class="nav-link" >Contact Us</a></li>';
                   
                        if (isset($_POST['uid'])){
                            echo '<li class="nav-item"><a href="logout.php" class="nav-link">Log Out</a></li>';
                        }
                        else{
                            echo '<li class="nav-item"><a href="login.php" class="nav-link">Log In</a></li>';
                        }
                   ?>
                   
                </ul>
            </div>
         </nav>
          <div style='border-bottom:1px solid #ccc;'></div>
      </div>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
</header>