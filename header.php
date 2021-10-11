<?php
require_once("private/initialize.php");
startSession();
authenticate();
$user_id = getUserId();
 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php  show_user_name($user_id['employee_id']); ?></title>
    <link rel="stylesheet" href="assets/style/index.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
<link rel="stylesheet" href="assets/style/viewUser.css">
<script type="text/javascript" src="assets/javaScript/jquery-3.6.0.js"></script>
<script type="text/javascript" src="assets/javaScript/index.js"></script>
  </head>
  <body style = "font-family: 'Roboto', sans-serif;">

<div id="header">

<div class="siteNav">

<div class="ProfilePicture">
  <?php show_user_picture($user_id['employee_id']); ?>
</div>

<div class="name">
<?php  show_user_name($user_id['employee_id']); ?>
</div>

<!--adminTasks-->
<div class="adminTasks">

  <?php
  $access = get_access_type();

  if($access == "Low"){
    show_admin_low();
  }

  else if ($access == "Medium") {
    show_admin_low();
    show_admin_medium();
  }

  else if($access == "High"){
    show_admin_low();
    show_admin_medium();
  }

  ?>

  <div class='logout'><img src='assets/images/logout_black_24dp.svg'>
  <a href='logout.php'>Logout</a></div>

</div>

</div>

<div class="adminHead">

<div class="menu">

  <div class="heading">
  Welcome, <?php  show_user_name($user_id['employee_id']); ?>
  </div>

  <?php if($access == "Medium") show_admin_search(); ?>
  <div id="notification" class="notify">
  <img src="assets/images/notifications_black_24dp.svg">

  <div class="notificationCounter">

  </div>

  </div>
</div>

</div>

<!--Add department popup form-->
<div id="popUpWindow" class="popup">
  <div>
<span class="closeButton">&times;</span>
</div>
<div class="content">

<div class="popupForm">
  <h2>Add Department</h2>
<form class="my_dep" id="dep_form" action="private/userRegistration.php" method="post">
<input class="depName" type="text" name="myDepartment" placeholder="Department name" required = "required" >
<input class="subButton" type="button" value="Create department">
</form>
</div>

</div>

</div>

<!--Remove department popup-->
<div class="delete_department">
<span class="close_delete_dep">&times;</span>
<div class="rev_header">
  <h2>Remove Department</h2>
<form class="" id="rev_form" action="private/userRegistration.php" method="post">
  <label for="selected_dep">Select Department</label>
<select id="selected_dep" class="select_dep" name="">

</select>
<button class="confirm_before" type="button" name="button">Remove department</button>
<input class="remove_button" type="button" value="Confirm deletion">
</form>
</div>
</div>
<!---->

<?php

if($access == "Medium"){
leave_type_popup();
load_occupations();
}

?>

<!--Add employee popup form-->
<div id="employee-popup" class="employee-window">
  <div>
<span class="closePopup">&times;</span>
</div>
<div class="emplyee-form">

<div class="employee-details">
<h2 class="addEmployeeHeading">Add Employee</h2>
<form class="form-fill" id="form-emp" action="private/userRegistration.php" method="post">
  <label class="label1" for="select">select department:</label><label class="label2" for="priviledge">select privilege:</label><br>
  <select class="selectDepartment" id="selectedDepartment" name="select">
    <?php loadDepartments(); ?>
  </select>
  <select class="userPriviledge" id="priviledge" name="priviledge">
  <option value="Low">Low</option>
  <option value="Medium">Medium</option>
  <option value="High">High</option>
  </select>
<input class="employee-name" type="text" name="name" placeholder="name" required = "required">
<input class="employee-sur" type="text" name="surname" placeholder="surname" required = "required">
<select class="employee-gender"  name="gender">
<option value="Male">Male</option>
<option value="Female">Female</option>
</select>
<input class="employee-occupation" type="text" name="occupation" placeholder="occupation" required = "required">
<input class="employee-id" type="text" name="identity" placeholder="identity number" required = "required">
<input class="employee-tax" type="text" name="taxNumber" placeholder="tax number" required = "required">
<input class="employee-salary" type="text" name="salary" placeholder="salary" required = "required">
<input class="phone" type="text" name="phone" placeholder="phone" required = "required">
<input class="streetAddress" type="text" name="street" placeholder="street address" required = "required">
<input class="city" type="text" name="city" placeholder="city" required = "required">
<input class="zipCode" type="text" name="zipcode" placeholder="zip code" required = "required">
<input class="province" type="text" name="province" placeholder="province" required = "required">
<input class="country" type="text" name="email" placeholder="email" required = "required">
<input class="employeePicture" type="file" name="picture"  required = "required">
<input class="employee-submit" id="submitEmployee" name="submit" type="button" value="Add employee">
</form>
</div>

</div>

</div>

<!--Leave request popup-->
<div class="leave_request_popup">
  <div>
<span class="close_leave">&times;</span>
</div>

<div class="leave_content">

  <div class="leave_requests">
  Leave Requests
  </div>

<div class="send_leave_Request">
Send leave Request
</div>

</div>

<div class="leave_content_details">
  <div class="show_leave_request">
    <div class="leave_list">
      <div class="leave_type">
        Leave Type
      </div>
      <div class="additional_info">
        additional info
      </div>
      <div class="due_date">
        Due date
      </div>
      <div class="leave_status">
        Status
      </div>
    </div>
    <div class="emp_sent_leave">
      <?php loadLeaveRequest($user_id['employee_id']); ?>
    </div>

  </div>
  <div class="send_leave_info">
    <div class="form_leave">
      <div class="leave_fill_form">
        <h3>Send Leave Request</h3>
      <form class="" id="leave_formSub" action="private/userRegistration.php" method="POST">
      <input class="reason_for_leave" type="text" name="reason" placeholder="Reason for leave" required = "required" >
      <label for="leave-type">Select Leave Type</label>
      <select id="leave-type" class="leaveType" name="selected_leave_type">
        <?php load_leaveTypes(); ?>
      </select>
      <label for="leaveDate">Leave date</label>
      <input id="leaveDate" class="leave_date" type="date" name="leave_date">
      <input class="submit_request" type="button" value="Send Request">
      </form>
      </div>
    </div>
  </div>
</div>

</div>

</div>
