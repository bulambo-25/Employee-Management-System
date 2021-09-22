
<?php
require_once 'database.php';
require_once 'functions.php';

class Crud{

private $connect;

public function __construct()
{
$this->connect = Database::instance();
}

public function createTables($query){
$this->connect->exec($query);
}

public function insertIntoWorker($obj){
  $identity       = $obj->getIdentity();
  $name           = $obj->getUserName();
  $surname        = $obj->getSurname();
  $tax            = $obj->getTaxNumber();
  $phone          = $obj->getPhone();
  $street         = $obj->getStreetName();
  $city           = $obj->getCity();
  $zipCode        = $obj->getZipCode();
  $province       = $obj->getProvince();
  $email          = $obj->getEmail();
  $picture        = $obj->getPicture();
  $department     = $obj->getDepartment();
  $priviledge     = $obj->getPrivilege();
  $salary         = $obj->getSalary();
  $gender         = $obj->getGender();
  $occupation     = $obj->getOccupation();
  $employee_id    = getNumber_of_users();
  $id             = $employee_id + 1;

   $this->connect->beginTransaction();

  $sql = 'INSERT INTO worker( first_name, second_name, identity_num, gender, tax_num, picture) VALUES(?,?,?,?,?,?)';
  $stmt = $this->connect->prepare($sql);
  $stmt->execute([$name, $surname, $identity, $gender, $tax, $picture]);

  $sql = 'INSERT INTO address(employee_id, phone, street, city, zipCode, province, email)
  VALUES(?,?,?,?,?,?,?)';
  $stmt = $this->connect->prepare($sql);
  $stmt->execute([$id, $phone, $street, $city, $zipCode, $province, $email]);

  $sql = 'INSERT INTO organization_data(employee_id, department, salary, occupation, priviledge) VALUES(?,?,?,?,?)';
  $stmt = $this->connect->prepare($sql);
  $stmt->execute([$id, $department, $salary, $occupation, $priviledge]);

   $this->connect->commit();
}

public function insertIntoDepartments($department){
  $sql = 'INSERT INTO department( department_name ) VALUES(?)';
  $stmt = $this->connect->prepare($sql);
  $stmt->execute([$department]);
}

}

 ?>


<?php


$crud = new Crud();

$crud->createTables('CREATE TABLE IF NOT EXISTS worker(
  employee_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  first_name VARCHAR(250),
  second_name VARCHAR(250),
  identity_num CHAR(13),
  gender VARCHAR(25),
  tax_num CHAR(10),
  picture VARCHAR(250)
);');

$crud->createTables('CREATE TABLE IF NOT EXISTS organization_data(
  employee_id INT NOT NULL,
  department VARCHAR(250),
  salary DOUBLE(15,2),
  occupation VARCHAR(250),
  priviledge VARCHAR(100),
  FOREIGN KEY(employee_id) REFERENCES worker(employee_id)
);');

$crud->createTables('CREATE TABLE IF NOT EXISTS address(
  employee_id INT NOT NULL,
  phone CHAR(10),
  street VARCHAR(250),
  city VARCHAR(250),
  zipCode CHAR(4),
  province VARCHAR(100),
  email VARCHAR(100),
  FOREIGN KEY(employee_id) REFERENCES worker(employee_id)
);');

$crud->createTables('CREATE TABLE IF NOT EXISTS department(
  department_id INT AUTO_INCREMENT,
  department_name VARCHAR(100),
  PRIMARY KEY(department_id)
);');

$crud->createTables('CREATE TABLE IF NOT EXISTS admin(
  admin_id INT AUTO_INCREMENT,
  name VARCHAR(100),
  password VARCHAR(100),
  PRIMARY KEY(admin_id)
);');

 ?>
