

<dl>
  <dt>Username</dt>
  <dd><input type="text" id='username' name="user[name]" value="<?php echo h($user->name); ?>" /></dd>
</dl>

<dl>
  <dt>Email</dt>
  <dd><input type="text" id='email' name="user[email]" value="<?php echo h($user->email); ?>" /></dd>
</dl>

<dl>
  <dt>Password</dt>
  <dd><input type="password" id='password' name="user[password]" value="<?php echo h($user->password); ?>" /></dd>
</dl>

<dl>
  <dt>Confirm Password</dt>
  <dd><input type="password" id='confirm_password' name="user[confirm_password]" value="<?php echo h($user->confirm_password); ?>" /></dd>
</dl>
