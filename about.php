<?php $pageTitle = 'About and Contact';
$errors = [];
$success = '';
$name = $email = $reason = $subject = $message = '';
$reasons = ['Event information', 'Registration support', 'Accessibility request', 'Activity suggestion', 'General feedback'];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $reason = trim($_POST['reason'] ?? '');
    $subject = trim($_POST['subject'] ?? '');
    $message = trim($_POST['message'] ?? '');
    if ($name === '' || mb_strlen($name) < 3 || mb_strlen($name) > 100) $errors[] = 'Enter a name between 3 and 100 characters.';
    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || mb_strlen($email) > 120) $errors[] = 'Enter a valid email.';
    if (!in_array($reason, $reasons, true)) $errors[] = 'Choose a valid contact reason.';
    if ($subject === '' || mb_strlen($subject) < 3 || mb_strlen($subject) > 120) $errors[] = 'Enter a subject between 3 and 120 characters.';
    if ($message === '' || mb_strlen($message) < 10 || mb_strlen($message) > 1000) $errors[] = 'Enter a message between 10 and 1000 characters.';
    if (!$errors) {
        $success = 'Your message passed server-side validation.';
        $name = $email = $reason = $subject = $message = '';
    }
}
require 'includes/header.php'; ?><section class="page-title-band">
    <div class="page-width"><span class="record-label">Center profile</span>
        <h1>About Mishkat</h1>
        <p>Mishkat Student Programs Center is a fictional Saudi university organization created for this project.</p>
    </div>
</section>
<section class="content-section">
    <div class="page-width about-columns">
        <section class="archive-paper">
            <h2>Center purpose</h2>
            <p>Mishkat coordinates student activities and records their dates, locations, audiences, and registration details.</p>
            <h2>Main goals</h2>
            <ul>
                <li>Keep event information clear.</li>
                <li>Support academic, cultural, professional, environmental, and wellbeing programs.</li>
                <li>Validate registration details before storage.</li>
            </ul>
            <h2>Project team</h2>
            <div class="team-records">
                <div class="team-record"><strong>Abdulaziz alsuriay</strong></div>
                <div class="team-record"><strong>Mohammed Alsubaie</strong></div>
                <div class="team-record"><strong>Ibrahim Alyahiwi</strong></div>
            </div>
        </section>
        <section class="archive-paper">
            <h2>Contact form</h2><?php if ($errors): ?><div class="feedback feedback-error">
                    <ul><?php foreach ($errors as $e): ?><li><?php echo htmlspecialchars($e); ?></li><?php endforeach; ?></ul>
                </div><?php endif; ?><?php if ($success): ?><div class="feedback feedback-success"><?php echo htmlspecialchars($success); ?></div><?php endif; ?><form action="about.php" method="post" novalidate>
                <div class="form-field"><label for="name">Name</label><input id="name" name="name" maxlength="100" required value="<?php echo htmlspecialchars($name); ?>"></div>
                <div class="form-field"><label for="email">Email</label><input type="email" id="email" name="email" maxlength="120" required value="<?php echo htmlspecialchars($email); ?>"></div>
                <div class="form-field"><label for="reason">Contact reason</label><select id="reason" name="reason" required>
                        <option value="">Choose a reason</option><?php foreach ($reasons as $x): ?><option <?php echo $reason === $x ? 'selected' : ''; ?>><?php echo htmlspecialchars($x); ?></option><?php endforeach; ?>
                    </select></div>
                <div class="form-field"><label for="subject">Subject</label><input id="subject" name="subject" maxlength="120" required value="<?php echo htmlspecialchars($subject); ?>"></div>
                <div class="form-field"><label for="message">Message</label><textarea id="message" name="message" maxlength="1000" required><?php echo htmlspecialchars($message); ?></textarea></div><button class="action-button" type="submit">Validate message</button>
            </form>
        </section>
    </div>
</section><?php require 'includes/footer.php'; ?>