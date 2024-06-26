<?php require_once('../private/initialize.php'); ?>
<?php

$id = $_GET['id'] ?? '1'; // PHP > 7.0
$tool = Tool::find_by_id($id);
$transactions = Transaction::find_all();
$user_id = $session->user_id;
foreach ($transactions as $transaction) {
  if ($transaction->tool_id == $tool->id) {
    $this_transaction = $transaction;
  }
}
if(is_post_request()) {
  if ($session->is_logged_in() == false) {
    require_login();
  }
  // Save record using post parameters
  $args = $_POST['tool'];
  $tool->merge_attributes($args);
  $result = $tool->save();
  if($result === true) {
    if ($this_transaction->borrower_id == $user_id) {
      $tool->availability = 'available';
      $tool->save();
      $this_transaction->borrower_id = $this_transaction->lender_id;
      $this_transaction->save();
      $session->message('You have returned this tool!');
    } else {
      $tool->availability = 'in use';
      $tool->save();
      $this_transaction->borrower_id = $user_id;
      $this_transaction->save();
      $session->message('You have borrowed this tool!');
    }
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
  <?php if (isset($_SESSION['tools_redirect'])) { ?>
    <a class="back-link" href="<?php echo $_SESSION['tools_redirect']; ?>">&laquo; Back to List</a>
  <?php } else { ?>
    <a class="back-link" href="index.php">&laquo; Back to List</a>
  <?php } ?>
  

  <div class="bicycle show">

    <h1>Tool: <?php echo h($tool->tool_name); ?></h1>

    <div class="attributes">
      <?php if (!is_blank($tool->image)) { ?>
       <img src="../../images/<?php echo $tool->image; ?>" alt='<?php echo $tool->tool_name; ?>' width='128' height='128'>
      <?php } ?>
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
    <?php if ($user_id !== $this_transaction->lender_id) { ?>
      <form action="<?php echo url_for('show.php?id=' . h(u($id))); ?>" method="post">
        <div id="operations">
          <?php if ($this_transaction->borrower_id == $user_id) { ?>
            <input type="submit" value="Return Tool" />
          <?php } elseif ($this_transaction->borrower_id !== $user_id && $this_transaction->borrower_id !== $this_transaction->lender_id) { ?>
            
          <?php } else { ?>
            <input type="submit" value="Borrow Tool" />
          <?php } ?>
        </div>
      </form>
    <?php } ?>
    
    
  </div>

</div>
