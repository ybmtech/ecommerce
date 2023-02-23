<?php
require_once "../config.php";
session_start();
if(isset($_POST['email'])){
    $token= $dbquery->filterValue($_POST['token']);
    if(!$token){
        $res=json_encode(['status'=>false,'message'=>'Bad Request', 'error' => 'token']);
        echo $res;
        exit();
    }
    else{
        $data=[
            'username'=>$_POST['email'],
            'password' =>$_POST['password'],
            'table'=> 'users',
            'param' => 'email',
            'password_column' => 'password'
        ];
      $result=$login->login($data);
      $decode_result=json_decode($result);
      if(101==$decode_result->status){
        session_regenerate_id();
        $_SESSION['customer_id']=$decode_result->data->unique_id;
        $_SESSION['customer_email']=$decode_result->data->email;
        $_SESSION['customer_phone']=$decode_result->data->phone;
      $_SESSION['name'] = $decode_result->data->name;
        $is_verify = $decode_result->data->is_verify;
        $role = $decode_result->data->role;
        if($role=='1'){
          $res = json_encode(['status' => false, 'message' => 'These credentials do not match our records.', 'error' => 'database']);
                echo $res;
                exit();
        }
        if($is_verify==""){
                $res = json_encode(['status' => false, 'message' => 'These credentials do not match our records.', 'error' => 'verify']);
                echo $res;
                exit();
        }
        else{
                $res = json_encode(['status' => true, 'message' => 'Login Successful']);
                echo $res;
                exit();
        }
        
      }
      elseif(102==$decode_result->status){
            $res = json_encode(['status' => false, 'message' => 'These credentials do not match our records.', 'error' => 'database']);
            echo $res;
            exit();
      } elseif (100== $decode_result->status) {
            $res = json_encode(['status' => false, 'message' => 'These credentials do not match our records.', 'error' => 'database']);
            echo $res;
            exit();
        }
      else{

      }
        
   
    }
				
}

?>