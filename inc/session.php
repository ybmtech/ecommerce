<?php
session_start();
require_once "config.php";
if(isset($_SESSION['customer_id']))
{
$id= $_SESSION['customer_id'];
$info=$dbquery->row_with_one_parameter('users','unique_id',$id);
}

else
{
	header("Location:login");
}
?>