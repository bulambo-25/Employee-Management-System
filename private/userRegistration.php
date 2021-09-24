
<?php
require_once 'crud.php';
require_once 'functions.php';
startSession();

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

 private function generatePassword(){
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
$crud = new Crud();
function is_ajax_request() {
  return isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
    $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest';
}

function is_ajax_request2() {
  return isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
    $_SERVER['HTTP_X_REQUESTED_WITH'] == 'ajaxRequest';
}

function is_ajax_request_3() {
  return isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
    $_SERVER['HTTP_X_REQUESTED_WITH'] == 'addLeave';
}

function is_ajax_request_4() {
  return isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
    $_SERVER['HTTP_X_REQUESTED_WITH'] == 'addLeaveType';
}

function is_ajax_request_5() {
  return isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
    $_SERVER['HTTP_X_REQUESTED_WITH'] == 'updateAccess';
}

if(is_ajax_request2()){
  $department = $_POST['myDepartment'];
  $crud->insertIntoDepartments($department);
}

if(is_ajax_request_3()){
  $leave_name = $_POST['leave_type'];
  $crud = new Crud();
  $crud->insert_leave_type($leave_name);
}

if(is_ajax_request_4()){

  $leave_type = $_POST['selected_leave_type'];
  $leave_date = $_POST['leave_date'];
  $reason = $_POST['reason'];
  $status = 0;
  $emp_id = getUserId();

  $crud->insert_into_emp_leave($emp_id['employee_id'], $leave_type, $leave_date, $reason, $status);
}

if(is_ajax_request_5()){
  $access_type  = $_POST['selecte_access'];
  $employee_id  = getUserId();
  $crud->update_access($access_type, $employee_id['employee_id']);
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

      $saveDir = "../employee_images/";
      $picture = "";
      $newPicture = "";

      if(isset($_FILES['picture'])){
         $errors= array();
         $file_name = $_FILES['picture']['name'];
         $file_size =$_FILES['picture']['size'];
         $file_tmp =$_FILES['picture']['tmp_name'];
         $file_type=$_FILES['picture']['type'];
         $file_ext=strtolower(end(explode('.',$_FILES['picture']['name'])));

         $extensions= array("jpeg","jpg");

         if(in_array($file_ext,$extensions)=== false){
            $errors[]="extension not allowed, please choose a JPEG.";
         }

         if($file_size > 2097152){
            $errors[]='File size must be excately 2 MB';
         }

         $picture    = $saveDir . $identity . '.jpg';
         $newPicture =  $identity . '.jpg';

         if(empty($errors)==true){
            move_uploaded_file($file_tmp, $picture);

            $resource = imagecreatefromjpeg($picture);

            $scaled = imagescale($resource, 125);
            $im2 = imagecrop($scaled, ['x' => 0, 'y' => 0, 'width' => 125, 'height' => 125]);
            if ($im2 !== FALSE) {

                imagejpeg($im2, $picture);
                imagedestroy($im2);
              }

              imagedestroy($resource);

         }
      }

      $registration = new Employee($name, $surname, $identity, $department, $salary,
      $taxNumber, $street, $zipCode, $province, $city, $email, $phone, $privilege, $newPicture,
      $gender, $occupation);
      $obj = $registration;

      $crud = new Crud();
      $crud->insertIntoWorker($obj);
    }
    else{
      return;
    }

 ?>
