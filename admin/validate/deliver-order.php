<?php
require_once "../../config.php";
session_start();
if(isset($_POST['order_id'])){
    $token= $dbquery->filterValue($_POST['token']);
    if(!$token || $token!==$_SESSION['_token']){
        $res=json_encode(['status'=>false,'message'=>'Bad request', 'error' => 'token']);
        echo $res;
    }
    else{
        $table='orders';
        $order_id= $dbquery->filterValue($_POST['order_id']);
        $email= $dbquery->filterValue($_POST['email']);
        $name= $dbquery->filterValue(ucwords($_POST['name']));
        $address= $dbquery->filterValue(ucwords($_POST['address']));
        $data=[
         'delivery_status'=>1
        ];
            $result = $update->update($table,$data,'order_ref',$order_id);
            if($result){
                $subject=$_ENV['APP_NAME']." | Order Delivered";
                $body = "<p>Dear {$name}, your order with order id of #{$order_id} has been delivered to {$address}</p>";
                 $body .= "<p>Alright reserve &copy ".$_ENV['APP_NAME']." ".date('Y'). "</p>";
                 
                 //send email using this app email set in mail class
                $mail->send('self', $email, $subject, $body);
       
                $msg = json_encode(['status' => true, 'message' => 'Done']);
                  echo $msg;
                exit();
            }
            else{
                $msg = json_encode(['status' => false, 'message' => 'Opps, operation fail,try again later ', 'error' => 'database']);
                echo $msg;
                exit();
            }
        
            
        
   
    }
				
}

?>