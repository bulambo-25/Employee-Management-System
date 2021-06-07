<!--Author: Kholani Benelzane 218257465-->

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

  <div class="logout"><img src="../images/logout_white_24dp.svg">
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
<form class="" action="index.html" method="post">
<input class="employee-name" type="text" name="" placeholder="name" required = "required">
<input class="employee-sur" type="text" name="" placeholder="surname" required = "required">
<input class="employee-id" type="text" name="" placeholder="identity number" required = "required">
<input class="employee-tax" type="text" name="" placeholder="tax number" required = "required" >
<input class="employee-submit" type="submit" value="Add employee">
</form>
</div>

</div>

</div>

</div>

  </body>
  <script src="../javaScript/index.js" type="text/javascript"></script>
</html>
