<?php
require_once("header.php");
 ?>

 <h2 class="secondHeading">Employees</h2>

 <div class="table">

   <div class="records">
     <div></div>
     <div>Name</div>
     <div>Surname</div>
     <div>Employee id</div>
     <div>Tax Number</div>

 </div>

 <div class="employee_List">
   <?php showEmployees(); ?>
 </div>

 </div>

  </body>
</html>
