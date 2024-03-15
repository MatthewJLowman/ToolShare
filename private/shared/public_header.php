<!doctype html>

<html lang="en">
  <head>
    <title>Tool Share <?php if(isset($page_title)) { echo '- ' . h($page_title); } ?></title>
    <meta charset="utf-8">
    <link rel="stylesheet" media="all" href="<?php echo url_for('/stylesheets/public.css'); ?>" />
  </head>

  <body>

    <header>
      <h1>
        <img src="../../public/images/11971260562074209608alst_hammer.svg.hi.png">
        <a href="<?php echo url_for('../public/index.php'); ?>">
          Tool Share
        </a>
        <img src="../../public/images/saw-hi.png">
      </h1>
      <?php if($session->is_logged_in()) { ?>
        <li><a href="<?php echo url_for('../public/index.php'); ?>">Menu</a></li>
        <li><a href="<?php echo url_for('/staff/logout.php'); ?>">Log Out, <?php echo $session->name; ?></a></li>
      <?php } else { ?>
        <li><a href="<?php echo url_for('/staff/login.php'); ?>">Log In</a></li>
        <li><a href="<?php echo url_for('/staff/signup.php'); ?>">Sign Up</a></li>
      <?php } ?>
    </header>
