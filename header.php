<?php
if(!isset($pageTitle)){$pageTitle='Campus Events Hub';}
$currentPage=basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title><?php echo htmlspecialchars($pageTitle); ?> | Campus Events Hub</title><link rel="stylesheet" href="css/style.css"></head><body>
<div class="info-strip"><div class="page-width strip-content"><span>Mishkat Student Programs Center</span><span>University activities and student registration</span></div></div>
<header class="site-header"><div class="page-width identity-row"><a class="archive-logo" href="index.php"><span class="folder-mark">M</span><span class="logo-copy"><strong>Mishkat Student Programs Center</strong><small>Campus Events Hub</small></span></a></div><div class="navigation-row"><nav class="page-width main-navigation" aria-label="Main navigation">
<a class="<?php echo $currentPage==='index.php'?'current':''; ?>" href="index.php">Home</a><a class="<?php echo in_array($currentPage,['events.php','event.php'],true)?'current':''; ?>" href="events.php">Events</a><a class="<?php echo $currentPage==='register.php'?'current':''; ?>" href="register.php">Register</a><a class="<?php echo $currentPage==='registrations.php'?'current':''; ?>" href="registrations.php">Registrations</a><a class="<?php echo $currentPage==='about.php'?'current':''; ?>" href="about.php">About</a>
</nav></div></header><main>
