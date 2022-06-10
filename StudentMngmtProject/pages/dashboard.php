<script src="pages/dashboard.js"></script>

<?php
    $today = new DateTimeImmutable("today");
    if (!isset($_GET['week']))
    {
        $curr_w = intval($today->format("W"));
        echo <<<END
        <script>
            gotoWeek($curr_w, true);
        </script>
END;
    }
?>

<?php
    require_once("includes/db-conv.php");
    static $colors = ['#203C56', '#544E68', '#8D697A', "#DD8159", "#FDAA5E"];

    $query = mysqli_query($db_cxn , "SELECT * FROM courses WHERE teacher_id='{$USER['id']}'");
    $courses_m = mysqli_fetch_all($query , MYSQLI_ASSOC);

    $i = 0;
    $courses = [];
    foreach($courses_m as &$c){
        $query = mysqli_query($db_cxn , "SELECT * FROM students_courses WHERE course_id='{$c['id']}'");
        $students = mysqli_fetch_all($query , MYSQLI_ASSOC);
        $c['students'] = $students;
        $c['color'] = $colors[$i % count($colors)];
        $i++;

        $courses[$c['id']] = $c;
    }

    $thisyear = intval($today->format("o"));
    $w_desired = $_GET['week'];

    $w_start = new DateTime();
    $w_start->setISODate($thisyear, $w_desired);
    $w_start->setTime(0, 0);
    $w_end = clone $w_start;
    $w_end->add(new DateInterval("P7D"));

    $w_endm1 = clone $w_end;
    $w_endm1->sub(new DateInterval("P1D"));

    $w_start_m = $w_start->format("Y-m-d H:i:s");
    $w_end_m = $w_end->format("Y-m-d H:i:s");

    $query = mysqli_query($db_cxn,
        "SELECT * FROM lectures
            INNER JOIN courses ON lectures.course_id = courses.id
            WHERE courses.teacher_id = '{$USER['id']}'
            AND (lectures.start BETWEEN '$w_start_m' AND '$w_end_m')");
    $lectures = mysqli_fetch_all($query, MYSQLI_ASSOC);

    $l_by_date = [];
    foreach($lectures as &$l) {
        $l['start'] = new DateTimeImmutable($l['start']);
        $l['end'] = new DateTimeImmutable($l['end']);
        $l['duration_s'] = $l['end']->getTimestamp() - $l['start']->getTimestamp();
        $date = $l['start']->format("Y-m-d");
        if (!isset($l_by_date[$date]))
            $l_by_date[$date] = array();
        $l_by_date[$date][] = $l;
    }
?>

<div class="dashboard-body">
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
            <a href="index.php?page=announcements"><img class="notification-icon" src="assets/icons/bell-solid.svg"></a>
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
            <div class="course" style="<?php echo "--col: {$c['color']}"?>">
                <img class="course-img" src="assets/pexels-julia-m-cameron-4144294(1).jpg">
                <div class="course-text">
                    <?php echo "<a class=\"course-name\" href=\"?page=courses&cid={$c['id']}\">{$c['name']} </a>" ?>
                    <span class="course-students"><?php echo "$count Members"?></span>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <hr>
    <div class="upcoming-area">
        <div class="your-courses-header">
            <div class="your-courses-text">
                <span class="greet-title-text">Upcoming</span>
                <span class="greet-text"><?php echo "{$w_start->format('l, F jS')} - {$w_endm1->format('l, F jS')}"; ?></span>
            </div>
            <div class="calendar-buttons">
                <div class="calendar-buttons-inner">
                    <div class="button-prev">
                        <button onclick="prevWeek()">&#12296;</button>
                    </div>
                    <div class="button-next">
                        <button onclick="nextWeek()">&#10217;</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="calendar-area">
            <div class="calendar">
                <div></div>
                <div class="calendar-header-marking">07:00</div>
                <div class="calendar-header-vbar" style="--vbar-col:2"></div>
                <div class="calendar-header-marking">10:00</div>
                <div class="calendar-header-vbar" style="--vbar-col:3"></div>
                <div class="calendar-header-marking">13:00</div>
                <div class="calendar-header-vbar" style="--vbar-col:4"></div>
                <div class="calendar-header-marking">16:00</div>
                <div class="calendar-header-vbar" style="--vbar-col:5"></div>
                <div class="calendar-header-marking">19:00</div>
                <div class="calendar-header-vbar" style="--vbar-col:6"></div>
                <?php
                    $d = clone $w_start;
                    for($i = 0; $i < 7; $i++) {
                        echo "<div class=\"calendar-day-name\">{$d->format("l")}</div>";
                        echo "<div class=\"calendar-day-bar\">";
                        $d_key = $d->format("Y-m-d");
                        if(array_key_exists($d_key, $l_by_date)) {
                            foreach($l_by_date[$d_key] as $l) {
                                $l_type = db_l_type_enum_to_human($l['course_type']);
                                $l_plen = $l['duration_s'] / 540;
                                $l_startpos = ($l['start']->getTimestamp() - $d->getTimestamp() - 25200) / 540;
                                $col = $courses[$l['course_id']]['color'];
                                echo <<<END
                                <div class="calendar-day-bar-inner tooltip" style="--p-startpos: $l_startpos%; --p-len: $l_plen%; --col: $col">
                                <p>{$l['name']}</p>
                                <span class="tooltip-text">{$l['name']} $l_type</span>
                                </div>
                                END;
                            }
                        }
                        $d->add(new DateInterval("P1D"));
                        echo "</div>";
                    }
                ?>
            </div>
        </div>
    </div>
</div>
