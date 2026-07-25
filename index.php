<?php $pageTitle = 'Home';
require 'includes/db.php';
$featured = null;
$r = mysqli_query($conn, "SELECT * FROM events WHERE featured=1 ORDER BY event_date LIMIT 1");
if ($r) {
    $featured = mysqli_fetch_assoc($r);
}
$upcoming = mysqli_query($conn, "SELECT * FROM events WHERE event_date>=CURDATE() ORDER BY event_date,event_time LIMIT 3");
$sr = mysqli_query($conn, "SELECT COUNT(*) event_total,COUNT(DISTINCT category) category_total,COALESCE(SUM(available_seats),0) seat_total FROM events");
$stats = $sr ? mysqli_fetch_assoc($sr) : null;
require 'includes/header.php'; ?>
<section class="archive-hero">
    <div class="page-width hero-layout">
        <div class="hero-text">
            <p class="record-label">Student Programs Archive</p>
            <h1>Campus activities, filed clearly.</h1>
            <p>Mishkat Student Programs Center keeps event details, dates, locations, and registration information together in one simple university website.</p>
            <div class="button-row"><a class="action-button" href="events.php">Browse event records</a><a class="action-button button-paper" href="register.php">Open registration</a></div>
        </div>
        <aside class="hero-records">
            <div class="record-shadow"></div>
            <div class="record-middle"></div><?php if ($featured): ?><article class="feature-record"><img src="<?php echo htmlspecialchars($featured['image']); ?>" alt="<?php echo htmlspecialchars($featured['title']); ?>">
                    <div class="feature-copy"><span class="category-tab">Featured archive entry</span>
                        <h2><?php echo htmlspecialchars($featured['title']); ?></h2>
                        <p><?php echo htmlspecialchars($featured['short_description']); ?></p><a class="action-button button-olive" href="event.php?id=<?php echo (int)$featured['id']; ?>">Open entry</a>
                    </div>
                </article><?php endif; ?>
        </aside>
    </div>
</section>
<section class="content-section white-section">
    <div class="page-width">
        <div class="section-heading">
            <div>
                <p class="archive-code">FILE 01 / UPCOMING</p>
                <h2>Next three records</h2>
            </div><a class="action-button button-paper" href="events.php">View full archive</a>
        </div><?php if ($upcoming && mysqli_num_rows($upcoming) > 0): ?><div class="index-list"><?php while ($event = mysqli_fetch_assoc($upcoming)): ?><article class="index-entry">
                        <div class="reference-date"><strong><?php echo date('d', strtotime($event['event_date'])); ?></strong><span><?php echo date('M Y', strtotime($event['event_date'])); ?></span></div><img src="<?php echo htmlspecialchars($event['image']); ?>" alt="<?php echo htmlspecialchars($event['title']); ?>">
                        <div class="index-copy"><span class="category-tab"><?php echo htmlspecialchars($event['category']); ?></span>
                            <h3><?php echo htmlspecialchars($event['title']); ?></h3>
                            <p><?php echo htmlspecialchars($event['short_description']); ?></p><a class="action-button button-paper" href="event.php?id=<?php echo (int)$event['id']; ?>">Read record</a>
                        </div>
                    </article><?php endwhile; ?></div><?php else: ?><div class="empty-record">
                <h2>No upcoming records</h2>
            </div><?php endif; ?>
    </div>
</section>
<section class="content-section lavender-section">
    <div class="page-width">
        <div class="section-heading">
            <div>
                <p class="archive-code">FILE 02 / AREAS</p>
                <h2>Program areas</h2>
            </div>
        </div>
        <div class="activity-files">
            <article class="activity-file">
                <h3>Academic Support</h3>
                <p>Research, documentation, study routines, and portfolio review.</p>
            </article>
            <article class="activity-file">
                <h3>Digital Skills</h3>
                <p>GIS, privacy, Git, and educational media.</p>
            </article>
            <article class="activity-file">
                <h3>Culture and Community</h3>
                <p>Theatre, local history, manuscripts, and community research.</p>
            </article>
            <article class="activity-file">
                <h3>Wellbeing and Environment</h3>
                <p>Walking routes, healthy routines, and sustainability.</p>
            </article>
        </div>
    </div>
</section>
<section class="content-section">
    <div class="page-width">
        <div class="statistics-ribbon">
            <div class="stat-cell"><strong><?php echo $stats ? (int)$stats['event_total'] : 0; ?></strong><span>Event records</span></div>
            <div class="stat-cell"><strong><?php echo $stats ? (int)$stats['category_total'] : 0; ?></strong><span>Categories</span></div>
            <div class="stat-cell"><strong><?php echo $stats ? (int)$stats['seat_total'] : 0; ?></strong><span>Available seats</span></div>
        </div>
    </div>
</section><?php mysqli_close($conn);
            require 'includes/footer.php'; ?>