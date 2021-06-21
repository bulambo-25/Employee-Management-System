
<?php
require_once 'database.php';

class Crud extends Database{

private $database;
private $employeeObject;

public function __construct()
{
  parent::__construct("localhost", "root", "", "departments");
  $this->database = parent::getConnection();
}

public function createEmployeeDetails($table, $username, $surname, $identity,
  $department, $salary, $taxNumber, $picture, $password){
  $connection = $this->database;
  $query = $connection->prepare("INSERT INTO $table(username, surname, identity,
  department, salary, taxNumber, picture, password) VALUES(?, ?, ?, ?, ?, ?, ?, ?)");
  $query->bind_param("ssssssss", $username, $surname, $identity,$department, $salary,
  $taxNumber, $picture, $password);
  $query->execute();
  $query->close();
}

private function createEmployeeContactDetails($table){
  $connection = $this->database;
  $query = $connection->prepare("INSERT INTO $table(username, street, postalCode, city,province,
  country, phone, email) VALUES(?, ?, ?, ?, ?, ?, ?, ?)");
  $query->bind_param("ssssssss", $street, $postCode, $city, $province, $country, $phone);
  $query->execute();
  $query->close();
}

public function retrieveEmployeeDetails(){
  $connection = $this->database;
  $check = $connection->prepare("SELECT identity FROM EmpoyeeDetails WHERE identity=?");
  $check->bind_param("s", $identity);
  $check->execute();
  $result = $check->get_result();
  $check->close();
  return $result;
}

public function retrieveContactDetails(){
 $connection = $this->database;
 $check = $connection->prepare("SELECT phone FROM contactDetails WHERE phone=?");
 $check->bind_param("s", $phone);
 $check->execute();
 $result = $check->get_result();
 $check->close();
 return $result;
}

public function dbQuery($query){
  $connection = $this->database;
  $check = $connection->prepare($query);
  $check->execute();
  $result = $check->get_result();
  $check->close();
  if (!$connection) die($connection->error);
  return $result;
}

public function createTable($name, $query){
  $dbQuery = "CREATE TABLE IF NOT EXISTS $name($query)";
  $this->dbQuery($dbQuery);
}

public function fetchTables(){
  $result   = array();
  $query    = "SHOW TABLES";
  $tables   = $this->dbQuery($query);

  while($departments = mysqli_fetch_assoc($tables)){
  foreach ($departments as $key) {
  $result[]  = $key;
   }
  }
  return json_encode($result, JSON_FORCE_OBJECT);
 }

 public function sanetizeString($input){
   $connection = $this->database;
   $input = strip_tags($input);
   $input = htmlentities($input);
   $input = stripslashes($input);
   return $connection->real_escape_string($input);
 }

}
 ?>
