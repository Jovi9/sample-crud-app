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
     function getUser($id)
     {
          $result = array();
          $query = "select * from users where user_id=?";
          $statement = $this->connection->stmt_init();
          if ($statement->prepare($query)) {
               $statement->bind_param("i", $id);
               $statement->execute();
               $queryResult = $statement->get_result();
               if ($queryResult->num_rows == 1) {
                    $result = $queryResult->fetch_all(MYSQLI_ASSOC);
               } else {
                    $result = null;
               }
          } else {
               $result = null;
          }
          $statement->close();
          return $result;
     }
     function update(array $request): array
     {
          $result = array();
          $query = "update users set name=?, updated_at=now() where user_id=?";
          $statement = $this->connection->stmt_init();
          if ($statement->prepare($query)) {
               $statement->bind_param("si", $request['name'], $request['id']);
               $statement->execute();
               if ($statement->affected_rows == 1) {
                    $result = $this->getUser($request['id']);
               } else {
                    $result = ['update-failed' => 'Failed to update profile, please try again.'];
               }
          } else {
               $result = ['request-failed' => 'Request Failed.'];
          }
          $statement->close();
          return $result;
     }
     function loadUsers(): array
     {
          $result = array();
          $query = "select user_id, name, username, created_at, updated_at from users;";
          $statement = $this->connection->stmt_init();
          if ($statement->prepare($query)) {
               $statement->execute();
               $queRes = $statement->get_result();
               if ($queRes->num_rows > 0) {
                    $result = $queRes->fetch_all(MYSQLI_ASSOC);
               } else {
                    $result = ['null' => 'No users found.'];
               }
          } else {
               $result = ['null' => 'No users found.'];
          }
          $statement->close();
          return $result;
     }

     function GetNumberOfUsers(): int
     {
          $count = 0;
          $query = 'select count(user_id) as NumberOfUsers from users;';
          $statement = $this->connection->stmt_init();
          if ($statement->prepare($query)) {
               $statement->execute();
               $que = $statement->get_result();
               if ($que->num_rows > 0) {
                    $count = $que->fetch_all(MYSQLI_ASSOC)[0]['NumberOfUsers'];
               }
          }
          return $count;
     }
}
