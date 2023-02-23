<?php
require_once __DIR__."/inc/session.php";
if( empty($_GET['ref']) ){
    header("Location:all-orders");
    }
     $order=$dbquery->row_with_one_parameter('orders','order_ref',$_GET['ref']);
     $delivery_point=$dbquery->row_with_one_parameter('delivery_locations','unique_id',$order['delivery_id']);
  
?>
<!DOCTYPE html>
<html lang="en">
<head>

  <!-- SITE TITTLE -->
  <title>Dashboard |<?=$_ENV['APP_NAME'];?></title>
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




<!-- DASHBOARD SECTION -->
      <section class="clearfix orderSection padding">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <ul class="list-inline squareBtn">
              <li class="li"><a href="dashboard" class="btn btn-common">Account Dashboard</a></li>
                 <li class="li"><a href="all-orders" class="btn btn-common">All Orders</a></li>
                  <li class="li"><a href="profile" class="btn btn-common">Profile</a></li>
             
                           </ul>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="innerWrapper">
                <!-- <div class="alert alert-warning alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <strong>Warning!</strong> You have one unpaid order. 
                </div> -->
                <h5 class="mb-0">Delivery City: <?=ucwords($delivery_point['name']);?></h5>
            <h5 class="mb-0">Delivery Address: <?=ucwords($order['address']);?></h5>
                               </span></h3>
                
                <div class="dashboard">
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>#</th>
                        <th>Name</th>
                         <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                         $currencies=$dbquery->multiple_row_without_parameter('currencies','name','ASC');
                         $order_currency_search=array_search($order['currency'],array_column($currencies,'name'));
                         $order_currency_id=$currencies[$order_currency_search]['unique_id'];
                        
                      $table1_data="`order_details`.`id` AS oid,`order_details`.`product_id` AS pid, `order_details`.`quantity`,`order_details`.`price`,`order_details`.`order_ref`,`products`.`name`";
              $rows=$dbquery->multiple_row_with_one_parameter_join('order_details','products','product_id','unique_id',$table1_data,'`order_details`.`order_ref`',$_GET['ref'],'order_details.id','ASC');                                            
                    if($rows!==false){
                        $cnt=1;
                 foreach($rows as $row):
                  if($order_currency_id==$default_currency_symbol['unique_id']){
                    $order_currency=$default_currency_symbol['symbol'];
                    $delivery_fee=$order_currency.number_format($order['delivery_fee'],2);
                    $total=$order_currency.number_format($order['total'],2);
                    $price=$order_currency.number_format($row['price'],2);
                    $total_price=$row['price'] * $row['quantity'];
                    $total_price=$order_currency.number_format($total_price,2);
                if(empty($order['coupon_discount'])){
                $coupon_discount=$order_currency.number_format(0,2);
                }
                else{
                  $coupon_discount=$order_currency.number_format($order['coupon_discount'],2);
             
                }
                  }
                  else{
                    $order_currency=$currencies[$order_currency_search]['symbol'];
                    $delivery_fee=$currencies[$order_currency_search]['rate'] * $order['delivery_fee'];
                    $delivery_fee=$order_currency.number_format($delivery_fee,2);
                    $total=$currencies[$order_currency_search]['rate'] * $order['total'];
                    $total=$order_currency.number_format($total,2);
                     $price=$currencies[$order_currency_search]['rate'] * $row['price'];
                     $price=$order_currency.number_format($price,2);
                     $total_price=$currencies[$order_currency_search]['rate'] * $row['price'] * $row['quantity'];
                     $total_price=$order_currency.number_format($total_price,2);
                     if(empty($order['coupon_discount'])){
                      $coupon_discount=$order_currency.number_format(0,2);
                      }
                      else{
                        $coupon_discount=$currencies[$order_currency_search]['rate'] * $order['coupon_discount'];
                        $coupon_discount=$order_currency.number_format($coupon_discount,2);
                   
                      }
                  }
                                            ?>
                        <tr>
                        <td><?=$cnt;?></td>
                        <td><?=ucwords($row['name']);?></td>
                                                <td><?=$row['quantity'];?></td>
                                                <td><?=$price;?></td>
                                                <td><?=$total_price;?></td>     
                                       </tr>
                         <?php $cnt++; endforeach; } ?>
                         <tr>
                             <td><?=$cnt;?></td>
                            <td>Delivery Fee</td>
                            <td></td>
                            <td></td>
                            <td><?=$delivery_fee?></td>
                           
                         </tr>
                         <tr>
                             <td></td>
                            <td></td>
                            <td></td>
                            <td>Discount</td>
                            <td><?=$coupon_discount?></td>
                           
                         </tr>
                         <tr>
                             <td></td>
                            <td></td>
                            <td></td>
                            <td>Total</td>
                            <td><?=$total;?></td>
                           
                         </tr>
                      </tbody>
                    </table>
                  </div>
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
