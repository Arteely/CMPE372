<?php
    $query = mysqli_query($db_cxn, "SELECT * FROM announcements");
    $announcements = mysqli_fetch_all($query, MYSQLI_ASSOC);
?>

<script>
    let announcements = <?php echo json_encode($announcements); ?>;
    announcements = announcements.map(a => {
        a['description'] = a['description'].split('\n');
        return a;
    });
    var side = null;
    var side_heading = null;
    var side_title = null;
    var side_from = null;
    var side_date = null;

    function gotoAnnouncement(a) {
        let announcement = announcements[a];
        side.css('visibility', 'visible');
        side_title.text(announcement['title']);
        side_from.text(`From: ${announcement['created_by']}`);
        side_date.text(`Date: ${announcement['dated']}`);
        side_heading.children('p').remove();
        announcement['description'].forEach((value, _) => {
            let tmp = $("<p></p>").text(value);
            side_heading.append(tmp);
        });
    }

    $(document).ready(() => {
        side = $("[data-an-side]");
        side_heading = $("[data-an-side-heading]");
        side_title = $("[data-an-side-title]");
        side_from = $("[data-an-side-from]");
        side_date = $("[data-an-side-date]");
        $("[data-an-link]").click((e) => {
            gotoAnnouncement($(e.currentTarget).attr('data-an-link'));
        })
    });

</script>

<div class="course-container">
    <div class="course-intro">
        <span class="greet-title-text">Announcements</span>
        <span class="greet-text">Most recent notifications and messages.</span>
    </div>
    <hr>
    <div class="announcement-section">
        <div class="announcement-container">
            <div class="announcement-header">
                <span class="an-head">Announcement</span>
                <span class="an-rest">Created By</span>
                <span class="an-rest">Date</span>
            </div>
            <div class="announcements">
                <?php foreach($announcements as $k=>$a): ?>
                <div class="announcement">
                    <?php echo "<a class='an-head' href='#' data-an-link=$k>{$a['title']}</a>"; ?>
                    <span class="an-rest"><?php echo $a['created_by']; ?></span>
                    <span class="an-rest"><?php echo $a['dated']; ?></span>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="announcement-side" style="visibility: hidden;" data-an-side>
            <div class="announcement-heading" data-an-side-heading>
                <span class="greet-title-text" data-an-side-title></span><br>
                <span class="greet-text" data-an-side-from></span><br>
                <span class="greet-text" data-an-side-date></span>
            </div>
        </div>
    </div>
</div>
