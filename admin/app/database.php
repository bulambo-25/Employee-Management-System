
<?php

class Database{

private $userName;
private $passWord;
private $database;
private $host;
private $connection;

public function __construct($host, $userName, $passWord, $database)
{
$this->userName   = $userName;
$this->passWord   = $passWord;
$this->database   = $database;
$this->host       = $host;

$connection = new mysqli($host, $userName, $passWord, $database)
or die("Connection could not be established with the server");

$this->connection = $connection;
$this->setConnection($connection);
}

public function setConnection($connection){
  $this->connection = $connection;
}//end of setConnection

public function getConnection(){
  return $this->connection;
}

}
 ?>
