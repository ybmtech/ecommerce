<?php
session_start();
require_once __DIR__."/config.php";
$reference = isset($_GET['reference']) ? $_GET['reference'] : '';
if(!$reference){
  die('No reference supplied');
}
$response=$payment->paystack_verify($reference);
//log response
$file = fopen('log.log','a');
fwrite($file, "\n paystack shop\n".var_export($response,true));
fclose($file);
$tranx = json_decode($response);

if('success' == $tranx->data->status){
  $refid=$tranx->data->reference;
  $amt=$tranx->data->amount;
  $amount=$amt/100;
  $email=$tranx->data->customer->email;
  $order_ref=$tranx->data->metadata->order_ref;
  $coupon_discount=$tranx->data->metadata->coupon_discount;
  $coupon=$tranx->data->metadata->coupon;
  $delivery_id=$tranx->data->metadata->delivery_id;
  $total=$tranx->data->metadata->total;
  $delivery_fee=$tranx->data->metadata->delivery_fee;
  $no_product=$tranx->data->metadata->no_product;
  $user_id=$tranx->data->metadata->user_id;
  $address=$tranx->data->metadata->address;
  $currency=$tranx->data->metadata->currency;
    $create_at=date("d-m-Y h:i:a");

 		$result=$dbquery->row_with_two_parameter('payment_historys','txref',$reference,'status','1','AND');
		if($result===false)
		{
    $order_detail_table="order_details";
    foreach($tranx->data->metadata->order as $order){
        $order_detail=[
            'product_id'=>$order->product_id,
            'price'=>$order->price,
            'quantity'=>$order->quantity,
            'order_ref'=>$order_ref
            ];
        $insert->insert($order_detail_table,$order_detail);
         }
 
         $order_table="orders";
         $order_data=[
    'order_ref'=>$order_ref,
      'user_id'=>$user_id,
     'currency'=>$currency,
     'coupon_code'=>$coupon,
     'coupon_discount'=>$coupon_discount,
     'payment_status'=>1,
     'delivery_id'=>$delivery_id,
     'delivery_fee'=>$delivery_fee,
     'no_product'=>$no_product,
     'address'=>$address,
     'total'=>$amount,
     'create_at'=>$create_at
         ];
           $saveOrder=$insert->insert($order_table,$order_data);

    $history_table="payment_historys";
    $history_data=[
'email'=>$email,
'txref'=>$reference,
'amount'=>$amount,
'transaction_type'=>'store',
'currency'=>'NGN',
'gateway'=>'paystack',
'status'=>'1',
'paid_at'=>$create_at
    ];
	  $saveHistory=$insert->insert($history_table,$history_data);

    $_SESSION['order']=$order_ref;
    unset($_SESSION["order_cart"]);
unset($_SESSION['total']);
unset($_SESSION['order_code']);
unset($_SESSION['coupon']);
unset($_SESSION['coupon_discount']);
    header("Location:payment-succes");
    
		}
		else{
        $_SESSION['order']=$order_ref;
        
        unset($_SESSION['total']);
        unset($_SESSION['order_code']);
        unset($_SESSION['coupon']);
        unset($_SESSION['coupon_discount']);
        header("Location:payment-succes");
		}
}
?>