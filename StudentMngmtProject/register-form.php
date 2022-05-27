<?php

$link = mysqli_connect('localhost', 'root', '', 'casara_sis');
 
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

$name = "";
$surname = "";
$username = "";
$password = "";
$password_confirmation = "";
$faculty_id = "";
$error_array = array();

if (isset($_POST['reg_user'])) {

$name = mysqli_real_escape_string($link, $_POST['name']);
$surname = mysqli_real_escape_string($link, $_POST['surname']);
$username = mysqli_real_escape_string($link, $_POST['username']);
$password = mysqli_real_escape_string($link, $_POST['password']);
$password_confirmation = mysqli_real_escape_string($link, $_POST['password_confirmation']);
$faculty_id = mysqli_real_escape_string($link, $_POST['faculty_id']);

if (empty($name)) { 
    array_push($error_array, "Please enter your Name"); }
if (empty($surname)) { 
    array_push($error_array, "Please enter your Surname"); }
if (empty($username)) { 
    array_push($error_array, "Please enter your E-Mail"); }
if (empty($faculty_id)) { 
    array_push($error_array, "Please enter your Faculty ID"); }
if ($password != $password_confirmation) {
	array_push($error_array, "Passwords do not match, please check again"); }

$dupe_check = mysqli_query($link, "SELECT * FROM casara_sis WHERE username='$username' LIMIT 1");
$user = mysqli_fetch_assoc($dupe_check);

if ($user) {
    if ($user['username'] === $username) {
      array_push($error_array, "Username already exists");
    }
  }

  if (count($error_array) == 0) {
    $password = md5($password_confirmation);

    $query = "INSERT INTO casara_sis (username, name, surname, faculty_id, password) 
              VALUES('$username', '$name', '$surname', '$faculty_id', '$password')";
    mysqli_query($link, $query);
    $_SESSION['username'] = $username;
    $_SESSION['success'] = "You are now logged in";
    header('location: index.php');
    }
}
?>