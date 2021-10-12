<?php
require_once("../private/initialize.php");
startSession();
authenticate();
 ?>

 <?php

$admin_info = get_admin_id();

 ?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
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
  <img class="picture" src="

  <?php

  if($admin_info['picture'] == NULL || $admin_info['picture'] == ""){
    echo "assets/images/account_circle_black_24dp.svg";
   }
   else if(!$admin_info['picture'] == NULL || $admin_info['picture'] == ""){
     echo "../admin_images/" . $admin_info['picture'];
   }

   ?>

   " alt="">

</div>

<div class="name">
<?php  echo $admin_info['name'] . " " . $admin_info['surname']; ?>
</div>

<div class="pic_form">
  <form id="admin_pic_form" action="../private/userRegistration.php" method="post">
    <input class="my_pic" type="file" name="pic">
    <input class="update_image" type="button" name="submit_profile_pic" value="update image">
  </form>
</div>

<div class="adminTasks">

<div class="department" style="font-family:"><img src="assets/images/add_black_24dp.svg">
<a>Add department</a></div>

<div class="remove_department" style="font-family:"><img src="assets/images/remove_black_24dp.svg">
<a>Remove department</a></div>

<div class="add_leave_type" style="font-family:"><img src="assets/images/add_black_24dp.svg">
<a>Add leave types</a></div>

<div class="add_occupation" style="font-family:"><img src="assets/images/add_black_24dp.svg">
<a>Add occupations</a></div>

<div class="employee"><img src="assets/images/person_add_black_24dp.svg">
  <a>Add employee</a></div>

  <div class="remove_employee"><img src="assets/images/person_remove_black_24dp.svg">
    <a>Remove employee</a></div>

  <div class="departments"><img src="assets/images/corporate_fare_black_24dp.svg">
  <a>Departments</a></div>

  <div class="logout"><img type="submit" src="assets/images/logout_black_24dp.svg">
  <a href="logout.php">Logout</a></div>

</div>

</div>

<div class="adminHead">

<div class="menu">

  <div id="search" class="searchUser">
  <form class="form_submit" action="index.html" method="post">
    <input class="search_user" type="text" name="searched_user" placeholder="search employee">
    <input class="submit_user" type="image" src="assets/images/search_black_24dp.svg" name="">
  </form>
  </div>

  <div class="heading">
  Admin
  </div>

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
<form class="my_dep" id="dep_form" action="../private/userRegistration.php" method="post">
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
<form class="" id="rev_form" action="../private/userRegistration.php" method="post">
  <label for="selected_dep">Select Department</label>
<select id="selected_dep" class="select_dep" name="">
<?php loadDepartments(); ?>
</select>
<button class="confirm_before" type="button" name="button">Remove department</button>
<input class="remove_button" type="button" value="Confirm deletion">
</form>
</div>
</div>
<!---->

<!--Add leave type-->
<div class="leave_popup">
  <div>
<span class="exit_leave">&times;</span>
</div>
<div class="content">

<div class="leave_form_fill">
  <h2>Add leave type</h2>
<form class="" id="leave_form" action="../private/userRegistration.php" method="post">
<input class="leave_form_name" type="text" name="leave_type" placeholder="Leave type" required = "required" >
<input class="leave_submit" type="button" value="Add leave type">
</form>
</div>

</div>

</div>
<!---->

<!--Add occupation popup-->
<div class="occupation_popup">
<span class="close_occupation">&times;</span>
<div class="occupation_content">
  <h2>Remove Department</h2>
<form class="" id="rev_form" action="../private/userRegistration.php" method="post">
  <label for="select_occ_dep">Select Department</label>
<select id="select_occ_dep" class="select_occu_dep" name="">
<?php loadDepartments(); ?>
</select>
<button class="confirm_before_occu" type="button" name="button">Add occupation</button>
<input class="create_occupation" type="button" value="Confirm occupation">
</form>
</div>
</div>
<!---->

<!--Add employee popup form-->
<div id="employee-popup" class="employee-window">
  <div>
<span class="closePopup">&times;</span>
</div>
<div class="emplyee-form">

<div class="employee-details">
<h2 class="addEmployeeHeading">Add Employee</h2>
<form class="form-fill" id="form-emp" action="../private/userRegistration.php" method="post">
  <label class="label1" for="select">select department:</label><label class="label2" for="priviledge">select privilege:</label><br>
  <select class="selectDepartment" id="selectedDepartment" name="select">
    <?php loadDepartments(); ?>
  </select>
  <select class="userPriviledge" id="priviledge" name="priviledge">
  <option value="low">Low</option>
  <option value="medium">Medium</option>
  <option value="high">High</option>
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

</div>
