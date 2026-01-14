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
echo "<script>alert('Product aaded in wishlist');</script>";
header('location:my-wishlist.php');

}
}

?>
<?php include 'header.php';?>

<!-- Body Container -->
<div id="page-content" >
    <!--Page Header-->
    <div class="page-header text-center">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                    <!--Breadcrumbs-->
                    <?php
                        $ret=mysqli_query($con,"select category.categoryName as catname,subcategory.subcategory as subcatname,products.productName as pname from products join category on category.id=products.category join subcategory on subcategory.id=products.subCategory where products.id='$pid'");
                        while ($rw=mysqli_fetch_array($ret)) {

                        ?>
                    <div class="breadcrumbs"><a href="index.php" title="Back to the home page">Home</a>
                    <span class="main-title fw-bold"><i class="icon anm anm-angle-right-l"></i><?php echo htmlentities($rw['catname']);?></span>
                    <span class="main-title fw-bold"><i class="icon anm anm-angle-right-l"></i><?php echo htmlentities($rw['subcatname']);?></span>
                    <span class="main-title fw-bold"><i class="icon anm anm-angle-right-l"></i><?php echo htmlentities($rw['pname']);?></span>
                    </div>
                    <?php }?>
                    <!--End Breadcrumbs-->
                </div>
            </div>
        </div>
    </div>
    <!--End Page Header-->

    <!--Main Content-->
    <div class="container">
        <!--Product Content-->
        <div class="product-single">
            <div class="row">
                <div class="col-lg-5 col-md-6 col-sm-12 col-12 product-layout-img mb-4 mb-md-0">
                    <!-- Product Horizontal -->

                    <!-- ================== Image Start =================== -->

                    <?php $ret=mysqli_query($con,"select * from products where id='$pid'");
                        $row=mysqli_fetch_array($ret)
                    ?>
                    <div class="product-details-img product-horizontal-style">
                        <!-- Product Main -->
                        <div class="zoompro-wrap">
                            <!-- Product Image Container -->
                            <div class="media-container">
                                <div class="zoompro-span" id="main-image-container">
                                    <img id="zoompro" class="zoompro" src="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>"
                                        data-zoom-image="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>" alt="product" width="625"
                                        height="500" />
                                </div>
                            </div>
                            <!-- End Product Image Container -->
                            <!-- Product Label -->
                            <!-- <div class="product-labels"><span class="lbl pr-label1">New</span><span
                                    class="lbl on-sale">Sale</span></div> -->
                            <!-- End Product Label -->

                        </div>
                        <!-- End Product Main -->

                        <!-- Product Thumb -->
                        <div class="product-thumb product-horizontal-thumb mt-3">
                            <div id="gallery" class="product-thumb-horizontal">

                            <?php 
                                $ret=mysqli_query($con,"select * from products where id='$pid'");
                                while($row=mysqli_fetch_array($ret)) 
                                {
                                    // Display Images Only (Video Removed from Thumbnails)
                                    for($imgno = 1; $imgno <= 3; $imgno++) {
                                        $imgVar = 'productImage' . $imgno;
                                        if(!empty($row[$imgVar])) {
                                            ?>
                                            <a data-image="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row[$imgVar]);?>"
                                                data-zoom-image="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row[$imgVar]);?>"
                                                data-type="image"
                                                class="slick-slide slick-cloned media-thumb <?php echo ($imgno == 1) ? 'active' : ''; ?>"
                                                onclick="switchToImage(this)">
                                                <img class="blur-up lazyload" 
                                                    data-src="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row[$imgVar]);?>"
                                                    src="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row[$imgVar]);?>" 
                                                    alt="product" width="625" height="808" />
                                            </a>
                                            <?php 
                                        }
                                    }
                                }
                                ?>
                                
                            </div>
                        </div>
                        <!-- End Product Thumb -->

                    </div>



                    <!-- ===================== Image End ==================  -->


                    <!-- End Product Horizontal -->
                </div>
                <?php $ret=mysqli_query($con,"select * from products where id='$pid'");
                        $row=mysqli_fetch_array($ret)
                ?>
                <div class="col-lg-7 col-md-6 col-sm-12 col-12 product-layout-info">
                    <!-- Product Details -->
                    <div class="product-single-meta">
                        <h2 class="product-main-title"><?php echo htmlentities($row['productName']);?></h2>
                        <!-- Product Reviews -->
                        <div class="product-review d-flex-center mb-3">
                            <div class="reviewStar d-flex-center"><i class="icon anm anm-star"></i><i
                                    class="icon anm anm-star"></i><i class="icon anm anm-star"></i><i
                                    class="icon anm anm-star"></i><i class="icon anm anm-star"></i></div>
                        </div>
                        <!-- End Product Reviews -->
                        <!-- Product Info -->
                        <div class="product-info">
                            <p class="product-stock d-flex">Availability:
                                <span class="pro-stockLbl ps-0">
                                    <span class="d-flex-center stockLbl instock text-uppercase"><?php echo htmlentities($row['productAvailability']);?></span>
                                </span>
                            </p>
                            <p class="product-vendor">Product Brand:<span class="text"><a href="#"><?php echo htmlentities($row['productCompany']);?></a></span></p>
                            <p class="product-type">Shiping Charge:<span class="text">
                                <?php if($row['shippingCharge']==0)
                                    {
                                        echo "Free";
                                    }
                                    else
                                    {
                                        echo htmlentities($row['shippingCharge']);
                                    }
                                ?>
                            </span></p>
                        </div>
                        <!-- End Product Info -->
                        <!-- Product Price -->
                        <div class="product-price d-flex-center my-3">
                            <span class="price old-price">RS: <?php echo htmlentities($row['productPriceBeforeDiscount']);?>.00</span><span class="price">RS: <?php echo htmlentities($row['productPrice']);?>.00</span>
                        </div>
                        <!-- End Product Price -->
                        <hr>
                        <!-- Sort Description -->
                        <div class="sort-description">
                        <?php 
                            $description = $row['productDescription'];
                            $words = explode(' ', $description, 36);
                            if(count($words) > 35){
                                array_pop($words);
                                array_push($words, '...');
                                $description = implode(' ', $words);
                            }
                            echo $description;
                            ?>
                        </div>
                        <!-- End Sort Description -->
                        <hr>
                       
                    </div>
                    <!-- End Product Details -->

                    <!-- Product Form -->
                    <form method="post" action="#" class="product-form product-form-border hidedropdown">
                        <!-- Product Action -->
                        <div class="product-action w-100 d-flex-wrap my-3 my-md-4">
                            <!-- Product Quantity -->
                            <div class="product-form-quantity d-flex-center">
                                <div class="qtyField" style="height:0;">
                                    <a class="qtyBtn minus" href="#;"><i class="icon anm anm-minus-r"></i></a>
                                    <?php
                                        $id=intval($_GET['id']);
                                        if(isset($_SESSION['cart'][$id])){
                                    ?>
                                    <input type="text" value="<?php echo $_SESSION['cart'][$row['id']]['quantity']; ?>" name="quantity[<?php echo $row['id']; ?>]" pattern="[0-9]*" class="product-form-input qty" />
                                <?php } else {?>
                                    <input type="text" value="1" name="quantity[<?php echo $row['id']; ?>]" pattern="[0-9]*" class="product-form-input qty" />
                                <?php } ?>
                                    <a class="qtyBtn plus" href="#;"><i class="icon anm anm-plus-r"></i></a>
                                </div>
                            </div>
                            <!-- End Product Quantity -->
                            <!-- Product Add -->
                            
                            <div class="product-form-submit addcart fl-1 ms-3">
                            <?php if($row['productAvailability']=='In Stock'){?>
                                <button type="button" onclick="addToCart(<?php echo $row['id'];?>)" class="btn btn-primary product-form-cart-submit">
                                    <span>Add to cart</span>
                                </button>
                            <?php } else {?>
                                <button type="submit" style=" cursor: not-allowed;" onclick="event.preventDefault();" class="btn btn-primary product-form-cart-submit"> <span>Out of Stock</span> </button>
                            <?php } ?>
                            </div>
                            
                            <!-- Product Add -->
                            <!-- Product Buy -->
                            <div class="product-form-submit buyit fl-1 ms-3">
                            <?php if($row['productAvailability']=='In Stock'){?>
                                <button type="button" onclick="buyNow(<?php echo $row['id'];?>)" class="btn btn-primary proceed-to-checkout"><span>Buy it now</span></button>
                                <?php } ?>
                            </div>
                            <!-- End Product Buy -->
                        </div>
                        <!-- End Product Action -->

                        <!-- Product Info link -->
                        <p class="infolinks d-flex-center justify-content-between">
                            <a class="text-link wishlist" href="product-details.php?pid=<?php echo htmlentities($row['id'])?>&&action=wishlist"><i
                                    class="icon anm anm-heart-l me-2"></i> <span>Add to Wishlist</span></a>
                            
                        </p>
                        <!-- End Product Info link -->
                    </form>
                    <!-- End Product Form -->
                </div>
            </div>
        </div>
        <!--Product Content-->

        <!-- Fixed Video Box (Top Right Corner) -->
        <?php if(!empty($row['productVideo'])): ?>
        <div id="fixed-video-box" class="fixed-video-container">
            <div class="video-header">
                <span class="video-title">Product Demo</span>
                <button id="close-video" class="close-video-btn">&times;</button>
                <button id="minimize-video" class="minimize-video-btn">−</button>
            </div>
            <div class="video-content" id="video-content">
                <iframe id="fixed-video-iframe" 
                    src="https://www.youtube.com/embed/<?php echo htmlentities($row['productVideo']); ?>?autoplay=1&mute=1&loop=1&playlist=<?php echo htmlentities($row['productVideo']); ?>&controls=1&modestbranding=1&rel=0" 
                    frameborder="0" 
                    allow="autoplay; encrypted-media" 
                    allowfullscreen>
                </iframe>
            </div>
        </div>
        <?php endif; ?>

        <!--Product Tabs-->
        <div class="tabs-listing section pb-0">
            <ul class="product-tabs style2 list-unstyled d-flex-wrap d-flex-justify-center d-none d-md-flex">
                <li rel="description" class="active"><a class="tablink">Description</a></li>
            </ul>

            <div class="tab-container">
                <!--Description-->
                <h3 class="tabs-ac-style d-md-none active" rel="description">Description</h3>
                <div id="description" class="tab-content">
                    <div class="product-description">
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                <?php echo $row['productDescription'];?>
                            </div>

                            <!-- <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                                <img data-src="assets/images/content/product-detail-img.jpg"
                                    src="assets/images/content/product-detail-img.jpg" alt="image" width="600"
                                    height="600" />
                            </div> -->
                        </div>
                    </div>
                </div>
                <!--End Description-->

            </div>
        </div>
        <!--End Product Tabs-->
    </div>
    <!--End Main Content-->

    <!--Related Products-->
    <section class="section product-slider pb-0">
        <div class="container">
            <div class="section-header">
                <p class="mb-1 mt-0">Discover Similar</p>
                <h2>Related Products</h2>
            </div>

            <!--Product Grid-->
            <div class="product-slider-4items gp10 arwOut5 grid-products">

                <?php
                $ret=mysqli_query($con,"select * from products where id='$pid'");
                $row=mysqli_fetch_array($ret);
                $cid=$row['category'];
                $subcid=$row['subCategory']; 
                // $ret=mysqli_query($con,"select * from products where category='$cid'");
                $qry=mysqli_query($con,"select * from products where subCategory='$subcid' and category='$cid'");
                $num=mysqli_num_rows($qry);
                if($num>0)
                    {
                        while($row=mysqli_fetch_array($qry))
                    {?>

                <div class="item col-item">
                    <div class="product-box">
                        <!-- Start Product Image -->
                        <div class="product-image">
                            <!-- Start Product Image -->
                            <a href="product-details.php?pid=<?php echo htmlentities($row['id']);?>"
                                class="product-img rounded-3">
                                <!-- Image -->
                                <img class="blur-up lazyload"
                                    data-src="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>"
                                    data-echo="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>"
                                    src="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>"
                                    data-echo="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>"
                                    alt="Product" title="<?php echo htmlentities($row['productName']);?>" width="625"
                                    height="808" />
                                <!-- End Image -->
                            </a>
                            <!-- End Product Image -->
                        </div>
                        <!-- Start Product Details -->
                        <div class="product-details text-center">
                            <!-- Product Name -->
                            <div class="product-name">
                                <a href="product-details.php?pid=<?php echo htmlentities($row['id']);?>">
                                    <?php echo htmlentities($row['productName']);?>
                                </a>
                            </div>
                            <!-- End Product Name -->
                            <!-- Product Price -->
                            <div class="product-price">
                                <span class="price">RS:
                                    <?php echo htmlentities($row['productPrice']);?>.00 &nbsp; <del class="old-price">
                                        RS:
                                        <?php echo htmlentities($row['productPriceBeforeDiscount']);?>.00
                                    </del>
                                </span>
                            </div>
                            <!-- End Product Price -->
                            <!-- <div class="view-collection mt-md-2">
                                <?php if($row['productAvailability']=='In Stock'){?>
                                <a href="index.php?page=product&action=add&id=<?php echo $row['id']; ?>"
                                    class="btn btn-secondary btn-sm">Add Cart &nbsp; <i
                                        class="icon anm anm-cart-l"></i></a> 
                                    href="category.php?pid=<?php echo htmlentities($row['id'])?>&&action=wishlist"
                                    title="Wishlist" class="btn btn-secondary btn-sm "> Wishlist &nbsp; <i
                                        class="icon anm anm-heart-l"></i></a>
                                <?php } else {?>
                                <a href="" style=" cursor: not-allowed;" onclick="event.preventDefault();"
                                    class="btn btn-secondary btn-sm">Out of Stock &nbsp; <i
                                        class="icon anm anm-cart-l"></i></a> 
                                    href="category.php?pid=<?php echo htmlentities($row['id'])?>&&action=wishlist"
                                    title="Wishlist" class="btn btn-secondary btn-sm "> Wishlist &nbsp; <i
                                        class="icon anm anm-heart-l"></i></a>
                                <?php } ?>
                            </div> -->
                        </div>
                        <!-- End product details -->
                    </div>
                </div>
                <?php }} else{ ?>
                <h4 style="min-width:300px; max-width:500px; width:auto; color: #888;">No Product Found In This Category
                </h4>
                <?php } ?>

            </div>
            <!--End Product Grid-->
        </div>
    </section>
    <!--End Related Products-->

</div>
</div>
<!-- End Body Container -->

<!-- Toast Notification -->
<div id="cart-toast" style="display: none; position: fixed; top: 20px; right: 20px; background: #28a745; color: white; padding: 15px 25px; border-radius: 5px; box-shadow: 0 4px 12px rgba(0,0,0,0.15); z-index: 9999; font-size: 14px; animation: slideIn 0.3s ease-out;">
    <i class="icon anm anm-check-cil" style="margin-right: 8px;"></i>
    <span id="toast-message">Product added to cart successfully!</span>
</div>

<style>
@keyframes slideIn {
    from {
        transform: translateX(400px);
        opacity: 0;
    }
    to {
        transform: translateX(0);
        opacity: 1;
    }
}

@keyframes slideOut {
    from {
        transform: translateX(0);
        opacity: 1;
    }
    to {
        transform: translateX(400px);
        opacity: 0;
    }
}
</style>

<!-- Custom CSS for Fixed Video Box -->
<style>
/* Fixed Video Container Styles */
.fixed-video-container {
    position: fixed;
    bottom: 70px;
    right: 20px;
    width: 200px;
    background: #ffffff;
    border-radius: 12px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    z-index: 1000;
    overflow: hidden;
    border: 2px solid #e0e0e0;
    transition: all 0.3s ease;
    height: 230px;
}

.fixed-video-container:hover {
    box-shadow: 0 12px 35px rgba(0,0,0,0.2);
    transform: translateY(-2px);
}

.video-header {
    background: #097596;
    color: white;
    padding: 8px 15px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    cursor: move;
    user-select: none;
}

.video-title {
    font-weight: 400;
    font-size: 12px;
    flex-grow: 1;
}

.close-video-btn, .minimize-video-btn {
    background: transparent;
    border: none;
    color: white;
    font-size: 18px;
    cursor: pointer;
    padding: 0;
    margin-left: 10px;
    width: 25px;
    height: 25px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background 0.2s ease;
}

.close-video-btn:hover, .minimize-video-btn:hover {
    background: rgba(255,255,255,0.2);
}

.video-content {
    position: relative;
    width: 100%;
    height: 180px;
    overflow: hidden;
}

.video-content iframe {
    width: 100%;
    height: 100%;
    border: none;
}

/* Minimized state */
.fixed-video-container.minimized .video-content {
    display: none;
}

.fixed-video-container.minimized {
    width: 200px;
}

/* Mobile responsiveness */
@media (max-width: 768px) {
    .fixed-video-container {
       bottom: 70px;
        right: 10px;
        width: 280px;
    }
    
    .video-content {
        height: 160px;
    }
    
    .fixed-video-container.minimized {
        width: 180px;
    }
}

@media (max-width: 480px) {
    .fixed-video-container {
        width: 260px;
    }
    
    .video-content {
        height: 145px;
    }
    
    .fixed-video-container.minimized {
        width: 160px;
    }
}

/* Draggable cursor */
.fixed-video-container.dragging {
    cursor: move;
    opacity: 0.8;
}

/* Hide video initially and show with animation */
.fixed-video-container {
    opacity: 0;
    transform: translateY(-20px);
    animation: slideInVideo 0.5s ease forwards;
    animation-delay: 1s;
}

@keyframes slideInVideo {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Remove old media container styles since video is removed */
.media-container {
    position: relative;
    width: 100%;
    height: 500px;
}

.media-thumb {
    cursor: pointer;
    transition: opacity 0.3s ease;
    border: 2px solid transparent;
}

.media-thumb:hover {
    opacity: 0.8;
}

.media-thumb.active {
    border-color: #007bff;
}

.zoompro-wrap {
    position: relative;
    overflow: hidden;
    border-radius: 8px;
}
</style>

<!-- JavaScript for Add to Cart and Buy Now -->
<script>
// Add to Cart Function
function addToCart(productId) {
    // Create XMLHttpRequest
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'product-details.php?pid=<?php echo $pid;?>&action=add&id=' + productId, true);
    
    xhr.onload = function() {
        if (xhr.status === 200) {
            // Show toast notification
            showToast('Product added to cart successfully!');
        }
    };
    
    xhr.send();
}

// Buy Now Function
function buyNow(productId) {
    // Create XMLHttpRequest
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'product-details.php?pid=<?php echo $pid;?>&action=add&id=' + productId, true);
    
    xhr.onload = function() {
        if (xhr.status === 200) {
            // Redirect to cart page
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
    
    // Hide toast after 3 seconds
    setTimeout(function() {
        toast.style.animation = 'slideOut 0.3s ease-out';
        setTimeout(function() {
            toast.style.display = 'none';
        }, 300);
    }, 3000);
}
</script>

<!-- JavaScript for Fixed Video Box Functionality -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const videoBox = document.getElementById('fixed-video-box');
    const closeBtn = document.getElementById('close-video');
    const minimizeBtn = document.getElementById('minimize-video');
    const videoContent = document.getElementById('video-content');
    
    if (!videoBox) return; // Exit if no video
    
    // Close video functionality
    if (closeBtn) {
        closeBtn.addEventListener('click', function() {
            videoBox.style.opacity = '0';
            videoBox.style.transform = 'translateY(-20px)';
            setTimeout(() => {
                videoBox.style.display = 'none';
            }, 300);
        });
    }
    
    // Minimize/Maximize functionality
    if (minimizeBtn) {
        minimizeBtn.addEventListener('click', function() {
            videoBox.classList.toggle('minimized');
            
            if (videoBox.classList.contains('minimized')) {
                minimizeBtn.innerHTML = '+';
                minimizeBtn.title = 'Maximize';
            } else {
                minimizeBtn.innerHTML = '−';
                minimizeBtn.title = 'Minimize';
            }
        });
    }
    
    // Make video box draggable
    let isDragging = false;
    let currentX;
    let currentY;
    let initialX;
    let initialY;
    let xOffset = 0;
    let yOffset = 0;
    
    const header = videoBox.querySelector('.video-header');
    
    if (header) {
        header.addEventListener('mousedown', dragStart);
        document.addEventListener('mousemove', dragMove);
        document.addEventListener('mouseup', dragEnd);
        
        // Touch events for mobile
        header.addEventListener('touchstart', dragStart);
        document.addEventListener('touchmove', dragMove);
        document.addEventListener('touchend', dragEnd);
    }
    
    function dragStart(e) {
        if (e.type === "touchstart") {
            initialX = e.touches[0].clientX - xOffset;
            initialY = e.touches[0].clientY - yOffset;
        } else {
            initialX = e.clientX - xOffset;
            initialY = e.clientY - yOffset;
        }
        
        if (e.target === header || header.contains(e.target)) {
            isDragging = true;
            videoBox.classList.add('dragging');
        }
    }
    
    function dragMove(e) {
        if (isDragging) {
            e.preventDefault();
            
            if (e.type === "touchmove") {
                currentX = e.touches[0].clientX - initialX;
                currentY = e.touches[0].clientY - initialY;
            } else {
                currentX = e.clientX - initialX;
                currentY = e.clientY - initialY;
            }
            
            xOffset = currentX;
            yOffset = currentY;
            
            // Boundary checking
            const rect = videoBox.getBoundingClientRect();
            const maxX = window.innerWidth - rect.width;
            const maxY = window.innerHeight - rect.height;
            
            currentX = Math.min(Math.max(0, currentX), maxX);
            currentY = Math.min(Math.max(0, currentY), maxY);
            
            videoBox.style.transform = `translate(${currentX}px, ${currentY}px)`;
        }
    }
    
    function dragEnd() {
        initialX = currentX;
        initialY = currentY;
        isDragging = false;
        videoBox.classList.remove('dragging');
    }
    
    // Auto-hide video after certain time (optional)
    let hideTimeout = setTimeout(() => {
        if (videoBox && !videoBox.classList.contains('minimized')) {
            videoBox.classList.add('minimized');
            if (minimizeBtn) {
                minimizeBtn.innerHTML = '+';
                minimizeBtn.title = 'Maximize';
            }
        }
    }, 30000); // Hide after 30 seconds
    
    // Clear timeout on user interaction
    videoBox
    videoBox.addEventListener('mouseenter', () => {
        clearTimeout(hideTimeout);
    });
    
    videoBox.addEventListener('mouseleave', () => {
        hideTimeout = setTimeout(() => {
            if (!videoBox.classList.contains('minimized')) {
                videoBox.classList.add('minimized');
                if (minimizeBtn) {
                    minimizeBtn.innerHTML = '+';
                    minimizeBtn.title = 'Maximize';
                }
            }
        }, 15000); // Hide after 15 seconds of no interaction
    });
});

// Image switching functionality (cleaned up since video is removed)
function switchToImage(element) {
    // Remove active class from all thumbnails
    document.querySelectorAll('.media-thumb').forEach(thumb => {
        thumb.classList.remove('active');
    });
    
    // Add active class to clicked thumbnail
    element.classList.add('active');
    
    // Update main image
    const mainImage = document.getElementById('zoompro');
    const newImageSrc = element.getAttribute('data-image');
    const newZoomSrc = element.getAttribute('data-zoom-image');
    
    mainImage.src = newImageSrc;
    mainImage.setAttribute('data-zoom-image', newZoomSrc);
    
    // Reinitialize zoom if needed
    if (typeof $.fn.elevateZoom !== 'undefined') {
        $('.zoompro').elevateZoom('destroy');
        setTimeout(() => {
            $('.zoompro').elevateZoom({
                gallery: "gallery",
                galleryActiveClass: "active",
                zoomWindowWidth: 300,
                zoomWindowHeight: 100,
                scrollZoom: false,
                zoomType: "inner",
                cursor: "crosshair"
            });
        }, 100);
    }
}
</script>

<?php include 'footer.php'?>
<script src="assets/js/vendor/photoswipe.min.js"></script>
<script>
    $(function () {
        var $pswp = $('.pswp')[0],
                image = [],
                getItems = function () {
                    var items = [];
                    $('.lightboximages a').each(function () {
                        var $href = $(this).attr('href'),
                                $size = $(this).data('size').split('x'),
                                item = {
                                    src: $href,
                                    w: $size[0],
                                    h: $size[1]
                                };
                        items.push(item);
                    });
                    return items;
                };
        var items = getItems();

        $.each(items, function (index, value) {
            image[index] = new Image();
            image[index].src = value['src'];
        });
        $('.prlightbox').on('click', function (event) {
            event.preventDefault();

            var $index = $(".active-thumb").parent().attr('data-slick-index');
            $index++;
            $index = $index - 1;

            var options = {
                index: $index,
                bgOpacity: 0.7,
                showHideOpacity: true
            };
            var lightBox = new PhotoSwipe($pswp, PhotoSwipeUI_Default, items, options);
            lightBox.init();
        });
    });
</script>

<!-- Elevatezoom Zoom -->
<script src="assets/js/vendor/jquery.elevatezoom.js"></script>
<script>
    $(document).ready(function () {
        /* Product Zoom */
        function product_zoom() {
            $(".zoompro").elevateZoom({
                gallery: "gallery",
                galleryActiveClass: "active",
                zoomWindowWidth: 300,
                zoomWindowHeight: 100,
                scrollZoom: false,
                zoomType: "inner",
                cursor: "crosshair"
            });
        }
        product_zoom();
    });
</script>