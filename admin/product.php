<?php
require_once __DIR__."/inc/session.php";
require_once __DIR__."/inc/token_generate.php";
$categories=$dbquery->multiple_row_without_parameter('product_categories','name','ASC');
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
                        <h2 class="pageheader-title">Product</h2>
                             <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="dashboard" class="breadcrumb-link">Dashboard</a></li>
                                         <li class="breadcrumb-item active" aria-current="page">Product</li>
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
                                <h5 class="mb-0" style="float: right;"><button  class="btn  btn-sm add-product">Add Product</button></h5>
                                   </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="table table-striped table-bordered second" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Image</th>
                                                <th>Name</th>
                                                <th>Category</th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                                <th>Description</th>
                                                <th>Creation Date</th>
                                                 <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $rows=$dbquery->multiple_row_without_parameter('products','name','ASC');
                                            if($rows!==false){
                                                foreach($rows as $row):
                                                    $get_category=$dbquery->row_with_one_parameter('product_categories','id',$row['category_id']);
                                            ?>
                                            <tr>
                                                <td width="20%"><img src="<?=$row['image'];?>" width="30%"></td>
                                                <td><?=ucwords($row['name']);?></td>
                                                <td><?=ucwords($get_category['name']);?></td>
                                                <td><?=number_format($row['price'],2);?></td>
                                                <td><?=$row['quantity'];?></td>
                                                <td><button class="btn view-desc" data-description="<?=$row['description'];?>">View</button></td>
                                                <td><?=$row['create_at'];?></td>
                                                <td>
                                                <div class="btn-group" role="group">
                            <button id="btnGroupDrop1" type="button" class="btn btn-sm  dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              More
                            </button>
                            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                             <a class="dropdown-item edit-product" href="#" type="button" id="<?php echo $row['unique_id']; ?>"
                              data-name="<?=$row['name'];?>" data-category_id="<?=$row['category_id'];?>" data-category_name="<?=$get_category['name'];?>" data-price="<?=$row['price'];?>"
                              data-description="<?=$row['description'];?>"
                              > 
                              Edit</a>
                              <a class="dropdown-item delete-product" href="#" type="button" id="<?=$row['unique_id'];?>"> Delete</a>
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
                    <!--add product modal-->
                    <div class="modal" tabindex="-1" role="dialog" id="modal">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Add Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form id="add_product_form">
                      <div class="row justify-content-center">
                        <div class="col-md-10">
                          <label>Product Name</label>
                          <input type="text" name="name" id="name" class="form-control">
                        </div>
                        <div class="col-md-10">
                          <label>Category</label>
                          <select name="category" id="category" class="form-control">
                            <option selected disabled>select category</option>
                            <?php
                            if($categories!==false){
                                foreach($categories as $category){ ?>
                                <option value="<?=$category['id'];?>"><?=$category['name'];?></option>
                               <?php }
                            }
                            ?>
                          </select>
                        </div>
                        <div class="col-md-10">
                          <label>Price</label>
                          <input type="text" name="price" id="price" class="form-control">
                        </div>
                        <div class="col-md-10">
                          <label>Quantity</label>
                          <input type="number" min="1" value="1" name="quantity" id="quantity" class="form-control">
                        </div>
                        <div class="col-md-10">
                          <label>Description</label>
                          <textarea name="description" id="description" class="form-control"></textarea>
                        </div>
                        <div class="col-md-10">
                          <label>Image</label>
                          <input type="file" name="image" id="image" class="form-control">
                        </div>
                      </div>
                      <input type="hidden" name="token" id="token" value="<?= $_SESSION['_token']; ?>">
                      
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn" id="add_product_btn">Add</button>
                    </form>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
                    <!--end add product modal-->
                      <!--edit product modal-->
                      <div class="modal" tabindex="-1" role="dialog" id="modal2">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Edit Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form id="edit_product_form">
                    <div class="row justify-content-center">
                        <div class="col-md-10">
                          <label>Product Name</label>
                          <input type="text" name="name" id="name2" class="form-control">
                        </div>
                        <div class="col-md-10">
                          <label>Category</label>
                          <select name="category" id="category2" class="form-control">
                             <?php
                            if($categories!==false){
                                foreach($categories as $category){ ?>
                                <option value="<?=$category['id'];?>"><?=$category['name'];?></option>
                               <?php }
                            }
                            ?>
                          </select>
                        </div>
                        <div class="col-md-10">
                          <label>Price</label>
                          <input type="text" name="price" id="price2" class="form-control">
                        </div>
                        <div class="col-md-10">
                          <label>Quantity (This will added to previous quantity)</label>
                          <input type="number" min="0" value="0" name="quantity" id="quantity" class="form-control">
                        </div>
                        <div class="col-md-10">
                          <label>Description</label>
                          <textarea name="description" id="description2" class="form-control"></textarea>
                        </div>
                        <div class="col-md-10">
                          <label>Image</label>
                          <input type="file" name="image" id="image" class="form-control">
                        </div>
                      </div>
                      <input type="hidden" name="unique_id" id="unique_id" value="">
                      <input type="hidden" name="token" id="token" value="<?= $_SESSION['_token']; ?>">
                   
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn" id="edit_product_btn">Update</button>
                    </form>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
                    <!--end edit product modal-->
                    <!--delete product modal-->
                    <div class="modal" tabindex="-1" role="dialog" id="modal3">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Delete Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <p>Are you sure you want to delete this product?</p>
                    <form  id="delete_product_form">
                        <input type="hidden" name="unique_id" id="unique_id2" value="">
                        <input type="hidden" name="tbl" id="tbl" value="products">
                        <input type="hidden" name="token" id="token" value="<?= $_SESSION['_token']; ?>">
                       
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn" id="delete_product_btn">Yes</button>
                    </form>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
                    <!--end delete product modal-->
                       <!--view description modal-->
                       <div class="modal" tabindex="-1" role="dialog" id="modal4">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                       <div id="show_description"></div>     
                  </div>
                  <div class="modal-footer">
                   
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
                    <!--end view description modal-->
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
    <?php require_once __DIR__ . "/ajax/product.php"; ?>
    <script>
    $(document).ready(function() {
      $(".add-product").click(function() {
        $("#modal").modal('show');
      });
      $(".edit-product").click(function() {
        $("#modal2").modal('show');
        let unique_id = $(this).attr('id');
        let product_name = $(this).data('name');
        let category_name = $(this).data('category_name');
        let category_id = $(this).data('category_id');
        let price = $(this).data('price');
        let description = $(this).data('description');
        $("#unique_id").val(unique_id);
        $("#name2").val(product_name);
        $("#category2").append('<option value="'+category_id+'" selected>'+category_name+'</option>');
        $("#price2").val(price);
        $("#description2").val(description);
      });
      $(".delete-product").click(function() {
        $("#modal3").modal('show');
        let unique_id = $(this).attr('id');
        $("#unique_id2").val(unique_id);
      });
      $(".view-desc").click(function() {
        $("#modal4").modal('show');
        let description = $(this).data('description');
        $("#show_description").text(description);
      });
    });
  </script>
</body>
 
</html>