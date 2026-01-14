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
header('location:my-wishlist.php');
}
		else{
			$message="Product ID is invalid";
		}
	}
}

?>
<?php include 'header.php'?>
            <!-- Body Container -->
            <div id="page-content">
                <!--Page Header-->
                <div class="page-header text-center">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 d-flex justify-content-between align-items-center">
                                <div class="page-title"><h1>Wishlist</h1></div>
                                <!--Breadcrumbs-->
                                <div class="breadcrumbs"><a href="index.html" title="Back to the home page">Home</a><span class="main-title"><i class="icon anm anm-angle-right-l"></i>Wishlist</span></div>
                                <!--End Breadcrumbs-->
                            </div>
                        </div>
                    </div>
                </div>
                <!--End Page Header-->

                <!--Main Content-->
                <div class="container">     
                    <!--Wishlist Form-->
                    <div class="alert alert-success py-2 alert-dismissible fade show cart-alert" role="alert">
                        There are <span class="text-primary fw-600"><?php echo $num;?></span> products in this wishlist
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>

                    <form action="#" method="post">
                        <div class="wishlist-table table-content table-responsive">
                            <table class="table align-middle text-nowrap table-bordered">
                                <thead class="thead-bg">
                                    <tr>
                                        <th class="product-name text-start" colspan="2">Product</th>
                                        <th class="product-price text-center">Price</th>
                                        <th class="stock-status text-center">Stock Status</th>
                                        <th class="product-subtotal text-center">Add to Cart</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>  
                                    <?php
                                        $ret=mysqli_query($con,"select products.productName as pname, products.productAvailability as stock,products.productName as proid,products.productImage1 as pimage,products.productPrice as pprice,wishlist.productId as pid,wishlist.id as wid from wishlist join products on products.id=wishlist.productId where wishlist.userId='".$_SESSION['id']."'");
                                        $num=mysqli_num_rows($ret);
                                            if($num>0)
                                            {
                                        while ($row=mysqli_fetch_array($ret)) {

                                        ?>
                                        <td class="product-thumbnail">
                                            <a class="product-img" href="product-details.php?pid=<?php echo htmlentities($pd=$row['pid']);?>"><img style="max-height:100px; object-fit:cover;" class="image rounded-0 blur-up lazyload" data-src="admin/productimages/<?php echo htmlentities($row['pid']);?>/<?php echo htmlentities($row['pimage']);?>" src="admin/productimages/<?php echo htmlentities($row['pid']);?>/<?php echo htmlentities($row['pimage']);?>" alt="Product" title="Product" width="120" height="170" /></a>
                                        </td>

                                        <td class="product-details">
                                            <a href="product-details.php?pid=<?php echo htmlentities($pd=$row['pid']);?>"><p class="product-name mb-0"><?php echo htmlentities($row['pname']);?></p></a>
                                            <a href="my-wishlist.php?del=<?php echo htmlentities($row['wid']);?>" onClick="return confirm('Are you sure you want to delete?')" type="button" class="btn remove-icon close-btn position-static me-3" data-bs-toggle="tooltip" data-bs-placement="top" title="Remove"><i class="icon anm anm-times-r"></i></a>
                                        </td>
                                        <td class="product-price text-center"><span class="amount fw-500">RS: <?php echo htmlentities($row['pprice']);?>.00</span></td>
                                        <?php if($row['stock']=='In Stock'){?>
                                        <td class="product-stock text-center"><span class="text-in-stock">In stock</span></td>
                                        <?php } else{?>
                                            <td class="product-stock text-center"><span class="text-out-stock">Out Of stock</span></td>
                                        <?php } ?>
                                        <td class="product-action text-center">
                                        <?php if($row['stock']=='In Stock'){?>
                                            <a href="index.php?page=product&action=add&id=<?php echo $row['pid']; ?>" type="button" class="btn btn-secondary text-nowrap">Add To Cart</a>
                                            <?php } else{?>
                                                <a href="#;" type="button" style=" cursor: not-allowed;" onclick="event.preventDefault();" class="btn btn-secondary text-nowrap" data-bs-toggle="modal" >Out of stock</a>
                                            <?php } ?>
                                        </td>

                                        
                                        <!-- <td class="product-thumbnail">
                                            <a class="product-img" href="product-layout1.html"><img class="image rounded-0 blur-up lazyload" data-src="assets/images/products/product1-120x170.jpg" src="assets/images/products/product1-120x170.jpg" alt="Product" title="Product" width="120" height="170" /></a>
                                            <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#quickview_modal"><i class="icon anm anm-search-plus-l"></i></button>
                                        </td>
                                        <td class="product-details">
                                            <p class="product-name mb-0">Oxford Cuban Shirt</p>
                                            <p class="variant-cart my-1 text-muted">Black / XL</p>
                                            <button type="button" class="btn remove-icon close-btn position-static me-3" data-bs-toggle="tooltip" data-bs-placement="top" title="Remove"><i class="icon anm anm-times-r"></i></button>
                                        </td>
                                        <td class="product-price text-center"><span class="amount fw-500">$143.00</span></td>
                                        <td class="product-stock text-center"><span class="text-in-stock">in stock</span></td>
                                        <td class="product-action text-center">
                                            <button type="button" class="btn btn-secondary text-nowrap" data-bs-toggle="modal" data-bs-target="#quickshop_modal">Select Options</button>
                                        </td> -->





                                    </tr>

                                    <?php } } else{ ?>
                                        <tr>
                                            <td>Your Wishlist Is Empty</td>
                                        </tr>
                                        <?php } ?>
                                    
                                </tbody>
                            </table>
                        </div>
                    </form>
                    <!--End Wishlist Form-->
                </div>
                <!--End Main Content-->
            </div>
            <!-- End Body Container -->

<?php include 'footer.php';?>
<?php } ?>