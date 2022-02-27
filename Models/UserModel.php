<?php

class UserModel extends BaseModel
{
    const TABLE = 'users';

    public function test()
    {
        return __METHOD__;
    }

    /**
     * login success: return an user record from DB
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
     * return: an user record in array
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
     * get all users in db
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

    public function add($user)
    {
        $ret = $this->create(self::TABLE, $user);
        return $ret;
    }
}
