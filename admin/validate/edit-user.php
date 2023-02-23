<?php
require_once "../../config.php";
session_start();
if(isset($_POST['name']) && isset($_POST['unique_id'])){
    $token= $dbquery->filterValue($_POST['token']);
    if(!$token || $token!==$_SESSION['_token']){
        $res=json_encode(['status'=>false,'message'=>'Bad request', 'error' => 'token']);
        echo $res;
    }
    else{
        $table='users';
        $update_at=date('d-m-Y');
        $unique_id= $dbquery->filterValue($_POST['unique_id']);
        $query_user=$dbquery->row_with_one_parameter($table,'unique_id',$unique_id);
         if(empty($_FILES['image']['name'])){
            $image_to_server=$query_user['image'];
        }
        else{
            $file=$_FILES['image'];
            $valid_extensions=['jpg','png','jpeg','gif'];
            $path="profiles_images";
            $size="5000000";
            $upload_file = $uploadFile->upload_file($file, $valid_extensions, $path, $size,"other");
       $upload_result=json_decode($upload_file,true);
       if($upload_result['status']==false){
        $msg = json_encode(['status' => false, 'message' =>$upload_result['message'],'error' => 'upload']);
        echo $msg;
        exit();
       }
       $image_to_server=$upload_result['data'];
        }
        $data=[
            'name'=>$_POST['name'],
            'phone'=>$_POST['phone'],
            'email'=>$_POST['email'],
            'role'=>$_POST['role'],
            'image'=>$image_to_server,
            'update_at'=>$update_at
        ];
       $check_new_email=$dbquery->row_with_two_parameter_not_equal($table,'email',$_POST['email'],'unique_id',$unique_id);
       if($check_new_email !== false){
        $msg = json_encode(['status' => false, 'message' => 'There is user with this email', 'error' => 'database']);
                echo $msg;
                exit();
       }
            $result = $update->update($table, $data,'unique_id',$unique_id);
            if($result){
                $msg = json_encode(['status' => true, 'message' => 'User Updated']);
                  echo $msg;
                exit();
            }
            else{
                $msg = json_encode(['status' => false, 'message' => 'Opps, fail to update user,try again later ', 'error' => 'database']);
                echo $msg;
                exit();
            }
        
            
        
   
    }
				
}

?>