<?php
session_start();
require_once __DIR__."/config.php";
$id=$dbquery->filterValue($_GET['id'])??"";
$product=$dbquery->row_with_one_parameter('products','unique_id',$id);
if($product==false){
    header('Location:./');
}
$category=$dbquery->row_with_one_parameter('product_categories','id',$product['category_id']);

?>
<!DOCTYPE html>
<html lang="en">
<head>
<title><?=ucwords($product['name']);?>|<?=$_ENV['APP_NAME'];?></title>
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

<!-- SINGLE PRODUCT SECTION -->
    <section class="clearfix singleProduct">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <div class="singleIamge">
              <img src="<?=$product['image']?>" data-src="<?=$product['image']?>" alt="<?=$product['name']?>" class="img-responsive lazyestload">
            </div>
          </div>

          <div class="col-md-6">
            <div class="singleProductInfo">
              <h2><?=ucwords($product['name']);?></h2>
              <h3><?php
 if(isset($_SESSION['currency_rate'])){
                $price=$_SESSION['currency_rate'] * $product['price'];
                echo $_SESSION['currency_symbol'].number_format($price,2);
              }
              else{
                echo $default_currency_symbol['symbol'].number_format($product['price'],2);
              }
                    ?>
               <del><?php
 if(isset($_SESSION['currency_rate'])){
                $price=$_SESSION['currency_rate'] * $product['price'];
                echo $_SESSION['currency_symbol'].number_format($price,2);
              }
              else{
                echo $default_currency_symbol['symbol'].number_format($product['price'],2);
              }
                    ?></del></h3>
              <p><?=$product['description'];?></p>

              <div class="finalCart">
                <form action="cart" method="post">
                <input type="number" name="quantity" id="quantity" value="1" min="1" max="999">
                <input type="hidden" name="product_id" id="product_id" value="<?=$id;?>">
                <button class="btn btn-primary"><i class="fa fa-shopping-basket" aria-hidden="true"></i>Add to cart</button>
                 </form>
            </div>

              <ul class="list-inline category">
                <li>Category:</li>
                <li><a href="product-categories?id=<?=$category['unique_id']?>"><?=ucwords($category['name']);?></a></li>
                 </ul>

           
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-12">
            <div class="tabCommon tabOne singleTab">
              <ul class="nav nav-tabs">
              <li><a class="active" data-toggle="tab" href="#details">Description</a></li>
              <!-- <li><a data-toggle="tab" href="#reviews">Reviews (2)</a></li> -->
              </ul>

              <div class="tab-content patternbg">
              <div id="details" class="tab-pane show fade in active">
                  <h4>Product Description</h4>
                  <p><?=$product['description'];?></p>
                 
                </div>
                <div id="reviews" class="tab-pane fade">
                  <div class="blogCommnets">

                    <div class="media">
                      <a class="media-left" href="javascript:void(0)">
                        <img class="media-object lazyestload" data-src="img/blog/user-1.jpg" src="img/blog/user-1.jpg" alt="Image">
                      </a>
                      <div class="media-body">
                        <h4 class="media-heading">Integer blandit</h4>
                        <h5><span><i class="fa fa-calendar" aria-hidden="true"></i>22 September, 2016</span></h5>
                        <p>Reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English.</p>
                        
                      </div>
                    </div>
                  
                 

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
<?php
$related_products=$dbquery->multiple_row_with_two_parameter_rand('products','category_id',$product['category_id'],'unique_id',$id,4);
if($related_products!==false){
?>
        <div class="row">
          <div class="col-12">
            <div class="relatedTitle">
              <h2>Related Products</h2>
            </div>
          </div>
        </div>

        <div class="row">

<?php
foreach($related_products as $related_product):
?>
          <div class="col-md-3 col-lg-3">
            <a href="product?id=<?=$related_product['unique_id'];?>" class="realatedInner">
              <div class="productBox">
                <img src="<?=$related_product['image'];?>" data-src="<?=$related_product['image'];?>" alt="<?=$related_product['name'];?>" class="img-responsive lazyestload">
              </div>
              <div class="productName"><?=ucwords($related_product['name']);?></div>
              <div class="productPrice">
              <?php
               if(isset($_SESSION['currency_rate'])){
                $price=$_SESSION['currency_rate'] * $related_product['price'];
                echo $_SESSION['currency_symbol'].number_format($related_product,2);
              }
              else{
                echo $default_currency_symbol['symbol'].number_format($related_product['price'],2);
              }
                    ?>
                </div>
            </a>
          </div>

<?php  endforeach; } ?>
</div>
      </div>
    </section>

    <?php require_once __DIR__."/inc/footer.php";?>
    <!-- FOOTER -->
  </div>




  <!-- JAVASCRIPTS -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

  
  
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
