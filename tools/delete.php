<?php

require_once('../private/initialize.php');

require_login();
if(!isset($_GET['id'])) {
  redirect_to(url_for('index.php'));
}
$id = $_GET['id'];
$tool = Tool::find_by_id($id);
$transactions = Transaction::find_all();
$user_id = $session->user_id;
foreach ($transactions as $transaction) {
  if ($transaction->tool_id == $tool->id) {
    $this_transaction = $transaction;
  }
}
if ($user_id !== $this_transaction->lender_id) {
  redirect_to(url_for('index.php'));
}
foreach ($transactions as $transaction) {
  if ($transaction->tool_id == $tool->id) {
    $this_transaction = $transaction;
  }
}
if($tool == false) {
  redirect_to(url_for('index.php'));
}

if(is_post_request()) {

  // Delete bicycle
  $this_transaction->delete();
  $result = $tool->delete();
  $session->message('The tool was deleted successfully.');
  redirect_to(url_for('index.php'));

} else {
  // Display form
}

?>

<?php $page_title = 'Delete Tool'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="index.php">&laquo; Back to List</a>

  <div class="bicycle delete">
    <h1>Delete Tool</h1>
    <p>Are you sure you want to delete this tool?</p>
    <p class="item"><?php echo h($tool->tool_name); ?></p>

    <form action="<?php echo url_for('delete.php?id=' . h(u($id))); ?>" method="post">
      <div id="operations">
        <input type="submit" name="commit" value="Delete Tool" />
      </div>
    </form>
  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
