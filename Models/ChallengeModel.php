<?php

class ChallengeModel extends BaseModel
{
    const TABLE = 'challenges';

    /**
     * get all records in challenges table
     */
    public function getAll()
    {
        $challenges = array();

        $result = $this->selectAll(self::TABLE);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                array_push($challenges, $row);
            }
        }

        return $challenges;
    }

    public function insert($challenge)
    {
        $sql = "INSERT INTO challenges (idTeacher, title, hint, attachment)
                VALUES ({$challenge['idTeacher']}, \"{$challenge['title']}\", \"{$challenge['hint']}\", 
                        \"" . mysqli_real_escape_string($this->connect, $challenge['attachment']) . "\")";
        $this->query($sql);
    }

    public function getById($id)
    {
        $sql = "SELECT * FROM challenges WHERE id={$id}";
        $result = $this->query($sql);
        return mysqli_fetch_assoc($result);
    }
}
