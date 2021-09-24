
  <?php

require_once("passwords.php");

  class Database{

    protected static $instance = null;

    protected function __construct() {}
    protected function __clone() {}

    public static function instance()
    {
        if (self::$instance === null)
        {
            $opt  = array(
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => FALSE,
            );
            $dsn = 'mysql:host='.DBHOST.';dbname='.DB.';charset='.CHARSET;

            try{
            self::$instance = new PDO($dsn, DBUSER, DBPASS, $opt);
          }catch(PDOException $e){
            throw new PDOException($e->getMessage(), (int)$e->getCode());
          }
        }
        return self::$instance;
    }

  }
   ?>
