<?php
require_once __DIR__."/vendor/autoload.php";
    use App\Controller\ConnectDb;
    use App\Controller\Token;
    use App\Controller\Insert;
    use App\Controller\Mail;
    use App\Controller\DbQuery;
    use App\Controller\Sms;
    use App\Controller\PayGateway;
    use App\Controller\Update;
    use App\Controller\Upload;
    use App\Controller\Login;
    use App\Middleware\Filter;
    use App\Middleware\myJson;
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
    $checkToken=new Token();
    $dbquery=new DbQuery();
    $insert=new Insert();
    $login=new Login();
    $uploadFile=new Upload();
    $update=new Update();
    $Filter=new Filter();
    $mail=new Mail();
    $sms=new Sms();
    $payment=new PayGateway();
$default_currency_symbol=$dbquery->row_with_one_parameter('default_currency','status',1);

function getUri(){
    $uri= $_SERVER['REQUEST_URI'];
    $explode_uri=explode('/',$uri);
   return  $explode_uri[1];
     }
?>