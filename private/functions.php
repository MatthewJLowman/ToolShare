<?php
/**
 * Returns a complete URL for a given script path.
 *
 * @param string $script_path The path to the script or file.
 * @return string The full URL based on the root path.
 */
function url_for($script_path) {
  // add the leading '/' if not present
  if($script_path[0] != '/') {
    $script_path = "/" . $script_path;
  }
  return WWW_ROOT . $script_path;
}
/**
 * Encodes a string for use in a URL.
 *
 * @param string $string The string to encode.
 * @return string The URL-encoded string.
 */
function u($string="") {
  return urlencode($string);
}
/**
 * Encodes a string using raw URL encoding.
 * This encoding is stricter than standard URL encoding.
 *
 * @param string $string The string to encode.
 * @return string The raw URL-encoded string.
 */
function raw_u($string="") {
  return rawurlencode($string);
}
/**
 * Converts special characters to HTML entities to prevent HTML injection.
 *
 * @param string $string The string to convert.
 * @return string The HTML-safe string.
 */
function h($string="") {
  return htmlspecialchars($string);
}
/**
 * Sends a 404 Not Found HTTP response and exits.
 * This is typically used when a resource cannot be found.
 */
function error_404() {
  header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found");
  exit();
}
/**
 * Sends a 500 Internal Server Error HTTP response and exits.
 * This is used when a server error occurs.
 */
function error_500() {
  header($_SERVER["SERVER_PROTOCOL"] . " 500 Internal Server Error");
  exit();
}
/**
 * Redirects to a specified location and exits.
 *
 * @param string $location The URL to redirect to.
 */
function redirect_to($location) {
  header("Location: " . $location);
  exit;
}
/**
 * Determines if the current request method is POST.
 *
 * @return bool True if the request method is POST, false otherwise.
 */
function is_post_request() {
  return $_SERVER['REQUEST_METHOD'] == 'POST';
}
/**
 * Determines if the current request method is GET.
 *
 * @return bool True if the request method is GET, false otherwise.
 */
function is_get_request() {
  return $_SERVER['REQUEST_METHOD'] == 'GET';
}

/**
 * A simple replacement for money_format() function.
 * PHP on Windows does not have the built-in money_format function.
 * 
 * @param string $format The format string (ignored in this implementation).
 * @param float $number The number to format as currency.
 * @return string The formatted currency string with two decimal places.
 */
if(!function_exists('money_format')) {
  function money_format($format, $number) {
    return '$' . number_format($number, 2);
  }
}

function truncate_description($description, $max_length = 45, $suffix = '...  READ MORE') {
  if (strlen($description) > $max_length) {
    // Cut the description at max_length and add a suffix
    $shortened = substr($description, 0, $max_length) . $suffix;
    return $shortened;
  }
  return $description; // No need to truncate
}

?>
