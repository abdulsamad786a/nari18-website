<?php 
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
    {   
header('location:login.php');
}
else{

?>
<?php include 'header.php'?>

<script language="javascript" type="text/javascript">
var popUpWin=0;
function popUpWindow(URLStr, left, top, width, height)
{
 if(popUpWin)
{
if(!popUpWin.closed) popUpWin.close();
}
popUpWin = open(URLStr,'popUpWin', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,copyhistory=yes,width='+600+',height='+600+',left='+left+', top='+top+',screenX='+left+',screenY='+top+'');
}

</script>
            <!-- Body Container -->
            <div id="page-content">
                <!--Page Header-->
                <div class="page-header text-center">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 d-flex justify-content-between align-items-center">
                                <div class="page-title"><h1>Order Details</h1></div>
                                <!--Breadcrumbs-->
                                <div class="breadcrumbs"><a href="index.html" title="Back to the home page">Home</a><span class="main-title"><i class="icon anm anm-angle-right-l"></i>Order Details</span></div>
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
                                     $orderid=$_POST['orderid'];
                                     $email=$_POST['email'];
                                     $ret = mysqli_query($con,"select t.email,t.id from (select usr.email,odrs.id from users as usr join orders as odrs on usr.id=odrs.userId) as t where  t.email='$email' and (t.id='$orderid')");
                                     $num=mysqli_num_rows($ret);
                                     if($num>0)
                                     {
                                     $query=mysqli_query($con,"select products.productImage1 as pimg1,products.productName as pname,orders.productId as opid,products.id as proid, products.shippingCharge as shipcharge, orders.quantity as qty,products.productPrice as pprice,orders.paymentMethod as paym,orders.orderDate as odate,orders.id as orderid from orders join products on orders.productId=products.id where orders.id='$orderid' and orders.paymentMethod is not null");
                                     $cnt=1;
                                     
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
                                        <a href="javascript:void(0);" onClick="popUpWindow('track-order.php?oid=<?php echo htmlentities($row['orderid']);?>')" type="button" class="btn btn-secondary text-nowrap">Track Order</a>
                                        </span></td>



                                    </tr>

                                    <?php  $cnt=$cnt+1; } } else{ ?>
                                        <tr>
                                            <td>Either order id or  Registered email id is invalid</td>
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