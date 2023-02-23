<?php
session_start();
require_once "../../config.php";
use Spatie\UrlSigner\MD5UrlSigner;
use Carbon\Carbon;
$token = $dbquery->filterValue($_POST['token']);
if (!$token || $token !== $_SESSION['_token']) {
    $res = json_encode(['status' => false, 'message' => 'Bad request', 'error' => 'token']);
    echo $res;
    exit();
}
else{
    //check user email from the database
    $table = 'users';
$email = $dbquery->filterValue($_POST['email']);
        $row =$dbquery->row_with_one_parameter($table,'email', $email);
       if($row){
                
                $name = $row['name'];
                //generate temporary sign url
                $urlSigner = new MD5UrlSigner('julieclinics');
                //add 15 minute to current datetime for expire link
                $expirationDate = Carbon::now(new DateTimeZone('Africa/Lagos'))->addMinutes(15);
        //get base url from env and attach verify page
        $link_key = md5($email);
        $addKey = substr(md5(uniqid(rand(), 1)), 3, 10);
        $hash = $link_key . $addKey;

                $url= $_ENV['APP_URL']. "/admin/reset-password?hash=".$hash;
                $sign_url = $urlSigner->sign($url, $expirationDate);

                $subject="Beauty Clinic | Password Reset";
                $body = "<p>Dear {$name}, You have request to reset your password with us.Please 
                use below link to reset your password. </p>";
                $body.="<p><a href='{$sign_url}' target='_BLANK'>Reset Password</a></p>";
            $body .= "<a href='{$sign_url}' target='_BLANK'>{$sign_url}</a>";
              $body .= "<p>Alright reserve &copy ".$_ENV['APP_NAME']." ".date('Y'). "</p>";
//save password token to database
$token_table= 'password_resets';
$data=[
'email'=>$email,
'token'=>$hash,
'create_at'=>date('d-m-Y')
];
    $insert->insert($token_table,$data);
         
                //send email using this app email set in mail class
                $mail->send('self', $email, $subject, $body);
        $msg = json_encode(['status' => true, 'message' => 'We have emailed your password reset link!']);
        echo $msg;
        exit();
       }
       else{
        $msg = json_encode(['status' => false, 'message' => "We can't find a user with that email address.", 'error' => 'database']);
        echo $msg;
        exit();
       }
           
        
    }   
        
   
    
				
?>