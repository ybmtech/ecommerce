<?php
require_once __DIR__."/inc/session.php";
require_once __DIR__."/inc/token_generate.php";
$states=$dbquery->multiple_row_without_parameter('states','name','ASC');
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
                        <h2 class="pageheader-title">Delivery Location</h2>
                             <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="dashboard" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Delivery Location</li>
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
                                <h5 class="mb-0" style="float: right;"><button class="btn  btn-sm add-location">Add Location</button></h5>
                                   </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="table table-striped table-bordered second" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>State</th>
                                                <th>Location</th>
                                                <th>Price</th>
                                                  <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $rows=$dbquery->multiple_row_without_parameter('delivery_locations','name','ASC');
                                            if($rows!==false){
                                                foreach($rows as $row):
                                                      $get_state=$dbquery->row_with_one_parameter('states','id',$row['state_id']);
                                            ?>
                                            <tr>
                                                <td><?=ucwords($get_state['name']);?></td>
                                                <td><?=ucwords($row['name']);?></td>
                                                <td><?=number_format($row['price'],2);?></td>
                                                <td>
                                                <div class="btn-group" role="group">
                            <button id="btnGroupDrop1" type="button" class="btn btn-sm  dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              More
                            </button>
                            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                             <a class="dropdown-item edit-location" href="#" type="button" id="<?php echo $row['unique_id']; ?>" data-name="<?=$row['name'];?>" data-price="<?=$row['price'];?>"> Edit</a>
                              <a class="dropdown-item delete-location" href="#" type="button" id="<?=$row['unique_id'];?>"> Delete</a>
                            </div>
                          </div>
                                                 </td>
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
                    <!--add location modal-->
                    <div class="modal" tabindex="-1" role="dialog" id="modal">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Add Location</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form id="add_location_form">
                      <div class="row justify-content-center">
                     
                        <div class="col-md-10">
                          <label>State</label>
                          <select name="state" id="state" class="form-control">
                          <option value="" disabled selected>Select State</option>
                          <?php
                            foreach($states as $state){ ?>
                            <option value="<?=$state['id'];?>"><?=ucwords($state['name']);?></option>
                           <?php  }
                            ?>
                          </select>
                        </div>

                        <div class="col-md-10">
                          <label>Location Name</label>
                          <input type="text" name="name" id="name" class="form-control">
                        </div>

                        <div class="col-md-10">
                          <label>Price</label>
                          <input type="text" name="price" id="price" class="form-control">
                        </div>

                      </div>
                      <input type="hidden" name="token" id="token" value="<?= $_SESSION['_token']; ?>">
                      
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn" id="add_location_btn">Add</button>
                    </form>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
                    <!--end add location modal-->
                      <!--edit location modal-->
                      <div class="modal" tabindex="-1" role="dialog" id="modal2">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Edit Location</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form id="edit_location_form">
                      <div class="row justify-content-center">
                        <div class="col-md-10">
                          <label>Location Name</label>
                          <input type="text" name="name" id="name2" class="form-control">
                        </div>
                        <div class="col-md-10">
                          <label>Price</label>
                          <input type="text" name="price" id="price2" class="form-control">
                        </div>
                      </div>
                      <input type="hidden" name="unique_id" id="unique_id" value="">
                      <input type="hidden" name="token" id="token" value="<?= $_SESSION['_token']; ?>">
                   
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn" id="edit_location_btn">Update</button>
                    </form>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
                    <!--end edit location modal-->
                    <!--delete location modal-->
                    <div class="modal" tabindex="-1" role="dialog" id="modal3">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Delete Location</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <p>Are you sure you want to delete this location?</p>
                    <form  id="delete_location_form">
                        <input type="hidden" name="unique_id" id="unique_id2" value="">
                        <input type="hidden" name="tbl" id="tbl" value="delivery_locations">
                        <input type="hidden" name="token" id="token" value="<?= $_SESSION['_token']; ?>">
                       
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn" id="delete_location_btn">Yes</button>
                    </form>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
                    <!--end delete location modal-->
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
    <?php require_once __DIR__ . "/ajax/delivery-location.php"; ?>
    <script>
    $(document).ready(function() {
      
      $(".add-location").click(function() {
        $("#modal").modal('show');
      });
      $(".edit-location").click(function() {
        $("#modal2").modal('show');
        let unique_id = $(this).attr('id');
        let location_name = $(this).data('name');
        let price = $(this).data('price');
        $("#unique_id").val(unique_id);
        $("#name2").val(location_name);
        $("#price2").val(price);
      });
      $(".delete-location").click(function() {
        $("#modal3").modal('show');
        let unique_id = $(this).attr('id');
        $("#unique_id2").val(unique_id);
      });
         
 
    });
  </script>
</body>
 
</html>