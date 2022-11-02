<?php


class User{
    public $conn;

    public $table_name;
    public $table_storage;



    public function __construct($conn){
        $this->conn = $conn;

        $this->table_name = "user";
        $this->table_storage = "storage";

        $statement = "CREATE TABLE IF NOT EXISTS {$this->table_name}(
            id INT(11) PRIMARY KEY AUTO_INCREMENT,
            email VARCHAR(255) NOT NULL,
            profile VARCHAR(255) NOT NULL,
            username VARCHAR(255) NOT NULL,
            userid VARCHAR(255) NOT NULL,
            password VARCHAR(255) NOT NULL,
            icon VARCHAR(255) NOT NULL,
            created_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP)";

        if(!mysqli_query($this->conn, $statement)){
            die("ocurrio un error al crear la tabla {$this->table_name}" . mysqli_error($this->conn));
        }

        $statement2 = "CREATE TABLE IF NOT EXISTS {$this->table_storage}(
            id INT(11) PRIMARY KEY AUTO_INCREMENT,
            userid VARCHAR(255) NOT NULL,
            storage DOUBLE NOT NULL,
            created_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP)";
        

        if(!mysqli_query($this->conn, $statement2)){
            die("ocurrio un error al crear la tabla {$this->table_storage}" . mysqli_error($this->conn));
        }

        //cada vez que un usuario se registre, se agregará un nuevo registro a la tabla de almacenamiento
        //esto se hara por medio de un trigger

    }

    public function addUser($user){

        $email = $user["email"];
        $password = ($user["password"]);
        $profile = $user["profile"];
        $username = $user["username"];
        $userid = $user["userid"];
        $icon = $user["icon"];
       

        $statement = "INSERT INTO {$this->table_name} (email, username,userid, profile, password, icon) VALUES(
                                                    '{$email}','{$username}','{$userid}','{$profile}','{$password}','{$icon}')";

        if(mysqli_query($this->conn, $statement)){
            return "success";
        }
        else{
            return "No se pudo agregar el user por : " . mysqli_error($this->conn);
        }
    }

    public function getUserByEmail($email){
        $statement = "SELECT * FROM {$this->table_name} WHERE email = '{$email}'";

        return mysqli_query($this->conn, $statement);
    }

    public function getUserByUserId($userid){
        $statement = "SELECT email,icon,username,profile FROM {$this->table_name} WHERE userid = '{$userid}'";

        return mysqli_query($this->conn, $statement);
    }
    //08d88ea61830195e57c6be44606f115c
    public function getStorageByUserId($userid){
        $statement = "SELECT * FROM {$this->table_storage} WHERE userid = '{$userid}'";

        return mysqli_query($this->conn, $statement);
    }

    public function getUsers(){
        $statement = "SELECT * FROM {$this->table_name}";
        return mysqli_query($this->conn, $statement);
    }
}