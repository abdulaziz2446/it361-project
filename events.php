<?php $pageTitle = 'Events';
require 'includes/db.php';
$eventsResult = mysqli_query($conn, "SELECT * FROM events ORDER BY event_date,event_time");
require 'includes/header.php'; ?><section class="page-title-band">
    <div class="page-width"><span class="record-label">Complete archive</span>
        <h1>Campus event records</h1>
        <p>Review each date, category, location, and summary before opening the full record.</p>
    </div>
</section>
<section class="content-section">
    <div class="page-width"><?php if ($eventsResult && mysqli_num_rows($eventsResult) > 0): ?><div class="archive-event-list"><?php while ($event = mysqli_fetch_assoc($eventsResult)): ?><article class="archive-event">
                        <div class="reference-date"><strong><?php echo date('d', strtotime($event['event_date'])); ?></strong><span><?php echo date('M Y', strtotime($event['event_date'])); ?></span></div><img src="<?php echo htmlspecialchars($event['image']); ?>" alt="<?php echo htmlspecialchars($event['title']); ?>">
                        <div class="event-copy"><span class="category-tab"><?php echo htmlspecialchars($event['category']); ?></span>
                            <h2><?php echo htmlspecialchars($event['title']); ?></h2>
                            <p><?php echo htmlspecialchars($event['short_description']); ?></p>
                            <ul class="event-facts">
                                <li><strong>Time:</strong> <?php echo date('g:i A', strtotime($event['event_time'])); ?></li>
                                <li><strong>Location:</strong> <?php echo htmlspecialchars($event['location']); ?></li>
                            </ul><a class="action-button button-paper" href="event.php?id=<?php echo (int)$event['id']; ?>">Open event file</a>
                        </div>
                    </article><?php endwhile; ?></div><?php else: ?><div class="empty-record">
                <h2>No event records available</h2>
            </div><?php endif; ?></div>
</section><?php mysqli_close($conn);
            require 'includes/footer.php'; ?>