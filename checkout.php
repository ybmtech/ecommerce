<?php
session_start();
require_once __DIR__."/config.php";
if(!isset($_SESSION["order_cart"])){
    header("Location:shop");
}
if(!isset($_SESSION['customer_id']) && isset($_SESSION["order_cart"])){
    $order_code=password_hash($_SESSION['order_code'],PASSWORD_DEFAULT);
header("Location:login?order={$order_code}");
}
if($_SESSION['customer_id']){
  $info=$dbquery->row_with_one_parameter('users','unique_id',$_SESSION['customer_id']);

if(empty($info['is_verify'])){
	header("Location:verify");
}
}
$states=$dbquery->multiple_row_without_parameter('states','name','ASC');
?>
<!DOCTYPE html>
<html lang="en">
<head>

<title>Checkout|<?=$_ENV['APP_NAME'];?></title>
  <?php require_once __DIR__."/inc/head.php";?>
 
  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <link rel="stylesheet" href="css/select2/select2.min.css" >

</head>

<body id="body" class="body-wrapper static">
  <div class="se-pre-con"></div>
  <div class="main-wrapper">
    <!-- HEADER -->
    <?php require_once __DIR__."/inc/header.php";?>

<!-- CHECK OUT SECTION -->
    <section class="clearfix checkout">
      <div class="container">
        <form method="post" action="payment">
          <div class="panel panel-default checkInfo">
            <div class="panel-heading patternbg">1. Shipping</div>
             <div class="panel-body">
              <div class="radio-inline chooseOption">
               
                <form class="form-horizontal">

                  <div class="form-group row">
                    <label class="control-label text-md-right col-md-3 col-xl-2" for="card">State:</label>
                    <div class="col-md-7">
                      <select  class="form-control" id="state" name="state" required="">
                        <option value="" selected disabled>Select State</option>
                      <?php
                            foreach($states as $state){ ?>
                            <option value="<?=$state['id'];?>"><?=ucwords($state['name']);?></option>
                           <?php  }
                            ?>
                         </select>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="control-label text-md-right col-md-3 col-xl-2" for="card">City:</label>
                    <div class="col-md-7">
                      <select  class="form-control" id="city" name="city" required="">
                          </select>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="control-label text-md-right col-md-3 col-xl-2" for="card">Address:</label>
                    <div class="col-md-7">
                      <input type="text" class="form-control" id="address" name="address" required="">
                          
                    </div>
                  </div>
              </div>

            
            </div>
          </div>

          <div class="panel panel-default cartInfo mb-4">
            <div class="panel-heading patternbg">2. Comfirm and Pay</div>
            <div class="panel-body tableArea">
              <div>
                <table class="table">
                  <tbody>
                    <?php
                      if(isset($_SESSION["order_cart"])){
                        $count_products=count($_SESSION["order_cart"]);
                        foreach ($_SESSION["order_cart"] as $item){
                          $product=$dbquery->row_with_one_parameter('products','unique_id',$item['product_id']);
                          $price=$product['price'];
                          $total_price=$price * $item['quantity'];
                    
                    ?>
                    <tr>
                      <td><div class="cartImage"><img src="<?=$product['image'];?>" width="103px" height="98px" data-src="<?=$product['image'];?>" class="lazyestload" alt="<?=$product['name'];?>"></div></td>
                      <td><?=ucwords($product['name']);?> <br> <span>Quantity: <?=$item['quantity'];?></span></td>
                      <td><span class="price">
                      <?php
 if(isset($_SESSION['currency_rate'])){
                $price2=$_SESSION['currency_rate'] * $price;
                echo $_SESSION['currency_symbol'].number_format($price2,2);
              }
              else{
                echo $default_currency_symbol['symbol'].number_format($price,2);
              }
                    ?>
                      </span></td>
                    </tr>
                    <?php } }?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

          <div class="paymentPart">
              <div class="form-group row">
                <div class="col-4">
                  <div class="radio-inline chooseOption">
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="gateway" id="gateway" value="paystack" checked>
                      <label class="form-check-label" for="gateway">
                        Pay with <img src="img/extra/paystack.png" alt="Image paypal" width="79px" height="30px">
                      </label>
                    </div>
                  </div>
                </div>
                
              </div>

            <div class="form-group">
              <div class="totalAmount">
                <span>Shipping:</span><strong id="shipping">
                  <?php
                   if(isset($_SESSION['currency_rate'])){
                    echo $_SESSION['currency_symbol'].number_format(0,2);
                  }
                  else{
                     echo $default_currency_symbol['symbol'].number_format(0,2);
                  }
                  ?>
                </strong><br>
                <span>Sub Total:</span><strong id="subtotal">
                  <?php
                  if(isset($_SESSION['total'])){
                    $subtotal=$_SESSION['total'];
                  }
                  else{
                    $subtotal=0;
                  }
                  if(isset($_SESSION['currency_rate'])){
                    $subtotal2=$_SESSION['currency_rate'] * $subtotal;
                    echo $_SESSION['currency_symbol'].number_format($subtotal2,2);
                  }
                  else{
                    echo $default_currency_symbol['symbol'].number_format($subtotal,2);
                  }
                  ?>
                  </strong><br>
                  <span>Discount:</span><strong>
                  <?php
                  if(isset($_SESSION['coupon_discount'])){
                    if($_SESSION['coupon_discount'] > $_SESSION['total']){
                      echo "Please add more product to use";
                    }
                    else{
                      if(isset($_SESSION['currency_rate'])){
                        $coupon=$_SESSION['currency_rate'] * $_SESSION['coupon_discount'];
                        echo $_SESSION['currency_symbol'].number_format($coupon,2);
                      }
                      else{
                        $coupon=$_SESSION['coupon_discount'];
                        echo $default_currency_symbol['symbol'].number_format($coupon,2);
                      }
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
                  </strong><br>
                  <span>Total:</span><strong id="total">
                <?php
             if(isset($_SESSION['currency_rate'])){
              if($_SESSION['coupon_discount'] > $_SESSION['total']){
                $total2=$_SESSION['currency_rate'] * $_SESSION['total'];
             
              }
              else{
                $total2=$_SESSION['currency_rate'] * ($_SESSION['total'] - $_SESSION['coupon_discount']);
             
              }
                  echo $_SESSION['currency_symbol'].number_format($total2,2);
              }
              else{
                if(isset($_SESSION['total'])){
                  if(isset($_SESSION['coupon_discount']) && $_SESSION['coupon_discount'] > $_SESSION['total']){
                    $total2=$_SESSION['total'];
                  }
                  elseif(!isset($_SESSION['coupon_discount'])){
                    $total2=$_SESSION['total'];
                  }
                  else{
                      $total2=$_SESSION['total'] - $_SESSION['coupon_discount'];
              
                  }
                    echo $default_currency_symbol['symbol'].number_format($total2,2) ?? "";
                  
                }
                else{
                  echo "0.00";
                }
                
              }
                    ?>
                </strong>
              </div>
              <br><br><br><br><br><br>
              <input type="hidden" id="subtotal2" name="subtotal2" value="<?=$subtotal;?>">
              <input type="hidden" id="shipping2" name="shipping2" value="">
              <input type="hidden" id="shipping_naira" name="shipping_naira" value="">
              <input type="hidden" id="total2" name="total2" value="<?=$_SESSION['total'] ?? 0;?>">
              <button type="submit" name="pay" id="pay" class="btn btn-primary" disabled>Complete payment</button>
            </div>

          </div>
        </form>
      </div>
    </section>



    <!-- FOOTER -->
    <?php require_once __DIR__."/inc/footer.php";?>
   
  </div>


  <!-- JAVASCRIPTS -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

  <script src='plugins/selectbox/jquery.selectbox-0.1.3.min.js'></script>
  
  
  <script src="js/mailchimp.js"></script>
  
  
  <script src='plugins/datepicker/bootstrap-datepicker.min.js'></script>
  
  <script src="plugins/lazyestload/lazyestload.js"></script>
  
  
  <script src="plugins/smoothscroll/SmoothScroll.js"></script>
  <script src="js/select2/select2.min.js"></script>
  
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
  $("#state").select2();
  $("#city").select2();
  
      $("#state").on('change',function(){
         let state=$(this).find('option:selected').val();
        $.ajax({
		url : "admin/fetch-city.php",
		data : "state="+state,
		type : 'GET',
		success : function(data) {
            $("#city").html(data); 
		}
	});
      });
      $("#city").on('change',function(){
         let city=$(this).find('option:selected').val();
        $.ajax({
		url : "admin/fetch-price.php",
		data : "city="+city,
		type : 'GET',
		success : function(data) {
      let response=JSON.parse(data);
      let price=response['price'];
       let symbol=response['symbol'];
       let subtotal=response['subtotal'];
     let subtotal2=Number(subtotal);
     let total=Number("<?=$total2;?>") + Number(price);
      $("#shipping").text(symbol+formatMoney(price)); 
      $("#shipping2").val(price); 
      $("#subtotal").text(symbol+formatMoney(subtotal2)); 
      $("#total").text(symbol+formatMoney(total)); 
      $("#total2").val(total); 
      $("#subtotal2").val(response['subtotal2']); 
      $("#shipping_naira").val(response['price_naira']); 
      $("#pay").attr('disabled', false); 
		}
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
      });
  </script>
</body>

</html>


