<?php

class AssignmentModel extends BaseModel
{
    const TABLE = 'assignments';

    public function insert($assignment)
    {
        $sql = "INSERT INTO assignments (idStudent, studentName, idClasswork, description, attachment)
                VALUES ({$assignment['idStudent']}, \"{$assignment['studentName']}\", {$assignment['idClasswork']}, 
                        \"" . mysqli_real_escape_string($this->connect, $assignment['description']) . "\", 
                        \"" . mysqli_real_escape_string($this->connect, $assignment['attachment']) . "\")";
        $this->query($sql);
    }

    public function getClassworkById($id)
    {
        $sql = "SELECT * FROM classworks WHERE id={$id}";
        $result = $this->query($sql);
        return mysqli_fetch_assoc($result);
    }

    /**
     * check if the student has submited assignment
     */
    public function checkSubmited($idStudent, $idClasswork)
    {
        $sql = "SELECT id FROM assignments WHERE idStudent={$idStudent} AND idClasswork={$idClasswork}";
        $result = $this->query($sql);
        if (mysqli_num_rows($result) > 0) {
            return true;
        }
        return false;
    }

    public function getById($id)
    {
        $sql = "SELECT * FROM assignments WHERE id={$id}";
        $result = $this->query($sql);
        return mysqli_fetch_assoc($result);
    }
}
