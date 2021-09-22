<?php
require_once("header.php");
 ?>

<?php

$user = $_GET['user'];
$selected_user = get_selected_user($user);

 ?>

<div class="selected_emp_details">

<?php show_user_details($selected_user); ?>

</div>

  </body>
  </html>
