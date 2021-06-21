<!--Author: Benelzane Kholani 218257465-->

<?php

 require_once 'admin.php';
 require_once 'database.php';
 require_once 'userRegistration.php';
 require_once 'crud.php';

 $crud = new Crud();
 $crud->createTable("Employee","
 username VARCHAR(50) NOT NULL,
 surname VARCHAR(50) NOT NULL,
 identity CHAR(13) NOT NULL UNIQUE,
 department VARCHAR(50) NOT NULL,
 salary VARCHAR(50),
 taxNumber VARCHAR(10),
 picture VARCHAR(13),
 password VARCHAR(13),
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
