<?php

$link = mysqli_connect('localhost', 'root', '', 'casara_sis');
 
$name = "";
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>