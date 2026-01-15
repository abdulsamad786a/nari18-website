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
<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Nari18 by Richa Singh | Luxury Boutique Login</title>
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400&family=Inter:wght@200;300;400;500&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        primary: "#720017", // Deep Maroon
                        gold: "#D4AF37",
                        "gold-light": "#F9F1D0",
                        luxury: {
                            red: "#8B0000",
                        }
                    },
                    fontFamily: {
                        display: ["'Cormorant Garamond'", "serif"],
                        sans: ["'Inter'", "sans-serif"],
                    },
                },
            },
        };
    </script>
    <style type="text/tailwindcss">
        @layer utilities {
            .glass-container {
                @apply bg-white/10 backdrop-blur-2xl border border-white/30;
                box-shadow: inset 0 0 20px rgba(255, 255, 255, 0.1), 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            }
            .gold-shine {
                background: linear-gradient(135deg, #720017 0%, #a80022 45%, #f9f1d0 50%, #a80022 55%, #720017 100%);
                background-size: 250% 250%;
                transition: background-position 0.5s ease;
            }
            .gold-shine:hover {
                background-position: 100% 100%;
            }
            .text-shadow-gold {
                text-shadow: 0 0 8px rgba(212, 175, 55, 0.4);
            }
            input::placeholder {
                color: rgba(255, 255, 255, 0.5) !important;
                font-family: 'Cormorant Garamond', serif;
                font-style: italic;
            }
            .tab-active {
                @apply text-white border-b-2 border-gold;
            }
            .tab-inactive {
                @apply text-white/50 border-b-2 border-transparent hover:text-white/80;
            }
            #mobile-login-form, #email-login-form {
                display: none;
            }
            #tab-email:checked ~ #email-login-form {
                display: block;
            }
            #tab-mobile:checked ~ #mobile-login-form {
                display: block;
            }
            #tab-email:checked ~ .tabs-nav label[for="tab-email"] {
                @apply text-white border-gold;
            }
            #tab-mobile:checked ~ .tabs-nav label[for="tab-mobile"] {
                @apply text-white border-gold;
            }
            .otp-message {
                padding: 12px;
                border-radius: 4px;
                margin-top: 16px;
                font-size: 12px;
            }
            .otp-message.success {
                background-color: rgba(16, 185, 129, 0.2);
                color: #10b981;
                border: 1px solid rgba(16, 185, 129, 0.3);
            }
            .otp-message.error {
                background-color: rgba(239, 68, 68, 0.2);
                color: #ef4444;
                border: 1px solid rgba(239, 68, 68, 0.3);
            }
        }
    </style>
</head>
<body class="min-h-screen relative font-sans antialiased text-white overflow-x-hidden">
    <div class="fixed inset-0 z-0">
        <img alt="Elegant model in red ethnic outfit" class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBD7IzdObiEjrTcD9ofPmQbnYf3xKcoMa677zq5CUf6pjar8BDQdMn0PfwMDK9fh2M7xFf-i_JzQBXxuh_bLYhGrxhmiUPxeY8PfjJ3Xco6RY0WKmhBWEoY_r3tti6B2WR6PWabq4PEtowDMFgdvpLlJBVC2NhF9JG3H5BmXJ7fxOxogiYYMYxys5f-DibRmcQoKxm1oAoth8atAPjhE3P9kw2uOmYP0FfPGE2bwCqtsRehMps0L1syjqgqSv1KeUg6x9iTSwbac3s"/>
        <div class="absolute inset-0 bg-gradient-to-tr from-black/80 via-black/40 to-luxury-red/30"></div>
    </div>
    <header class="relative z-10 w-full">
        <div class="max-w-7xl mx-auto px-6 lg:px-12 py-10 flex flex-col md:flex-row justify-between items-baseline gap-4">
            <div class="space-y-1">
                <h1 class="text-4xl md:text-5xl font-display font-light tracking-widest uppercase text-white">Login</h1>
                <p class="text-[10px] tracking-[0.4em] font-sans text-gold-light/80 uppercase">Nari18 by Richa Singh</p>
            </div>
            <nav class="flex items-center space-x-3 text-xs tracking-widest font-sans uppercase text-white/60">
                <a class="hover:text-gold transition-colors" href="index.php">Home</a>
                <span class="text-[10px] opacity-30 select-none">/</span>
                <span class="text-white font-medium">Login</span>
            </nav>
        </div>
    </header>
    <main class="relative z-10 flex flex-col items-center justify-center px-6 py-12 lg:py-20">
        <div class="w-full max-w-lg mx-auto">
            <div class="glass-container rounded-3xl p-8 md:p-12 space-y-8">
                <div class="text-center space-y-3">
                    <h2 class="text-3xl md:text-4xl font-display italic text-gold-light tracking-wide text-shadow-gold">Registered Customers</h2>
                    <p class="text-xs font-light text-white/70 tracking-widest uppercase">
                        If you have an account with us, please log in.
                    </p>
                </div>
                <div class="relative">
                    <input checked="" class="hidden" id="tab-email" name="login-type" type="radio"/>
                    <input class="hidden" id="tab-mobile" name="login-type" type="radio"/>
                    <div class="tabs-nav flex justify-center space-x-8 mb-10 border-b border-white/10">
                        <label class="tab-inactive pb-4 text-[10px] tracking-[0.3em] font-sans uppercase cursor-pointer transition-all duration-300" for="tab-email">Email Login</label>
                        <label class="tab-inactive pb-4 text-[10px] tracking-[0.3em] font-sans uppercase cursor-pointer transition-all duration-300" for="tab-mobile">Mobile Login</label>
                    </div>
                    
                    <!-- Email Login Form -->
                    <div id="email-login-form">
                        <form method="post" class="space-y-8" id="passwordLoginForm">
                            <div class="space-y-1 relative group">
                                <label class="text-[10px] uppercase tracking-widest text-gold/80 font-medium mb-1 block">Email Address</label>
                                <input class="w-full px-0 py-3 border-t-0 border-x-0 border-b border-white/20 bg-transparent focus:ring-0 focus:border-gold transition-colors text-lg font-display text-white" placeholder="e.g. elegance@nari18.com" required="" type="email" name="email" id="CustomerEmail"/>
                            </div>
                            <div class="space-y-1 relative group">
                                <div class="flex justify-between items-center mb-1">
                                    <label class="text-[10px] uppercase tracking-widest text-gold/80 font-medium block">Password</label>
                                    <a class="text-[10px] uppercase tracking-widest text-white/50 hover:text-gold transition-colors italic" href="forgot-password.php">
                                        Forgot?
                                    </a>
                                </div>
                                <input class="w-full px-0 py-3 border-t-0 border-x-0 border-b border-white/20 bg-transparent focus:ring-0 focus:border-gold transition-colors text-lg font-display text-white" placeholder="••••••••" required="" type="password" name="password" id="CustomerPassword"/>
                            </div>
                            <button class="w-full gold-shine text-white py-5 text-xs tracking-[0.4em] font-sans uppercase shadow-2xl transition-all duration-500 mt-6 border border-white/10" type="submit" name="login">
                                Sign In
                            </button>
                        </form>
                    </div>
                    
                    <!-- Mobile/OTP Login Form -->
                    <div id="mobile-login-form">
                        <form class="space-y-8" id="otpLoginForm">
                            <!-- Phone Number Input Section -->
                            <div id="phoneSection">
                                <div class="space-y-1 relative group">
                                    <label class="text-[10px] uppercase tracking-widest text-gold/80 font-medium mb-1 block">Mobile Number</label>
                                    <div class="flex items-center border-b border-white/20 focus-within:border-gold transition-colors">
                                        <span class="text-lg font-display text-white/60 pr-2 border-r border-white/10 mr-4">+91</span>
                                        <input class="w-full px-0 py-3 border-none bg-transparent focus:ring-0 text-lg font-display text-white" placeholder="98765 43210" required="" type="tel" id="phoneNumber" maxlength="10" pattern="[0-9]{10}"/>
                                        <button class="text-[10px] uppercase tracking-widest text-gold hover:text-gold-light transition-colors whitespace-nowrap ml-4" type="button" id="sendOtpBtn" onclick="sendOTP()">
                                            <span id="sendOtpText">Get OTP</span>
                                            <span id="sendOtpLoader" style="display: none;">
                                                <i class="fa fa-spinner fa-spin"></i> Sending...
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- OTP Input Section (Hidden Initially) -->
                            <div id="otpSection" style="display: none;">
                                <div class="space-y-1 relative group">
                                    <label class="text-[10px] uppercase tracking-widest text-gold/80 font-medium mb-1 block">Enter OTP</label>
                                    <input class="w-full px-0 py-3 border-t-0 border-x-0 border-b border-white/20 bg-transparent focus:ring-0 focus:border-gold transition-colors text-lg font-display tracking-[0.5em] text-white" placeholder="••••••" required="" type="text" id="otpInput" maxlength="6" pattern="[0-9]{6}"/>
                                    <small class="text-[10px] text-white/50 mt-2 block">OTP sent to <span id="phoneDisplay"></span></small>
                                </div>
                                <button class="w-full gold-shine text-white py-5 text-xs tracking-[0.4em] font-sans uppercase shadow-2xl transition-all duration-500 mt-6 border border-white/10" type="button" id="verifyOtpBtn" onclick="verifyOTP()">
                                    <span id="verifyOtpText">Verify OTP & Login</span>
                                    <span id="verifyOtpLoader" style="display: none;">
                                        <i class="fa fa-spinner fa-spin"></i> Verifying...
                                    </span>
                                </button>
                                <div class="text-center mt-4">
                                    <button type="button" class="text-[10px] uppercase tracking-widest text-white/50 hover:text-gold transition-colors italic" id="resendOtpBtn" onclick="resendOTP()" style="display: none;">
                                        Resend OTP
                                    </button>
                                    <div id="resendTimer" style="display: none;">
                                        <small class="text-[10px] text-white/50">Resend OTP in <span id="countdown">60</span> seconds</small>
                                    </div>
                                </div>
                            </div>

                            <!-- Error/Success Messages -->
                            <div id="otpMessage" class="otp-message" style="display: none;"></div>
                        </form>
                    </div>
                </div>
                <div class="relative py-2">
                    <div aria-hidden="true" class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-white/10"></div>
                    </div>
                    <div class="relative flex justify-center text-[10px] uppercase tracking-[0.5em] font-light">
                        <span class="bg-black/20 backdrop-blur-md px-4 text-white/40 italic">OR</span>
                    </div>
                </div>
                <div class="text-center space-y-4">
                    <p class="text-[10px] font-light text-white/50 tracking-widest uppercase">Don't have an account?</p>
                    <a class="group relative text-sm tracking-[0.3em] font-sans uppercase text-gold inline-block" href="register.php">
                        Sign up now
                        <span class="absolute -bottom-1 left-0 w-full h-[1px] bg-gold/40 scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left"></span>
                    </a>
                </div>
            </div>
        </div>
    </main>
    <footer class="relative z-10 py-12 opacity-60">
        <div class="text-center">
            <p class="font-display italic text-gold-light text-lg tracking-widest">Curating Elegance since 2018</p>
        </div>
    </footer>

    <script>
        let resendTimerInterval = null;
        let countdownSeconds = 60;

        // Switch between Email and Mobile login tabs
        document.getElementById('tab-email').addEventListener('change', function() {
            if (this.checked) {
                document.getElementById('email-login-form').style.display = 'block';
                document.getElementById('mobile-login-form').style.display = 'none';
                resetOTPForm();
            }
        });

        document.getElementById('tab-mobile').addEventListener('change', function() {
            if (this.checked) {
                document.getElementById('email-login-form').style.display = 'none';
                document.getElementById('mobile-login-form').style.display = 'block';
            }
        });

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
            messageDiv.className = 'otp-message ' + type;
            messageDiv.style.display = 'block';
        }

        // Allow Enter key to submit
        document.getElementById('phoneNumber')?.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                sendOTP();
            }
        });

        document.getElementById('otpInput')?.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                verifyOTP();
            }
        });

        // Only allow numbers in phone and OTP fields
        document.getElementById('phoneNumber')?.addEventListener('input', function(e) {
            this.value = this.value.replace(/[^0-9]/g, '');
        });

        document.getElementById('otpInput')?.addEventListener('input', function(e) {
            this.value = this.value.replace(/[^0-9]/g, '');
        });
    </script>
</body>
</html>
