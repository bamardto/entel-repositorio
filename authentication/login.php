<?php
  require("../helper/index.php");
  session_start();

  //checkear si el user esta logueado
  if(isset($_SESSION[Helper::SESSION_USER_ID])){
    header("Location: ../");
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
      <link rel="stylesheet" href="../css/jquery.autocompleter.css">
      <link rel="stylesheet" href="../css/main.css?v=1">
   </head>
   <body>

      <main>
         <header>
            <div class="wrapper">
               <h1>
                  <a href="javascript:;">
                     Entel Corp
                     <img src="../img/logo-ecorp.svg" alt="Logo Entel Corp">
                  </a>
               </h1>
               <h2>Repositorio web</h2>
            </div>
         </header>
         <div class="container-login">
            <div class="box-login">
               <div class="title">
                  <h2>Ingresar a <strong>Repositorio web</strong></h2>
               </div>
               <div class="content">
                  <form action="#">
                     <div>
                        <label>Email</label>
                        <input type="text" name="email">
                     </div>
                     <div>
                        <label>Contraseña</label>
                        <input type="password" name="password">
                     </div>
                     <button type="submit">
                        Entrar
                     </button>
                  </form>
               </div>
            </div>
         </div>
      </main>

      
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
      <script src="../js/jquery.autocompleter.js"></script>
      <script src="../js/main.js"></script>
      <script src="../scripts/auth.js"></script>

   </body>
</html>