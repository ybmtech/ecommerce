<?php
namespace App\Controller;
use \PDO;
use \DateTime;
class Token{
     //check token from table with expire date
     public function checkPasswordToken($table,$otp){
        require_once "middleware/Filter.php";
        require_once "config/database.php";
        $filter=new Filter();
        $con=new ConnectDb();
        $otp=$filter->filterValue($otp);
       $query="SELECT * FROM $table WHERE otp=:otp";
  $stmt=$con->con->prepare($query);
  $stmt->bindValue(':otp',$otp);
  $stmt->execute();
  if($stmt->rowCount()>0){
      $info=$stmt->fetch(PDO::FETCH_ASSOC);
      $curDate= new DateTime(); 
       $curDate->format("Y-m-d H:i:s");  
  $expDate=new DateTime($info['expire_date']);
      $interval=$curDate->diff($expDate);
  if($interval->format("%R%a")>1 || $interval->format("%R%a")<-1)
  {
    $result="expire";
           return $result ;
          }
      else{
          return "ok";
      }
          }
          else{
            $result="wrong";
              return $result;
          }
      }
       public function getJwtHeader(){
        $requestHeaders = getallheaders();
        $headers =$requestHeaders['X-Authorization'];
        return $headers;
    }
      public function getAuthorizationHeader(){
        $requestHeaders = apache_request_headers();
        $headers =$requestHeaders['X-Authorization'];
        return $headers;
    }
public function getBearerToken() {
    $headers =$this->getAuthorizationHeader();
    // HEADER: Get the access token from the header
    if (!empty($headers)) {
        if (preg_match('/Bearer\s(\S+)/', $headers, $matches)) {
            $headers=trim($matches[1]);
            return substr($headers,4);
        }
    }
    return null;
}
function generate_uuid(){
    return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
        mt_rand( 0, 0xffff ),
        mt_rand( 0, 0x0C2f ) | 0x4000,
        mt_rand( 0, 0x3fff ) | 0x8000,
        mt_rand( 0, 0x2Aff ), mt_rand( 0, 0xffD3 ), mt_rand( 0, 0xff4B )
    );

}
}