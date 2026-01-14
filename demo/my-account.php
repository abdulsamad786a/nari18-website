<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
    {   
header('location:login.php');
}
else{
	if(isset($_POST['update']))
	{
		$name=$_POST['name'];
		$contactno=$_POST['contactno'];
		$query=mysqli_query($con,"update users set name='$name',contactno='$contactno' where id='".$_SESSION['id']."'");
		if($query)
		{
echo "<script>alert('Your info has been updated');</script>";
		}
	}


date_default_timezone_set('Asia/Kolkata');// change according timezone
$currentTime = date( 'd-m-Y h:i:s A', time () );


if(isset($_POST['submit']))
{
$sql=mysqli_query($con,"SELECT password FROM  users where password='".md5($_POST['cpass'])."' && id='".$_SESSION['id']."'");
$num=mysqli_fetch_array($sql);
if($num>0)
{
 $con=mysqli_query($con,"update students set password='".md5($_POST['newpass'])."', updationDate='$currentTime' where id='".$_SESSION['id']."'");
echo "<script>alert('Password Changed Successfully !!');</script>";
}
else
{
	echo "<script>alert('Current Password not match !!');</script>";
}
}

?>
<?php include 'header.php'?>

<script type="text/javascript">
function valid()
{
if(document.chngpwd.cpass.value=="")
{
alert("Current Password Filed is Empty !!");
document.chngpwd.cpass.focus();
return false;
}
else if(document.chngpwd.newpass.value=="")
{
alert("New Password Filed is Empty !!");
document.chngpwd.newpass.focus();
return false;
}
else if(document.chngpwd.cnfpass.value=="")
{
alert("Confirm Password Filed is Empty !!");
document.chngpwd.cnfpass.focus();
return false;
}
else if(document.chngpwd.newpass.value!= document.chngpwd.cnfpass.value)
{
alert("Password and Confirm Password Field do not match  !!");
document.chngpwd.cnfpass.focus();
return false;
}
return true;
}
</script>

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
                            <div class="dashboard-content tab-content h-100" id="top-tabContent">
                                <!-- Account Info -->
                                <div class="tab-pane fade h-100 show active" id="info">
                                    <div class="account-info h-100">
                                        <div class="welcome-msg mb-4">
                                            <?php 
                                             $query=mysqli_query($con,"select * from users where id='".$_SESSION['id']."'");
                                             $row=mysqli_fetch_array($query)
                                            ?>
                                            <h2>Hello, <span class="text-primary"><?php echo $row['name'];?></span></h2>
                                            <p>From your My Account Dashboard you have the ability to view a snapshot of your recent account activity and update your account information. Select a link below to view or edit information.</p>
                                        </div>


                                        <div class="account-box">
                                            <h3 class="mb-3">Account Information</h3>
                                            <div class="row row-cols-lg-1 row-cols-md-2 row-cols-sm-1 row-cols-1">
                                                <div class="box-info mb-4">
                                                    <div class="box-title d-flex-center">
                                                        <h4>profile info</h4> 
                                                    </div>

                                    <?php
                                    $query=mysqli_query($con,"select * from users where id='".$_SESSION['id']."'");
                                    while($row=mysqli_fetch_array($query))
                                    {
                                    ?>    

                                     <form method="post" role="form" class="customer-form">	
                                       
                                       
                                        <div class="form-row">
                                            <div class="form-group col-12 mb-4">
                                                <label for="name" class="mt-2">Name <span class="required">*</span></label>
                                                <input type="text" name="name" placeholder="Enter your Name" id="name" value="<?php echo $row['name'];?>" required />
                                            </div>
                                            <div class="form-group col-12 mb-4">
                                                <label for="email" class="">Email Id <span class="required">*</span></label>
                                                <input type="email" name="contact" placeholder="Email Id" id="email"  value="<?php echo $row['email'];?>" readonly required />
                                            </div>
                                            <div class="form-group col-12 mb-4">
                                                <label for="contactno" class="">Contact No. <span class="required">*</span></label>
                                                <input type="text" name="contactno" placeholder="Contact No." id="contactno" value="<?php echo $row['contactno'];?>"  maxlength="10" required />
                                            </div>
                                           
                                            <div class="form-group col-12 mb-0">
                                                <div class="login-remember-forgot d-flex justify-content-between align-items-center">
                                                    <input type="submit" name="update" class="btn btn-primary btn-lg" value="Update Info" />
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

                                <!-- Address Book -->
                                <div class="tab-pane fade h-100" id="address">
                                    <div class="address-card mt-0 h-100">                                   
                                        <div class="top-sec d-flex-justify-center justify-content-between mb-4">
                                        <div class="account-box">
                                            <h3 class="mb-3">Account Information</h3>
                                            <div class="row row-cols-lg-1 row-cols-md-2 row-cols-sm-1 row-cols-1">
                                                <div class="box-info mb-4">
                                                    <div class="box-title d-flex-center">
                                                        <h4>change password</h4> 
                                                    </div>

                                     <form method="post" role="form" name="chngpwd" onSubmit="return valid();" class="customer-form">	
                                       
                                       
                                        <div class="form-row">
                                            <div class="form-group col-12 mb-4">
                                                <label for="cpass" class="mt-2">Current Password <span class="required">*</span></label>
                                                <input type="password" name="cpass" placeholder="Current Password" id="cpass"  required />
                                            </div>
                                            <div class="form-group col-12 mb-4">
                                                <label for="newpass" class="">New Password <span class="required">*</span></label>
                                                <input type="password" name="newpass" placeholder="New Password" id="newpass"  required />
                                            </div>
                                            <div class="form-group col-12 mb-4">
                                                <label for="cnfpass" class="">Confirm Password <span class="required">*</span></label>
                                                <input type="password" name="cnfpass" placeholder="Confirm Password" id="cnfpass"  required />
                                            </div>
                                           
                                            <div class="form-group col-12 mb-0">
                                                <div class="login-remember-forgot d-flex justify-content-between align-items-center">
                                                    <input type="submit" name="submit" class="btn btn-primary btn-lg" value="Change Password" />
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                                </div>
                                               
                                            </div>
                                        </div>
                                            
                                        </div>

                                                                          
                                    </div>
                                </div>
                                <!-- End Address Book -->

                              
                            </div>
                        </div>
                    </div>
                </div>
                <!--End Main Content-->
            </div>
            <!-- End Body Container -->

  <?php include 'footer.php'?>
  <?php } ?>