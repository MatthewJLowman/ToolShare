<?php
/**
 * Prevents caching of the page content by the browser.
 * It ensures that the most recent version of the page is displayed.
 */
  header("Cache-Control: no-cache");
  /**
 * Turns on output buffering.
 * Output buffering stores output in a buffer before sending it to the browser,
 * allowing modification of headers and content before sending the final output.
 */
  ob_start(); // turn on output buffering
/**
 * Defines constant paths to various directories within the project.
 * This helps in referencing directories relative to the current file's location.
 * - `PRIVATE_PATH` is the path to the current directory.
 * - `PROJECT_PATH` is the path to the parent directory of `PRIVATE_PATH`.
 * - `PUBLIC_PATH` is the public directory at the project level.
 * - `SHARED_PATH` is the shared resources directory within the `PRIVATE_PATH`.
 */
  define("PRIVATE_PATH", dirname(__FILE__));
  define("PROJECT_PATH", dirname(PRIVATE_PATH));
  define("PUBLIC_PATH", PROJECT_PATH . '/');
  define("SHARED_PATH", PRIVATE_PATH . '/shared');

/**
 * Defines the root URL of the website without including the domain name.
 * It finds the root path from the server's script name and assigns it to `WWW_ROOT`.
 * This can be used to build relative URLs.
 */
  $public_end = strpos($_SERVER['SCRIPT_NAME'], '/') + 7;
  $doc_root = substr($_SERVER['SCRIPT_NAME'], 0, $public_end);
  define("WWW_ROOT", $doc_root);
/**
 * Includes necessary PHP files to support the functionality of the project.
 * - `functions.php`: Contains common functions used across the project.
 * - `status_error_functions.php`: Contains functions related to error handling and status codes.
 * - `db_credentials.php`: Holds database connection credentials.
 * - `database_functions.php`: Contains functions for database interactions.
 * - `validation_functions.php`: Contains functions for input validation.
 */
  require_once('functions.php');
  require_once('status_error_functions.php');
  require_once('db_credentials.php');
  require_once('database_functions.php');
  require_once('validation_functions.php');

/**
 * Loads class definitions either manually or using autoloading.
 * This allows classes to be instantiated without manually requiring each class file.
 * - The `my_autoload` function handles dynamic loading of class files based on the class name.
 * - The `spl_autoload_register` function registers `my_autoload` as the autoloader.
 */
  foreach(glob('classes/*.class.php') as $file) {
    require_once($file);
  }

  // Autoload class definitions
  function my_autoload($class) {
    if(preg_match('/\A\w+\Z/', $class)) {
      include('classes/' . $class . '.class.php');
    }
  }
  spl_autoload_register('my_autoload');
/**
 * Establishes a connection to the database and sets it for `DatabaseObject` class.
 * - `db_connect()`: Connects to the database using credentials from `db_credentials.php`.
 * - `DatabaseObject::set_database($database)`: Associates the database with the `DatabaseObject` class.
 */
  $database = db_connect();
  DatabaseObject::set_database($database);
/**
 * Creates a new session object for session management.
 * This object manages user sessions, providing methods for login, logout, and session state.
 */
  $session = new Session;
?>

