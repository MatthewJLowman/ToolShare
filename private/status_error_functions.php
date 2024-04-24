<?php
/**
 * Requires the user to be logged in.
 *
 * If the user is not logged in, this function sets a session variable to 
 * store the current request URI and then redirects to a login page. If the 
 * user is logged in, the rest of the page is allowed to proceed as normal.
 * 
 * @global Session $session The current session object.
 */
function require_login() {
  global $session;
  if(!$session->is_logged_in()) {
    $_SESSION['redirect_to'] = $_SERVER['REQUEST_URI'];
    var_dump($_SESSION['redirect_to']);
    redirect_to(url_for('../../login.php'));
  } else {
    // Do nothing, let the rest of the page proceed
  }
}
/**
 * Displays a list of errors in an HTML formatted block.
 *
 * This function accepts an array of error messages and creates a formatted
 * HTML output, listing all errors. If there are no errors, the function 
 * returns an empty string.
 *
 * @param array $errors An array of error messages.
 * @return string The formatted HTML output for the errors, or an empty string.
 */
function display_errors($errors=array()) {
  $output = '';
  if(!empty($errors)) {
    $output .= "<div class=\"errors\">";
    $output .= "Please fix the following errors:";
    $output .= "<ul>";
    foreach($errors as $error) {
      $output .= "<li>" . h($error) . "</li>";
    }
    $output .= "</ul>";
    $output .= "</div>";
  }
  return $output;
}
/**
 * Displays a session message in an HTML formatted block.
 *
 * This function retrieves a message from the session, displays it, 
 * and then clears the message from the session. If no message is found,
 * it returns `null`.
 *
 * @global Session $session The current session object.
 * @return string|null The formatted HTML message, or `null` if no message is set.
 */
function display_session_message() {
  global $session;
  $msg = $session->message();
  if(isset($msg) && $msg != '') {
    $session->clear_message();
    return '<div id="message">' . h($msg) . '</div>';
  }
}

?>
