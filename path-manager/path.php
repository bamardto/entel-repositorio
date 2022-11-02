<?php

require("../helper/index.php");

session_start();

class Path{
    public function __construct(){
        $this->HomeDir = "../uploads/user_" . $_SESSION[Helper::SESSION_USER_ID] . "/";

        //default path
        $this->default_paths = array(
            "Archivos/",
            "Recientes/",
            "Papelera/",
        );

        foreach($this->default_paths as $path){
            if(!file_exists($this->HomeDir . $path)){
                mkdir($this->HomeDir . $path, 777, true);
            }
        }
    }
    public function getHomeDir(){
        return $this->HomeDir;
    }
    public function getCurrentIndex($number){
        return $this->HomeDir . $this->default_paths[$number];
    }
    public function getCurrentPath(){
        if(!isset($_SESSION[Helper::SESSION_CURRENT_PATH])){
              //Current directory
            $_SESSION[Helper::SESSION_CURRENT_PATH] = $this->HomeDir . "/";
        }
        return $_SESSION[Helper::SESSION_CURRENT_PATH];
    }
    public function setCurrentPath($path){
        $_SESSION[Helper::SESSION_CURRENT_PATH] = $path;
    }
}