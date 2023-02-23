<?php
session_start();
require_once __DIR__."/config.php";
if (isset($_POST['coupon']) && !empty($_POST['coupon'])){
    if(isset($_SESSION['coupon']) && $_SESSION['coupon']==$_POST['coupon']){
      echo json_encode(['status'=>false,'message'=>'coupon already used']);
      exit();
    }
    $check_coupon=$dbquery->row_with_one_parameter('coupons','name',$_POST['coupon']);
    $check_use_coupon=$dbquery->row_with_one_parameter('orders','coupon_code',$_POST['coupon']);
    if($check_coupon!==false){
      if($check_use_coupon!==false){
        echo json_encode(['status'=>false,'message'=>'coupon already used']);
        exit();
      }
        $expire_date=$check_coupon['expire_date'];
        $today_date=date("Y-m-d");
        $expire_time=strtotime($expire_date);
        $today_time=strtotime($today_date);
        if($expire_time < $today_time){
            echo json_encode(['status'=>false,'message'=>'Coupon code has expire']);
            exit();
        }

         $_SESSION['coupon']=$_POST['coupon'];
        $_SESSION['coupon_discount']=$check_coupon['discount'];
        if(isset($_SESSION['currency_rate'])){
          $discount=$_SESSION['currency_rate'] * $check_coupon['discount'];
          $symbol=$_SESSION['currency_symbol'];
          $discount=number_format($discount,2);
        }
        else{
          $symbol=$default_currency_symbol['symbol'];
          $discount=$check_coupon['discount'];
          $discount=number_format($discount,2);
        }
        echo json_encode(['status'=>true,'message'=>'Coupon Applied','discount'=>$discount,'symbol'=>$symbol]);
      exit();
    }
    else{
        echo json_encode(['status'=>false,'message'=>'Wrong coupon code']);
      exit();
    }
    
  }
 
  