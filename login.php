<?php
require_once('private/initialize.php');
session_start();

$errors = [];
$username = '';
$password = '';

if(is_post_request()) {

  $username = $_POST['username'] ?? '';
  $password = $_POST['password'] ?? '';

  // Validations
  if(is_blank($username)) {
    $errors[] = "Username cannot be blank.";
  }
  if(is_blank($password)) {
    $errors[] = "Password cannot be blank.";
  }

  // if there were no errors, try to login
  if(empty($errors)) {
    $member = User::find_by_name($username);
    // test if admin found and password is correct
    if($member != false && $member->verify_password($password)) {
      // Mark admin as logged in
      $session->login($member);
      redirect_to('index.php');
    } else {
      // username not found or password does not match
      $errors[] = "Log in was unsuccessful.";
    }

  }

}

?>

<?php $page_title = 'Log in'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">
  <h1>Log in</h1>

  <?php echo display_errors($errors); ?>

  <form action="login.php" method="post">
    Username:<br />
    <input type="text" name="username" value="<?php echo h($username); ?>" /><br />
    Password:<br />
    <input type="password" name="password" value="<?php echo h($password); ?>" /><br />
    <input type="submit" name="submit" value="Log In"  />
  </form>
  <div id="signup">
    <p>Don't have an account?</p>
    <a href="signup.php">Sign Up!</a>
  </div>
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
