<?php

require("../utils/index.php");
require("../connections/index.php");
require("../user/index.php");

$conn = new Config();

if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["action"]) && !empty($_POST["action"])){
    $action = Utils::sanitize($conn->getConnection(), $_POST["action"]);
  
    if($action === "login"){
        if(isset($_POST["email"]) && !empty($_POST["email"])){
            $email = Utils::sanitize($conn->getConnection(), $_POST["email"]);
            if(Utils::validateEmail($email)){
                if(isset($_POST["password"]) && !empty($_POST["password"])){
                    $password = Utils::sanitize($conn->getConnection(), $_POST["password"]);
                    $userInstance  = new User($conn->getConnection());
                    $user2 = $userInstance->getUserByEmail($email);
                    if($user2->num_rows > 0){
                        $user = mysqli_fetch_assoc($user2);
                        $password_hash = $user["password"];
                        $userid = $user["userid"];

                        if(Utils::checkPassword($password, $password_hash)){
                            Utils::createLoginSession($userid);
                            echo "success";
                        }
                        else{
                            echo "wrong pass";
                        }
                    }
                    else{
                        echo "El email no esta registrado";
                    }
                }
                else{
                    echo "Por favor introduzca su contrasena";
                }
            }
            else{
                echo "El email {$email} no es valido";
            }
        }
        else{
            echo "Por favor introduzca email";
        }
    }
    
}
else{
    echo "Ha ocurrido un error";
}