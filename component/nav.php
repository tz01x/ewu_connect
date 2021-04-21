
 <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="http://localhost/ewu_connect/">EWU Connect</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="http://localhost/ewu_connect/login.php">Login Page</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="http://localhost/ewu_connect/signup.php">Sign Up Page</a>
        </li>
        
        <?php
         
            
            if(isset($_SESSION['uid'])){
              echo'<li class="nav-item">
              <a class="nav-link active" aria-current="page" href="http://localhost/ewu_connect/profile.php">Profile Page</a>
          
            </li>';
            }


        ?>

<li class="nav-item">
<?php
         
         //session_start();
             if(isset($_SESSION['uid'])){
               echo'<li class="nav-item">
               <a class="nav-link active" aria-current="page" href="http://localhost/ewu_connect/logout.php">Logout</a>
           
             </li>';
             }
 
 
         ?>
          
        </li>
        
      </ul>
    </div>
  </div>
</nav>