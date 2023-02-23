<?php
session_start();
require_once __DIR__."/config.php";
require_once __DIR__."/config.php";
$id=$dbquery->filterValue($_GET['id'])??"";
$category=$dbquery->row_with_one_parameter('product_categories','unique_id',$id);
if($category==false){
    header('Location:./');
}
$products=$dbquery->multiple_row_with_one_parameter('products','id',$category['id'],'id','DESC');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title><?=ucwords($category['name']);?>|<?=$_ENV['APP_NAME'];?></title>
  <?php require_once __DIR__."/inc/head.php";?>
  <style>
	
	.paginationCommon {
  display: block;
}
.paginationCommon a:hover{
  background-color: #ec5598;
  color:#ffffff;
}
.paginationCommon a {
  color: black;
  float: left;
  padding: 8px 16px;
  text-decoration: none;
  border: 1px solid #ec5598;
  margin: 0 4px;
  transition: all 0.3s ease-in-out;
}
.paginationCommon a:first-child {
  border-top-left-radius: 5px;
  border-bottom-left-radius: 5px;
}

.paginationCommon a:last-child {
  border-top-right-radius: 5px;
  border-bottom-right-radius: 5px;
}
		</style>
</head>

<body id="body" class="body-wrapper static">
  <div class="se-pre-con"></div>
  <div class="main-wrapper">
    <!-- HEADER -->
    <?php require_once __DIR__."/inc/header.php";?>
<!-- PRODUCT SECTION -->
    <section class="container-fluid clearfix productArea">
      <div class="container paginate-container">
          <h3 class="text-center" style="color:#ec5598"><?=ucwords($category['name']);?></h3>
            <div class="row paginate">
             <?php
             if($products!==false){
              foreach($products as $product):
             ?>

              <div class="col-md-6 col-lg-4 col-xl-3">
                <div class="produtSingle">
                  <div class="produtImage">
                    <img src="<?=$product['image'];?>" data-src="<?=$product['image'];?>" alt="<?=$product['name'];?>" class="img-responsive lazyestload">
                    <div class="productMask">
                      <ul class="list-inline productOption">
                      
                        <li><a href="product?id=<?=$product['unique_id'];?>"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a></li>

                      </ul>
                    </div>
                  </div>
                  <div class="productCaption">
                    <h2><a href="product?id=<?=$product['unique_id'];?>"><?=ucwords($product['name']);?></a></h2>
                    <h3>
                    <?php
 if(isset($_SESSION['currency_rate'])){
                $price=$_SESSION['currency_rate'] * $product['price'];
                echo $_SESSION['currency_symbol'].number_format($price,2);
              }
              else{
                echo $default_currency_symbol['symbol'].number_format($product['price'],2);
              }
                    ?>
                    </h3>
                  </div>
                </div>
              </div>

              <?php  endforeach; } ?>
              
            </div>
            
            <?php
             if($products!==false){ ?>
            <div class="paginationCommon productPagination">
              
            </div>
            <?php  } ?>
        

      </div>
    </section>


    <!-- FOOTER -->
    <?php require_once __DIR__."/inc/footer.php";?>
  </div>


  


  <!-- JAVASCRIPTS -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="js/mailchimp.js"></script>
  
  <script src="plugins/lazyestload/lazyestload.js"></script>
  
  
  <script src="plugins/smoothscroll/SmoothScroll.js"></script>
  <script src="js/purePajinate.es5.min.js"></script>
  
  
  <script src="js/custom.js"></script>

  <script>
  	//paste this code under head tag or in a seperate js file.
  	// Wait for window load
  	$(window).load(function() {
  		// Animate loader off screen
  		$(".se-pre-con").fadeOut("slow");
  	});
  </script>
<script type="text/javascript">
	document.onreadystatechange = function() {
		if (document.readyState === "complete") {
			var example_2 = new purePajinate({ 
				containerSelector: '.paginate-container .paginate ', 
				itemSelector: '.paginate-container .paginate  > div', 
				navigationSelector: '.paginate-container .paginationCommon',
				wrapAround: true,
				showFirstLast: true,
				itemsPerPage: 4 
			});

		
		}
	};
</script>
</body>

</html>
