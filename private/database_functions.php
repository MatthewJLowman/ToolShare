<?php
/**
 * Establishes a connection to the database.
 *
 * This function creates a new MySQLi connection using the specified database
 * server, username, password, and database name constants. It also checks
 * if the connection was successful and confirms it. If the connection fails,
 * an error message is displayed and the script exits.
 *
 * @return mysqli The established MySQLi connection.
 */
function db_connect() {
  $connection = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
  confirm_db_connect($connection);
  return $connection;
}
/**
 * Confirms that the database connection was successful.
 *
 * This function checks if the MySQLi connection encountered an error.
 * If so, it displays an error message with additional information and 
 * exits the script.
 *
 * @param mysqli $connection The database connection to confirm.
 */
function confirm_db_connect($connection) {
  if($connection->connect_errno) {
    $msg = "Database connection failed: ";
    $msg .= $connection->connect_error;
    $msg .= " (" . $connection->connect_errno . ")";
    exit($msg);
  }
}
/**
 * Closes the connection to the database.
 *
 * This function checks if the given database connection is set and, 
 * if so, closes the connection to free up resources.
 *
 * @param mysqli $connection The database connection to close.
 */
function db_disconnect($connection) {
  if(isset($connection)) {
    $connection->close();
  }
}

?>
