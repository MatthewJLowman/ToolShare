<?php require_once('../private/initialize.php'); ?>
<?php
// Find all bicycles;

$tools = Tool::find_all();
$transactions = Transaction::find_all();
$user_id = $session->user_id;
$_SESSION['tools_redirect'] = $_SERVER['REQUEST_URI'];
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
      <a class="action" href="new.php">Add Tool</a>
    </div>

  	<table class="list">
      <div id="maintools"
        <?php foreach($tools as $tool) { ?>
          <?php if ($tool->availability == 'available') { ?>
          <tr>
          <?php } else  { ?>
          <tr id='inuse'>
          <?php } ?>
          <td><a href="<?php echo url_for('show.php?id=' . h(u($tool->id))); ?>">
            <?php if (!is_blank($tool->image)) { ?>
            <img src="../../images/<?php echo $tool->image; ?>" alt='<?php echo $tool->tool_name; ?>' width='64' height='64'>
            <?php } ?>
            <div id='toolinfo'>
            <h3><?php echo h($tool->tool_name); ?></h3>
            <?php
              $truncated_description = truncate_description($tool->description, 45);
              echo h($truncated_description);
            ?>
            </div>
          </a></td>
          
          <?php
          $id = $_GET['id'] ?? '1'; // PHP > 7.0
            foreach ($transactions as $transaction) {
              if ($transaction->tool_id == $tool->id) {
                $this_transaction = $transaction;
              }
            }
            ?>
            <?php if ($session->is_logged_in() == true) { ?>
              <?php if ($user_id !== $this_transaction->lender_id) { ?>
                <form action="<?php echo url_for('show.php?id=' . h(u($tool->id))); ?>" method="post">
                  <div id="operations">
                    <?php if ($this_transaction->borrower_id == $user_id) { ?>
                      <td id='borrow'><input type="submit" value="Return Tool" /></td>
                    <?php } elseif ($this_transaction->borrower_id !== $user_id && $this_transaction->borrower_id !== $this_transaction->lender_id) { ?>
              
                    <?php } else { ?>
                      <td id='borrow'><input type="submit" value="Borrow Tool" /></td>
                    <?php } ?>
                  </div>
                </form>
              <?php } ?>
          <?php } ?>
      </div>
    	  </tr>
      <?php } ?>
  	</table>

  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
