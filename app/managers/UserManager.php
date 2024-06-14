<?php

namespace App\Managers;

class UserManager {

    public function checkLogin($user, $pass) {
        //$hash = Database::queryOne('SELECT password FROM users WHERE name=?', array($username));
        $password = $user->getPassword();

        return password_verify($pass, $password);
    }

    public function addUser($username, $pass) {
        $hash = password_hash($pass, PASSWORD_DEFAULT);
        Database::query('INSERT INTO users(name,password) VALUES(?,?)', array($username, $hash));
    }

    public function getAll() {
        return Database::queryAll("SELECT * FROM users");
    }

    public function deleteUser($id) {
        Database::query('DELETE FROM users WHERE id=?', array($id));
    }

}
