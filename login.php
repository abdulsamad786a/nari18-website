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
                        <!-- Login Method Toggle -->
                        <div class="text-center mb-4">
                            <div class="btn-group" role="group" aria-label="Login method">
                                <button type="button" class="btn btn-outline-primary active" id="passwordLoginBtn" onclick="switchLoginMethod('password')">
                                    <i class="icon anm anm-lock-l"></i> Password Login
                                </button>
                                <button type="button" class="btn btn-outline-primary" id="otpLoginBtn" onclick="switchLoginMethod('otp')">
                                    <i class="icon anm anm-phone-l"></i> OTP Login
                                </button>
                            </div>
                        </div>

                        <!-- Password Login Form -->
                        <form method="post" class="customer-form" id="passwordLoginForm">	
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
                        </form>

                        <!-- OTP Login Form -->
                        <form class="customer-form" id="otpLoginForm" style="display: none;">
                            <h2 class="text-center fs-4 mb-3">Login with OTP</h2>
                            <p class="text-center mb-4">Enter your registered phone number to receive OTP</p>

                            <!-- Phone Number Input Section -->
                            <div id="phoneSection">
                                <div class="form-row mt-3">
                                    <div class="form-group col-12">
                                        <input type="text" name="phone" id="phoneNumber" placeholder="Enter 10-digit phone number" maxlength="10" pattern="[0-9]{10}" required />
                                        <small class="form-text text-muted">Example: 8826446755</small>
                                    </div>
                                    <div class="form-group col-12 mb-0">
                                        <button type="button" class="btn btn-primary btn-lg w-100" id="sendOtpBtn" onclick="sendOTP()">
                                            <span id="sendOtpText">Send OTP</span>
                                            <span id="sendOtpLoader" style="display: none;">
                                                <i class="fa fa-spinner fa-spin"></i> Sending...
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- OTP Input Section (Hidden Initially) -->
                            <div id="otpSection" style="display: none;">
                                <div class="form-row mt-3">
                                    <div class="form-group col-12">
                                        <input type="text" name="otp" id="otpInput" placeholder="Enter 6-digit OTP" maxlength="6" pattern="[0-9]{6}" required />
                                        <small class="form-text text-muted">OTP sent to <span id="phoneDisplay"></span></small>
                                    </div>
                                    <div class="form-group col-12">
                                        <button type="button" class="btn btn-primary btn-lg w-100" id="verifyOtpBtn" onclick="verifyOTP()">
                                            <span id="verifyOtpText">Verify OTP & Login</span>
                                            <span id="verifyOtpLoader" style="display: none;">
                                                <i class="fa fa-spinner fa-spin"></i> Verifying...
                                            </span>
                                        </button>
                                    </div>
                                    <div class="form-group col-12 text-center">
                                        <button type="button" class="btn btn-link" id="resendOtpBtn" onclick="resendOTP()" style="display: none;">
                                            Resend OTP
                                        </button>
                                        <div id="resendTimer" style="display: none;">
                                            <small class="text-muted">Resend OTP in <span id="countdown">60</span> seconds</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Error/Success Messages -->
                            <div id="otpMessage" class="mt-3" style="display: none;"></div>
                        </form>

                        <div class="login-divide"><span class="login-divide-text">OR</span></div>

                        <div class="login-signup-text mt-4 mb-2 fs-6 text-center text-muted">
                            Don't have an account? 
                            <a href="register.php" class="btn-link">Sign up now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End Main Content-->
</div>
<!-- End Body Container -->

<?php include 'footer.php'; ?>

<style>
    .btn-group .btn {
        border-radius: 0;
    }
    .btn-group .btn:first-child {
        border-top-left-radius: 4px;
        border-bottom-left-radius: 4px;
    }
    .btn-group .btn:last-child {
        border-top-right-radius: 4px;
        border-bottom-right-radius: 4px;
    }
    .btn-group .btn.active {
        background-color: #8b7355;
        border-color: #8b7355;
        color: #fff;
    }
    #otpMessage {
        padding: 10px;
        border-radius: 4px;
    }
    #otpMessage.success {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }
    #otpMessage.error {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }
</style>

<script>
    let resendTimerInterval = null;
    let countdownSeconds = 60;

    // Switch between Password and OTP login
    function switchLoginMethod(method) {
        if (method === 'password') {
            document.getElementById('passwordLoginForm').style.display = 'block';
            document.getElementById('otpLoginForm').style.display = 'none';
            document.getElementById('passwordLoginBtn').classList.add('active');
            document.getElementById('otpLoginBtn').classList.remove('active');
            resetOTPForm();
        } else {
            document.getElementById('passwordLoginForm').style.display = 'none';
            document.getElementById('otpLoginForm').style.display = 'block';
            document.getElementById('passwordLoginBtn').classList.remove('active');
            document.getElementById('otpLoginBtn').classList.add('active');
        }
    }

    // Reset OTP form
    function resetOTPForm() {
        document.getElementById('phoneSection').style.display = 'block';
        document.getElementById('otpSection').style.display = 'none';
        document.getElementById('phoneNumber').value = '';
        document.getElementById('otpInput').value = '';
        document.getElementById('otpMessage').style.display = 'none';
        document.getElementById('resendOtpBtn').style.display = 'none';
        document.getElementById('resendTimer').style.display = 'none';
        clearInterval(resendTimerInterval);
        countdownSeconds = 60;
    }

    // Send OTP
    function sendOTP() {
        const phone = document.getElementById('phoneNumber').value.trim();
        
        // Validate phone number
        if (!phone || phone.length !== 10 || !/^[0-9]{10}$/.test(phone)) {
            showMessage('Please enter a valid 10-digit phone number', 'error');
            return;
        }

        // Disable button and show loader
        const sendBtn = document.getElementById('sendOtpBtn');
        const sendText = document.getElementById('sendOtpText');
        const sendLoader = document.getElementById('sendOtpLoader');
        sendBtn.disabled = true;
        sendText.style.display = 'none';
        sendLoader.style.display = 'inline';

        // Hide previous messages
        document.getElementById('otpMessage').style.display = 'none';

        // Make AJAX call
        const formData = new FormData();
        formData.append('phone', phone);

        fetch('send-otp.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            // Check if response is OK
            if (!response.ok) {
                throw new Error('Network response was not ok: ' + response.status);
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                // Show OTP input section
                document.getElementById('phoneSection').style.display = 'none';
                document.getElementById('otpSection').style.display = 'block';
                document.getElementById('phoneDisplay').textContent = phone;
                showMessage(data.message, 'success');
                
                // Start resend timer
                startResendTimer();
            } else {
                showMessage(data.message, 'error');
                sendBtn.disabled = false;
                sendText.style.display = 'inline';
                sendLoader.style.display = 'none';
            }
        })
        .catch(error => {
            console.error('Error sending OTP:', error);
            showMessage('An error occurred: ' + error.message + '. Please check browser console for details.', 'error');
            sendBtn.disabled = false;
            sendText.style.display = 'inline';
            sendLoader.style.display = 'none';
        });
    }

    // Verify OTP
    function verifyOTP() {
        const otp = document.getElementById('otpInput').value.trim();
        
        // Validate OTP
        if (!otp || otp.length !== 6 || !/^[0-9]{6}$/.test(otp)) {
            showMessage('Please enter a valid 6-digit OTP', 'error');
            return;
        }

        // Disable button and show loader
        const verifyBtn = document.getElementById('verifyOtpBtn');
        const verifyText = document.getElementById('verifyOtpText');
        const verifyLoader = document.getElementById('verifyOtpLoader');
        verifyBtn.disabled = true;
        verifyText.style.display = 'none';
        verifyLoader.style.display = 'inline';

        // Make AJAX call
        const formData = new FormData();
        formData.append('otp', otp);

        fetch('verify-otp.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showMessage(data.message, 'success');
                // Redirect to homepage after 1 second
                setTimeout(() => {
                    window.location.href = data.redirect || 'index.php';
                }, 1000);
            } else {
                showMessage(data.message, 'error');
                verifyBtn.disabled = false;
                verifyText.style.display = 'inline';
                verifyLoader.style.display = 'none';
            }
        })
        .catch(error => {
            showMessage('An error occurred. Please try again.', 'error');
            verifyBtn.disabled = false;
            verifyText.style.display = 'inline';
            verifyLoader.style.display = 'none';
        });
    }

    // Resend OTP
    function resendOTP() {
        clearInterval(resendTimerInterval);
        document.getElementById('resendOtpBtn').style.display = 'none';
        document.getElementById('resendTimer').style.display = 'none';
        
        // Show phone section again
        document.getElementById('phoneSection').style.display = 'block';
        document.getElementById('otpSection').style.display = 'none';
        document.getElementById('otpInput').value = '';
        
        // Automatically send OTP again
        sendOTP();
    }

    // Start resend timer
    function startResendTimer() {
        countdownSeconds = 60;
        document.getElementById('resendTimer').style.display = 'block';
        document.getElementById('resendOtpBtn').style.display = 'none';
        
        resendTimerInterval = setInterval(() => {
            countdownSeconds--;
            document.getElementById('countdown').textContent = countdownSeconds;
            
            if (countdownSeconds <= 0) {
                clearInterval(resendTimerInterval);
                document.getElementById('resendTimer').style.display = 'none';
                document.getElementById('resendOtpBtn').style.display = 'inline';
            }
        }, 1000);
    }

    // Show message
    function showMessage(message, type) {
        const messageDiv = document.getElementById('otpMessage');
        messageDiv.textContent = message;
        messageDiv.className = type;
        messageDiv.style.display = 'block';
    }

    // Allow Enter key to submit
    document.getElementById('phoneNumber').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            sendOTP();
        }
    });

    document.getElementById('otpInput').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            verifyOTP();
        }
    });

    // Only allow numbers in phone and OTP fields
    document.getElementById('phoneNumber').addEventListener('input', function(e) {
        this.value = this.value.replace(/[^0-9]/g, '');
    });

    document.getElementById('otpInput').addEventListener('input', function(e) {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
</script>
