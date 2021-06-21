<!--Author: Kholani Benelzane 218257465-->
<?php include "functions.php"; ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="../style/index.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
  </head>
  <body style = "font-family: 'Roboto', sans-serif;">

<div id="header">

<div class="siteNav">

<div class="ProfilePicture">
  <img class="picture" src="../images/person_black_24dp.svg" alt="">
</div>

<div class="name">
Cole Colombia
</div>

<div class="adminTasks">

<div id="addDep" class="department" style="font-family:"><img src="../images/add_white_24dp.svg">
<a>Add department</a></div>

<div id="add-Employees" class="employee"><img src="../images/person_add_white_24dp.svg">
  <a>Add employee</a></div>

  <div class="departments"><img src="../images/maps_home_work_white_24dp.svg">
  <a>Departments</a></div>

  <div class="logout"><img type="submit" src="../images/logout_white_24dp.svg">
  <a>Logout</a></div>

</div>

</div>

<div class="adminHead">


<div class="menu">

  <div id="search" class="searchUser">
  <img src="../images/search_white_24dp.svg">
  </div>


  <div class="heading">
  Admin
  </div>

  <div id="notification" class="notify">
  <img src="../images/notifications_white_24dp.svg">

  <div class="notificationCounter">
  5
  </div>

  </div>
</div>

<h2 class="secondHeading">Employees</h2>

<div class="table">

  <table>
  <tr>
    <th>Name</th>
    <th>Surname</th>
    <th>Department</th>
    <th>Employee Id</th>
  </tr>
</table>

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
<form class="" action="index.html" method="post">
<input class="depName" type="text" name="" placeholder="Department name" required = "required" >
<input class="subButton" type="submit" value="Create department">
</form>
</div>

</div>

</div>

<!--Add employee popup form-->
<div id="employee-popup" class="employee-window">
  <div>
<span class="closePopup">&times;</span>
</div>
<div class="emplyee-form">



<div class="employee-details">
<h2 class="addEmployeeHeading">Add Employee</h2>
<form class="form-fill" action="userRegistration.php" enctype="multipart/form-data" method="post">
  <label class="label1" for="select">select department:</label><label class="label2" for="priviledge">select privilege:</label><br>
  <select class="selectDepartment" id="selectedDepartment" name="select"></select>
  <select class="userPriviledge" id="priviledge" name="priviledge">
  <option value="low">low</option>
  <option value="medium">medium</option>
  <option value="high">high</option>
  </select>
<input class="employee-name" type="text" name="name" placeholder="name" required = "required">
<input class="employee-sur" type="text" name="surname" placeholder="surname" required = "required">
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
<input class="employee-submit" name="submit" type="submit" value="Add employee">
</form>
</div>

</div>

</div>

</div>

  </body>
  <script type="text/javascript" src="../javaScript/index.js"></script>
</html>
