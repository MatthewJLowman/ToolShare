<?php

require_once('../private/initialize.php');

if($session->is_admin_logged_in()) {

if(!isset($_GET['id'])) {
  redirect_to(url_for('index.php'));
}
$id = $_GET['id'];
$member = User::find_by_id($id);
if($member == false) {
  redirect_to(url_for('index.php'));
}

if(is_post_request()) {

  // Delete admin
  $result = $member->delete();
  $session->message('The admin was deleted successfully.');
  redirect_to(url_for('index.php'));

} else {
  // Display form
}

?>

<?php $page_title = 'Delete Admin'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/index.php'); ?>">&laquo; Back to List</a>

  <div class="admin delete">
    <h1>Delete User</h1>
    <p>Are you sure you want to delete this user?</p>
    <p class="item"><?php echo h($user->name()); ?></p>

    <form action="<?php echo url_for('/users/delete.php?id=' . h(u($id))); ?>" method="post">
      <div id="operations">
        <input type="submit" name="commit" value="Delete Admin" />
      </div>
    </form>
  </div>

</div>
<?php } else {
    redirect_to(url_for('../index.php'));
} ?>
<?php include(SHARED_PATH . '/staff_footer.php'); ?>
