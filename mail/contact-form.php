<?php
require_once "../config.php";
  session_cache_limiter('nocache');
  header('Expires: ' . gmdate('r', 0));
  header('Content-type: application/json');

  // Enter your subject:
  $subject = "Contact Us Message";

  // Enter your success message:
  $success = '<strong>Success!</strong> We will get back to you soon.. :)';

  // Enter your error message:
  $error = '<strong>Error!</strong> Failed to send mail';



  // Form Fields
  $name = $_POST["name"];
  $email = $_POST["email"];
  $mobile= $_POST["phone"];
  $message = $_POST["message"];



  if( $_SERVER['REQUEST_METHOD'] == 'POST') {

    if($email != '' && $message != '') {
      $name = isset($name) ? "Name: $name<br><br>" : '';
      $email = isset($email) ? "Email: $email<br><br>" : '';
      $mobile = isset($mobile) ? "Mobile No: $mobile<br><br>" : '';
      $message = isset($message) ? "Message: $message<br><br>" : '';

      $body = $name . $email . $message. $mobile . '<br><br><br>This email was sent from: ' . $_ENV['APP_URL'];

      $body .= "<p>Alright reserve &copy ".$_ENV['APP_NAME']." ".date('Y'). "</p>";
                 
      //send email using this app email set in mail class
     $sendmail=$mail->send($email,'self', $subject, $body);

      if($sendmail===false) {
        $response = json_encode(array('status'=>'false', 'message' => $error));
        echo json_encode($response);
        exit();

      }else {
        $response = json_encode(array('status'=>'true', 'message' => $success));
        echo json_encode($response);
        exit();
      }
      

    } else {
      $response = json_encode(array('status'=>'false', 'message' => '<strong>There is some error !</strong> Please Contact webmaster :) '));
      echo json_encode($response);
      exit();
    }

  }
?>
