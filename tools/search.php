<?php require_once('../private/initialize.php'); ?>

<?php
// Get the search query from the GET parameters
$search_query = h($_GET['query'] ?? '');

// Find tools matching the search query
$tools = Tool::find_all(); // Get all tools
$filtered_tools = [];

foreach ($tools as $tool) {
    // Check if the search query is present in the tool name or description
    if (stripos($tool->tool_name, $search_query) !== false || stripos($tool->description, $search_query) !== false) {
        $filtered_tools[] = $tool;
    }
}
?>

<?php $page_title = 'Search Results'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">
    <h1>Search Results</h1>
    <p>Search query: <?php echo h($search_query); ?></p>

    <div class="actions">
        <a class="action" href="index.php">Back to All Tools</a>
    </div>

    <table class="list">
        <?php foreach ($filtered_tools as $tool) { ?>
            <tr>
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
            </tr>
        <?php } ?>
    </table>
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
