<?php require_once('private/initialize.php'); ?>
<?php include(SHARED_PATH . '/public_header.php'); ?>
<body>
<div id="main">
  <section>
    <ul id="menu">
      <li>
        <a href="tools/index.php">
          <h3>Browse our Tool Inventory</h3>
          <p>Access our inventory of tools submitted by users like you</p>
        </a>
        
      </li>
      <li>
        <a href="tools/new.php">
        <h3>Lend</h3>
        <p>Contribute a tool to our inventory that can be borrowed by another user</p>
        </a>
      </li>

      <?php if($session->is_admin_logged_in()) { ?>
        <li><a href="users/index.php">Super Secret Admin Page</a></li>
      <?php } ?>

    </ul>
  </section>
  <section id="page">
    <h2>Welcome to Tool Share!</h2>
    <p>At Tool Share, we believe in the power of community and collaboration. Our platform is dedicated to making tools accessible to everyone in our community, fostering a culture of sharing, resourcefulness, and mutual support. Whether you're a seasoned DIY enthusiast, a hobbyist, or a professional tradesperson, we're here to connect you with the tools you need to bring your projects to life.</p>

    <h2>How It Works</h2>

    <p>Using Tool Share is easy. Simply sign up for an account, browse our extensive catalog of tools, and request to borrow the ones you need. Whether you're looking for power tools, hand tools, gardening equipment, or anything in between, you'll find a diverse range of options available from fellow members of the community. Once your request is approved, arrange a convenient time and place for pickup, and return the tool when you're finished.</p>
    <p><a href="mailto:matthewjlowman@students.abtech.edu">Contact Us</a></p>
  </section>
</div>
</body>
<?php include(SHARED_PATH . '/public_footer.php'); ?>
