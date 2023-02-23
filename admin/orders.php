<?php
require_once __DIR__."/inc/session.php";
require_once __DIR__."/inc/token_generate.php";
?>
<!doctype html>
<html lang="en">
 
<head>
<?php require_once __DIR__."/inc/dashboard/head.php";?>
      <link rel="stylesheet" type="text/css" href="assets/vendor/datatables/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" type="text/css" href="assets/vendor/datatables/css/buttons.bootstrap4.css">
    <link rel="stylesheet" type="text/css" href="assets/vendor/datatables/css/select.bootstrap4.css">
    <link rel="stylesheet" type="text/css" href="assets/vendor/datatables/css/fixedHeader.bootstrap4.css">
</head>

<body>
    <!-- ============================================================== -->
    <!-- main wrapper -->
    <!-- ============================================================== -->
    <div class="dashboard-main-wrapper">
         <!-- ============================================================== -->
        <!-- navbar -->
        <!-- ============================================================== -->
        <?php require_once __DIR__."/inc/dashboard/topnav.php";?>
        <!-- ============================================================== -->
        <!-- end navbar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- left sidebar -->
        <!-- ============================================================== -->
        <?php require_once __DIR__."/inc/dashboard/sidebar.php";?>
      
        <!-- ============================================================== -->
        <!-- end left sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- wrapper  -->
        <!-- ============================================================== -->
        <div class="dashboard-wrapper">
            <div class="container-fluid  dashboard-content">
                <!-- ============================================================== -->
                <!-- pageheader -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="page-header">
                        <h2 class="pageheader-title">Orders</h2>
                             <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="dashboard" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Orders</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- end pageheader -->
                <!-- ============================================================== -->
                
                <div class="row">
                    <!-- ============================================================== -->
                    <!-- data table  -->
                    <!-- ============================================================== -->
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">Orders</h5>
                                   </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="table table-striped table-bordered second" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Order Id</th>
                                                <th>Name</th>
                                                <th>No. of Products</th>
                                                <th>Currency</th>
                                                <th>Coupon</th>
                                                <th>Coupon Discount</th>
                                                <th>Delivery Fee</th>
                                                <th>Total</th>
                                                <th>Payment Status</th>
                                                 <th>Date</th>
                                                 <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                             $currencies=$dbquery->multiple_row_without_parameter('currencies','name','ASC');
                                            $table1_data="`orders`.`id` AS oid,`orders`.`user_id` AS uid, `orders`.`coupon_code`,`orders`.`currency`,`orders`.`coupon_discount`,`orders`.`payment_status`,`orders`.`delivery_status`,`orders`.`delivery_fee`,
                                            `orders`.`total`,`orders`.`no_product`,`orders`.`create_at`,`orders`.`order_ref`,`orders`.`delivery_id`,`orders`.`address`,`users`.`name`,`users`.`email`";
                                            $rows=$dbquery->multiple_row_without_parameter_join('orders','users','user_id','unique_id',$table1_data,'orders.id','ASC');                                            
                                              if($rows!==false){
                                                foreach($rows as $row):
                                                  $order_currency_search=array_search($row['currency'],array_column($currencies,'name'));
                                                  $order_currency_id=$currencies[$order_currency_search]['unique_id'];
                                                 if($order_currency_id==$default_currency_symbol['unique_id']){
                                                   $order_currency=$default_currency_symbol['symbol'];
                                                   $delivery_fee=$order_currency.number_format($row['delivery_fee'],2);
                                                   $total=$order_currency.number_format($row['total'],2);
                                                   if(empty($row['coupon_discount'])){
                                                    $coupon_discount=$order_currency.number_format(0,2);
                                                    }
                                                    else{
                                                      $coupon_discount=$order_currency.number_format($row['coupon_discount'],2);
                                                 
                                                    }
                                                 }
                                                 else{
                                                   $order_currency=$currencies[$order_currency_search]['symbol'];
                                                   $delivery_fee=$currencies[$order_currency_search]['rate'] * $row['delivery_fee'];
                                                   $delivery_fee=$order_currency.number_format($delivery_fee,2);
                                                   $total=$currencies[$order_currency_search]['rate'] * $row['total'];
                                                   $total=$order_currency.number_format($total,2);
                                                   if(empty($row['coupon_discount'])){
                                                    $coupon_discount=$order_currency.number_format(0,2);
                                                    }
                                                    else{
                                                      $coupon_discount=$currencies[$order_currency_search]['rate'] * $row['coupon_discount'];
                                                      $coupon_discount=$order_currency.number_format($coupon_discount,2);
                                                 
                                                    }
                                                 }
                                            ?>
                                            <tr>
                                                <td><a href="order_details?ref=<?=$row['order_ref'];?>" style="text-decoration:underline;"><?=$row['order_ref'];?></a></td>
                                                <td><?=ucwords($row['name']);?></td>
                                                <td><?=$row['no_product'];?></td>
                                                <td><?=$row['currency'];?></td>
                                                <td><?=$row['coupon_code'];?></td>
                                                <td><?=$coupon_discount;?></td>
                                                <td><?=$delivery_fee;?></td>
                                                <td><?=$total;?></td>
                                                <td><?=($row['payment_status']=='1')?'Paid':'Not Paid';?></td>
                                                <td><?=$row['create_at'];?></td>
                                                <td>
                                                  <?php
                                                  if($row['delivery_status']=='1'){ 
                                                   echo "Delivered";
                                                }
                                                  else{ ?>
 <button class="btn deliver"  type="button" id="<?=$row['order_ref'];?>" data-name="<?=$row['name'];?>" data-email="<?=$row['email'];?>" data-address="<?=$row['address'];?>"> Deliver</button>

                                                  <?php }
                                                  ?>
                                                 </td>
                                            </tr>
                                            <?php endforeach; } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ============================================================== -->
                    <!-- end data table  -->
                    <!-- ============================================================== -->
                  
                      
                 
                  <!--deliver-->
                  <div class="modal" tabindex="-1" role="dialog" id="modal">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Order Delivered</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <p>Are you sure this order has been delivered</p>
                    <form  id="deliver_form">
                        <input type="hidden" name="order_id" id="order_id" value="">
                         <input type="hidden" name="token" id="token" value="<?= $_SESSION['_token']; ?>">
                         <input type="hidden" name="email" id="email" value="">
                        <input type="hidden" name="name" id="name" value="">
                        <input type="hidden" name="address" id="address" value="">
                       
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn" id="deliver_btn">Yes</button>
                    </form>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
                    <!--end deliver-->
                </div>
              
            </div>
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <?php require_once __DIR__."/inc/dashboard/footer.php";?>
       
            <!-- ============================================================== -->
            <!-- end footer -->
            <!-- ============================================================== -->
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- end main wrapper -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <?php require_once __DIR__."/inc/dashboard/tablescript.php";?>
    <?php require_once __DIR__ . "/ajax/deliver-order.php"; ?>
    <script>
    $(document).ready(function() {
     
        $(".deliver").click(function() {
        $("#modal").modal('show');
        let order_id = $(this).attr('id');
        let email = $(this).data('email');
        let name = $(this).data('name');
        let address = $(this).data('address');
        $("#order_id").val(order_id);
        $("#email").val(email);
        $("#name").val(name);
        $("#address").val(address);
      });

    

    });
  </script>
</body>
 
</html>