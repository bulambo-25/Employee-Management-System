<?php
require_once("header.php");
 ?>

<?php

$user = $_GET['user'];
$selected_user = get_selected_user($user);
$_SESSION['id'] = $user;
 ?>

<div class="update_accesses">
  <form id="access_form" action="../private/userRegistration.php" method="post">
    <label for="update_user_access">Update employee access:</label>
    <select class="selected_access" name="selecte_access">
      <option value="Low">LOW</option>
      <option value="Medium">MEDIUM</option>
      <option value="High">HIGH</option>
    </select>
    <input class="submit_access" type="button" name="submit_access" value="update_access">
  </form>


</div>

<div class="selected_emp_details">

<?php show_user_details($selected_user); ?>

</div>

  </body>
  </html>
