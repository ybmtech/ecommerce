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
        $table='products';
        $update_at=date('d-m-Y');
        $unique_id= $dbquery->filterValue($_POST['unique_id']);
        $query_product=$dbquery->row_with_one_parameter($table,'unique_id',$unique_id);
        $quantity=$query_product['quantity'] + $_POST['quantity'];
        if(empty($_FILES['image']['name'])){
            $image_to_server=$query_product['image'];
        }
        else{
            $file=$_FILES['image'];
            $valid_extensions=['jpg','png','jpeg','gif'];
            $path="product_images";
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
            'category_id'=>$_POST['category'],
            'price'=>$_POST['price'],
            'quantity'=>$quantity,
            'description'=>$_POST['description'],
            'image'=>$image_to_server,
            'update_at'=>$update_at
        ];
       
            $result = $update->update($table, $data,'unique_id',$unique_id);
            if($result){
                $msg = json_encode(['status' => true, 'message' => 'Product Updated']);
                  echo $msg;
                exit();
            }
            else{
                $msg = json_encode(['status' => false, 'message' => 'Opps, fail to update product,try again later ', 'error' => 'database']);
                echo $msg;
                exit();
            }
        
            
        
   
    }
				
}

?>