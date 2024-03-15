<?php

class Tool extends DatabaseObject {

    static protected $table_name = "tools";
    static protected $db_columns = ['tool_id', 'tool_name', 'description', 'availability'];

    public $tool_id;
    public $tool_name;
    public $description;
    public $availability;

    public function __construct($args=[]) {
        $this->tool_name = $args['tool_name'] ?? '';
        $this->description = $args['description'] ?? '';
        $this->$availability = $args['availability'] ?? '';
    }

}