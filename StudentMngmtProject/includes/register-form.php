<?php
session_start();

if(isset($_SESSION['user'])) {
    header('location: index.php?page=dashboard');
}

$error_array = array();
if(!isset($_POST['register_user']) && !isset($_POST['login_user'])) {
    goto done;
}

require_once('connect.php');

if($db_cxn === false) {
    array_push($error_array, "ERROR: Could not connect to " . mysqli_connect_error());
}

$user = NULL;
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
    else if (!filter_var($username, FILTER_VALIDATE_EMAIL)) {
        array_push($error_array, "Invalid email"); }

    if (empty($faculty_id)) {
        array_push($error_array, "Please enter your Faculty ID"); }
    if ($password != $password_confirmation) {
        array_push($error_array, "Passwords do not match, please check again"); }

    if(count($error_array) != 0) {
        goto done;
    }

    $dupe_check = mysqli_query($db_cxn, "SELECT * FROM users WHERE username='$username' LIMIT 1");
    if($dupe_check == false) {
        array_push($error_array, "Database error");
        goto done;
    }

    if (mysqli_num_rows($dupe_check) != 0) {
        array_push($error_array, "Username already exists");
        goto done;
    }

    $encrypted_password = md5($password);

    $query = "INSERT INTO users (name, surname, username, faculty_id, password)
        VALUES('$name', '$surname', '$username', '$faculty_id', '$encrypted_password')";
    $result = mysqli_query($db_cxn, $query);
    if($result == false) {
        array_push($error_array, "Database error");
        goto done;
    }

    $last = mysqli_insert_id($db_cxn);
    $query = "SELECT users.*, faculties.name AS faculty_name FROM users
        INNER JOIN faculties ON users.faculty_ref = faculties.id
        WHERE id='$last'";
    $result = mysqli_query($db_cxn, $query);
    if($result == false) {
        array_push($error_array, "Database error");
        goto done;
    }

    $user = mysqli_fetch_assoc($result);
}
else if (isset($_POST['login_user'])) {
    $username = mysqli_real_escape_string($db_cxn, $_POST['username']);
    $password = mysqli_real_escape_string($db_cxn, $_POST['password']);

    if (empty($username)) {
        array_push($error_array, "Please enter a username");
    }
    if (empty($password)) {
        array_push($error_array, "Please enter a password");
    }

    if (count($error_array) != 0) {
        goto done;
    }

    $password = md5($password);
    $query = "SELECT users.*, faculties.name AS faculty_name FROM users
        INNER JOIN faculties ON users.faculty_ref = faculties.id
        WHERE username='$username' AND password='$password'";
    $results = mysqli_query($db_cxn, $query);
    if($results == false) {
        array_push($error_array, "Couldn't SELECT");
        goto done;
    }

    if (mysqli_num_rows($results) == 1) {
        $user = mysqli_fetch_assoc($results);
    }
    else {
        array_push($error_array, "Wrong E-Mail or Password");
    }
}

if ($user != null) {
    if($user['description'] !== null) {
        $user['description'] = explode("\n", $user['description']);
    }
    $_SESSION['user'] = $user;
    header("location: index.php?page=dashboard");
}

done:;

?>
