<?php
session_start();
require_once __DIR__."/config.php";
if (isset($_POST['product_id']) && !empty($_POST['product_id']) && isset($_POST['new_quantity']) && !empty($_POST['new_quantity']) && isset($_POST['current_quantity']) && !empty($_POST['current_quantity'])){
    foreach($_SESSION["order_cart"] as &$value){
      if($value['product_id'] == $_POST["product_id"]){
          $value['quantity'] = $_POST["new_quantity"];
          break; 
      }
  }
$product=$dbquery->row_with_one_parameter('products','unique_id',$_POST['product_id']);
if(isset($_SESSION['currency_rate'])){
  $price=$_SESSION['currency_rate'] * $product['price'];
  $symbol=$_SESSION['currency_symbol'];
}
else{
  $symbol=$default_currency_symbol['symbol'];
  $price=$product['price'];
}
$current_product_total_price=$product['price'] * $_POST['current_quantity'];
$new_product_total_price=$product['price'] * $_POST['new_quantity'];
$_SESSION['total']-=$current_product_total_price;
$_SESSION['total']+=$new_product_total_price; 

 echo json_encode(['symbol'=>$symbol,'price'=>$price]);
  }