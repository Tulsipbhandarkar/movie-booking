<?php
include 'connection.php';
include 'user_info_params.php';

echo "seat-bookings";
// $thet = $_GET['theat'];
// $mdate = $_GET['mdate'];
// $mtime = $_GET['mtime'];
// $movieid = $_GET['mid'];

// $mtime .= ":00";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="movie.css">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


</head>
<body>



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
    <div class="movie-container" id="showing-seats">
      <div class="screen" style="width: 100%; height: 60px;"></div>
      <table id="s_table">
<?php

$sql= "SELECT * FROM shows NATURAL JOIN seats WHERE shows.mid=$movieid AND shows.cid=$thet AND shows.sdate='$mdate' AND shows.stimings='$mtime';";

echo  $thet;
$cnt=0;
$occ_seats= array();
$seat_name="";
if($result = mysqli_query($link,$sql))
    {

     if(mysqli_num_rows($result) > 0){

while($row = mysqli_fetch_array($result))
  {
      array_push($occ_seats, $row['sno']);
    $cnt+=1;
    $sid = $row['sid'];
    echo $sid;
  }
}
}
//    echo "<table id='s_table'>";
  for($i=1;$i<=3;$i++)
  {  
    $seat_price=150 + 50*$i;
      echo "<tr class='" .$seat_price ."'>";
    for($j=1;$j<=5;$j++)
    {           $calc=($i-1)*5+$j ;
        if(in_array($calc , $occ_seats)){
            $seat_name="seat occupied";
        }
        else{
            $seat_name="seat";
        }

        echo "<td class='" .$seat_name ."'style='text-align: center'><a href='#'>" . $calc ."</a></td> ";
    }
    echo "</tr>";
  }
//    echo "</table>";

?>
</table>
</div>
    <p class="text">
      You have selected <span id="count">0</span> seats for a price of $<span
        id="total"
        >0</span>
    </p>
    <input type="button" id='submit-book' value='Pay now' disabled> 



    <script>
       
        mid = <?= $movieid ?> ;
        thet= <?= $thet ?> ;
        mtime=  <?= json_encode($mtime) ?> ;
        mdate= <?= json_encode($mdate) ?> ;
        sid= <?= $sid ?>;
        console.log(mid+" ");
        console.log(thet+" ");
        console.log(mdate+" ");
        console.log(mtime+" ");
        console.log(sid+" ");

        $(document).ready(function(){
          $('#submit-book').click(function(){
            // alert("Booking confirmed");
 
      var arrSeat =JSON.stringify(selected_seats);
      console.log(arrSeat);
      // $('#myLink').attr({ href: '/myLink?array=' + arrStr });

            $.ajax({
                  type: "POST",
                  url: 'confirm_seats.php',
                  data: {
                          "sid":sid,
                        "selected_seats":arrSeat},
                  success: function(data){
                    console.log("Seats confirmed");
                  $('.text').append(data);
                  }
                });

             window.location.assign('dashboard.php');
          });
        });
      </script>
          <script type="text/javascript" src= seats_page.js></script>

</body>
</html>