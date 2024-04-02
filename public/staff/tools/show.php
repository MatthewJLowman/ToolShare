<?php require_once('../../../private/initialize.php'); ?>
<?php require_login(); ?>
<?php

$id = $_GET['id'] ?? '1'; // PHP > 7.0
$tool = Tool::find_by_id($id);

?>

<?php $page_title = 'Show Tool: ' . h($tool->tool_name); ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/tools/index.php'); ?>">&laquo; Back to List</a>

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

  </div>

</div>
