<?php
session_start();
 require_once "../config.php";
require_once __DIR__ . "/inc/token_generate.php";
use Spatie\UrlSigner\MD5UrlSigner;
//initialize verify temporary sign url
$urlSigner = new MD5UrlSigner('julieclinics');
$url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$verifyUrl = $urlSigner->validate($url);
if ($verifyUrl == false) {
    echo "<script>alert('Wrong link or expired link, click on forgot password again');window.location.href='./';</script>";
    exit();
} else {
    $table = 'password_resets';
    $query = $dbquery->row_with_one_parameter($table, 'token', $_GET['hash']);

    if ($query == false) {
        echo "<script>alert('This password reset token is invalid.');window.location.href='./';</script>";
        exit();
    }
}
 ?>
<!doctype html>
<html lang="en">
 <?php require_once __DIR__."/inc/auth/head.php";?>
<body>
    <!-- ============================================================== -->
    <!-- login page  -->
    <!-- ============================================================== -->
    <div class="splash-container">
        <div class="card ">
            <div class="card-header text-center"><a href="./"><img class="logo-img" src="<?=$_ENV['APP_LOGO'];?>" alt="logo" style="width:30% ;"></a><span class="splash-description">Please enter your user information.</span></div>
            <div class="card-body">
                <form id="reset-password-form">
                    <div class="form-group">
                        <input class="form-control form-control-lg" id="password" name="password" type="password" placeholder="Enter New Password" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <input class="form-control form-control-lg" id="password_confirmation" name="password_confirmation" type="password" placeholder="Confirm Password" autocomplete="off">
                    </div>
                    <input type="hidden" name="hash" id="hash" value="<?= $_GET['hash']; ?>">
                    <input type="hidden" name="token" id="token" value="<?= $_SESSION['_token']; ?>">
                    <button type="submit" id="reset-password" name="reset-password" class="btn  btn-lg btn-block">Reset</button>
                </form>
            </div>
            <div class="card-footer bg-white p-0  ">
                <div class="card-footer-item card-footer-item-bordered">
                    <a href="./" class="footer-link">Go back to Login</a>
                </div>
            </div>
        </div>
    </div>
  
    <!-- ============================================================== -->
    <!-- end login page  -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <?php require_once __DIR__."/inc/auth/script.php";?>
    <?php require_once __DIR__ . "/ajax/reset-password.php"; ?>
</body>
 
</html>