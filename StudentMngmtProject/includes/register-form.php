<?php
session_start();

$name = "";
$surname = "";
$username = "";
$faculty_id = "";
$error_array = array();

require_once('connect.php');

if($db_cxn === false){
    array_push($error_array, "ERROR: Could not connect to " . mysqli_connect_error());
}

if (isset($_POST['register_user'])) {

$name = mysqli_real_escape_string($db_cxn, $_POST['name']);
$surname = mysqli_real_escape_string($db_cxn, $_POST['surname']);
$username = mysqli_real_escape_string($db_cxn, $_POST['username']);
$password = mysqli_real_escape_string($db_cxn, $_POST['password']);
$password_confirmation = mysqli_real_escape_string($db_cxn, $_POST['password_confirmation']);
$faculty_id = mysqli_real_escape_string($db_cxn, $_POST['faculty_id']);

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

$dupe_check = mysqli_query($db_cxn, "SELECT * FROM users WHERE username='$username' LIMIT 1");
$user = mysqli_fetch_assoc($dupe_check);

if ($user) {
    if ($user['username'] === $username) {
      array_push($error_array, "Username already exists");
    }
  }

  if (count($error_array) == 0) {
    $encrypted_password = md5($password);

    $query = "INSERT INTO users (name, surname, username, faculty_id, password) 
        VALUES('$name', '$surname', '$username', '$faculty_id', '$encrypted_password')";
    mysqli_query($db_cxn, $query);
    $_SESSION['username'] = $username;
    $_SESSION['success'] = "You are now logged in";
    header('location: index.php');
    }
}

if (isset($_POST['login_user'])) {
    $username = mysqli_real_escape_string($db_cxn, $_POST['username']);
    $password = mysqli_real_escape_string($db_cxn, $_POST['password']);
  
    if (empty($username)) {
        array_push($error_array, "Please enter a username");
    }
    if (empty($password)) {
        array_push($error_array, "Please enter a password");
    }
  
    if (count($error_array) == 0) {
        $password = md5($password);
        $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
        $results = mysqli_query($db_cxn, $query);
        if (mysqli_num_rows($results) == 1) {
          $_SESSION['username'] = $username;
          $_SESSION['success'] = "You are now logged in";
          header('location: index.php');
        }
        
        else {
            array_push($error_array, "Wrong E-Mail or Password"); 
        }
    }
  }
?>