<?php

require("./path.php");
require("../utils/index.php");
require("../connections/index.php");
require("../widgets/index.php");

$path = new Path;
$conn = new Config();

if($_SERVER["REQUEST_METHOD"] === "POST" AND isset($_POST["action"]) AND !empty($_POST["action"])){
    $action = Utils::sanitize($conn->getConnection(), $_POST["action"]);

    if($action === "get_current_path"){

        if(isset($_POST["path"]) AND !empty($_POST["path"])){
            $path->setCurrentPath(Utils::sanitize($conn->getConnection(), $_POST["path"]));
        }
        $current_path = $path->getCurrentPath();

        $results = $current_path;
        $results = str_replace($path->getHomeDir(), "/", $results);

        $final_path = "";
        foreach (explode("/", $results) as $p) {
            $final_path .= "<li>$p</li>";
        }

        $res = array(
            "path"=>$final_path,
            "current_path"=>$current_path);
        
        header("Content-Type: application/json");
        echo json_encode($res);
    }
    else if($action === "set_current_path_with_index"){
        $index = Utils::sanitize($conn->getConnection(), $_POST["index"]);
        $current_path = $path->getCurrentIndex($index);

        $results = $current_path;

        $path->setCurrentPath($results);

        $results = str_replace($path->getHomeDir(), "/", $results);

        $final_path = "";
        foreach (explode("/", $results) as $p) {
            $final_path .= "<li>$p</li>";
        }

        $res = array(
            "path"=>$final_path,
            "current_path"=>$current_path);

        header("Content-Type: application/json");
        echo json_encode($res);
    }
    else if($action === "set_current_path"){
        $m_path = Utils::sanitize($conn->getConnection(), $_POST["path"]);

        $path->setCurrentPath($m_path);
        
        $current_path = $m_path;

        $home_dir = $m_path;

        $dir_and_files = scandir($current_path);

        unset($dir_and_files[array_search(".", $dir_and_files)]);
        unset($dir_and_files[array_search("..", $dir_and_files)]);

        $results="";
        foreach ($dir_and_files as $p) {
            if(!is_dir("$home_dir/$p")){
                $results .= Widgets::homeRowListFile($p,"$home_dir/$p");
            }
            else{
                $results .= Widgets::homeRowListFolder($p,"$home_dir/$p");
            }
        }
        header("Content-Type: application/json");
        echo $results;
        
    }else{
        header("HTTP/1.0 404 Not Found");
        echo "<h1>Page not found</h1>";
        echo "La pagina requerida no pudo ser encontrada";
        exit;
    }
}