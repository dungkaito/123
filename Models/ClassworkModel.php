<?php

class ClassworkModel extends BaseModel
{
    const TABLE = 'classwork';

    /**
     * insert a new record to classwork database
     * @param array $classwork     message to insert
     */
    public function insert($classwork)
    {
        $sql = "INSERT INTO classwork (idTeacher, title, description, attachment)
                VALUES ({$classwork['idTeacher']},
                        \"" . mysqli_real_escape_string($this->connect, $classwork['title']) . "\",
                        \"" . mysqli_real_escape_string($this->connect, $classwork['description']) . "\", 
                        \"" . mysqli_real_escape_string($this->connect, $classwork['attachment']) . "\")";
        $this->query($sql);
    }

    /**
     * get all records in classworks table
     */
    public function getAll()
    {
        $classworks = array();

        $result = $this->selectAll(self::TABLE);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                array_push($classworks, $row);
            }
        }

        return $classworks;
    }

    /**
     * get a record in classworks table by id
     * @param string $id    id of classwork to select
     */
    public function getById($id)
    {
        $result = $this->selectBy(self::TABLE, 'id', $id);
        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            return $row;
        }
        return false;
    }
}
