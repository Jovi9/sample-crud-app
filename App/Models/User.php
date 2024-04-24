<?php

namespace App\Models;

use App\Connection;

require __DIR__ . '/../../vendor/autoload.php';

class User extends Connection
{
    function __construct()
    {
        parent::__construct();
    }
    function __destruct()
    {
        $this->connection->close();
    }
    function register(array $user): array
    {
        $result = array();
        $query = "insert into users (name, username, password) values (?,?,?)";
        $statement = $this->connection->stmt_init();
        if ($statement->prepare($query)) {
            $statement->bind_param("sss", $user['name'], $user['username'], password_hash($user['password'], PASSWORD_BCRYPT));
            $statement->execute();
            if ($statement->affected_rows == 1) {
                $result = ['register-success' => 'You have registered successfully.'];
            } else {
                $result = ['register-failed' => 'Registration Failed, please try again.'];
            }
        } else {
            $result = ['request-failed' => 'Request Failed. Try Again.'];
        }
        $statement->close();
        return $result;
    }
    function login(array $user): array
    {
        $result = array();
        $query = "select * from users where username=?";
        $statement = $this->connection->stmt_init();
        if ($statement->prepare($query)) {
            $statement->bind_param("s", $user['username']);
            $statement->execute();
            $queryResult = $statement->get_result();
            if ($queryResult->num_rows == 1) {
                $res = $queryResult->fetch_all(MYSQLI_ASSOC);
                if (password_verify($user['password'], $res[0]['password'])) {
                    $result = $res;
                } else {
                    $result = ['invalid-creds' => 'Incorrect username or password.'];
                }
            } else {
                $result = ['invalid-creds' => 'Incorrect username or password.'];
            }
        } else {
            $result = ['request-failed' => 'Request Failed. Try Again.'];
        }
        $statement->close();
        return $result;
    }
}
