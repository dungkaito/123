<?php

class MessageModel extends BaseModel
{
    const TABLE = 'messages';

    /**
     * get all messages which have uid=$id chat before
     * @param string $id    user id
     * @return array        array of array messages
     */
    public function getMessagesBySender($id)
    {
        $sql = "SELECT * FROM messages WHERE idSender={$id} OR idReceiver={$id}";
        $result = $this->query($sql);
        if (mysqli_num_rows($result) > 0) {
            $messages = [];
            while($row = mysqli_fetch_assoc($result)) {
                array_push($messages, $row);
            }
            return $messages;
        }
        return false;
    }

    /**
     * insert a new record to messages database
     * @param array $ms     message to insert
     */
    public function insert($ms)
    {   
        $sql = "INSERT INTO messages (idSender, idReceiver, content)
                VALUES ({$ms['idSender']}, {$ms['idReceiver']}, '{$ms['content']}')";

        $this->query($sql);
    }

    public function deleteById($id)
    {
        $sql = "DELETE FROM messages WHERE id={$id}";
        $this->query($sql);
    }

    public function getById($id)
    {
        $result = $this->selectBy(self::TABLE, 'id', $id);
        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            return $row;
        }
        return false;
    }

    /**
     * update data in `messages` table
     * @param array $ms   message data to update
     */
    public function edit($ms)
    {
        $sql = "UPDATE messages 
                SET content=\"{$ms['content']}\"
                WHERE id={$ms['id']}";
        // var_dump($sql);exit();
        return $this->query($sql);
        // var_dump($ret);
    }
}
