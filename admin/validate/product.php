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
        $table='products';
        $unique_id= $Filter->unique_id_generator();
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
  
        $data=[
            'unique_id'=>$unique_id,
            'name'=>$_POST['name'],
            'category_id'=>$_POST['category'],
            'price'=>$_POST['price'],
            'quantity'=>$_POST['quantity'],
            'description'=>$_POST['description'],
            'image'=>$image_to_server,
            'create_at'=>$create_at,
            'update_at'=>$create_at
        ];
        $check_product=$dbquery->row_with_two_parameter($table,'name',$_POST['name'],'category_id',$_POST['category'],'AND');
        if ($check_product !== false) {
            $msg = json_encode(['status' => false, 'message' => 'This product already exist.','error' => 'database']);
            echo $msg;
            exit();
        }
        else{
            $result = $insert->insert($table, $data);
            if($result){
                $msg = json_encode(['status' => true, 'message' => 'Product Added']);
                  echo $msg;
                exit();
            }
            else{
                $msg = json_encode(['status' => false, 'message' => 'Opps, fail to add product,try again later ', 'error' => 'database']);
                echo $msg;
                exit();
            }
        }
            
        
   
    }
				
}

?>