<?php

class UserModel extends BaseModel
{
    const TABLE = 'users';

    public function test()
    {
        return __METHOD__;
    }

    /**
     * login success: return an user record from database
     * login fail: return false
     */
    public function login($username, $password)
    {
        $result = $this->selectBy(self::TABLE, 'username', $username);
        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            if ($row['password'] === $password) {
                return $row;
            }
        }
        return false;
    }

    /**
     * get an user by $column
     * @return array    an user record
     */
    public function getUser($column, $value)
    {
        $result = $this->selectBy(self::TABLE, $column, $value);
        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            return $row;
        }
        return false;
    }

    /**
     * get all users in database
     * @return array    an array of user's info arrays
     */
    public function getAll()
    {
        $users = array();

        $result = $this->selectAll(self::TABLE);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                array_push($users, $row);
            }
        }

        return $users;
    }

    /**
     * insert new student record to database
     * @param array $user   user data to insert
     */
    public function add($user)
    {
        // var_dump($user['avatar']);exit();
        $sql = "INSERT INTO users (username, password, name, email, phone, avatar, role)
                VALUE (\"{$user['username']}\", \"{$user['password']}\", \"{$user['name']}\", \"{$user['email']}\", 
                       \"{$user['phone']}\", \"" . mysqli_real_escape_string($this->connect, $user['avatar']) . "\", 
                       {$user['role']})";
                
        // var_dump($sql);exit();
        return $this->query($sql);
        // var_dump($ret);
    }

    /**
     * update data in `users` table
     * @param array $user   user data to update
     */
    public function edit($user)
    {
        $sql = "UPDATE users 
                SET username=\"{$user['username']}\", password=\"{$user['password']}\", name=\"{$user['name']}\",  
                    email=\"{$user['email']}\", phone=\"{$user['phone']}\", 
                    avatar=\"" . mysqli_real_escape_string($this->connect, $user['avatar']) . "\", 
                    role={$user['role']} 
                WHERE id={$user['id']}";
        // var_dump($sql);exit();
        return $this->query($sql);
        // var_dump($ret);
    }

    /**
     * delete a record from `users` table
     * @param string $id    id of student will be delete from database
     */
    public function delete($id)
    {
        $sql = "DELETE FROM users WHERE id={$id}";
        $this->query($sql);
    }
}
