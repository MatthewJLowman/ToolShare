<?php require_once('../private/initialize.php'); ?>
<?php require_login(); ?>
<?php

$id = $_GET['id'] ?? '1'; // PHP > 7.0
$tool = Tool::find_by_id($id);
$user_id = $session->user_id;
if(is_post_request()) {

  // Save record using post parameters
  $id = $_POST['id'] ??  '1';
  $args = Tool::find_by_id($id);
  $tool->merge_attributes($args);
  $result = $tool->save();
  if($result == true) {
    $args['availability'] = 'in use';
    $transaction = Transaction::find_by_id($id);
    $transaction->borrower_id = $user_id;
    $session->message('The tool was updated successfully.');
    redirect_to(url_for('show.php?id=' . $id));
  } else {
    // show errors
  }

} else {

  // display the form

}
?>

<?php $page_title = 'Show Tool: ' . h($tool->tool_name); ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="index.php">&laquo; Back to List</a>

  <div class="bicycle show">

    <h1>Tool: <?php echo h($tool->tool_name); ?></h1>

    <div class="attributes">
      <dl>
        <dt>Name</dt>
        <dd><?php echo h($tool->tool_name); ?></dd>
      </dl>
      <dl>
        <dt>Description</dt>
        <dd><?php echo h($tool->description); ?></dd>
      </dl>
      <dl>
        <dt>Availability</dt>
        <dd><?php echo h($tool->availability); ?></dd>
      </dl>
    </div>
    <form action="show.php" method="post">
      <input type="hidden" name="id" value="<?php echo($id) ?>" />
      <div id="operations">
        <input type="submit" value="Borrow Tool" />
      </div>
    </form>
  </div>

</div>
