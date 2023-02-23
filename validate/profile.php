<?php
session_start();
require_once "../config.php";
if(isset($_POST['profile-btn'])){
    $token= $dbquery->filterValue($_POST['token']);
    if(!$token){
        $res=json_encode(['status'=>false,'message'=>'Bad request', 'error' => 'token']);
        echo $res;
    }
    else{
         $table='users';
         $create_at=date("d-m-Y");
        $unique_id= $_SESSION['customer_id'];
        if(!empty($_POST['password'])){
            if($_POST['password']!==$_POST['confirm_password']){
                $msg = json_encode(['status' => false, 'message' => 'Password not match']);
                echo $msg;
                exit();
            }
            $data=[
                'name'=>$_POST['fullname'],
                 'phone' => $_POST['phone'],
                'password' =>password_hash($_POST['password'],PASSWORD_BCRYPT),
                 'update_at'=>$create_at
            ];
        }
        else{
            $data=[
                'name'=>$_POST['fullname'],
                 'phone' => $_POST['phone'],
                'update_at'=>$create_at
            ];
        }
       
            $result = $update->update($table, $data,'unique_id',$unique_id);
            if($result){
                $_SESSION['customer_phone']=$_POST['phone'];
               $_SESSION['name'] = $_POST['fullname'];
                $msg = json_encode(['status' => true, 'message' => 'Profile updated']);
                echo $msg;
                exit();
            }
            else{
                $msg = json_encode(['status' => false, 'message' => 'Opps, fail,try again later  ', 'error' => 'database']);
                echo $msg;
                exit();
            }
        
            
        
   
    }
				
}

?>