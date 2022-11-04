<?php
  require("./helper/index.php");
  require("./widgets/index.php");
  require("./user/index.php");
  require("./connections/index.php");
  session_start();
  if(!isset($_SESSION[Helper::SESSION_USER_ID])){
    header("Location: ./authentication/login.php");
  }
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
      <title></title>
      <meta http-equiv="Cache-Control" content="no-cache"/>
      <link rel="shortcut icon" type="image/png" href="img/favicon.png">
      <link rel="stylesheet" href="css/jquery.autocompleter.css">
      <link rel="stylesheet" href="css/main.css?v=2">
      
   </head>
   <body>

      <main>
         <header>
            <div class="wrapper">
               <div class="overlay"></div>
               <div class="filter">
                  <select>
                     <option value="hide">Filtrar por</option>
                     <option>Tipo</option>
                     <option>Nombre</option>
                     <option>Modificado</option>
                     <option>Tamaño de archivo</option>
                     <option>Ascendente</option>
                     <option>Descendente</option>
                  </select>
               </div>    
               <h1>
                  <a href="javascript:;">
                     Entel Corp
                     <img src="img/logo-ecorp.svg" alt="Logo Entel Corp">
                  </a>
               </h1>
               <h2>Repositorio web</h2>
               <a href="javascript:;" class="open-search">
                  <img src="img/search-icon.svg" alt="">
               </a>
               <div class="search">
                  <input type="text" placeholder="Buscar..." id="search-box">
                  <button>
                     <img src="img/search-icon.svg" alt="">
                     <img src="img/search-icon-black.svg" alt="">
                  </button>
               </div>
               <a href="javascript:;" class="logout">
                  <img src="img/logout-icon.svg" alt="">
                  Salir
               </a>
            </div>
         </header>
         <div class="container">
            <aside class="sidebar">
               <?php
               $config = new Config();
               $user = new User($config->getConnection());
               $res = mysqli_fetch_assoc($user->getUserByUserId($_SESSION[Helper::SESSION_USER_ID]));
               if($res){
                  echo Widgets::homeTitleUser($res["username"]);
               }
               ?>
               <ul>
                  <li class="active">
                     <a href="">
                        <div class="image">
                           <img src="img/folder-icon.svg" alt="">
                           <img src="img/folder-icon-active.svg" alt="">
                        </div>
                        <span class="btn_sidebar" data-pos="0">Archivos</span>
                     </a>
                  </li>
                  <li>
                     <a href="#">
                        <div class="image">
                           <img src="img/clock-icon.svg" alt="">
                           <img src="img/clock-icon-active.svg" alt="">
                        </div>
                        <span class="btn_sidebar" data-pos="1">Recientes</span>
                     </a>
                  </li>
                  <li>
                     <a href="#">
                        <div class="image">
                           <img src="img/trash-icon.svg" alt="">
                           <img src="img/trash-icon-active.svg" alt="">
                        </div>
                        <span class="btn_sidebar" data-pos="2">Papelera de<br>reciclaje</span>
                     </a>
                  </li>
                  <?php
                     $config = new Config();
                     $user = new User($config->getConnection());
                     $res = mysqli_fetch_assoc($user->getUserByUserId($_SESSION[Helper::SESSION_USER_ID]));
                     
                     if($res["profile"] == "administrador"){
                        echo '
                        <li>
                           <a href="#">
                              <div class="image">
                              <img src="img/user-icon.svg" alt="">
                              <img src="img/user-icon-active.svg" alt="">
                              </div>
                              <span class="btn_sidebar" data-pos="3">Usuarios</span>
                           </a>
                        </li>
                        ';
                     }
                  ?>
               </ul>
               <!-- PROGRESSBAR VALOR DE LO USADO POR USER EJ: 2GB DE 20GB -->
               <div style="display:none;"class="progress-container">
                     <p>size</p>
                     <div class="progress">
                        <span class="progress-bar"></span>
                     </div>
               </div>
            </aside>
            <div id="main-content-tool">
               <div class="tools">
                  <nav>
                     <ul class="primary">
                           <?php
                           $config = new Config();
                           $user = new User($config->getConnection());
                           $res = mysqli_fetch_assoc($user->getUserByUserId($_SESSION[Helper::SESSION_USER_ID]));
                           
                           if($res["profile"] == "administrador" || $res["profile"] == "intermedio"){
                              echo '
                              <li class="new-btn">
                                 <a href="javascript:;">Nuevo</a>
                                 <ul>
                                    <li>
                                       <a href="javascript:;">
                                          <div class="image">
                                             <img src="img/yellow-folder-icon.svg" alt="">
                                          </div>
                                          <span>Carpeta</span>
                                       </a>
                                    </li>
                                    <li>
                                       <a href="javascript:;">
                                          <div class="image">
                                             <img src="img/word-icon.svg" alt="">
                                          </div>
                                          <span>Word</span>
                                       </a>
                                    </li>
                                    <li>
                                       <a href="javascript:;">
                                          <div class="image">
                                             <img src="img/excel-icon.svg" alt="">
                                          </div>
                                          <span>Excel</span>
                                       </a>
                                    </li>
                                    <li>
                                       <a href="javascript:;">
                                          <div class="image">
                                             <img src="img/powerpoint-icon.svg" alt="">
                                          </div>
                                          <span>PowerPoint</span>
                                       </a>
                                    </li>
                                    <li>
                                       <a href="javascript:;">
                                          <div class="image">
                                             <img src="img/image-icon.svg" alt="">
                                          </div>
                                          <span>Imágen</span>
                                       </a>
                                    </li>         
                                 </ul>
                              </li>
                              ';
                           }
                           ?>
                        
                     </ul>
                     <a href="javascript:;" class="open-secondary">
                        <img src="img/mob-tools-btn.svg" alt="">
                        <img src="img/mob-tools-close.svg" alt="">
                     </a>
                     <ul class="secondary">
                        <li class="upload-btn">
                           <?php
                           $config = new Config();
                           $user = new User($config->getConnection());
                           $res = mysqli_fetch_assoc($user->getUserByUserId($_SESSION[Helper::SESSION_USER_ID]));
                           
                           if($res["profile"] == "administrador" || $res["profile"] == "intermedio"){
                              echo '
                              <a href="javascript:;">
                                 <div class="image">
                                    <img src="img/upload-btn.svg" alt="">
                                 </div>
                                 <span>Cargar</span>
                              </a>
                              ';
                           }
                           ?>
                           <ul>
                              <li>
                                 <a href="javascript:;">
                                    Archivo
                                    <input type="file" class="file">
                                 </a>
                              </li>
                              <li>
                                 <a href="javascript:;">
                                    Carpetas
                                    <input type="file" class="file">
                                 </a>
                              </li>
                           </ul>
                        </li>
                        <li class="disabled">
                           <a href="javascript:;">
                              <div class="image">
                                 <img src="img/download-btn-disabled.svg" alt="">
                                 <img src="img/download-btn.svg" alt="">
                              </div>
                              <span>Descargar</span>
                           </a>
                        </li>
                        <li class="disabled">
                           <a href="javascript:;">
                              <div class="image">
                                 <img src="img/trash-btn-disabled.svg" alt="">
                                 <img src="img/trash-btn.svg" alt="">
                              </div>
                              <span>Eliminar</span>
                           </a>
                        </li>
                     </ul>
                  </nav>
               </div>
               <div class="main-content">
                  <div class="wrapper">
                     <div class="title">
                     </div>
                     <div class="table-wrap">
                        <table>
                           <tr>
                              <th><input type="checkbox" class="select-all"></th>
                              <th><img src="img/file-icon.svg" alt=""></th>
                              <th>Nombre</th>
                              <th>Modificado</th>
                              <th>Tamaño de archivo</th>
                           </tr>
                           <tr class="content">
                           </tr>
                        </table>
                           
                     </div>
                  </div>
               </div>   
            </div>
            <div id="main-content-tool-user" style="display:none;">
               <div class="tools">
                  <nav>
                     <ul class="primary">
                        <li class="btn-create-user">
                           <a href="javascript:;">Crear usuario</a>
                        </li>
                     </ul>
                     <a href="javascript:;" class="open-secondary">
                        <img src="img/mob-tools-btn.svg" alt="">
                        <img src="img/mob-tools-close.svg" alt="">
                     </a>
                     <ul class="secondary">
                        <li class="btn-edit-user disabled">
                           <a href="javascript:;">
                              <div class="image">
                                 <img src="img/edit-btn-disabled.svg" alt="">
                                 <img src="img/edit-btn.svg" alt="">
                              </div>
                              <span>Editar</span>
                           </a>
                        </li>
                        <li class="btn-delete-user disabled">
                           <a href="javascript:;">
                              <div class="image">
                                 <img src="img/trash-btn-disabled.svg" alt="">
                                 <img src="img/trash-btn.svg" alt="">
                              </div>
                              <span>Eliminar</span>
                           </a>
                        </li>
                     </ul>
                  </nav>
               </div>
               <div class="main-content">
                  <div class="wrapper">
                     <div class="title-user">
                        Usuarios
                     </div>
                     <div class="table-wrap">
                        <table>
                           <tr>
                              <th><input type="checkbox" class="select-all"></th>
                              <th><img src="img/user-icon-blue.svg" alt=""></th>
                              <th>Nombre</th>
                              <th>Perfil</th>
                              <th>Email</th>
                           </tr>
                           <tr class="content-user">

                           </tr>
                        </table>
                     </div>
                  </div>
               </div>  
               
            </div>
         </div>
         <div class="blur-overlay"></div>
                  <div class="modal create-user">
                     <h2>Crear usuario</h2>
                        <form id="formAddUser">
                           <input type="email" placeholder="Email" name="email" class="required">
                           <input type="password" placeholder="Contraseña" name="password" class="required">
                           <input type="text" placeholder="Usuario" name="username" class="required">
                           <input type="text" placeholder="Perfil" name="profile" class="required">
                           <input type="text" placeholder="Icon" name="icon" class="required">
                           <button type="submit">Crear</button>
                           
                        </form>
                  </div>
                  <div class="modal edit-user">
                     <h2>Editar usuario</h2>
                     <input type="text" placeholder="Nombre" value="Darwin">
                     <input type="text" placeholder="Rut" value="00.0000-0">
                     <input type="email" placeholder="Email" value="digitalbeat@digitalbeat.cl">
                     <input type="password" placeholder="Contraseña" value="123456">
                     <button type="button" class="toggle-disabled">Guardar</button>
                  </div>
                  <div class="modal delete-user">
                     <h2>Confirma si deseas eliminar al usuario 01</h2>
                     <div class="wrap">
                        <a href="javascript:;" class="yes">Si</a>
                        <a href="javascript:;" class="no">No</a>
                     </div>
                  </div>

         <div class="blur-overlay"></div>
         <div class="modal folder">
            <h2>Crear una carpeta</h2>
            <input type="text" placeholder="Escribe el nombre de  tu carpeta" class="required">
            <button type="button" class="toggle-disabled" disabled>Crear</button>
         </div>
      </main>

      
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
      <script src="js/jquery.autocompleter.js"></script>
      <script src="js/main.js?v=2"></script>

      <script src="./init.js" type="module"></script>
      <script src="scripts/create-user.js"></script>
   </body>
</html>