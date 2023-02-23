<?php
session_start();
require_once __DIR__."/config.php";
if(isset($_POST['remove']) && isset($_POST['product_id']) && !empty($_POST['product_id'])){
    if(!empty($_SESSION["order_cart"])) {
        foreach($_SESSION["order_cart"] as $key => $value) {
            if($_POST["product_id"] == $key){
    $get_product=$dbquery->row_with_one_parameter('products','unique_id',$_POST["product_id"]);
    $product_total_price=$get_product['price'] * $_SESSION["order_cart"][$key]["quantity"];
    $_SESSION['total']=$_SESSION['total']-$product_total_price;
            unset($_SESSION["order_cart"][$key]);
            }
            if(empty($_SESSION["order_cart"]))
            unset($_SESSION["order_cart"]);
                }		
            }
}
if(isset($_POST["product_id"]) && isset($_POST["quantity"])) {
    $id=$_POST['product_id'];
    $get_product=$dbquery->row_with_one_parameter('products','unique_id',$id);
    $product_total_price=$get_product['price'] * $_POST['quantity'];
    
     $cartArray = array(
        $id=>array(
         'product_id'=>$_POST['product_id'],
         'quantity'=>$_POST['quantity']
         )
     );

 if(empty($_SESSION["order_cart"])) {
     $_SESSION["order_cart"] = $cartArray;
     $_SESSION['total']=$product_total_price;
 }else{
     $array_keys = array_keys($_SESSION["order_cart"]);
     if(in_array($id,$array_keys)) {
         foreach($_SESSION["order_cart"] as $k => $v) {
             if($cartArray[$id]["product_id"] == $k) {
                 if(empty($_SESSION["order_cart"][$k]["quantity"])) {
                     $_SESSION["order_cart"][$k]["quantity"] = 0;
                 }
                 $_SESSION["order_cart"][$k]["quantity"] += $_POST["quantity"];
                 $_SESSION['total']+=$product_total_price;
             }
     }
     } else {
     $_SESSION["order_cart"] = array_merge(
     $_SESSION["order_cart"],
     $cartArray
     );
     $_SESSION['total']+=$product_total_price;
     }
 
     }
     $_SESSION['order_code']=$_POST['product_id'];
 }
?>
<!DOCTYPE html>
<html lang="en">
<head>

  <!-- SITE TITTLE -->
  <title>Cart|<?=$_ENV['APP_NAME'];?></title>
  <?php require_once __DIR__."/inc/head.php";?>
  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <style>
    .quantity {
  padding-top: 20px;
  margin-right: 60px;
}
.quantity input {
  -webkit-appearance: none;
  border: none;
  text-align: center;
  width: 32px;
  font-size: 16px;
  color: #43484D;
  font-weight: 300;
}
	
 
button[class*=btn] {
  width: 30px;
  height: 30px;
  background-color: #E1E8EE;
  border-radius: 6px;
  border: none;
  cursor: pointer;
}
.minus-btn img {
  margin-bottom: 3px;
}
.plus-btn img {
  margin-top: 2px;
}
 
button:focus,
input:focus {
  outline:0;
}
@media (max-width: 800px) {
  
  .quantity{
    width: 100%;
    text-align: center;
    margin: 6px 0;
  }
  .buttons {
    margin-right: 20px;
  }
}
  </style>

</head>

<body id="body" class="body-wrapper static">
  <div class="se-pre-con"></div>
  <div class="main-wrapper">
    <!-- HEADER -->
    <?php require_once __DIR__."/inc/header.php";?>
<!-- ORDER SECTION -->
    <section class="clearfix orderArea">
    <p class="text-center"><a href="shop" >Continue shopping</a></p>
       <div class="container">
        <div class="row">
          <div class="col-lg-8">
            
              <div class="panel panel-default cartInfo">
                <div class="panel-heading patternbg">your Order</div>
                <div class="panel-body tableArea mb-4 mb-lg-0">
                  <div>          
                    <table class="table">
                      <tbody>

                      <?php
                        $last_product_id="";
                       $last_product_category_id="";
                      if(isset($_SESSION["order_cart"])){
                         $count_products=count($_SESSION["order_cart"]);
                        $i=0;
                        foreach ($_SESSION["order_cart"] as $item){
                           
                        $product=$dbquery->row_with_one_parameter('products','unique_id',$item['product_id']);
                          $price=$product['price'];
                          $total_price=$price * $item['quantity'];
                          if(++$i===$count_products){
                            $last_product_id=$product['unique_id'];
                            $last_product_category_id=$product['category_id'];
                          }
                        ?>
                        <tr>
                          <td><a href="product?id=<?=$product['unique_id'];?>" class="cartImage"><img src="<?=$product['image'];?>" width="103px" height="98px" class="lazyestload" data-src="<?=$product['image'];?>" alt="<?=$product['name'];?>"></a></td>
                          <td><a class="text-wrap" href="product?id=<?=$product['unique_id'];?>"><?=ucwords($product['name']);?></a>
                          <br><span class="price">
                          <?php
 if(isset($_SESSION['currency_rate'])){
                $price2=$_SESSION['currency_rate'] * $product['price'];
                echo $_SESSION['currency_symbol'].number_format($price2,2);
              }
              else{
                echo $default_currency_symbol['symbol'].number_format($product['price'],2);
              }
                    ?>
                          </span>
                          
                        </td>
                        <td width="30%"><div class="quantity">
        <button class="minus-btn" type="button" name="button" onclick="decrement_quantity('<?=$product['unique_id'];?>')">-</button>
      <input type="text" name="quantity" id="quantity_<?=$product['unique_id'];?>" value="<?=$item['quantity'];?>">
      <button class="plus-btn" type="button" name="button" onclick="increment_quantity('<?=$product['unique_id'];?>')">+</button>
    </div></td>
                          <td>
                            <span class="price" id="price_<?=$product['unique_id'];?>">
                             <?php
 if(isset($_SESSION['currency_rate'])){
                $total_price2=$_SESSION['currency_rate'] * $total_price;
                echo $_SESSION['currency_symbol'].number_format($total_price2,2);
              }
              else{
                echo $default_currency_symbol['symbol'].number_format($total_price,2);
              }
                    ?>
                          </span></td>
                          <td>
                            <form action="cart" method="post">
                                <input type="hidden" name="product_id" id="product_id" value="<?=$product['unique_id'];?>">
                               <button type="submit" name="remove" id="remove" class="close">
                              <span aria-hidden="true" class="hidden-xs">×</span>
                            </button>
                        </form>
                          </td>
                        </tr>
                    <?php } } ?>
                    <input type="hidden" id="overall_total_amount" value="
                    <?php
             if(isset($_SESSION['currency_rate'])){
                $total2=$_SESSION['currency_rate'] * $_SESSION['total'];
                echo $total2;
              }
              else{
                echo $_SESSION['total'] ?? "";
              }
                    ?>
                    ">
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            
          </div>

          <div class="col-lg-4">
            <form id="couponForm">
              <div class="panel panel-default cartInfo">
                <div class="panel-heading patternbg">Total <span class="pull-right" id="overal_total">
                  <?php
             if(isset($_SESSION['currency_rate'])){
                $total2=$_SESSION['currency_rate'] * $_SESSION['total'];
                echo $_SESSION['currency_symbol'].number_format($total2,2);
              }
              else{
                if(isset($_SESSION['total'])){
                  echo $default_currency_symbol['symbol'].number_format($_SESSION['total'],2) ?? "";
                  
                }
                else{
                  echo "0.00";
                }
                
              }
                    ?>
                 
                </span></div>
               <?php
               if(isset($_SESSION['total'])){
                ?>
                 <div class="panel-body">
                  <p>Apply Coupon Code</p>
                  <span style="color:#ec5598;" id="coupon_message"></span>
                  <div class="input-group">
                    <input type="text" name="coupon" id="coupon" class="form-control" placeholder="Apply Coupon Code" aria-describedby="basic-addon221" autocomplete="off" required>
                    <button type="button" class="input-group-addon apply-coupon" id="basic-addon221">APPLY</button>
                  </div>
                  Coupon Discount: <span style="color:#ec5598;" id="coupon_discount">
                  <?php
                  if(isset($_SESSION['coupon_discount'])){
                   if(isset($_SESSION['currency_rate'])){
                    $coupon=$_SESSION['currency_rate'] * $_SESSION['coupon_discount'];
                    echo $_SESSION['currency_symbol'].number_format($coupon,2);
                  }
                  else{
                    $coupon=$_SESSION['coupon_discount'];
                    echo $default_currency_symbol['symbol'].number_format($coupon,2);
                  }
                }
                else{
                  if(isset($_SESSION['currency_rate'])){
                     echo $_SESSION['currency_symbol'].number_format(0,2);
                  }
                  else{
                    echo $default_currency_symbol['symbol'].number_format(0,2);
                  }
                }
                  ?>
                </span><br><br>
                  <a href="checkout" class="btn btn-primary btn-block">Checkout</a>
                </div>
              <?php }
                 ?>
              </div>
            </form>
          </div>
          
        </div>
      </div>
    </section>

<!-- RELATED PRODUCT SECTION -->
    <section class="clearfix relatedProduct">
      <div class="container">
      <?php
$related_products=$dbquery->multiple_row_with_two_parameter_rand('products','category_id',$last_product_category_id,'unique_id',$last_product_id,4);
if($related_products!==false){
?>
        <div class="relatedTitle">
          <h2>Related Products</h2>
        </div>

        <div class="row">
        <?php
foreach($related_products as $related_product):
?>
        <div class="col-md-6 col-lg-3">
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

        <?php endforeach; ?>
        </div>
        <?php   } ?>
      </div>
    </section>


    <!-- FOOTER -->
    <?php require_once __DIR__."/inc/footer.php";?>
  </div>

  <!-- JAVASCRIPTS -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="plugins/lazyestload/lazyestload.js"></script>
  
  
  <script src="plugins/smoothscroll/SmoothScroll.js"></script>
  
  <script src="js/mailchimp.js"></script>
  <script src="js/currency.js"></script>
  <script src="js/custom.js"></script>

  <script>
  	//paste this code under head tag or in a seperate js file.
  	// Wait for window load
  	$(window).load(function() {
  		// Animate loader off screen
  		$(".se-pre-con").fadeOut("slow");
  	});
  </script>
<script>
function increment_quantity(product_id) {
    var current_quantity=$("#quantity_"+product_id).val();
    var newQuantity = parseInt(current_quantity)+1;
    update_cart(product_id,current_quantity,newQuantity);
}

function decrement_quantity(product_id) {
    var current_quantity = $("#quantity_"+product_id).val();
    if(current_quantity > 1) 
    {
    var newQuantity = parseInt(current_quantity) - 1;
    update_cart(product_id, current_quantity,newQuantity);
    }
}
function update_cart(product_id, current_quantity,new_quantity) {
	var inputQuantityElement = $("#quantity_"+product_id);
    $.ajax({
		url : "update_cart_quantity.php",
		data : "product_id="+product_id+"&new_quantity="+new_quantity+"&current_quantity="+current_quantity,
		type : 'post',
		success : function(data) {
            let response=JSON.parse(data);
            let price=response['price'];
            let symbol=response['symbol'];
            let previous_price=Number(price) * Number(current_quantity);
            let new_price=Number(price) * Number(new_quantity);
            let previous_overal_total=$('#overall_total_amount').val();
            let overal_total=(Number(previous_overal_total) - previous_price) + new_price;
            $('#price_'+product_id).text(symbol+formatMoney(new_price));
            $('#overal_total').text(symbol+formatMoney(overal_total));
            $('#overall_total_amount').val(overal_total);
			      $(inputQuantityElement).val(new_quantity);
            
		}
	});
}

$('.apply-coupon').on('click',function(){
    let coupon=$('#coupon').val();
    $.ajax({
		url : "apply_coupon.php",
		data : "coupon="+coupon,
		type : 'post',
		success : function(response) {
            let data=JSON.parse(response);
           if(data['status']==false){
            $('#coupon_message').text(data['message']);
            $('#coupon').val("");
           }
           else{
                $('#coupon').val("");
            $('#coupon_message').text(data['message']);
            $('#coupon_discount').text(data['symbol'] + data['discount']);
           }
           
            
		}
	});
});

function formatMoney(number, decPlaces, decSep, thouSep) {
    decPlaces = isNaN(decPlaces = Math.abs(decPlaces)) ? 2 : decPlaces,
    decSep = typeof decSep === "undefined" ? "." : decSep;
    thouSep = typeof thouSep === "undefined" ? "," : thouSep;
    var sign = number < 0 ? "-" : "";
    var i = String(parseInt(number = Math.abs(Number(number) || 0).toFixed(decPlaces)));
    var j = (j = i.length) > 3 ? j % 3 : 0;

    return sign +
        (j ? i.substr(0, j) + thouSep : "") +
        i.substr(j).replace(/(\decSep{3})(?=\decSep)/g, "$1" + thouSep) +
        (decPlaces ? decSep + Math.abs(number - i).toFixed(decPlaces).slice(2) : "");
}

</script>
</body>

</html>

