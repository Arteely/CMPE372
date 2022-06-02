<?php
  session_start();

  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
    }

  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login.php");
  }

  require_once('includes/connect.php');
  $username = mysqli_real_escape_string($db_cxn , $_SESSION['username']);
  $query = mysqli_query($db_cxn , "SELECT * FROM users WHERE username='$username'");
  $user = mysqli_fetch_assoc($query);
  $query = mysqli_query($db_cxn , "SELECT * FROM courses WHERE teacher_id='{$user['id']}'");
  $courses = mysqli_fetch_all($query , MYSQLI_ASSOC);
  foreach($courses as &$c){
      $query = mysqli_query($db_cxn , "SELECT * FROM students_courses WHERE course_id='{$c['id']}'");
      $students = mysqli_fetch_all($query , MYSQLI_ASSOC);
      $c['students'] = $students;
  }
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

                    <span class="navbar-user-text">Welcome! <?php echo "{$user['name']}" ?></span>
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
                <div class="main-content-body">
                    <div class="greet-search-area">
                        <div class="user-greet">
                        <span class="greet-title-text"><?php echo "{$user['name']} {$user['surname']}" ?></span>
                        <span class="greet-text">Good Afternoon, you have no upcoming lessons today!</span>
                        </div>
                        <div class="search-bar">
                            <img class="search-icon" src="assets/icons/magnifying-glass-solid.svg">
                            <input class="search-input" type="text" placeholder="Search courses or anything">
                        </div>
                        <div class="notifications-bar">
                            <a href="#"><img class="notification-icon" src="assets/icons/bell-solid.svg"></a>
                        </div>
                    </div>
                    <hr>
                    <div class="your-courses-area">
                        <div class="your-courses-text">
                            <span class="greet-title-text">Your Courses</span>
                            <span class="greet-text">Take a look at the lessons you have.</span>
                        </div>
                        <div class="your-courses">
                            <?php foreach($courses as $c): ?>
                            <?php $count = count($c['students']); ?>
                            <div class="course">
                                <img class="course-img" src="assets/pexels-julia-m-cameron-4144294(1).jpg">
                                <a class="course-name" href="#"><?php echo "{$c['name']}" ?></a>
                                <span class="course-students"><?php echo "$count Members"?></span>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <hr>
                    <div class="your-courses-area">
                        <div class="your-courses-text">
                            <span class="greet-title-text">Upcoming</span>
                            <span class="greet-text"><?php echo date('l, F jS')?></span>
                        </div>
                        <div class="calendar-area">
                            <div class="calendar">
                                <a class="course-name" href="#">CMPE372</a><br>
                                <span class="course-students">10:30 - 11:30</span>
                                <span class="course-students">32 Members</span><br>
                                <span class="course-students">Zoom</span>
                            </div>
                            <div class="calendar">
                                <a class="course-name" href="#">CMPE372</a><br>
                                <span class="course-students">10:30 - 11:30</span>
                                <span class="course-students">32 Members</span><br>
                                <span class="course-students">Zoom</span>
                            </div>
                            <div class="calendar">
                                <a class="course-name" href="#">CMPE372</a><br>
                                <span class="course-students">10:30 - 11:30</span>
                                <span class="course-students">32 Members</span><br>
                                <span class="course-students">Zoom</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="footer-container">
                    <div class="footer-area">
                         <img src="assets/casara-logo-white-selfmade.png">
                    </div>
                    <div class="footer-area">
                        <ul class="footer-links">
                            <li class="footer-link">
                                <a href="#">Dashboard</a>
                            </li>
                            <li class="footer-link">
                                <a href="#">Lessons</a>
                            </li>
                            <li class="footer-link">
                                <a href="#">Students</a>
                            </li>
                            <li class="footer-link">
                                <a href="#">Announcements</a>
                            </li>
                        </ul>
                    </div>
                    <div class="footer-area flex-right">
                        <div class="footer-logout">
                            <span>You are logged in as: <strong><?php echo "{$user['name']} {$user['surname']}" ?></strong></span><br>
                            <span class="footer-link"><a href="index.php?logout='1'">Log Out</a></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
