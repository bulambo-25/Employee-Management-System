
<?php

require_once("../private/initialize.php");

$admin = new Admin();

if (isset($_SESSION['user']))
{
$admin->sessionDestroy();
header("Location: login.php");
}

 ?>
