<?php
  require("../helper/index.php");
  session_start();

  //checkear si el user esta logueado
  if(isset($_SESSION[Helper::SESSION_USER_ID])){
    header("Location: ../");
  }
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="../styles.css">
    <title>Document</title>
</head>
<body>
    <div class="wrapper fadeInDown">
        <div id="formContent active" class="form-1">
          <!-- Tabs Titles -->
      
          <!-- Icon -->
          <h3>Sign in</h3>
      
          <!-- Login Form -->
          <form action="#">
            <input type="email" id="email" class="fadeIn second" name="email" placeholder="login">
            <input type="password" id="password" class="fadeIn third" name="password" placeholder="password">
            <input type="submit" class="fadeIn fourth" value="Log In">
          </form>
      
          <!-- Remind Passowrd -->
          <div id="formFooter">
            <span class="underlineHover" onclick="registerForm()">no tienes cuenta?</span>
          </div>
      
        </div>

        <div id="formContent" class="form-2">
          <!-- Tabs Titles -->
      
          <!-- Icon -->
          <h3>register</h3>
      
          <!-- Login Form -->
          <!-- <form action="#">
            <input type="email" id="email" class="fadeIn second" name="email" placeholder="email">
            <input type="password" id="password" class="fadeIn third" name="password" placeholder="password">
            <input type="text" id="username" class="fadeIn third" name="username" placeholder="username">
            <input type="text" id="profile" class="fadeIn third" name="profile" placeholder="profile">
            <input type="text" id="icon" class="fadeIn third" name="icon" placeholder="icon">
            <input type="submit" class="fadeIn fourth" value="Register">
          </form> -->
      
          <!-- Remind Passowrd -->
          <div id="formFooter">
            <span class="underlineHover" onclick="loginForm()">ya tienes cuenta?</span>
          </div>
      
        </div>
      </div>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="../scripts/auth.js"></script>
</body>
</html>