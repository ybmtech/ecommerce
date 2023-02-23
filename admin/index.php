<?php
session_start();
require_once __DIR__."../../config.php";
if(isset($_SESSION['admin_id'])){
    header('Location:dashboard');
}
 require_once __DIR__."/inc/token_generate.php";
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
            <div class="card-header text-center"><a href="./"><img class="logo-img" src="<?=$_ENV['APP_LOGO'];?>" alt="logo" style="width:30% ;"></a><span class="splash-description">Please enter your login details.</span></div>
            <div class="card-body">
                <form id="login-form">
                    <div class="form-group">
                        <input class="form-control form-control-lg" id="email" name="email" type="email" placeholder="Email" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <input class="form-control form-control-lg" id="password" name="password" type="password" placeholder="Password" autocomplete="off">
                    </div>
                    <!-- <div class="form-group">
                        <label class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox"><span class="custom-control-label">Remember Me</span>
                        </label>
                    </div> -->
                    <input type="hidden" name="token" id="token" value="<?= $_SESSION['_token']; ?>">
                    <button type="submit" id="login-btn" class="btn  btn-lg btn-block">Login</button>
                </form>
            </div>
            <div class="card-footer bg-white p-0  ">
                <div class="card-footer-item card-footer-item-bordered">
                    <a href="forgot-password" class="footer-link">Forgot Password</a>
                </div>
            </div>
        </div>
        <p class="text-center"> Copyright © <?=date('Y');?> <?=$_ENV['APP_NAME'];?></p>
    </div>
  
    <!-- ============================================================== -->
    <!-- end login page  -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <?php require_once __DIR__."/inc/auth/script.php";?>
    <?php require_once __DIR__ . "/ajax/login.php"; ?>
</body>
 
</html>