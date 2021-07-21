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

var movieidEn=0;
var theat=0;
var mdate=0;
var mtime=0;

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
<!-- <div><script type='text/javascript' src='dup.js'></script></div> -->
    <div class="movie-container" id="showing-seats">
      <div class="screen" style="width: 100%; height: 60px; display:none;"></div>

<table id="s_table">
  <!--  <tr>
    <td class="seat" data-value="1" width="20px" style="text-align: center"><a href="#">  1</a></td> 
    <td class="seat" data-value="2" width="20px" style="text-align: center"><a href="#">  2</a></td> 
    <td class="seat" width="20px" style="text-align: center"><a href="#">  3</a></td> 
    <td class="seat" width="20px" style="text-align: center"><a href="#">  4</a></td> 
    <td class="seat occupied" width="20px" style="text-align: center"><a href="#">  5</a></td> 
  </tr>
  <tr>
    <td class="seat" width="20px" style="text-align: center"><a href="#">  6</a></td> 
    <td class="seat"  style="text-align: center"><a href="#">  7</a></td> 
    <td class="seat" style="text-align: center"><a href="#">  8</a></td> 
    <td class="seat" style="text-align: center"><a href="#">  9</a></td> 
    <td class="seat" style="text-align: center"><a href="#">  10</a></td> 
  </tr>
  <tr>  
    <td class="seat" width="20px" style="text-align: center"><a href="#">  11</a></td> 
    <td class="seat" style="text-align: center"><a href="#">  12</a></td> 
    <td class="seat occupied" style="text-align: center"><a href="#">  13</a></td> 
    <td class="seat" style="text-align: center"><a href="#">  14</a></td> 
    <td class="seat" style="text-align: center"><a href="#">  15</a></td> 
  </tr> -->
</table>
</div>

    <p class="text">
      You have selected <span id="count">0</span> seats for a price of $<span
        id="total"
        >0</span
      >
    </p>

  <input type="button" id='submit-button' value='Book Seats' disabled> 
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

$('#submit-button').prop('disabled',true);

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
  
  $('#submit-button').prop('disabled',true);

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


   $('#submit-button').prop('disabled',false);
    $('#submit-button').click(function(){
      loc ='seats_page.php?mid='+movieidEn+'&theat='+theat+"&mdate="+mdate+"&mtime="+mtime
      window.location.assign(loc);
    })
//  console.log("Seats ");
// $.ajax({
//   type: "POST",
//   url: 'seats_page.php',
//   data: {"thet":theat,
//           "mdate":mdate,
//           "mtime":mtime,
//           "movieid":movieidEn},
//   success: function(data){
//     console.log("Success ");
//     $('.screen').css('display','block')
//     $("#s_table").html("");  
//     $("#s_table").append(data);
//   }
// });

})

}

  </script>
    <script type="text/javascript" src= movie-page.js></script>
</body>
</html>