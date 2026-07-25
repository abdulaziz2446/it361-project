<?php
$pageTitle = 'Register';
require 'includes/db.php';
$errors = [];
$success = '';
$fullName = '';
$studentId = '';
$email = '';
$phone = '';
$college = '';
$academicLevel = '';
$attendanceMode = '';
$selectedEvent = filter_input(INPUT_GET, 'event_id', FILTER_VALIDATE_INT);
$selectedEvent = $selectedEvent ?: '';
$colleges = ['College of Computing', 'College of Business', 'College of Engineering', 'College of Science', 'College of Health Sciences', 'College of Arts and Humanities', 'College of Design'];
$levels = ['First Year', 'Second Year', 'Third Year', 'Fourth Year', 'Fifth Year', 'Postgraduate'];
$modes = ['On campus', 'Online, when available', 'No preference'];
$events = [];
$r = mysqli_query($conn, "SELECT id,title,event_date FROM events ORDER BY event_date");
if ($r) {
    while ($row = mysqli_fetch_assoc($r)) {
        $events[] = $row;
    }
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullName = trim($_POST['full_name'] ?? '');
    $studentId = strtoupper(trim($_POST['student_id'] ?? ''));
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $college = trim($_POST['college'] ?? '');
    $academicLevel = trim($_POST['academic_level'] ?? '');
    $attendanceMode = trim($_POST['attendance_mode'] ?? '');
    $selectedEvent = filter_var($_POST['event_id'] ?? '', FILTER_VALIDATE_INT);
    if ($fullName === '' || mb_strlen($fullName) < 3 || mb_strlen($fullName) > 120) $errors[] = 'Enter a full name between 3 and 120 characters.';
    if (!preg_match('/^S?\d{9}$/', $studentId)) $errors[] = 'Enter a student ID with 9 digits and an optional S.';
    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || mb_strlen($email) > 120) {
        $errors[] = 'Enter a valid university email.';
    } else {
        $domain = strtolower(substr(strrchr($email, '@'), 1));
        if (substr($domain, -4) !== '.edu' && substr($domain, -7) !== '.edu.sa') $errors[] = 'Use a university email ending in .edu or .edu.sa.';
    }
    if (!preg_match('/^(05\d{8}|\+9665\d{8})$/', $phone)) $errors[] = 'Enter a Saudi mobile number such as 05XXXXXXXX or +9665XXXXXXXX.';
    if (!in_array($college, $colleges, true)) $errors[] = 'Choose a valid college.';
    if (!in_array($academicLevel, $levels, true)) $errors[] = 'Choose a valid academic level.';
    if (!in_array($attendanceMode, $modes, true)) $errors[] = 'Choose a valid attendance mode.';
    $eventName = '';
    if (!$selectedEvent || $selectedEvent < 1) {
        $errors[] = 'Choose a valid event.';
    } else {
        $s = mysqli_prepare($conn, "SELECT title,registration_deadline FROM events WHERE id=?");
        mysqli_stmt_bind_param($s, 'i', $selectedEvent);
        mysqli_stmt_execute($s);
        $cr = mysqli_stmt_get_result($s);
        $chosen = mysqli_fetch_assoc($cr);
        if (!$chosen) {
            $errors[] = 'The selected event does not exist.';
        } else {
            $eventName = $chosen['title'];
            if ($chosen['registration_deadline'] < date('Y-m-d')) $errors[] = 'Registration for this event has closed.';
        }
        mysqli_stmt_close($s);
    }
    if (empty($errors)) {
        $s = mysqli_prepare($conn, "INSERT INTO registrations(full_name,student_id,email,phone,college,academic_level,attendance_mode,event_id) VALUES(?,?,?,?,?,?,?,?)");
        mysqli_stmt_bind_param($s, 'sssssssi', $fullName, $studentId, $email, $phone, $college, $academicLevel, $attendanceMode, $selectedEvent);
        if (mysqli_stmt_execute($s)) {
            $success = 'Your registration for ' . $eventName . ' was saved successfully.';
            $fullName = $studentId = $email = $phone = $college = $academicLevel = $attendanceMode = $selectedEvent = '';
        } else {
            $errors[] = 'The registration could not be saved.';
        }
        mysqli_stmt_close($s);
    }
}
require 'includes/header.php'; ?>
<section class="page-title-band">
    <div class="page-width"><span class="record-label">Student registration file</span>
        <h1>Register for an activity</h1>
        <p>PHP checks the information before insertion.</p>
    </div>
</section>
<section class="content-section lavender-section">
    <div class="page-width">
        <div class="form-file"><?php if ($errors): ?><div class="feedback feedback-error"><strong>Please correct the following:</strong>
                    <ul><?php foreach ($errors as $error): ?><li><?php echo htmlspecialchars($error); ?></li><?php endforeach; ?></ul>
                </div><?php endif; ?><?php if ($success): ?><div class="feedback feedback-success"><?php echo htmlspecialchars($success); ?></div><?php endif; ?><form action="register.php" method="post" novalidate>
                <div class="form-columns">
                    <?php $fields = [['full_name', 'Full name', 'text', $fullName, '120'], ['student_id', 'Student ID', 'text', $studentId, '10'], ['email', 'University email', 'email', $email, '120'], ['phone', 'Saudi mobile number', 'tel', $phone, '14']];
                    foreach ($fields as $f): ?><div class="form-field"><label for="<?php echo $f[0]; ?>"><?php echo $f[1]; ?></label><input type="<?php echo $f[2]; ?>" id="<?php echo $f[0]; ?>" name="<?php echo $f[0]; ?>" maxlength="<?php echo $f[4]; ?>" required value="<?php echo htmlspecialchars($f[3]); ?>"></div><?php endforeach; ?>
                    <div class="form-field"><label for="college">College</label><select id="college" name="college" required>
                            <option value="">Choose a college</option><?php foreach ($colleges as $x): ?><option <?php echo $college === $x ? 'selected' : ''; ?>><?php echo htmlspecialchars($x); ?></option><?php endforeach; ?>
                        </select></div>
                    <div class="form-field"><label for="academic_level">Academic level</label><select id="academic_level" name="academic_level" required>
                            <option value="">Choose a level</option><?php foreach ($levels as $x): ?><option <?php echo $academicLevel === $x ? 'selected' : ''; ?>><?php echo htmlspecialchars($x); ?></option><?php endforeach; ?>
                        </select></div>
                    <div class="form-field"><label for="attendance_mode">Preferred attendance mode</label><select id="attendance_mode" name="attendance_mode" required>
                            <option value="">Choose a mode</option><?php foreach ($modes as $x): ?><option <?php echo $attendanceMode === $x ? 'selected' : ''; ?>><?php echo htmlspecialchars($x); ?></option><?php endforeach; ?>
                        </select></div>
                    <div class="form-field"><label for="event_id">Selected event</label><select id="event_id" name="event_id" required>
                            <option value="">Choose an event</option><?php foreach ($events as $event): ?><option value="<?php echo (int)$event['id']; ?>" <?php echo (string)$selectedEvent === (string)$event['id'] ? 'selected' : ''; ?>><?php echo htmlspecialchars($event['title'] . ' - ' . date('d M Y', strtotime($event['event_date']))); ?></option><?php endforeach; ?>
                        </select></div>
                </div><button class="action-button" type="submit">Save registration</button>
            </form>
        </div>
    </div>
</section><?php mysqli_close($conn);
            require 'includes/footer.php'; ?>