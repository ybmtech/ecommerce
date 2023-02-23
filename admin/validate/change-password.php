<?php
require_once "../../config.php";
session_start();
if(isset($_POST['new_password'])){
         $table='users';
        $unique_id= $_SESSION['admin_id'];
        $data=[
            'password'=>password_hash($_POST['new_password'],PASSWORD_DEFAULT),
              'update_at'=>date("d-m-Y")
        ];
        $check_user=$dbquery->row_with_one_parameter($table,'unique_id', $unique_id);
        if (password_verify($_POST['old_password'],$check_user['password'])==FALSE) {
            $msg = json_encode(['status' => false, 'message' => 'Incorrect old password.','error' => 'database']);
            echo $msg;
            exit();
        }
        else{
            $result = $update->update($table, $data,'unique_id',$unique_id);
            if($result){
                $msg = json_encode(['status' => true, 'message' => 'Password Changed Successful']);
                  echo $msg;
                exit();
            }
            else{
                $msg = json_encode(['status' => false, 'message' => 'Opps, fail to change password,try again later ', 'error' => 'database']);
                echo $msg;
                exit();
            }
        }
            
        
   
    
				
}

?>