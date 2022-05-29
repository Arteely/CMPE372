<?php
    require_once("config.php");
    $db_cxn = mysqli_connect($CONFIG['dbhost'], $CONFIG['dbuser'], $CONFIG['dbpass'], $CONFIG['dbname']);
?>