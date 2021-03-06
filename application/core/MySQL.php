<?php

class MySQL {

    // Base variables
    public $lastError; // Holds the last error
    public $lastQuery; // Holds the last query
    public $result; // Holds the MySQL query result
    public $records; // Holds the total number of records returned
    public $affected; // Holds the total number of records affected
    public $rawResults; // Holds raw 'arrayed' results
    public $arrayedResult; // Holds an array of the result

    private $hostname; // MySQL Hostname
    private $username; // MySQL Username
    private $password; // MySQL Password
    private $database; // MySQL Database
    private $port;

    private $databaseLink; // Database Connection Link


    /* *******************
     * Class Constructor *
     * *******************/

    function __construct($database = "myDB", $username = "root", $password = "ishwarpk", $hostname = 'localhost', $port = 3306, $persistant = false) {
        $this->database = $database;
        $this->username = $username;
        $this->password = $password;
        $this->hostname = $hostname;
        $this->port = $port;


        $this->Connect($persistant);
    }

    /* *******************
     * Class Destructor  *
     * *******************/

    function __destruct() {
        $this->closeConnection();
    }

    /* *******************
     * Private Functions *
     * *******************/

    // Connects class to database
    // $persistant (boolean) - Use persistant connection?
    private function Connect($persistant = false) {
        $this->CloseConnection();

            $this->databaseLink = mysqli_connect($this->hostname, $this->username, $this->password, $this->database, $this->port);

        if (!$this->databaseLink) {
            $this->lastError = 'Could not connect to server: ' . mysqli_error($this->databaseLink);
            return false;
        }

        if (!$this->UseDB()) {
            $this->lastError = 'Could not connect to database: ' . mysqli_error($this->databaseLink);
            return false;
        }

        $this->setCharset(); // TODO: remove forced charset find out a specific management
        return true;
    }


    // Select database to use
    private function UseDB() {
        if (!mysqli_select_db($this->databaseLink, $this->database)) {
            $this->lastError = 'Cannot select database: ' . mysqli_error($this->databaseLink);
            return false;
        } else {
            return true;
        }
    }


    // Performs a 'mysqli_real_escape_string' on the entire array/string
    private function SecureData($data, $types) {
        if (is_array($data)) {
            $i = 0;
            foreach ($data as $key => $val) {
                if (!is_array($data[$key])) {
                    $data[$key] = $this->CleanData($data[$key], $types[$i]);
                    $data[$key] = mysqli_real_escape_string($this->databaseLink, $data[$key]);
                    $i++;
                }
            }
        } else {
            $data = $this->CleanData($data, $types);
            $data = mysqli_real_escape_string($this->databaseLink, $data);
        }
        return $data;
    }

    // clean the variable with given types
    // possible types: none, str, int, float, bool, datetime, ts2dt (given timestamp convert to mysql datetime)
    // bonus types: hexcolor, email
    private function CleanData($data, $type = '') {
        switch ($type) {
            case 'none':
                // useless do not reaffect just do nothing
                //$data = $data;
                break;
            case 'str':
            case 'string':
                settype($data, 'string');
                break;
            case 'int':
            case 'integer':
                settype($data, 'integer');
                break;
            case 'float':
                settype($data, 'float');
                break;
            case 'bool':
            case 'boolean':
                settype($data, 'boolean');
                break;
            // Y-m-d H:i:s
            // 2014-01-01 12:30:30
            case 'datetime':
                $data = trim($data);
                $data = preg_replace('/[^\d\-: ]/i', '', $data);
                preg_match('/^([\d]{4}-[\d]{2}-[\d]{2} [\d]{2}:[\d]{2}:[\d]{2})$/', $data, $matches);
                $data = $matches[1];
                break;
            case 'ts2dt':
                settype($data, 'integer');
                $data = date('Y-m-d H:i:s', $data);
                break;

            // bonus types
            case 'hexcolor':
                preg_match('/(#[0-9abcdef]{6})/i', $data, $matches);
                $data = $matches[1];
                break;
            case 'email':
                $data = filter_var($data, FILTER_VALIDATE_EMAIL);
                break;
            default:
                $data = '';
                break;
        }
        return $data;
    }



    /* ******************
     * Public Functions *
     * ******************/

    // Executes MySQL query
    public function executeSQL($query) {
        $this->lastQuery = $query;
//        echo $query;

        if ($this->result = mysqli_query($this->databaseLink, $query)) {
            if (gettype($this->result) === "object" ) {
                $this->records = mysqli_num_rows($this->result);
                $this->affected = mysqli_affected_rows($this->databaseLink);
            } else {
                $this->records = 0;
                $this->affected = 0;
            }

            if ($this->records > 0) {
                $this->arrayResults();
                return $this->arrayedResult;
            } else {
                return true;
            }

        } else {
            $this->lastError = mysqli_error($this->databaseLink);
            return false;
        }
    }

    public function commit() {
        return mysqli_query($this->databaseLink, "COMMIT");
    }

    public function rollback() {
        return mysqli_query($this->databaseLink, "ROLLBACK");
    }

    public function setCharset($charset = 'UTF8') {
        return mysqli_set_charset($this->databaseLink, $this->SecureData($charset, 'string'));
    }

    // Adds a record to the database based on the array key names
    public function insert($table, $vars, $exclude = '', $datatypes) {

        // Catch Exclusions
        if ($exclude == '') {
            $exclude = array();
        }

        array_push($exclude, 'MAX_FILE_SIZE'); // Automatically exclude this one

        // Prepare Variables
        $vars = $this->SecureData($vars, $datatypes);

        $query = "INSERT INTO `{$table}` SET ";
        foreach ($vars as $key => $value) {
            if (in_array($key, $exclude)) {
                continue;
            }
            $query .= "`{$key}` = '{$value}', ";
        }

        $query = trim($query, ', ');

        return $this->executeSQL($query);
    }

    // Deletes a record from the database
    public function delete($table, $where = '', $limit = '', $like = false, $wheretypes) {
        $query = "DELETE FROM `{$table}` WHERE ";
        if (is_array($where) && $where != '') {
            // Prepare Variables
            $where = $this->SecureData($where, $wheretypes);

            foreach ($where as $key => $value) {
                if ($like) {
                    $query .= "`{$key}` LIKE '%{$value}%' AND ";
                } else {
                    $query .= "`{$key}` = '{$value}' AND ";
                }
            }

            $query = substr($query, 0, -5);
        }

        if ($limit != '') {
            $query .= ' LIMIT ' . $limit;
        }

        return $this->executeSQL($query);
    }


    // Gets a single row from $from where $where is true
    public function select($from, $where = '', $orderBy = '', $limit = '', $like = false, $operand = 'AND', $cols = '*', $wheretypes) {
        // Catch Exceptions
        if (trim($from) == '') {
            return false;
        }

        $query = "SELECT {$cols} FROM `{$from}` WHERE ";

        if (is_array($where) && $where != '') {
            // Prepare Variables
//            $where = $this->SecureData($where, $wheretypes);

            foreach ($where as $key => $value) {
                if ($like) {
                    $query .= "`{$key}` LIKE '%{$value}%' {$operand} ";
                } else {
                    $query .= "`{$key}` = '{$value}' {$operand} ";
                }
            }

            $query = substr($query, 0, -(strlen($operand) + 2));

        } else {
            $query = substr($query, 0, -6);
        }

        if ($orderBy != '') {
            $query .= ' ORDER BY ' . $orderBy;
        }

        if ($limit != '') {
            $query .= ' LIMIT ' . $limit;
        }

        return $this->executeSQL($query);

    }

    // increments a value in table for given id
    public function increment($table, $field, $id) {
        if (trim($table) == '' || !$field || !$id) {
            return false;
        }
        $query = "INSERT INTO `{$table}` (id,`{$field}`)
        VALUES (\"{$id}\",1)
        ON DUPLICATE KEY UPDATE
          `{$field}`=`{$field}` + 1";
//        echo $query;
        return $this->executeSQL($query);
    }

    // Updates a record in the database based on WHERE
    public function update($table, $set, $where, $exclude = '', $datatypes, $wheretypes) {
        // Catch Exceptions
        if (trim($table) == '' || !is_array($set) || !is_array($where)) {
            return false;
        }
        if ($exclude == '') {
            $exclude = array();
        }

        array_push($exclude, 'MAX_FILE_SIZE'); // Automatically exclude this one

        $set = $this->SecureData($set, $datatypes);
        $where = $this->SecureData($where, $wheretypes);

        // SET

        $query = "UPDATE `{$table}` SET ";

        foreach ($set as $key => $value) {
            if (in_array($key, $exclude)) {
                continue;
            }
            $query .= "`{$key}` = '{$value}', ";
        }

        $query = substr($query, 0, -2);

        // WHERE

        $query .= ' WHERE ';

        foreach ($where as $key => $value) {
            $query .= "`{$key}` = '{$value}' AND ";
        }

        $query = substr($query, 0, -5);

        return $this->executeSQL($query);
    }

    // 'Arrays' a single result
    public function arrayResult() {
        $this->arrayedResult = mysqli_fetch_assoc($this->result) or die (mysqli_error($this->databaseLink));
        return $this->arrayedResult;
    }

    // 'Arrays' multiple result
    public function arrayResults() {

        if ($this->records == 1) {
            return $this->arrayResult();
        }

        $this->arrayedResult = array();
        while ($data = mysqli_fetch_assoc($this->result)) {
            $this->arrayedResult[] = $data;
        }
        return $this->arrayedResult;
    }

    // 'Arrays' multiple results with a key
    public function arrayResultsWithKey($key = 'id') {
        if (isset($this->arrayedResult)) {
            unset($this->arrayedResult);
        }
        $this->arrayedResult = array();
        while ($row = mysqli_fetch_assoc($this->result)) {
            foreach ($row as $theKey => $theValue) {
                $this->arrayedResult[$row[$key]][$theKey] = $theValue;
            }
        }
        return $this->arrayedResult;
    }

    // Returns last insert ID
    public function lastInsertID() {
        return mysqli_insert_id($this->databaseLink);
    }

    // Return number of rows
    public function countRows($from, $where = '') {
        $result = $this->select($from, $where, '', '', false, 'AND', 'count(*)');
        return $result["count(*)"];
    }

    // Closes the connections
    public function closeConnection() {
        if ($this->databaseLink) {
            // Commit before closing just in case :)
            $this->commit();
            mysqli_close($this->databaseLink);
        }
    }
}