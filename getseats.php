<?php
include 'connection.php';
echo "seat-bookings";
$thet = $_POST['thet'];
$mdate = $_POST['mdate'];
$mtime = $_POST['mtime'];
$movieid = $_POST['movieid'];

$mtime .= ":00";

$sql= "SELECT * FROM shows NATURAL JOIN seats WHERE shows.mid=$movieid AND shows.cid=$thet AND shows.sdate='$mdate' AND shows.stimings='$mtime';";

$cnt=0;
$occ_seats= array();
$seat_name="";
if($result = mysqli_query($link,$sql));
    {

     if(mysqli_num_rows($result) > 0){
        
while($row = mysqli_fetch_array($result))
  {
      array_push($occ_seats, $row['sno']);
    $cnt+=1;
  }
}
}
  // echo "<table>";
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
  // echo "</table>";


  // else{
  //     echo "No result";
  // }
  

?>