<?php

require_once('../../../private/initialize.php');

require_login();

if(!isset($_GET['id'])) {
  redirect_to(url_for('/staff/tools/index.php'));
}
$id = $_GET['id'];
$tool = Tool::find_by_id($id);
if($tool == false) {
  redirect_to(url_for('/staff/tools/index.php'));
}

if(is_post_request()) {

  // Save record using post parameters
  $args = $_POST['tool'];
  $tool->merge_attributes($args);
  $result = $tool->save();

  if($result === true) {
    $session->message('The tool was updated successfully.');
    redirect_to(url_for('/staff/tools/show.php?id=' . $id));
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

  <a class="back-link" href="<?php echo url_for('/staff/tools/index.php'); ?>">&laquo; Back to List</a>

  <div class="bicycle edit">
    <h1>Edit Tool</h1>

    <?php echo display_errors($tool->errors); ?>

    <form action="<?php echo url_for('/staff/tools/edit.php?id=' . h(u($id))); ?>" method="post">

      <?php include('form_fields.php'); ?>

      <div id="operations">
        <input type="submit" value="Edit Tool" />
      </div>
    </form>

  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
