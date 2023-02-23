<?php
session_start();
require_once "../../config.php";
use Spatie\UrlSigner\MD5UrlSigner;
$token = $dbquery->filterValue($_POST['token']);
if (!$token || $token !== $_SESSION['_token']) {
    $res = json_encode(['status' => false, 'message' => 'Bad request', 'error' => 'token']);
    echo $res;
    exit();
}
else{
    //check password token  from the database
    $table = 'password_resets';
$hash = $dbquery->filterValue($_POST['hash']);
        $row =$dbquery->row_with_one_parameter($table,'token', $hash);
       if($row){
            $user_table = 'users';
            $email= $row['email'];
            $password = $dbquery->filterValue($_POST['password']);
            $data = [
                'password' => password_hash($password,PASSWORD_DEFAULT)
            ];
            $query = $update->update($user_table, $data, 'email', $email);
            if($query){
            $dbquery->delete_with_one_parameter($table, 'token', $hash);
                $msg = json_encode(['status' => true, 'message' => 'Your password has been reset!,you can now login']);
                echo $msg;
                exit();
            }
            else{
                $msg = json_encode(['status' => false, 'message' => "Oops, we are sorry you cannot change password now.", 'error' => 'database']);
                echo $msg;
                exit();
            }
        
       }
       else{
        $msg = json_encode(['status' => false, 'message' => "This password reset token is invalid.", 'error' => 'database']);
        echo $msg;
        exit();
       }
        
    }   				
?>