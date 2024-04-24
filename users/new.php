<?php

require_once('../private/initialize.php');

if($session->is_admin_logged_in()) {
if(is_post_request()) {

  // Create record using post parameters
  $args = $_POST['admin'];
  $admin = new User($args);
  $result = $admin->save();

  if($result === true) {
    $new_id = $admin->id;
    $session->message('The admin was created successfully.');
    redirect_to(url_for('show.php?id=' . $new_id));
  } else {
    // show errors
  }

} else {
  // display the form
  $admin = new User;
}

?>

<?php $page_title = 'Create Admin'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('index.php'); ?>">&laquo; Back to List</a>

  <div class="admin new">
    <h1>Create Admin</h1>

    <?php echo display_errors($admin->errors); ?>

    <form action="<?php echo url_for('new.php'); ?>" method="post">

      <?php include('form_fields.php'); ?>

      <div id="operations">
        <input type="submit" value="Create Admin" />
      </div>
    </form>

  </div>

</div>
<?php } else {
    redirect_to(url_for('../public/index.php'));
} ?>
<?php include(SHARED_PATH . '/staff_footer.php'); ?>
