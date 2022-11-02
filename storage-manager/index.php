<?php

require("../utils/index.php");
require("../connections/index.php");
require("../user/index.php");

$size = 0;

getSize();

//echo $size; //in bytes

if($_SERVER["REQUEST_METHOD"] === "POST" AND isset($_POST["action"]) AND !empty($_POST["action"])){
    session_start();
    $config = new Config();
    $user = new User($config->getConnection());

    $action = Utils::sanitize($config->getConnection(), $_POST["action"]);

    $res = array();
    $user_2 = mysqli_fetch_assoc($user->getStorageByUserId($_SESSION[Helper::SESSION_USER_ID]));

    if($action === "get_storage"){
        getSize("../uploads/user_" . $_SESSION[Helper::SESSION_USER_ID] . "/");
        $res = array(
            "current"=>$size,
            "total"=> $user_2["storage"]
        );

    }

    header("Content-Type: application/json");
    echo json_encode($res);

}else{
    header("HTTP/1.0 404 Not Found");
    echo "<h1>Page not found</h1>";
    echo "La pagina requerida no pudo ser encontrada";
    exit;
}

function getSize($path = '../uploads/'){

    $files_and_folders = scandir($path);

    //chequeamos si el array no contiene ni carpetas ni archivos
    if(count($files_and_folders) < 0){
        return;
    }

    //aca removeremos . ..    
    unset($files_and_folders[array_search(".", $files_and_folders)]);
    unset($files_and_folders[array_search("..", $files_and_folders)]);

    foreach ($files_and_folders as $fi_fo) {


        //revisamos si una carpeta o archivo
        if(is_dir("$path/$fi_fo")){

            getSize("$path/$fi_fo");
            //esta funcion escanea todas las carpetas que se obtienen del directorio

        }else{
            $GLOBALS["size"] += filesize("$path/$fi_fo");
        }
    }
}