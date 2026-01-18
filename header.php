<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (isset($_GET['action']) && $_GET['action'] == "add") {
    $id = intval($_GET['id']);
    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]['quantity']++;
    } else {
        $sql_p = "SELECT * FROM products WHERE id={$id}";
        $query_p = mysqli_query($con, $sql_p);
        if (mysqli_num_rows($query_p) != 0) {
            $row_p = mysqli_fetch_array($query_p);
            $_SESSION['cart'][$row_p['id']] = array("quantity" => 1, "price" => $row_p['productPrice']);
        } else {
            $message = "Product ID is invalid";
        }
    }
    // Set flag to show modal
    $_SESSION['show_cart_modal'] = true;
    // Don't redirect, let modal show on current page
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
    <link rel="shortcut icon" href="assets/images/logo.png" />
    <!-- Plugins CSS -->
    <link rel="stylesheet" href="assets/css/plugins.css">
    <!-- Main Style CSS -->
    <link rel="stylesheet" href="assets/css/style-min.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <!-- Blue Color Removal - Override all blue colors with theme color -->
    <link rel="stylesheet" href="assets/css/blue-color-removal.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Font Awesome for Footer Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Google Fonts for Footer -->
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Montserrat:wght@300;400;500;600&display=swap"
        rel="stylesheet" />
    <style>
        /* Top Header Shop Now Link - Yellow Hover - Maximum Specificity */
        html body .top-header .top-header-shop-now-link:hover,
        html body .top-header a.top-header-shop-now-link:hover,
        .top-header .top-header-shop-now-link:hover,
        .top-header-shop-now-link:hover {
            color: #C5A059 !important;
        }
    </style>
</head>

<body class="template-index index-demo1">
    <!--Page Wrapper-->
    <div class="page-wrapper">


        <!--Top Header-->
        <div class="top-header" style="background: #800020; color: white; padding: 8px 0; width: 100%;">
            <div style="max-width: 1200px; margin: 0 auto; padding: 0 15px;">
                <div
                    style="display: flex; align-items: center; justify-content: space-between; flex-wrap: nowrap; gap: 150px;">
                    <div style="flex: 1; text-align: left; display: none;" class="top-header-left">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
                            stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            style="vertical-align: middle; display: inline-block;">
                            <path
                                d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z">
                            </path>
                        </svg>
                        <a href="tel:+91-8826446755" class="top-header-phone-link"
                            style="color: white; text-decoration: none; margin-left: 4px; font-size: 11px;"><span
                                class="phone-text">+91-8826446755</span></a>
                    </div>
                    <div style="flex: 2; text-align: center;">
                        <span
                            style="font-size: 11px; letter-spacing: 0.1em; text-transform: uppercase; white-space: nowrap;">Get
                            the Best Deal in All Over India — <a href="all-category.php"
                                class="top-header-shop-now-link"
                                style="color: white; text-decoration: underline; text-underline-offset: 4px; opacity: 0.8;">Shop
                                Now</a></span>
                    </div>
                    <div style="flex: 1; text-align: right; display: none;" class="top-header-right">
                        <span style="font-size: 11px; white-space: nowrap;">Complementary Shipping on Orders Above
                            ₹5000</span>
                    </div>
                </div>
            </div>
        </div>
        <style>
            @media (min-width: 768px) {

                .top-header-left,
                .top-header-right {
                    display: block !important;
                }
            }

            .top-header-phone-link:hover .phone-text {
                color: #C5A059 !important;
            }
        </style>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const phoneLink = document.querySelector('.top-header-phone-link');
                if (phoneLink) {
                    phoneLink.addEventListener('mouseenter', function () {
                        this.querySelector('.phone-text').style.setProperty('color', '#C5A059', 'important');
                    });
                    phoneLink.addEventListener('mouseleave', function () {
                        this.querySelector('.phone-text').style.setProperty('color', 'white', 'important');
                    });
                }
            });
        </script>
        <!--End Top Header-->

        <!-- Shop Now Link Hover Effect Script -->
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const shopNowLink = document.querySelector('.top-header-shop-now-link');
                if (shopNowLink) {
                    shopNowLink.addEventListener('mouseenter', function () {
                        this.style.setProperty('color', '#C5A059', 'important');
                    });
                    shopNowLink.addEventListener('mouseleave', function () {
                        this.style.setProperty('color', 'white', 'important');
                    });
                }
            });
        </script>

        <!--Header-->
        <header class="header d-flex align-items-center header-1 header-fixed modern-navbar" id="mainHeader">
            <?php
            if (isset($_GET['action'])) {
                if (!empty($_SESSION['cart'])) {
                    foreach ($_POST['quantity'] as $key => $val) {
                        if ($val == 0) {
                            unset($_SESSION['cart'][$key]);
                        } else {
                            $_SESSION['cart'][$key]['quantity'] = $val;
                        }
                    }
                }
            }
            ?>
            <div class="container">
                <div class="row">
                    <!--Logo-->
                    <div class="logo col-5 col-sm-3 col-md-3 col-lg-2 align-self-center">
                        <a class="logoImg" href="index.php"><img src="assets/images/logo.png" alt="Nari18"
                                title="Nari18" width="200" /></a>
                    </div>
                    <!--End Logo-->
                    <!--Menu-->

                    <div class="col-1 col-sm-1 col-md-1 col-lg-8 align-self-center d-menu-col">
                        <nav class="navigation" id="AccessibleNav">
                            <ul id="siteNav" class="site-nav medium center">
                                <li class="lvl1 parent "><a href="index.php">Home </a> </li>
                                <li class="lvl1 parent "><a href="about.php">About Us </a> </li>
                                <li class="lvl1 parent dropdown"><a href="all-category.php"> shop by catalog <i
                                            class="icon anm anm-angle-down-l"></i></a>
                                    <ul class="dropdown">
                                        <?php $sql = mysqli_query($con, "select id,categoryName  from category");
                                        while ($row = mysqli_fetch_array($sql)) { ?>
                                            <li><a href="category.php?cid=<?php echo $row['id']; ?>"
                                                    class="site-nav"><?php echo $row['categoryName']; ?></a></li>
                                        <?php } ?>
                                    </ul>
                                </li>
                                <li class="lvl1 parent dropdown"><a href="all-category.php"> new arivals <i
                                            class="icon anm anm-angle-down-l"></i></a>
                                    <ul class="dropdown">
                                        <?php $sql = mysqli_query($con, "select id,categoryName  from category");
                                        while ($row = mysqli_fetch_array($sql)) { ?>
                                            <li><a href="category.php?cid=<?php echo $row['id']; ?>"
                                                    class="site-nav"><?php echo $row['categoryName']; ?></a></li>
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
                                    <?php $sql = mysqli_query($con, "select id,categoryName  from category limit 2");
                                    while ($row = mysqli_fetch_array($sql)) {
                                        ?>
                                    <li class="lvl1 parent "><a href="category.php?cid=<?php echo $row['id']; ?>"><?php echo $row['categoryName']; ?> </a>
                                    </li>
                                    <?php } ?>
                                    
                                    
                                    <li class="lvl1 parent dropdown"><a href="all-category.php"> All Categories <i class="icon anm anm-angle-down-l"></i></a>
                                        <ul class="dropdown">
                                        <?php $sql = mysqli_query($con, "select id,categoryName  from category");
                                        while ($row = mysqli_fetch_array($sql)) { ?>
                                            <li><a href="category.php?cid=<?php echo $row['id']; ?>" class="site-nav"><?php echo $row['categoryName']; ?></a></li>
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
                                <a href="#;" class="search-icon clr-none" data-bs-toggle="offcanvas"
                                    data-bs-target="#search-drawer"><i class="hdr-icon icon anm anm-search-l"></i></a>
                            </div>
                            <div class="search-drawer offcanvas offcanvas-top" tabindex="-1" id="search-drawer">
                                <div class="container">
                                    <div class="search-header d-flex-center justify-content-between mb-3">
                                        <h3 class="title m-0">What are you looking for?</h3>
                                        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="search-body">
                                        <form class="form minisearch" id="header-search" action="search-result.php"
                                            method="post" name="search">
                                            <!--Search Field-->
                                            <div class="d-flex searchField">
                                                <div class="search-category">
                                                    <select class="rgsearch-category rounded-end-0">
                                                        <option value="0">All Categories</option>
                                                    </select>
                                                </div>
                                                <div class="input-box d-flex fl-1">
                                                    <input type="text" name="product" required
                                                        class="input-text border-start-0 border-end-0"
                                                        placeholder="Search for products..." value="" />
                                                    <button type="submit" name="search"
                                                        class="action search d-flex-justify-center btn rounded-start-0"><i
                                                            class="icon anm anm-search-l"></i></button>
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
                            <div class="account-link" title="Account"><i class="hdr-icon icon anm anm-user-al"></i>
                            </div>
                            <div id="accountBox" class="premium-account-dropdown">
                                <div class="account-dropdown-inner">
                                    <?php if (strlen($_SESSION['login']) != 0) { ?>
                                        <!-- Logged In User Header -->
                                        <div class="account-dropdown-header">
                                            <div class="account-avatar">
                                                <span><?php echo strtoupper(substr($_SESSION['username'], 0, 1)); ?></span>
                                            </div>
                                            <div class="account-user-info">
                                                <span class="account-greeting">Welcome back</span>
                                                <span
                                                    class="account-username"><?php echo htmlentities($_SESSION['username']); ?></span>
                                            </div>
                                        </div>
                                        <div class="account-dropdown-divider"></div>
                                    <?php } ?>

                                    <!-- Menu Items -->
                                    <div class="account-dropdown-menu">
                                        <?php if (strlen($_SESSION['login']) == 0) { ?>
                                            <a href="login.php" class="account-menu-item account-menu-primary">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"></path>
                                                    <polyline points="10 17 15 12 10 7"></polyline>
                                                    <line x1="15" y1="12" x2="3" y2="12"></line>
                                                </svg>
                                                <span class="btn-text">Sign In</span>
                                            </a>
                                            <a href="register.php" class="account-menu-item">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                                    <circle cx="8.5" cy="7" r="4"></circle>
                                                    <line x1="20" y1="8" x2="20" y2="14"></line>
                                                    <line x1="23" y1="11" x2="17" y2="11"></line>
                                                </svg>
                                                <span>Create Account</span>
                                            </a>
                                        <?php } else { ?>
                                            <a href="my-account.php" class="account-menu-item">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                                    <circle cx="12" cy="7" r="4"></circle>
                                                </svg>
                                                <span>My Account</span>
                                            </a>

                                            <a href="my-wishlist.php" class="account-menu-item">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round">
                                                    <path
                                                        d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z">
                                                    </path>
                                                </svg>
                                                <span>Wishlist</span>
                                            </a>

                                            <div class="account-dropdown-divider"></div>
                                            <a href="logout.php" class="account-menu-item account-menu-logout">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                                    <polyline points="16 17 21 12 16 7"></polyline>
                                                    <line x1="21" y1="12" x2="9" y2="12"></line>
                                                </svg>
                                                <span>Sign Out</span>
                                            </a>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--End Account-->
                        <!--Wishlist-->


                        <?php if (strlen($_SESSION['login']) == 0) { ?>
                            <div class="wishlist-link iconset" title="Wishlist"><a href="my-wishlist.php"><i
                                        class="hdr-icon icon anm anm-heart-l"></i><span class="wishlist-count">0</span></a>
                            </div>
                        <?php } else { ?>
                            <?php
                            $loginid = $_SESSION['id'];
                            $wishlistqr = mysqli_query($con, "SELECT * FROM `wishlist` WHERE userId=$loginid");
                            $num = mysqli_num_rows($wishlistqr);
                            ?>
                            <div class="wishlist-link iconset" title="Wishlist"><a href="my-wishlist.php"><i
                                        class="hdr-icon icon anm anm-heart-l"></i><span
                                        class="wishlist-count"><?php echo $num; ?></span></a></div>
                        <?php } ?>

                        <!--End Wishlist-->
                        <!--Minicart-->

                        <?php
                        // Add this function at the top of header.php after session_start()
// This calculates total cart quantity
                        function getCartCount()
                        {
                            $count = 0;
                            if (!empty($_SESSION['cart'])) {
                                foreach ($_SESSION['cart'] as $item) {
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
                            <a href="#;" class="header-cart btn-minicart clr-none" data-bs-toggle="offcanvas"
                                data-bs-target="#minicart-drawer">
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

                                xhr.onload = function () {
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
                        <button type="button"
                            class="iconset pe-0 menu-icon js-mobile-nav-toggle mobile-nav--open d-lg-none"
                            title="Menu"><i class="hdr-icon icon anm anm-times-l"></i><i
                                class="hdr-icon icon anm anm-bars-r"></i></button>
                        <!--End Mobile Toggle-->
                    </div>
                    <!--End Right Icon-->
                </div>
            </div>
        </header>
        <!--End Header-->

        <!-- Modern Navbar Styles with Effects -->
        <style>
            /* Modern Navbar Styling */
            .modern-navbar {
                position: sticky !important;
                top: 0;
                z-index: 50;
                transition: all 0.3s ease;
                border-bottom: 1px solid rgba(0, 0, 0, 0.1);
                background: rgba(249, 247, 242, 0.9) !important;
                backdrop-filter: blur(12px);
                -webkit-backdrop-filter: blur(12px);
            }

            .modern-navbar .container {
                max-width: 1200px !important;
                margin: 0 auto !important;
            }

            .modern-navbar .container .row {
                align-items: center;
                width: 100%;
                margin: 0;
            }

            .modern-navbar.scrolled {
                height: 70px !important;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            }

            .modern-navbar.scrolled .container .row {
                align-items: center;
            }

            .modern-navbar .logo {
                transition: all 0.3s ease;
                flex-shrink: 0;
                display: flex !important;
                align-items: center !important;
                justify-content: flex-start !important;
                padding-top: 5px !important;
                padding-bottom: 5px !important;
            }

            .modern-navbar .logo img {
                transition: all 0.3s ease;
                width: auto !important;
                height: auto !important;
                max-width: 200px !important;
                max-height: 55px !important;
                object-fit: contain !important;
                display: block !important;
            }

            .modern-navbar.scrolled .logo img {
                max-width: 150px !important;
                max-height: 45px !important;
                width: auto !important;
                height: auto !important;
                object-fit: contain !important;
            }

            .modern-navbar.scrolled .logo {
                flex-shrink: 0;
                min-width: auto;
            }

            /* Nav Item Hover Effect - Applied to all navbar text tabs */
            #siteNav>li>a,
            #siteNav li a,
            .navigation a,
            nav a {
                position: relative;
                text-transform: uppercase;
                letter-spacing: 0.1em;
                font-size: 15px;
                font-weight: 500;
                color: #2c2c2c !important;
                transition: color 0.3s ease;
            }

            #siteNav>li>a::after,
            #siteNav li a::after,
            .navigation a::after,
            nav a::after {
                content: '';
                position: absolute;
                width: 0;
                height: 1px;
                bottom: -4px;
                left: 0;
                background-color: #800020;
                transition: width 0.3s ease;
            }

            /* AGGRESSIVE OVERRIDE - Force theme color on all navbar links */
            #siteNav>li>a:hover,
            #siteNav>li:hover>a,
            #siteNav li a:hover,
            #siteNav li:hover>a,
            #siteNav>li.lvl1>a:hover,
            #siteNav>li.lvl1:hover>a,
            #siteNav>li.parent>a:hover,
            #siteNav>li.parent:hover>a,
            .navigation a:hover,
            nav a:hover,
            #AccessibleNav #siteNav>li>a:hover,
            #AccessibleNav #siteNav>li:hover>a,
            .navigation #siteNav>li>a:hover,
            .navigation #siteNav>li:hover>a,
            header #siteNav>li>a:hover,
            header #siteNav>li:hover>a,
            body #siteNav>li>a:hover,
            body #siteNav>li:hover>a {
                color: #800020 !important;
            }

            #siteNav>li>a:hover::after,
            #siteNav>li:hover>a::after,
            #siteNav li a:hover::after,
            #siteNav li:hover>a::after,
            .navigation a:hover::after,
            nav a:hover::after {
                width: 100%;
            }

            /* Ensure dropdown parent links also have the effect */
            #siteNav>li.dropdown>a::after,
            #siteNav>li.parent>a::after {
                content: '';
                position: absolute;
                width: 0;
                height: 1px;
                bottom: -4px;
                left: 0;
                background-color: #800020;
                transition: width 0.3s ease;
            }

            #siteNav>li.dropdown:hover>a::after,
            #siteNav>li.parent:hover>a::after {
                width: 100%;
            }

            /* Icon Styling */
            .modern-navbar .hdr-icon {
                color: #2c2c2c;
                transition: color 0.3s ease;
            }

            .modern-navbar .hdr-icon:hover {
                color: #800020;
            }

            /* Cart and Wishlist Badges */
            .modern-navbar .cart-count,
            .modern-navbar .wishlist-count {
                background: #800020;
                color: white;
                font-size: 9px;
                font-weight: bold;
                min-width: 16px;
                height: 16px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                position: absolute;
                top: -8px;
                right: -8px;
                padding: 0 4px;
            }

            .modern-navbar .wishlist-count {
                background: #D4AF37;
            }

            /* Responsive adjustments */
            @media (max-width: 991px) {
                .modern-navbar {
                    height: auto !important;
                }
            }

            /* Premium Account Dropdown Styles */
            .account-parent {
                position: relative !important;
            }

            #accountBox.premium-account-dropdown {
                position: absolute !important;
                top: 100% !important;
                right: 0 !important;
                left: auto !important;
                width: 240px !important;
                min-width: 240px !important;
                max-width: 240px !important;
                background: #ffffff !important;
                border-radius: 8px !important;
                box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15) !important;
                opacity: 0;
                visibility: hidden;
                transform: translateY(8px);
                transition: all 0.25s ease;
                z-index: 9999 !important;
                overflow: visible !important;
                border: 1px solid #e5e5e5 !important;
                padding: 0 !important;
                margin: 0 !important;
            }

            .account-parent:hover #accountBox.premium-account-dropdown {
                opacity: 1;
                visibility: visible;
                transform: translateY(0);
            }

            .account-dropdown-inner {
                padding: 0 !important;
                margin: 0 !important;
                width: 100% !important;
            }

            .account-dropdown-header {
                display: flex !important;
                align-items: center !important;
                gap: 12px !important;
                padding: 16px !important;
                background: linear-gradient(135deg, #800020 0%, #5a0016 100%) !important;
                border-radius: 7px 7px 0 0 !important;
                margin: 0 !important;
            }

            .account-avatar {
                width: 44px !important;
                height: 44px !important;
                min-width: 44px !important;
                border-radius: 50% !important;
                background: rgba(255, 255, 255, 0.2) !important;
                display: flex !important;
                align-items: center !important;
                justify-content: center !important;
                border: 2px solid rgba(255, 255, 255, 0.3) !important;
            }

            .account-avatar span {
                color: #ffffff !important;
                font-size: 18px !important;
                font-weight: 600 !important;
                text-transform: uppercase !important;
                line-height: 1 !important;
            }

            .account-user-info {
                display: flex !important;
                flex-direction: column !important;
                gap: 2px !important;
                flex: 1 !important;
                min-width: 0 !important;
            }

            .account-greeting {
                font-size: 10px !important;
                color: rgba(255, 255, 255, 0.8) !important;
                text-transform: uppercase !important;
                letter-spacing: 0.1em !important;
                line-height: 1.2 !important;
                white-space: nowrap !important;
            }

            .account-username {
                font-size: 15px !important;
                font-weight: 600 !important;
                color: #ffffff !important;
                text-transform: capitalize !important;
                line-height: 1.2 !important;
                white-space: nowrap !important;
                overflow: hidden !important;
                text-overflow: ellipsis !important;
            }

            .account-dropdown-divider {
                height: 1px !important;
                background: #eeeeee !important;
                margin: 0 !important;
                border: none !important;
            }

            .account-dropdown-menu {
                padding: 8px 0 !important;
                margin: 0 !important;
            }

            .account-menu-item {
                display: flex !important;
                align-items: center !important;
                gap: 12px !important;
                padding: 10px 16px !important;
                color: #444444 !important;
                text-decoration: none !important;
                font-size: 13px !important;
                font-weight: 500 !important;
                transition: all 0.2s ease !important;
                border-left: 3px solid transparent !important;
                white-space: nowrap !important;
            }

            .account-menu-item:hover {
                background: #f8f6f3 !important;
                color: #800020 !important;
                border-left-color: #800020 !important;
            }

            .account-menu-item svg {
                color: #999999 !important;
                transition: color 0.2s ease !important;
                flex-shrink: 0 !important;
                width: 18px !important;
                height: 18px !important;
            }

            .account-menu-item:hover svg {
                color: #800020 !important;
            }

            .account-menu-item span {
                flex: 1 !important;
            }

            .account-menu-primary {
                background: #800020 !important;
                color: #ffffff !important;
                margin: 8px 12px !important;
                border-radius: 6px !important;
                border-left: none !important;
                justify-content: center !important;
            }

            .account-menu-primary:hover {
                background: #600018 !important;
                border-left: none !important;
            }

            .account-menu-primary:hover .btn-text {
                color: #D4AF37 !important;
            }

            .account-menu-primary svg {
                color: #ffffff !important;
            }

            .account-menu-primary:hover svg {
                color: #D4AF37 !important;
            }

            .account-menu-logout {
                color: #c53030 !important;
            }

            .account-menu-logout:hover {
                background: #fff5f5 !important;
                color: #9b2c2c !important;
                border-left-color: #c53030 !important;
            }

            .account-menu-logout svg {
                color: #c53030 !important;
            }

            .account-menu-logout:hover svg {
                color: #9b2c2c !important;
            }

            < !-- Enhanced Dropdown Menu Styles --><style>
            /* Classic, Elegant Dropdown Menu Styling - Vertical List Layout */
            @media (min-width: 990px) {

                #siteNav>li .dropdown,
                #siteNav>li .dropdown ul {
                    background: #ffffff;
                    border: 1px solid #e8e8e8;
                    border-radius: 8px;
                    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12), 0 2px 8px rgba(0, 0, 0, 0.08);
                    padding: 12px 0;
                    margin-top: 8px;
                    min-width: 220px;
                    max-width: 280px;
                    width: auto;
                    display: block;
                    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                    backdrop-filter: blur(10px);
                    position: absolute;
                    left: 0;
                    top: 100%;
                    opacity: 0;
                    visibility: hidden;
                    transform: translateY(-10px);
                }

                #siteNav>li:hover>.dropdown {
                    opacity: 1;
                    visibility: visible;
                    transform: translateY(0);
                    top: 100%;
                }

                #siteNav>li ul.dropdown {
                    display: block;
                    list-style: none;
                    margin: 0;
                    padding: 0;
                }

                #siteNav>li ul.dropdown li {
                    border-top: none;
                    margin: 0;
                    border-radius: 0;
                    transition: all 0.2s ease;
                    display: block;
                    border-bottom: 1px solid #f0f0f0;
                }

                #siteNav>li ul.dropdown li:last-child {
                    border-bottom: none;
                }

                #siteNav>li ul.dropdown li:first-child {
                    margin-top: 0;
                }

                #siteNav>li ul.dropdown li:last-child {
                    margin-bottom: 0;
                }

                #siteNav>li ul.dropdown li a {
                    color: #2c2c2c !important;
                    background: transparent;
                    font-weight: 400;
                    font-size: 14px;
                    padding: 10px 20px;
                    border-radius: 0;
                    transition: all 0.2s ease;
                    display: block;
                    width: 100%;
                    letter-spacing: 0.3px;
                    position: relative;
                    text-align: left;
                }

                #siteNav>li ul.dropdown li a:hover,
                #siteNav>li ul.dropdown li:hover>a,
                #siteNav>li .dropdown li a:hover,
                #siteNav>li .dropdown li:hover>a,
                #siteNav>li .dropdown .site-nav:hover,
                #siteNav>li .dropdown li .site-nav:hover,
                #siteNav>li .dropdown a.site-nav:hover,
                .dropdown li a:hover,
                .dropdown li:hover>a,
                .dropdown .site-nav:hover,
                .dropdown a.site-nav:hover {
                    color: #800020 !important;
                    background: #f8f6f4 !important;
                    padding-left: 24px;
                    font-weight: 500;
                }

                /* GLOBAL BLUE COLOR REMOVAL - Replace all blue with theme color #800020 */
                /* Override all blue colors from style-min.css (#097596) */
                a:hover:not(.btn-elegant):not(.btn-get-directions),
                a:active:not(.btn-elegant):not(.btn-get-directions),
                a:focus:not(.btn-elegant):not(.btn-get-directions),
                a:visited:hover:not(.btn-elegant):not(.btn-get-directions),
                a:link:hover:not(.btn-elegant):not(.btn-get-directions),
                .site-nav:hover,
                .navigation a:hover,
                nav a:hover,
                #siteNav a:hover,
                #siteNav li a:hover,
                #siteNav>li>a:hover,
                #siteNav>li:hover>a,
                .btn:hover:not(.btn-elegant):not(.btn-get-directions),
                button:hover:not(.btn-elegant):not(.btn-get-directions),
                .link:hover,
                [class*="blue"]:not([class*="swatch"]):not([class*="color"]),
                [style*="#097596"],
                [style*="#007bff"],
                [style*="#0d6efd"] {
                    color: #800020 !important;
                    border-color: #800020 !important;
                    background-color: transparent !important;
                }

                /* Footer hover rules - Must come after global rules with higher specificity */
                html body .footer a:hover,
                html body .footer .footer-links a:hover,
                html body .footer .footer-links li a:hover,
                html body .footer .footer-contact-item a:hover,
                html body .footer .footer-contact-item:hover a,
                html body .footer .footer-bottom a:hover,
                html body .footer .footer-copyright a:hover,
                html body .footer .footer-social a:hover {
                    color: #C5A059 !important;
                }

                /* Override blue backgrounds */
                [style*="background.*#097596"],
                [style*="background.*#007bff"],
                [style*="background.*#0d6efd"],
                .btn-primary,
                .btn-primary:hover,
                .btn-primary:focus,
                .btn-primary:active,
                [class*="btn"][class*="blue"]:not([class*="swatch"]) {
                    background-color: #800020 !important;
                    border-color: #800020 !important;
                    color: #ffffff !important;
                }

                /* Override any blue colors from main CSS - More specific selectors */
                #siteNav>li .dropdown a:hover,
                #siteNav>li .dropdown a:focus,
                #siteNav>li .dropdown a:active,
                #siteNav>li .dropdown li a.site-nav:hover,
                #siteNav>li .dropdown li:hover a.site-nav,
                #siteNav>li ul.dropdown li a.site-nav:hover,
                #siteNav>li ul.dropdown li:hover a.site-nav {
                    color: #800020 !important;
                }

                /* Force override for all dropdown link states */
                #siteNav>li .dropdown a,
                #siteNav>li .dropdown .site-nav {
                    color: #2c2c2c !important;
                }

                #siteNav>li .dropdown a:hover,
                #siteNav>li .dropdown a:focus,
                #siteNav>li .dropdown .site-nav:hover,
                #siteNav>li .dropdown .site-nav:focus {
                    color: #800020 !important;
                }
            }
        </style>

        <!-- AGGRESSIVE OVERRIDE - Must be after all other styles -->
        <style>
            /* Override blue color from main CSS - Maximum specificity */
            #siteNav>li .dropdown li a.site-nav:hover,
            #siteNav>li .dropdown li:hover a.site-nav,
            #siteNav>li ul.dropdown li a.site-nav:hover,
            #siteNav>li ul.dropdown li:hover a.site-nav,
            #siteNav>li .dropdown a.site-nav:hover,
            #siteNav>li .dropdown li a:hover,
            #siteNav>li .dropdown li:hover>a,
            #siteNav>li .dropdown .site-nav:hover,
            #AccessibleNav #siteNav>li .dropdown a:hover,
            #AccessibleNav #siteNav>li .dropdown .site-nav:hover,
            .navigation #siteNav>li .dropdown a:hover,
            .navigation #siteNav>li .dropdown .site-nav:hover,
            header #siteNav>li .dropdown a:hover,
            header #siteNav>li .dropdown .site-nav:hover,
            body #siteNav>li .dropdown a:hover,
            body #siteNav>li .dropdown .site-nav:hover {
                color: #800020 !important;
            }

            /* Override any visited or active states */
            #siteNav>li .dropdown a:visited:hover,
            #siteNav>li .dropdown a:active:hover,
            #siteNav>li .dropdown .site-nav:visited:hover,
            #siteNav>li .dropdown .site-nav:active:hover {
                color: #800020 !important;
            }

            /* FINAL AGGRESSIVE OVERRIDE - Force theme color on ALL navbar main links */
            #siteNav>li.lvl1>a:hover,
            #siteNav>li.lvl1:hover>a,
            #siteNav>li.parent>a:hover,
            #siteNav>li.parent:hover>a,
            #siteNav>li:not(.dropdown)>a:hover,
            #siteNav>li:not(.dropdown):hover>a,
            body #siteNav>li.lvl1>a:hover,
            body #siteNav>li.lvl1:hover>a,
            body #siteNav>li.parent>a:hover,
            body #siteNav>li.parent:hover>a,
            html body #siteNav>li.lvl1>a:hover,
            html body #siteNav>li.lvl1:hover>a,
            html body #siteNav>li.parent>a:hover,
            html body #siteNav>li.parent:hover>a,
            html body #siteNav>li:not(.dropdown)>a:hover,
            html body #siteNav>li:not(.dropdown):hover>a {
                color: #800020 !important;
            }
        </style>

        <!-- Additional Dropdown Styles -->
        <style>
            @media (min-width: 990px) {

                /* Smooth animation on hover */
                #siteNav>li .dropdown {
                    transform: translateY(-10px);
                }

                /* Responsive adjustments for larger screens */
                @media (min-width: 1200px) {

                    #siteNav>li .dropdown,
                    #siteNav>li .dropdown ul {
                        min-width: 240px;
                        max-width: 300px;
                    }
                }
            }

            /* Mobile dropdown styling */
            @media (max-width: 989px) {
                .mobile-nav .lvl-2 {
                    background: #f8f6f4;
                    border-left: 3px solid #800020;
                    margin-left: 15px;
                    padding: 8px 0;
                    border-radius: 4px;
                }

                .mobile-nav .lvl-2 li a {
                    padding: 10px 20px;
                    color: #2c2c2c;
                    font-size: 14px;
                    transition: all 0.2s ease;
                }

                .mobile-nav .lvl-2 li a:hover {
                    color: #800020;
                    background: #ffffff;
                    padding-left: 25px;
                }
            }
        </style>

        <!--Mobile Menu-->
        <div class="mobile-nav-wrapper" role="navigation">
            <div class="closemobileMenu">Close Menu <i class="icon anm anm-times-l"></i></div>
            <ul id="MobileNav" class="mobile-nav">
                <li class="lvl1 parent "><a href="index.php">Home </a> </li>
                <li class="lvl1 parent "><a href="about.php">About Us </a> </li>

                <li class="lvl1 parent dropdown"><a href="all-category.php">shop by catalog <i
                            class="icon anm anm-angle-down-l"></i></a>
                    <ul class="lvl-2">
                        <?php $sql = mysqli_query($con, "select id,categoryName  from category");
                        while ($row = mysqli_fetch_array($sql)) {
                            ?>
                            <li><a href="category.php?cid=<?php echo $row['id']; ?>"
                                    class="site-nav"><?php echo $row['categoryName']; ?></a></li>
                        <?php } ?>
                    </ul>
                </li>
                <li class="lvl1 parent dropdown"><a href="all-category.php">new arivals <i
                            class="icon anm anm-angle-down-l"></i></a>
                    <ul class="lvl-2">
                        <?php $sql = mysqli_query($con, "select id,categoryName  from category");
                        while ($row = mysqli_fetch_array($sql)) {
                            ?>
                            <li><a href="category.php?cid=<?php echo $row['id']; ?>"
                                    class="site-nav"><?php echo $row['categoryName']; ?></a></li>
                        <?php } ?>
                    </ul>
                </li>
                <li class="lvl1 parent "><a href="contact.php">Contact Us </a> </li>
                <li class="mobile-menu-bottom">
                    <div class="mobile-links">
                        <ul class="list-inline d-inline-flex flex-column w-100">
                            <li><a href="login.php" class="d-flex align-items-center"><i
                                        class="icon anm anm-sign-in-al"></i>Sign In</a></li>
                            <li><a href="register.php" class="d-flex align-items-center"><i
                                        class="icon anm anm-user-al"></i>Register</a></li>
                            <li><a href="my-account.php" class="d-flex align-items-center"><i
                                        class="icon anm anm-user-cil"></i>My Account</a></li>
                            <li><a href="logout.php" class="d-flex align-items-center"><i
                                        class="icon anm anm-sign-in-al"></i>Sign Out</a></li>
                            <li class="title h5">Need Help?</li>
                            <li><a href="tel:8826446755" class="d-flex align-items-center"><i
                                        class="icon anm anm-phone-l"></i> +91-8826446755</a></li>
                            <li><a href="mailto:Info@nari18.com" class="d-flex align-items-center"><i
                                        class="icon anm anm-envelope-l"></i> Info@nari18.com</a>, <a
                                    href="mailto:richa@nari18.com" class="d-flex align-items-center"><i
                                        class="icon anm anm-envelope-l"></i> richa@nari18.com</a></li>
                        </ul>
                    </div>
                    <div class="mobile-follow mt-2">
                        <h5 class="title">Follow Us</h5>
                        <ul class="list-inline social-icons d-inline-flex mt-1">
                            <li class="list-inline-item"><a href="#" title="Facebook"><i
                                        class="icon anm anm-facebook-f"></i></a></li>
                            <li class="list-inline-item"><a href="#" title="Twitter"><i
                                        class="icon anm anm-twitter"></i></a></li>
                            <li class="list-inline-item"><a href="#" title="Pinterest"><i
                                        class="icon anm anm-pinterest-p"></i></a></li>
                            <li class="list-inline-item"><a href="#" title="Linkedin"><i
                                        class="icon anm anm-linkedin-in"></i></a></li>
                            <li class="list-inline-item"><a href="#" title="Instagram"><i
                                        class="icon anm anm-instagram"></i></a></li>
                            <li class="list-inline-item"><a href="#" title="Youtube"><i
                                        class="icon anm anm-youtube"></i></a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
        <!--End Mobile Menu-->

        <!-- Navbar Scroll Effect Script -->
        <script>
            // Navbar scroll effect
            window.addEventListener('scroll', function () {
                const header = document.getElementById('mainHeader');
                if (window.scrollY > 50) {
                    header.classList.add('scrolled');
                } else {
                    header.classList.remove('scrolled');
                }
            });

            // AGGRESSIVE: Force theme color on ALL navbar links
            document.addEventListener('DOMContentLoaded', function () {
                // Force ALL navbar main links (Home, About Us, Contact Us, etc.) - More comprehensive selector
                const navLinks = document.querySelectorAll('#siteNav > li > a, #siteNav li.lvl1 > a, #siteNav li.parent > a, #siteNav li a, .navigation #siteNav li > a');

                navLinks.forEach(function (link) {
                    // Force color with !important via setProperty
                    link.addEventListener('mouseenter', function () {
                        this.style.setProperty('color', '#800020', 'important');
                    });

                    link.addEventListener('mouseleave', function () {
                        this.style.setProperty('color', '#2c2c2c', 'important');
                    });

                    // Also add CSS class for additional control
                    link.classList.add('theme-hover-link');
                });

                // Force dropdown links
                const dropdownLinks = document.querySelectorAll('#siteNav .dropdown a, #siteNav .dropdown .site-nav');

                dropdownLinks.forEach(function (link) {
                    link.addEventListener('mouseenter', function () {
                        this.style.setProperty('color', '#800020', 'important');
                    });

                    link.addEventListener('mouseleave', function () {
                        this.style.setProperty('color', '#2c2c2c', 'important');
                    });
                });

                // Add ULTRA AGGRESSIVE global style override with maximum specificity
                const style = document.createElement('style');
                style.id = 'navbar-theme-override';
                style.textContent = `
                        /* ULTRA AGGRESSIVE - Force navbar main links */
                        #siteNav > li > a:hover,
                        #siteNav > li:hover > a,
                        #siteNav > li.lvl1 > a:hover,
                        #siteNav > li.lvl1:hover > a,
                        #siteNav > li.parent > a:hover,
                        #siteNav > li.parent:hover > a,
                        #siteNav > li:not(.dropdown) > a:hover,
                        #siteNav > li:not(.dropdown):hover > a,
                        #siteNav li a:hover,
                        #siteNav li:hover > a,
                        .theme-hover-link:hover,
                        body #siteNav > li > a:hover,
                        body #siteNav > li:hover > a,
                        html body #siteNav > li > a:hover,
                        html body #siteNav > li:hover > a,
                        html body #siteNav > li.lvl1 > a:hover,
                        html body #siteNav > li.lvl1:hover > a,
                        html body #siteNav > li.parent > a:hover,
                        html body #siteNav > li.parent:hover > a {
                            color: #800020 !important;
                        }
                        
                        /* Force dropdown links */
                        #siteNav .dropdown a:hover,
                        #siteNav .dropdown .site-nav:hover,
                        #siteNav .dropdown li:hover a,
                        #siteNav .dropdown li:hover .site-nav {
                            color: #800020 !important;
                        }
                    `;
                document.head.appendChild(style);
            });

            // GLOBAL BLUE COLOR REMOVAL - JavaScript override
            document.addEventListener('DOMContentLoaded', function () {
                // Add global style to override all blue colors
                const blueRemovalStyle = document.createElement('style');
                blueRemovalStyle.id = 'blue-color-removal';
                blueRemovalStyle.textContent = `
                        /* GLOBAL BLUE COLOR REMOVAL - Replace ALL blue with theme color #800020 */
                        :root {
                            --bs-blue: #800020 !important;
                            --bs-primary: #800020 !important;
                            --bs-primary-rgb: 128, 0, 32 !important;
                        }
                        
                        /* Override all link hover colors */
                        html body a:hover:not(.btn-elegant):not(.btn-get-directions),
                        html body a:active:not(.btn-elegant):not(.btn-get-directions),
                        html body a:focus:not(.btn-elegant):not(.btn-get-directions),
                        html body a:visited:hover:not(.btn-elegant):not(.btn-get-directions),
                        html body .site-nav:hover,
                        html body .navigation a:hover,
                        html body nav a:hover,
                        html body #siteNav a:hover,
                        html body #siteNav li a:hover,
                        html body #siteNav > li > a:hover,
                        html body #siteNav > li:hover > a,
                        html body .btn:hover:not(.btn-success):not(.btn-danger):not(.btn-warning):not(.btn-info):not(.btn-elegant):not(.btn-get-directions),
                        html body button:hover:not(.btn-success):not(.btn-danger):not(.btn-warning):not(.btn-info):not(.btn-elegant):not(.btn-get-directions),
                        html body .link:hover {
                            color: #800020 !important;
                            border-color: #800020 !important;
                        }
                        
                        /* Footer hover rules - Must come after global rules with higher specificity */
                        html body .footer a:hover,
                        html body .footer .footer-links a:hover,
                        html body .footer .footer-links li a:hover,
                        html body .footer .footer-contact-item a:hover,
                        html body .footer .footer-contact-item:hover a,
                        html body .footer .footer-bottom a:hover,
                        html body .footer .footer-copyright a:hover,
                        html body .footer .footer-social a:hover {
                            color: #C5A059 !important;
                        }
                        
                        /* Override Bootstrap primary/blue buttons */
                        html body .btn-primary,
                        html body .btn-primary:hover,
                        html body .btn-primary:focus,
                        html body .btn-primary:active,
                        html body [class*="btn-primary"],
                        html body [class*="primary"]:not([class*="swatch"]):not([class*="color"]) {
                            background-color: #800020 !important;
                            border-color: #800020 !important;
                            color: #ffffff !important;
                        }
                        
                        /* Override specific blue color codes from style-min.css */
                        html body [style*="#097596"],
                        html body [style*="#007bff"],
                        html body [style*="#0d6efd"],
                        html body [style*="#0066cc"] {
                            color: #800020 !important;
                            border-color: #800020 !important;
                            background-color: transparent !important;
                        }
                    `;

                // Remove existing style if present
                const existingStyle = document.getElementById('blue-color-removal');
                if (existingStyle) {
                    existingStyle.remove();
                }

                document.head.appendChild(blueRemovalStyle);
            });
        </script>

        <!-- GLOBAL BLUE COLOR REMOVAL STYLESHEET - Load after all other CSS -->
        <style id="global-blue-removal">
            /* COMPREHENSIVE BLUE COLOR REMOVAL */
            /* This overrides ALL blue colors from style-min.css and plugins.css */

            /* Override :root CSS variables */
            :root {
                --bs-blue: #800020 !important;
                --bs-primary: #800020 !important;
                --bs-primary-rgb: 128, 0, 32 !important;
            }

            /* Override all anchor tag hover states (main source: style-min.css line 223, 228) */
            html body a:hover:not(.btn-elegant):not(.btn-get-directions),
            html body a:active:not(.btn-elegant):not(.btn-get-directions),
            html body a:focus:not(.btn-elegant):not(.btn-get-directions) {
                color: #800020 !important;
            }

            /* Footer hover rules - Must come after global rules with higher specificity */
            html body .footer a:hover,
            html body .footer .footer-links a:hover,
            html body .footer .footer-links li a:hover,
            html body .footer .footer-contact-item a:hover,
            html body .footer .footer-contact-item:hover a,
            html body .footer .footer-bottom a:hover,
            html body .footer .footer-copyright a:hover,
            html body .footer .footer-social a:hover {
                color: #C5A059 !important;
            }

            /* Override Bootstrap primary buttons */
            html body .btn-primary,
            html body .btn-primary:hover,
            html body .btn-primary:focus,
            html body .btn-primary:active,
            html body .btn-primary:not(:disabled):not(.disabled):active {
                background-color: #800020 !important;
                border-color: #800020 !important;
                color: #ffffff !important;
            }

            /* Override any element with blue color in inline styles */
            html body [style*="color: #097596"],
            html body [style*="color:#097596"],
            html body [style*="color: #007bff"],
            html body [style*="color:#007bff"],
            html body [style*="color: #0d6efd"],
            html body [style*="color:#0d6efd"] {
                color: #800020 !important;
            }

            /* Override any element with blue background in inline styles */
            html body [style*="background: #097596"],
            html body [style*="background:#097596"],
            html body [style*="background-color: #097596"],
            html body [style*="background-color:#097596"],
            html body [style*="background: #007bff"],
            html body [style*="background:#007bff"],
            html body [style*="background-color: #007bff"],
            html body [style*="background-color:#007bff"] {
                background-color: #800020 !important;
            }

            /* Override any element with blue border in inline styles */
            html body [style*="border-color: #097596"],
            html body [style*="border-color:#097596"],
            html body [style*="border: #097596"],
            html body [style*="border:#097596"] {
                border-color: #800020 !important;
            }
        </style>

        <!-- Add to Cart Success Modal -->
        <?php
        $show_modal = isset($_SESSION['show_cart_modal']) && $_SESSION['show_cart_modal'] == true;
        $modal_product = isset($_SESSION['last_added_product']) ? $_SESSION['last_added_product'] : null;
        if (isset($_SESSION['show_cart_modal'])) {
            // Clear the flag immediately so it doesn't show on next reload
            unset($_SESSION['show_cart_modal']);
        }
        ?>
        <link
            href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Inter:wght@300;400;500;600&display=swap"
            rel="stylesheet" />
        <link
            href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"
            rel="stylesheet" />

        <style>
            .btn-quickview-modern {
                position: absolute;
                top: 60px;
                right: 12px;
                width: 40px;
                height: 40px;
                background: rgba(255, 255, 255, 0.95);
                color: #800020;
                border: 1px solid rgba(128, 0, 32, 0.2);
                border-radius: 50%;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                opacity: 0;
                transform: scale(0.8);
                transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
                cursor: pointer;
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
                z-index: 10;
                padding: 0;
            }

            .product-box-modern:hover .btn-quickview-modern,
            .product-card-wrapper:hover .btn-quickview-modern {
                opacity: 1;
                transform: scale(1);
            }

            .btn-quickview-modern:hover {
                background: rgba(255, 255, 255, 0.95) !important;
                border-color: #800020 !important;
                color: #800020 !important;
                transform: scale(1.15) !important;
                box-shadow: 0 4px 12px rgba(128, 0, 32, 0.15) !important;
            }

            .btn-quickview-modern span {
                font-size: 20px !important;
                line-height: 1 !important;
            }
        </style>


        <!-- Cart Modal Removed - Replaced with Minicart Sidebar -->

        <script>
            // Show modal if flag is set
            <?php if ($show_modal): ?>
                document.addEventListener('DOMContentLoaded', function () {
                    // Open the minicart drawer using Bootstrap Offcanvas API
                    var minicartElement = document.getElementById('minicart-drawer');
                    if (minicartElement) {
                        var bsOffcanvas = new bootstrap.Offcanvas(minicartElement);
                        bsOffcanvas.show();
                    }
                });
            <?php endif; ?>

            // Removed showCartModal function as we are now using the sidebar



            // Close modal when clicking outside


            // Close modal with Escape key
            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape') {
                    closeCartModal();
                }
            });

            // Force yellow hover on checkout button - AGGRESSIVE STYLING
            document.addEventListener('DOMContentLoaded', function () {
                function applyYellowHover() {
                    const checkoutButtons = document.querySelectorAll('.cart-modal-btn-checkout, a.cart-modal-btn-checkout');
                    checkoutButtons.forEach(function (button) {
                        button.addEventListener('mouseenter', function () {
                            this.style.setProperty('color', '#C5A059', 'important');
                        });
                        button.addEventListener('mouseleave', function () {
                            this.style.setProperty('color', '#ffffff', 'important');
                        });
                        button.addEventListener('focus', function () {
                            this.style.setProperty('color', '#C5A059', 'important');
                        });
                        button.addEventListener('blur', function () {
                            this.style.setProperty('color', '#ffffff', 'important');
                        });
                    });
                }

                // Apply immediately
                applyYellowHover();

                // Re-apply when modal is shown (in case button is added dynamically)
                const originalShowCartModal = window.showCartModal;
                if (originalShowCartModal) {
                    window.showCartModal = function () {
                        originalShowCartModal();
                        setTimeout(applyYellowHover, 100);
                    };
                }
            });

            // Intercept add to cart links and show sidebar via AJAX
            document.addEventListener('DOMContentLoaded', function () {
                const cartButtons = document.querySelectorAll('a[href*="action=add"], .btn-cart-modern[href*="action=add"]');

                cartButtons.forEach(function (button) {
                    // Skip disabled buttons
                    if (button.classList.contains('disabled') || button.style.cursor === 'not-allowed') {
                        return;
                    }

                    button.addEventListener('click', function (e) {
                        e.preventDefault();
                        e.stopPropagation();

                        // Get product ID from URL
                        const url = new URL(this.href, window.location.origin);
                        const productId = url.searchParams.get('id');

                        if (!productId) {
                            window.location.href = this.href;
                            return;
                        }

                        // Add to cart via AJAX
                        fetch('add-to-cart-ajax.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded',
                            },
                            body: 'id=' + productId
                        })
                            .then(response => response.json())
                            .then(data => {
                                if (data.status === 'success') {
                                    // Update cart count badge
                                    const badge = document.getElementById('cart-count-badge');
                                    if (badge) badge.textContent = data.count;

                                    // Refresh minicart content and open sidebar
                                    const cartDrawerContent = document.getElementById('cart-drawer');
                                    if (cartDrawerContent) {
                                        fetch('fetch-minicart.php')
                                            .then(response => response.text())
                                            .then(html => {
                                                cartDrawerContent.innerHTML = html;

                                                // Open the minicart drawer
                                                const minicartElement = document.getElementById('minicart-drawer');
                                                if (minicartElement) {
                                                    const bsOffcanvas = bootstrap.Offcanvas.getInstance(minicartElement) || new bootstrap.Offcanvas(minicartElement);
                                                    bsOffcanvas.show();
                                                }
                                            });
                                    }
                                } else {
                                    console.error('Error adding to cart:', data.message);
                                    // Fallback to normal behavior if AJAX fails
                                    window.location.href = this.href;
                                }
                            })
                            .catch(error => {
                                console.error('Fetch error:', error);
                                window.location.href = this.href;
                            });
                    });
                });
            });
        </script>