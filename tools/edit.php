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
if($tool == false) {
}

if(is_post_request()) {

  // Save record using post parameters
  $args = $_POST['tool'];
  $tool->merge_attributes($args);
  $result = $tool->save();

  if($result === true) {
    $session->message('The tool was updated successfully.');
    redirect_to(url_for('show.php?id=' . $id));
  } else {
    // show errors
  }

} else {

  // display the form

}

?>

<?php $page_title = 'Edit tool'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="index.php">&laquo; Back to List</a>

  <div class="bicycle edit">
    <h1>Edit Tool</h1>

    <?php echo display_errors($tool->errors); ?>

    <form action="<?php echo url_for('edit.php?id=' . h(u($id))); ?>" method="post">

      <?php include('form_fields.php'); ?>

      <div id="operations">
        <input type="submit" value="Edit Tool" />
      </div>
    </form>

  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
