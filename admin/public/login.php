<?php require_once("../private/initialize.php");
startSession();
authenticateSign();
 ?>

<?php

$error = $email = $password = "";

if(isset($_POST['adminName']))
{
  $email    = $_POST['adminName'];
  $password = $_POST['adminPass'];

  if($email == "" || $password == "")
  {
    $error = "Not all fields were entered";
  }
  else
  {

    $count = count_admins_login($email, $password);

    if($count == 0){
      $error = "Username or password invalid";
    }else{
      $_SESSION['admin'] = $email;
      $_SESSION['admin_pass'] = $password;
      header("Location: index.php");
    }
  }

}

 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="../public/assets/style/login.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&family=Roboto+Condensed:wght@300&display=swap"
 rel="stylesheet">
  </head>
  <body>
    <div class="header">
      <div class="form">
        <div class="adminForm">
          <img src="../public/assets/images/account_circle_black_24dp.svg" style="width:75px">
          <h2 style="font-family: 'Open Sans', sans-serif;
          font-family: 'Roboto Condensed', sans-serif;">Login</h2>
        <form action="login.php" method="post">
          <input class="adminName" type="text" name="adminName" placeholder="email">
          <input class="adminPass" type="password" name="adminPass" placeholder="password">
          <input class="login" type="submit" value="Login">
        </form>
          </div>
      </div>
      <div class="register">
        <a href="register.php">Don't have an account yet, register</a>
      </div>
      <div class="error">
        <?php echo $error; ?>
      </div>
    </div>
  </body>
</html>
