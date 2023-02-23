<?php
session_start();
require_once "../config.php";
$city_id=$_GET['city'];
$row=$dbquery->row_with_one_parameter('delivery_locations','unique_id',$city_id);
if(isset($_SESSION['currency_rate'])){
    $price=$_SESSION['currency_rate'] * $row['price'];
    $subtotal=($_SESSION['currency_rate'] * $_SESSION['total']) + $price;
    $symbol=$_SESSION['currency_symbol'];
  }
  else{
    $symbol=$default_currency_symbol['symbol'];
    $price=$row['price'];
    $subtotal=$_SESSION['total'] + $price;
    $total=$_SESSION['total'] + $price;
  }
  
  $subtotal2=$_SESSION['total'];
   echo json_encode(['symbol'=>$symbol,'price'=>$price,'price_naira'=>$row['price'],'subtotal'=>$subtotal,'subtotal2'=>$subtotal2]);
