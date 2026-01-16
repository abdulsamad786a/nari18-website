<?php 
session_start();
error_reporting(0);
include('includes/config.php');

// Handle Add to Cart via AJAX
if(isset($_GET['ajax']) && $_GET['ajax']=="add" && isset($_GET['id'])){
	$id=intval($_GET['id']);
	$quantity = isset($_GET['qty']) ? intval($_GET['qty']) : 1;
	
	if(isset($_SESSION['cart'][$id])){
		$_SESSION['cart'][$id]['quantity'] += $quantity;
	}else{
		$sql_p="SELECT * FROM products WHERE id={$id}";
		$query_p=mysqli_query($con,$sql_p);
		if(mysqli_num_rows($query_p)!=0){
			$row_p=mysqli_fetch_array($query_p);
			$_SESSION['cart'][$row_p['id']]=array("quantity" => $quantity, "price" => $row_p['productPrice']);
		}
	}
	echo "success";
	exit();
}

$pid=intval($_GET['pid']);
if(isset($_GET['pid']) && $_GET['action']=="wishlist" ){
	if(strlen($_SESSION['login'])==0)
    {   
header('location:login.php');
}
else
{
mysqli_query($con,"insert into wishlist(userId,productId) values('".$_SESSION['id']."','$pid')");
$_SESSION['wishlist_notification'] = 'Product added to wishlist successfully!';
header('location:my-wishlist.php');
exit();
}
}

?>
<?php include 'header.php';?>

<!-- Tailwind CSS CDN -->
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet"/>
<!-- Material Icons - Multiple sources for reliability -->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
<style>
    /* Force Material Icons to render properly */
    .material-icons-outlined,
    .material-icons,
    .material-symbols-outlined {
        font-family: 'Material Icons Outlined', 'Material Icons', 'Material Symbols Outlined' !important;
        font-weight: normal !important;
        font-style: normal !important;
        font-size: inherit !important;
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
<script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    primary: "#800020",
                    "gold": "#D4AF37",
                    "background-light": "#F9F7F2",
                },
                fontFamily: {
                    display: ["Playfair Display", "serif"],
                    sans: ["Inter", "sans-serif"],
                },
            },
        },
    };
</script>

<style>
    .product-page-wrapper {
        font-family: 'Inter', sans-serif;
        background: #F9F7F2;
    }
    .product-page-wrapper * {
        box-sizing: border-box;
    }
    .zoom-hover:hover img {
        transform: scale(1.05);
    }
    .custom-scrollbar::-webkit-scrollbar {
        height: 4px;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #D4AF37;
        border-radius: 10px;
    }
    /* Accordion styles */
    .accordion-item {
        /* border handled by tailwind */
    }
    .accordion-header {
        cursor: pointer;
        transition: all 0.2s ease;
    }
    .accordion-content {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.35s ease-out;
    }
    .accordion-content.active {
        max-height: 800px;
    }
    .accordion-icon {
        transition: transform 0.2s ease;
        line-height: 1;
    }
    .accordion-header.active .accordion-icon {
        transform: rotate(45deg);
    }
    /* Thumbnail active state */
    .thumbnail-item.active {
        border-color: #800020 !important;
        border-width: 2px !important;
    }
    /* Add to Cart button hover */
    .btn-add-cart {
        background-color: #800020;
    }
    .btn-add-cart:hover {
        background-color: #600018;
    }
    .btn-add-cart span {
        color: #ffffff;
        transition: color 0.3s ease;
    }
    .btn-add-cart:hover span {
        color: #D4AF37 !important;
    }
    /* Toast notification */
    @keyframes slideIn {
        from { transform: translateX(400px); opacity: 0; }
        to { transform: translateX(0); opacity: 1; }
    }
    @keyframes slideOut {
        from { transform: translateX(0); opacity: 1; }
        to { transform: translateX(400px); opacity: 0; }
    }
</style>

<?php 
$ret=mysqli_query($con,"select * from products where id='$pid'");
$row=mysqli_fetch_array($ret);

// Get category and subcategory names for breadcrumb
$breadcrumb_query = mysqli_query($con,"select category.categoryName as catname, subcategory.subcategory as subcatname, products.productName as pname from products join category on category.id=products.category join subcategory on subcategory.id=products.subCategory where products.id='$pid'");
$breadcrumb = mysqli_fetch_array($breadcrumb_query);
?>

<!-- Product Page Content -->
<div class="product-page-wrapper">
    <!-- Breadcrumbs -->
    <nav class="max-w-7xl mx-auto px-4 sm:px-6 py-6 sm:py-8">
        <ol class="flex flex-wrap items-center gap-2 text-[10px] uppercase tracking-widest text-stone-400">
            <li><a class="hover:text-stone-900 transition-colors" href="index.php">Home</a></li>
            <li><svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg></li>
            <li><a class="hover:text-stone-900 transition-colors" href="category.php?cid=<?php echo $row['category'];?>"><?php echo htmlentities($breadcrumb['catname']);?></a></li>
            <li><svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg></li>
            <li class="text-stone-900 font-semibold"><?php echo htmlentities($row['productName']);?></li>
        </ol>
    </nav>

    <!-- Main Product Section -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 pb-16 sm:pb-24">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-16">
            
            <!-- Product Images - Left Side -->
            <div class="lg:col-span-7 space-y-4">
                <!-- Main Image -->
                <div class="zoom-hover overflow-hidden rounded-lg bg-stone-100 aspect-[4/5] relative">
                    <img id="main-product-image" 
                        alt="<?php echo htmlentities($row['productName']);?>" 
                        class="w-full h-full object-cover transition-transform duration-700 ease-in-out cursor-zoom-in" 
                        src="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>"
                    />
                    <?php if($row['productAvailability']=='In Stock'): ?>
                    <div class="absolute top-4 right-4 bg-white/90 px-3 py-1 text-[10px] tracking-widest uppercase font-semibold rounded">New Arrival</div>
                    <?php else: ?>
                    <div class="absolute top-4 right-4 bg-red-600 text-white px-3 py-1 text-[10px] tracking-widest uppercase font-semibold rounded">Out of Stock</div>
                    <?php endif; ?>
                </div>
                
                <!-- Thumbnails -->
                <div class="grid grid-cols-4 gap-3 sm:gap-4">
                    <?php 
                    for($imgno = 1; $imgno <= 3; $imgno++) {
                        $imgVar = 'productImage' . $imgno;
                        if(!empty($row[$imgVar])) {
                    ?>
                    <div class="thumbnail-item aspect-[3/4] rounded bg-stone-100 overflow-hidden cursor-pointer border-2 <?php echo ($imgno == 1) ? 'border-primary' : 'border-transparent hover:border-stone-300';?> transition-all"
                        onclick="switchImage('admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row[$imgVar]);?>', this)">
                        <img alt="Thumbnail <?php echo $imgno;?>" 
                            class="w-full h-full object-cover opacity-90 hover:opacity-100 transition-opacity" 
                            src="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row[$imgVar]);?>"
                        />
                    </div>
                    <?php 
                        }
                    }
                    ?>
                    <?php if(!empty($row['productVideo'])): ?>
                    <div class="aspect-[3/4] rounded bg-stone-200 overflow-hidden cursor-pointer border-2 border-transparent hover:border-stone-300 flex items-center justify-center transition-all"
                        onclick="openVideoModal()">
                        <span class="text-xs uppercase tracking-tight font-medium text-stone-600">+ Video</span>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            
            <!-- Product Details - Right Side -->
            <div class="lg:col-span-5 flex flex-col">
                <!-- Product Header -->
                <div class="border-b border-stone-200 pb-6 sm:pb-8">
                    <!-- Reviews -->
                    <div class="flex items-center gap-1 mb-3">
                        <svg class="w-4 h-4 text-[#D4AF37]" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <svg class="w-4 h-4 text-[#D4AF37]" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <svg class="w-4 h-4 text-[#D4AF37]" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <svg class="w-4 h-4 text-[#D4AF37]" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <svg class="w-4 h-4 text-[#D4AF37]" viewBox="0 0 20 20"><defs><linearGradient id="half"><stop offset="50%" stop-color="#D4AF37"/><stop offset="50%" stop-color="#e5e7eb"/></linearGradient></defs><path fill="url(#half)" d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <span class="text-[11px] text-stone-500 uppercase tracking-widest ml-2">(48 Reviews)</span>
                    </div>
                    
                    <!-- Product Name -->
                    <h2 class="font-display text-3xl sm:text-4xl lg:text-5xl font-semibold mb-4 leading-tight text-stone-900">
                        <?php echo htmlentities($row['productName']);?>
                    </h2>
                    
                    <!-- Price -->
                    <div class="flex flex-wrap items-baseline gap-3 sm:gap-4 mb-6">
                        <span class="text-xl sm:text-2xl font-light tracking-tight text-stone-900">Rs. <?php echo number_format($row['productPrice']);?>.00</span>
                        <?php if($row['productPriceBeforeDiscount'] > $row['productPrice']): ?>
                        <span class="text-stone-400 line-through text-base sm:text-lg font-light">Rs. <?php echo number_format($row['productPriceBeforeDiscount']);?>.00</span>
                        <?php 
                        $discount = round((($row['productPriceBeforeDiscount'] - $row['productPrice']) / $row['productPriceBeforeDiscount']) * 100);
                        ?>
                        <span class="text-primary text-xs font-bold uppercase tracking-widest bg-primary/5 px-2 py-1 rounded">Save <?php echo $discount;?>%</span>
                        <?php endif; ?>
                    </div>
                    
                    <!-- Short Description -->
                    <p class="text-sm text-stone-600 leading-relaxed max-w-md">
                        <?php 
                        $description = $row['productDescription'];
                        $words = explode(' ', strip_tags($description), 36);
                        if(count($words) > 35){
                            array_pop($words);
                            array_push($words, '...');
                        }
                        echo implode(' ', $words);
                        ?>
                    </p>
                </div>
                
                <!-- Product Options -->
                <div class="py-6 sm:py-8 space-y-6 sm:space-y-8">
                    <!-- Quantity & Add to Cart -->
                    <div class="space-y-4">
                        <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-4">
                            <!-- Quantity -->
                            <div class="flex items-center h-14">
                                <button onclick="decrementQty()" class="px-4 py-2 hover:text-primary transition-colors text-lg">−</button>
                                <input type="text" id="product-quantity" value="1" class="w-12 text-center bg-transparent border-none focus:ring-0 text-sm" readonly />
                                <button onclick="incrementQty()" class="px-4 py-2 hover:text-primary transition-colors text-lg">+</button>
                            </div>
                            <!-- Add to Cart -->
                            <div class="flex-1">
                                <?php if($row['productAvailability']=='In Stock'):?>
                                <button onclick="addToCart(<?php echo $row['id'];?>)" 
                                    class="btn-add-cart w-full h-14 text-[11px] uppercase tracking-[0.2em] font-bold transition-all transform active:scale-95 shadow-lg shadow-primary/20 rounded">
                                    <span>Add to Cart</span>
                                </button>
                                <?php else: ?>
                                <button disabled 
                                    class="w-full h-14 bg-stone-400 text-white text-[11px] uppercase tracking-[0.2em] font-bold cursor-not-allowed rounded">
                                    Out of Stock
                                </button>
                                <?php endif; ?>
                            </div>
                        </div>
                        
                        <!-- Buy it Now -->
                        <?php if($row['productAvailability']=='In Stock'):?>
                        <button onclick="buyNow(<?php echo $row['id'];?>)" 
                            class="w-full h-14 border-2 border-[#D4AF37] text-stone-800 text-[11px] uppercase tracking-[0.2em] font-bold hover:bg-[#D4AF37] hover:text-white transition-all transform active:scale-95 rounded">
                            Buy it Now
                        </button>
                        <?php endif; ?>
                        
                        <!-- Wishlist -->
                        <div class="flex justify-center pt-2">
                            <a href="product-details.php?pid=<?php echo htmlentities($row['id'])?>&&action=wishlist" 
                                class="flex items-center gap-2 text-[10px] uppercase tracking-widest text-stone-500 hover:text-primary transition-colors group">
                                <svg class="w-4 h-4 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                                Add to Wishlist
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Accordion Section (Details & Care) -->
                <div class="border-t border-stone-200 pt-6 sm:pt-8">
                    <!-- Accordion Card Container -->
                    <div class="bg-white rounded-xl border border-stone-200 overflow-hidden shadow-sm">
                        <!-- Description Accordion -->
                        <div class="accordion-item border-b border-stone-100">
                            <div class="accordion-header px-5 py-4 flex items-center justify-between cursor-pointer hover:bg-stone-50 transition-colors" onclick="toggleAccordion(this)">
                                <div class="flex items-center gap-4">
                                    <svg class="w-5 h-5 text-stone-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"></path></svg>
                                    <span class="text-sm font-medium text-stone-700">Description</span>
                                </div>
                                <span class="accordion-icon text-xl text-stone-400 font-light">+</span>
                            </div>
                            <div class="accordion-content">
                                <div class="px-5 pb-5 pl-14 text-sm text-stone-600 leading-relaxed">
                                    <?php echo $row['productDescription'];?>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Free Shipping Accordion -->
                        <div class="accordion-item border-b border-stone-100">
                            <div class="accordion-header px-5 py-4 flex items-center justify-between cursor-pointer hover:bg-stone-50 transition-colors" onclick="toggleAccordion(this)">
                                <div class="flex items-center gap-4">
                                    <svg class="w-5 h-5 text-stone-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12"></path></svg>
                                    <span class="text-sm font-medium text-stone-700">Free Shipping</span>
                                </div>
                                <span class="accordion-icon text-xl text-stone-400 font-light">+</span>
                            </div>
                            <div class="accordion-content">
                                <div class="px-5 pb-5 pl-14 text-sm text-stone-600 leading-relaxed">
                                    <p class="mb-2">
                                        <?php if($row['shippingCharge']==0): ?>
                                        <strong class="text-green-600">✓ Free shipping</strong> on this product!
                                        <?php else: ?>
                                        Shipping charge: <strong>Rs. <?php echo $row['shippingCharge'];?></strong>
                                        <?php endif; ?>
                                    </p>
                                    <ul class="list-disc pl-4 space-y-1">
                                        <li>Estimated delivery: 5-7 business days</li>
                                        <li>Free shipping on orders above ₹5000</li>
                                        <li>Express delivery available at checkout</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Care Guide Accordion -->
                        <div class="accordion-item border-b border-stone-100">
                            <div class="accordion-header px-5 py-4 flex items-center justify-between cursor-pointer hover:bg-stone-50 transition-colors" onclick="toggleAccordion(this)">
                                <div class="flex items-center gap-4">
                                    <svg class="w-5 h-5 text-stone-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9.75 3.104v5.714a2.25 2.25 0 01-.659 1.591L5 14.5M9.75 3.104c-.251.023-.501.05-.75.082m.75-.082a24.301 24.301 0 014.5 0m0 0v5.714c0 .597.237 1.17.659 1.591L19.8 15.3M14.25 3.104c.251.023.501.05.75.082M19.8 15.3l-1.57.393A9.065 9.065 0 0112 15a9.065 9.065 0 00-6.23.693L5 15.5m14.8-.2l-.312.077a3.001 3.001 0 01-2.593-.377l-.89-.534a2.251 2.251 0 00-2.006-.136l-.905.362a2.252 2.252 0 01-1.69 0l-.905-.362a2.251 2.251 0 00-2.006.136l-.89.534a3.001 3.001 0 01-2.593.377L5 15.5m0 0v2.25A2.25 2.25 0 007.25 20h9.5A2.25 2.25 0 0019 17.75V15.5"></path></svg>
                                    <span class="text-sm font-medium text-stone-700">Care Guide</span>
                                </div>
                                <span class="accordion-icon text-xl text-stone-400 font-light">+</span>
                            </div>
                            <div class="accordion-content">
                                <div class="px-5 pb-5 pl-14 text-sm text-stone-600 leading-relaxed">
                                    <ul class="list-disc pl-4 space-y-1">
                                        <li>Dry clean recommended for best results</li>
                                        <li>Store in a cool, dry place</li>
                                        <li>Iron on low heat with protective cloth</li>
                                        <li>Avoid direct sunlight when drying</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Secure Payment (static - no accordion) -->
                        <div class="px-5 py-4 flex items-center gap-4">
                            <svg class="w-5 h-5 text-stone-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"></path></svg>
                            <span class="text-sm font-medium text-stone-700">Secure payment</span>
                        </div>
                    </div>
                    
                    <!-- Trust Badges -->
                    <div class="bg-stone-50 px-3 py-3 mt-6 rounded-lg border border-stone-100">
                        <div class="flex items-center justify-between text-[9px] sm:text-[10px] uppercase tracking-wider font-medium text-stone-500">
                            <div class="flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12"></path></svg>
                                <span>Free Shipping</span>
                            </div>
                            <div class="flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <span>7 Days Return</span>
                            </div>
                            <div class="flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                                <span>Authenticity</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Products Section -->
        <section class="mt-20 sm:mt-32">
            <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-8 sm:mb-12 gap-4">
                <div class="space-y-2">
                    <span class="text-[10px] uppercase tracking-[0.3em] font-semibold" style="color: #800020;">Curated for you</span>
                    <h3 class="font-display text-3xl sm:text-4xl font-semibold text-stone-900">Related Products</h3>
                </div>
                <div class="flex gap-4">
                    <button onclick="scrollRelated('left')" class="w-10 h-10 rounded-full border border-stone-300 flex items-center justify-center hover:bg-stone-100 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    </button>
                    <button onclick="scrollRelated('right')" class="w-10 h-10 rounded-full border border-stone-300 flex items-center justify-center hover:bg-stone-100 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </button>
                </div>
            </div>
            
            <div id="related-products" class="flex gap-6 sm:gap-8 overflow-x-auto pb-8 sm:pb-12 custom-scrollbar snap-x scroll-smooth">
                <?php
                $cid=$row['category'];
                $subcid=$row['subCategory']; 
                $qry=mysqli_query($con,"select * from products where subCategory='$subcid' and category='$cid' and id!='$pid' limit 8");
                $num=mysqli_num_rows($qry);
                if($num>0) {
                    while($relatedRow=mysqli_fetch_array($qry)) {
                ?>
                <div class="min-w-[260px] sm:min-w-[300px] snap-start group">
                    <div class="aspect-[3/4] bg-stone-100 rounded-lg overflow-hidden relative mb-4">
                        <a href="product-details.php?pid=<?php echo htmlentities($relatedRow['id']);?>">
                            <img alt="<?php echo htmlentities($relatedRow['productName']);?>" 
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" 
                                src="admin/productimages/<?php echo htmlentities($relatedRow['id']);?>/<?php echo htmlentities($relatedRow['productImage1']);?>"
                            />
                        </a>
                        <button class="absolute bottom-4 left-4 right-4 bg-white/90 py-3 text-[10px] uppercase tracking-widest font-bold opacity-0 translate-y-2 group-hover:opacity-100 group-hover:translate-y-0 transition-all rounded">
                            <a href="product-details.php?pid=<?php echo htmlentities($relatedRow['id']);?>">Quick View</a>
                        </button>
                        <a href="product-details.php?pid=<?php echo htmlentities($relatedRow['id'])?>&&action=wishlist" 
                            class="absolute top-4 right-4 text-stone-800 hover:text-primary transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                        </a>
                    </div>
                    <a href="product-details.php?pid=<?php echo htmlentities($relatedRow['id']);?>">
                        <h4 class="text-sm font-medium tracking-tight group-hover:text-primary transition-colors text-stone-900">
                            <?php echo htmlentities($relatedRow['productName']);?>
                        </h4>
                    </a>
                    <p class="text-stone-500 text-xs mt-1">Rs. <?php echo number_format($relatedRow['productPrice']);?>.00</p>
                </div>
                <?php 
                    }
                } else { 
                ?>
                <p class="text-stone-500">No related products found in this category.</p>
                <?php } ?>
            </div>
        </section>
    </main>
</div>

<!-- Video Modal (if product has video) -->
<?php if(!empty($row['productVideo'])): ?>
<div id="video-modal" class="fixed inset-0 bg-black/80 z-50 flex items-center justify-center p-4 hidden">
    <div class="bg-white rounded-lg max-w-4xl w-full overflow-hidden relative">
        <button onclick="closeVideoModal()" class="absolute top-4 right-4 z-10 w-10 h-10 bg-white rounded-full flex items-center justify-center hover:bg-stone-100 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
        <div class="aspect-video">
            <iframe id="video-iframe" 
                class="w-full h-full"
                src="" 
                frameborder="0" 
                allow="autoplay; encrypted-media" 
                allowfullscreen>
            </iframe>
        </div>
    </div>
</div>
<?php endif; ?>

<!-- Toast Notification -->
<div id="cart-toast" style="display: none; position: fixed; top: 20px; right: 20px; background: #28a745; color: white; padding: 15px 25px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.15); z-index: 9999; font-size: 14px; animation: slideIn 0.3s ease-out;">
    <svg style="width: 20px; height: 20px; vertical-align: middle; margin-right: 8px; display: inline-block;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
    <span id="toast-message">Product added to cart successfully!</span>
</div>

<!-- JavaScript -->
<script>
// Quantity Controls
function incrementQty() {
    var input = document.getElementById('product-quantity');
    var val = parseInt(input.value) || 1;
    input.value = val + 1;
}

function decrementQty() {
    var input = document.getElementById('product-quantity');
    var val = parseInt(input.value) || 1;
    if (val > 1) input.value = val - 1;
}

// Add to Cart Function
function addToCart(productId) {
    var quantity = parseInt(document.getElementById('product-quantity').value);
    
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'product-details.php?pid=<?php echo $pid;?>&ajax=add&id=' + productId + '&qty=' + quantity, true);
    
    xhr.onload = function() {
        if (xhr.status === 200 && xhr.responseText === 'success') {
            showToast('Product added to cart successfully!');
            setTimeout(function () {
                window.location.reload();
            }, 1000);
        }
    };
    
    xhr.send();
}

// Buy Now Function
function buyNow(productId) {
    var quantity = parseInt(document.getElementById('product-quantity').value);
    
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'product-details.php?pid=<?php echo $pid;?>&ajax=add&id=' + productId + '&qty=' + quantity, true);
    
    xhr.onload = function() {
        if (xhr.status === 200 && xhr.responseText === 'success') {
            window.location.href = 'my-cart.php';
        }
    };
    
    xhr.send();
}

// Show Toast Notification
function showToast(message) {
    var toast = document.getElementById('cart-toast');
    var toastMessage = document.getElementById('toast-message');
    
    toastMessage.textContent = message;
    toast.style.display = 'block';
    toast.style.animation = 'slideIn 0.3s ease-out';
    
    setTimeout(function() {
        toast.style.animation = 'slideOut 0.3s ease-out';
        setTimeout(function() {
            toast.style.display = 'none';
        }, 300);
    }, 2000);
}

// Image Switcher
function switchImage(src, element) {
    document.getElementById('main-product-image').src = src;
    
    // Update active thumbnail
    document.querySelectorAll('.thumbnail-item').forEach(function(thumb) {
        thumb.classList.remove('active');
        thumb.classList.remove('border-primary');
        thumb.classList.add('border-transparent');
    });
    element.classList.add('active');
    element.classList.add('border-primary');
    element.classList.remove('border-transparent');
}

// Accordion Toggle
function toggleAccordion(header) {
    var content = header.nextElementSibling;
    var icon = header.querySelector('.accordion-icon');
    
    // Close other accordions
    document.querySelectorAll('.accordion-content').forEach(function(item) {
        if (item !== content) {
            item.classList.remove('active');
            item.previousElementSibling.classList.remove('active');
        }
    });
    
    // Toggle current accordion
    header.classList.toggle('active');
    content.classList.toggle('active');
}

// Related Products Scroll
function scrollRelated(direction) {
    var container = document.getElementById('related-products');
    var scrollAmount = 320;
    
    if (direction === 'left') {
        container.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
    } else {
        container.scrollBy({ left: scrollAmount, behavior: 'smooth' });
    }
}

// Video Modal Functions
<?php if(!empty($row['productVideo'])): ?>
function openVideoModal() {
    var modal = document.getElementById('video-modal');
    var iframe = document.getElementById('video-iframe');
    iframe.src = 'https://www.youtube.com/embed/<?php echo htmlentities($row['productVideo']); ?>?autoplay=1';
    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeVideoModal() {
    var modal = document.getElementById('video-modal');
    var iframe = document.getElementById('video-iframe');
    iframe.src = '';
    modal.classList.add('hidden');
    document.body.style.overflow = '';
}

// Close modal on outside click
document.getElementById('video-modal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeVideoModal();
    }
});
<?php endif; ?>
</script>

<?php include 'footer.php'?>
