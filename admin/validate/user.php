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
        $table='users';
        $unique_id= $Filter->unique_id_generator();
        if(empty($_FILES['image']['name'])){
            $image_to_server="";
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
      
          $password=password_hash($_POST['phone'],PASSWORD_DEFAULT);
        $data=[
            'unique_id'=>$unique_id,
            'name'=>$_POST['name'],
            'phone'=>$_POST['phone'],
            'email'=>$_POST['email'],
            'role'=>$_POST['role'],
            'is_verify'=>date("d-m-Y h:i:s"),
            'password'=>$password,
             'image'=>$image_to_server,
            'create_at'=>$create_at,
            'update_at'=>$create_at
        ];
        $check_user=$dbquery->row_with_one_parameter($table,'email',$_POST['email']);
        if ($check_user !== false) {
            $msg = json_encode(['status' => false, 'message' => 'This user already exist with this email.','error' => 'database']);
            echo $msg;
            exit();
        }
        else{
            $result = $insert->insert($table, $data);
            if($result){
                $name=$_POST['name'];
                $email=$_POST['email'];
                $user_password=$_POST['phone'];
                $current_year=date("Y");
                if($_POST['role']=='1'){
                    $url= $_ENV['APP_URL']."/admin/";
                }
                else{
                    $url= $_ENV['APP_URL']."/login";
                }
                
                $subject="Julie Beauty Clinic Registration";
                $body = "<p>Dear {$name}, An account as been created for you on julie beauty clinic.Below are your login details </p>";
                $body.="<p>
                Url : {$url} <br>
                Email: {$email} <br>
                Password : {$user_password}
                </p>";
                $body.="<p>Note : Login with above credential then change your password for security reasons.</p>";
                $body.="<p>All right reserve &copy {$_ENV['APP_NAME']} {$current_year}</p>";
                $mail->send('self', $email, $subject, $body);
              
                $msg = json_encode(['status' => true, 'message' => 'User Added']);
                  echo $msg;
                exit();
            }
            else{
                $msg = json_encode(['status' => false, 'message' => 'Opps, fail to add user,try again later ', 'error' => 'database']);
                echo $msg;
                exit();
            }
        }
            
        
   
    }
				
}

?>