<?php

include 'connection.php';
session_start();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    

 
</head>

<body>

<div class="container">

<nav class="nav">

    <ul class="nav-list">
    
    <?php if (!isset($_SESSION['username'])) : ?>
        <li class="logo"><img  src="logo.png" alt="website logo" style="height: 70px; width: 70px;margin-right:860px; "></img></li>
    <?php endif ?>

    <?php  if (isset($_SESSION['username'])) : ?>
        <li><img class="logo" src="logo.png" alt="website logo" style="height: 70px; width: 70px;"></img></li>
                   <li  id="welcome">Welcome
                             <strong>
                                 <?php echo $_SESSION["name"];?>
                             </strong>
                    </li>     
    <?php endif ?>

        <li><a class='main-item' id="home" href="#">Home</a></li>
        <!-- <li ><a class='main-item' id='cityselected' href="#">Select City</a>
        <ul class="dropdown-menu">
            
        <?php $s = "SELECT cname FROM cities";
if($result = mysqli_query($link, $s)){
    if(mysqli_num_rows($result) > 0){
        
        while($row = mysqli_fetch_array($result)){
            echo "<li class='cityname'><a href='#'>" . $row['cname'] ."</a></li>";
        }
    }
}            ?>
    
            </ul>
        </li> -->
        
        <li><a class='main-item' href="#">Contact</a></li>

        <?php if (!isset($_SESSION['username'])) : ?>
        <li><a  class='main-item'href="signin.php">Login</a></li>
        <li><a class='main-item' href="signup.php">Sign Up</a></li>
        <?php endif ?>
        <?php  if (isset($_SESSION['username'])) : ?>
            <li id='onlylogout'>             

                             <a  class='main-item' href="logout.php">
                                 Logout
                             </a>
            </li>         
        <?php endif ?>
    </ul>
</nav>
</div>

<div class="slideshow">
    <a href="https://www.youtube.com/" target="_blank"><img class="mySlides" src="assets/army-of-the-dead.jpeg" style="width:100%"></a>
    <a href="https://www.google.com/" target="_blank"></a><img class="mySlides" src="assets/ghani.jpg" style="width:100%"></a>
    <a href="https://in.bookmyshow.com/explore/home/chennai" target="_blank"><img class="mySlides" src="assets/quiet-place-2.jpg" style="width:100%"></a>
  </div>

<div class="showbox">
<div class="cards-container">
<p class="headings"> Now Showing</p>

 <?php
$sql = "SELECT mid, mname, mimg FROM movies";
if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
        
        while($row = mysqli_fetch_array($result)){

            echo "<div class='card' >";
            if (isset($_SESSION['username'])){ echo "<a href='movie-page.php?mid=".$row['mid'] ."'>";}
            else {echo "<a href='#'></a>"; }
        echo "<img src='".$row['mimg'] ."'>
        <div class='card-title'>"
           .$row['mname'] ."
        </div>
            </a>
        </div>";

        
      }
    }
}
?>
</div>
</div>

<footer class="footer-clean">
<div class="footer-container">
                <div class="row-justify-content-center">
                    <div class="col-sm-4 col-md-3 item">
                        <h3>Services</h3>
                        <ul>
                            <li><a href="#">Web design</a></li>
                            <li><a href="#">Development</a></li>
                            <li><a href="#">Hosting</a></li>
                        </ul>
                    </div>
                    <div class="col-sm-4 col-md-3 item">
                        <h3>About</h3>
                        <ul>
                            <li><a href="#">Company</a></li>
                            <li><a href="#">Team</a></li>
                            <li><a href="#">Legacy</a></li>
                        </ul>
                    </div>
                    <div class="col-sm-4 col-md-3 item">
                        <h3>Careers</h3>
                        <ul>
                            <li><a href="#">Job openings</a></li>
                            <li><a href="#">Employee success</a></li>
                            <li><a href="#">Benefits</a></li>
                        </ul>
                    </div>
                </div>
            </div>
</footer>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script  src="scripts.js"></script>
</body>

</html>

<?php

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    echo 
    exit;
}

?>
