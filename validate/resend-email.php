<?php
require_once "../config.php";
use Spatie\UrlSigner\MD5UrlSigner;
use Carbon\Carbon;
session_start();
$table='users';

//check user email from the database
        $row =$dbquery->row_with_one_parameter($table,'email', $_POST['email']);
       
                $email=$dbquery->filterValue($_POST['email']);
                $name = $row['name'];
                //generate temporary sign url
                $urlSigner = new MD5UrlSigner('ecommerce');
                //add 15 minute to current datetime for expire link
                $expirationDate = Carbon::now(new DateTimeZone('Africa/Lagos'))->addMinutes(15);
                 //get base url from env and attach verify page
                $url= $_ENV['APP_URL']. "/verify-email?id=".$row['unique_id'];
                $sign_url = $urlSigner->sign($url, $expirationDate);

                $subject=$_ENV['APP_NAME']." Registration";
                $body = "<p>Dear {$name}, You are welcome to ".$_ENV['APP_NAME'].". Please 
                use below link to verify your account. </p>";
                $body.="<p><a href='{$sign_url}' target='_BLANK'>Verify</a></p>";
            $body .= "<a href='{$sign_url}' target='_BLANK'>{$sign_url}</a>";
              $body .= "<p>Alright reserve &copy ".$_ENV['APP_NAME']." ".date('Y'). "</p>";

                //send email using this app email set in mail class
                $mail->send('self', $email, $subject, $body);
                $msg = json_encode(['status' => true, 'message' => 'Your register was successful,please login']);
               
                echo "success";
                exit();
           
        
            
        
   
    
				
?>