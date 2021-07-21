<?php
include 'connection.php';

$thet = $_POST['thet'];
$mdate = $_POST['mdate'];
$movieid = $_POST['movieid'];

$sql= "SELECT * FROM shows NATURAL JOIN cities WHERE shows.mid=$movieid AND cities.cid=$thet AND shows.sdate='$mdate';";


if($result = mysqli_query($link,$sql));
    {
	 echo "<select name ='movietime' class ='movietime' onchange=\"showseats(this.value)\">";
	 echo "<option value=\"\">--Select Time--</option>";
     if(mysqli_num_rows($result) > 0){
      echo "Printing 2";
while($row = mysqli_fetch_array($result))
  {
    $trim_time=substr($row['stimings'],0,5);   //trimmed trailing zeros
	 echo "<option value='".$trim_time."'>".$trim_time." </option> ";

  }
		echo "</select>";

  }
  else{
      echo "<option>No result</option>";
  }
}
?>