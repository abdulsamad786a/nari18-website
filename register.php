<?php
session_start();
error_reporting(0);
include('includes/config.php');

// Code for User registration
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
<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Nari18 by Richa Singh | Luxury Boutique Register</title>
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400&family=Inter:wght@200;300;400;500&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
        }
    </style>
    <script type="text/javascript">
        function valid()
        {
            if(document.register.password.value != document.register.confirmpassword.value)
            {
                alert("Password and Confirm Password Field do not match !!");
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
</head>
<body class="min-h-screen relative font-sans antialiased text-white overflow-x-hidden">
    <div class="fixed inset-0 z-0">
        <img alt="Elegant model in red ethnic outfit" class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBD7IzdObiEjrTcD9ofPmQbnYf3xKcoMa677zq5CUf6pjar8BDQdMn0PfwMDK9fh2M7xFf-i_JzQBXxuh_bLYhGrxhmiUPxeY8PfjJ3Xco6RY0WKmhBWEoY_r3tti6B2WR6PWabq4PEtowDMFgdvpLlJBVC2NhF9JG3H5BmXJ7fxOxogiYYMYxys5f-DibRmcQoKxm1oAoth8atAPjhE3P9kw2uOmYP0FfPGE2bwCqtsRehMps0L1syjqgqSv1KeUg6x9iTSwbac3s"/>
        <div class="absolute inset-0 bg-gradient-to-tr from-black/80 via-black/40 to-luxury-red/30"></div>
    </div>
    <header class="relative z-10 w-full">
        <div class="max-w-7xl mx-auto px-6 lg:px-12 py-10 flex flex-col md:flex-row justify-between items-baseline gap-4">
            <div class="space-y-1">
                <h1 class="text-4xl md:text-5xl font-display font-light tracking-widest uppercase text-white">Register</h1>
                <p class="text-[10px] tracking-[0.4em] font-sans text-gold-light/80 uppercase">Nari18 by Richa Singh</p>
            </div>
            <nav class="flex items-center space-x-3 text-xs tracking-widest font-sans uppercase text-white/60">
                <a class="hover:text-gold transition-colors" href="index.php">Home</a>
                <span class="text-[10px] opacity-30 select-none">/</span>
                <span class="text-white font-medium">Register</span>
            </nav>
        </div>
    </header>
    <main class="relative z-10 flex flex-col items-center justify-center px-6 py-12 lg:py-20">
        <div class="w-full max-w-lg mx-auto">
            <div class="glass-container rounded-3xl p-8 md:p-12 space-y-8">
                <div class="text-center space-y-3">
                    <h2 class="text-3xl md:text-4xl font-display italic text-gold-light tracking-wide text-shadow-gold">Create an Account</h2>
                    <p class="text-xs font-light text-white/70 tracking-widest uppercase">
                        Register here if you are a new customer
                    </p>
                </div>
                <form class="space-y-8" role="form" method="post" name="register" onSubmit="return valid();">
                    <div class="space-y-1 relative group">
                        <label class="text-[10px] uppercase tracking-widest text-gold/80 font-medium mb-1 block">Full Name</label>
                        <input type="text" name="fullname" placeholder="Enter your full name" id="CustomerUsername" class="w-full px-0 py-3 border-t-0 border-x-0 border-b border-white/20 bg-transparent focus:ring-0 focus:border-gold transition-colors text-lg font-display text-white" value="" required />
                    </div>
                    <div class="space-y-1 relative group">
                        <label class="text-[10px] uppercase tracking-widest text-gold/80 font-medium mb-1 block">Email Address</label>
                        <input type="email" name="emailid" placeholder="e.g. elegance@nari18.com" onBlur="userAvailability()" id="email" class="w-full px-0 py-3 border-t-0 border-x-0 border-b border-white/20 bg-transparent focus:ring-0 focus:border-gold transition-colors text-lg font-display text-white" value="" required />
                        <span id="user-availability-status1" style="font-size:12px; color: rgba(239, 68, 68, 0.8); margin-top: 4px; display: block;"></span>
                    </div>
                    <div class="space-y-1 relative group">
                        <label class="text-[10px] uppercase tracking-widest text-gold/80 font-medium mb-1 block">Contact Number</label>
                        <input type="text" name="contactno" placeholder="98765 43210" id="contactno" class="w-full px-0 py-3 border-t-0 border-x-0 border-b border-white/20 bg-transparent focus:ring-0 focus:border-gold transition-colors text-lg font-display text-white" value="" required />
                    </div>
                    <div class="space-y-1 relative group">
                        <label class="text-[10px] uppercase tracking-widest text-gold/80 font-medium mb-1 block">Password</label>
                        <input type="password" name="password" placeholder="••••••••" id="CustomerPassword" class="w-full px-0 py-3 border-t-0 border-x-0 border-b border-white/20 bg-transparent focus:ring-0 focus:border-gold transition-colors text-lg font-display text-white" value="" required />
                    </div>
                    <div class="space-y-1 relative group">
                        <label class="text-[10px] uppercase tracking-widest text-gold/80 font-medium mb-1 block">Confirm Password</label>
                        <input id="confirmpassword" type="password" name="confirmpassword" placeholder="••••••••" class="w-full px-0 py-3 border-t-0 border-x-0 border-b border-white/20 bg-transparent focus:ring-0 focus:border-gold transition-colors text-lg font-display text-white" required />
                    </div>
                    <button class="w-full gold-shine text-white py-5 text-xs tracking-[0.4em] font-sans uppercase shadow-2xl transition-all duration-500 mt-6 border border-white/10" type="submit" name="submit" id="submit">
                        Register
                    </button>
                </form>
                <div class="relative py-2">
                    <div aria-hidden="true" class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-white/10"></div>
                    </div>
                    <div class="relative flex justify-center text-[10px] uppercase tracking-[0.5em] font-light">
                        <span class="bg-black/20 backdrop-blur-md px-4 text-white/40 italic">OR</span>
                    </div>
                </div>
                <div class="text-center space-y-4">
                    <p class="text-[10px] font-light text-white/50 tracking-widest uppercase">Already have an account?</p>
                    <a class="group relative text-sm tracking-[0.3em] font-sans uppercase text-gold inline-block" href="login.php">
                        Login now
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
</body>
</html>
