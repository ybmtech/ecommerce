<?php
session_start();
if(isset($_POST['pay'])){
    require_once __DIR__."/config.php";
    $gateway=$dbquery->filterValue($_POST['gateway']);
    $order_ref=time().mt_rand(99,99999);
      if(isset($_SESSION['coupon_discount']) && $_SESSION['coupon_discount'] > $_SESSION['total']){
      $total=$_SESSION['total'] + $_POST['shipping_naira'];
      $coupon_discount="";
      $coupon="";
   
    }
    elseif(!isset($_SESSION['coupon_discount'])){
      $total=$_SESSION['total'] + $_POST['shipping_naira'];
      $coupon_discount="";
      $coupon="";
    }
    else{
      $total=($_SESSION['total'] + $_POST['shipping_naira']) - $_SESSION['coupon_discount'];
      $coupon_discount=$_SESSION['coupon_discount']??"";
      $coupon=$_SESSION['coupon']??"";  
    }
    
    $orders=[];
    $no_product=0;
    foreach ($_SESSION["order_cart"] as $item){
        $product=$dbquery->row_with_one_parameter('products','unique_id',$item['product_id']);
        $orders[]=[
          'product_id'=>$product['unique_id'],
          'quantity'=>$item['quantity'],
          'price'=>$product['price']
        ];
        $no_product+=1;
    }
    $currency=$_SESSION['currency_name'] ?? "NGN";
     $amount=$total;
    $reference=time().mt_rand(99,999999);
    if($gateway=="paystack"){
        $newAmount =$amount*100;  //the amount in kobo.
          $fields = [
            'email' =>$_SESSION['customer_email'],
            'amount' =>$newAmount,
            'reference' =>$reference,
            'callback_url'=>$_ENV['APP_URL'].'/payment-verify',
            'channels'=>['card'],
            'metadata'=>json_encode([
                "order_ref"=>$order_ref,
                "coupon_discount"=>$coupon_discount,
                "coupon"=>$coupon,
                "delivery_id"=>$_POST['city'],
                "total"=>$_SESSION['total'],
                "delivery_fee"=>$_POST['shipping_naira'],
                "address"=>$_POST['address'],
                "user_id"=>$_SESSION['customer_id'],
                "order"=>$orders,
                "no_product"=>$no_product,
                "currency"=>$currency
              ])
          ];
          $pay=$payment->paystack($fields);
          $decode_pay=json_decode($pay,true);
          $status=$decode_pay['status'];
          $msg=$decode_pay['msg'];
          if($status==true){
              echo "<script>window.location.href='{$msg}';</script>";
          }
          else{
            echo "<script>alert('{$msg}');window.location.href='checkout';</script>"; 
          }
        }
        
        else{
            echo "<script>alert('Please select payment method');window.location.href='checkout';</script>";
        }
}
else{
    header("Location:./");
}
