<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
    {   
header('location:login.php');
}
else{
// Code forProduct deletion from  wishlist	
$wid=intval($_GET['del']);
if(isset($_GET['del']))
{
$query=mysqli_query($con,"delete from wishlist where id='$wid'");
header('location:my-wishlist.php');
exit();
}


if(isset($_GET['action']) && $_GET['action']=="add"){
	$id=intval($_GET['id']);
	$query=mysqli_query($con,"delete from wishlist where productId='$id'");
	if(isset($_SESSION['cart'][$id])){
		$_SESSION['cart'][$id]['quantity']++;
	}else{
		$sql_p="SELECT * FROM products WHERE id={$id}";
		$query_p=mysqli_query($con,$sql_p);
		if(mysqli_num_rows($query_p)!=0){
			$row_p=mysqli_fetch_array($query_p);
			$_SESSION['cart'][$row_p['id']]=array("quantity" => 1, "price" => $row_p['productPrice']);	
		}
		else{
			$message="Product ID is invalid";
		}
	}
	header('location:my-wishlist.php');
	exit();
}

// Get wishlist count and items
$ret=mysqli_query($con,"select products.productName as pname, products.productAvailability as stock,products.productName as proid,products.productImage1 as pimage,products.productPrice as pprice,wishlist.productId as pid,wishlist.id as wid from wishlist join products on products.id=wishlist.productId where wishlist.userId='".$_SESSION['id']."'");
$num=mysqli_num_rows($ret);

?>
<?php include 'header.php'?>
<!-- Tailwind CSS for Wishlist Page -->
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&amp;family=Inter:wght@300;400;500;600&amp;family=Cinzel:wght@400;500;600&amp;display=swap" rel="stylesheet"/>
<!-- Material Icons for Wishlist Page -->
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
<style>
    /* Force Material Icons to render properly on wishlist page */
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
<script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>
<script>
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            colors: {
              primary: "#6d101d",
              "background-light": "#fdfbf7",
              "background-dark": "#121212",
              accent: "#8b1525",
            },
            fontFamily: {
              display: ["Playfair Display", "serif"],
              sans: ["Inter", "sans-serif"],
              serif: ["Playfair Display", "serif"],
              cinzel: ["Cinzel", "serif"],
            },
            borderRadius: {
              DEFAULT: "0px",
              "md": "2px",
            },
          },
        },
      };
    </script>
<style>
        .small-caps { font-variant: small-caps; letter-spacing: 0.1em; }
        .hero-gradient { background: linear-gradient(rgba(0,0,0,0.02), rgba(0,0,0,0)); }
        /* Override page wrapper for wishlist */
        #page-content { background: #fdfbf7; }
        
        /* Wishlist Add to Cart button hover effect - yellow/gold text */
        .wishlist-add-cart-btn {
            display: inline-block;
        }
        .wishlist-add-cart-btn:hover .button-text {
            color: #D4AF37 !important;
        }
        
        /* Close/Remove icon hover effect */
        .wishlist-remove-btn:hover svg {
            stroke: #b91c1c !important;
        }
        .alert-close-btn:hover svg {
            stroke: #15803d !important;
            opacity: 0.7;
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
            stroke: #6d101d;
        }
        .modal-title {
            font-family: 'Playfair Display', serif;
            font-size: 24px;
            font-weight: 400;
            color: #1c1917;
            margin-bottom: 12px;
        }
        .modal-desc {
            font-family: 'Inter', sans-serif;
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
            font-family: 'Inter', sans-serif;
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
            background: #6d101d;
            color: #fff;
        }
        .modal-btn-confirm:hover {
            background: #8b1525;
        }
        .modal-btn-confirm:hover .btn-text {
            color: #D4AF37 !important;
        }
        
        /* Notification Modal Styles */
        .notification-modal .modal-icon {
            border-color: #fce7f3;
            background: #fdf2f8;
        }
        .notification-modal .modal-icon svg {
            stroke: #6d101d;
            fill: #fce7f3;
        }
        .notification-modal .modal-btn-confirm {
            background: #6d101d;
        }
        .notification-modal .modal-btn-confirm:hover {
            background: #8b1525;
        }
        .notification-modal .modal-btn-confirm:hover .btn-text {
            color: #D4AF37 !important;
        }
    </style>
<main style="background: #fdfbf7; min-height: 100vh;">
<section class="pt-20 pb-12" style="background: #faf9f5; border-bottom: 1px solid #e5e7eb;">
<div class="max-w-7xl mx-auto px-6 text-center">
<h2 class="text-4xl lg:text-5xl font-light tracking-wide mb-6" style="font-family: 'Playfair Display', serif;">Wishlist</h2>
<nav class="flex justify-center items-center space-x-3 text-[11px] uppercase tracking-[0.2em]" style="color: #a8a29e;">
<a class="hover:text-stone-800 transition-colors" href="index.php" style="color: #a8a29e;">Home</a>
<span style="color: #d6d3d1;">/</span>
<span style="color: #1c1917;">Wishlist</span>
</nav>
</div>
</section>
<section class="max-w-7xl mx-auto px-6 py-20" style="min-height: 500px;">
<?php if($num > 0): ?>
<!-- Alert Banner -->
<div class="px-6 py-3 mb-8 flex items-center justify-between" style="background: #f0fdf4; border: 1px solid #bbf7d0;">
<div class="text-sm" style="color: #15803d;">
There are <strong><?php echo $num; ?></strong> products in this wishlist
</div>
<button type="button" onclick="this.parentElement.style.display='none'" class="alert-close-btn">
<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#15803d" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="transition: all 0.3s;"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
</button>
</div>

<div class="overflow-x-auto">
<table class="w-full text-left">
<thead>
<tr style="border-bottom: 1px solid #e5e7eb;">
<th class="pb-6 text-sm font-medium tracking-widest w-16" style="font-variant: small-caps; letter-spacing: 0.1em; color: #a8a29e; font-family: 'Playfair Display', serif;"></th>
<th class="pb-6 text-sm font-medium tracking-widest" style="font-variant: small-caps; letter-spacing: 0.1em; color: #a8a29e; font-family: 'Playfair Display', serif;">Product</th>
<th class="pb-6 text-sm font-medium tracking-widest" style="font-variant: small-caps; letter-spacing: 0.1em; color: #a8a29e; font-family: 'Playfair Display', serif;">Price</th>
<th class="pb-6 text-sm font-medium tracking-widest" style="font-variant: small-caps; letter-spacing: 0.1em; color: #a8a29e; font-family: 'Playfair Display', serif;">Stock Status</th>
<th class="pb-6 text-sm font-medium tracking-widest text-right" style="font-variant: small-caps; letter-spacing: 0.1em; color: #a8a29e; font-family: 'Playfair Display', serif;">Action</th>
</tr>
</thead>
<tbody style="border-top: 1px solid #f5f5f4;">
<?php
// Reset the query result pointer
mysqli_data_seek($ret, 0);
while ($row=mysqli_fetch_array($ret)) {
    // Check if collection field exists, otherwise use empty string
    $collection = isset($row['productCollection']) ? $row['productCollection'] : '';
?>
<tr style="border-top: 1px solid #f5f5f4;">
<td class="py-10 pr-6 align-middle">
<button type="button" onclick="showRemoveModal(<?php echo htmlentities($row['wid']);?>, '<?php echo addslashes(htmlentities($row['pname']));?>')" class="wishlist-remove-btn inline-block bg-transparent border-none cursor-pointer p-0">
<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#d6d3d1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="transition: all 0.3s;"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
</button>
</td>
<td class="py-10">
<div class="flex items-center gap-6">
<div class="overflow-hidden relative" style="width: 96px; height: 128px; background: #f5f5f4;">
<a href="product-details.php?pid=<?php echo htmlentities($row['pid']);?>" class="block w-full h-full">
<img alt="<?php echo htmlentities($row['pname']);?>" class="w-full h-full object-cover cursor-pointer" style="filter: grayscale(100%); transition: filter 0.7s;" onmouseover="this.style.filter='grayscale(0%)'" onmouseout="this.style.filter='grayscale(100%)'" src="admin/productimages/<?php echo htmlentities($row['pid']);?>/<?php echo htmlentities($row['pimage']);?>" />
</a>
</div>
<div>
<h3 class="text-lg tracking-wide cursor-pointer" style="font-family: 'Playfair Display', serif;">
<a href="product-details.php?pid=<?php echo htmlentities($row['pid']);?>" class="hover:text-primary transition-colors" style="color: #1c1917;"><?php echo htmlentities($row['pname']);?></a>
</h3>
<?php if(!empty($collection)): ?>
<p class="text-[10px] uppercase tracking-widest mt-1" style="color: #a8a29e;">Collection: <?php echo htmlentities($collection); ?></p>
<?php endif; ?>
</div>
</div>
</td>
<td class="py-10">
<span class="tracking-wider" style="color: #57534e; font-family: 'Inter', sans-serif;">RS: <?php echo number_format($row['pprice'], 2); ?></span>
</td>
<td class="py-10">
<?php if($row['stock']=='In Stock'): ?>
<span class="text-[10px] uppercase tracking-[0.2em] px-3 py-1 font-semibold" style="background: #f0fdf4; color: #15803d;">In Stock</span>
<?php else: ?>
<span class="text-[10px] uppercase tracking-[0.2em] px-3 py-1 font-semibold" style="background: #fef2f2; color: #b91c1c;">Out Of Stock</span>
<?php endif; ?>
</td>
<td class="py-10 text-right">
<?php if($row['stock']=='In Stock'): ?>
<a href="my-wishlist.php?action=add&id=<?php echo $row['pid']; ?>" class="wishlist-add-cart-btn text-white px-8 py-3 text-[11px] uppercase tracking-[0.2em] transition-all duration-300 inline-block" style="background: #6d101d;" onmouseover="this.style.background='#8b1525'" onmouseout="this.style.background='#6d101d'">
<span class="button-text" style="color: white; transition: color 0.3s;">Add to Cart</span>
</a>
<?php else: ?>
<button disabled class="text-white px-8 py-3 text-[11px] uppercase tracking-[0.2em] cursor-not-allowed opacity-50" style="background: #d6d3d1;">
Out of Stock
</button>
<?php endif; ?>
</td>
</tr>
<?php } ?>
</tbody>
</table>
</div>
<?php else: ?>
<!-- Empty State -->
<div class="flex flex-col items-center justify-center py-20 text-center">
<div class="mb-10" style="opacity: 0.2;">
<svg xmlns="http://www.w3.org/2000/svg" width="120" height="120" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg>
</div>
<h3 class="text-2xl tracking-wide mb-4" style="font-family: 'Playfair Display', serif;">Your wishlist is currently empty</h3>
<p class="max-w-sm mx-auto mb-10 text-sm leading-relaxed" style="color: #78716c;">Explore our latest collections to find pieces that resonate with your personal style.</p>
<a class="wishlist-add-cart-btn text-white px-10 py-4 text-[12px] uppercase tracking-[0.25em] transition-all duration-500 inline-block" href="all-category.php" style="background: #6d101d;" onmouseover="this.style.background='#8b1525'" onmouseout="this.style.background='#6d101d'">
<span class="button-text" style="color: white; transition: color 0.3s;">Continue Shopping</span>
</a>
</div>
<?php endif; ?>
</section>
</main>

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
        <p class="modal-desc">Are you sure you want to remove this item from your wishlist? This action cannot be undone.</p>
        <div class="modal-buttons">
            <button type="button" class="modal-btn modal-btn-cancel" onclick="closeRemoveModal()">Cancel</button>
            <a id="confirmRemoveBtn" href="#" class="modal-btn modal-btn-confirm" style="text-decoration: none;"><span class="btn-text" style="color: #fff; transition: color 0.3s;">Remove</span></a>
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
        <div class="modal-icon" id="notificationIcon">
            <!-- Heart icon for wishlist -->
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
            </svg>
        </div>
        <h3 class="modal-title" id="notificationTitle">Success!</h3>
        <p class="modal-desc" id="notificationDesc">Your action has been completed successfully.</p>
        <div class="modal-buttons">
            <button type="button" class="modal-btn modal-btn-confirm" onclick="closeNotificationModal()"><span class="btn-text" style="color: #fff; transition: color 0.3s;">OK</span></button>
        </div>
    </div>
</div>

<script>
    let currentDeleteId = null;
    
    function showRemoveModal(wid, productName) {
        currentDeleteId = wid;
        document.getElementById('confirmRemoveBtn').href = 'my-wishlist.php?del=' + wid;
        document.getElementById('removeModal').classList.add('active');
        document.body.style.overflow = 'hidden';
    }
    
    function closeRemoveModal() {
        document.getElementById('removeModal').classList.remove('active');
        document.body.style.overflow = '';
        currentDeleteId = null;
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
    
    // Check for session notification on page load
    <?php if(isset($_SESSION['wishlist_notification'])): ?>
    document.addEventListener('DOMContentLoaded', function() {
        showNotificationModal('Added to Wishlist', '<?php echo addslashes($_SESSION['wishlist_notification']); ?>');
    });
    <?php unset($_SESSION['wishlist_notification']); endif; ?>
</script>

<?php include 'footer.php';?>
<?php } ?>
