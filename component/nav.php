<?php 
$host_name=$_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['SERVER_NAME']."/ewu_connect";
?>
 <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="<?=$host_name?>">EWU Connect</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?=$host_name?>/login.php">Login Page</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?=$host_name?>/signup.php">Sign Up Page</a>
        </li>
        
        <?php
         
            
            if(isset($_SESSION['uid'])){
              echo'<li class="nav-item">
              <a class="nav-link active" aria-current="page" href="'.$host_name.'/profile.php">Profile Page</a>
          
            </li>';
            }


        ?>

<li class="nav-item">
<?php
         
         //session_start();
             if(isset($_SESSION['uid'])){
               echo'<li class="nav-item">
               <a class="nav-link active" aria-current="page" href="'.$host_name.'/logout.php">Logout</a>
           
             </li>';
             }
 
 
         ?>
          
        </li>
        
      </ul>
    </div>
  </div>
</nav>