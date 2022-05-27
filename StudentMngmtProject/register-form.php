<?php

require_once "config.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty(trim($_POST["username"]))){
        $username_error = "Please enter a username";
    }
    elseif(str_contains($_POST["username"], '@') == FALSE){
        $username_error = "Username is not an e-mail";
    }
}

?>