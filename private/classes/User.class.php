<?php
/**
 * Class representing a user in a database.
 *
 * This class extends the `DatabaseObject` class and represents a record in the "users" database table.
 * It provides attributes, methods for user management, validation logic, and additional functionality for handling passwords.
 */
class User extends DatabaseObject {
    /**
     * The name of the database table this class interacts with.
     *
     * @var string
     */
    static protected $table_name = "users";
    /**
     * The database columns used by this class.
     *
     * @var array
     */
    static protected $db_columns = ['user_id', 'email', 'password', 'name', 'is_admin'];
    /**
     * User attributes from the database table.
     *
     * @var int
     */
    public $user_id;
    /**
     * User's email address.
     *
     * @var string
     */
    public $email;
     /**
     * User's password in plain text.
     *
     * @var string
     */
    public $password;
    /**
     * User's name.
     *
     * @var string
     */
    public $name;
    /**
     * Indicates whether the user has administrative privileges.
     *
     * @var bool
     */
    public $is_admin;
    /**
     * Hashed version of the user's password.
     *
     * @var string
     */
    protected $hashed_password;
    /**
     * Password confirmation for validation.
     *
     * @var string
     */
    public $confirm_password;
      /**
     * Determines if a password is required for creating or updating a user.
     *
     * @var bool
     */
    protected $password_required = true;
      /**
     * Constructor for the User class.
     *
     * @param array $args An optional associative array of attributes to initialize the user with.
     * If no values are provided, default empty values are used.
     */
    public function __construct($args=[]) {
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->confirm_password = $args['confirm_password'] ?? '';
        $this->name = $args['name'] ?? '';
        $this->is_admin = $args['is_admin'] ?? '';
    }
    /**
     * Hashes the user's password using bcrypt.
     */
    public function set_hashed_password() {
        $this->hashed_password = password_hash($this->password, PASSWORD_BCRYPT);
    }
    /**
     * Creates a new user record with a hashed password.
     *
     * @return bool True if creation is successful, false otherwise.
     */
    protected function create() {
        $this->set_hashed_password();
        return parent::create();
    }
    /**
     * Updates an existing user record. If a password is provided, it is hashed before updating.
     *
     * @return bool True if the update is successful, false otherwise.
     */
    protected function update() {
        if($this->password != '') {
            $this->set_hashed_password();
            return parent::update();
        } else {
            $this->password_required = false;
        }
        
    }
    /**
     * Validates the user's attributes and returns an array of errors.
     *
     * @return array An array of error messages, if any.
     */
    protected function validate() {
      $this->errors = [];
        // Validate name
      if(is_blank($this->name)) {
        $this->errors[] = "Name cannot be blank.";
      } elseif (!has_length($this->name, array('min' => 2, 'max' => 255))) {
        $this->errors[] = "Name must be between 2 and 255 characters.";
      }  elseif (!has_unique_name($this->name, $this->id ?? 0)) {
        $this->errors[] = "Name not allowed. Try another.";
      }
      // Validate email
      if(is_blank($this->email)) {
        $this->errors[] = "Email cannot be blank.";
      } elseif (!has_length($this->email, array('max' => 255))) {
        $this->errors[] = "Email must be less than 255 characters.";
      } elseif (!has_valid_email_format($this->email)) {
        $this->errors[] = "Email must be a valid format.";
      }
        // Validate password if required
        if($this->password_required) {
            if(is_blank($this->password)) {
                $this->errors[] = "Password cannot be blank.";
            } elseif (!has_length($this->password, array('min' => 8))) {
                $this->errors[] = "Password must contain 8 or more characters";
            } elseif (!preg_match('/[A-Z]/', $this->password)) {
                $this->errors[] = "Password must contain at least 1 uppercase letter";
            } elseif (!preg_match('/[a-z]/', $this->password)) {
                $this->errors[] = "Password must contain at least 1 lowercase letter";
            } elseif (!preg_match('/[0-9]/', $this->password)) {
                $this->errors[] = "Password must contain at least 1 number";
            } elseif (!preg_match('/[^A-Za-z0-9\s]/', $this->password)) {
                $this->errors[] = "Password must contain at least 1 symbol";
            }
            // Validate confirm password
            if(is_blank($this->confirm_password)) {
                $this->errors[] = "Confirm password cannot be blank.";
            } elseif ($this->password !== $this->confirm_password) {
                $this->errors[] = "Password and confirm password must match.";
            }
        }

      return $this->errors;
    }
      /**
     * Verifies if a given password matches the hashed password in the database.
     *
     * @param string $password The plain text password to verify.
     * @return bool True if the password is correct, false otherwise.
     */
    public function verify_password($password) {
      $sql = "SELECT * FROM " . static::$table_name . " ";
      $sql .= "WHERE password='" . self::$database->escape_string($password) . "'";
      $obj_array = static::find_by_sql($sql);
      if(!empty($obj_array)) {
        return true;
      } else {
        return false;
      }
    }
    /**
     * Finds a user by their name in the database.
     *
     * @param string $name The name of the user to find.
     * @return User|bool The User object if found, or false if not found.
     */
    static public function find_by_name($name) {
      $sql = "SELECT * FROM " . static::$table_name . " ";
      $sql .= "WHERE name='" . self::$database->escape_string($name) . "'";
      $obj_array = static::find_by_sql($sql);
      if(!empty($obj_array)) {
        return array_shift($obj_array);
      } else {
        return false;
      }
    }
}