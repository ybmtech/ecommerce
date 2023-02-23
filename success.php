<?php
session_start();
require_once __DIR__."/config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Payment Success|<?=$_ENV['APP_NAME'];?></title>
  <?php require_once __DIR__."/inc/head.php";?>
  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  

</head>

<body id="body" class="body-wrapper static">
  <div class="se-pre-con"></div>
  <div class="main-wrapper">
    <!-- HEADER -->
    <?php require_once __DIR__."/inc/header.php";?>
  <!-- SUCCESS -->
  <div class="padding confirmation">
    <div class="container">

      <div class="alert alert-success alert-common alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <i class="fa fa-check"></i>
        Thank you! For your payment
      </div>

      <div class="confirm">
        <h2>Appointment Cancellation Policy</h2>
        <p>Commitment fee is non-refundable if customers
miss appointment date.
If you're running late, kindly give a call an hour before
the appointment time.
If you're cancelling the appintment due to any reason,
kindly contact us 24 hours before the appointment date.</p>
   <div class="confirm-detail">
          <h3>Your appointment id: <span>#<?php echo $_SESSION['booking_id'];?></span></h3>
        </div>
      </div>

    </div>
  </div>


    <!-- FOOTER -->
    <?php require_once __DIR__."/inc/footer.php";?>
  </div>


  
  <!-- JAVASCRIPTS -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

  
  
  
  <script src="js/mailchimp.js"></script>
  
  
  
  
  <script src="plugins/lazyestload/lazyestload.js"></script>
  
  
  <script src="plugins/smoothscroll/SmoothScroll.js"></script>
  
  
  <script src="js/custom.js"></script>

  

</body>

</html>
