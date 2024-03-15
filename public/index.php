<?php require_once('../private/initialize.php'); ?>
<?php include(SHARED_PATH . '/public_header.php'); ?>
<div id="main">

  <ul id="menu">
    <li>
      <a href="<?php echo url_for('/staff/tools/index.php'); ?>">
        <h3>Borrow</h3>
        <p>Access our inventory of tools submitted by users like you</p>
      </a>
      
    </li>
    <li>
      <a href="<?php echo url_for('staff/tools/new.php'); ?>">
      <h3>Lend</h3>
      <p>Contribute a tool to our inventory that can be borrowed by another user</p>
      </a>
    </li>

    <?php if($session->is_admin_logged_in()) { ?>
      <li><a href="<?php echo url_for('/staff/admins/index.php'); ?>">Super Secret Admin Page</a></li>
    <?php } ?>

  </ul>
    
</div>

<?php include(SHARED_PATH . '/public_footer.php'); ?>
