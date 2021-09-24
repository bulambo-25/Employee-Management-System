<?php require_once("private/initialize.php");
startSession();
authenticateSign();
?>

<?php

$error = $user = $pass = "";

if(isset($_POST['submit_emp']))
{
  $user = $_POST['identity'];
  $pass = $_POST['password'];

  if($user == "" || $pass == "")
  {
    $error = "Not all fields were entered";
  }
  else
  {
    $count = authenticate_user($user, $pass);

    if($count == 0){
      $error = "Username or password invalid";
    }else{
      $_SESSION['user'] = $user;
      $_SESSION['pass'] = $pass;
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
    <link rel="stylesheet" href="assets/style/login.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&family=Roboto+Condensed:wght@300&display=swap"
 rel="stylesheet">
  </head>
  <body>
    <div class="header">
      <div class="form">
        <div class="adminForm">
          <img src="assets/images/account_circle_black_24dp.svg" style="width:75px">
          <h2 style="font-family: 'Open Sans', sans-serif;
          font-family: 'Roboto Condensed', sans-serif;">Login</h2>
        <form action="login.php" method="post">
          <input class="adminName" type="text" name="identity" placeholder="username">
          <input class="adminPass" type="password" name="password" placeholder="password">
          <input class="login" name="submit_emp" type="submit" value="Login">
        </form>
          </div>
      </div>
      <div class="register">

      </div>
      <div class="error">
        <?php echo $error; ?>
      </div>
    </div>
  </body>
</html>
