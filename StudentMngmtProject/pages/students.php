<?php
    $query = mysqli_query($db_cxn, "SELECT * FROM students");
    $students = mysqli_fetch_all($query, MYSQLI_ASSOC);

?>

<div class="main-content-body body-students">
    <div class="user-greet">
        <span class="greet-title-text">Students</span><br>
        <span class="greet-text">List of all students attending your classes</span>
    </div>

    <div class="students-grid">
        <?php foreach ($students as $s) : ?>
            <div class="instructor-profile">
                <img class="instructor-image" src="assets/profile-picture-selfmade.png">
                <div class="instructor-info">
                    <span class="instructor-name"><?php echo "{$s['name']} {$s['surname']}"; ?></span><br>
                    <span class="instructor-faculty"><?php echo "{$s['student_id']}"; ?></span>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>