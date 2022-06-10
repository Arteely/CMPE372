<?php
    if(!isset($_GET['cid']))
        header("location: index.php?page=dashboard");

    $cid = $_GET['cid'];

    $query = mysqli_query($db_cxn, "SELECT * FROM courses WHERE id=$cid");
    $course = mysqli_fetch_assoc($query);

    if($course['description'] !== null) {
        $course['description'] = explode("\n", $course['description']);
    }

    if($course == false || $course['teacher_id'] != $USER['id'])
        header("location: index.php?page=dashboard");

    $query = mysqli_query($db_cxn, "SELECT * FROM students_courses
        INNER JOIN students ON students_courses.student_id = students.id
        WHERE course_id=$cid");
    $students = mysqli_fetch_all($query, MYSQLI_ASSOC);

    $query = mysqli_query($db_cxn, "SELECT * FROM lectures WHERE course_id=$cid ORDER BY start");
    $lectures = mysqli_fetch_all($query, MYSQLI_ASSOC);
    foreach($lectures as &$l) {
        $l['start'] = new DateTimeImmutable($l['start']);
        $l['end'] = new DateTimeImmutable($l['end']);
    }
?>

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
            <!-- Tab 4 -->
            <input type="radio" name="tab-button" id="tab-button-4" aria-controls="participants">
            <label for="tab-button-4">Lectures</label>

            <div class="tab-panels">
                <section id="notes" class="tab-panel">
                    <h3><?php echo "{$course['name']} - {$course['ext_name']}"; ?></h3>
                    <?php
                        foreach($course['description'] as $p) {
                            echo "<p>$p</p>";
                        }
                    ?>
                </section>
                <section id="resources" class="tab-panel">
                    <h3>6B. Rauchbier</h3>
                    <p><strong>Overall Impression:</strong>  An elegant, malty German amber lager with a balanced, complementary beechwood smoke character. Toasty-rich malt in aroma and flavor, restrained bitterness, low to high smoke flavor, clean fermentation profile, and an attenuated finish are characteristic.</p>
                    <p><strong>History:</strong> A historical specialty of the city of Bamberg, in the Franconian region of Bavaria in Germany. Beechwood-smoked malt is used to make a Märzen-style amber lager. The smoke character of the malt varies by maltster; some breweries produce their own smoked malt (rauchmalz).</p>
                </section>
                <section id="participants" class="tab-panel">
                    <div class="participant-grid">
                        <?php foreach($students as $s): ?>
                        <div class="instructor-profile">
                            <img class="instructor-image" src="assets/profile-picture-selfmade.png">
                            <div class="instructor-info">
                                <span class="instructor-name"><?php echo "{$s['name']} {$s['surname']}"; ?></span><br>
                                <span class="instructor-faculty"><?php echo "{$s['student_id']}"; ?></span>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </section>
                <section id="lectures" class="tab-panel">
                    <div class="lecture-grid">
                        <?php foreach($lectures as $l):
                            $mon = $l['start']->format("M");
                            $day = $l['start']->format("j");
                            $start_h = $l['start']->format("H:s");
                            $end_h = $l['end']->format("H:s");

                        ?>
                        <div class="lecture-date">
                            <div class="lecture-date-mon"><?php echo $mon; ?></div>
                            <div class="lecture-date-day"><?php echo $day; ?></div>
                        </div>
                        <div class="lecture-body">
                            <div class="lecture-body-times"><?php echo "$start_h - $end_h"; ?></div>
                            <div class="lecture-body-topic"><?php echo $l['topic']; ?></div>
                        </div>
                        <?php endforeach; ?>
                        <div class="lecture-date">
                            <span class="lecture-new-icon">&#65291;</span>
                        </div>
                        <div class="lecture-body">
                            <a href="#" class="lecture-body-topic">Schedule New Lecture</span></a>
                        </div>
                    </div>
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
            <?php
                foreach($USER['description'] as $p) {
                    echo "<p>$p</p>";
                }
            ?>
        </div>
    </div>
</div>
<div class="course-tasks-container">

</div>
