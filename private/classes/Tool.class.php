<?php

/**
 * Class representing a tool in a database.
 *
 * This class extends the `DatabaseObject` class and represents a record in the "tools" database table.
 * It provides attributes and a constructor for initializing a tool, along with the definition of the associated database columns.
 */
class Tool extends DatabaseObject {
    
    /**
     * The name of the database table this class interacts with.
     *
     * @var string
     */
    static protected $table_name = "tools";
     /**
     * The database columns used by this class.
     *
     * @var array
     */
    static protected $db_columns = ['id', 'tool_name', 'description', 'availability', 'image'];
    /**
     * Unique identifier for the tool.
     *
     * @var int
     */
    public $id;
    /**
     * The name of the tool.
     *
     * @var string
     */
    public $tool_name;
    /**
     * Description of the tool.
     *
     * @var string
     */
    public $description;
     /**
     * Indicates the availability status of the tool.
     *
     * @var string
     */
    public $availability;
     /**
     * Image associated with the tool.
     *
     * @var string
     */
    public $image;
        /**
     * Constructor for the Tool class.
     *
     * @param array $args An optional associative array of attributes to initialize the tool with.
     * If no values are provided, default empty values are used.
     */

    public function __construct($args=[]) {
        $this->tool_name = $args['tool_name'] ?? '';
        $this->description = $args['description'] ?? '';
        $this->availability = $args['availability'] ?? '';
        $this->image = $args['image'] ?? '';
    }

} ?>