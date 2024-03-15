
  <?php if(isset($super_hero_image)) { ?>

    <div class="expanding-wrapper">
      <?php $image_url = url_for('/images/' . $super_hero_image); ?>
      <img id="super-hero-image" src="<?php echo $image_url; ?>" />
      <footer>
        <?php include(SHARED_PATH . '/public_copyright_disclaimer.php'); ?>
      </footer>
    </div>

  <?php } else { ?>

    <footer>
      <?php include(SHARED_PATH . '/public_copyright_disclaimer.php'); ?>
      <p>429 Tool St.</p>
      <p>Arden NC 28704</p>
      <p>Matthew Lowman</p>
    <p><a href="mailto:matthewjlowman@students.abtech.edu">matthewjlowman@students.abtech.edu</a></p>
    </footer>

  <?php } ?>

  </body>
</html>

<?php
db_disconnect($database);
?>
