
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

public function createEmployeeDetails($table, $obj){
  $employee   = $obj;
  $connection = $this->database;
  $username   = $employee->getUserName();
  $surname    = $employee->getSurname();
  $identity   = $employee->getIdentity();
  $department = $employee->getDepartment();


  $query = $connection->prepare("INSERT INTO $table(username, surname, identity,
  department) VALUES(?, ?, ?, ?)");
  $query->bind_param("ssss", $username, $surname, $identity, $department);
  $query->execute();
  $query->close();
}

/*public function retrieveContact(){
  $salary     = $employee->getSalary();
  $taxNumber  = $employee->getTaxNumber();
  $picture    = $employee->getPicture();
  $passWord   = $employee->getPassword();
  $streetName = $employee->getStreetName();
  $zipCode    = $employee->getZipCode();
  $city       = $employee->getCity();
  $privilege  = $employee->getPrivilege();
  $phone      = $employee->getPhone();
  $email      = $employee->getEmail();
}*/

public function retrieveEmployeeDetails(){
  $rows = array();
  $check = "SELECT * FROM employee";
  $result = $this->dbQuery($check);

  while($details = mysqli_fetch_assoc($result)){
  foreach ($details as $key) {
  $rows[]  = $key;
   }
  }
  return json_encode($rows, JSON_FORCE_OBJECT);
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
