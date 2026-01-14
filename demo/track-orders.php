<?php
session_start();
error_reporting(0);
include('includes/config.php');
?>
<?php include 'header.php'?>

            <!-- Body Container -->
            <div id="page-content">
                <!--Page Header-->
                <div class="page-header text-center">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 d-flex justify-content-between align-items-center">
                                <div class="page-title"><h1>Track Orders</h1></div>
                                <!--Breadcrumbs-->
                                <div class="breadcrumbs"><a href="index.html" title="Back to the home page">Home</a><span class="main-title"><i class="icon anm anm-angle-right-l"></i>Track Orders</span></div>
                                <!--End Breadcrumbs-->
                            </div>
                        </div>
                    </div>
                </div>
                <!--End Page Header-->

                <!--Main Content-->
                <div class="container">     
                     <!-- Orders tracking -->
                     <div class="tab-pane h-100" >
                                    <div class="orders-card mt-0 h-100">    
                                        <div class="top-sec d-flex-justify-center justify-content-between mb-4">
                                            <h2 class="mb-0">Orders tracking</h2>
                                        </div>

                                        <form class="orderstracking-from" method="post" action="order-details.php">
                                            <p class="mb-3">To track your order please enter your OrderID in the box below and press "Track" button. </p>
                                            <div class="row align-items-center">
                                                <div class="form-group col-md-5 col-lg-5">
                                                    <label for="orderid" >Order ID <span class="required-f">*</span></label>
                                                    <input name="orderid" placeholder="Order ID" value="" id="orderid" type="text" required>
                                                </div>
                                                <div class="form-group col-md-5 col-lg-5">
                                                    <label for="email" >Billing email <span class="required-f">*</span></label>
                                                    <input name="email" placeholder="Billing email" value="" id="email" type="text" required>
                                                </div>
                                                <div class="form-group col-md-2 col-lg-2 mt-4">
                                                    <button type="submit" name="submit" class="btn rounded w-100"><span>Track</span></button>
                                                </div>
                                            </div>
                                        </form>
                                       
                                    </div>
                                </div>
                                <!-- End Orders tracking -->
                   
                </div>
                <!--End Main Content-->
            </div>
            <!-- End Body Container -->

<?php include 'footer.php';?>
