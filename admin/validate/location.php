<?php
require_once "../../config.php";
session_start();
if(isset($_POST['name'])){
    $token= $dbquery->filterValue($_POST['token']);
    if(!$token || $token!==$_SESSION['_token']){
        $res=json_encode(['status'=>false,'message'=>'Bad request', 'error' => 'token']);
        echo $res;
    }
    else{
        $create_at=date("d-m-Y");
        $table='location';
        $unique_id= $Filter->unique_id_generator();
        $data=[
            'unique_id'=>$unique_id,
            'name'=>$_POST['name'],
            'create_at'=>$create_at
        ];
        $check_category=$dbquery->row_with_one_parameter($table,'name', $_POST['name']);
        if ($check_category !== false) {
            $msg = json_encode(['status' => false, 'message' => 'This location already exist.','error' => 'database']);
            echo $msg;
            exit();
        }
        else{
            $result = $insert->insert($table, $data);
            if($result){
                $msg = json_encode(['status' => true, 'message' => 'Location Added']);
                  echo $msg;
                exit();
            }
            else{
                $msg = json_encode(['status' => false, 'message' => 'Opps, fail to add location,try again later ', 'error' => 'database']);
                echo $msg;
                exit();
            }
        }
            
        
   
    }
				
}

?>