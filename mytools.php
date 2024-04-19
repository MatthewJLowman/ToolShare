<?php require_once('private/initialize.php'); ?>
<?php
// Find all bicycles;
$tools = Tool::find_all();
$transactions = Transaction::find_all();
?>
<?php $page_title = 'Tools'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">
  <div class="bicycles listing">
    <h1>Lent Tools</h1>
    
    <div class="actions">
      <a class="action" href="new.php">Add Tool</a>
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
      <?php 
        $user_id = $session->user_id;
        foreach($tools as $tool) { 
          foreach($transactions as $transaction) {
            $this_transaction = $transaction->tool_id; 
      ?>
            <?php if ($this_transaction == $tool->id) { ?>
              <?php if ($transaction->lender_id == $user_id) { ?>
                <tr>
                  <td><?php echo h($tool->image); ?></td>
                  <td><?php echo h($tool->tool_name); ?></td>
                  <td><?php echo h($tool->description); ?></td>
                  <td><?php echo h($tool->availability); ?></td>
                  <td><a class="action" href="<?php echo url_for('../tools/show.php?id=' . h(u($tool->id))); ?>">View</a></td>
                  <td><a class="action" href="<?php echo url_for('../tools/edit.php?id=' . h(u($tool->id))); ?>">Edit</a></td>
                  <td><a class="action" href="<?php echo url_for('../tools/delete.php?id=' . h(u($tool->id))); ?>">Delete</a></td>
                </tr>
              <?php } ?>
            <?php } ?>
          <?php } ?>
        <?php } ?>
  	</table>

    <h1>Borrowed Tools</h1>
    
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
      <?php 
        $user_id = $session->user_id;
        foreach($tools as $tool) { 
          foreach($transactions as $transaction) {
            $this_transaction = $transaction->tool_id; 
      ?>
            <?php if ($this_transaction == $tool->id) { ?>
              <?php if ($transaction->borrower_id == $user_id) { ?>
                <tr>
                  <td><?php echo h($tool->image); ?></td>
                  <td><?php echo h($tool->tool_name); ?></td>
                  <td><?php echo h($tool->description); ?></td>
                  <td><?php echo h($tool->availability); ?></td>
                  <td><a class="action" href="<?php echo url_for('../tools/show.php?id=' . h(u($tool->id))); ?>">View</a></td>
                  <td><a class="action" href="<?php echo url_for('../tools/edit.php?id=' . h(u($tool->id))); ?>">Edit</a></td>
                  <td><a class="action" href="<?php echo url_for('../tools/delete.php?id=' . h(u($tool->id))); ?>">Delete</a></td>
                </tr>
              <?php } ?>
            <?php } ?>
          <?php } ?>
        <?php } ?>
  	</table>

  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
