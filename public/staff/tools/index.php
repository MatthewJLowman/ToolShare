<?php require_once('../../../private/initialize.php'); ?>
<?php
// Find all bicycles;
$tools = Tool::find_all();
?>
<?php $page_title = 'Tools'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">
  <div class="bicycles listing">
    <h1>Tools</h1>
    <form action="search.php" method="GET">
		<input type="text" name="query"/>
		<input type="submit" value="Search"/>
	</form>
    <div class="actions">
      <a class="action" href="<?php echo url_for('/staff/tools/new.php'); ?>">Add Tool</a>
    </div>

  	<table class="list">
      <tr>
        <th>Image</th>
        <th>Name</th>
        <th>Description</th>
        <th>Availability</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
      </tr>

      <?php foreach($tools as $tool) { ?>
        <tr>
          <td><?php echo h($tool->image); ?></td>
          <td><?php echo h($tool->tool_name); ?></td>
          <td><?php echo h($tool->description); ?></td>
          <td><?php echo h($tool->availability); ?></td>
          <td><a class="action" href="<?php echo url_for('/staff/tools/show.php?id=' . h(u($tool->id))); ?>">View</a></td>
          <td><a class="action" href="<?php echo url_for('/staff/tools/edit.php?id=' . h(u($tool->id))); ?>">Edit</a></td>
          <td><a class="action" href="<?php echo url_for('/staff/tools/delete.php?id=' . h(u($tool->id))); ?>">Delete</a></td>
    	  </tr>
      <?php } ?>
  	</table>

  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
