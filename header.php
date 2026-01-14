<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(isset($_GET['action']) && $_GET['action']=="add"){
	$id=intval($_GET['id']);
	if(isset($_SESSION['cart'][$id])){
		$_SESSION['cart'][$id]['quantity']++;
	}else{
		$sql_p="SELECT * FROM products WHERE id={$id}";
		$query_p=mysqli_query($con,$sql_p);
		if(mysqli_num_rows($query_p)!=0){
			$row_p=mysqli_fetch_array($query_p);
			$_SESSION['cart'][$row_p['id']]=array("quantity" => 1, "price" => $row_p['productPrice']);
		
		}else{
			$message="Product ID is invalid";
		}
	}
		echo "<script>alert('Product has been added to the cart')</script>";
		echo "<script type='text/javascript'> document.location ='my-cart.php'; </script>";
}


?>
<!DOCTYPE html>
<html class="no-js" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="description" content="description">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Title Of Site -->
        <title>Nari18</title>
        <!-- Favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.png" />
        <!-- Plugins CSS -->
        <link rel="stylesheet" href="assets/css/plugins.css">
        <!-- Main Style CSS -->
        <link rel="stylesheet" href="assets/css/style-min.css">
        <link rel="stylesheet" href="assets/css/responsive.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    </head>

    <body class="template-index index-demo1">
        <!--Page Wrapper-->
        <div class="page-wrapper">
          

            <!--Top Header-->
            <div class="top-header">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-6 col-sm-6 col-md-3 col-lg-4 text-left">
                            <i class="icon anm anm-phone-l me-2"></i><a href="tel:+91-">+91-8826446755</a>
                        </div>
                        <div class="col-12 col-sm-12 col-md-6 col-lg-4 text-center d-none d-md-block">
                            Get the Best Deal In All Over India <a href="all-category.php" class="text-link ms-1">Shop now</a>
                        </div>
    
                    </div>
                </div>
            </div>
            <!--End Top Header-->


            <!--Header-->
            <header class="header d-flex align-items-center header-1 header-fixed">
                <?php 
                    if(isset($_Get['action'])){
                        if(!empty($_SESSION['cart'])){
                        foreach($_POST['quantity'] as $key => $val){
                            if($val==0){
                                unset($_SESSION['cart'][$key]);
                            }else{
                                $_SESSION['cart'][$key]['quantity']=$val;
                            }
                        }
                        }
                    }
                ?>
                <div class="container">        
                    <div class="row">
                        <!--Logo-->
                        <div class="logo col-5 col-sm-3 col-md-3 col-lg-2 align-self-center">
                            <a class="logoImg" href="index.php"><img src="assets/images/logo.png" alt="Nari18" title="Nari18" width="149" height="39" /></a>
                        </div>
                        <!--End Logo-->
                        <!--Menu-->

                        <div class="col-1 col-sm-1 col-md-1 col-lg-8 align-self-center d-menu-col">
                            <nav class="navigation" id="AccessibleNav">
                                <ul id="siteNav" class="site-nav medium center">
                                    <li class="lvl1 parent "><a href="index.php">Home </a> </li>
                                    <li class="lvl1 parent "><a href="about.php">About Us </a> </li>
                                     <li class="lvl1 parent dropdown"><a href="all-category.php"> shop by catalog <i class="icon anm anm-angle-down-l"></i></a>
                                        <ul class="dropdown">
                                        <?php $sql=mysqli_query($con,"select id,categoryName  from category");
                                         while($row=mysqli_fetch_array($sql))
                                        { ?>
                                            <li><a href="category.php?cid=<?php echo $row['id'];?>" class="site-nav"><?php echo $row['categoryName'];?></a></li>
                                        <?php } ?> 
                                        </ul>
                                    </li>
                                     <li class="lvl1 parent dropdown"><a href="all-category.php"> new arivals <i class="icon anm anm-angle-down-l"></i></a>
                                        <ul class="dropdown">
                                        <?php $sql=mysqli_query($con,"select id,categoryName  from category");
                                         while($row=mysqli_fetch_array($sql))
                                        { ?>
                                            <li><a href="category.php?cid=<?php echo $row['id'];?>" class="site-nav"><?php echo $row['categoryName'];?></a></li>
                                        <?php } ?> 
                                        </ul>
                                    </li>
                                  <li class="lvl1 parent "><a href="contact.php">Contact Us </a> </li>
                                </ul>
                            </nav>
                        </div>

                        <!-- <div class="col-1 col-sm-1 col-md-1 col-lg-8 align-self-center d-menu-col">
                            <nav class="navigation" id="AccessibleNav">
                                <ul id="siteNav" class="site-nav medium center">
                                    <li class="lvl1 parent "><a href="index.php">Home </a> </li>
                                    <li class="lvl1 parent "><a href="about.php">About Us </a> </li>
                                    <?php $sql=mysqli_query($con,"select id,categoryName  from category limit 2");
                                    while($row=mysqli_fetch_array($sql))
                                    {
                                        ?>
                                    <li class="lvl1 parent "><a href="category.php?cid=<?php echo $row['id'];?>"><?php echo $row['categoryName'];?> </a>
                                    </li>
                                    <?php } ?>
                                    
                                    
                                    <li class="lvl1 parent dropdown"><a href="all-category.php"> All Categories <i class="icon anm anm-angle-down-l"></i></a>
                                        <ul class="dropdown">
                                        <?php $sql=mysqli_query($con,"select id,categoryName  from category");
                                         while($row=mysqli_fetch_array($sql))
                                        { ?>
                                            <li><a href="category.php?cid=<?php echo $row['id'];?>" class="site-nav"><?php echo $row['categoryName'];?></a></li>
                                        <?php } ?> 
                                        </ul>
                                    </li>
                                </ul>
                            </nav>
                        </div> -->
                        <!--End Menu-->
                        <!--Right Icon-->
                        <div class="col-7 col-sm-9 col-md-9 col-lg-2 align-self-center icons-col text-right">
                            <!--Search-->
                            <div class="search-parent iconset">
                                <div class="site-search" title="Search">
                                    <a href="#;" class="search-icon clr-none" data-bs-toggle="offcanvas" data-bs-target="#search-drawer"><i class="hdr-icon icon anm anm-search-l"></i></a>
                                </div>
                                <div class="search-drawer offcanvas offcanvas-top" tabindex="-1" id="search-drawer">
                                    <div class="container">
                                        <div class="search-header d-flex-center justify-content-between mb-3">
                                            <h3 class="title m-0">What are you looking for?</h3>
                                            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                        </div>
                                        <div class="search-body">
                                            <form class="form minisearch" id="header-search" action="search-result.php" method="post" name="search">
                                                <!--Search Field-->
                                                <div class="d-flex searchField">
                                                    <div class="search-category">
                                                        <select class="rgsearch-category rounded-end-0">
                                                            <option value="0">All Categories</option>
                                                        </select>
                                                    </div>
                                                    <div class="input-box d-flex fl-1">
                                                        <input type="text" name="product" required class="input-text border-start-0 border-end-0" placeholder="Search for products..." value="" />
                                                        <button type="submit" name="search" class="action search d-flex-justify-center btn rounded-start-0"><i class="icon anm anm-search-l"></i></button>
                                                    </div>
                                                </div>
                                                <!--End Search Field-->
                                               
                                                <!--End Search popular-->
                                               
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--End Search-->
                            <!--Account-->
                            <div class="account-parent iconset">
                                <div class="account-link" title="Account"><i class="hdr-icon icon anm anm-user-al"></i></div>
                                <div id="accountBox">
                                    <div class="customer-links">
                                    
                                        <ul class="m-0">
                                        <?php if(strlen($_SESSION['login'])==0)
                                        {   ?>
                                            <li><a href="login.php"><i class="icon anm anm-sign-in-al"></i>Sign In</a></li>                                            
                                            <?php }
                                        else{ ?>
                                            
                                            <li><a href="#"><i class="icon anm anm-sign-in-al"></i>Welcome - <?php echo htmlentities($_SESSION['username']);?></a></li> 
                                            <?php } ?>

                                            
                                            <li><a href="register.php"><i class="icon anm anm-user-al"></i>Register</a></li>
                                            <li><a href="my-account.php"><i class="icon anm anm-user-cil"></i>My Account</a></li>
                                            <li><a href="my-wishlist.php"><i class="icon anm anm-heart-l"></i>Wishlist</a></li>
                                            <li><a href="logout.php"><i class="icon anm anm-sign-out-al"></i>Sign out</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!--End Account-->
                            <!--Wishlist-->
                           
                           
                            <?php if(strlen($_SESSION['login'])==0)
                            {   ?>
                           <div class="wishlist-link iconset" title="Wishlist"><a href="my-wishlist.php"><i class="hdr-icon icon anm anm-heart-l"></i><span class="wishlist-count">0</span></a></div>
                           <?php }else{?>
                            <?php
                                $loginid = $_SESSION['id'];
                                $wishlistqr=mysqli_query($con,"SELECT * FROM `wishlist` WHERE userId=$loginid");
                                $num=mysqli_num_rows($wishlistqr);
                            ?>
                            <div class="wishlist-link iconset" title="Wishlist"><a href="my-wishlist.php"><i class="hdr-icon icon anm anm-heart-l"></i><span class="wishlist-count"><?php echo $num;?></span></a></div>
                           <?php }?>

                            <!--End Wishlist-->
                            <!--Minicart-->
                            
<?php
// Add this function at the top of header.php after session_start()
// This calculates total cart quantity
function getCartCount() {
    $count = 0;
    if(!empty($_SESSION['cart'])){
        foreach($_SESSION['cart'] as $item){
            $count += $item['quantity'];
        }
    }
    return $count;
}

// Update the cart count variable
$cartCount = getCartCount();
?>

<!-- In the header section, update the cart icon part to: -->
<div class="header-cart iconset" title="Cart">
    <a href="#;" class="header-cart btn-minicart clr-none" data-bs-toggle="offcanvas" data-bs-target="#minicart-drawer">
        <i class="hdr-icon icon anm anm-cart-l"></i>
        <span class="cart-count" id="cart-count-badge"><?php echo $cartCount; ?></span>
    </a>
</div>

                            <!-- Add this script before closing </body> tag in header.php -->
                            <script>
                            // Function to update cart count via AJAX
                            function updateCartCount() {
                                var xhr = new XMLHttpRequest();
                                xhr.open('GET', 'get-cart-count.php', true);
                                
                                xhr.onload = function() {
                                    if (xhr.status === 200) {
                                        var count = xhr.responseText;
                                        document.getElementById('cart-count-badge').textContent = count;
                                    }
                                };
                                
                                xhr.send();
                            }

                            // Call this function whenever cart is updated
                            window.updateCartCount = updateCartCount;
                            
                            </script>

                            <!--End Wishlist-->
                            <!--Mobile Toggle-->
                            <button type="button" class="iconset pe-0 menu-icon js-mobile-nav-toggle mobile-nav--open d-lg-none" title="Menu"><i class="hdr-icon icon anm anm-times-l"></i><i class="hdr-icon icon anm anm-bars-r"></i></button>
                            <!--End Mobile Toggle-->
                        </div>
                        <!--End Right Icon-->
                    </div>
                </div>
            </header>
            <!--End Header-->
            <!--Mobile Menu-->
            <div class="mobile-nav-wrapper" role="navigation">
                <div class="closemobileMenu">Close Menu <i class="icon anm anm-times-l"></i></div>
                <ul id="MobileNav" class="mobile-nav">
                    <li class="lvl1 parent "><a href="index.php">Home </a> </li>
                    <li class="lvl1 parent "><a href="about.php">About Us </a> </li>                    
                    
                    <li class="lvl1 parent dropdown"><a href="all-category.php">shop by catalog <i class="icon anm anm-angle-down-l"></i></a>
                        <ul class="lvl-2">
                        <?php $sql=mysqli_query($con,"select id,categoryName  from category");
                            while($row=mysqli_fetch_array($sql))
                            {
                        ?>
                    <li><a href="category.php?cid=<?php echo $row['id'];?>" class="site-nav"><?php echo $row['categoryName'];?></a></li>
                        <?php }?>
                        </ul>
                    </li>
                    <li class="lvl1 parent dropdown"><a href="all-category.php">new arivals <i class="icon anm anm-angle-down-l"></i></a>
                        <ul class="lvl-2">
                        <?php $sql=mysqli_query($con,"select id,categoryName  from category");
                            while($row=mysqli_fetch_array($sql))
                            {
                        ?>
                            <li><a href="category.php?cid=<?php echo $row['id'];?>" class="site-nav"><?php echo $row['categoryName'];?></a></li>
                        <?php }?>
                        </ul>
                    </li>
                     <li class="lvl1 parent "><a href="contact.php">Contact Us </a> </li>
                    <li class="mobile-menu-bottom">
                        <div class="mobile-links"> 
                            <ul class="list-inline d-inline-flex flex-column w-100">
                                <li><a href="login.php" class="d-flex align-items-center"><i class="icon anm anm-sign-in-al"></i>Sign In</a></li>
                                <li><a href="register.php" class="d-flex align-items-center"><i class="icon anm anm-user-al"></i>Register</a></li>
                                <li><a href="my-account.php" class="d-flex align-items-center"><i class="icon anm anm-user-cil"></i>My Account</a></li>
                                <li><a href="logout.php" class="d-flex align-items-center"><i class="icon anm anm-sign-in-al"></i>Sign Out</a></li>
                                <li class="title h5">Need Help?</li>
                                <li><a href="tel:8826446755" class="d-flex align-items-center"><i class="icon anm anm-phone-l"></i> +91-8826446755</a></li>
                                <li><a href="mailto:Info@nari18.com" class="d-flex align-items-center"><i class="icon anm anm-envelope-l"></i> Info@nari18.com</a>, <a href="mailto:richa@nari18.com" class="d-flex align-items-center"><i class="icon anm anm-envelope-l"></i> richa@nari18.com</a></li>
                            </ul>
                        </div>
                        <div class="mobile-follow mt-2">  
                            <h5 class="title">Follow Us</h5>
                            <ul class="list-inline social-icons d-inline-flex mt-1">
                                <li class="list-inline-item"><a href="#" title="Facebook"><i class="icon anm anm-facebook-f"></i></a></li>
                                <li class="list-inline-item"><a href="#" title="Twitter"><i class="icon anm anm-twitter"></i></a></li>
                                <li class="list-inline-item"><a href="#" title="Pinterest"><i class="icon anm anm-pinterest-p"></i></a></li>
                                <li class="list-inline-item"><a href="#" title="Linkedin"><i class="icon anm anm-linkedin-in"></i></a></li>
                                <li class="list-inline-item"><a href="#" title="Instagram"><i class="icon anm anm-instagram"></i></a></li>
                                <li class="list-inline-item"><a href="#" title="Youtube"><i class="icon anm anm-youtube"></i></a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
            <!--End Mobile Menu-->