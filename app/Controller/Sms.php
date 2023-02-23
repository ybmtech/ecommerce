<?php
namespace App\Controller;
class Sms{
    	public function sendSms($phone,$message){
			$userid="57177754"; 
			$password="@Policeman64";
			$message_type=0; 
			$encode_message=urlencode($message);
				$sender=urlencode("NOTICE");
				$code='234';
				$trim_phone=trim($phone);
				//format contact
			 $format_phone=$trim_phone;
								 if(substr($trim_phone,0,1)=='0'){
					$format_phone=$code.substr($trim_phone,-10);
						}
			elseif(substr($trim_phone,0,1)=='+'){
				$format_phone=$code.substr($trim_phone,-10);
					   }
			$url="http://developers.cloudsms.com.ng/api.php?userid={$userid}&password={$password}&type={$message_type}&destination={$format_phone}&sender={$sender}&message={$encode_message}";
			if ($f = @fopen($url, "r")) {
				$response = fgets($f, 255);
				$trim_response=trim($response);
				$sent_date=date("M D d-m-Y h:i:a");
				if(101==$trim_response){
			       //success
				   return true;
			   }
			   elseif(109==$trim_response){
				   //insufficient fund
				   return false;
			   }
			   else{
				   //failed
				   return false;
			   }
	
		}
	}
}