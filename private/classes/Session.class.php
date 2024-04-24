<?php
/**
 * Class to manage user sessions.
 *
 * This class provides methods to handle user login, logout, session validation,
 * and administration checks. It uses PHP's session handling mechanism to store
 * session-related data like user ID, name, last login time, and admin status.
 */

class Session {
  /**
   * User ID for the current session.
   *
   * @var int
   */
  public $user_id;
  /**
   * Name of the logged-in user.
   *
   * @var string
   */
  public $name;
  /**
   * Last login time for the current session.
   *
   * @var int
   */
  private $last_login;
  /**
   * Indicates whether the logged-in user is an admin.
   *
   * @var bool
   */
  private $is_admin;
   /**
   * Maximum duration a login session is considered valid, in seconds.
   *
   * Set to 1 day (60 * 60 * 24).
   */
  public const MAX_LOGIN_AGE = 60*60*24; // 1 day
  /**
   * Constructor for the Session class.
   *
   * Initializes the session and checks for any stored login details.
   */
  public function __construct() {
    session_start();
    $this->check_stored_login();
  }
  /**
   * Logs in a user and sets the session data.
   *
   * @param object $member An object representing the user, with properties `user_id`, `name`, and `is_admin`.
   * @return bool True if the login is successful, otherwise false.
   */
  public function login($member) {
    if($member) {
      // prevent session fixation attacks
      session_regenerate_id();
      $this->user_id = $_SESSION['user_id'] = $member->user_id;
      $this->name = $_SESSION['name'] = $member->name;
      $this->last_login = $_SESSION['last_login'] = time();
      $this->is_admin = $_SESSION['is_admin'] = $member->is_admin;
    }
    return true;
  }
  /**
   * Checks if a user is logged in.
   *
   * @return bool True if a user is logged in and the session is recent, otherwise false.
   */
  public function is_logged_in() {
    // return isset($this->admin_id);
    return isset($this->user_id) && $this->last_login_is_recent();
  }
   /**
   * Checks if an admin user is logged in.
   *
   * @return bool True if an admin user is logged in and the session is recent, otherwise false.
   */
  public function is_admin_logged_in() {
    return $this->is_logged_in() && $this->is_admin >= 1;
  }
  /**
   * Logs out the user and clears the session data.
   *
   * @return bool True if the logout is successful.
   */
  public function logout() {
    unset($_SESSION['user_id']);
    unset($_SESSION['name']);
    unset($_SESSION['last_login']);
    unset($_SESSION['is_admin']);
    unset($_SESSION['redirect_to']);
    unset($this->user_id);
    unset($this->name);
    unset($this->last_login);
    unset($this->is_admin);
    return true;
  }
   /**
   * Checks if there's a stored login in the session data.
   *
   * This method retrieves stored session data and initializes the class properties with it.
   */
  private function check_stored_login() {
    if(isset($_SESSION['user_id'])) {
      $this->user_id = $_SESSION['user_id'];
      $this->name = $_SESSION['name'];
      $this->last_login = $_SESSION['last_login'];
      $this->is_admin = $_SESSION['is_admin'];
    }
  }
   /**
   * Checks if the last login is within the allowed age.
   *
   * @return bool True if the last login is recent, otherwise false.
   */
  private function last_login_is_recent() {
    if(!isset($this->last_login)) {
      return false;
    } elseif(($this->last_login + self::MAX_LOGIN_AGE) < time()) {
      return false;
    } else {
      return true;
    }
  }
  /**
   * Stores or retrieves a session message.
   *
   * This method can be used to set a message in the session or retrieve an existing message.
   *
   * @param string $msg Optional message to set in the session.
   * @return string The current session message, if any.
   */
  public function message($msg="") {
    if(!empty($msg)) {
      // Then this is a "set" message
      $_SESSION['message'] = $msg;
      return true;
    } else {
      // Then this is a "get" message
      return $_SESSION['message'] ?? '';
    }
  }
   /**
   * Clears the session message.
   *
   * This method removes the message stored in the session.
   */
  public function clear_message() {
    unset($_SESSION['message']);
  }
}

?>
