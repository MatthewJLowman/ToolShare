<?php
/**
 * Class representing a generic database object.
 *
 * This class provides basic CRUD (Create, Read, Update, Delete) operations for
 * objects that map to database tables. It offers various utility methods for
 * interacting with the database and handling object attributes.
 */
class DatabaseObject {
  /**
   * The database connection resource.
   */
  static protected $database;
   /**
   * The name of the database table that this class interacts with.
   */
  static protected $table_name = "";
   /**
   * List of database columns corresponding to the object's attributes.
   */
  static protected $columns = [];
   /**
   * An array to hold validation errors.
   */
  public $errors = [];
  /**
   * Sets the database connection for the class.
   *
   * @param mysqli $database The database connection to set.
   */
  static public function set_database($database) {
    self::$database = $database;
  }
  /**
   * Executes a SQL query and returns the result as an array of objects.
   *
   * @param string $sql The SQL query to execute.
   * @return array An array of objects resulting from the query.
   */
  static public function find_by_sql($sql) {
    $result = self::$database->query($sql);
    if(!$result) {
      return("Database query failed.$sql");
    }

    // results into objects
    $object_array = [];
    while($record = $result->fetch_assoc()) {
      $object_array[] = static::instantiate($record);
    }

    $result->free();

    return $object_array;
  }
  /**
   * Retrieves all records from the corresponding database table.
   *
   * @return array An array of all records as objects.
   */
  static public function find_all() {
    $sql = "SELECT * FROM " . static::$table_name;
    return static::find_by_sql($sql);
  }
  /**
   * Retrieves a single record from the database by ID.
   *
   * @param int $id The ID of the record to retrieve.
   * @return mixed The object representing the record, or false if not found.
   */
  static public function find_by_id($id) {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE id='" . self::$database->escape_string($id) . "'";
    $obj_array = static::find_by_sql($sql);
    if(!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }
   /**
   * Instantiates an object based on a database record.
   *
   * @param array $record An associative array of database column values.
   * @return object The instantiated object.
   */
  static protected function instantiate($record) {
    $object = new static;
    // Could manually assign values to properties
    // but automatically assignment is easier and re-usable
    foreach($record as $property => $value) {
      if(property_exists($object, $property)) {
        $object->$property = $value;
      }
    }
    return $object;
  }
  /**
   * Validates the object according to custom rules.
   *
   * @return array An array of validation errors.
   */
  protected function validate() {
    $this->errors = [];

    // Add custom validations

    return $this->errors;
  }
   /**
   * Creates a new record in the database based on the object's attributes.
   *
   * @return bool True if the creation was successful, otherwise false.
   */
  protected function create() {
    $this->validate();
    if(!empty($this->errors)) { return false; }

    $attributes = $this->sanitized_attributes();
    $sql = "INSERT INTO " . static::$table_name . " (";
    $sql .= join(', ', array_keys($attributes));
    $sql .= ") VALUES ('";
    $sql .= join("', '", array_values($attributes));
    $sql .= "')";
    echo $sql;
    $result = self::$database->query($sql);
    if($result) {
      $this->id = self::$database->insert_id;
    }
    return $result;
  }
  /**
   * Updates an existing record in the database based on the object's attributes.
   *
   * @return bool True if the update was successful, otherwise false.
   */
  protected function update() {
    $this->validate();
    if(!empty($this->errors)) { return false; }

    $attributes = $this->sanitized_attributes();
    $attribute_pairs = [];
    foreach($attributes as $key => $value) {
      $attribute_pairs[] = "{$key}='{$value}'";
    }

    $sql = "UPDATE " . static::$table_name . " SET ";
    $sql .= join(', ', $attribute_pairs);
    $sql .= " WHERE id='" . self::$database->escape_string($this->id) . "' ";
    $sql .= "LIMIT 1";
    $result = self::$database->query($sql);
    return $result;
  }
  /**
   * Saves the object to the database.
   *
   * If the object has an ID, it updates the existing record. If not, it creates a new record.
   *
   * @return bool True if the save operation was successful, otherwise false.
   */
  public function save() {
    // A new record will not have an ID yet
    if(isset($this->id)) {
      return $this->update();
    } else {
      return $this->create();
    }
  }
   /**
   * Merges an array of attributes into the object's properties.
   *
   * @param array $args An associative array of attributes to merge.
   */
  public function merge_attributes($args=[]) {
    foreach($args as $key => $value) {
      if(property_exists($this, $key) && !is_null($value)) {
        $this->$key = $value;
      }
    }
  }

  /**
   * Retrieves the object's attributes corresponding to database columns, excluding the ID.
   *
   * @return array An associative array of attribute names and values.
   */
  public function attributes() {
    $attributes = [];
    foreach(static::$db_columns as $column) {
      if($column == 'id') { continue; }
      $attributes[$column] = $this->$column;
    }
    return $attributes;
  }
  /**
   * Sanitizes the object's attributes to prevent SQL injection.
   *
   * @return array An associative array of sanitized attributes.
   */
  protected function sanitized_attributes() {
    $sanitized = [];
    foreach($this->attributes() as $key => $value) {
      $sanitized[$key] = self::$database->escape_string($value);
    }
    return $sanitized;
  }
  /**
   * Deletes a record from the database based on the object's ID.
   *
   * @return bool True if the deletion was successful, otherwise false.
   */
  public function delete() {
    $sql = "DELETE FROM " . static::$table_name . " ";
    $sql .= "WHERE id='" . self::$database->escape_string($this->id) . "' ";
    $sql .= "LIMIT 1";
    $result = self::$database->query($sql);
    return $result;

    // After deleting, the instance of the object will still
    // exist, even though the database record does not.
    // This can be useful, as in:
    //   echo $user->first_name . " was deleted.";
    // but, for example, we can't call $user->update() after
    // calling $user->delete().
  }

}

?>
