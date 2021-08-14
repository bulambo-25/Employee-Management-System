 <?php

 class Database{
   private static $instance = null;
   private $userName = "root";
   private $passWord = "";
   private $database = "departments";
   private $host = "localhost";
   private $connection;
   private $charset = 'utf8mb4';

   private function __construct(){
     $dsn = "mysql:host=$this->host;dbname=$this->database;charset=$this->charset";
     try{
     $this->connetion = new PDO($dsn, $this->userName, $this->passWord);
   }
   catch(PDOException $e){
     throw new PDOException($e->getMessage(), (int)$e->getCode());
   }

   }

   public static function getInstance(){
     if(!self::$instance){
       self::$instance = new Database();
     }

     return self::$instance;
   }

   public function getConnection(){
     return $this->connection;
   }
 }

  ?>
