<?php
session_start();
error_reporting(0);
include('includes/config.php');
$cid = intval($_GET['cid']);

// Handle add to cart
if(isset($_GET['action']) && $_GET['action']=="add"){
    $id = intval($_GET['id']);
    if(isset($_SESSION['cart'][$id])){
        $_SESSION['cart'][$id]['quantity']++;
    }else{
        $sql_p = "SELECT * FROM products WHERE id={$id}";
        $query_p = mysqli_query($con, $sql_p);
        if(mysqli_num_rows($query_p) != 0){
            $row_p = mysqli_fetch_array($query_p);
            $_SESSION['cart'][$row_p['id']] = array("quantity" => 1, "price" => $row_p['productPrice']);
            $_SESSION['show_cart_modal'] = true;
            $_SESSION['last_added_product'] = array(
                'id' => $row_p['id'],
                'name' => $row_p['productName'],
                'price' => $row_p['productPrice'],
                'image' => $row_p['productImage1']
            );
        }else{
            $message = "Product ID is invalid";
        }
    }
}

// Handle Wishlist
if(isset($_GET['pid']) && $_GET['action']=="wishlist"){
    if(strlen($_SESSION['login']) == 0) {   
        header('location:login.php');
    } else {
        mysqli_query($con, "insert into wishlist(userId,productId) values('".$_SESSION['id']."','".$_GET['pid']."')");
        $_SESSION['wishlist_notification'] = 'Product added to wishlist successfully!';
        header('location:my-wishlist.php');
        exit();
    }
}

// Get category name
$categoryNameQuery = mysqli_query($con, "SELECT categoryName FROM category WHERE id='$cid'");
$categoryNameRow = mysqli_fetch_array($categoryNameQuery);
$categoryName = $categoryNameRow ? htmlentities($categoryNameRow['categoryName']) : 'Collection';

// Pagination setup
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$productsPerPage = 12;
$offset = ($page - 1) * $productsPerPage;

// Get sorting
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'newest';
$orderBy = "ORDER BY id DESC";
switch($sort) {
    case 'price_low':
        $orderBy = "ORDER BY productPrice ASC";
        break;
    case 'price_high':
        $orderBy = "ORDER BY productPrice DESC";
        break;
    case 'popularity':
        $orderBy = "ORDER BY id DESC";
        break;
}

// Price range filter
$priceFilter = isset($_GET['price']) ? $_GET['price'] : '';
$priceCondition = "";
switch($priceFilter) {
    case 'under5000':
        $priceCondition = "AND productPrice < 5000";
        break;
    case '5000to10000':
        $priceCondition = "AND productPrice >= 5000 AND productPrice <= 10000";
        break;
    case 'above10000':
        $priceCondition = "AND productPrice > 10000";
        break;
}

// Build WHERE clause
$whereClause = "WHERE category = '$cid' $priceCondition";

// Get total product count with filters
$totalQuery = mysqli_query($con, "SELECT COUNT(*) as total FROM products $whereClause");
$totalRow = mysqli_fetch_array($totalQuery);
$totalProducts = $totalRow['total'];
$totalPages = ceil($totalProducts / $productsPerPage);

// Helper function to build filter URL for category page
function buildCategoryFilterUrl($cid, $params = array()) {
    $currentParams = array('cid' => $cid);
    
    // Preserve existing parameters
    if(isset($_GET['price']) && !empty($_GET['price'])) $currentParams['price'] = $_GET['price'];
    if(isset($_GET['sort']) && $_GET['sort'] != 'newest') $currentParams['sort'] = $_GET['sort'];
    
    // Merge with new parameters
    foreach($params as $key => $value) {
        if($value === null || $value === '') {
            unset($currentParams[$key]);
        } else {
            $currentParams[$key] = $value;
        }
    }
    
    // Remove page when filters change
    unset($currentParams['page']);
    
    $queryString = http_build_query($currentParams);
    return 'category.php?' . $queryString;
}

// Helper function to build pagination URL
function buildCategoryPageUrl($pageNum) {
    $currentParams = $_GET;
    $currentParams['page'] = $pageNum;
    return 'category.php?' . http_build_query($currentParams);
}

?>
<?php include('header.php'); ?>

<!-- Material Icons for Category Page -->
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
<style>
    /* Force Material Icons to render properly */
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
</style>

<!-- Tailwind CSS CDN with config -->
<script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>
<script>
    tailwind.config = {
        darkMode: "class",
        theme: {
            extend: {
                colors: {
                    primary: "#800020",
                    "background-light": "#F9F7F2",
                    "background-dark": "#121212",
                    "accent-gold": "#C5A059",
                },
                fontFamily: {
                    display: ["Playfair Display", "serif"],
                    serif: ["Cormorant Garamond", "serif"],
                    sans: ["Montserrat", "sans-serif"],
                },
                borderRadius: {
                    DEFAULT: "0px",
                },
            },
        },
    };
</script>

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet"/>

<style>
    .product-card:hover .product-action {
        opacity: 1;
        transform: translateY(0);
    }
    .small-caps {
        font-variant: small-caps;
    }
    .collection-page {
        background: #F9F7F2;
        min-height: 100vh;
    }
    .sidebar-category {
        transition: all 0.2s ease;
    }
    .sidebar-category:hover {
        color: #800020;
        padding-left: 4px;
    }
    .sidebar-category.active {
        color: #800020;
        font-weight: 500;
    }
    /* Custom radio styling */
    .filter-radio {
        appearance: none;
        -webkit-appearance: none;
        width: 18px;
        height: 18px;
        border: 2px solid #d1d5db;
        border-radius: 50%;
        cursor: pointer;
        transition: all 0.2s ease;
        position: relative;
        flex-shrink: 0;
    }
    .filter-radio.checked {
        border-color: #800020;
        background-color: #800020;
    }
    .filter-radio.checked::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 6px;
        height: 6px;
        background: white;
        border-radius: 50%;
    }
    .filter-radio:hover {
        border-color: #800020;
    }
    /* Product grid hover effects */
    .product-card-wrapper {
        transition: transform 0.3s ease;
    }
    .product-card-wrapper:hover {
        transform: translateY(-4px);
    }
    .quick-add-btn {
        transform: translateY(100%);
        transition: transform 0.3s ease;
    }
    .product-card-wrapper:hover .quick-add-btn {
        transform: translateY(0);
    }
    .quick-add-link:hover .quick-add-text {
        color: #D4AF37 !important;
    }
    .clear-filters-btn:hover .btn-text {
        color: #D4AF37 !important;
    }
    .product-image-container img {
        transition: transform 1s ease;
    }
    .product-card-wrapper:hover .product-image-container img {
        transform: scale(1.05);
    }
    /* Wishlist button */
    .wishlist-btn {
        transition: all 0.3s ease;
    }
    .wishlist-btn:hover {
        color: #800020 !important;
        transform: scale(1.1);
    }
    .wishlist-btn:hover i {
        color: #800020 !important;
    }
    /* Pagination */
    .pagination-btn {
        transition: all 0.3s ease;
    }
    .pagination-btn:hover,
    .pagination-btn.active {
        border-color: #800020;
        color: #800020;
    }
    .pagination-btn.active {
        background: #800020;
        color: white;
    }
    /* Sidebar promotional banner */
    .promo-banner {
        position: relative;
        overflow: hidden;
    }
    .promo-banner:hover img {
        transform: scale(1.05);
    }
    .promo-banner img {
        transition: transform 0.7s ease;
    }
    /* Sort dropdown styling */
    .sort-select {
        background-color: transparent;
        border: none;
        cursor: pointer;
        outline: none;
    }
    .sort-select:focus {
        outline: none;
        box-shadow: none;
    }
    /* Active filters */
    .active-filter {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 12px;
        background: #f3f4f6;
        border-radius: 20px;
        font-size: 12px;
        color: #374151;
        transition: all 0.2s ease;
    }
    .active-filter:hover {
        background: #e5e7eb;
    }
    .active-filter .remove-filter {
        width: 16px;
        height: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #9ca3af;
        color: white;
        border-radius: 50%;
        font-size: 10px;
        cursor: pointer;
        transition: background 0.2s ease;
    }
    .active-filter .remove-filter:hover {
        background: #800020;
    }
    /* Clear filter link */
    .clear-filter-link {
        color: #800020;
        font-size: 12px;
        text-decoration: underline;
        cursor: pointer;
        transition: opacity 0.2s ease;
    }
    .clear-filter-link:hover {
        opacity: 0.7;
    }
    /* Mobile filter toggle */
    .mobile-filter-btn {
        display: none;
    }
    @media (max-width: 1023px) {
        .mobile-filter-btn {
            display: flex;
        }
        .filter-sidebar {
            display: none;
        }
        .filter-sidebar.show {
            display: block;
        }
    }
</style>

<!-- Collection Page Content -->
<div class="collection-page">
    <main class="max-w-7xl mx-auto px-4 sm:px-6 py-8 sm:py-12">
        <!-- Page Header -->
        <div class="flex flex-col md:flex-row md:items-end justify-between border-b border-stone-200 pb-6 sm:pb-8 mb-8 sm:mb-12">
            <div>
                <!-- Breadcrumb -->
                <nav class="flex text-[10px] uppercase tracking-widest text-stone-500 mb-4">
                    <a href="index.php" class="hover:text-primary transition-colors">Home</a>
                    <span class="mx-2">/</span>
                    <a href="all-category.php" class="hover:text-primary transition-colors">Collections</a>
                    <span class="mx-2">/</span>
                    <span class="text-stone-900 font-medium"><?php echo $categoryName; ?></span>
                </nav>
                
                <!-- Title -->
                <h2 class="font-display text-3xl sm:text-4xl md:text-5xl text-stone-900" style="font-family: 'Playfair Display', serif;">
                    <?php echo $categoryName; ?>
                </h2>
                <p class="mt-2 text-stone-500 italic text-base sm:text-lg" style="font-family: 'Cormorant Garamond', serif;">
                    Exquisite hand-crafted pieces for the modern woman.
                </p>
            </div>
            
            <!-- Products Count & Sort -->
            <div class="mt-4 md:mt-0 flex items-center gap-4">
                <span class="text-xs uppercase tracking-widest text-stone-500"><?php echo $totalProducts; ?> Products Found</span>
                <form method="GET" id="sortForm">
                    <input type="hidden" name="cid" value="<?php echo $cid; ?>">
                    <?php if(!empty($priceFilter)): ?>
                    <input type="hidden" name="price" value="<?php echo $priceFilter; ?>">
                    <?php endif; ?>
                    <select name="sort" onchange="document.getElementById('sortForm').submit();" class="sort-select bg-transparent border-none text-xs uppercase tracking-widest focus:ring-0 cursor-pointer text-stone-700">
                        <option value="newest" <?php echo $sort == 'newest' ? 'selected' : ''; ?>>Sort By: Newest</option>
                        <option value="price_low" <?php echo $sort == 'price_low' ? 'selected' : ''; ?>>Price: Low to High</option>
                        <option value="price_high" <?php echo $sort == 'price_high' ? 'selected' : ''; ?>>Price: High to Low</option>
                        <option value="popularity" <?php echo $sort == 'popularity' ? 'selected' : ''; ?>>Popularity</option>
                    </select>
                </form>
            </div>
        </div>
        
        <!-- Active Filters Display -->
        <?php if(!empty($priceFilter)): ?>
        <div class="flex flex-wrap items-center gap-3 mb-6 pb-6 border-b border-stone-200">
            <span class="text-xs uppercase tracking-widest text-stone-500">Active Filters:</span>
            
            <?php 
                $priceLabels = array(
                    'under5000' => 'Under ₹5,000',
                    '5000to10000' => '₹5,000 - ₹10,000',
                    'above10000' => 'Above ₹10,000'
                );
            ?>
            <a href="<?php echo buildCategoryFilterUrl($cid, array('price' => null)); ?>" class="active-filter">
                <?php echo $priceLabels[$priceFilter]; ?>
                <span class="remove-filter">×</span>
            </a>
            
            <a href="category.php?cid=<?php echo $cid; ?>" class="clear-filter-link ml-auto">Clear All</a>
        </div>
        <?php endif; ?>
        
        <!-- Mobile Filter Toggle Button -->
        <button onclick="toggleFilters()" class="mobile-filter-btn lg:hidden w-full mb-6 py-3 px-4 border border-stone-300 flex items-center justify-center gap-2 text-sm uppercase tracking-widest">
            <i class="icon anm anm-sliders-hr"></i>
            Filter & Sort
        </button>
        
        <!-- Main Content Grid -->
        <div class="flex flex-col lg:flex-row gap-8 lg:gap-16">
            
            <!-- Sidebar -->
            <aside id="filterSidebar" class="filter-sidebar w-full lg:w-1/5 space-y-8 sm:space-y-10 lg:block">
                
                <!-- Categories -->
                <div>
                    <h3 class="text-lg sm:text-xl mb-4 sm:mb-6 border-b border-stone-200 pb-2" style="font-family: 'Cormorant Garamond', serif;">Category</h3>
                    <ul class="space-y-3">
                        <li class="flex items-center justify-between text-sm group cursor-pointer">
                            <a href="all-category.php" class="sidebar-category group-hover:text-primary transition-colors">
                                All Products
                            </a>
                            <span class="text-xs text-stone-400"><?php 
                                $allCountQuery = mysqli_query($con, "SELECT COUNT(*) as cnt FROM products");
                                $allCountRow = mysqli_fetch_array($allCountQuery);
                                echo $allCountRow['cnt'];
                            ?></span>
                        </li>
                        <?php
                        $catQuery = mysqli_query($con, "SELECT * FROM category");
                        while($catRow = mysqli_fetch_array($catQuery)) {
                            $catCount = mysqli_query($con, "SELECT COUNT(*) as cnt FROM products WHERE category = " . $catRow['id']);
                            $countRow = mysqli_fetch_array($catCount);
                            $isActive = ($cid == $catRow['id']);
                        ?>
                        <li class="flex items-center justify-between text-sm group cursor-pointer">
                            <a href="category.php?cid=<?php echo $catRow['id']; ?>" 
                               class="sidebar-category <?php echo $isActive ? 'active' : ''; ?> group-hover:text-primary transition-colors">
                                <?php echo htmlentities($catRow['categoryName']); ?>
                            </a>
                            <span class="text-xs" style="<?php echo $isActive ? 'color: #800020;' : 'color: #a8a29e;'; ?>"><?php echo $countRow['cnt']; ?></span>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
                
                <!-- Price Range -->
                <div>
                    <h3 class="text-lg sm:text-xl mb-4 sm:mb-6 border-b border-stone-200 pb-2" style="font-family: 'Cormorant Garamond', serif;">Price Range</h3>
                    <div class="space-y-3">
                        <a href="<?php echo buildCategoryFilterUrl($cid, array('price' => 'under5000')); ?>" class="flex items-center space-x-3 cursor-pointer group">
                            <span class="filter-radio <?php echo $priceFilter == 'under5000' ? 'checked' : ''; ?>"></span>
                            <span class="text-sm group-hover:text-primary transition-colors <?php echo $priceFilter == 'under5000' ? 'font-medium' : ''; ?>" style="<?php echo $priceFilter == 'under5000' ? 'color: #800020;' : ''; ?>">Under ₹5,000</span>
                            <span class="text-xs text-stone-400 ml-auto"><?php 
                                $priceCount1 = mysqli_query($con, "SELECT COUNT(*) as cnt FROM products WHERE category = $cid AND productPrice < 5000");
                                $pc1 = mysqli_fetch_array($priceCount1);
                                echo $pc1['cnt'];
                            ?></span>
                        </a>
                        <a href="<?php echo buildCategoryFilterUrl($cid, array('price' => '5000to10000')); ?>" class="flex items-center space-x-3 cursor-pointer group">
                            <span class="filter-radio <?php echo $priceFilter == '5000to10000' ? 'checked' : ''; ?>"></span>
                            <span class="text-sm group-hover:text-primary transition-colors <?php echo $priceFilter == '5000to10000' ? 'font-medium' : ''; ?>" style="<?php echo $priceFilter == '5000to10000' ? 'color: #800020;' : ''; ?>">₹5,000 - ₹10,000</span>
                            <span class="text-xs text-stone-400 ml-auto"><?php 
                                $priceCount2 = mysqli_query($con, "SELECT COUNT(*) as cnt FROM products WHERE category = $cid AND productPrice >= 5000 AND productPrice <= 10000");
                                $pc2 = mysqli_fetch_array($priceCount2);
                                echo $pc2['cnt'];
                            ?></span>
                        </a>
                        <a href="<?php echo buildCategoryFilterUrl($cid, array('price' => 'above10000')); ?>" class="flex items-center space-x-3 cursor-pointer group">
                            <span class="filter-radio <?php echo $priceFilter == 'above10000' ? 'checked' : ''; ?>"></span>
                            <span class="text-sm group-hover:text-primary transition-colors <?php echo $priceFilter == 'above10000' ? 'font-medium' : ''; ?>" style="<?php echo $priceFilter == 'above10000' ? 'color: #800020;' : ''; ?>">Above ₹10,000</span>
                            <span class="text-xs text-stone-400 ml-auto"><?php 
                                $priceCount3 = mysqli_query($con, "SELECT COUNT(*) as cnt FROM products WHERE category = $cid AND productPrice > 10000");
                                $pc3 = mysqli_fetch_array($priceCount3);
                                echo $pc3['cnt'];
                            ?></span>
                        </a>
                        
                        <?php if(!empty($priceFilter)): ?>
                        <a href="<?php echo buildCategoryFilterUrl($cid, array('price' => null)); ?>" class="text-xs text-stone-500 hover:text-primary mt-2 inline-block">
                            ← Clear price filter
                        </a>
                        <?php endif; ?>
                    </div>
                </div>
                
            </aside>
            
            <!-- Products Grid -->
            <div class="w-full lg:w-4/5">
                <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-x-8 gap-y-8 sm:gap-y-16">
                    <?php
                    $productQuery = mysqli_query($con, "SELECT * FROM products $whereClause $orderBy LIMIT $offset, $productsPerPage");
                    $productCount = mysqli_num_rows($productQuery);
                    
                    if($productCount > 0) {
                        while($product = mysqli_fetch_array($productQuery)) {
                            $isOutOfStock = $product['productAvailability'] != 'In Stock';
                    ?>
                    <!-- Product Card -->
                    <div class="product-card-wrapper group">
                        <div class="relative aspect-[3/4] mb-4 sm:mb-6 overflow-hidden bg-stone-100 border border-stone-100">
                            <!-- Product Image -->
                            <a href="product-details.php?pid=<?php echo $product['id']; ?>" class="product-image-container block w-full h-full">
                                <img alt="<?php echo htmlentities($product['productName']); ?>" 
                                     class="w-full h-full object-cover" 
                                     src="admin/productimages/<?php echo $product['id']; ?>/<?php echo $product['productImage1']; ?>"
                                     loading="lazy"/>
                            </a>
                            
                            <!-- Wishlist Button -->
                            <div class="absolute top-2 sm:top-4 right-2 sm:right-4">
                                <?php if(strlen($_SESSION['login']) > 0) { ?>
                                <a href="category.php?cid=<?php echo $cid; ?>&pid=<?php echo $product['id']; ?>&action=wishlist<?php echo !empty($priceFilter) ? '&price=' . $priceFilter : ''; ?>" 
                                   class="wishlist-btn w-8 h-8 sm:w-10 sm:h-10 bg-white/80 backdrop-blur rounded-full flex items-center justify-center shadow-sm transition-all" style="color: #333;">
                                    <i class="icon anm anm-heart-l" style="font-size: 18px;"></i>
                                </a>
                                <?php } else { ?>
                                <a href="login.php" 
                                   class="wishlist-btn w-8 h-8 sm:w-10 sm:h-10 bg-white/80 backdrop-blur rounded-full flex items-center justify-center shadow-sm transition-all" style="color: #333;">
                                    <i class="icon anm anm-heart-l" style="font-size: 18px;"></i>
                                </a>
                                <?php } ?>
                            </div>
                            
                            <!-- Out of Stock Badge -->
                            <?php if($isOutOfStock): ?>
                            <div class="absolute top-2 sm:top-4 left-2 sm:left-4">
                                <span class="bg-stone-800 text-white text-[8px] sm:text-[10px] tracking-widest uppercase py-1 px-2 sm:px-3">
                                    Out of Stock
                                </span>
                            </div>
                            <?php endif; ?>
                            
                            <!-- Sale Badge -->
                            <?php if($product['productPriceBeforeDiscount'] > $product['productPrice']): 
                                $discount = round((($product['productPriceBeforeDiscount'] - $product['productPrice']) / $product['productPriceBeforeDiscount']) * 100);
                            ?>
                            <div class="absolute top-2 sm:top-4 left-2 sm:left-4 <?php echo $isOutOfStock ? 'top-10 sm:top-14' : ''; ?>">
                                <span class="text-white text-[8px] sm:text-[10px] tracking-widest uppercase py-1 px-2 sm:px-3" style="background-color: #800020;">
                                    <?php echo $discount; ?>% Off
                                </span>
                            </div>
                            <?php endif; ?>
                            
                            <!-- Quick Add Button -->
                            <div class="quick-add-btn absolute bottom-0 left-0 right-0 p-2 sm:p-4 bg-white/90 backdrop-blur">
                                <?php if(!$isOutOfStock): ?>
                                <a href="category.php?cid=<?php echo $cid; ?>&action=add&id=<?php echo $product['id']; ?><?php echo !empty($priceFilter) ? '&price=' . $priceFilter : ''; ?>" 
                                   class="quick-add-link block w-full py-2 sm:py-3 bg-stone-900 text-white text-[10px] sm:text-xs tracking-widest uppercase hover:bg-primary transition-colors text-center">
                                    <span class="quick-add-text">Quick Add</span>
                                </a>
                                <?php else: ?>
                                <button disabled class="w-full py-2 sm:py-3 bg-stone-400 text-white text-[10px] sm:text-xs tracking-widest uppercase cursor-not-allowed text-center">
                                    Out of Stock
                                </button>
                                <?php endif; ?>
                            </div>
                        </div>
                        
                        <!-- Product Details -->
                        <div class="text-center space-y-1 sm:space-y-2">
                            <h3 class="small-caps text-sm sm:text-lg tracking-wider text-stone-800" style="font-family: 'Cormorant Garamond', serif;">
                                <a href="product-details.php?pid=<?php echo $product['id']; ?>" class="hover:text-primary transition-colors">
                                    <?php echo htmlentities($product['productName']); ?>
                                </a>
                            </h3>
                            <div class="flex items-center justify-center gap-2 sm:gap-3 flex-wrap">
                                <span class="font-medium text-sm sm:text-base" style="color: #800020;">₹ <?php echo number_format($product['productPrice'], 2); ?></span>
                                <?php if($product['productPriceBeforeDiscount'] > $product['productPrice']): ?>
                                <span class="text-[10px] sm:text-xs line-through" style="color: #9ca3af;">₹ <?php echo number_format($product['productPriceBeforeDiscount'], 2); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php 
                        }
                    } else {
                    ?>
                    <!-- No Products Found -->
                    <div class="col-span-full text-center py-16">
                        <i class="icon anm anm-box-l" style="font-size: 60px; color: #d1d5db; display: block; margin-bottom: 16px;"></i>
                        <h3 class="text-xl text-stone-600 mb-2" style="font-family: 'Playfair Display', serif;">No Products Found</h3>
                        <p class="text-stone-400 mb-4">
                            <?php if(!empty($priceFilter)): ?>
                            No products found in this price range. Try a different filter.
                            <?php else: ?>
                            This category doesn't have any products yet. Check back soon!
                            <?php endif; ?>
                        </p>
                        <?php if(!empty($priceFilter)): ?>
                        <a href="category.php?cid=<?php echo $cid; ?>" class="clear-filters-btn inline-block py-3 px-8 text-white text-xs tracking-widest uppercase transition-colors" style="background-color: #800020;">
                            <span class="btn-text">Clear Filters</span>
                        </a>
                        <?php else: ?>
                        <a href="all-category.php" class="clear-filters-btn inline-block py-3 px-8 text-white text-xs tracking-widest uppercase transition-colors" style="background-color: #800020;">
                            <span class="btn-text">Browse All Collections</span>
                        </a>
                        <?php endif; ?>
                    </div>
                    <?php } ?>
                </div>
                
                <!-- Pagination -->
                <?php if($totalPages > 1): ?>
                <div class="mt-12 sm:mt-20 flex items-center justify-center gap-2 sm:gap-4 flex-wrap">
                    <?php 
                    // Previous button
                    if($page > 1): ?>
                    <a href="<?php echo buildCategoryPageUrl($page - 1); ?>" 
                       class="pagination-btn w-8 h-8 sm:w-10 sm:h-10 flex items-center justify-center border border-stone-300 hover:border-primary hover:text-primary transition-all">
                        <i class="icon anm anm-angle-left-l"></i>
                    </a>
                    <?php endif; ?>
                    
                    <?php 
                    // Page numbers
                    $startPage = max(1, $page - 2);
                    $endPage = min($totalPages, $page + 2);
                    
                    if($startPage > 1): ?>
                    <a href="<?php echo buildCategoryPageUrl(1); ?>" class="pagination-btn w-8 h-8 sm:w-10 sm:h-10 flex items-center justify-center border border-stone-300 text-sm sm:text-base">1</a>
                    <?php if($startPage > 2): ?>
                    <span class="text-stone-400">...</span>
                    <?php endif; ?>
                    <?php endif; ?>
                    
                    <?php for($i = $startPage; $i <= $endPage; $i++): ?>
                    <a href="<?php echo buildCategoryPageUrl($i); ?>" 
                       class="pagination-btn w-8 h-8 sm:w-10 sm:h-10 flex items-center justify-center border border-stone-300 text-sm sm:text-base <?php echo $i == $page ? 'active' : ''; ?> hover:border-primary hover:text-primary transition-all">
                        <?php echo $i; ?>
                    </a>
                    <?php endfor; ?>
                    
                    <?php if($endPage < $totalPages): ?>
                    <?php if($endPage < $totalPages - 1): ?>
                    <span class="text-stone-400">...</span>
                    <?php endif; ?>
                    <a href="<?php echo buildCategoryPageUrl($totalPages); ?>" class="pagination-btn w-8 h-8 sm:w-10 sm:h-10 flex items-center justify-center border border-stone-300 text-sm sm:text-base"><?php echo $totalPages; ?></a>
                    <?php endif; ?>
                    
                    <?php 
                    // Next button
                    if($page < $totalPages): ?>
                    <a href="<?php echo buildCategoryPageUrl($page + 1); ?>" 
                       class="pagination-btn w-8 h-8 sm:w-10 sm:h-10 flex items-center justify-center border border-stone-300 hover:border-primary hover:text-primary transition-all">
                        <i class="icon anm anm-angle-right-l"></i>
                    </a>
                    <?php endif; ?>
                </div>
                
                <!-- Page info -->
                <div class="text-center mt-4 text-xs text-stone-400">
                    Showing <?php echo $offset + 1; ?> - <?php echo min($offset + $productsPerPage, $totalProducts); ?> of <?php echo $totalProducts; ?> products
                </div>
                <?php endif; ?>
            </div>
        </div>
    </main>
</div>

<script>
// Mobile filter toggle
function toggleFilters() {
    const sidebar = document.getElementById('filterSidebar');
    sidebar.classList.toggle('show');
}
</script>

<?php include 'footer.php'; ?>
