<?php

class Tool extends DatabaseObject {

    static protected $table_name = "tools";
    static protected $db_columns = ['id', 'tool_name', 'description', 'availability'];

    public $id;
    public $tool_name;
    public $description;
    public $availability;
    public $lender_id;
    public $borrower_id;

    public function __construct($args=[]) {
        $this->tool_name = $args['tool_name'] ?? '';
        $this->description = $args['description'] ?? '';
        $this->availability = $args['availability'] ?? '';
        $this->lender_id = $args['lender_id'] ?? '';
        $this->borrower_id = $args['borrower_id'] ?? '';
    }

} ?>