<?php
session_start();
//session_destroy();
require_once __DIR__."/config.php";
$currencies=$dbquery->multiple_row_without_parameter('currencies','name','ASC');
$product_categories=$dbquery->multiple_row_without_parameter('product_categories','name','ASC');
$table1_data="`products`.`unique_id` AS uid,`products`.`name` AS sname,`products`.`price` AS price,
`products`.`description` AS description,`products`.`image` AS image,`product_categories`.`unique_id` AS cid";
$products=$dbquery->multiple_row_without_parameter_join('products','product_categories','category_id','id',$table1_data,'products.name','ASC');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Home| <?=$_ENV['APP_NAME'];?></title>
  <?php require_once __DIR__."/inc/head.php";?>
  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <style>
    /* Paste this css to your style sheet file or under head tag */
    /* This only works with JavaScript,
    if it's not present, don't show loader */
    
    .isotopeSelector{
        margin-left:10px;
        margin-bottom:10px;
        text-align: center;
    }
    .isotopeSelector hr{
        background-color:#ec5598;
        border-width:3px ;
    }
    .isotopeContainer{
        padding-left: 10%;
    }
  </style>

</head>

<body id="body" class="body-wrapper static">
  <div class="se-pre-con"></div>
  <div class="main-wrapper">
    <!-- HEADER -->
   <?php require_once __DIR__."/inc/home_header.php";?>
<!-- MAIN SLIDER -->
    <section class="main-slider" data-loop="true" data-autoplay="true" data-interval="1000">
      <div class="inner">
        
        <!-- Slide One -->
        <div class="slide slideResize slide1" style="background-image: url(img/home/slider_1.jpg);">
          <div class="container">
            <div class="slide-inner1 common-inner">
                  </div>
          </div>
        </div>

        <!-- Slide Two -->
        <div class="slide slideResize slide2" style="background-image: url(img/home/slider_2.jpg);">
          <div class="container">
            <div class="slide-inner2 common-inner">
                </div>
          </div>
        </div>

        <!-- Slide Three -->
        <div class="slide slideResize slide3" style="background-image: url(img/home/slider_3.jpg);">
          <div class="container">
            <div class="common-inner slide-inner3">
              <img src="img/favicon.png" alt="Logo Icon" class="img-responsive">
                  </div>
          </div>
        </div>

        <!-- Slide Four -->
        <div class="slide slideResize slide4" style="background-image: url(img/home/slider_4.jpg);">
          <div class="container">
            <div class="common-inner slide-inner4">
                        </div>
          </div>
        </div>

      </div>
    </section>

 <!-- SERVICES SECTION -->
  <section>
    <div class="clearfix homeGalleryTitle">
      <div class="container">
        <div class="secotionTitle">
          <h2><span>Explore </span>Our Products</h2>
        </div>
      </div>
    </div>

    <div class="container-fluid clearfix homeGallery">
      <div class="row">
        <div class="col-xs-12">
          <div class="filter-container isotopeFilters">
            <ul class="list-inline filter">
              <li class="active"><a href="#" data-filter="*">All Product</a></li>
              <?php
               if($product_categories!==false){
              foreach($product_categories as $category):
              ?>
              <li><a href="#" data-filter=".<?=$category['unique_id'];?>"><?=ucwords($category['name']);?></a></li>
            <?php endforeach; } ?>
            </ul>
          </div>
        </div>
      </div>

      <div class="row isotopeContainer" id="container">
         <?php
          if($product_categories!==false){
         foreach($products as $product):
         ?>
        <div class="col-md-6 col-lg-3 isotopeSelector <?=$product['cid'];?>">
        <div class="priceTableWrapper">
        <div class="priceImage">
        <img data-src="<?=$product['image'];?>" src="<?=$product['image'];?>" alt="<?=$product['sname']." image";?>" class="img-responsive lazyestload">
       
            </div>
            <div class="priceInfo">

            <ul class="list-unstyled">
        <li><?=ucwords($product['sname']);?></li>
        <div class="price-flex">
          <p>
          <?php
          if(isset($_SESSION['currency_rate'])){
            $price=$_SESSION['currency_rate'] * $product['price'];
            echo $_SESSION['currency_symbol'].number_format($price,2);
          }
          else{
            echo $default_currency_symbol['symbol'].number_format($product['price'],2);
          }
          
          ?>
          </p>
        
        </div>
      </ul>
            <a  href="product?id=<?=$product['uid'];?>" class="btn btn-primary first-btn">Buy</a>
          </div>
          </div>
        </div>
<?php endforeach; }?>
      </div>
    </div>
  </section>



    <!-- FOOTER -->
    <?php require_once __DIR__."/inc/footer.php";?>
  </div>


  


  <!-- JAVASCRIPTS -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

  <script src='plugins/selectbox/jquery.selectbox-0.1.3.min.js'></script>
  <script src='plugins/owl-carousel/owl.carousel.min.js'></script>
  <script src='plugins/isotope/isotope.min.js'></script>
  <script src='plugins/fancybox/jquery.fancybox.min.js'></script>
  
  <script src='plugins/isotope/isotope-triger.min.js'></script>
  <script src='plugins/datepicker/bootstrap-datepicker.min.js'></script>
  
  <script src="plugins/lazyestload/lazyestload.js"></script>
  
  <script src="js/mailchimp.js"></script>
  <script src="js/currency.js"></script>
  <script src="plugins/smoothscroll/SmoothScroll.js"></script>
  
  
  <script src="js/custom.js"></script>
 <script>
(function (w, d, s, u) {
w.gbwawc = {
url: u,
options: {
        waId: "<?=$_ENV['APP_PHONE'];?>",
        siteName: "<?=$_ENV['APP_NAME'];?>",
        siteTag: "order,support",
        siteLogo: "<?=$_ENV['APP_LOGO'];?>",
        widgetPosition: "RIGHT",
        triggerMessage: "How can we help you",
        welcomeMessage: "Welcome to <?=$_ENV['APP_NAME'];?>",
        brandColor: "#ec5598",
        messageText: "How can we help you",
        replyOptions: ['I would like to make an order',,'I have a support question',''],
    },
};
var h = d.getElementsByTagName(s)[0],
j = d.createElement(s);
j.async = true;
j.src = u + "/whatsapp-widget.min.js?_=" + Math.random();
h.parentNode.insertBefore(j, h);
})(window, document, "script", "https://waw.gallabox.com");
</script>
  

</body>

</html>

