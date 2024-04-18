<?php

require_once('../private/initialize.php');

require_login();

if(is_post_request()) {

  // Create record using post parameters
  $args = $_POST['tool'];
  $args['availability'] = 'available';
  $user_id = $session->user_id;
  $tool = new Tool($args);
  $result = $tool->save();
  
  if($result === true) {
    $transaction = new Transaction();
    $transaction->tool_id = $tool->id;
    $transaction->borrower_id = $user_id;
    $transaction->lender_id = $user_id;

    $transaction_result = $transaction->save();
    if ($transaction_result === true) {
        // Both Tool and Transaction created successfully
        $new_id = $tool->id;
        $session->message('The tool was created successfully.');
        redirect_to(url_for('show.php?id=' . $new_id));
      } else {
          // Transaction creation failed, handle the error
          $session->message('Failed to create a transaction for the tool.');
      }
  } else {
    // show errors
  }

} else {
  // display the form
  $tool = new Tool;
}

?>

<?php $page_title = 'Create Tool'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="index.php">&laquo; Back to List</a>

  <div class="bicycle new">
    <h1>Create Tool</h1>

    <?php echo display_errors($tool->errors); ?>

    <form action="<?php echo url_for('new.php'); ?>" method="post">

      <?php include('form_fields.php'); ?>

      <div id="operations">
        <input type="submit" value="Create Tool" />
      </div>
    </form>

  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
