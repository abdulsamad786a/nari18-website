<?php
session_start();
error_reporting(0);
include('includes/config.php');

// Code for User login
if(isset($_POST['submit']))
{
$name=$_POST['fullname'];
$email=$_POST['emailid'];
$contactno=$_POST['contactno'];
$password=md5($_POST['password']);
$query=mysqli_query($con,"insert into users(name,email,contactno,password) values('$name','$email','$contactno','$password')");
if($query)
{
	echo "<script>alert('You are successfully register');</script>";
}
else{
echo "<script>alert('Not register something went worng');</script>";
}
}

?>

<?php include('header.php'); ?> 

<script type="text/javascript">
function valid()
{
 if(document.register.password.value!= document.register.confirmpassword.value)
{
alert("Password and Confirm Password Field do not match  !!");
document.register.confirmpassword.focus();
return false;
}
return true;
}
</script>
    	<script>
function userAvailability() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_availability.php",
data:'email='+$("#email").val(),
type: "POST",
success:function(data){
$("#user-availability-status1").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}
</script>

            <!-- Body Container -->
            <div id="page-content">
                <!--Page Header-->
                <div class="page-header text-center">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 d-flex justify-content-between align-items-center">
                                <div class="page-title"><h1>Create an Account</h1></div>
                                <!--Breadcrumbs-->
                                <div class="breadcrumbs"><a href="index.php" title="Back to the home page">Home</a> <span class="main-title fw-bold"><i class="icon anm anm-angle-right-l"></i>Create an Account</span></div>
                                <!--End Breadcrumbs-->
                            </div>
                        </div>
                    </div>
                </div>
                <!--End Page Header-->

                <!--Main Content-->
                <div class="container">   
                    <div class="login-register pt-2">
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-8 offset-md-2 col-lg-6 offset-lg-3">
                                <div class="inner h-100">
                                <form class="customer-form " role="form" method="post" name="register" onSubmit="return valid();">	
                                        <h2 class="text-center fs-4 mb-4">Register here if you are a new customer</h2>
                                        <div class="form-row">
                                            <div class="form-group col-12">
                                                <label for="CustomerUsername" class="d-none">Full Name <span class="required">*</span></label>
                                                <input type="text" name="fullname" placeholder="Full Name" id="CustomerUsername" value="" required />
                                            </div>
                                            <div class="form-group col-12">
                                                <label for="email" class="d-none">Email <span class="required">*</span></label>
                                                <input type="email" name="emailid" placeholder="Email" onBlur="userAvailability()" id="email" value="" required />
                                                <span id="user-availability-status1" style="font-size:12px;"></span>
                                            </div>
                                            <div class="form-group col-12">
                                                <label for="contactno" class="d-none">Contact No. <span class="required">*</span></label>
                                                <input type="text" name="contactno" placeholder="Contact No." id="contactno" value="" required />
                                            </div>
                                            <div class="form-group col-12">
                                                <label for="CustomerPassword" class="d-none">Password <span class="required">*</span></label>
                                                <input type="password" name="password" placeholder="Password" id="CustomerPassword" value="" required />                        	
                                            </div>
                                            <div class="form-group col-12">
                                                <label for="confirmpassword" class="d-none">Confirm Password <span class="required">*</span></label>
                                                <input id="confirmpassword" type="Password" name="confirmpassword" placeholder="Confirm Password" required />                         	
                                            </div>
                                            
                                            <div class="form-group col-12 mb-0">
                                                <input type="submit" class="btn btn-primary btn-lg w-100 " name="submit" id="submit" value="Register" />
                                            </div>
                                        </div>

                                        <div class="login-divide"><span class="login-divide-text">OR</span></div>

                                        <div class="login-signup-text mt-4 mb-2 fs-6 text-center text-muted">Already have an account? <a href="login.php" class="btn-link">Login now</a></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--End Main Content-->
            </div>
            <!-- End Body Container -->

            <?php include 'footer.php'?>