<dl>
  <dt>Name</dt>
  <dd><input type="text" name="tool[tool_name]" value="<?php echo h($tool->tool_name); ?>" /></dd>
</dl>

<dl>
  <dt>Description</dt>
  <dd><input type="text" name="tool[description]" maxlength="255" size="20" value="<?php echo h($tool->description); ?>" /></dd>
</dl>

<dl>
  <dt>Image</dt>
  <dd><input type="file" name="file" value="<?php echo h($tool->image); ?>"/></dd>
</dl>
