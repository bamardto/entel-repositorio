<?php

class Widgets{

    /* public static function homeFileCard($file_name, $data){
        return '
        <div class="card file" style="height: 100px; width: 100px; background-color:gray" data-path="' . $data . '">
            <p class="card-text text-center w-100">' . $file_name . '</p>
        </div>
        ';
    } */
    public static function homeRowListFile($file_name, $data){
        return '
        <tr class="file" data-path="'.$data.'">
            <td><input type="checkbox"></td>
            <td><img src="img/file-icon.svg" alt=""></td>
            <td>'.$file_name.'</td>
            <td>28 de Sep.</td>
            <td>44,7 KB</td>
        </tr>
        
        ';
    }
    public static function homeRowListFolder($folder_name, $data){
        return '
        <tr class="folder" data-path="'.$data.'">
            <td><input type="checkbox"></td>
            <td><img src="img/folder-icon.svg" alt=""></td>
            <td><a class="td-folder">'.$folder_name.'</a></td>
            <td>28 de Sep.</td>
            <td>44,7 KB</td>
        </tr>
        
        ';
    }

    public static function homeTitleUser($username){
        return '
        <h2>' .$username. '</h2>
        ';
    }

    /* public static function liAndImg($p){
        return '
        <img src="img/breadcrumb-icon.svg" alt=""><li>'.$p.'</li></img>      
        ';
    } */
    
    /* public static function homeFolderCard($folder_name, $data){
        return '
        <div class="card folder" style="height: 100px; width: 100px;" data-path="' . $data . '">
            <p class="card-text text-center w-100">' . $folder_name . '</p>
        </div>
        ';
    } */
    public static function homeNavBar($email, $username, $icon){
        return '
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar w/ text</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <td class="navbar-toggler-icon">' . $icon . '</td>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">' . $email . '</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Features</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Pricing</a>
                </li>
                </ul>
                <td class="navbar-text">
                    '. $username .'
                </td>
            </div>
            </div>
        </nav>
        ';
    }
}