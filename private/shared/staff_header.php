<?php
  if(!isset($page_title)) { $page_title = 'Staff Area'; }
?>

<!doctype html>

<html lang="en">
  <head>
    <title>Tool Share - <?php echo h($page_title); ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" media="all" href="<?php echo url_for('../../stylesheets/staff.css'); ?>" />
  </head>

  <body>
    <header>
      <h1>Tool Share</h1>
    </header>

    <navigation>
      <ul>
        <?php if($session->is_logged_in()) { ?>
          <li><a href="../../index.php">Home</a></li>
          <li><a href="../../mytools.php">My Tools</a></li>
          <li><a href="../../logout.php">Log Out, <?php echo $session->name; ?></a></li>
        <?php } else { ?>
          <li><a href="/login.php">Log In</a></li>
        <?php } ?>
      </ul>
    </navigation>

    <?php echo display_session_message(); ?>
