
<!--Author: Kholani Benelzane 218257465-->
<!--Admin class-->

<?php

class Admin{

//instance variables
private $userName;
private $password;
private $picture;
private $loggedIn = FALSE;

/*public function __construct($userName, $password, $picture)
{
  $this->userName   = $userName;
  $this->password   = $password;
  $this->picture    = $picture;
}//end of __construct
*/

public function GetUserName(){
  return $this->userName;
}//end of GetUserName method

public function GetPassword(){
  return $this->password;
}//end of GetPassword method

public function GetPicture(){
  return $this->picture;
}//end of GetPicture method

public function GetLoggedIn(){
  return $this->loggedIn;
}//end of GetLoggedIn method

public function setLoggedIn($loggedIn){
  $this->loggedIn = $loggedIn;
}

public function sessionDestroy(){
 session_destroy();
}

}//end of Admin class

 ?>
