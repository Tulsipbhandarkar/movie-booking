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
    <link rel="stylesheet" href="movie.css">

</head>
<body>
    Dashboard
    <br>
<ul>
<?php
$u_mail=$_SESSION['username'] ;
$sql1= "SELECT bid,sid,sno FROM bookings NATURAL JOIN seats WHERE bookings.mail='$u_mail' AND bookings.bid=seats.bid;";

$bids=array();

if($result = mysqli_query($link,$sql1))
    {
     if(mysqli_num_rows($result) > 0){

while($row = mysqli_fetch_array($result))
        {
            array_push($bids,$row['bid']);

        } 
    }
    else{
        echo "Error ".$sql1;
    }
}
else{
    echo "Error linking ".$sql1;
}

$bids=array_unique($bids);
sort($bids);

foreach($bids as $b)  {
    //$sql2= "SELECT movies.mname, shows.sdate, shows.stimings bookings.noseats FROM bookings,shows,movies,seats WHERE bookings.bid=$b AND bookings.sid=shows.sid AND shows.mid=movies.mid;";
    $sql2= "SELECT bookings.bid, movies.mname,bookings.noseats,shows.sdate, shows.stimings FROM bookings,shows,movies WHERE bookings.bid=$b AND  shows.sid=bookings.sid AND shows.mid=movies.mid ORDER BY bookings.bid ASC; ";


        if($result = mysqli_query($link,$sql2))
        {
        if(mysqli_num_rows($result) > 0){

        while($row = mysqli_fetch_array($result))
            {
                echo "<li id='". $b."'class='booking_item'> <button class='delete_booking'> DELETE </button>" ;
        echo $b. "  ---". $row['mname']. ' '. $row['noseats'] ."  " .$row['sdate']. "  ". $row['stimings'];
        echo "<br>";
        echo "</li>" ;
            } 
        }
        else{
            echo "Error sq2 ".$sql2;
        }
        }
        else{
        echo "Error linking sql2 ".$sql2;
            }

}


?>
 </ul>

 <script>


        $(document).ready(function(){
            $('.delete_booking').click(function(){
                var b_item=$(this).attr('id')
                $(this).parent().remove();
                $.ajax({
                    type:'POST',
                    url: 'delete_booking.php',
                    data: {"b_item": b_item,
                    },
                    success: function(data){
                        console.log("Sucessfully deleted")
                    }
                }
)
            })
})

   
 </script> 

</body>
</html>