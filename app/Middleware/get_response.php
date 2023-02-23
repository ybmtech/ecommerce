<?php
class Responses{
    public $message;
public function jsonResponse($message,$data){
    $this->message=$message;
   $response=$this->ResponseData();
   if(empty($data)){
    return json_encode(['status'=>$response['status'],'message'=>$response['message']]);
   }
   else{
    return json_encode(['status'=>$response['status'],'message'=>$response['message'],'data'=>$data]);
   }
    
}
public function ResponseData(){
 $response=[
'reg_success'=>['status'=>true,'message'=>'Account created successful'],
'mail'=>['status'=>true,'message'=>'Mail has been sent to your email'],
'profile_update_success'=>['status'=>true,'message'=>'Profile updated successful'],
'password_update_success'=>['status'=>true,'message'=>'Password changed successful'],
'update_success'=>['status'=>true,'message'=>'Updated successful'],
'no_access'=>['status'=>false,'message'=>'Invalid request'],
'server_error'=>['status'=>false,'message'=>'Sorry,we could not process your request. try later'],
'not_email'=>['status'=>false,'message'=>'Please provide a valid email'],
'parameter_error'=>['status'=>false,'message'=>'Required field missed'],
'incorrect_token'=>['status'=>false,'message'=>'Invalid token'],
'token_expire'=>['status'=>false,'message'=>'Link has expired'],
'wrong_token'=>['status'=>false,'message'=>'Wrong link'],
'user_exit'=>['status'=>false,'message'=>'User with email exist'],
'password_length'=>['status'=>false,'message'=>'Password cannot be less than 8 characters long'],
'incorrect_username'=>['status'=>false,'message'=>'Incorrect username'],
'incorrect_password'=>['status'=>false,'message'=>'Incorrect password'],
'password_not_match'=>['status'=>false,'message'=>'Confirm password does not match with password'],
'curent_password_not_match'=>['status'=>false,'message'=>'Wrong password,provide current password'],
'login_success'=>['status'=>true,'message'=>'Login was successful'],
'user_not_exit'=>['status'=>false,'message'=>'User not found'],
'user_not_email'=>['status'=>false,'message'=>'Email not found'],
'image_extention'=>['status'=>false,'message'=>'Sorry, only JPG, JPEG, PNG format are allowed'],
'image_size'=>['status'=>false,'message'=>'Sorry, your image is too large, please upload 5mb size'],
'success'=>['status'=>true,'message'=>'Successful'],
'not_admin'=>['status'=>false,'message'=>'You don\'t have access'],
'low_wallet_balance'=>['status'=>false,'message'=>'Your wallet balance is low'],
'no_data'=>['status'=>false,'message'=>'Require data not found'],
'no_bvn'=>['status'=>false,'message'=>'bvn is required to generate virtual account number'],
'virtual_account_fail'=>['status'=>false,'message'=>'Incorrect bvn, make sure your bvn is correct'],
'virtual_account_exit'=>['status'=>false,'message'=>'You have already generate account number'],
'wrong_order_ref'=>['status'=>false,'message'=>'Wrong order reference number'],
'not_paid'=>['status'=>false,'message'=>'payment has not been made'],
'refresh_token'=>['status'=>false,'message'=>'You don\'t have access']
 ];
 return $response[$this->message];
}
}
?>