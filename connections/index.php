<?php
class Config{
    public $conn;
    public $username;
    public $password;
    public $db;
    public $host;

    public function __construct(
        $username = "root",
        $password = "",
        $host = "localhost",
        $db = "corp_repo"
    )
    {
        $this->username = $username;
        $this->password = $password;
        $this->host = $host;
        $this->db = $db;

        $con = mysqli_connect($this->host, $this->username, $this->password);


        if ($con) {
            $statement = "CREATE DATABASE IF NOT EXISTS {$this->db}";

            if(mysqli_query($con, $statement)){
                $this->conn = mysqli_connect($this->host, $this->username, $this->password, $this->db);
            }
            else{
                die("ocurrio un error al crear la bd");
            }
        }
        else {
            die("Ha ocurrido un error en la coneccion");
        }
    }

    public function getConnection(){
        return $this->conn;
    }

}