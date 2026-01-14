<?php
session_start();
error_reporting(0);
include('includes/config.php');

// Code for User login
if(isset($_POST['login']))
{
    $email=$_POST['email'];
    $password=md5($_POST['password']);
    $query=mysqli_query($con,"SELECT * FROM users WHERE email='$email' and password='$password'");
    $num=mysqli_fetch_array($query);
    if($num>0)
    {
    $extra="login.php";
    $_SESSION['login']=$_POST['email'];
    $_SESSION['id']=$num['id'];
    $_SESSION['username']=$num['name'];
    $uip=$_SERVER['REMOTE_ADDR'];
    $status=1;
    $log=mysqli_query($con,"insert into userlog(userEmail,userip,status) values('".$_SESSION['login']."','$uip','$status')");
    $host=$_SERVER['HTTP_HOST'];
    $uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
    header("location:http://$host$uri/$extra");
    $_SESSION['errmsg']="You Have Logged In, Now You Can Buy!!";
    exit();
    }
    else
    {
    $extra="login.php";
    $email=$_POST['email'];
    $uip=$_SERVER['REMOTE_ADDR'];
    $status=0;
    $log=mysqli_query($con,"insert into userlog(userEmail,userip,status) values('$email','$uip','$status')");
    $host  = $_SERVER['HTTP_HOST'];
    $uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
    header("location:http://$host$uri/$extra");
    $_SESSION['errmsg']="Invalid email id or Password";
    exit();
    }
}

?>
<?php include('header.php'); ?>

            <!-- Body Container -->
            <div id="page-content"> 
                <!--Page Header-->
                <div class="page-header text-center">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 d-flex justify-content-between align-items-center">
                                <div class="page-title"><h1>Login</h1></div>
                                <!--Breadcrumbs-->
                                <div class="breadcrumbs"><a href="index.php" title="Back to the home page">Home</a><span class="main-title fw-bold"><i class="icon anm anm-angle-right-l"></i>Login</span></div>
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
                                    <form method="post" class="customer-form">	
                                        <h2 class="text-center fs-4 mb-3">Registered Customers</h2>
                                        <p class="text-center mb-4">If you have an account with us, please log in.</p>
                                        <span style="color:red;" >
                                        <?php
                                            echo htmlentities($_SESSION['errmsg']);
                                            ?>
                                            <?php
                                            echo htmlentities($_SESSION['errmsg']="");
                                            ?>
                                        </span>
                                        <div class="form-row mt-3">
                                            <div class="form-group col-12">
                                                <label for="CustomerEmail" class="d-none">Email <span class="required">*</span></label>
                                                <input type="email" name="email" placeholder="Email" id="CustomerEmail" value="" required />
                                            </div>
                                            <div class="form-group col-12">
                                                <label for="CustomerPassword" class="d-none">Password <span class="required">*</span></label>
                                                <input type="password" name="password" placeholder="Password" id="CustomerPassword" value="" required />                        	
                                            </div>
                                            <div class="form-group col-12">
                                                <div class="login-remember-forgot d-flex justify-content-between align-items-center">
                                                    <div class="remember-check customCheckbox">
                                                        <!-- <input id="remember" name="remember" type="checkbox" value="remember" required />
                                                        <label for="remember"> Remember me</label> -->
                                                    </div>
                                                    <a href="forgot-password.php">Forgot your password?</a>
                                                </div>
                                            </div>
                                            <div class="form-group col-12 mb-0">
                                                <input type="submit" class="btn btn-primary btn-lg w-100" name="login" value="Sign In" />
                                            </div>
                                        </div>

                                        <div class="login-divide"><span class="login-divide-text">OR</span></div>

                                        <div class="login-signup-text mt-4 mb-2 fs-6 text-center text-muted">Don,t have an account? <a href="register.php" class="btn-link">Sign up now</a></div>
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