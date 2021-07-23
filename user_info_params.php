<?php

$url_rec=$_SERVER['HTTP_REFERER'];


if(strpos($url_rec,'movie-page.php')){
    $thet = $_GET['theat'];
    $mdate= $_GET['mdate'];
    $mtime = $_GET['mtime'];
    $movieid= $_GET['mid'];
    
    $mtime .= ":00";

}
else{
    $thet = 0;
    $mdate=0;
    $mtime = 0;
    $movieid= 0;
    
}

?>        