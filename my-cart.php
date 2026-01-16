<?php 
session_start();
error_reporting(0);
include('includes/config.php');

/* ========= AJAX: update quantity instantly (min=1) ========= */
if (isset($_POST['ajax']) && $_POST['ajax']==='1' && isset($_POST['action']) && $_POST['action']==='update_qty') {
    header('Content-Type: application/json');
    $pid = intval($_POST['pid'] ?? 0);
    $qty = intval($_POST['qty'] ?? 0);

    if ($pid <= 0) {
        echo json_encode(['ok'=>false,'msg'=>'Invalid product']); exit;
    }

    // Enforce min 1 server-side
    if ($qty < 1) { $qty = 1; }

    if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];
    if (!isset($_SESSION['cart'][$pid])) {
        $_SESSION['cart'][$pid] = ['quantity'=>$qty];
    } else {
        $_SESSION['cart'][$pid]['quantity'] = $qty;
    }

    // Recalculate totals
    $totalprice = 0.0;
    $totalqunty = 0;
    $shipingcharge = 0.0;
    $lineTotal = 0.0;

    if (!empty($_SESSION['cart'])) {
        $ids = array_map('intval', array_keys($_SESSION['cart']));
        if ($ids) {
            $in = implode(',', $ids);
            $sql = "SELECT id, productPrice, shippingCharge FROM products WHERE id IN($in)";
            $res = mysqli_query($con, $sql);
            $priceMap = [];
            $shipMap = [];
            while ($r = mysqli_fetch_assoc($res)) {
                $priceMap[$r['id']] = (float)$r['productPrice'];
                $shipMap[$r['id']]  = (float)$r['shippingCharge'];
            }

            foreach ($_SESSION['cart'] as $id => $entry) {
                $q = max(1, (int)$entry['quantity']); // safety
                $p = (float)($priceMap[$id] ?? 0);
                $totalqunty += $q;
                $subtotal = $q * $p;
                $totalprice += $subtotal;
                $shipingcharge = (float)($shipMap[$id] ?? $shipingcharge);
                if ($id == $pid) $lineTotal = $subtotal;
            }
        }
    }

    $tax = round($totalprice * 18 / 100, 2);
    $grand = round($totalprice + $tax + (float)$shipingcharge, 2);

    $_SESSION['qnty'] = $totalqunty;
    $_SESSION['tp']   = number_format($totalprice, 2);

    echo json_encode([
        'ok'=>true,
        'pid'=>$pid,
        'qty'=>$qty,
        'line_total'=>number_format($lineTotal, 2),
        'subtotal'=>number_format($totalprice, 2),
        'tax'=>number_format($tax, 2),
        'shipping'=>number_format((float)$shipingcharge, 2),
        'grand'=>number_format($grand, 2),
        'cart_count'=>$totalqunty
    ]);
    exit;
}

/* ========= AJAX: remove product instantly ========= */
if (isset($_POST['ajax']) && $_POST['ajax']==='1' && isset($_POST['action']) && $_POST['action']==='remove_item') {
    header('Content-Type: application/json');
    $pid = intval($_POST['pid'] ?? 0);

    if ($pid <= 0) {
        echo json_encode(['ok'=>false,'msg'=>'Invalid product']); exit;
    }

    if (isset($_SESSION['cart'][$pid])) {
        unset($_SESSION['cart'][$pid]);
    }

    // Recalculate totals
    $totalprice = 0.0;
    $totalqunty = 0;
    $shipingcharge = 0.0;

    if (!empty($_SESSION['cart'])) {
        $ids = array_map('intval', array_keys($_SESSION['cart']));
        if ($ids) {
            $in = implode(',', $ids);
            $sql = "SELECT id, productPrice, shippingCharge FROM products WHERE id IN($in)";
            $res = mysqli_query($con, $sql);
            $priceMap = [];
            $shipMap = [];
            while ($r = mysqli_fetch_assoc($res)) {
                $priceMap[$r['id']] = (float)$r['productPrice'];
                $shipMap[$r['id']]  = (float)$r['shippingCharge'];
            }

            foreach ($_SESSION['cart'] as $id => $entry) {
                $q = max(1, (int)$entry['quantity']);
                $p = (float)($priceMap[$id] ?? 0);
                $totalqunty += $q;
                $subtotal = $q * $p;
                $totalprice += $subtotal;
                $shipingcharge = (float)($shipMap[$id] ?? $shipingcharge);
            }
        }
    }

    $tax = round($totalprice * 18 / 100, 2);
    $grand = round($totalprice + $tax + (float)$shipingcharge, 2);

    $_SESSION['qnty'] = $totalqunty;
    $_SESSION['tp']   = number_format($totalprice, 2);

    echo json_encode([
        'ok'=>true,
        'pid'=>$pid,
        'subtotal'=>number_format($totalprice, 2),
        'tax'=>number_format($tax, 2),
        'shipping'=>number_format((float)$shipingcharge, 2),
        'grand'=>number_format($grand, 2),
        'cart_count'=>$totalqunty,
        'cart_empty'=>empty($_SESSION['cart'])
    ]);
    exit;
}
/* ========= end AJAX ========= */

if(isset($_POST['submit'])){
    if(!empty($_SESSION['cart'])){
        foreach($_POST['quantity'] as $key => $val){
            $val = (int)$val;
            if ($val < 1) $val = 1; // min 1 on legacy submit
            $_SESSION['cart'][$key]['quantity']=$val;
        }
        echo "<script>alert('Your Cart has been Updated');</script>";
    }
}

// Remove product(s)
if(isset($_POST['remove_code'])) {
    if(!empty($_SESSION['cart'])){
        foreach($_POST['remove_code'] as $key){
            unset($_SESSION['cart'][$key]);
        }
        echo "<script>alert('Your Cart has been Updated');</script>";
    }
}

// Place order
if(isset($_POST['ordersubmit'])) {
    if(strlen($_SESSION['login'])==0){   
        header('location:login.php');
    } else {
        $quantity=$_POST['quantity'];
        $pdd=$_SESSION['pid'];
        $quantity = array_map(function($v){ $v=(int)$v; return $v<1?1:$v; }, $quantity);
        $value=array_combine($pdd,$quantity);
        $_SESSION['order_data'] = $value;
        $grandtotal = $_POST['grandtotal'];
        $_SESSION['grandtotal_data'] = $grandtotal;
        header('Location: pay.php');
    }
}

// Billing update
if(isset($_POST['update'])) {
    $baddress=$_POST['billingaddress'];
    $bstate=$_POST['bilingstate'];
    $bcity=$_POST['billingcity'];
    $bpincode=$_POST['billingpincode'];
    $query=mysqli_query($con,"update users set billingAddress='$baddress',billingState='$bstate',billingCity='$bcity',billingPincode='$bpincode' where id='".$_SESSION['id']."'");
    if($query) { echo "<script>alert('Billing Address has been updated');</script>"; }
}

// Shipping update
if(isset($_POST['shipupdate'])) {
    $saddress=$_POST['shippingaddress'];
    $sstate=$_POST['shippingstate'];
    $scity=$_POST['shippingcity'];
    $spincode=$_POST['shippingpincode'];
    $query=mysqli_query($con,"update users set shippingAddress='$saddress',shippingState='$sstate',shippingCity='$scity',shippingPincode='$spincode' where id='".$_SESSION['id']."'");
    if($query) { echo "<script>alert('Shipping Address has been updated');</script>"; }
}
?>
<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Nari18 | Premium Boutique - Shopping Cart</title>
    <link rel="shortcut icon" href="assets/images/favicon.png" />
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Montserrat:wght@300;400;500;600&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet"/>
    <!-- Font Awesome for Footer Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Plugins CSS for Footer compatibility -->
    <link rel="stylesheet" href="assets/css/plugins.css">
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        primary: "#800020",
                        secondary: "#D4AF37",
                        "background-light": "#F9F7F2",
                        "background-dark": "#121212",
                    },
                    fontFamily: {
                        display: ["Playfair Display", "serif"],
                        sans: ["Montserrat", "sans-serif"],
                    },
                    borderRadius: {
                        DEFAULT: "4px",
                    },
                },
            },
        };
    </script>
    <style>
        /* Override any conflicting styles - Cart Page Specific */
        body.cart-page {
            font-family: 'Montserrat', sans-serif !important;
            background-color: #F9F7F2 !important;
            color: #1e293b !important;
        }
        body.cart-page.dark {
            background-color: #121212 !important;
            color: #f1f5f9 !important;
        }
        .cart-page h1, .cart-page h2, .cart-page h3, .cart-page .serif-font {
            font-family: 'Playfair Display', serif !important;
        }
        /* Main content area styling */
        .cart-page main {
            background-color: #F9F7F2 !important;
        }
        .cart-page.dark main {
            background-color: #121212 !important;
        }
        /* Header styling */
        .cart-page header {
            background: rgba(255, 255, 255, 0.8) !important;
            backdrop-filter: blur(12px) !important;
        }
        .cart-page.dark header {
            background: rgba(24, 24, 27, 0.8) !important;
        }
        /* Input elegant styling */
        .input-elegant {
            background-color: transparent !important;
            border-top: none !important;
            border-left: none !important;
            border-right: none !important;
            border-bottom: 1px solid #d1d5db !important;
            transition: border-color 0.3s ease;
            border-radius: 0 !important;
        }
        .input-elegant:focus {
            border-bottom: 2px solid #800020 !important;
            outline: none !important;
            box-shadow: none !important;
        }
        .dark .input-elegant {
            border-bottom-color: #4b5563 !important;
            color: #e2e8f0 !important;
        }
        .dark .input-elegant:focus {
            border-bottom-color: #D4AF37 !important;
        }
        .dark .input-elegant::placeholder {
            color: #9ca3af !important;
        }
        /* Primary color overrides */
        .cart-page .bg-primary {
            background-color: #800020 !important;
        }
        .cart-page .text-primary {
            color: #800020 !important;
        }
        .cart-page .border-primary {
            border-color: #800020 !important;
        }
        .cart-page .hover\:text-primary:hover {
            color: #800020 !important;
        }
        .cart-page .hover\:bg-primary:hover {
            background-color: #800020 !important;
        }
        /* Secondary color overrides for dark mode */
        .cart-page.dark .text-secondary,
        .cart-page.dark .dark\:text-secondary {
            color: #D4AF37 !important;
        }
        .cart-page.dark .border-secondary,
        .cart-page.dark .dark\:border-secondary {
            border-color: #D4AF37 !important;
        }
        .cart-page.dark .hover\:text-secondary:hover,
        .cart-page.dark .dark\:hover\:text-secondary:hover {
            color: #D4AF37 !important;
        }
        /* Cart table styling */
        .cart-page table {
            background-color: transparent !important;
        }
        .cart-page .divide-stone-100 > * + * {
            border-color: rgba(245, 245, 244, 1) !important;
        }
        .cart-page.dark .divide-stone-800 > * + * {
            border-color: rgba(41, 37, 36, 1) !important;
        }
        /* Order summary card */
        .cart-page .bg-white {
            background-color: #ffffff !important;
        }
        .cart-page.dark .dark\:bg-zinc-900 {
            background-color: #18181b !important;
        }
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        ::-webkit-scrollbar-thumb {
            background: #800020;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #600018;
        }
        /* Quantity buttons animation */
        .qty-btn:active {
            transform: scale(0.95);
        }
        /* Product image hover effect */
        .product-img-wrapper:hover img {
            filter: grayscale(0);
        }
        /* Smooth transitions */
        .transition-smooth {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        /* Stone colors for text */
        .cart-page .text-stone-400 {
            color: #a8a29e !important;
        }
        .cart-page .text-stone-500 {
            color: #78716c !important;
        }
        .cart-page .text-stone-600 {
            color: #57534e !important;
        }
        .cart-page .text-stone-800 {
            color: #292524 !important;
        }
        .cart-page.dark .dark\:text-stone-400 {
            color: #a8a29e !important;
        }
        /* Border colors */
        .cart-page .border-stone-100 {
            border-color: #f5f5f4 !important;
        }
        .cart-page .border-stone-200 {
            border-color: #e7e5e4 !important;
        }
        .cart-page.dark .dark\:border-stone-800 {
            border-color: #292524 !important;
        }
        /* Ensure checkout button has correct colors */
        .cart-page button[name="ordersubmit"],
        .cart-page .checkout-btn {
            background-color: #800020 !important;
            border-color: #800020 !important;
            color: #ffffff !important;
        }
        .cart-page button[name="ordersubmit"]:hover,
        .cart-page .checkout-btn:hover {
            background-color: #ffffff !important;
            color: #800020 !important;
        }
        .cart-page.dark button[name="ordersubmit"],
        .cart-page.dark .checkout-btn {
            background-color: transparent !important;
            border-color: #D4AF37 !important;
            color: #D4AF37 !important;
        }
        .cart-page.dark button[name="ordersubmit"]:hover,
        .cart-page.dark .checkout-btn:hover {
            background-color: #D4AF37 !important;
            color: #000000 !important;
        }
    </style>
</head>
<body class="cart-page bg-background-light dark:bg-background-dark text-slate-800 dark:text-slate-100 min-h-screen transition-colors duration-300">

<!-- Header -->
<header class="border-b border-stone-200 dark:border-stone-800 bg-white/80 dark:bg-zinc-900/80 backdrop-blur-md sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
        <div class="flex items-center space-x-12">
            <a class="text-2xl font-display font-bold tracking-tighter text-primary dark:text-secondary" href="index.php">
                <img src="assets/images/logo.png" alt="Nari18" title="Nari18" class="h-10 dark:brightness-110" />
            </a>
            <nav class="hidden lg:flex space-x-8 text-[11px] font-semibold tracking-[0.2em] uppercase text-stone-600 dark:text-stone-400">
                <a class="hover:text-primary dark:hover:text-secondary transition-colors" href="index.php">Home</a>
                <a class="hover:text-primary dark:hover:text-secondary transition-colors" href="about.php">About Us</a>
                <a class="hover:text-primary dark:hover:text-secondary transition-colors" href="all-category.php">Shop Catalog</a>
                <a class="hover:text-primary dark:hover:text-secondary transition-colors" href="all-category.php">New Arrivals</a>
            </nav>
        </div>
        <div class="flex items-center space-x-6 text-stone-600 dark:text-stone-400">
            <a href="search-result.php" class="hover:text-primary dark:hover:text-secondary transition-colors"><span class="material-symbols-outlined">search</span></a>
            <a href="my-account.php" class="hover:text-primary dark:hover:text-secondary transition-colors"><span class="material-symbols-outlined">person</span></a>
            <a href="my-cart.php" class="hover:text-primary dark:hover:text-secondary transition-colors relative">
                <span class="material-symbols-outlined">shopping_bag</span>
                <span class="absolute -top-1 -right-1 bg-primary text-white text-[10px] w-4 h-4 rounded-full flex items-center justify-center" id="header-cart-count"><?php echo isset($_SESSION['qnty']) ? $_SESSION['qnty'] : 0; ?></span>
            </a>
        </div>
    </div>
</header>

<!-- Main Content -->
<main class="max-w-7xl mx-auto px-6 py-12">
    <h1 class="text-4xl font-display mb-12 text-center lg:text-left">Your Shopping Cart</h1>
    
    <form method="post" id="cartForm">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
        <!-- Left Column - Cart Items & Address Forms -->
        <div class="lg:col-span-8">
            <?php if(!empty($_SESSION['cart'])){ ?>
            <!-- Cart Table -->
            <div class="overflow-x-auto mb-16">
                <table class="w-full text-left" id="cartTable">
                    <thead class="border-b border-stone-200 dark:border-stone-800">
                        <tr class="text-[11px] font-semibold uppercase tracking-[0.2em] text-stone-400 pb-4">
                            <th class="pb-4 font-normal">Product</th>
                            <th class="pb-4 font-normal text-center">Price</th>
                            <th class="pb-4 font-normal text-center">Quantity</th>
                            <th class="pb-4 font-normal text-right">Subtotal</th>
                            <th class="pb-4 font-normal text-right"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-stone-100 dark:divide-stone-800">
                        <?php
                            $pdtid=array();
                            $sql = "SELECT * FROM products WHERE id IN(";
                            foreach($_SESSION['cart'] as $id => $value){
                                $sql .=$id. ",";
                            }
                            $sql=substr($sql,0,-1) . ") ORDER BY id ASC";
                            $query = mysqli_query($con,$sql);
                            $totalprice=0;
                            $totalqunty=0;
                            $shipingcharge=0;
                            if(!empty($query)){
                                while($row = mysqli_fetch_array($query)){
                                    $qty = max(1,(int)$_SESSION['cart'][$row['id']]['quantity']);
                                    $_SESSION['cart'][$row['id']]['quantity'] = $qty;
                                    $subtotal= $qty * (float)$row['productPrice'];
                                    $shipingcharge = (float)$row['shippingCharge'];
                                    $totalprice += $subtotal;
                                    $tax = $totalprice*18/100;
                                    $_SESSION['qnty']=$totalqunty+=$qty;
                                    array_push($pdtid,$row['id']);
                        ?>
                        <tr class="cart-row" data-pid="<?php echo $row['id']; ?>" id="row-<?php echo $row['id']; ?>">
                            <td class="py-8">
                                <div class="flex items-center space-x-6">
                                    <div class="w-24 h-32 bg-stone-100 dark:bg-stone-800 flex-shrink-0 overflow-hidden product-img-wrapper">
                                        <a href="product-details.php?pid=<?php echo $row['id'];?>">
                                            <img alt="<?php echo htmlspecialchars($row['productName']); ?>" 
                                                 class="w-full h-full object-cover grayscale-[0.2] hover:grayscale-0 transition-all" 
                                                 src="admin/productimages/<?php echo $row['id'];?>/<?php echo $row['productImage1'];?>" />
                                        </a>
                                    </div>
                                    <div>
                                        <a href="product-details.php?pid=<?php echo $row['id'];?>">
                                            <h3 class="font-display text-lg mb-1 hover:text-primary dark:hover:text-secondary transition-colors"><?php echo $row['productName']; ?></h3>
                                        </a>
                                        <p class="text-[11px] text-stone-500 uppercase tracking-widest"><?php echo $row['productCategory'] ?? 'Premium Collection'; ?></p>
                                    </div>
                                </div>
                            </td>
                            <td class="py-8 text-center text-sm">Rs: <?php echo number_format($row['productPrice'], 2); ?></td>
                            <td class="py-8">
                                <div class="flex items-center justify-center">
                                    <div class="flex border border-stone-200 dark:border-stone-700 items-center">
                                        <button type="button" class="qty-btn px-3 py-1 hover:bg-stone-50 dark:hover:bg-stone-800 transition-colors" data-role="minus" data-pid="<?php echo $row['id']; ?>">
                                            <span class="material-symbols-outlined text-sm">remove</span>
                                        </button>
                                        <input type="text" 
                                               class="w-12 text-center text-sm bg-transparent border-none focus:ring-0 qty-input" 
                                               value="<?php echo (int)$_SESSION['cart'][$row['id']]['quantity']; ?>" 
                                               name="quantity[<?php echo $row['id']; ?>]" 
                                               pattern="[0-9]*"
                                               inputmode="numeric"
                                               data-pid="<?php echo $row['id']; ?>"
                                               id="qty-<?php echo $row['id']; ?>" />
                                        <button type="button" class="qty-btn px-3 py-1 hover:bg-stone-50 dark:hover:bg-stone-800 transition-colors" data-role="plus" data-pid="<?php echo $row['id']; ?>">
                                            <span class="material-symbols-outlined text-sm">add</span>
                                        </button>
                                    </div>
                                </div>
                            </td>
                            <td class="py-8 text-right font-medium" id="line-total-<?php echo $row['id']; ?>">Rs: <?php echo number_format($_SESSION['cart'][$row['id']]['quantity']*$row['productPrice'],2); ?></td>
                            <td class="py-8 text-right pl-4">
                                <button type="button" class="remove-item text-stone-300 hover:text-red-600 transition-colors" data-pid="<?php echo $row['id']; ?>" title="Remove item">
                                    <span class="material-symbols-outlined">close</span>
                                </button>
                            </td>
                        </tr>
                        <?php } } 
                            $_SESSION['pid']=$pdtid;
                        ?>
                    </tbody>
                </table>
                
                <!-- Cart Actions -->
                <div class="mt-8 flex flex-col sm:flex-row justify-between items-center gap-4">
                    <a href="index.php" class="text-[11px] font-semibold uppercase tracking-widest flex items-center group transition-colors hover:text-primary dark:hover:text-secondary">
                        <span class="material-symbols-outlined text-sm mr-2 transition-transform group-hover:-translate-x-1">arrow_back</span>
                        Continue Shopping
                    </a>
                    <button type="submit" name="submit" class="text-[11px] font-semibold uppercase tracking-widest border border-primary text-primary dark:text-secondary dark:border-secondary px-6 py-2 hover:bg-primary hover:text-white dark:hover:bg-secondary dark:hover:text-black transition-all">
                        Update Cart
                    </button>
                </div>
            </div>
            
            <!-- Billing & Shipping Forms -->
            <?php
            $query=mysqli_query($con,"select * from users where id='".$_SESSION['id']."'");
            while($row=mysqli_fetch_array($query))
            {
            ?>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-16">
                <!-- Billing Details -->
                <div class="space-y-8">
                    <h2 class="text-xl font-display uppercase tracking-widest border-b border-stone-200 dark:border-stone-800 pb-4">Billing Details</h2>
                    <div class="space-y-6">
                        <div>
                            <label class="block text-[10px] font-bold uppercase tracking-widest text-stone-400 mb-1">Full Name *</label>
                            <input class="w-full input-elegant text-sm py-2 px-0" type="text" name="fullname" value="<?php echo $row['name'];?>" readonly />
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold uppercase tracking-widest text-stone-400 mb-1">Address *</label>
                            <input class="w-full input-elegant text-sm py-2 px-0" type="text" name="billingaddress" id="billingaddress" placeholder="Billing Address" value="<?php echo $row['billingAddress'];?>" />
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-[10px] font-bold uppercase tracking-widest text-stone-400 mb-1">State</label>
                                <input class="w-full input-elegant text-sm py-2 px-0" type="text" name="bilingstate" id="bilingstate" placeholder="State" value="<?php echo $row['billingState'];?>" />
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold uppercase tracking-widest text-stone-400 mb-1">City</label>
                                <input class="w-full input-elegant text-sm py-2 px-0" type="text" name="billingcity" id="billingcity" placeholder="City" value="<?php echo $row['billingCity'];?>" />
                            </div>
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold uppercase tracking-widest text-stone-400 mb-1">Pincode</label>
                            <input class="w-full input-elegant text-sm py-2 px-0" type="text" name="billingpincode" id="billingpincode" placeholder="Pincode" value="<?php echo $row['billingPincode'];?>" />
                        </div>
                        <button type="submit" name="update" class="bg-primary text-white dark:bg-transparent dark:text-secondary dark:border dark:border-secondary px-8 py-3 text-[11px] font-bold uppercase tracking-[0.2em] hover:bg-stone-900 dark:hover:bg-secondary dark:hover:text-black transition-colors w-full">
                            Update Billing Address
                        </button>
                        <label class="flex items-center space-x-3 cursor-pointer group">
                            <input type="checkbox" id="copyAddress" onclick="copyBillingToShipping()" class="form-checkbox text-primary h-4 w-4 border-stone-300 dark:border-stone-700 rounded-none focus:ring-0" />
                            <span class="text-[11px] font-medium uppercase tracking-widest text-stone-500 group-hover:text-stone-800 dark:group-hover:text-stone-200 transition-colors">Same as Shipping Address</span>
                        </label>
                    </div>
                </div>
                
                <!-- Shipping Details -->
                <div class="space-y-8">
                    <h2 class="text-xl font-display uppercase tracking-widest border-b border-stone-200 dark:border-stone-800 pb-4">Shipping Details</h2>
                    <div class="space-y-6">
                        <div>
                            <label class="block text-[10px] font-bold uppercase tracking-widest text-stone-400 mb-1">Full Name *</label>
                            <input class="w-full input-elegant text-sm py-2 px-0" type="text" name="shippingfullname" id="shippingfullname" value="<?php echo $row['name'];?>" readonly />
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold uppercase tracking-widest text-stone-400 mb-1">Address *</label>
                            <input class="w-full input-elegant text-sm py-2 px-0" type="text" name="shippingaddress" id="shippingaddress" placeholder="Shipping Address" value="<?php echo $row['shippingAddress'];?>" />
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-[10px] font-bold uppercase tracking-widest text-stone-400 mb-1">State</label>
                                <input class="w-full input-elegant text-sm py-2 px-0" type="text" name="shippingstate" id="shippingstate" placeholder="State" value="<?php echo $row['shippingState'];?>" />
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold uppercase tracking-widest text-stone-400 mb-1">City</label>
                                <input class="w-full input-elegant text-sm py-2 px-0" type="text" name="shippingcity" id="shippingcity" placeholder="City" value="<?php echo $row['shippingCity'];?>" />
                            </div>
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold uppercase tracking-widest text-stone-400 mb-1">Pincode</label>
                            <input class="w-full input-elegant text-sm py-2 px-0" type="text" name="shippingpincode" id="shippingpincode" placeholder="Pincode" value="<?php echo $row['shippingPincode'];?>" />
                        </div>
                        <button type="submit" name="shipupdate" class="bg-primary text-white dark:bg-transparent dark:text-secondary dark:border dark:border-secondary px-8 py-3 text-[11px] font-bold uppercase tracking-[0.2em] hover:bg-stone-900 dark:hover:bg-secondary dark:hover:text-black transition-colors w-full">
                            Update Shipping Address
                        </button>
                    </div>
                </div>
            </div>
            <?php } ?>
            
            <?php } else { ?>
            <!-- Empty Cart Message -->
            <div class="text-center py-20">
                <span class="material-symbols-outlined text-8xl text-stone-300 dark:text-stone-600 mb-6 block">shopping_cart</span>
                <h3 class="text-2xl font-display mb-4">Your cart is empty</h3>
                <p class="text-stone-500 mb-8">Add some beautiful pieces to your cart to see them here.</p>
                <a href="index.php" class="inline-block bg-primary text-white px-8 py-3 text-[11px] font-bold uppercase tracking-[0.2em] hover:bg-stone-900 transition-colors">
                    Continue Shopping
                </a>
            </div>
            <?php } ?>
        </div>
        
        <!-- Right Column - Order Summary -->
        <?php if(!empty($_SESSION['cart'])){ ?>
        <div class="lg:col-span-4">
            <div class="sticky top-28">
                <div class="bg-white dark:bg-zinc-900 p-8 shadow-sm border border-stone-100 dark:border-stone-800">
                    <h2 class="text-lg font-display uppercase tracking-widest mb-8 border-b border-stone-100 dark:border-stone-800 pb-4">Order Summary</h2>
                    
                    <div class="space-y-4 mb-8">
                        <div class="flex justify-between text-sm">
                            <span class="text-stone-500 uppercase tracking-tighter text-[11px] font-semibold">Subtotal</span>
                            <span class="font-medium" id="subtotal"><?php echo number_format($totalprice, 2); ?></span>
                            <input type="hidden" name="subtotal" value="<?php echo $totalprice; ?>">
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-stone-500 uppercase tracking-tighter text-[11px] font-semibold">Tax (18% GST)</span>
                            <span class="font-medium" id="tax"><?php echo number_format($tax, 2); ?></span>
                            <input type="hidden" name="tax" value="<?php echo $tax; ?>">
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-stone-500 uppercase tracking-tighter text-[11px] font-semibold">Shipping</span>
                            <?php if($totalprice >= 5000) { ?>
                            <span class="text-green-600 font-medium uppercase text-[10px]" id="shipping">Free</span>
                            <?php } else { ?>
                            <span class="font-medium" id="shipping">Rs: <?php echo number_format($shipingcharge, 2); ?></span>
                            <?php } ?>
                            <input type="hidden" name="shipping" value="<?php echo ($totalprice >= 5000) ? 0 : $shipingcharge; ?>">
                        </div>
                    </div>
                    
                    <?php 
                        $shipping_final = ($totalprice >= 5000) ? 0 : $shipingcharge;
                        $grand_now = $totalprice + $shipping_final + $tax;
                    ?>
                    <div class="bg-primary text-white p-4 flex justify-between items-center mb-8">
                        <span class="text-[12px] font-bold uppercase tracking-[0.2em]">Total</span>
                        <span class="text-xl font-display" id="grand">Rs: <?php echo number_format($grand_now, 2); ?></span>
                        <input type="hidden" name="grandtotal" id="grandtotal" value="<?php echo number_format($grand_now,2,'.',''); ?>">
                    </div>
                    
                    <button type="submit" name="ordersubmit" class="w-full bg-primary border-2 border-primary text-white py-4 text-[11px] font-bold uppercase tracking-[0.2em] hover:bg-white hover:text-primary transition-all flex items-center justify-center dark:border-secondary dark:text-secondary dark:bg-transparent dark:hover:bg-secondary dark:hover:text-black">
                        <span class="material-symbols-outlined text-sm mr-2">lock</span>
                        Proceed to Secure Checkout
                    </button>
                    
                    <!-- Payment Icons -->
                    <div class="mt-8 flex flex-wrap justify-center gap-4 opacity-50 grayscale hover:grayscale-0 hover:opacity-100 transition-all duration-500">
                        <img alt="Secure Payment" class="h-7" src="assets/Secure_Payment.webp" />
                    </div>
                </div>
                
                <!-- Free Shipping Notice -->
                <div class="mt-6 p-6 border border-stone-100 dark:border-stone-800 bg-stone-50/50 dark:bg-zinc-800/30">
                    <p class="text-[10px] text-stone-400 uppercase tracking-widest text-center italic">
                        Free shipping on all premium orders above Rs. 5,000
                    </p>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
    </form>
</main>

<script>
// Copy Billing to Shipping Address
function copyBillingToShipping() {
    const checkbox = document.getElementById("copyAddress");
    if (checkbox.checked) {
        document.getElementById("shippingaddress").value = document.getElementById("billingaddress").value;
        document.getElementById("shippingstate").value = document.getElementById("bilingstate").value;
        document.getElementById("shippingcity").value = document.getElementById("billingcity").value;
        document.getElementById("shippingpincode").value = document.getElementById("billingpincode").value;
    } else {
        document.getElementById("shippingaddress").value = "";
        document.getElementById("shippingstate").value = "";
        document.getElementById("shippingcity").value = "";
        document.getElementById("shippingpincode").value = "";
    }
}
</script>

<script>
// Quantity update and remove item functionality
(function(){
    const table = document.getElementById('cartTable');
    if (!table) return;

    let lock = false;

    function clampInt(v) {
        v = parseInt(v || '1', 10);
        if (isNaN(v) || v < 1) v = 1;
        return v;
    }

    function postJSON(url, data) {
        return fetch(url, {
            method: 'POST',
            headers: { 'Content-Type':'application/x-www-form-urlencoded; charset=UTF-8' },
            body: new URLSearchParams(data).toString()
        }).then(r => r.json());
    }

    // Handle quantity button clicks
    table.addEventListener('click', function(e){
        // Handle remove item
        const removeBtn = e.target.closest('button.remove-item');
        if (removeBtn && table.contains(removeBtn)) {
            e.preventDefault();
            e.stopPropagation();
            
            if (lock) return;
            
            const pid = removeBtn.getAttribute('data-pid');
            
            if (confirm('Are you sure you want to remove this item from cart?')) {
                lock = true;
                
                postJSON(window.location.href, {
                    ajax: '1',
                    action: 'remove_item',
                    pid: pid
                }).then(res=>{
                    if (!res || !res.ok) return;
                    
                    // Remove the row with animation
                    const row = document.getElementById('row-'+pid);
                    if (row) {
                        row.style.transition = 'opacity 0.3s, transform 0.3s';
                        row.style.opacity = '0';
                        row.style.transform = 'translateX(-20px)';
                        setTimeout(()=> {
                            row.remove();
                            // Check if cart is empty
                            if (res.cart_empty) {
                                setTimeout(()=> location.reload(), 300);
                            }
                        }, 300);
                    }
                    
                    // Update totals
                    updateTotals(res);
                    
                    // Update header cart count
                    const headerCount = document.getElementById('header-cart-count');
                    if (headerCount) headerCount.textContent = res.cart_count;
                    
                }).catch(console.error).finally(()=>{ lock = false; });
            }
            return;
        }
        
        // Handle quantity buttons
        const btn = e.target.closest('button.qty-btn');
        if (!btn || !table.contains(btn)) return;

        e.preventDefault();
        e.stopPropagation();

        if (lock) return;
        const pid = btn.getAttribute('data-pid');
        const role = btn.getAttribute('data-role');
        const input = document.getElementById('qty-'+pid);
        let current = clampInt(input.value);

        if (role === 'plus') current = current + 1;
        if (role === 'minus') current = Math.max(1, current - 1);

        input.value = current;

        lock = true;
        postJSON(window.location.href, {
            ajax: '1',
            action: 'update_qty',
            pid: pid,
            qty: current
        }).then(res=>{
            if (!res || !res.ok) return;

            const lt = document.getElementById('line-total-'+pid);
            if (lt) lt.textContent = 'Rs: ' + res.line_total;

            updateTotals(res);

            const headerCount = document.getElementById('header-cart-count');
            if (headerCount) headerCount.textContent = res.cart_count;
        }).catch(console.error).finally(()=>{ lock = false; });
    }, true);

    // Debounced manual typing with min=1
    let debounceTimer = null;
    table.addEventListener('input', function(e){
        const inp = e.target;
        if (!inp.classList.contains('qty-input')) return;
        const pid = inp.getAttribute('data-pid');

        inp.value = inp.value.replace(/[^0-9]/g,'');
        if (inp.value === '' || inp.value === '0') inp.value = '1';

        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(()=>{
            if (lock) return;
            const val = clampInt(inp.value);
            inp.value = val;

            lock = true;
            postJSON(window.location.href, {
                ajax: '1',
                action: 'update_qty',
                pid: pid,
                qty: val
            }).then(res=>{
                if (!res || !res.ok) return;

                const lt = document.getElementById('line-total-'+pid);
                if (lt) lt.textContent = 'Rs: ' + res.line_total;

                updateTotals(res);

                const headerCount = document.getElementById('header-cart-count');
                if (headerCount) headerCount.textContent = res.cart_count;
            }).catch(console.error).finally(()=>{ lock = false; });
        }, 300);
    }, false);

    function updateTotals(res) {
        const subtotal = document.getElementById('subtotal');
        if (subtotal) subtotal.textContent = res.subtotal;

        const tax = document.getElementById('tax');
        if (tax) tax.textContent = res.tax;

        const shipping = document.getElementById('shipping');
        if (shipping) {
            const subtotalVal = parseFloat(res.subtotal.replace(/,/g, ''));
            if (subtotalVal >= 5000) {
                shipping.textContent = 'Free';
                shipping.className = 'text-green-600 font-medium uppercase text-[10px]';
            } else {
                shipping.textContent = 'Rs: ' + res.shipping;
                shipping.className = 'font-medium';
            }
        }

        const grand = document.getElementById('grand');
        const grandHidden = document.getElementById('grandtotal');
        if (grand) grand.textContent = 'Rs: ' + res.grand;
        if (grandHidden) grandHidden.value = res.grand;
    }
})();
</script>

<!-- Include Home Page Footer -->
<?php include 'footer.php'; ?>
