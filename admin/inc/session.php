<?php
session_start();
require_once "../config.php";
if(isset($_SESSION['admin_id']))
{
$id= $_SESSION['admin_id'];
$info=$dbquery->row_with_one_parameter('users','unique_id',$id);
}

else
{
	header("Location:./");
}
?>