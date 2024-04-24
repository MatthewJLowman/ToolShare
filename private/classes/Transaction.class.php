<?php
/**
 * Class representing a transaction record in a database.
 *
 * This class extends the `DatabaseObject` and represents a record in the "transactions" table.
 * It manages information about transactions involving tools and participants in the form of borrowers and lenders.
 */
class Transaction extends DatabaseObject {
     /**
     * The name of the database table this class interacts with.
     *
     * @var string
     */
    static protected $table_name = "transactions";
    /**
     * The database columns used by this class.
     *
     * @var array
     */
    static protected $db_columns = ['id', 'tool_id', 'borrower_id', 'lender_id'];
     /**
     * Unique identifier for a transaction.
     *
     * @var int
     */
    public $id;
    /**
     * Identifier for the tool involved in the transaction.
     *
     * @var int
     */
    public $tool_id;
    /**
     * Identifier for the borrower in the transaction.
     *
     * @var int
     */
    public $borrower_id;
    /**
     * Identifier for the lender in the transaction.
     *
     * @var int
     */
    public $lender_id;
     /**
     * Constructor for the Transaction class.
     *
     * @param array $args An optional associative array of attributes to initialize the transaction with.
     * If no values are provided, default empty values are used.
     */
    public function __construct($args=[]) {
        $this->tool_id = $args['tool_id'] ?? '';
        $this->borrower_id = $args['borrower_id'] ?? '';
        $this->lender_id = $args['lender_id'] ?? '';
    }

} ?>