<?php
require_once "../../config.php";
session_start();
if(isset($_POST['tbl']) && isset($_POST['unique_id'])){
    $token= $dbquery->filterValue($_POST['token']);
    if(!$token || $token!==$_SESSION['_token']){
        $res=json_encode(['status'=>false,'message'=>'Bad request', 'error' => 'token']);
        echo $res;
    }
    else{
        $table=$dbquery->filterValue($_POST['tbl']);
        $unique_id= $dbquery->filterValue($_POST['unique_id']);
        $post_status= $dbquery->filterValue($_POST['status']);
        $status=($post_status=="enable") ? 1 : 0;
        $data=[
         'status'=>$status
        ];
            $result = $update->update($table,$data,'id',$unique_id);
            if($result){
                $msg = json_encode(['status' => true, 'message' => ucwords($post_status)]);
                  echo $msg;
                exit();
            }
            else{
                $msg = json_encode(['status' => false, 'message' => 'Opps, fail to enable/disable,try again later ', 'error' => 'database']);
                echo $msg;
                exit();
            }
        
            
        
   
    }
				
}

?>