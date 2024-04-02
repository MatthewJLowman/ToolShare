<?php

class Session {

  private $user_id;
  public $name;
  private $last_login;
  private $is_admin;

  public const MAX_LOGIN_AGE = 60*60*24; // 1 day

  public function __construct() {
    session_start();
    $this->check_stored_login();
  }

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

  public function is_logged_in() {
    // return isset($this->admin_id);
    return isset($this->user_id) && $this->last_login_is_recent();
  }

  public function is_admin_logged_in() {
    return $this->is_logged_in() && $this->is_admin == 1;
  }

  public function logout() {
    unset($_SESSION['user_id']);
    unset($_SESSION['name']);
    unset($_SESSION['last_login']);
    unset($_SESSION['is_admin']);
    unset($this->user_id);
    unset($this->name);
    unset($this->last_login);
    unset($this->is_admin);
    return true;
  }

  private function check_stored_login() {
    if(isset($_SESSION['user_id'])) {
      $this->user_id = $_SESSION['user_id'];
      $this->name = $_SESSION['name'];
      $this->last_login = $_SESSION['last_login'];
      $this->is_admin = $_SESSION['is_admin'];
    }
  }

  private function last_login_is_recent() {
    if(!isset($this->last_login)) {
      return false;
    } elseif(($this->last_login + self::MAX_LOGIN_AGE) < time()) {
      return false;
    } else {
      return true;
    }
  }

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

  public function clear_message() {
    unset($_SESSION['message']);
  }
}

?>
