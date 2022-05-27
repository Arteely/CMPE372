<?php

$link = mysqli_connect('localhost', 'root', '', 'casara_sis');
 
$name = "";
$surname = "";
$username = "";
$password = "";
$password_confirmation = "";
$faculty_id = "";

if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>