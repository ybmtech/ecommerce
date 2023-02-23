<?php
namespace App\Controller;
use App\Controller\DbQuery;
use App\Middleware\Filter;
class Login extends ConnectDb{
 //login user
      public function login($receive_data){
		  $Filter=new Filter();
        $dbquery=new DbQuery();
        $username=$Filter->filterValue($receive_data['username']);
        $password=$Filter->filterValue($receive_data['password']);
        $table=$Filter->filterValue($receive_data['table']);
        $param=$Filter->filterValue($receive_data['param']);
        $password_column=$Filter->filterValue($receive_data['password_column']);
          $check_user=$dbquery->row_with_one_parameter($table,$param,$username);
          if($check_user==false){
            $message=json_encode(['status'=>'100']); //wrong user
            return $message;
            exit();
          }
          if(password_verify($password,$check_user[$password_column])){
            $message=json_encode(['status'=>'101','data'=>$check_user]); //success
        return $message;
        exit();
      }
      else{
        $message=json_encode(['status'=>'102']); //wrong password
        return $message;
        exit();
      }
    
    }
    
}