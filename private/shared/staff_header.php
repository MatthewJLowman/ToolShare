<?php
  if(!isset($page_title)) { $page_title = 'Staff Area'; }
?>

<!doctype html>

<html lang="en">
  <head>
    <title>Tool Share - <?php echo h($page_title); ?></title>
    <meta charset="utf-8">
    <link rel="stylesheet" media="all" href="<?php echo url_for('/stylesheets/staff.css'); ?>" />
  </head>

  <body>
    <header>
      <h1>Tool Share</h1>
    </header>

    <navigation>
      <ul>
        <?php if($session->is_logged_in()) { ?>
        <li>User: <?php echo $session->name; ?></li>
        <li><a href="<?php echo url_for('../public/index.php'); ?>">Menu</a></li>
        <li><a href="<?php echo url_for('/staff/logout.php'); ?>">Log Out</a></li>
      <?php } else { ?>
        <li><a href="<?php echo url_for('/staff/login.php'); ?>">Log In</a></li>
        <li><a href="<?php echo url_for('/staff/signup.php'); ?>">Sign Up</a></li>
      <?php } ?>
      </ul>
    </navigation>

    <?php echo display_session_message(); ?>
