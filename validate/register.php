<?php
require_once "../config.php";
use Spatie\UrlSigner\MD5UrlSigner;
use Carbon\Carbon;
session_start();
if(isset($_POST['register'])){
    $token= $dbquery->filterValue($_POST['token']);
    if(!$token){
        $res=json_encode(['status'=>false,'message'=>'Bad request', 'error' => 'token']);
        echo $res;
    }
    else{
        $create_at=date("d-m-Y");
        $table='users';
        $unique_id= $Filter->unique_id_generator();
        $data=[
            'unique_id'=>$unique_id,
            'name'=>$_POST['fullname'],
            'email'=>$_POST['email'],
            'phone' => $_POST['phone'],
            'password' =>password_hash($_POST['password'],PASSWORD_BCRYPT),
            'create_at'=>$create_at,
            'update_at'=>$create_at
        ];
        $check_email =$dbquery->row_with_one_parameter($table,'email', $_POST['email']);
        if ($check_email !== false) {
            $msg = json_encode(['status' => false, 'message' => 'This email already register, please login']);
            echo $msg;
            exit();
        }
        else{
            $result = $insert->insert($table, $data);
            if($result){
                $email=$dbquery->filterValue($_POST['email']);
                $name = $dbquery->filterValue($_POST['fullname']);
                  //generate temporary sign url
                $urlSigner = new MD5UrlSigner('ecommerce');
                  //add 15 minute to current datetime for expire link
                $expirationDate = Carbon::now(new DateTimeZone('Africa/Lagos'))->addMinutes(15);
                //get base url from env and attach verify page
                $url= $_ENV['APP_URL']."/verify";
                $sign_url = $urlSigner->sign($url, $expirationDate);

                $subject=$_ENV['APP_NAME']." Registration";
                $body = "<p>Dear {$name}, You are welcome to ".$_ENV['APP_NAME'].". Please 
                use below link to verify your account. </p>";
                $body.="<p><a href='{$sign_url}' target='_BLANK'>Verify</a></p>";
                $mail->send('self', $email, $subject, $body);
                $msg = json_encode(['status' => true, 'message' => 'Your register was successful,please login']);
                session_regenerate_id();
                $_SESSION['customer_id'] = $unique_id;
                echo $msg;
                exit();
            }
            else{
                $msg = json_encode(['status' => false, 'message' => 'Opps, registration fail,try again later  ', 'error' => 'database']);
                echo $msg;
                exit();
            }
        }
            
        
   
    }
				
}

?>