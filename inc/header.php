<header id="pageTop" class="header">
<!-- TOP INFO BAR -->
<div class="top-info-bar">
  <div class="container">
    <div class="top-bar-right">
      <ul class="list-inline">
        <li><a href=""><i class="fa fa-envelope" aria-hidden="true"></i> <?=$_ENV['APP_EMAIL'];?></a></li>
        <li><span><i class="fa fa-phone" aria-hidden="true"></i><?=$_ENV['APP_PHONE'];?></span></li>
      </ul>
    </div>
  </div>
</div>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-md main-nav navbar-light">
  <div class="container">

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>

    <a class="navbar-brand" href="./"><img class="lazyestload" data-src="<?=$_ENV['APP_LOGO'];?>" src="<?=$_ENV['APP_LOGO'];?>" alt="logo"></a>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item <?=(getUri()=="/" || getUri()=="index.php" || getUri()=="") ? "active" : "";?>">
          <a class="nav-link" href="./">Home <span class="sr-only">(current)</span></a>
        </li>

      
        <li class="nav-item <?=(getUri()=="shop") ? "active" : "";?>">
          <a class="nav-link " href="shop">Shop</a>
        </li>

        <li class="nav-item <?=(getUri()=="contact") ? "active" : "";?>">
          <a class="nav-link" href="contact">Contact Us</a>
        </li>

        <li class="nav-item <?=(getUri()=="about") ? "active" : "";?>">
          <a class="nav-link" href="about">About Us</a>
        </li>

              <?php
        if(!isset($_SESSION['customer_id'])){ ?>
 <li class="nav-item <?=(getUri()=="login") ? "active" : "";?>">
          <a class="nav-link" href="login">Login</a>
        </li>
        <?php }
        else{
?>
 <li class="nav-item dropdown ">
          <a class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" href="javascript:void(0)"><?=$_SESSION['name'];?></a>

          <ul class="dropdown-menu">
            <li><a href="dashboard">Dashboard</a></li>
            <li><a href="logout">Logout</a></li>
              </ul>
        </li>
       <?php }
        ?>

      </ul>
    </div>
    
    <div class="cart_btn">
    <a href="cart"><i class="fa fa-shopping-basket" aria-hidden="true"></i><span class="badge">
    <?php
        $cart=$_SESSION["order_cart"] ?? 0;
        if($cart==0){
          echo 0;
        }
        else{
          echo count(array_keys($_SESSION["order_cart"]));
        }
       
        ?>
   </span></a>
      </div>
    <!-- header search ends-->
  </div>
</nav>

</header>