<?php require_once('private/initialize.php'); ?>
<?php
// Find all bicycles;
$tools = Tool::find_all();
$transactions = Transaction::find_all();
$_SESSION['tools_redirect'] = $_SERVER['REQUEST_URI'];
?>
<?php $page_title = 'Tools'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">
  <div class="bicycles listing">
    <h1>Lent Tools</h1>
    
    <div class="actions">
      <a class="action" href="tools/new.php">Add Tool</a>
    </div>

  	<table class="list">
      <?php 
        $user_id = $session->user_id;
        foreach($tools as $tool) { 
          foreach($transactions as $transaction) {
            $this_transaction = $transaction->tool_id; 
      ?>
            <?php if ($this_transaction == $tool->id) { ?>
              <?php if ($transaction->lender_id == $user_id) { ?>
              <tr>
                 <td><a href="<?php echo url_for('../tools/show.php?id=' . h(u($tool->id))); ?>">
                    <?php if (!is_blank($tool->image)) { ?>
                    <img src="../../images/<?php echo $tool->image; ?>" alt='<?php echo $tool->tool_name; ?>' width='64' height='64'>
                    <?php } ?>
                    <div id='toolinfo'>
                    <h3><?php echo h($tool->tool_name); ?></h3>
                    <?php echo h($tool->description); ?>
                    </div>
                  </a></td>
                  <td><a href="<?php echo url_for('../tools/edit.php?id=' . h(u($tool->id))); ?>">Edit</a></td>
                  <td><a href="<?php echo url_for('../tools/delete.php?id=' . h(u($tool->id))); ?>">Delete</a></td>
              </tr>
              <?php } ?>
            <?php } ?>
          <?php } ?>
        <?php } ?>
  	</table>

    <h1>Borrowed Tools</h1>
    
  	<table class="list">
      <?php 
        $user_id = $session->user_id;
        foreach($tools as $tool) { 
          foreach($transactions as $transaction) {
            $this_transaction = $transaction->tool_id; 
      ?>
            <?php if ($this_transaction == $tool->id) { ?>
              <?php if ($transaction->borrower_id == $user_id) { ?>
                <?php if ($transaction->borrower_id !== $transaction->lender_id) { ?>
                  <tr>
                    <td><a href="<?php echo url_for('../tools/show.php?id=' . h(u($tool->id))); ?>">
                    <?php if (!is_blank($tool->image)) { ?>
                    <img src="../../images/<?php echo $tool->image; ?>" alt='<?php echo $tool->tool_name; ?>' width='64' height='64'>
                    <?php } ?>
                    <div id='toolinfo'>
                    <h3><?php echo h($tool->tool_name); ?></h3>
                    <?php echo h($tool->description); ?>
                    </div>
                    </a></td>
                  </tr>
                <?php } ?>
              <?php } ?>
            <?php } ?>
          <?php } ?>
        <?php } ?>
  	</table>

  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
