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
        $table='coupons';
        $unique_id= $dbquery->filterValue($_POST['unique_id']);
        $data=[
            'name'=>$_POST['name'],
            'discount'=>$_POST['discount'],
            'expire_date'=>$_POST['expire']
        ];
       
            $result = $update->update($table, $data,'unique_id',$unique_id);
            if($result){
                $msg = json_encode(['status' => true, 'message' => 'Coupon Updated']);
                  echo $msg;
                exit();
            }
            else{
                $msg = json_encode(['status' => false, 'message' => 'Opps, fail to update coupon,try again later ', 'error' => 'database']);
                echo $msg;
                exit();
            }
        
            
        
   
    }
				
}

?>