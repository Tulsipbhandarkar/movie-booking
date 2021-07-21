<?php
include 'connection.php';

$thet = $_POST['thet'];
$movieid = $_POST['movieid'];

$sql= "SELECT DISTINCT shows.sdate FROM shows NATURAL JOIN cities WHERE shows.mid=$movieid AND cities.cid=$thet;";


if($result = mysqli_query($link,$sql));
    {
	 echo "<select name ='movie' class ='moviedate' onchange=\"showdate(this.value)\">";
	 echo "<option value=\"\">--Select Date--</option>";
     if(mysqli_num_rows($result) > 0){
      
while($row = mysqli_fetch_array($result))
  {
	 echo "<option value='".$row['sdate']."'>".$row['sdate']." </option> ";

  }
		echo "</select>";

  }
  else{
      echo "<option>No result</option>";
  }
}
?>