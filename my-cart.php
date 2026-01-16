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
        $_SESSION['cart_notification'] = ['title' => 'Cart Updated', 'message' => 'Your cart has been updated successfully.'];
    }
}

// Remove product(s)
if(isset($_POST['remove_code'])) {
    if(!empty($_SESSION['cart'])){
        foreach($_POST['remove_code'] as $key){
            unset($_SESSION['cart'][$key]);
        }
        $_SESSION['cart_notification'] = ['title' => 'Cart Updated', 'message' => 'Your cart has been updated successfully.'];
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
    if($query) { $_SESSION['cart_notification'] = ['title' => 'Address Updated', 'message' => 'Billing address has been updated successfully.']; }
}

// Shipping update
if(isset($_POST['shipupdate'])) {
    $saddress=$_POST['shippingaddress'];
    $sstate=$_POST['shippingstate'];
    $scity=$_POST['shippingcity'];
    $spincode=$_POST['shippingpincode'];
    $query=mysqli_query($con,"update users set shippingAddress='$saddress',shippingState='$sstate',shippingCity='$scity',shippingPincode='$spincode' where id='".$_SESSION['id']."'");
    if($query) { $_SESSION['cart_notification'] = ['title' => 'Address Updated', 'message' => 'Shipping address has been updated successfully.']; }
}
?>
<?php include 'header.php'; ?>

<!-- Cart Page Specific Styles and Icons -->
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
<style>
    /* Force Material Icons to render properly on cart page */
    .material-symbols-outlined,
    .material-icons-outlined,
    .material-icons {
        font-family: 'Material Symbols Outlined', 'Material Icons Outlined', 'Material Icons' !important;
        font-weight: normal !important;
        font-style: normal !important;
        font-size: 24px !important;
        line-height: 1 !important;
        letter-spacing: normal !important;
        text-transform: none !important;
        display: inline-block !important;
        white-space: nowrap !important;
        word-wrap: normal !important;
        direction: ltr !important;
        -webkit-font-feature-settings: 'liga' !important;
        -webkit-font-smoothing: antialiased !important;
        text-rendering: optimizeLegibility !important;
        -moz-osx-font-smoothing: grayscale !important;
        font-feature-settings: 'liga' !important;
    }
    /* Adjust icon sizes for specific contexts */
    .qty-btn .material-symbols-outlined {
        font-size: 18px !important;
    }
    .remove-item .material-symbols-outlined {
        font-size: 20px !important;
    }
    button[name="ordersubmit"] .material-symbols-outlined {
        font-size: 16px !important;
    }
    /* Remove borders from quantity selector and remove button */
    .qty-btn {
        border: none !important;
        background: transparent !important;
        outline: none !important;
    }
    .qty-btn:focus {
        outline: none !important;
        box-shadow: none !important;
    }
    .remove-item {
        border: none !important;
        background: transparent !important;
        outline: none !important;
        box-shadow: none !important;
    }
    .remove-item:focus {
        outline: none !important;
        box-shadow: none !important;
    }
    .qty-input {
        border: none !important;
        outline: none !important;
        box-shadow: none !important;
    }
    .qty-input:focus {
        border: none !important;
        outline: none !important;
        box-shadow: none !important;
    }
    /* Update Cart Button Hover Effect */
    .update-cart-btn {
        background-color: #ffffff !important;
    }
    .update-cart-btn:hover {
        background-color: #800020 !important;
    }
    .update-cart-btn .update-cart-text {
        color: #800020 !important;
    }
    .update-cart-btn:hover .update-cart-text {
        color: #D4AF37 !important;
    }
    /* Custom Checkbox Styling */
    .custom-checkbox {
        appearance: auto !important;
        -webkit-appearance: checkbox !important;
        -moz-appearance: checkbox !important;
        width: 18px !important;
        height: 18px !important;
        border: 2px solid #800020 !important;
        border-radius: 3px !important;
        cursor: pointer !important;
        background-color: #fff !important;
    }
    .custom-checkbox:checked {
        background-color: #800020 !important;
        border-color: #800020 !important;
    }
</style>
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
        /* Cart Page Specific Styles */
        #page-content {
            font-family: 'Montserrat', sans-serif;
            background-color: #F9F7F2;
            color: #1e293b;
            min-height: 60vh;
        }
        #page-content h1, #page-content h2, #page-content h3, #page-content .serif-font {
            font-family: 'Playfair Display', serif !important;
        }
        /* Main content area styling */
        #page-content main {
            background-color: #F9F7F2;
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
        #page-content .bg-primary {
            background-color: #800020 !important;
        }
        #page-content .text-primary {
            color: #800020 !important;
        }
        #page-content .border-primary {
            border-color: #800020 !important;
        }
        #page-content .hover\:text-primary:hover {
            color: #800020 !important;
        }
        #page-content .hover\:bg-primary:hover {
            background-color: #800020 !important;
        }
        /* Cart table styling */
        #page-content table {
            background-color: transparent !important;
        }
        #page-content .divide-stone-100 > * + * {
            border-color: rgba(245, 245, 244, 1) !important;
        }
        /* Order summary card */
        #page-content .bg-white {
            background-color: #ffffff !important;
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
        
        /* Custom Modal Styles */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }
        .modal-overlay.active {
            opacity: 1;
            visibility: visible;
        }
        .modal-box {
            background: #fff;
            padding: 40px 50px;
            max-width: 380px;
            width: 90%;
            text-align: center;
            position: relative;
            transform: scale(0.9);
            transition: transform 0.3s ease;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }
        .modal-overlay.active .modal-box {
            transform: scale(1);
        }
        .modal-close {
            position: absolute;
            top: 15px;
            right: 15px;
            background: none;
            border: none;
            cursor: pointer;
            padding: 5px;
            transition: transform 0.3s;
        }
        .modal-close:hover {
            transform: rotate(90deg);
        }
        .modal-close svg {
            stroke: #a8a29e;
            transition: stroke 0.3s;
        }
        .modal-close:hover svg {
            stroke: #1c1917;
        }
        .modal-icon {
            width: 70px;
            height: 70px;
            border: 2px solid #e5e7eb;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px;
        }
        .modal-icon svg {
            stroke: #800020;
        }
        .modal-title {
            font-family: 'Playfair Display', serif;
            font-size: 24px;
            font-weight: 400;
            color: #1c1917;
            margin-bottom: 12px;
        }
        .modal-desc {
            font-family: 'Montserrat', sans-serif;
            font-size: 13px;
            color: #78716c;
            line-height: 1.6;
            margin-bottom: 30px;
        }
        .modal-buttons {
            display: flex;
            gap: 15px;
            justify-content: center;
        }
        .modal-btn {
            padding: 14px 30px;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.15em;
            font-family: 'Montserrat', sans-serif;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s;
            border: none;
        }
        .modal-btn-cancel {
            background: #fff;
            border: 1px solid #e5e7eb;
            color: #1c1917;
        }
        .modal-btn-cancel:hover {
            background: #f5f5f4;
            border-color: #d6d3d1;
        }
        .modal-btn-confirm {
            background: #800020;
            color: #fff;
        }
        .modal-btn-confirm:hover {
            background: #600018;
        }
        
        /* Notification Modal Styles */
        .notification-modal .modal-icon {
            border-color: #bbf7d0;
            background: #f0fdf4;
        }
        .notification-modal .modal-icon svg {
            stroke: #15803d;
        }
        .notification-modal .modal-btn-confirm {
            background: #15803d;
        }
        .notification-modal .modal-btn-confirm:hover {
            background: #166534;
        }
        /* Smooth transitions */
        .transition-smooth {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        /* Stone colors for text */
        #page-content .text-stone-400 {
            color: #a8a29e !important;
        }
        #page-content .text-stone-500 {
            color: #78716c !important;
        }
        #page-content .text-stone-600 {
            color: #57534e !important;
        }
        #page-content .text-stone-800 {
            color: #292524 !important;
        }
        /* Border colors */
        #page-content .border-stone-100 {
            border-color: #f5f5f4 !important;
        }
        #page-content .border-stone-200 {
            border-color: #e7e5e4 !important;
        }
        /* Ensure checkout button has correct colors */
        #page-content button[name="ordersubmit"],
        #page-content .checkout-btn {
            background-color: #800020 !important;
            border-color: #800020 !important;
            color: #ffffff !important;
        }
        #page-content button[name="ordersubmit"]:hover,
        #page-content .checkout-btn:hover {
            background-color: #ffffff !important;
            color: #800020 !important;
        }
    </style>

<!-- Main Content -->
<div id="page-content" style="background: #F9F7F2;">
<main class="max-w-7xl mx-auto px-6 py-12">
    <h1 class="text-4xl font-display mb-12 text-center lg:text-left" style="font-family: 'Playfair Display', serif;">Your Shopping Cart</h1>
    
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
                                    <div class="flex items-center">
                                        <button type="button" class="qty-btn px-2 py-1 text-stone-500 hover:text-primary transition-colors" data-role="minus" data-pid="<?php echo $row['id']; ?>">
                                            <span class="material-symbols-outlined text-sm">remove</span>
                                        </button>
                                        <input type="text" 
                                               class="w-10 text-center text-sm bg-transparent border-none focus:ring-0 focus:outline-none qty-input" 
                                               value="<?php echo (int)$_SESSION['cart'][$row['id']]['quantity']; ?>" 
                                               name="quantity[<?php echo $row['id']; ?>]" 
                                               pattern="[0-9]*"
                                               inputmode="numeric"
                                               data-pid="<?php echo $row['id']; ?>"
                                               id="qty-<?php echo $row['id']; ?>" />
                                        <button type="button" class="qty-btn px-2 py-1 text-stone-500 hover:text-primary transition-colors" data-role="plus" data-pid="<?php echo $row['id']; ?>">
                                            <span class="material-symbols-outlined text-sm">add</span>
                                        </button>
                                    </div>
                                </div>
                            </td>
                            <td class="py-8 text-right font-medium" id="line-total-<?php echo $row['id']; ?>">Rs: <?php echo number_format($_SESSION['cart'][$row['id']]['quantity']*$row['productPrice'],2); ?></td>
                            <td class="py-8 text-right pl-4">
                                <button type="button" class="remove-item text-stone-300 hover:text-red-600 transition-colors border-none bg-transparent p-0" data-pid="<?php echo $row['id']; ?>" title="Remove item">
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
                    <button type="submit" name="submit" class="update-cart-btn text-[11px] font-semibold uppercase tracking-widest border border-primary px-6 py-2 transition-all" style="background-color: #ffffff !important;">
                        <span class="update-cart-text" style="color: #800020; transition: color 0.3s;">Update Cart</span>
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
                            <input type="checkbox" id="copyAddress" onclick="copyBillingToShipping()" class="custom-checkbox" style="width: 18px; height: 18px; accent-color: #800020; cursor: pointer;" />
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
                    <div class="mt-4 w-full">
                        <img alt="Secure Payment" class="w-full h-auto object-contain" src="assets/Secure_Payment.webp" style="max-height: 50px;" />
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
</div><!-- End page-content -->

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
            
            // Show custom modal instead of browser confirm
            showRemoveModal(pid);
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

<!-- Remove Item Modal -->
<div id="removeModal" class="modal-overlay">
    <div class="modal-box">
        <button type="button" class="modal-close" onclick="closeRemoveModal()">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
        </button>
        <div class="modal-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="3 6 5 6 21 6"></polyline>
                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                <line x1="10" y1="11" x2="10" y2="17"></line>
                <line x1="14" y1="11" x2="14" y2="17"></line>
            </svg>
        </div>
        <h3 class="modal-title">Remove Item?</h3>
        <p class="modal-desc">Are you sure you want to remove this item from your cart? This action cannot be undone.</p>
        <div class="modal-buttons">
            <button type="button" class="modal-btn modal-btn-cancel" onclick="closeRemoveModal()">Cancel</button>
            <button type="button" id="confirmRemoveBtn" class="modal-btn modal-btn-confirm">Remove</button>
        </div>
    </div>
</div>

<!-- Notification Modal -->
<div id="notificationModal" class="modal-overlay notification-modal">
    <div class="modal-box">
        <button type="button" class="modal-close" onclick="closeNotificationModal()">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
        </button>
        <div class="modal-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                <polyline points="22 4 12 14.01 9 11.01"></polyline>
            </svg>
        </div>
        <h3 class="modal-title" id="notificationTitle">Success!</h3>
        <p class="modal-desc" id="notificationDesc">Your action has been completed successfully.</p>
        <div class="modal-buttons">
            <button type="button" class="modal-btn modal-btn-confirm" onclick="closeNotificationModal()">OK</button>
        </div>
    </div>
</div>

<script>
    let pendingRemovePid = null;
    
    function showRemoveModal(pid) {
        pendingRemovePid = pid;
        document.getElementById('removeModal').classList.add('active');
        document.body.style.overflow = 'hidden';
    }
    
    function closeRemoveModal() {
        document.getElementById('removeModal').classList.remove('active');
        document.body.style.overflow = '';
        pendingRemovePid = null;
    }
    
    function showNotificationModal(title, message) {
        document.getElementById('notificationTitle').textContent = title;
        document.getElementById('notificationDesc').textContent = message;
        document.getElementById('notificationModal').classList.add('active');
        document.body.style.overflow = 'hidden';
    }
    
    function closeNotificationModal() {
        document.getElementById('notificationModal').classList.remove('active');
        document.body.style.overflow = '';
    }
    
    // Close modal when clicking outside
    document.getElementById('removeModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeRemoveModal();
        }
    });
    
    document.getElementById('notificationModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeNotificationModal();
        }
    });
    
    // Close modal with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeRemoveModal();
            closeNotificationModal();
        }
    });
    
    // Handle confirm remove button click
    document.getElementById('confirmRemoveBtn').addEventListener('click', function() {
        if (!pendingRemovePid) return;
        
        const pid = pendingRemovePid;
        closeRemoveModal();
        
        // Post to remove the item
        fetch(window.location.href, {
            method: 'POST',
            headers: { 'Content-Type':'application/x-www-form-urlencoded; charset=UTF-8' },
            body: new URLSearchParams({
                ajax: '1',
                action: 'remove_item',
                pid: pid
            }).toString()
        })
        .then(r => r.json())
        .then(res => {
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
            
            // Update header cart count
            const headerCount = document.getElementById('header-cart-count');
            if (headerCount) headerCount.textContent = res.cart_count;
        })
        .catch(console.error);
    });
    
    // Check for session notification on page load
    <?php if(isset($_SESSION['cart_notification'])): ?>
    document.addEventListener('DOMContentLoaded', function() {
        showNotificationModal('<?php echo addslashes($_SESSION['cart_notification']['title']); ?>', '<?php echo addslashes($_SESSION['cart_notification']['message']); ?>');
    });
    <?php unset($_SESSION['cart_notification']); endif; ?>
</script>

<!-- Include Home Page Footer -->
<?php include 'footer.php'; ?>
