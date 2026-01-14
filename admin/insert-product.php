<?php
session_start();
include('include/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{
	
if(isset($_POST['submit']))
{
	$category=$_POST['category'];
	$subcat=$_POST['subcategory'];
	$productname=$_POST['productName'];
	$productcompany=$_POST['productCompany'];
	$productprice=$_POST['productprice'];
	$productpricebd=$_POST['productpricebd'];
	$productdescription=$_POST['productDescription'];
	$productscharge=$_POST['productShippingcharge'];
	$productavailability=$_POST['productAvailability'];
	$productvideo=$_POST['productVideo'];
	$productimage1=$_FILES["productimage1"]["name"];
	$productimage2=$_FILES["productimage2"]["name"];
	$productimage3=$_FILES["productimage3"]["name"];
	
	// YouTube URL validation and processing
	$youtube_id = '';
	if(!empty($productvideo)) {
		// Extract YouTube video ID from various URL formats
		if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $productvideo, $match)) {
			$youtube_id = $match[1];
			$productvideo = $youtube_id; // Store only the video ID
		} else {
			$_SESSION['error']="Invalid YouTube URL format!";
			header('location:insert-product.php?error=1');
			exit();
		}
	}
	
	//for getting product id
	$query=mysqli_query($con,"select max(id) as pid from products");
		$result=mysqli_fetch_array($query);
		$productid=$result['pid']+1;
		$dir="productimages/$productid";
	if(!is_dir($dir)){
			mkdir("productimages/".$productid);
		}

	move_uploaded_file($_FILES["productimage1"]["tmp_name"],"productimages/$productid/".$_FILES["productimage1"]["name"]);
	move_uploaded_file($_FILES["productimage2"]["tmp_name"],"productimages/$productid/".$_FILES["productimage2"]["name"]);
	move_uploaded_file($_FILES["productimage3"]["tmp_name"],"productimages/$productid/".$_FILES["productimage3"]["name"]);
	
$sql=mysqli_query($con,"insert into products(category,subCategory,productName,productCompany,productPrice,productDescription,shippingCharge,productAvailability,productImage1,productImage2,productImage3,productPriceBeforeDiscount,productVideo) values('$category','$subcat','$productname','$productcompany','$productprice','$productdescription','$productscharge','$productavailability','$productimage1','$productimage2','$productimage3','$productpricebd','$productvideo')");
$_SESSION['msg']="Product Inserted Successfully !!";

}


?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin| Insert Product</title>
	<link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link type="text/css" href="css/theme.css" rel="stylesheet">
	<link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
	<link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600'
		rel='stylesheet'>
	<script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
	<script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>

	<script>
		function getSubcat(val) {
			$.ajax({
				type: "POST",
				url: "get_subcat.php",
				data: 'cat_id=' + val,
				success: function (data) {
					$("#subcategory").html(data);
				}
			});
		}
		function selectCountry(val) {
			$("#search-box").val(val);
			$("#suggesstion-box").hide();
		}
		
		// YouTube URL validation function
		function validateYouTubeURL() {
			var url = document.getElementById('productVideo').value;
			var preview = document.getElementById('video-preview');
			
			if(url.trim() === '') {
				preview.innerHTML = '';
				return;
			}
			
			var regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
			var match = url.match(regExp);
			
			if (match && match[2].length == 11) {
				var videoId = match[2];
				preview.innerHTML = '<div style="margin-top: 10px;"><iframe width="300" height="200" src="https://www.youtube.com/embed/' + videoId + '" frameborder="0" allowfullscreen></iframe></div>';
			} else {
				preview.innerHTML = '<div style="margin-top: 10px; color: red;">Invalid YouTube URL</div>';
			}
		}
	</script>

</head>

<body>
	<?php include('include/header.php');?>

	<div class="wrapper">
		<div class="container">
			<div class="row">
				<?php include('include/sidebar.php');?>
				<div class="span9">
					<div class="content">

						<div class="module">
							<div class="module-head">
								<h3>Insert Product</h3>
							</div>
							<div class="module-body">

								<?php if(isset($_POST['submit']))
{?>
								<div class="alert alert-success">
									<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>Well done!</strong>
									<?php echo htmlentities($_SESSION['msg']);?>
									<?php echo htmlentities($_SESSION['msg']="");?>
								</div>
								<?php } ?>

								<?php if(isset($_GET['error']))
{?>
								<div class="alert alert-error">
									<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>Oh snap!</strong>
									<?php echo htmlentities($_SESSION['error']);?>
									<?php echo htmlentities($_SESSION['error']="");?>
								</div>
								<?php } ?>

								<?php if(isset($_GET['del']))
{?>
								<div class="alert alert-error">
									<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>Oh snap!</strong>
									<?php echo htmlentities($_SESSION['delmsg']);?>
									<?php echo htmlentities($_SESSION['delmsg']="");?>
								</div>
								<?php } ?>

								<br />

								<form class="form-horizontal row-fluid" name="insertproduct" method="post"
									enctype="multipart/form-data">

									<div class="control-group">
										<label class="control-label" for="basicinput">Category</label>
										<div class="controls">
											<select name="category" class="span8 tip" onChange="getSubcat(this.value);"
												required>
												<option value="">Select Category</option>
												<?php $query=mysqli_query($con,"select * from category");
while($row=mysqli_fetch_array($query))
{?>

												<option value="<?php echo $row['id'];?>">
													<?php echo $row['categoryName'];?>
												</option>
												<?php } ?>
											</select>
										</div>
									</div>

									<div class="control-group">
										<label class="control-label" for="basicinput">Sub Category</label>
										<div class="controls">
											<select name="subcategory" id="subcategory" class="span8 tip" required>
											</select>
										</div>
									</div>

									<div class="control-group">
										<label class="control-label" for="basicinput">Product Name</label>
										<div class="controls">
											<input type="text" name="productName" placeholder="Enter Product Name"
												class="span8 tip" required>
										</div>
									</div>

									<div class="control-group">
										<label class="control-label" for="basicinput">Product Company</label>
										<div class="controls">
											<input type="text" name="productCompany"
												placeholder="Enter Product Company Name" class="span8 tip" required>
										</div>
									</div>
									
									<div class="control-group">
										<label class="control-label" for="basicinput">Product Price Before
											Discount</label>
										<div class="controls">
											<input type="text" name="productpricebd" placeholder="Enter Product Price"
												class="span8 tip" required>
										</div>
									</div>

									<div class="control-group">
										<label class="control-label" for="basicinput">Product Price After
											Discount(Selling Price)</label>
										<div class="controls">
											<input type="text" name="productprice" placeholder="Enter Product Price"
												class="span8 tip" required>
										</div>
									</div>

									<div class="control-group">
										<label class="control-label" for="basicinput">Product Description</label>
										<div class="controls">
											<textarea name="productDescription" placeholder="Enter Product Description"
												rows="6" class="span8 tip">
											</textarea>
										</div>
									</div>

									<div class="control-group">
										<label class="control-label" for="basicinput">Product Shipping Charge</label>
										<div class="controls">
											<input type="text" name="productShippingcharge"
												placeholder="Enter Product Shipping Charge" class="span8 tip" required>
										</div>
									</div>

									<div class="control-group">
										<label class="control-label" for="basicinput">Product Availability</label>
										<div class="controls">
											<select name="productAvailability" id="productAvailability"
												class="span8 tip" required>
												<option value="">Select</option>
												<option value="In Stock">In Stock</option>
												<option value="Out of Stock">Out of Stock</option>
											</select>
										</div>
									</div>

									<div class="control-group">
										<label class="control-label" for="basicinput">Product Image1</label>
										<div class="controls">
											<input type="file" name="productimage1" id="productimage1" value=""
												class="span8 tip" required>
										</div>
									</div>

									<div class="control-group">
										<label class="control-label" for="basicinput">Product Image2</label>
										<div class="controls">
											<input type="file" name="productimage2" class="span8 tip" >
										</div>
									</div>

									<div class="control-group">
										<label class="control-label" for="basicinput">Product Image3</label>
										<div class="controls">
											<input type="file" name="productimage3" class="span8 tip">
										</div>
									</div>

									<!-- NEW VIDEO FIELD -->
									<div class="control-group">
										<label class="control-label" for="basicinput">Product Video (YouTube)</label>
										<div class="controls">
											<input type="url" name="productVideo" id="productVideo" 
												placeholder="Enter YouTube Video URL (Optional)" 
												class="span8 tip" 
												onchange="validateYouTubeURL()"
												onkeyup="validateYouTubeURL()">
											<span class="help-block">
												Supported formats:<br>
												• https://www.youtube.com/watch?v=VIDEO_ID<br>
												• https://youtu.be/VIDEO_ID<br>
												• https://www.youtube.com/embed/VIDEO_ID
											</span>
											<div id="video-preview"></div>
										</div>
									</div>

									<div class="control-group">
										<div class="controls">
											<button type="submit" name="submit" class="btn">Insert</button>
										</div>
									</div>
								</form>
							</div>
						</div>

					</div><!--/.content-->
				</div><!--/.span9-->
			</div>
		</div><!--/.container-->
	</div><!--/.wrapper-->

	<?php include('include/footer.php');?>

	<script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
	<script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
	<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="scripts/flot/jquery.flot.js" type="text/javascript"></script>
	<script src="scripts/datatables/jquery.dataTables.js"></script>
	<script>
		$(document).ready(function () {
			$('.datatable-1').dataTable();
			$('.dataTables_paginate').addClass("btn-group datatable-pagination");
			$('.dataTables_paginate > a').wrapInner('<span />');
			$('.dataTables_paginate > a:first-child').append('<i class="icon-chevron-left shaded"></i>');
			$('.dataTables_paginate > a:last-child').append('<i class="icon-chevron-right shaded"></i>');
		});
	</script>
</body>
<?php } ?>