<?php
session_start();
error_reporting(0);
include('includes/config.php');
$cid=intval($_GET['cid']);
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
				echo "<script>alert('Product has been added to the cart')</script>";
		echo "<script type='text/javascript'> document.location ='my-cart.php'; </script>";
		}else{
			$message="Product ID is invalid";
		}
	}
	
}
// COde for Wishlist
if(isset($_GET['pid']) && $_GET['action']=="wishlist" ){
	if(strlen($_SESSION['login'])==0)
    {   
header('location:login.php');
}
else
{
mysqli_query($con,"insert into wishlist(userId,productId) values('".$_SESSION['id']."','".$_GET['pid']."')");
echo "<script>alert('Product aaded in wishlist');</script>";
header('location:my-wishlist.php');

}
}
?>
<?php include('header.php'); ?>

            <!-- Body Container -->
            <div id="page-content"> 
                <!--Page Header-->
                <div class="page-header text-center">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 d-flex justify-content-between align-items-center">
                            <?php $sql=mysqli_query($con,"select categoryName  from category where id='$cid'");
                                while($row=mysqli_fetch_array($sql))
                                {
                            ?>   
                            <div class="page-title"><h1><?php echo htmlentities($row['categoryName']);?></h1></div>
                                <!--Breadcrumbs-->
                                <div class="breadcrumbs"><a href="index.php" title="Back to the home page">Home</a> <span class="main-title"><i class="icon anm anm-angle-right-l"></i><?php echo htmlentities($row['categoryName']);?></span></div>
                                <!--End Breadcrumbs-->
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <!--End Page Header-->

                <!--Main Content-->
                <div class="container">
                   
                    <div class="row">
                        <!--Sidebar-->
                        <div class="col-12 col-sm-12 col-md-12 col-lg-3 sidebar sidebar-bg filterbar">
                            <div class="closeFilter d-block d-lg-none"><i class="icon anm anm-times-r"></i></div>
                            <div class="sidebar-tags sidebar-sticky clearfix">
                              
                                <!--Categories-->
                                <div class="sidebar-widget clearfix categories filterBox filter-widget">
                                    <div class="widget-title"><h2>Categories</h2></div>
                                    <div class="widget-content filterDD">
                                        <ul class="sidebar-categories scrollspy morelist clearfix">
                                            <?php
                                                $sql = "SELECT id, categoryName FROM category";
                                                $result = $con->query($sql);
                                                
                                                if ($result->num_rows > 0) {
                                                  // output data of each row
                                                  while($row = $result->fetch_assoc()) {
                                                    echo '<li class="lvl1 sub-level more-item"><a href="#;" class="site-nav">'.$row["categoryName"].'</a><ul class="sublinks">';
                                                    
                                                    $sql2 = "SELECT productName, id FROM products WHERE category=".$row["id"];
                                                    $result2 = $con->query($sql2);
                                                    
                                                    if ($result2->num_rows > 0) { 
                                                      while($row2 = $result2->fetch_assoc()) {
                                                        echo '<li class="lvl2"><a href="product-details.php?pid='.$row2['id'].'" class="site-nav">'.$row2["productName"].'</a></li>';
                                                      }
                                                    } else{
                                                        echo "<li class='lvl2'>No Product Found</li>";
                                                    }
                                                    
                                                    echo '</ul></li>';
                                                  }
                                                } else {
                                                  echo "<li class='lvl2'>No Result</li>";
                                                }
                                            ?>
                                            <!-- <li class="lvl1 sub-level more-item"><a href="#;" class="site-nav">category</a>
                                                <ul class="sublinks">
                                                    <li class="lvl2"><a href="#" class="site-nav">sucategorh  </a></li>
                                                    <li class="lvl2"><a href="#" class="site-nav">sucategorh  </a></li>
                                                    <li class="lvl2"><a href="#" class="site-nav">sucategorh  </a></li>
                                                </ul>
                                            </li> -->
                                        </ul>
                                    </div>
                                </div>
                                <!--Categories-->
                               
                                <!--Banner-->
                                <div class="sidebar-widget static-banner p-0">
                                    <a href="#"><img class="rounded-0 blur-up lazyload" data-src="assets/images/banners/shop-banner.jpg" src="assets/images/banners/shop-banner.jpg" alt="image" width="274" height="367"></a>
                                </div>
                                <!--End Banner-->
                            </div>
                        </div>
                        <!--End Sidebar-->

                        <!--Products-->
                        <div class="col-12 col-sm-12 col-md-12 col-lg-9 main-col">
                            <!--Toolbar-->
                            <div class="toolbar toolbar-wrapper shop-toolbar">
                                <div class="row align-items-center">
                                    <div class="col-12 col-sm-2 col-md-4 col-lg-4 text-left filters-toolbar-item d-flex order-1 order-sm-0">
                                     <h1 style=" font-family: 'Edu VIC WA NT Beginner',cursive;">
                                        <?php $sql=mysqli_query($con,"select categoryName  from category where id='$cid'"); $row=mysqli_fetch_array($sql);
                                        echo htmlentities($row['categoryName']);
                                        ?> 
                                     </h1>
                                    </div>

                                </div>
                            </div>
                            <!--End Toolbar-->

                            <!--Product Grid-->
                            <div class="grid-products grid-view-items">
                                <div class="row col-row product-options row-cols-lg-4 row-cols-md-3 row-cols-sm-3 row-cols-2">
                                   
                                        <?php
                                            $ret=mysqli_query($con,"select * from products where category='$cid'");
                                            $num=mysqli_num_rows($ret);
                                            if($num>0)
                                                {
                                                     while ($row=mysqli_fetch_array($ret)) 
                                                {?>
                                           
                                            <div class="item col-item">
                                                <div class="product-box">
                                                    <!-- Start Product Image -->
                                                    <div class="product-image">
                                                        <!-- Start Product Image -->
                                                        <a href="product-details.php?pid=<?php echo htmlentities($row['id']);?>" class="product-img rounded-3">
                                                            <!-- Image -->
                                                            <img class="blur-up lazyload" data-src="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>" data-echo="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>" src="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>" data-echo="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>" alt="Product" title="<?php echo htmlentities($row['productName']);?>" width="625" height="808" />
                                                            <!-- End Image -->
                                                        </a>
                                                        <!-- End Product Image -->
                                                    </div>
                                                    <!-- Start Product Details -->
                                                    <div class="product-details text-center">
                                                        <!-- Product Name -->
                                                        <div class="product-name">
                                                            <a href="product-details.php?pid=<?php echo htmlentities($row['id']);?>"><?php echo htmlentities($row['productName']);?></a>
                                                        </div>
                                                        <!-- End Product Name -->
                                                        <!-- Product Price -->
                                                        <div class="product-price">
                                                            <span class="price">RS: <?php echo htmlentities($row['productPrice']);?>.00 &nbsp; <del class="old-price"> RS: <?php echo htmlentities($row['productPriceBeforeDiscount']);?>.00</del></span>
                                                        </div>
                                                        <!-- End Product Price -->
                                                        <div class="view-collection mt-md-2">
                                                        <?php if($row['productAvailability']=='In Stock'){?>
                                                            <a href="index.php?page=product&action=add&id=<?php echo $row['id']; ?>"  class="btn btn-secondary btn-sm">Add Cart &nbsp; <i class="icon anm anm-cart-l"></i></a> <a href="category.php?pid=<?php echo htmlentities($row['id'])?>&&action=wishlist" title="Wishlist" class="btn btn-secondary btn-sm mt-2"> Wishlist &nbsp; <i class="icon anm anm-heart-l"></i></a>
                                                            <?php } else {?>
                                                                <a href="" style=" cursor: not-allowed;" onclick="event.preventDefault();" class="btn btn-secondary btn-sm">Out of Stock &nbsp; <i class="icon anm anm-cart-l"></i></a> <a href="category.php?pid=<?php echo htmlentities($row['id'])?>&&action=wishlist" title="Wishlist" class="btn btn-secondary btn-sm mt-2"> Wishlist &nbsp; <i class="icon anm anm-heart-l"></i></a>
                                                             <?php } ?>
                                                        </div>
                                                    </div>
                                                    <!-- End product details -->
                                                </div>
                                            </div>
                                            <?php }} else{ ?>
                                                <h4 style="min-width:300px; max-width:500px; width:auto; color: #888;">No Product Found In This Category </h4>
                                            <?php } ?>

                                </div>

                                
                            </div>
                            <!--End Product Grid-->
                        </div>
                        <!--End Products-->
                    </div>
                </div>
                <!--End Main Content-->
            </div>
            <!-- End Body Container -->

<?php include 'footer.php';?>