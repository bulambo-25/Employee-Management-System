
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

  if(!isset($_SESSION['user']))
  {
    header("Location: login.php");
  }

}

function authenticateSign(){

  if(isset($_SESSION['user']))
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

  if (isset($_SESSION['user']))
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
    echo "<a href='" ."viewUser.php?user=" . $row['employee_id'] ."'><div><div><img src='".$row['picture']."'></div><div>" . $row['first_name'] .
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

function show_admin_low(){
  echo "
    <div class='leave_request'><img src='assets/images/event_black_24dp.svg'>
    <a href='#'>Leave Requests</a></div>

    <div class='download_info'><img src='assets/images/description_black_24dp.svg'>
    <a href='#'>Download info</a></div>";
}

function show_admin_medium(){

  echo "
  <div class='department' style='font-family:'><img src='assets/images/add_black_24dp.svg'>
  <a>Add department</a></div>

    <div class='departments'><img src='assets/images/corporate_fare_black_24dp.svg'>
    <a>Departments</a></div>

    <div class='add_leave_type' style='font-family:'><img src='assets/images/add_black_24dp.svg'>
    <a>Add leave types</a></div>

    <div class='add_occupation' style='font-family:'><img src='assets/images/add_black_24dp.svg'>
    <a>Add occupations</a></div>

    <div class='employee'><img src='assets/images/person_add_black_24dp.svg'>
      <a>Add employee</a></div>

    ";


}

function show_admin_search(){

  echo "<div id='search' class='searchUser'>
    <form class='form_submit' action='index.html' method='post'>
      <input class='search_user' type='text' name='searched_user' placeholder='search employee'>
      <input class='submit_user' type='image' src='assets/images/search_black_24dp.svg' name=''>
    </form>
    </div>";

}

function user_details($user){

  $pdo = connect();

  $pdo->beginTransaction();

  $stmt = $pdo->prepare("SELECT * FROM worker WHERE employee_id=?");
  $stmt->execute([$user]);
  $result = $stmt->fetch();

  $stmt = $pdo->prepare("SELECT * FROM address WHERE employee_id=?");
  $stmt->execute([$user]);
  $result2 = $stmt->fetch();

  $stmt = $pdo->prepare("SELECT * FROM organization_data WHERE employee_id=?");
  $stmt->execute([$user]);
  $result3 = $stmt->fetch();

  $pdo->commit();

    echo "<div class='worker'>
    <div class='info_emp'>Basic info</div>
        <div class='emp_name'>
          <input type='text' name='' value='Name: ".$result['first_name']."' disabled>
          <input type='text' name='' value='Surname: ".$result['second_name']."' disabled>
          <input type='text' name='' value='Identity number: ".$result['identity_num']."' disabled>
          <input type='text' name='' value='Gender: ".$result['gender']."' disabled>
          <input type='text' name='' value='Tax number: ".$result['tax_num']."' disabled>
        </div>
      </div>";

    echo "<div class='address'>
    <div class='info_emp'>Contact info</div>
    <div class='emp_address'>
    <input type='text' name='' value='Phone: ".$result2['phone']."' disabled>
    <input type='text' name='' value='Street name: ".$result2['street']."' disabled>
    <input type='text' name='' value='Zip Code: ".$result2['zipCode']."' disabled>
    <input type='text' name='' value='Province: ".$result2['province']."' disabled>
    <input type='text' name='' value='Email: ".$result2['email']."' disabled>
    </div>
    </div>";

    echo "<div class='department_data'>
    <div class='info_department'>Organization info</div>
    <div class='emp_address'>
    <input type='text' name='' value='Department: ".$result3['department']."' disabled>
    <input type='text' name='' value='Salary: ".$result3['salary']."' disabled>
    <input type='text' name='' value='occupation: ".$result3['occupation']."' disabled>
    </div>
    </div>";
  }

function show_user_picture($user){
  $pdo = connect();

  $stmt = $pdo->prepare("SELECT * FROM worker WHERE employee_id=?");
  $stmt->execute([$user]);
  $result = $stmt->fetch();

  echo "<img src='employee_images/".$result['picture']."'>";
}

function show_user_name($user){
  $pdo = connect();
  $stmt = $pdo->prepare("SELECT * FROM worker WHERE employee_id=?");
  $stmt->execute([$user]);
  $result = $stmt->fetch();

  echo $result['first_name'] ." ". $result['second_name'];
}

function load_leaveTypes(){
  $pdo = connect();
  $stmt = $pdo->query("SELECT * FROM leave_type");
  $leaves = $stmt->fetchAll();

  foreach ($leaves as $key => $row) {
  echo "<option>" . $row['leave_types'] . "</option>";
  }

}

function loadLeaveRequest($employee_id){

  $pdo  = connect();
  $stmt = $pdo->prepare("SELECT * FROM emp_leave WHERE employee_id=?");
  $stmt->execute([$employee_id]);
  $emp_leave = $stmt->fetchAll();

  $status = "";

  foreach ($emp_leave as $key => $row) {

    if($row['leave_status'] == 0){
      $status = "Pending";
    }
    else if($row['leave_status'] == 1) {
      $status = "Approved";
    }

  echo "<div class='emp_leave_list'>
        <div class='leave_type'>
          ".$row['leave_type']."
        </div>
        <div class='additional_info'>
          ".$row['info']."
        </div>
        <div class='due_date'>
          ".$row['leave_date']."
        </div>
        <div class='leave_status'>
          " . $status. "
        </div>
    </div>";
  }

}

function authenticate_user($user, $password){

    $pdo = connect();
    $stmt = $pdo->prepare("SELECT count(*) FROM worker WHERE identity_num = ? AND password = ?");
    $stmt->execute([$user, $password]);
    $count = $stmt->fetchColumn();

    return $count;
}

function getUserId(){
  $pdo                = connect();
  $logged_in_user     = $_SESSION['user'];
  $stmt               = $pdo->prepare("SELECT * FROM worker WHERE identity_num = ?");
  $stmt->execute([$logged_in_user]);
  $user_id            = $stmt->fetch();

  return $user_id;
}

function get_access_type(){
  $pdo                = connect();
  $loggedin_user_id   = getUserId();
  $stmt               = $pdo->prepare("SELECT * FROM organization_data WHERE employee_id = ?");
  $stmt->execute([$loggedin_user_id['employee_id']]);
  $user_id            = $stmt->fetch();

  return $user_id['priviledge'];
}

function get_number_of_employees(){

  $pdo = connect();
  $stmt = $pdo->query("SELECT count(*) FROM worker");
  $stmt->execute();
  $count = $stmt->fetchColumn();

  return $count;
}

function leave_type_popup(){

  echo "
  <!--Add leave type-->
  <div class='leave_popup'>
    <div>
  <span class='exit_leave'>&times;</span>
  </div>
  <div class='content'>

  <div class='leave_form_fill'>
    <h2>Add leave type</h2>
  <form class='' id='leave_form' action='private/userRegistration.php' method='post'>
  <input class='leave_form_name' type='text' name='leave_type' placeholder='Leave type' required = 'required'>
  <input class='leave_submit' type='button' value='Add leave type'>
  </form>
  </div>

  </div>

  </div>
  <!---->
  ";

}

function load_occupations(){

  echo "
  <!--Add occupation popup-->
  <div class='occupation_popup'>
  <span class='close_occupation'>&times;</span>
  <div class='occupation_content'>
    <h2>Remove Department</h2>
  <form class='' id='rev_form' action='private/userRegistration.php' method='post'>
    <label for='select_occ_dep'>Select Department</label>
  <select id='select_occ_dep' class='select_occu_dep' name=''>
     ";

  echo loadDepartments() . "
  </select>
  <button class='confirm_before_occu' type='button' name='button'>Add occupation</button>
  <input class='create_occupation' type='button' value='Confirm occupation'>
  </form>
  </div>
  </div>
  <!---->
  ";

}

?>
