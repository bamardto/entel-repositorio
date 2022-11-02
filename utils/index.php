<?php
require_once("../helper/index.php");
class Utils{

    public static function createLoginSession($userId){
        session_start();
        $_SESSION[Helper::SESSION_USER_ID] = $userId;
    }

    public static function removeLoginSession($userId){
        session_start();
        unset($_SESSION[Helper::SESSION_USER_ID]);
    }

    public static function sanitize($conn, $string){
        return mysqli_real_escape_string($conn, $string);
    }
    //CHECK EMAIL IS VALID
    public static function validateEmail($email){
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public static function checkPassword($password, $password_hash){
        return password_verify($password, $password_hash);
    }
    
}