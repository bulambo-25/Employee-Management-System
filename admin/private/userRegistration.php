
<?php
require_once 'crud.php';

class Employee{

private $userName;
private $surname;
private $identity;
private $department;
private $salary;
private $taxNumber;
private $streetName;
private $zipCode;
private $province;
private $city;
private $email;
private $phone;
private $privilege;
private $picture;
private $gender;
private $occupation;

  public function __construct($userName, $surname, $identity, $department, $salary,
  $taxNumber, $streetName, $zipCode, $province, $city, $email, $phone, $privilege,$picture,
  $gender, $occupation)
  {
    $this->userName    = $userName;
    $this->surname     = $surname;
    $this->identity    = $identity;
    $this->department  = $department;
    $this->salary      = $salary;
    $this->taxNumber   = $taxNumber;
    $this->streetName  = $streetName;
    $this->zipCode     = $zipCode;
    $this->province    = $province;
    $this->city        = $city;
    $this->email       = $email;
    $this->phone       = $phone;
    $this->privilege   = $privilege;
    $this->picture     = $picture;
    $this->gender      = $gender;
    $this->occupation  = $occupation;
  }//end of constructor

  public function getUsername(){
    return $this->userName;
  }//end of getUserName method

  public function getSurname(){
    return $this->surname;
  }//end of getsurname

  public function getIdentity(){
    return $this->identity;
  }//end of getIdentity

  public function getDepartment(){
    return $this->department;
  }//end of getDepartment

  public function getSalary(){
    return $this->salary;
  }

  public function getTaxNumber(){
    return $this->taxNumber;
  }

  public function getStreetName(){
    return $this->streetName;
  }

  public function getProvince(){
    return $this->province;
  }

  public function getZipCode(){
    return $this->zipCode;
  }

  public function getCity(){
    return $this->city;
  }

  public function getEmail(){
    return $this->email;
  }

  public function getPrivilege(){
    return $this->privilege;
  }

  public function getPhone(){
    return $this->phone;
  }

  public function getPicture(){
    return $this->picture;
 }

 private function generatePassword($passWord){
 $str = "Emp";
 $passWord = $str.$this->identity;
 return $passWord;
}

public function getPassword(){
 return $this->generatePassword();
}

public function getGender(){
  return $this->gender;
}

public function getOccupation(){
  return $this->occupation;
}

}//end of user class

 ?>

<?php

function is_ajax_request() {
  return isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
    $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest';
}

function is_ajax_request2() {
  return isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
    $_SERVER['HTTP_X_REQUESTED_WITH'] == 'ajaxRequest';
}

if(is_ajax_request2()){
  $department = $_POST['myDepartment'];
  $crud->insertIntoDepartments($department);
}

    if(is_ajax_request()) {
      $name       = $_POST['name'];
      $surname    = $_POST['surname'];
      $identity   = $_POST['identity'];
      $department = $_POST['select'];
      $taxNumber  = $_POST['taxNumber'];
      $salary     = $_POST['salary'];
      $phone      = $_POST['phone'];
      $street     = $_POST['street'];
      $city       = $_POST['city'];
      $zipCode    = $_POST['zipcode'];
      $province   = $_POST['province'];
      $email      = $_POST['email'];
      $gender     = $_POST['gender'];
      $occupation = $_POST['occupation'];
      $privilege  = $_POST['priviledge'];
      $picture    = $_FILES['picture']['name'];

      $registration = new Employee($name, $surname, $identity, $department, $salary,
      $taxNumber, $street, $zipCode, $province, $city, $email, $phone, $privilege, $picture,
      $gender, $occupation);
      $obj = $registration;

      $crud = new Crud();
      $crud->insertIntoWorker($obj);

    }
    else{
      return;
    }

 ?>
