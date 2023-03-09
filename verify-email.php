<?php
require_once __DIR__ . "/inc/session.php";
use Spatie\UrlSigner\MD5UrlSigner;
    //initialize verify temporary sign url
    $urlSigner = new MD5UrlSigner('ecommerce');
$url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
   $verifyUrl= $urlSigner->validate($url);
if($verifyUrl==false){
    echo "<script>alert('Wrong link or expired link, please resend new verify link');window.location.href='verify';</script>";
    exit();
}
else{
    $table='users';
    $unique_id=$_GET['id'];
    $data=[
    'is_verify'=>date('d-m-Y H:i:s')
    ];
    $query= $update->update($table, $data, 'unique_id', $unique_id);
    if($query){
        echo "<script>alert('Account verified successful');window.location.href='./';</script>";
        exit();
    }
    else{
        echo "<script>alert('Account verified fail,please resend new verify link');window.location.href='verify';</script>";
        exit();
    }
}
?>