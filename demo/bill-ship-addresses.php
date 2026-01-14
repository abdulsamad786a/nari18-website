<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
    {   
header('location:index.php');
}
else{
	// code for billing address updation
	if(isset($_POST['update']))
	{
		$baddress=$_POST['billingaddress'];
		$bstate=$_POST['bilingstate'];
		$bcity=$_POST['billingcity'];
		$bpincode=$_POST['billingpincode'];
		$query=mysqli_query($con,"update users set billingAddress='$baddress',billingState='$bstate',billingCity='$bcity',billingPincode='$bpincode' where id='".$_SESSION['id']."'");
		if($query)
		{
echo "<script>alert('Billing Address has been updated');</script>";
		}
	}


// code for Shipping address updation
	if(isset($_POST['shipupdate']))
	{
		$saddress=$_POST['shippingaddress'];
		$sstate=$_POST['shippingstate'];
		$scity=$_POST['shippingcity'];
		$spincode=$_POST['shippingpincode'];
		$query=mysqli_query($con,"update users set shippingAddress='$saddress',shippingState='$sstate',shippingCity='$scity',shippingPincode='$spincode' where id='".$_SESSION['id']."'");
		if($query)
		{
echo "<script>alert('Shipping Address has been updated');</script>";
		}
	}



?>
<?php include 'header.php'?>


            <!-- Body Container -->
            <div id="page-content"> 
                <!--Page Header-->
                <div class="page-header text-center">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 d-flex justify-content-between align-items-center">
                                <div class="page-title"><h1>My Account</h1></div>
                                <!--Breadcrumbs-->
                                <div class="breadcrumbs"><a href="index.html" title="Back to the home page">Home</a><span class="main-title fw-bold"><i class="icon anm anm-angle-right-l"></i>My Account</span></div>
                                <!--End Breadcrumbs-->
                            </div>
                        </div>
                    </div>
                </div>
                <!--End Page Header-->

                <!--Main Content-->
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-3 mb-4 mb-lg-0">
                            <!-- Dashboard sidebar -->
                            <div class="dashboard-sidebar bg-block">
                               
                                <div class="dashboard-tab">
                                    <ul class="nav nav-tabs flex-lg-column border-bottom-0" id="top-tab" role="tablist">
                                        <li class="nav-item"><a href="my-account.php" data-bs-toggle="tab" data-bs-target="#info" class="nav-link active">Account Info</a></li>
                                        <li class="nav-item"><a href="my-account.php" data-bs-toggle="tab" data-bs-target="#address" class="nav-link">Change Password</a></li>
                                        <li class="nav-item"><a href="bill-ship-addresses.php"  class="nav-link">Shipping / Billing Address</a></li>
                                        <li class="nav-item"><a href="order-history.php" class="nav-link">Order History</a></li>
                                        <li class="nav-item"><a href="track-orders.php" class="nav-link">Track Order</a></li>
                                        <li class="nav-item"><a href="pending-orders.php" data-bs-toggle="tab" data-bs-target="#payment" class="nav-link">Payment Pending Order</a></li>
                                       
                                        <li class="nav-item"><a href="logout.php" class="nav-link">Log Out</a> </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- End Dashboard sidebar -->
                        </div>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-9">
                            <div class="dashboard-content tab-content h-100" >
                                <!-- Account Info -->
                                <div class="tab-pane fade h-100 show active">
                                    <div class="account-info h-100">
                                        
                                        <div class="account-box">
                                            <h3 class="mb-3">Shipping / Billing Address</h3>
                                            <div class="row row-cols-lg-2 row-cols-md-2 row-cols-sm-1 row-cols-1">
                                                <div class="box-info mb-4">
                                                    <div class="box-title d-flex-center">
                                                        <h4>Billing Address</h4> 
                                                    </div>

                                            <?php
                                            $query=mysqli_query($con,"select * from users where id='".$_SESSION['id']."'");
                                            while($row=mysqli_fetch_array($query))
                                            {
                                            ?>   

                                     <form method="post" role="form" class="customer-form">	
                                       
                                       
                                        <div class="form-row">
                                            <div class="form-group col-12 mb-4">
                                                <label for="billingaddress" class="mt-2">Billing Address <span class="required">*</span></label>
                                                <input type="text" name="billingaddress" placeholder="Billing Address" id="billingaddress" value="<?php echo $row['billingAddress'];?>" required />
                                            </div>
                                            <div class="form-group col-12 mb-4">
                                                <label for="bilingstate" class="">Billing State <span class="required">*</span></label>
                                                <input type="text" name="bilingstate" placeholder="Billing State" id="bilingstate" value="<?php echo $row['billingState'];?>" required />
                                            </div>
                                            <div class="form-group col-12 mb-4">
                                                <label for="billingcity" class="">Billing City <span class="required">*</span></label>
                                                <input type="text" name="billingcity" placeholder="Billing City" id="billingcity" value="<?php echo $row['billingCity'];?>"  required />
                                            </div>
                                            <div class="form-group col-12 mb-4">
                                                <label for="billingpincode" class="">Billing Pincode <span class="required">*</span></label>
                                                <input type="text" name="billingpincode" placeholder="Billing Pincode" id="billingpincode" value="<?php echo $row['billingPincode'];?>"  required />
                                            </div>
                                           
                                            <div class="form-group col-12 mb-0">
                                                <div class="login-remember-forgot d-flex justify-content-between align-items-center">
                                                    <input type="submit" name="update" class="btn btn-primary btn-lg" value="Update Billing Address" />
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <?php } ?>
                                                </div>

                                                <div class="box-info mb-4">
                                                    <div class="box-title d-flex-center">
                                                        <h4>Shipping Address</h4> 
                                                    </div>

                                        <?php
                                        $query=mysqli_query($con,"select * from users where id='".$_SESSION['id']."'");
                                        while($row=mysqli_fetch_array($query))
                                        {
                                        ?> 

                                    <form method="post" role="form" class="customer-form">
                                       <div class="form-row">
                                           <div class="form-group col-12 mb-4">
                                               <label for="shippingaddress" class="mt-2">Shipping Address <span class="required">*</span></label>
                                               <input type="text" name="shippingaddress" placeholder="Shipping Address" id="shippingaddress" value="<?php echo $row['shippingAddress'];?>" required />
                                           </div>
                                           <div class="form-group col-12 mb-4">
                                               <label for="shippingstate" class="">Shipping State <span class="required">*</span></label>
                                               <input type="text" name="shippingstate" placeholder="Shipping State" id="shippingstate" value="<?php echo $row['shippingState'];?>" required />
                                           </div>
                                           <div class="form-group col-12 mb-4">
                                               <label for="shippingcity" class="">Shipping City <span class="required">*</span></label>
                                               <input type="text" name="shippingcity" placeholder="Billing City" id="shippingcity" value="<?php echo $row['shippingCity'];?>"  required />
                                           </div>
                                           <div class="form-group col-12 mb-4">
                                               <label for="shippingpincode" class="">Shipping Pincode <span class="required">*</span></label>
                                               <input type="text" name="shippingpincode" placeholder="Billing Pincode" id="shippingpincode" value="<?php echo $row['shippingPincode'];?>"  required />
                                           </div>
                                          
                                           <div class="form-group col-12 mb-0">
                                               <div class="login-remember-forgot d-flex justify-content-between align-items-center">
                                                   <input type="submit" name="shipupdate" class="btn btn-primary btn-lg" value="Update Shipping Address" />
                                               </div>
                                           </div>
                                       </div>
                                   </form>
                                    <?php } ?>
                                                </div>
                                               
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!-- End Account Info -->



                            </div>
                        </div>
                    </div>
                </div>
                <!--End Main Content-->
            </div>
            <!-- End Body Container -->

  <?php include 'footer.php'?>
  <?php } ?>