<?php 
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
    {   
header('location:login.php');
}
else{
	if (isset($_GET['id'])) {

		mysqli_query($con,"delete from orders  where userId='".$_SESSION['id']."' and paymentMethod is null and id='".$_GET['id']."' ");
		echo "<script>alert('Successfully Deleted')</script>";
        header('Location: pending-orders.php');
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
                                <div class="page-title"><h1>Pending orders</h1></div>
                                <!--Breadcrumbs-->
                                <div class="breadcrumbs"><a href="index.html" title="Back to the home page">Home</a><span class="main-title"><i class="icon anm anm-angle-right-l"></i>Pending orders</span></div>
                                <!--End Breadcrumbs-->
                            </div>
                        </div>
                    </div>
                </div>
                <!--End Page Header-->

                <!--Main Content-->
                <div class="container">     
                    

                    <form action="#" method="post">
                        <div class="wishlist-table table-content table-responsive">
                            <table class="table align-middle text-nowrap table-bordered">
                                <thead class="thead-bg">
                                    <tr>
                                        <th class="product-name text-start" >SL No</th>
                                        <th class="product-name text-start" >Image</th>
                                        <th class="product-name text-start" >Product Name</th>
                                        <th class="product-name text-start" >Quantity</th>
                                        <th class="product-name text-start" >Price Per Unit</th>
                                        <th class="product-name text-start" >Shipping Charge</th>
                                        <th class="product-name text-start" >Grandtotal</th>
                                        <th class="product-name text-start" >Payment Method</th>
                                        <th class="product-name text-start" >Order Date</th>
                                        <th class="product-name text-start" >Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>  
                                  
                                     <?php 
                                     
                                     $query=mysqli_query($con,"select products.productImage1 as pimg1,products.productName as pname,orders.productId as opid,products.id as proid, products.shippingCharge as shipcharge, orders.quantity as qty,products.productPrice as pprice,orders.paymentMethod as paym,orders.orderDate as odate,orders.id as orderid from orders join products on orders.productId=products.id where orders.userId='".$_SESSION['id']."' and orders.paymentMethod is null");
                                     $cnt=1;
                                     $num=mysqli_num_rows($query);
                                     if($num>0)
                                     {                                    
                                     while($row=mysqli_fetch_array($query))
                                     {
                                        $shippcharge = htmlentities($row['shipcharge']);
                                     ?>
                                        <td class="product-price text-center"><span class="amount fw-500"><?php echo $cnt;?> </span></td>
                                        <td class="product-thumbnail">
                                            <img style="max-height:100px; object-fit:cover;" class="image rounded-0 blur-up lazyload" data-src="admin/productimages/<?php echo $row['proid'];?>/<?php echo $row['pimg1'];?>" src="admin/productimages/<?php echo $row['proid'];?>/<?php echo $row['pimg1'];?>" alt="Product" title="Product" width="120" height="170" /></a>
                                        </td>

                                        <td class="product-details">
                                            <a href="product-details.php?pid=<?php echo $row['opid'];?>"><p class="product-name mb-0"><?php echo htmlentities($row['pname']);?></p></a>
                                        </td>
                                        <td class="product-price text-center"><span class="amount fw-500"><?php echo $qty=$row['qty']; ?></span></td>
                                        <td class="product-price text-center"><span class="amount fw-500"><?php echo $price=$row['pprice']; ?></span></td>
                                        <td class="product-price text-center"><span class="amount fw-500"><?php echo $shippcharge ?></span></td>
                                        <td class="product-price text-center"><span class="amount fw-500"><?php echo (($qty*$price)+$shippcharge);?></span></td>
                                        <td class="product-price text-center"><span class="amount fw-500"><?php echo $row['paym']; ?>
                                        <td class="product-price text-center"><span class="amount fw-500"><?php echo $row['odate']; ?> </span></td>
                                        <td class="product-price text-center"><span class="amount fw-500">
                                        <a href="pending-orders.php?id=<?php echo $row['orderid']; ?>" type="button" class="btn btn-secondary text-nowrap">Delete</a>
                                        </span></td>



                                    </tr>

                                    <?php  $cnt=$cnt+1; } } else{ ?>
                                        <tr>
                                            <td>No Payment Pending</td>
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