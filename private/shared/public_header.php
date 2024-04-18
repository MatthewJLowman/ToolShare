<!doctype html>

<html lang="en">
  <head>
    <title>Tool Share <?php if(isset($page_title)) { echo '- ' . h($page_title); } ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" media="all" href="<?php echo url_for('../../stylesheets/public.css'); ?>" />
  </head>

  <body>

    <header>
      <h1>
        <img src="/images/11971260562074209608alst_hammer.svg.hi.png" alt="hammer">
        <a href="<?php echo url_for('../index.php'); ?>">
          Tool Share
        </a>
        <img src="/images/saw-hi.png" alt="saw">
      </h1>
      
      <?php if($session->is_logged_in()) { ?>
        <li><a href="<?php echo url_for('../../index.php'); ?>">Home</a></li>
        <li><a href="<?php echo url_for('../../mytools.php'); ?>">My Tools</a></li>
        <li><a href="<?php echo url_for('../../logout.php'); ?>">Log Out, <?php echo $session->name; ?></a></li>
      <?php } else { ?>
        <li><a href="<?php echo url_for('../../login.php'); ?>">Log In</a></li>
      <?php } ?>
    </header>
