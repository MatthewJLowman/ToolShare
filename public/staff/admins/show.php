<?php require_once('../../../private/initialize.php'); ?>

<?php if($session->is_admin_logged_in()) { ?>
<?php

$id = $_GET['id'] ?? '1'; // PHP > 7.0
var_dump($id);
$admin = User::find_by_id($id);
var_dump($admin);
?>

<?php $page_title = 'Show Admin: ' . h($admin->name); ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/admins/index.php'); ?>">&laquo; Back to List</a>

  <div class="admin show">

    <h1>Admin: <?php echo h($admin->name); ?></h1>

    <div class="attributes">
      <dl>
        <dt>Email</dt>
        <dd><?php echo h($admin->email); ?></dd>
      </dl>
      <dl>
        <dt>Name</dt>
        <dd><?php echo h($admin->name); ?></dd>
      </dl>
    </div>

  </div>

</div>
<?php } else {
    redirect_to(url_for('../public/index.php'));
} ?>