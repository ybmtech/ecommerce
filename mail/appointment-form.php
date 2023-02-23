<?php
  session_cache_limiter('nocache');
  header('Expires: ' . gmdate('r', 0));
  header('Content-type: application/json');

  require_once('php-mailer/PHPMailerAutoload.php');
  $mail = new PHPMailer();

  // Enter your email address:
  $to = 'example@gmail.com';

  // Enter your subject:
  $subject = 'Appointment Request';

  // Enter your success message:
  $success = '<strong>Success!</strong> We will get back to you soon.. :)';

  // Enter your error message:
  $error = '<strong>Error!</strong> Failed to send mail';


  // Form Fields
  $date = $_POST["appointment-form-date"];
  $time= $_POST["appointment-form-time"];
  $full_name = $_POST["appointment-form-full-name"];
  $email = $_POST["appointment-form-email"];
  $phone = $_POST["appointment-form-phone"];
  $address = $_POST["appointment-form-address"];
  $message = $_POST["appointment-form-message"];




  if( $_SERVER['REQUEST_METHOD'] == 'POST') {
    //
    if( $full_name != '' && $email != '' && $phone != '' && $address != '' && $message != '') {

      //If you don't receive the email, enable and configure these parameters below:

      //$mail->isSMTP();                                      // Set mailer to use SMTP
      //$mail->Host = 'mail.yourserver.com';                  // Specify main and backup SMTP servers, example: smtp1.example.com;smtp2.example.com
      //$mail->SMTPAuth = true;                               // Enable SMTP authentication
      //$mail->Username = 'SMTP username';                    // SMTP username
      //$mail->Password = 'SMTP password';                    // SMTP password
      //$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
      //$mail->Port = 587;                                    // TCP port to connect to

      $mail->IsHTML(true);                                    // Set email format to HTML
      $mail->CharSet = 'UTF-8';

      $mail->From = $email;
      $mail->FromName = $name;
      $mail->AddAddress($to);
      $mail->AddReplyTo($email, $name);
      $mail->Subject = $subject;

      $date = isset($date) ? "Date: $date<br><br>" : '';
      $time= isset($time) ? "Time: $time<br><br>" : '';
      $full_name = isset($full_name) ? "Full Name: $full_name<br><br>" : '';
      $email = isset($email) ? "Email: $email<br><br>" : '';
      $phone = isset($phone) ? "Phone: $phone<br><br>" : '';
      $address = isset($address) ? "Address: $address<br><br>" : '';
      $message = isset($message) ? "Message: $message<br><br>" : '';

      $mail->Body = $date . $time. $full_name .  $email . $phone . $address.  $message . '<br><br><br>This email was sent from: ' . $_SERVER['HTTP_REFERER'];


      if(!$mail->Send()) {
        $response = json_encode(array('status'=>'false', 'message' => $error));
        die($response);

      }else {
        $response = json_encode(array('status'=>'true', 'message' => $success));
        die($response);
      }
      echo json_encode($response);

    } else {
      $response = json_encode(array('status'=>'false', 'message' => '<strong>There is some error !</strong> Please Contact webmaster :) '));
      die($response);
    }

  }
?>
