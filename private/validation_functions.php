<?php

/**
 * Checks if a given value is blank.
 *
 * This function validates the presence of data. It uses `trim()` to
 * remove leading and trailing spaces, ensuring that empty spaces
 * don't count as valid input. It also uses `===` for strict
 * comparison, avoiding false positives.
 *
 * @param mixed $value The value to check.
 * @return bool True if the value is blank, false otherwise.
 */
  function is_blank($value) {
    return !isset($value) || trim($value) === '';
  }

/**
 * Checks if a given value has a presence.
 *
 * This function is the reverse of `is_blank()`, validating that the value
 * is not empty or only whitespace. Useful for form validation to ensure
 * required fields are not empty.
 *
 * @param mixed $value The value to check.
 * @return bool True if the value has presence, false if it's blank.
 */
  function has_presence($value) {
    return !is_blank($value);
  }

/**
 * Checks if the length of a given string is greater than a specified minimum.
 *
 * @param string $value The string to check.
 * @param int $min The minimum length.
 * @return bool True if the length is greater than `min`, false otherwise.
 */
  function has_length_greater_than($value, $min) {
    $length = strlen($value);
    return $length > $min;
  }

/**
 * Checks if the length of a given string is less than a specified maximum.
 *
 * @param string $value The string to check.
 * @param int $max The maximum length.
 * @return bool True if the length is less than `max`, false otherwise.
 */
  function has_length_less_than($value, $max) {
    $length = strlen($value);
    return $length < $max;
  }

/**
 * Checks if the length of a given string is exactly a specified value.
 *
 * @param string $value The string to check.
 * @param int $exact The exact length.
 * @return bool True if the length is exactly `exact`, false otherwise.
 */
  function has_length_exactly($value, $exact) {
    $length = strlen($value);
    return $length == $exact;
  }

/**
 * Checks if the length of a given string meets specified conditions.
 *
 * This function combines checks for minimum, maximum, and exact lengths.
 * It returns true if the string's length matches the defined options.
 *
 * @param string $value The string to check.
 * @param array $options An array with 'min', 'max', or 'exact' keys.
 * @return bool True if the length meets the defined options, false otherwise.
 */
  function has_length($value, $options) {
    if(isset($options['min']) && !has_length_greater_than($value, $options['min'] - 1)) {
      return false;
    } elseif(isset($options['max']) && !has_length_less_than($value, $options['max'] + 1)) {
      return false;
    } elseif(isset($options['exact']) && !has_length_exactly($value, $options['exact'])) {
      return false;
    } else {
      return true;
    }
  }

/**
 * Validates that a given value is included in a specified set.
 *
 * @param mixed $value The value to check.
 * @param array $set The set to check against.
 * @return bool True if the value is in the set, false otherwise.
 */
  function has_inclusion_of($value, $set) {
  	return in_array($value, $set);
  }

/**
 * Validates that a given value is excluded from a specified set.
 *
 * @param mixed $value The value to check.
 * @param array $set The set to check against.
 * @return bool True if the value is not in the set, true otherwise.
 */
  function has_exclusion_of($value, $set) {
    return !in_array($value, $set);
  }

/**
 * Checks if a string contains a specific substring.
 *
 * @param string $value The string to check.
 * @param string $required_string The substring to look for.
 * @return bool True if the `required_string` is found in `value`, false otherwise.
 */
  function has_string($value, $required_string) {
    return strpos($value, $required_string) !== false;
  }

/**
 * Validates the format of an email address.
 *
 * This function checks that the email address follows a valid pattern,
 * which consists of characters followed by an '@', then another set of
 * characters, and finally a domain with at least two letters.
 *
 * @param string $value The email address to validate.
 * @return bool True if the email has a valid format, false otherwise.
 */
  function has_valid_email_format($value) {
    $email_regex = '/\A[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}\Z/i';
    return preg_match($email_regex, $value) === 1;
  }

/**
 * Validates the uniqueness of a name in a user context.
 *
 * This function checks if a username is unique among users.
 * It can also consider existing users by checking against a current ID.
 *
 * @param string $name The name to check.
 * @param int|string $current_id The current user ID to check against (defaults to "0").
 * @return bool True if the name is unique or matches the current user ID, false otherwise.
 */
  function has_unique_name($name, $current_id="0") {
    $user = User::find_by_name($name);
    if($user === false || $user->id == $current_id) {
      // is unique
      return true;
    } else {
      // not unique
      return false;
    }
  }

?>
