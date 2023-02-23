<?php
require_once __DIR__."/inc/session.php";
require_once __DIR__."/inc/token_generate.php";
    if( empty($_GET['ref']) ){
      header("Location:orders");
      }
      $order=$dbquery->row_with_one_parameter('orders','order_ref',$_GET['ref']);
      $delivery_point=$dbquery->row_with_one_parameter('delivery_locations','unique_id',$order['delivery_id']);
      $currencies=$dbquery->multiple_row_without_parameter('currencies','name','ASC');
      $order_currency_search=array_search($order['currency'],array_column($currencies,'name'));
      $order_currency_id=$currencies[$order_currency_search]['unique_id'];
    
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
                        <h2 class="pageheader-title">#<?=$_GET['ref']?></h2>
                             <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="dashboard" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="orders" class="breadcrumb-link">Orders</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Order Details</li>
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
                                <h5 class="mb-0">Delivery City: <?=ucwords($delivery_point['name']);?></h5>
                                <h5 class="mb-0">Delivery Address: <?=ucwords($order['address']);?></h5>
                                   </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="table table-striped table-bordered second" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Quantity</th>
                                                <th>Price</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                           $table1_data="`order_details`.`id` AS oid,`order_details`.`product_id` AS pid, `order_details`.`quantity`,`order_details`.`price`,`order_details`.`order_ref`,`products`.`name`";
                                            $rows=$dbquery->multiple_row_with_one_parameter_join('order_details','products','product_id','unique_id',$table1_data,'`order_details`.`order_ref`',$_GET['ref'],'order_details.id','ASC');                                            
                                          if($rows!==false){
                                                foreach($rows as $row):
                                                  if($order_currency_id==$default_currency_symbol['unique_id']){
                                                    $order_currency=$default_currency_symbol['symbol'];
                                                     $price=$order_currency.number_format($row['price'],2);
                                                    $total_price=$row['price'] * $row['quantity'];
                                                    $total_price=$order_currency.number_format($total_price,2);
                                             
                                                  }
                                                  else{
                                                    $order_currency=$currencies[$order_currency_search]['symbol'];
                                                      $price=$currencies[$order_currency_search]['rate'] * $row['price'];
                                                     $price=$order_currency.number_format($price,2);
                                                     $total_price=$currencies[$order_currency_search]['rate'] * $row['price'] * $row['quantity'];
                                                     $total_price=$order_currency.number_format($total_price,2);
                                                    
                                                  }
                                            ?>
                                            <tr>
                                                <td><?=ucwords($row['name']);?></td>
                                                <td><?=$row['quantity'];?></td>
                                                <td><?=$price;?></td>
                                                <td><?=$total_price;?></td>
                                                </tr>
                                            <?php endforeach; } ?>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ============================================================== -->
                    <!-- end data table  -->
                    <!-- ============================================================== -->
                  
                      
                    <!--Enable country-->
                    <div class="modal" tabindex="-1" role="dialog" id="modal">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Enable Country</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <p>Are you sure you want to enable this country</p>
                    <form  id="enable_status_form">
                        <input type="hidden" name="unique_id" id="unique_id" value="">
                        <input type="hidden" name="tbl" id="tbl" value="countries">
                        <input type="hidden" name="link" id="link" value="countries">
                        <input type="hidden" name="status" id="status" value="enable">
                        <input type="hidden" name="token" id="token" value="<?= $_SESSION['_token']; ?>">
                       
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn" id="enable_status_btn">Yes</button>
                    </form>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
                    <!--end Enable country-->

                      <!--Disable country-->
                      <div class="modal" tabindex="-1" role="dialog" id="modal2">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Disable Country</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <p>Are you sure you want to disable this country</p>
                    <form  id="disable_status_form">
                        <input type="hidden" name="unique_id" id="unique_id2" value="">
                        <input type="hidden" name="tbl" id="tbl" value="countries">
                        <input type="hidden" name="link" id="link" value="countries">
                        <input type="hidden" name="status" id="status" value="disable">
                        <input type="hidden" name="token" id="token" value="<?= $_SESSION['_token']; ?>">
                       
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn" id="disable_status_btn">Yes</button>
                    </form>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
                    <!--end disable country-->
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
    <?php require_once __DIR__ . "/ajax/status.php"; ?>
    <script>
    $(document).ready(function() {
     
        $(".enable-country").click(function() {
        $("#modal").modal('show');
        let unique_id = $(this).attr('id');
        $("#unique_id").val(unique_id);
      });

      $(".disable-country").click(function() {
        $("#modal2").modal('show');
        let unique_id = $(this).attr('id');
        $("#unique_id2").val(unique_id);
      });

    });
  </script>
</body>
 
</html>