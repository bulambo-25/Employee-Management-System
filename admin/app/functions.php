<!--Author: Benelzane Kholani 218257465-->

<?php

 require_once 'admin.php';
 require_once 'database.php';
 require_once 'crud.php';

 $crud = new Crud();
 $crud->createTable("employee","
 username VARCHAR(20) NOT NULL,
 surname VARCHAR(20) NOT NULL,
 identity CHAR(13) NOT NULL UNIQUE,
 department VARCHAR(20) NOT NULL,
 PRIMARY KEY(identity)");

 $departments = $crud->fetchTables();

 $file = fopen('../../admin/json/departments.json', 'w');
 fwrite($file, $departments);
 fclose($file);

 //$employee  = new Employee();


/*$user = new Admin();
$user->CreateSession();
$user->authenticate();
*/


 ?>
