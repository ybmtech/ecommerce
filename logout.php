<?php
session_start();
unset($_SESSION['_token']);
unset($_SESSION['customer_id']);
unset($_SESSION['customer_email']);
unset($_SESSION['customer_phone']);
unset($_SESSION['name']);
// unset($_SESSION["order_cart"]);
// unset($_SESSION['total']);
// unset($_SESSION['order_code']);
// unset($_SESSION['coupon']);
// unset($_SESSION['coupon_discount']);
header("Location:login");
