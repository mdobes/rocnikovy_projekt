<?php

namespace App\Managers;

use App\Entities\User;

class LoginManager {

    private static $prefix = "blog_";
    private static $user;

    public static function login($id) {
        $_SESSION[self::$prefix. "id"] = $id;
    }

    public static function logout() {
        unset($_SESSION[self::$prefix. "id"]);
    }

    public static function isLogged() {
        return isset($_SESSION[self::$prefix. "id"]);
    }

    /*public static function getLoggedUser() {
        return $_SESSION[self::$prefix. "username"];
    }*/

    public static function getUser() {
        if(!isset(self::$user)){
            self::$user = DatabaseManager::getEntityManager()->getRepository(User::class)->findOneBy(['id' => self::getID()]);
        }
        return self::$user;
    }

    public static function getID() {
        return $_SESSION[self::$prefix. "id"];
    }

}
