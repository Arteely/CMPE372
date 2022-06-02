<?php
  $query = mysqli_query($db_cxn , "SELECT * FROM courses WHERE teacher_id='{$USER['id']}'");
  $courses = mysqli_fetch_all($query , MYSQLI_ASSOC);
  foreach($courses as &$c){
      $query = mysqli_query($db_cxn , "SELECT * FROM students_courses WHERE course_id='{$c['id']}'");
      $students = mysqli_fetch_all($query , MYSQLI_ASSOC);
      $c['students'] = $students;
  }
?>

<div class="main-content-body">
    <div class="greet-search-area">
        <div class="user-greet">
            <span class="greet-title-text"><?php echo "{$USER['name']} {$USER['surname']}" ?></span>
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
