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

    protected function delete()
    {

    }

    /**
     * return records of $sql query
     */
    protected function query($sql)
    {
        return mysqli_query($this->connect, $sql);
    }

    /**
     * return a record in $table where $column = $value
     */
    protected function getBy($table, $column, $value)
    {
        $sql = "SELECT * FROM $table WHERE $column = '$value'";
        return $this->query($sql);
    }
}
