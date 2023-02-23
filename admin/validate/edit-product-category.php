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
        $table='product_categories';
        $unique_id= $dbquery->filterValue($_POST['unique_id']);
        $data=[
            'name'=>$_POST['name']
        ];
        $check_new_name=$dbquery->row_with_two_parameter_not_equal($table,'name',$_POST['name'],'unique_id',$unique_id);
        if($check_new_name !== false){
         $msg = json_encode(['status' => false, 'message' => 'There is category with this name', 'error' => 'database']);
                 echo $msg;
                 exit();
        }
       
            $result = $update->update($table, $data,'unique_id',$unique_id);
            if($result){
                $msg = json_encode(['status' => true, 'message' => 'Category Updated']);
                  echo $msg;
                exit();
            }
            else{
                $msg = json_encode(['status' => false, 'message' => 'Opps, fail to update category,try again later ', 'error' => 'database']);
                echo $msg;
                exit();
            }
        
            
        
   
    }
				
}

?>