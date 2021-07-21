<?php
 include 'connection.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=
    , initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="movie.css">

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>
<body>

<script type="text/javascript">

var movieidEn;
var theat;
var mdate;
var mtime;

</script>
<!-- theatre, date, timings
from shows select cid of the particular movie and
JOIN with cities to theatre name

-select theatre 
-get sdate  (shows)
-select stimings -->




<div class="movie-container">
<form class="bookform">
<select name="theatre" class="theatre" onchange="showtheatre(this.value)">
<option value ="">Select Theatre:</option>
<?php
$movieid = $_GET['mid'];
$movieidEn= json_encode($movieid);
//  $sql = "SELECT * FROM  shows NATURAL JOIN cities WHERE shows.mid=$movieid;";

 $theat= "SELECT DISTINCT cities.cid ,cities.cname FROM shows NATURAL JOIN cities WHERE shows.mid=$movieid;";


if($result = mysqli_query($link, $theat)){
    if(mysqli_num_rows($result) > 0){

        while($row = mysqli_fetch_array($result)){
            echo "<option value='" .$row['cid'] ."'>" .$row['cname'] ."</option>";
          
          //   echo "<br>";
          //  echo "SID:" .$row['cid'];
          //  echo "<br>";
          //  echo "CID:" .$row['cname'];
          //  echo "<br>";

          //  echo $row['stimings'];  echo "<br>";
          //  echo $row['sdate'];
          //  echo "<br>";


        }
    }
}


?>
</select>
</form>
</div>
<div class="test">
    hello test
</div>

<div class= "seat-bookings">
<div class="movie-container">
      <label for="">Pick a movie</label>
      <select id="movie">
        <option value="10">Avengers: Endgame ($10)</option>
        <option value="12">Joker ($12)</option>
        <option value="8">Toy Story 4 ($8)</option>
        <option value="9">The Lion King ($9)</option>
      </select>
    </div>

    <ul class="showcase">
      <li>
        <div class="seat"></div>
        <small>N/A</small>
      </li>
      <li>
        <div class="seat selected"></div>
        <small>Selected</small>
      </li>
      <li>
        <div class="seat occupied"></div>
        <small>Occupied</small>
      </li>
    </ul>

    <div class="container">
      <div class="screen"></div>

      <div class="row">
        <div class="seat"><a><input value="1"></a></div>
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat"></div>
      </div>

      <div class="row">
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat occupied"></div>
        <div class="seat occupied"></div>
        <div class="seat"></div>
        <div class="seat"></div>
      </div>
      <div class="row">
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat occupied"></div>
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat occupied"></div>
        <div class="seat"></div>
      </div>

      <div class="row">
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat occupied"></div>
        <div class="seat occupied"></div>
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat"></div>
      </div>





    <p class="text">
      You have selected <span id="count">0</span> seats for a price of $<span
        id="total"
        >0</span
      >
    </p>
</div>
<script>
    //function to select theatre and show date option
  function showtheatre(str)
{
  movieidEn = <?= $movieidEn ?> ;
  theat=str;

// if (str=="")
//   {
//   document.getElementById("movie").innerHTML="";
//   return;
//   } 
$(document).ready(function(){

  $.ajax({
    type: "POST",
    url: 'getdate.php',
    data: {"thet":str,
            "movieid":movieidEn},
    success: function(data){

      $(".bookform").children().slice(1,).remove();
      $(".bookform").append(data);
     
    }
 });
})
}

  //function to select date and show timings option
function showdate(str){         
  mdate=str;

$(document).ready(function(){
 console.log("Date ");
$.ajax({
  type: "POST",
  url: 'gettime.php',
  data: {"thet":theat,
          "mdate":mdate,
          "movieid":movieidEn},
  success: function(data){
    console.log(mdate);
    $(".bookform").children().slice(2,).remove();   //remove eveyrhing except first two element, that is remove previously clicked-element
    $(".bookform").append(data);
   
  }
});
})
}

function showseats(str){         
  mtime=str;

$(document).ready(function(){
 console.log("Seats ");
$.ajax({
  type: "POST",
  url: 'getseats.php',
  data: {"thet":theat,
          "mdate":mdate,
          "mtime":mtime,
          "movieid":movieidEn},
  success: function(data){

    $('.seat-bookings').css("display","block");
    $(".movie-container").append(data);
  }
});
})

}

  </script>
    <script type="text/javascript" src= movie-page.js></script>
</body>
</html>