<?php
session_start();
error_reporting(0);
include('includes/config.php');

// ✅ Agar user already login hai to homepage bhej do
if (strlen($_SESSION['login']) != 0) {
    header('location:index.php');
    exit();
}

// ✅ User Login Process
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']); // Encrypted password check

    $query = mysqli_query($con, "SELECT * FROM users WHERE email='$email' AND password='$password'");
    $num = mysqli_fetch_array($query);

    if ($num > 0) {
        // ✅ Successful login
        $_SESSION['login'] = $_POST['email'];
        $_SESSION['id'] = $num['id'];
        $_SESSION['username'] = $num['name'];
        $uip = $_SERVER['REMOTE_ADDR'];
        $status = 1;

        // Log user login attempt
        $log = mysqli_query($con, "INSERT INTO userlog(userEmail, userip, status) VALUES('".$_SESSION['login']."', '$uip', '$status')");

        // ✅ Show alert + redirect
        echo "<script>
            // alert('You have successfully logged in!');
            window.location.href = 'index.php';
        </script>";
        exit();
    } else {
        // ❌ Invalid login
        $email = $_POST['email'];
        $uip = $_SERVER['REMOTE_ADDR'];
        $status = 0;
        $log = mysqli_query($con, "INSERT INTO userlog(userEmail, userip, status) VALUES('$email', '$uip', '$status')");
        
        echo "<script>
            alert('Invalid Email ID or Password!');
            window.location.href = 'login.php';
        </script>";
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
                    <div class="breadcrumbs">
                        <a href="index.php" title="Back to the home page">Home</a>
                        <span class="main-title fw-bold"><i class="icon anm anm-angle-right-l"></i>Login</span>
                    </div>
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

                            <div class="form-row mt-3">
                                <div class="form-group col-12">
                                    <input type="email" name="email" placeholder="Email" id="CustomerEmail" required />
                                </div>
                                <div class="form-group col-12">
                                    <input type="password" name="password" placeholder="Password" id="CustomerPassword" required />                        	
                                </div>
                                <div class="form-group col-12">
                                    <div class="login-remember-forgot d-flex justify-content-between align-items-center">
                                        <div class="remember-check customCheckbox"></div>
                                        <a href="forgot-password.php">Forgot your password?</a>
                                    </div>
                                </div>
                                <div class="form-group col-12 mb-0">
                                    <input type="submit" class="btn btn-primary btn-lg w-100" name="login" value="Sign In" />
                                </div>
                            </div>

                            <div class="login-divide"><span class="login-divide-text">OR</span></div>

                            <div class="login-signup-text mt-4 mb-2 fs-6 text-center text-muted">
                                Don’t have an account? 
                                <a href="register.php" class="btn-link">Sign up now</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End Main Content-->
</div>
<!-- End Body Container -->

<?php include 'footer.php'; ?>
