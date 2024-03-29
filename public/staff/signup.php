<?php

require_once('../../private/initialize.php');

if(is_post_request()) {
  // Create record using post parameters
  $args = $_POST['user'];
  $user = new User($args);
  $user->is_admin = 0;
  $result = $user->save();

  if($result === true) {
    $new_id = $user->id;
    $session->message("You've signed up successfully.");
    $session->login($user);
    redirect_to(url_for('../public/index.php'));
  } else {
    // show errors
  }

} else {
  // display the form
  $user = new User;
}

?>
<?php $page_title = 'Sign Up for Membership'; ?>
<?php include(SHARED_PATH . '/public_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('index.php'); ?>">&laquo; Back to Menu</a>

  <div class="member new">
    <h1>Create User</h1>

    <?php echo display_errors($user->errors); ?>

    <form action="<?php echo url_for('staff/signup.php'); ?>" method="post">

      <?php include('admins/form_fields.php'); ?>

      <div id="operations">
        <input type="submit" value="Sign Up" />
      </div>
    </form>

  </div>

</div>

<?php include(SHARED_PATH . '/public_footer.php'); ?>