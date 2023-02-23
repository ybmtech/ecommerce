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
                        <h2 class="pageheader-title">User</h2>
                             <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="dashboard" class="breadcrumb-link">Dashboard</a></li>
                                         <li class="breadcrumb-item active" aria-current="page">User</li>
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
                                <h5 class="mb-0" style="float: right;"><button class="btn  btn-sm add-user">Add User</button></h5>
                                   </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="table table-striped table-bordered second" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Image</th>
                                                <th>Name</th>
                                                <th>Phone</th>
                                                <th>Email</th>
                                                <th>Role</th>
                                                 <th>Creation Date</th>
                                                 <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $rows=$dbquery->multiple_row_without_parameter('users','name','ASC');
                                            if($rows!==false){
                                                foreach($rows as $row):
                                                    $image=($row['image']=="")?"../profiles_images/noimage.jpg":$row['image'];
                                            ?>
                                            <tr>
                                                <td width="20%"><img src="<?=$image;?>" width="30%"></td>
                                                <td><?=ucwords($row['name']);?></td>
                                                <td><?=$row['phone'];?></td>
                                                 <td><?=$row['email'];?></td>
                                                 <td><?=($row['role']=='1')?"Admin":"User";?></td>
                                                  <td><?=$row['create_at'];?></td>
                                                <td>
                                                <div class="btn-group" role="group">
                            <button id="btnGroupDrop1" type="button" class="btn btn-sm  dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              More
                            </button>
                            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                             <a class="dropdown-item edit-user" href="#" type="button" id="<?php echo $row['unique_id']; ?>"
                              data-name="<?=$row['name'];?>"  data-phone="<?=$row['phone'];?>"
                              data-email="<?=$row['email'];?>" data-role="<?=$row['role'];?>"
                              > 
                              Edit</a>
                             <?php
                             if($row['role']=='2'){
                              ?>
                              <a class="dropdown-item delete-user" href="#" type="button" id="<?=$row['unique_id'];?>"> Delete</a>
                           <?php  } ?> 
                             
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
                    <!--add user modal-->
                    <div class="modal" tabindex="-1" role="dialog" id="modal">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Add User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form id="add_user_form">
                      <div class="row justify-content-center">
                        <div class="col-md-10">
                          <label>Name</label>
                          <input type="text" name="name" id="name" class="form-control">
                        </div>
                        <div class="col-md-10">
                          <label>Phone</label>
                          <input type="text" name="phone" id="phone" class="form-control">
                        </div>
                        <div class="col-md-10">
                          <label>Email</label>
                          <input type="email" name="email" id="email" class="form-control">
                        </div>
                        <div class="col-md-10">
                          <label>Role</label>
                          <select name="role" id="role" class="form-control">
                            <option selected disabled>Select Role</option>
                            <option value="1">Admin</option>
                            <option value="2">User</option>
                          </select>
                        </div>
                        <div class="col-md-10">
                          <label>Image (Optional)</label>
                          <input type="file" name="image" id="image" class="form-control">
                        </div>
                      </div>
                      <input type="hidden" name="token" id="token" value="<?= $_SESSION['_token']; ?>">
                      
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn" id="add_user_btn">Add</button>
                    </form>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
                    <!--end add user modal-->
                      <!--edit user modal-->
                      <div class="modal" tabindex="-1" role="dialog" id="modal2">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Edit User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form id="edit_user_form">
                    <div class="row justify-content-center">
                        <div class="col-md-10">
                          <label>Name</label>
                          <input type="text" name="name" id="name2" class="form-control">
                        </div>
                        <div class="col-md-10">
                          <label>Phone</label>
                          <input type="text" name="phone" id="phone2" class="form-control">
                        </div>
                        <div class="col-md-10">
                          <label>Email</label>
                          <input type="email" name="email" id="email2" class="form-control">
                        </div>
                        <div class="col-md-10">
                          <label>Role</label>
                          <select name="role" id="role2" class="form-control">
                            <option selected disabled>Select Role</option>
                            <option value="1">Admin</option>
                            <option value="2">User</option>
                          </select>
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
                    <button type="submit" class="btn" id="edit_user_btn">Update</button>
                    </form>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
                    <!--end edit user modal-->
                    <!--delete user modal-->
                    <div class="modal" tabindex="-1" role="dialog" id="modal3">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Delete User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <p>Are you sure you want to delete this user?</p>
                    <form  id="delete_user_form">
                        <input type="hidden" name="unique_id" id="unique_id2" value="">
                        <input type="hidden" name="tbl" id="tbl" value="users">
                        <input type="hidden" name="token" id="token" value="<?= $_SESSION['_token']; ?>">
                       
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn" id="delete_user_btn">Yes</button>
                    </form>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
                    <!--end delete user modal-->
                      
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
    <?php require_once __DIR__ . "/ajax/user.php"; ?>
    <script>
    $(document).ready(function() {
      $(".add-user").click(function() {
        $("#modal").modal('show');
      });
      $(".edit-user").click(function() {
        $("#modal2").modal('show');
        let unique_id = $(this).attr('id');
        let name = $(this).data('name');
        let phone = $(this).data('phone');
        let email = $(this).data('email');
        let role = $(this).data('role');
        let role_name=(role=='1')?'Admin':'User';
         $("#unique_id").val(unique_id);
        $("#name2").val(name);
        $("#phone2").val(phone);
        $("#email2").val(email);
        $("#role2").append('<option value="'+role+'" selected>'+role_name+'</option>');
         });
      $(".delete-user").click(function() {
        $("#modal3").modal('show');
        let unique_id = $(this).attr('id');
        $("#unique_id2").val(unique_id);
      });
     
    });
  </script>
</body>
 
</html>