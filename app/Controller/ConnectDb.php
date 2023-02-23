<?php
namespace App\Controller;
use \PDO;
class ConnectDb{
   public  $con;
   public $filterData;
    public function __construct(){
        try{
            $this->con=new PDO("mysql:host={$_ENV['DB_HOST']};dbname={$_ENV['DB_DATABASE']};", $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD']);
            $this->con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
              return $this->con;
      }
      catch(\PDOException $e){
         exit();
      }
}
   //fiter input data
   public function filterValue($data)
   {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      $this->filterData = $data;
      return $this->filterData;
   }
}
?>