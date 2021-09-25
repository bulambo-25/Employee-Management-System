
<?php

require_once("Database.php");

function sanitizeString($input){
  $input = trim($input);
  $input = htmlentities($input);
  $input = stripslashes($input);
  return $input;
}

function connect(){
  $pdo = Database::instance();
  return $pdo;
}

function destroySession()
{
  $_SESSION=array();
  if (session_id() != "" || isset($_COOKIE[session_name()]))
  setcookie(session_name(), '', time()-2592000, '/');
  session_destroy();
}

function checkIdenticalInput($input, $input2)
{
  $input  = sanitizeString($input);
  $input2 = sanitizeString($input2);

  if (strcmp($input, $input2) == 0) {
    return true;
  }
  else{
    return false;
  }
}

function emailValidation($email){
  $sanitized_email = filter_var($email, FILTER_SANITIZE_EMAIL);
  if (filter_var($sanitized_email, FILTER_VALIDATE_EMAIL)) {
      return true;
  }
  else{
    return false;
  }
}

function finalEmailValidation($email){

    $sanitized_email = filter_var($email, FILTER_SANITIZE_EMAIL);

    if (filter_var($sanitized_email, FILTER_VALIDATE_EMAIL)) {
        return $sanitized_email;
    }

  }

function has_presence($input)
{
   if(isset($input) && $input !== ""){
    return true;
   }
}

function has_length($value, $options=[]) {

	if(isset($options['max']) && (strlen($value) > (int)$options['max'])) {
		return false;
	}

	if(isset($options['min']) && (strlen($value) < (int)$options['min'])) {
		return false;
	}

	return true;
}

function authenticate()
{

  if(!isset($_SESSION['admin']))
  {
    header("Location: login.php");
  }

}

function authenticateSign(){

  if(isset($_SESSION['admin']))
  {
    header("Location: index.php");
  }
}

function startSession()
{
  if (session_id() == "") {
      session_start();
     }
}

function logout() {

  if (isset($_SESSION['admin']))
  {
    destroySession();
    header("Location: login.php");
  }
}

function loadDepartments(){
  $pdo = connect();
  $stmt = $pdo->query("SELECT * FROM department");
  $departments = $stmt->fetchAll();

  foreach ($departments as $key => $row) {
  echo "<option>" . $row['department_name'] . "</option>";
  }

}

function showEmployees(){

  $pdo = connect();
  $data = $pdo->query("SELECT * FROM worker")->fetchAll();
  foreach ($data as $row) {
    echo "<a href='" ."viewUser.php?user=" . $row['employee_id'] ."'><div><div><img src='../../employee_images/".$row['picture']."'></div><div>" . $row['first_name'] .
    "</div><div>" .$row['second_name'] . "</div><div>" . $row['identity_num'] . "</div><div>". $row['tax_num'] ."</div></div></a>";
}

}

function get_selected_user($user){
  return $user;
}

function getNumber_of_users(){
  $pdo   = connect();
  $stmt  = $pdo->query("SELECT COUNT(*) FROM worker");
  $count = $stmt->fetchColumn();
  return $count;
}

function show_user_details($user){

  $pdo = connect();

  $pdo->beginTransaction();

  $stmt = $pdo->prepare("SELECT * FROM worker WHERE employee_id=?");
  $stmt->execute([$user]);
  $result = $stmt->fetchAll();

  $stmt = $pdo->prepare("SELECT * FROM address WHERE employee_id=?");
  $stmt->execute([$user]);
  $result2 = $stmt->fetchAll();

  $stmt = $pdo->prepare("SELECT * FROM organization_data WHERE employee_id=?");
  $stmt->execute([$user]);
  $result3 = $stmt->fetchAll();

  $pdo->commit();

  foreach ($result as $key => $value) {

    echo "<div class='worker'>
        <div class='emp_picture'>
        <img src='../../employee_images/".$value['picture']."'>
        </div>
        <div class='emp_name'>
          <input type='text' name='' value='Name: ".$value['first_name']."' disabled>
          <input type='text' name='' value='Surname: ".$value['second_name']."' disabled>
          <input type='text' name='' value='Identity number: ".$value['identity_num']."' disabled>
          <input type='text' name='' value='Gender: ".$value['gender']."' disabled>
          <input type='text' name='' value='Tax number: ".$value['tax_num']."' disabled>
        </div>
      </div>";

  }

  foreach ($result2 as $key => $value) {

    echo "<div class='address'>
    <div class='info_emp'>Contact info</div>
    <div class='emp_address'>
    <input type='text' name='' value='Phone: ".$value['phone']."' disabled>
    <input type='text' name='' value='Street name: ".$value['street']."' disabled>
    <input type='text' name='' value='Zip Code: ".$value['zipCode']."' disabled>
    <input type='text' name='' value='Province: ".$value['province']."' disabled>
    <input type='text' name='' value='Email: ".$value['email']."' disabled>
    </div>
    </div>";
  }

  foreach ($result3 as $key => $value) {
    echo "<div class='department_data'>
    <div class='info_department'>Organization info</div>
    <div class='emp_address'>
    <input type='text' name='' value='Department: ".$value['department']."' disabled>
    <input type='text' name='' value='Salary: ".$value['salary']."' disabled>
    <input type='text' name='' value='occupation: ".$value['occupation']."' disabled>
    <input type='text' name='' value='Access type: ".$value['priviledge']."' disabled>
    </div>
    </div>";
  }

}

//registration form
function count_admins($email){
  $pdo = connect();
  $stmt = $pdo->prepare("SELECT count(*) FROM admin WHERE email = ?");
  $stmt->execute([$email]);
  $count = $stmt->fetchColumn();
  return $count;
}

//login form
function count_admins_login($email, $password){
  $pdo = connect();
  $stmt = $pdo->prepare("SELECT count(*) FROM admin WHERE email = ? AND password=?");
  $stmt->execute([$email, $password]);
  $count = $stmt->fetchColumn();
  return $count;
}

function insert_admin($name,$surname, $user, $pass, $picture){
  $pdo = connect();
  $sql = 'INSERT INTO admin( name, surname, email, password, picture ) VALUES(?,?,?,?,?)';
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$name,$surname, $user, $pass,$picture]);
}

function get_admin_id(){
  $email     = $_SESSION['admin'];
  $pdo       = connect();
  $stmt      = $pdo->prepare("SELECT * FROM admin WHERE email=?");
  $stmt->execute([$email]);
  $admin_id  = $stmt->fetch();

  return $admin_id;
}

?>
