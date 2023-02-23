<?php
function getUri(){
        $uri= substr($_SERVER['REQUEST_URI'],7);
        $explode_uri=explode('?',$uri);
       return  $explode_uri[0];
         }
?>
<div class="nav-left-sidebar sidebar-light" style="overflow-y: scroll; height:90%!important;background-color: #000080;">
            <div class="menu-list">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="d-xl-none d-lg-none" href="#">Dashboard</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav flex-column">
                            <li class="nav-divider">
                            </li>
                            <li class="nav-item">
                     <a class="nav-link <?=(getUri()=="dashboard") ? "active" : "";?>" href="dashboard"><i class="fas fa-th-large"></i>Dashboard</a>
                             </li>
                        
                            <li class="nav-item">
                     <a class="nav-link <?=(getUri()=="product-category") ? "active" : "";?>" href="product-category"><i class="fas fa-columns"></i>Product Category</a>
                             </li>
                             
                             <li class="nav-item">
                     <a class="nav-link <?=(getUri()=="product") ? "active" : "";?>" href="product"><i class="fas fa-boxes"></i>Product</a>
                             </li>
                            
                             <li class="nav-item">
                     <a class="nav-link <?=(getUri()=="coupon") ? "active" : "";?>" href="coupon"><i class="fab fa-modx"></i>Coupon</a>
                             </li>
                           
                             <li class="nav-item">
                     <a class="nav-link <?=(getUri()=="user") ? "active" : "";?>" href="user"><i class="fas fa-user-plus"></i>User</a>
                             </li>
                           

                           

                             <li class="nav-item">
                     <a class="nav-link <?=(getUri()=="delivery-location") ? "active" : "";?>" href="delivery-location"><i class="fas fa-map"></i>Delivery Location</a>
                             </li>

                            <li class="nav-item">
                     <a class="nav-link <?=(getUri()=="orders") ? "active" : "";?>" href="orders"><i class="fas fa-dolly"></i>Orders</a>
                             </li>
                          
                             <li class="nav-item">
                     <a class="nav-link <?=(getUri()=="payment-history") ? "active" : "";?>" href="payment-history"><i class="fas fa-history"></i>Payments</a>
                             </li>
                             
                             
                             <li class="nav-item">
                     <a class="nav-link <?=(getUri()=="change-password") ? "active" : "";?>" href="change-password"><i class="fas fa-user-circle"></i>Change Password</a>
                             </li>
                            <li class="nav-item">
                     <a class="nav-link" href="logout"><i class="fas fa-power-off mr-2"></i>Logout</a>
                             </li>
                             
                        </ul>
                    </div>
                </nav>
            </div>
        </div>