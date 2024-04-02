<?php

class User extends DatabaseObject {

    static protected $table_name = "users";
    static protected $db_columns = ['user_id', 'email', 'password', 'name', 'is_admin'];

    public $user_id;
    public $email;
    public $password;
    public $name;
    public $is_admin;
    protected $hashed_password;
    public $confirm_password;
    protected $password_required = true;

    public function __construct($args=[]) {
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->confirm_password = $args['confirm_password'] ?? '';
        $this->name = $args['name'] ?? '';
        $this->is_admin = $args['is_admin'] ?? '';
    }

    public function set_hashed_password() {
        $this->hashed_password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    protected function create() {
        $this->set_hashed_password();
        return parent::create();
    }

    protected function update() {
        if($this->password != '') {
            $this->set_hashed_password();
            return parent::update();
        } else {
            $this->password_required = false;
        }
        
    }

    protected function validate() {
      $this->errors = [];

      if(is_blank($this->name)) {
        $this->errors[] = "Name cannot be blank.";
      } elseif (!has_length($this->name, array('min' => 2, 'max' => 255))) {
        $this->errors[] = "Name must be between 2 and 255 characters.";
      }  elseif (!has_unique_name($this->name, $this->id ?? 0)) {
        $this->errors[] = "Name not allowed. Try another.";
      }

      if(is_blank($this->email)) {
        $this->errors[] = "Email cannot be blank.";
      } elseif (!has_length($this->email, array('max' => 255))) {
        $this->errors[] = "Last name must be less than 255 characters.";
      } elseif (!has_valid_email_format($this->email)) {
        $this->errors[] = "Email must be a valid format.";
      }

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

            if(is_blank($this->confirm_password)) {
                $this->errors[] = "Confirm password cannot be blank.";
            } elseif ($this->password !== $this->confirm_password) {
                $this->errors[] = "Password and confirm password must match.";
            }
        }

      return $this->errors;
    }

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