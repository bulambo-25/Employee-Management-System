<?php require_once("../private/initialize.php");
startSession();
?>

<?php
$error = $user = $pass = "";

if (isset($_SESSION['admin'])) destroySession();
if(isset($_POST['userName']))
{
  $user = $_POST['userName'];
  $pass = $_POST['password'];

  if($user == "" || $pass == "")
  {
    $error = "Not all fields were entered";
  }
  else
  {
    $count = count_admins($user);

    if($count > 0){
      $error = "That username already exists";
    }
    else{
      insert_admin($user, $pass);
      $error = "Account created please loggin";
    }
  }
}

 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="../public/assets/style/register.css">
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
          font-family: 'Roboto Condensed', sans-serif;">Register</h2>
        <form action="register.php" method="post">
          <input class="adminName" type="email" name="userName" placeholder="email">
          <input class="adminPass" type="password" name="password" placeholder="password">
          <input type="submit" value="Register" class="register">
        </form>

          </div>
          <div class="in">
            <a  href="login.php">registered already, sign in</a>
          </div>
          <div class="error">
          <?php echo $error ?>
          </div>
      </div>
    </div>
  </body>
</html>
