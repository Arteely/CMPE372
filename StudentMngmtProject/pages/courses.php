<?php
    if(!isset($_GET['cid']))
        header("location: index.php?page=dashboard");

    $cid = $_GET['cid'];

    $query = mysqli_query($db_cxn, "SELECT * FROM courses WHERE id=$cid");
    $course = mysqli_fetch_assoc($query);

    if($course == false || $course['teacher_id'] != $USER['id'])
        header("location: index.php?page=dashboard");

    $query = mysqli_query($db_cxn, "SELECT * FROM students_courses
        INNER JOIN students ON students_courses.student_id = students.id
        WHERE course_id=$cid");
    $students = mysqli_fetch_all($query, MYSQLI_ASSOC);
?>

<div class="main-content-body">
    <div class="course-container">
        <div class="course-intro">
            <span class="greet-title-text"><?php echo "{$course['name']}: {$course['ext_name']}"; ?></span>
            <span class="greet-subheading"><?php echo "{$USER['name']} {$USER['surname']}"; ?>, Faculty of <?php echo "{$USER['faculty_name']}" ?></span>
        </div>
        <div class="course-banner-container">
            <img class="course-banner" src="https://images.pexels.com/photos/669616/pexels-photo-669616.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2">
        </div>
        <div class="course-description">
            <div class="tabset">
                <!-- Tab 1 -->
                <input type="radio" name="tab-button" id="tab-button-1" aria-controls="notes" checked>
                <label for="tab-button-1">Course Notes</label>
                <!-- Tab 2 -->
                <input type="radio" name="tab-button" id="tab-button-2" aria-controls="resources">
                <label for="tab-button-2">Resources</label>
                <!-- Tab 3 -->
                <input type="radio" name="tab-button" id="tab-button-3" aria-controls="participants">
                <label for="tab-button-3">Participants</label>

                <div class="tab-panels">
                    <section id="notes" class="tab-panel">
                        <h3><?php echo "{$course['name']} - {$course['ext_name']}"; ?></h3>
                        <p>Further development of the material in BUS 273, in particular the analysis of variance,
                        multiple regression, non-parametric procedures and the analysis of categorical data.
                        Data analysis via statistical packages.
                        </p>
                    </section>
                    <section id="resources" class="tab-panel">
                        <h3>6B. Rauchbier</h3>
                        <p><strong>Overall Impression:</strong>  An elegant, malty German amber lager with a balanced, complementary beechwood smoke character. Toasty-rich malt in aroma and flavor, restrained bitterness, low to high smoke flavor, clean fermentation profile, and an attenuated finish are characteristic.</p>
                        <p><strong>History:</strong> A historical specialty of the city of Bamberg, in the Franconian region of Bavaria in Germany. Beechwood-smoked malt is used to make a Märzen-style amber lager. The smoke character of the malt varies by maltster; some breweries produce their own smoked malt (rauchmalz).</p>
                    </section>
                    <section id="participants" class="tab-panel">
                        <?php foreach($students as $s): ?>
                        <div class="instructor-profile">
                            <img class="instructor-image" src="assets/profile-picture-selfmade.png">
                            <div class="instructor-info">
                                <span class="instructor-name"><?php echo "{$s['name']} {$s['surname']}"; ?></span><br>
                                <span class="instructor-faculty"><?php echo "{$s['student_id']}"; ?></span>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </section>
                </div>
            </div>
            <div class="instructor-description">
                <h3>About Instructor</h3>
                <div class="instructor-profile">
                    <img class="instructor-image" src="assets/profile-picture-selfmade.png">
                    <div class="instructor-info">
                        <span class="instructor-name"><?php echo "{$USER['name']} {$USER['surname']}"; ?></span><br>
                        <span class="instructor-faculty">Faculty of <?php echo "{$USER['faculty_name']}" ?></span>
                    </div>
                </div>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dicta asperiores provident voluptates ipsum eum deleniti nostrum quisquam, officia alias vero a unde ad possimus architecto culpa laboriosam! Sit, atque nam!</p>
            </div>
        </div>
    </div>
    <div class="course-tasks-container">

    </div>
</div>
