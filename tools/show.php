<?php require_once('../private/initialize.php'); ?>
<?php require_login(); ?>
<?php

$id = $_GET['id'] ?? '1'; // PHP > 7.0
$tool = Tool::find_by_id($id);
$transactions = Transaction::find_all();
$user_id = $session->user_id;
if(is_post_request()) {

  // Save record using post parameters
  $args = $_POST['tool'];
  $tool->merge_attributes($args);
  $result = $tool->save();
  if($result === true) {
    $tool->availability = 'in use';
    $tool->save();
    foreach ($transactions as $transaction) {
      $this_transaction = $transaction->tool_id;
      if ($this_transaction == $tool->id) {
        $transaction->borrower_id = $user_id;
        $transaction->save();
      }
    }
    $session->message('The tool was updated successfully!');
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
    <form action="<?php echo url_for('show.php?id=' . h(u($id))); ?>" method="post">
      <div id="operations">
        <input type="submit" value="Borrow Tool" />
      </div>
    </form>
  </div>

</div>
