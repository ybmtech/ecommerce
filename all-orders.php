<?php
require_once __DIR__."/inc/session.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>

  <!-- SITE TITTLE -->
  <title>All Orders |<?=$_ENV['APP_NAME'];?></title>
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


<!-- ORDER SECTION -->
      <section class="clearfix orderSection padding">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <ul class="list-inline squareBtn">
              <li class="li"><a href="dashboard" class="btn btn-common">Account Dashboard</a></li>
                 <li class="li"><a href="javascript:void(0)" class="btn btn-common btn-theme cursor-default">All Orders</a></li>
                   <li class="li"><a href="profile" class="btn btn-common">Profile</a></li>
                            </ul>
            </div>
          </div>

          <div class="row">
            <div class="col-12">
              <div class="innerWrapper">
                <div class="orderBox  patternbg">
                  All Orders
                </div>

                <div class="table-responsive">
                  <table class="table">
                    <thead>
                    <tr>
                          <th>Order ID</th>
                          <th>Date</th>
                          <th>No. Product</th>
                          <th>Shipping</th>
                          <th>Total</th>
                          <th>Payment Status</th>
                          <th>Delivery Status</th>
                          <th></th>
                        </tr>
                    </thead>

                    <tbody>
                     
                    <?php
                       $currencies=$dbquery->multiple_row_without_parameter('currencies','name','ASC');
                        $get_all_orders=$dbquery->multiple_row_with_one_parameter('orders','user_id',$_SESSION['customer_id'],'id','DESC');
                        if($get_all_orders!==false)
                        foreach($get_all_orders as $order){
                          $order_currency_search=array_search($order['currency'],array_column($currencies,'name'));
                          $order_currency_id=$currencies[$order_currency_search]['unique_id'];
                         if($order_currency_id==$default_currency_symbol['unique_id']){
                           $order_currency=$default_currency_symbol['symbol'];
                           $delivery_fee=$order_currency.number_format($order['delivery_fee'],2);
                           $total=$order_currency.number_format($order['total'],2);
                         }
                         else{
                           $order_currency=$currencies[$order_currency_search]['symbol'];
                           $delivery_fee=$currencies[$order_currency_search]['rate']*$order['delivery_fee'];
                           $delivery_fee=$order_currency.number_format($delivery_fee,2);
                           $total=$currencies[$order_currency_search]['rate'] * $order['total'];
                           $total=$order_currency.number_format($total,2);
                     
                         }
                        ?>
                        <tr>
                          <td>#<?=$order['order_ref'];?></td>
                          <td><?=$order['create_at'];?></td>
                          <td><?=$order['no_product']?></td>
                          <td> <?=$delivery_fee;?></td>
                          <td> <?=$total;?></td>
                          <td><?=($order['payment_status']==1) ? "Paid" : "Not paid"?></td>
                          <td><?=($order['delivery_status']==1) ? "Delivered" : "Pending"?></td>
                            <td><a href="order-details?ref=<?=$order['order_ref'];?>" class="btn btn-default">View</a></td>
                       </tr>
                        <?php } ?>
                     
                      
                    </tbody>
                  </table>
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
