<?php

include 'connection.php';
include 'user_info_params.php';
session_start();

$arr_seats=$_POST['selected_seats'];
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
    echo "Error: " . $sql . "<br>" . mysqli_error($link);}

foreach($dec_seats as $seat){
    $seat_no=(int)$seat;
    $calc=150 + 50*(ceil($seat_no/5));
   echo $calc;
    $sql2="INSERT INTO seats(sno, sid, price , mail) VALUES ($seat_no, $sid, $calc, '$u_mail');";

    if(mysqli_query($link,$sql2))
{
    echo "Succesfully inserted ".$seat;
}
else{
    echo "Error: " . $sql . "<br>" . mysqli_error($link);}
}

?>