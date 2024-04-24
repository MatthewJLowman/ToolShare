<?php
/**
 * Class for parsing CSV (Comma-Separated Values) files.
 *
 * This class allows you to read CSV files, parse them, and retrieve the results.
 * It provides functionality to set the file to be parsed, read its contents, 
 * and get the parsed data along with row count.
 */
class ParseCSV {
  /**
   * The delimiter used to separate CSV fields.
   */

  public static $delimiter = ',';
  /**
   * The name of the CSV file to be parsed.
   */
  private $filename;
  /**
   * The header row of the CSV file.
   */
  private $header;
  /**
   * An array to store parsed CSV data.
   */
  private $data=[];
  /**
   * The total number of rows in the parsed CSV data.
   */
  private $row_count = 0;
  /**
   * Constructor for ParseCSV.
   *
   * @param string $filename The name of the CSV file to parse (optional).
   */
  public function __construct($filename='') {
    if($filename != '') {
      $this->file($filename);
    }
  }
  /**
   * Sets the CSV file to be parsed.
   *
   * @param string $filename The name of the CSV file.
   * @return bool True if the file is set successfully, otherwise false.
   */
  public function file($filename) {
    if(!file_exists($filename)) {
      echo "File does not exist.";
      return false;
    } elseif(!is_readable($filename)) {
      echo "File is not readable.";
      return false;
    }
    $this->filename = $filename;
    return true;
  }
  /**
   * Parses the CSV file.
   *
   * This method reads the file, extracts the header, and loads the data into
   * an array with the keys corresponding to the header.
   *
   * @return array|false The parsed data or false if the file is not set or cannot be parsed.
   */
  public function parse() {
    if(!isset($this->filename)) {
      echo "File not set.";
      return false;
    }

    // clear any previous results
    $this->reset();

    $file = fopen($this->filename, 'r');
    while(!feof($file)) {
      $row = fgetcsv($file, 0, self::$delimiter);
      if($row == [NULL] || $row === FALSE) { continue; }
      if(!$this->header) {
     	  $this->header = $row;
      } else {
        $this->data[] = array_combine($this->header, $row);
        $this->row_count++;
     	}
    }
    fclose($file);
    return $this->data;
  }
  /**
   * Gets the last parsed results.
   *
   * @return array The last parsed CSV data.
   */
  public function last_results() {
    return $this->data;
  }
   /**
   * Returns the count of rows in the parsed CSV data.
   *
   * @return int The number of rows parsed.
   */
  public function row_count() {
    return $this->row_count;
  }
  /**
   * Resets the parser to its initial state.
   */
  private function reset() {
    $this->header = NULL;
    $this->data = [];
    $this->row_count = 0;
  }

}

?>
