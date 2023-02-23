<?php
namespace App\Controller;
class PayGateway{
   
    /**
     * paystack payment initilize
     */
    public function paystack($fields){
        $url = "https://api.paystack.co/transaction/initialize";
         $fields_string = http_build_query($fields);
         //open connection
         $ch = curl_init();
         
         //set the url, number of POST vars, POST data
         curl_setopt($ch,CURLOPT_URL, $url);
         curl_setopt($ch,CURLOPT_POST, true);
         curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
         curl_setopt($ch, CURLOPT_HTTPHEADER, array(
           "Authorization: Bearer ".$_ENV['PAYSTACK_KEY'],
           "Cache-Control: no-cache",
         ));
         
         //So that curl_exec returns the contents of the cURL; rather than echoing it
         curl_setopt($ch,CURLOPT_RETURNTRANSFER, true); 
         
         //execute post
         $request = curl_exec($ch);
         $err = curl_error($ch);
         curl_close($ch);
         if($err){
           // there was an error contacting the Paystack API
           return json_encode(['status'=>false,'msg'=>'Network error, please connect to internet']);
       }
       else{
           $response = json_decode($request, true);
           if($response['status']===true){
               return json_encode(['status'=>true,'msg'=>$response['data']['authorization_url']]);
        
           }
           else{
               return json_encode(['status'=>false,'msg'=>'Transaction failed']);
           }
           
       }
   }

   /**
 * paystack verify payment
 * require reference
 */
public function paystack_verify($reference){
    $curl=curl_init();
   curl_setopt_array($curl, array(
       CURLOPT_URL => "https://api.paystack.co/transaction/verify/" . rawurlencode($reference),
       CURLOPT_RETURNTRANSFER => true,
       CURLOPT_HTTPHEADER => [
         "accept: application/json",
         "Authorization: Bearer ".$_ENV['PAYSTACK_KEY'],
         "cache-control: no-cache"
       ],
     ));
     
     $response = curl_exec($curl);
     $err = curl_error($curl);
     curl_close($curl);
     
     if($err){
         // there was an error contacting the Paystack API
       return "network error";
     }
     else{
         return $response;
     }
}

/**
* flutter wave payment initilize
*/
public function flutterwave($request){
     $curl = curl_init();
curl_setopt_array($curl, array(
CURLOPT_URL => 'https://api.flutterwave.com/v3/payments',
CURLOPT_RETURNTRANSFER => true,
CURLOPT_ENCODING => '',
CURLOPT_MAXREDIRS => 10,
CURLOPT_TIMEOUT => 0,
CURLOPT_FOLLOWLOCATION => true,
CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
CURLOPT_CUSTOMREQUEST => 'POST',
CURLOPT_POSTFIELDS => json_encode($request),
CURLOPT_HTTPHEADER => array(
   "Authorization: Bearer ".$_ENV['FLUTTER_WAVE_KEY'], 
    'Content-Type: application/json'
),
));

$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);
if($err){
   // there was an error contacting the Flutterwave API
   return json_encode(['status'=>false,'msg'=>'Network error, please connect to internet']);
}
else{
   $res = json_decode($response);
   if($res->status == 'success')
   {
       $link = $res->data->link;
       return json_encode(['status'=>true,'msg'=>$link]);
       
   }
   else
   {
       return json_encode(['status'=>false,'msg'=>'Transaction failed']);
   }
}

}
/**
* flutterwave verify payment
* require transaction id
*/
public function flutterwave_verify($txid){
    $curl = curl_init();
   curl_setopt_array($curl, array(
       CURLOPT_URL => "https://api.flutterwave.com/v3/transactions/{$txid}/verify",
       CURLOPT_RETURNTRANSFER => true,
       CURLOPT_ENCODING => "",
       CURLOPT_MAXREDIRS => 10,
       CURLOPT_TIMEOUT => 0,
       CURLOPT_FOLLOWLOCATION => true,
       CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
       CURLOPT_CUSTOMREQUEST => "GET",
       CURLOPT_HTTPHEADER => array(
         "Content-Type: application/json",
         "Authorization: Bearer ".$_ENV['FLUTTER_WAVE_KEY'],
       ),
     ));
     
     $response = curl_exec($curl);
     $err = curl_error($curl);
     curl_close($curl);
     if($err){
       // there was an error contacting the flutterwave API
     return "network error";
   }
   else{
       return $response;
   }
    
}

}