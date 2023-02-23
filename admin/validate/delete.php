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
            $result = $dbquery->delete_with_one_parameter($table,'unique_id',$unique_id);
            if($result){
                $msg = json_encode(['status' => true, 'message' => 'Deleted']);
                  echo $msg;
                exit();
            }
            else{
                $msg = json_encode(['status' => false, 'message' => 'Opps, fail to delete,try again later ', 'error' => 'database']);
                echo $msg;
                exit();
            }
        
            
        
   
    }
				
}

?>