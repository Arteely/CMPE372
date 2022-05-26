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
                    <span class="navbar-user-text">Welcome! Artem Artemyev</span>
                    <span class="navbar-user-text">Faculty of Business</span>
                </div>
                <hr class="sidebar-divide">
                <ul class="side-menu-links">
                    <li class="side-menu-button selected">
                        <a href="index.html">
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
                        <a href="login.php">
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
                <div class="greet-search-area">
                    <div class="user-greet">
                     <span class="greet-title-text">Hi! Artem Artemyev</span>
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
                        <div class="course">
                            <img class="course-img" src="assets/pexels-julia-m-cameron-4144294(1).jpg">
                            <a class="course-name" href="#">CMPE372</a>
                            <span class="course-students">31 Members</span>
                        </div>
                        <div class="course">
                            <img class="course-img" src="assets/pexels-julia-m-cameron-4144294(1).jpg">
                            <a class="course-name" href="#">CMPE372</a>
                            <span class="course-students">32 Members</span>
                        </div>
                        <div class="course">
                            <img class="course-img" src="assets/pexels-julia-m-cameron-4144294(1).jpg">
                            <a class="course-name" href="#">CMPE372</a>
                            <span class="course-students">32 Members</span>
                        </div>
                        <div class="course">
                            <img class="course-img" src="assets/pexels-julia-m-cameron-4144294(1).jpg">
                            <a class="course-name" href="#">CMPE372</a>
                            <span class="course-students">32 Members</span>
                        </div>
                        <div class="course">
                            <img class="course-img" src="assets/pexels-julia-m-cameron-4144294(1).jpg">
                            <a class="course-name" href="#">CMPE372</a>
                            <span class="course-students">32 Members</span>
                        </div>
                        <div class="course">
                            <img class="course-img" src="assets/pexels-julia-m-cameron-4144294(1).jpg">
                            <a class="course-name" href="#">CMPE372</a>
                            <span class="course-students">32 Members</span>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="your-courses-area">
                    <div class="your-courses-text">
                        <span class="greet-title-text">Upcoming</span>
                        <span class="greet-text">Tuesday, May 25th</span>
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
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>