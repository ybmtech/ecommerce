<?php
session_start();
require_once __DIR__."../../config.php";
 require_once __DIR__."/inc/token_generate.php";
 ?>
<!doctype html>
<html lang="en">
<?php require_once __DIR__."/inc/auth/head.php";?>
<body>
    <!-- ============================================================== -->
    <!-- forgot password  -->
    <!-- ============================================================== -->
    <div class="splash-container">
        <div class="card">
            <div class="card-header text-center"><img class="logo-img" src="<?=$_ENV['APP_LOGO'];?>" style="width:30% ;" alt="logo"><span class="splash-description">Please enter your user information.</span></div>
            <div class="card-body">
                <form id="forgot-password-form">
                    <p>Enter the email associated with your account and we'll send an email with instructions to reset your password</p>
                    <div class="form-group">
                        <input class="form-control form-control-lg" type="email" name="email" id="email" placeholder="Your Email" autocomplete="off">
                    </div>
                    <input type="hidden" name="token" id="token" value="<?= $_SESSION['_token']; ?>">
                 
                    <button type="submit" class="btn  btn-lg btn-block" id="forgot-password-btn">Reset Password</button>
                  </form>
            </div>
            <div class="card-footer text-center">
                <span>Already member? <a href="./">Login Here.</a></span>
            </div>
        </div>
        
    </div>
    <!-- ============================================================== -->
    <!-- end forgot password  -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <?php require_once __DIR__."/inc/auth/script.php";?>
    <?php require_once __DIR__ . "/ajax/forgot-password.php"; ?>
</body>

 
</html>