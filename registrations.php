<?php $pageTitle = 'Registrations';
require 'includes/db.php';
$r = mysqli_query($conn, "SELECT registrations.*,events.title event_title FROM registrations INNER JOIN events ON registrations.event_id=events.id ORDER BY registration_date DESC");
require 'includes/header.php'; ?><section class="page-title-band">
    <div class="page-width"><span class="record-label">Database register</span>
        <h1>Stored student registrations</h1>
    </div>
</section>
<section class="content-section">
    <div class="page-width"><?php if ($r && mysqli_num_rows($r) > 0): ?><div class="table-scroll">
                <table>
                    <thead>
                        <tr>
                            <th>Student Name</th>
                            <th>Student ID</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>College</th>
                            <th>Academic Level</th>
                            <th>Attendance Mode</th>
                            <th>Event</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody><?php while ($x = mysqli_fetch_assoc($r)): ?><tr>
                                <td><?php echo htmlspecialchars($x['full_name']); ?></td>
                                <td><?php echo htmlspecialchars($x['student_id']); ?></td>
                                <td><?php echo htmlspecialchars($x['email']); ?></td>
                                <td><?php echo htmlspecialchars($x['phone']); ?></td>
                                <td><?php echo htmlspecialchars($x['college']); ?></td>
                                <td><?php echo htmlspecialchars($x['academic_level']); ?></td>
                                <td><?php echo htmlspecialchars($x['attendance_mode']); ?></td>
                                <td class="event-column"><?php echo htmlspecialchars($x['event_title']); ?></td>
                                <td><?php echo date('d M Y, g:i A', strtotime($x['registration_date'])); ?></td>
                            </tr><?php endwhile; ?></tbody>
                </table>
            </div><?php else: ?><div class="empty-record">
                <h2>No registration records</h2><a class="action-button" href="register.php">Open registration</a>
            </div><?php endif; ?></div>
</section><?php mysqli_close($conn);
            require 'includes/footer.php'; ?>