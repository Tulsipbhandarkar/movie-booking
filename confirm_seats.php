<?php

include 'connection.php';
include 'user_info_params.php';
session_start();

$arr_seats=$_POST['sel_seats'];
$dec_seats=json_decode($arr_seats);

// $arr_seat= explode(',', $arr_seats);
$sid = $_POST['sid'];
$tot_seats= sizeof($dec_seats);


$u_mail=$_SESSION['username'];

// $sql = "INSERT INTO bookings (mail, sid, noseats) VALUES ('123@mail.com',1,5);";
$sql = "INSERT INTO bookings (mail, sid, noseats) VALUES ('".$u_mail."','".$sid ."','" .$tot_seats ."')";      

if(mysqli_query($link,$sql))
{
    echo "Succesfully inserted";
}
else{
    echo "Error: " . $sql . "<br>" . mysqli_error($link);
}





$sql2= "SELECT bid FROM bookings WHERE bookings.mail='$u_mail' ORDER BY bid DESC LIMIT 1;";
$bid=0;
if($result = mysqli_query($link,$sql2))
    {
     if(mysqli_num_rows($result) > 0){

while($row = mysqli_fetch_array($result))
        {
            $bid = $row['bid'];
        } 
    }
}



foreach($dec_seats as $seat){
    $seat_no=(int)$seat;
    $calc=150 + 50*(ceil($seat_no/5));
   echo $calc;
    $sql3="INSERT INTO seats(sno, sid, price , bid) VALUES ($seat_no, $sid, $calc, $bid);";

    if(mysqli_query($link,$sql3))
{
    echo "Succesfully inserted ".$seat;
}
else{
    echo "Error: " . $sql3 . "<br>" . mysqli_error($link);}
}

?>