<?php

class BaseModel extends Database
{
    protected $connect;

    public function __construct()
    {
        $this->connect = $this->connect();
    }

    protected function create()
    {

    }

    protected function read()
    {

    }

    protected function update()
    {

    }

    /**
     * performs a query
     * @param string $sql       SQL statement
     * @return mysqli_result    query's result
     */
    protected function query($sql)
    {
        return mysqli_query($this->connect, $sql);
    }

    /**
     * select from db with condition
     * @param string $table     table name
     * @param string $column    column name to filter
     * @param string $value     column value to filter
     * @return mysqli_result    query's result
     */
    protected function selectBy($table, $column, $value)
    {
        $sql = "SELECT * FROM $table WHERE $column = '$value'";
        return $this->query($sql);
    }

    /**
     * select all records from table
     * @param string $table     table name
     * @return mysqli_result    query's result
     */
    protected function selectAll($table)
    {
        $sql = "SELECT * FROM $table";
        return $this->query($sql);
    }

    
}
