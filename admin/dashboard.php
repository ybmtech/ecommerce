<?php
require_once __DIR__."/inc/session.php";
$no_customer=$dbquery->row_count_one_parameter('users','role','2');
$today=date("m/d/Y");
$today_order_date=date("d-m-Y");
$today_order=$dbquery->row_count_one_parameter_like('orders','create_at',$today_order_date);
$today_product=$dbquery->row_count_without_parameter('products');
$today_category=$dbquery->row_count_without_parameter('product_categories');
?>
<!doctype html>
<html lang="en">
<head>
 <?php require_once __DIR__."/inc/dashboard/head.php";?>
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
            <div class="dashboard-ecommerce">
                <div class="container-fluid dashboard-content ">
                    <!-- ============================================================== -->
                    <!-- pageheader  -->
                    <!-- ============================================================== -->
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="page-header">
                                 <div class="page-breadcrumb">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="./" class="breadcrumb-link">Home</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ============================================================== -->
                    <!-- end pageheader  -->
                    <!-- ============================================================== -->
                    <div class="ecommerce-widget">

                        <div class="row">
                            <!-- ============================================================== -->
                            <!-- sales  -->
                            <!-- ============================================================== -->
                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="card border-3 border-top border-top-primary">
                                <a href="user">  <div class="card-body">
                                        <h5 class="text-muted">Customers</h5>
                                        <div class="metric-value d-inline-block">
                                            <h1 class="mb-1"><?=$no_customer;?></h1>
                                        </div>
                                        
                                    </div></a>
                                </div>
                            </div>
                            <!-- ============================================================== -->
                            <!-- end sales  -->
                            <!-- ============================================================== -->
                            <!-- ============================================================== -->
                            <!-- new customer  -->
                            <!-- ============================================================== -->
                            
                            <!-- ============================================================== -->
                            <!-- end new customer  -->
                            <!-- ============================================================== -->
                            <!-- ============================================================== -->
                            <!-- visitor  -->
                            <!-- ============================================================== -->
                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="card border-3 border-top border-top-primary">
                                <a href="#"> <div class="card-body">
                                        <h5 class="text-muted">Products</h5>
                                        <div class="metric-value d-inline-block">
                                            <h1 class="mb-1"><?=$today_product?></h1>
                                        </div>
                                       
                                    </div></a>
                                </div>
                            </div>

                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="card border-3 border-top border-top-primary">
                                <a href="#"> <div class="card-body">
                                        <h5 class="text-muted">Product Categorys</h5>
                                        <div class="metric-value d-inline-block">
                                            <h1 class="mb-1"><?=$today_category?></h1>
                                        </div>
                                       
                                    </div></a>
                                </div>
                            </div>
                            <!-- ============================================================== -->
                            <!-- end visitor  -->
                            <!-- ============================================================== -->
                            <!-- ============================================================== -->
                            <!-- total orders  -->
                            <!-- ============================================================== -->
                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="card border-3 border-top border-top-primary">
                                <a href="orders">  <div class="card-body">
                                        <h5 class="text-muted">Total Orders</h5>
                                        <div class="metric-value d-inline-block">
                                            <h1 class="mb-1"><?=$today_order;?></h1>
                                        </div>
                                        
                                    </div></a>
                                </div>
                            </div>
                            <!-- ============================================================== -->
                            <!-- end total orders  -->
                            <!-- ============================================================== -->
                        </div>
                        <div class="row">
        <!-- recent orders  -->
                            <!-- ============================================================== -->
                            <div class="col-xl-12 col-lg-12 col-md-6 col-sm-12 col-12">
                                <div class="card">
                                    <h5 class="card-header">Recent Orders</h5>
                                    <div class="card-body p-0">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead class="bg-light">
                                                <tr>
                                                <th>Order Id</th>
                                                <th>Name</th>
                                                <th>No. of Products</th>
                                                <th>Coupon</th>
                                                <th>Coupon Discount</th>
                                                <th>Delivery Fee</th>
                                                <th>Total</th>
                                                <th>Payment Status</th>
                                                 <th>Date</th>
                                                
                                            </tr>
                                                </thead>
                                                <tbody>
                                            <?php
                                            $table1_data="`orders`.`id` AS oid,`orders`.`user_id` AS uid, `orders`.`coupon_code`,`orders`.`coupon_discount`,`orders`.`payment_status`,`orders`.`delivery_status`,`orders`.`delivery_fee`,
                                            `orders`.`total`,`orders`.`no_product`,`orders`.`create_at`,`orders`.`order_ref`,`orders`.`delivery_id`,`orders`.`address`,`users`.`name`,`users`.`email`";
                                            $rows=$dbquery->multiple_row_without_parameter_join('orders','users','user_id','unique_id',$table1_data,'orders.id','ASC');                                            
                                              if($rows!==false){
                                                foreach($rows as $row):
                                            ?>
                                            <tr>
                                                <td><a href="order_details?ref=<?=$row['order_ref'];?>&delivery=<?=$row['delivery_id'];?>&address=<?=$row['address'];?>" style="text-decoration:underline;"><?=$row['order_ref'];?></a></td>
                                                <td><?=ucwords($row['name']);?></td>
                                                <td><?=$row['no_product'];?></td>
                                                <td><?=$row['coupon_code'];?></td>
                                                <td><?=($row['coupon_discount']!=="")?number_format($row['coupon_discount'],2):"";?></td>
                                                <td><?=number_format($row['delivery_fee'],2);?></td>
                                                <td><?=number_format($row['total'],2);?></td>
                                                <td><?=($row['payment_status']=='1')?'Paid':'Not Paid';?></td>
                                                 <td><?=$row['create_at'];?></td>
                                                
                                            </tr>
                                            <?php endforeach; } ?>
                                        </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
        <!-- ============================================================== -->
        <!-- end wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- end main wrapper  -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <!-- jquery 3.3.1 -->
    <?php require_once __DIR__."/inc/dashboard/script.php";?>
</body>
 
</html>