
<!--Author: Kholani Benelzane 218257465-->
<!--Admin class-->

<?php

class Admin{

//instance variables
private $userName;
private $password;
private $isLoggedIn;

/*public function __construct($userName, $password)
{
  $this->userName   = $userName;
  $this->password   = $password;
}//end of __construct
*/

public function GetUserName(){
  return $this->userName;
}//end of GetUserName method

public function GetPassword(){
  return $this->password;
}//end of GetPassword method

public function GetIsLoggedIn(){
  return $this->isLoggedIn;
}//end of GetIsLoggedIn method

public function CreateSession(){
  session_start();
}//end of CreateSession

public function authenticate(){

  $userStr = "(guest)";

  if(isset($_Session['user'])){
    $this->userName   = $_Session['user'];
    $this->isLoggedIn = TRUE;
    $userStr          = "($user)";
  }//end if

  else{
    $this->isLoggedIn = FALSE;
    die(header("Location: login.php"));
  }//end else

  return $userStr;
}

}//end of Admin class

 ?>
