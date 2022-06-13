<?php
    $query = mysqli_query($db_cxn, "SELECT * FROM courses WHERE teacher_id='{$USER['id']}'");
    $courses_m = mysqli_fetch_all($query, MYSQLI_ASSOC);

$courses = [];
foreach ($courses_m as &$c) {
    $query = mysqli_query($db_cxn, "SELECT * FROM students_courses WHERE course_id='{$c['id']}'");
    $students = mysqli_fetch_all($query, MYSQLI_ASSOC);
    $c['students'] = $students;
    $courses[$c['id']] = $c;
}

?>

<div class="main-content-body">
    <div class="user-greet">
        <span class="greet-title-text">Your Courses</span><br>
        <span class="greet-text">List of all your available courses</span>
    </div>

    <div class="lessons-container">
        <div class="announcement-header">
            <span class="an-head">Course Name</span>
            <span class="an-rest">Students</span>
            <span class="an-rest">Location</span>
            <span class="an-rest"></span>
        </div>
        <?php foreach ($courses as $c) : ?>
        <?php $count = count($c['students']); ?>
        <div class="lessons">
            <div class="lesson-details">
                <div class="lesson-image">
                    <span>BS</span>
                </div>
                <div class="lesson-name">
                    <span class="instructor-name"><?php echo "{$c['name']}"?></span><br>
                    <span class="instructor-faculty"><?php echo "{$c['ext_name']}"?></span>
                </div>
                <div class="lesson-students">
                    <span class="instructor-faculty"><?php echo "$count Members" ?></span>
                </div>
                <div class="lesson-students">
                    <span class="instructor-faculty">Online (Zoom)</span>
                </div>
                <div class="lesson-link">
                    <form method="POST" action="?page=courses&cid=<?php echo "{$c['id']}"?>">
                        <button>View Class</button>
                    </form>
                </div>
            </div>
            <div class="lesson-desc">
                <span class="greet-text"><?php echo "{$c['description']}"?></span>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>