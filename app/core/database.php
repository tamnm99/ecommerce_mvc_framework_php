<?php


// this is the database class has method to talk with database
class Database
{

    public static $conn;

    //using pdo to connect database
    public function __construct()
    {
        try {
            //   $string = "mysql:host=Localhost; dbname=eshop_db";
            $string = DB_TYPE . ":host=" . DB_HOST . ";dbname=" . DB_NAME;
            self::$conn = new PDO($string, DB_USER, DB_PASSWORD);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    // get Instance to get connection with database
   public static function getInstance()
   {
       if (self::$conn) {
          /* return self::$conn;*/
       }

       //call construct of database
       return $instance = new self();
   }

   // Get new Instance to connect with DB
    public static function newInstance()
    {
        return $instance = new self();
    }

    // read DB ( select,... database to get information)
   public function read_db($query, $data = array())
   {
       $statement = self::$conn->prepare($query);
       $result = $statement->execute($data);
       if ($result) {
           $data = $statement->fetchAll(PDO::FETCH_OBJ);
           if (is_array($data) && count($data) > 0) {
               return $data;
           }
       }
       return false;
   }

   // write database( insert, update,.... database)
    public function write_db($query, $data = array())
    {
        $statement = self::$conn->prepare($query);
        $result = $statement->execute($data);
        if ($result) {
            return true;
        }
        return false;
    }
}

// $db = Database::getInstance();
// $data = $db->read_db("DESCRIBE tbl_user");
// show($data);
