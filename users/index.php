<?php require_once('../private/initialize.php'); ?>

<?php
// Find all admins
$admins = User::find_all();
?>
<?php if($session->is_admin_logged_in()) { ?>
<?php $page_title = 'Admins'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>
<div id="content">
  <div class="admins listing">
    <h1>Admins</h1>

    <div class="actions">
      <a class="action" href="<?php echo url_for('/staff/admins/new.php'); ?>">Add Admin</a>
    </div>

  	<table class="list">
      <?php foreach($admins as $admin) { ?>
        <tr>
          <td><?php echo h($admin->email); ?></td>
          <td><?php echo h($admin->name); ?></td>
          <td><a class="action" href="<?php echo url_for('show.php?id=' . h(u($admin->id))); ?>">View</a></td>
          <td><a class="action" href="<?php echo url_for('edit.php?id=' . h(u($admin->id))); ?>">Edit</a></td>
          <td><a class="action" href="<?php echo url_for('delete.php?id=' . h(u($admin->id))); ?>">Delete</a></td>
    	  </tr>
      <?php } ?>
  	</table>

  </div>

</div>
<?php } else {
  redirect_to(url_for('../index.php'));
}
?>
<?php include(SHARED_PATH . '/staff_footer.php'); ?>
