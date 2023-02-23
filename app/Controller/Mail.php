<?php
namespace App\Controller;
class Mail{
    private $email="test@mail.com";
public function send($sender,$receiver,$subject,$body)
		{
			if($sender=="self"){
			$email= $this->email;
			}
			else{
				$email=$sender;
			}
			if($receiver=="self"){
				$to =$this->email;
				}
				else{
					$to =$receiver;
				}
			$headers = 'MIME-Version: 1.0' . "\r\n";
			$headers .= "From: " . $email . "\r\n"; // Sender's E-mail
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";		
			if (@mail($to, $subject, $body, $headers))
			{
				return true;
			}else{
				return false;
			}
		}
		       
}
?>