<?php
require_once __DIR__."/inc/session.php";
require_once __DIR__ . "/inc/token_generate.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>

  <!-- SITE TITTLE -->
  <title>Profile |<?=$_ENV['APP_NAME'];?></title>
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

<!-- USER SECTION -->
      <section class="clearfix userSection padding">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <ul class="list-inline squareBtn">
              <li class="li"><a href="dashboard" class="btn btn-common">Account Dashboard</a></li>
                 <li class="li"><a href="all-orders" class="btn btn-common">All Orders</a></li>
                   <li class="li"><a href="javascript:void(0)" class="btn btn-common">Profile</a></li>
   </ul>
            </div>
          </div>

          <div class="row">
            <div class="col-12">
              <div class="innerWrapper">
                <div class="orderBox  patternbg">
                  profile
                </div>

                <div class="profile">
                <p style="color:#ec5598; text-align:center;" id="profile-msg"></p>
             
                  <div class="row">
                 
                    <!-- <div class="col-md-3 col-xl-2">
                      <div class="thumbnail">
                        <img class="lazyestload" data-src="img/home/team-1.jpg" src="img/home/team-1.jpg" alt="profile-image">
                        <div class="caption">
                          <div  class="imagediv">
                            <span class="visibleimg"></span>
                            <span class="showonhover">Change Avatar</span>
                            <input id="selectfile" type="file" name="" style="display: none;" />
                          </div>
                        </div>
                      </div>
                    </div> -->
                  
                    <div class="col-md-9 col-xl-10">
                      <form class="form-horizontal" id="profile-form">
                       
                        <div class="form-group row">
                          <label class="col-md-4 col-xl-2 control-label text-md-right">Full Name</label>
                          <div class="col-md-8 col-xl-10">
                            <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Enter Your Full Name" value="<?=$_SESSION['name']?>">
                          </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-md-4 col-xl-2 control-label text-md-right">Phone Number</label>
                          <div class="col-md-8 col-xl-10">
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter Your Phone no" value="<?=$_SESSION['customer_phone']?>">
                          </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-md-4 col-xl-2 control-label text-md-right">Email Address</label>
                          <div class="col-md-8 col-xl-10">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter Your Email Address" value="<?=$_SESSION['customer_email']?>" readonly>
                          </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-md-4 col-xl-2 control-label text-md-right">Password</label>
                          <div class="col-md-8 col-xl-10">
                            <input type="password" class="form-control" id="password" name="password"  placeholder="Enter Password">
                          </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-md-4 col-xl-2 control-label text-md-right">New Password</label>
                          <div class="col-md-8 col-xl-10">
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Enter New Password">
                          </div>
                        </div>
                        
                        <div class="form-group row justify-content-md-end">
                          <div class="col-lg-offset-10 col-xl-2 col-offset-9 col-md-3">
                          <input type="hidden" name="token" id="token" value="<?= $_SESSION['_token']; ?>">
                 
                            <button type="submit" id="profile-btn" name="profile-btn" class="btn btn-primary btn-block">UPDATE </button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>



    <!-- FOOTER -->
    <?php require_once __DIR__."/inc/footer.php";?>
  
  </div>


  <!-- JAVASCRIPTS -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <?php require_once __DIR__."/ajax/profile.php";?>
  <script src="js/mailchimp.js"></script>
  
  <script src="plugins/lazyestload/lazyestload.js"></script>
  
  
  <script src="plugins/smoothscroll/SmoothScroll.js"></script>
  
  
  <script src="js/custom.js"></script>

  <script>
  	//paste this code under head tag or in a seperate js file.
  	// Wait for window load
  	$(window).load(function() {
  		// Animate loader off screen
  		$(".se-pre-con").fadeOut("slow");
  	});
  </script>

</body>

</html>
