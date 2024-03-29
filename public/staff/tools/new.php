<?php

require_once('../../../private/initialize.php');

require_login();

if(is_post_request()) {

  // Create record using post parameters
  $args = $_POST['tool'];
  $args['availability'] = 'available';
  $tool = new Tool($args);
  $result = $tool->save();

  if($result === true) {
    $new_id = $tool->tool_id;
    $session->message('The tool was created successfully.');
    redirect_to(url_for('/staff/tools/show.php?id=' . $new_id));
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

  <a class="back-link" href="<?php echo url_for('/staff/tools/index.php'); ?>">&laquo; Back to List</a>

  <div class="bicycle new">
    <h1>Create Tool</h1>

    <?php echo display_errors($tool->errors); ?>

    <form action="<?php echo url_for('/staff/tools/new.php'); ?>" method="post">

      <?php include('form_fields.php'); ?>

      <div id="operations">
        <input type="submit" value="Create Tool" />
      </div>
    </form>

  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
