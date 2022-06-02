<?php
  session_start();

  if (!isset($_SESSION['user'])) {
  	header('location: login.php');
    }

  if (isset($_GET['logout'])) {
  	session_destroy();
    unset($_SESSION['user']);
  	header("location: login.php");
  }

  require_once('includes/connect.php');
  $USER = $_SESSION['user'];
?>

<html lang="en-gb">
    <head>
        <title>CASARA SIS</title>
        <link rel="stylesheet" href="stylesheet.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;700&display=swap" rel="stylesheet">
        <link rel="icon" href="assets/favicon.ico">
    </head>
    <body>
        <div class="main-page-container">
            <div class="side-menu">
                <div class="navbar-user">
                    <img src="assets/casara-logo-white-selfmade.png">

                    <span class="navbar-user-text">Welcome! <?php echo "{$USER['name']}" ?></span>
                    <span class="navbar-user-text">Faculty of Business</span>
                </div>
                <hr class="sidebar-divide">
                <ul class="side-menu-links">
                    <li class="side-menu-button selected">
                        <a href="index.php">
                            <img class="side-menu-button-image" src="assets/icons/table-columns-solid.svg">
                            <span class="side-menu-button-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="side-menu-button">
                        <a href="#">
                            <img class="side-menu-button-image" src="assets/icons/check-solid.svg">
                            <span class="side-menu-button-text">Lessons</span>
                        </a>
                    </li>
                    <li class="side-menu-button">
                        <a href="#">
                            <img class="side-menu-button-image" src="assets/icons/users-solid.svg">
                            <span class="side-menu-button-text">Students</span>
                        </a>
                    </li>
                    <li class="side-menu-button">
                        <a href="#">
                            <img class="side-menu-button-image" src="assets/icons/sliders-solid.svg">
                            <span class="side-menu-button-text">Settings</span>
                        </a>
                    </li>
                </ul>
                    <hr class="sidebar-divide">
                <ul class="side-menu-links">
                    <li class="side-menu-button">
                        <a href="#">
                            <img class="side-menu-button-image" src="assets/icons/bullhorn-solid.svg">
                            <span class="side-menu-button-text">Announcements</span>
                        </a>
                    </li>
                    <li class="side-menu-button">
                        <a href="index.php?logout='1'">
                            <img class="side-menu-button-image" src="assets/icons/arrow-right-from-bracket-solid.svg">
                            <span class="side-menu-button-text">Log Out</span>
                        </a>
                    </li>
                </ul>
                <div class="navbar-footer">
                    <span class="navbar-user-text">CASARA-SIS is a platform made as a CMPE372 Project.</span>
                </div>
            </div>
            <div class="main-content-area">
                <?php
                    $page_target = "pages/{$_GET['page']}.php";
                    if(!file_exists($page_target))
                        header("location: index.php?page=dashboard");

                    require_once($page_target);
                ?>
            </div>
        </div>
    </body>
</html>
