<?php

require("../utils/index.php");
require("../connections/index.php");
require("../user/index.php");


if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["action"]) && !empty($_POST["action"])){
    session_start();
    $conn = new Config();
    $action = Utils::sanitize($conn->getConnection(), $_POST["action"]);

    if($action === "register"){

        if(
            isset($_POST["email"]) && !empty($_POST["email"]) &&
            isset($_POST["username"]) && !empty($_POST["username"]) &&
            isset($_POST["password"]) && !empty($_POST["password"]) &&
            isset($_POST["profile"]) && !empty($_POST["profile"]) &&
            isset($_POST["icon"]) && !empty($_POST["icon"]) 
        ){
            $email = Utils::sanitize($conn->getConnection(), $_POST["email"]);
            $password = Utils::sanitize($conn->getConnection(), $_POST["password"]);
            $username = Utils::sanitize($conn->getConnection(), $_POST["username"]);
            $profile = Utils::sanitize($conn->getConnection(), $_POST["profile"]);
            $icon = Utils::sanitize($conn->getConnection(), $_POST["icon"]);
            $userid = md5(time().$email);
            if(Utils::validateEmail($email)){
                $userInstance  = new User($conn->getConnection());
                $user2 = $userInstance->getUserByEmail($email);
                
                if($user2->num_rows < 1){
                    $userDetails = array(
                        "email"=>$email,
                        "password"=>password_hash($password, PASSWORD_DEFAULT),
                        "profile"=>$profile,
                        "username"=>$username,
                        "userid"=>$userid,
                        "icon"=>$icon
                    );

                    $res = $userInstance->addUser($userDetails);
                    if($res === "success"){                        
                        echo "success";
                    }else{
                        echo $res;
                    }
                }
                else{
                    echo "El email ya esta en uso";
                }

            }else{
                echo "El email {$email} no es valido";
            }
        }
        else{
            echo "Todos los campos son requeridos";
        }
    }
    
}else if($_SERVER["REQUEST_METHOD"] === "GET"){
    $conn = new Config();
    $userInstance  = new User($conn->getConnection());
    $users = $userInstance->getUsers();
    
    foreach($users as $row) {
        $username = $row['username'];
        $profile = $row['profile'];
        $email = $row['email'];
        $id = $row['id'];

        echo'
        <div class="file"" data-id="'.$id.'">
            <span><input type="checkbox"></span>
            <span><img src="img/user-icon.svg" style="margin: 0 3px;" alt=""></span>
            <span>'.$username.'</span>
            <span>'.$profile.'</span>
            <span>'.$email.'</span>
        </div>
        ';

    }
}else{
    echo "Ha ocurrido un error";
}


