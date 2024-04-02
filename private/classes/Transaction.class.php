<?php

class Transaction extends DatabaseObject {

    static protected $table_name = "transactions";
    static protected $db_columns = ['id', 'tool_id', 'borrower_id', 'lender_id'];

    public $id;
    public $tool_id;
    public $borrower_id;
    public $lender_id;

    public function __construct($args=[]) {
        $this->tool_id = $args['tool_id'] ?? '';
        $this->borrower_id = $args['borrower_id'] ?? '';
        $this->lender_id = $args['lender_id'] ?? '';
    }

} ?>