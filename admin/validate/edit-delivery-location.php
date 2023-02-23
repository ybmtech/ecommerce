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
        $table='delivery_locations';
        $unique_id= $dbquery->filterValue($_POST['unique_id']);
        $data=[
            'name'=>$_POST['name'],
            'price'=>$_POST['price'],
        ];
      
            $result = $update->update($table, $data,'unique_id',$unique_id);
            if($result){
                $msg = json_encode(['status' => true, 'message' => 'Location Updated']);
                  echo $msg;
                exit();
            }
            else{
                $msg = json_encode(['status' => false, 'message' => 'Opps, fail to update location,try again later ', 'error' => 'database']);
                echo $msg;
                exit();
            }
        
            
        
   
    }
				
}

?>