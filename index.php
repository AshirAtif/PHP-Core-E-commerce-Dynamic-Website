<?php
session_start();
require_once("dbconnect.php");
$db_handle = new DBController();
if(!empty($_GET["action"])) {
switch($_GET["action"]) {
	case "add":
		if(!empty($_POST["quantity"])) {
			$productByCode = $db_handle->runQuery("SELECT * FROM tbl_product WHERE code='" . $_GET["code"] . "'");
			$itemArray = array($productByCode[0]["code"]=>array('name'=>$productByCode[0]["name"], 'code'=>$productByCode[0]["code"], 'quantity'=>$_POST["quantity"], 'price'=>$productByCode[0]["price"], 'image'=>$productByCode[0]["image"]));
			
			if(!empty($_SESSION["cart_item"])) {
				if(in_array($productByCode[0]["code"],array_keys($_SESSION["cart_item"]))) {
					foreach($_SESSION["cart_item"] as $k => $v) {
							if($productByCode[0]["code"] == $k) {
								if(empty($_SESSION["cart_item"][$k]["quantity"])) {
									$_SESSION["cart_item"][$k]["quantity"] = 0;
								}
								$_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
							}
					}
				} else {
					$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
				}
			} else {
				$_SESSION["cart_item"] = $itemArray;
			}
		}
	break;
	case "remove":
		if(!empty($_SESSION["cart_item"])) {
			foreach($_SESSION["cart_item"] as $k => $v) {
					if($_GET["code"] == $k)
						unset($_SESSION["cart_item"][$k]);				
					if(empty($_SESSION["cart_item"]))
						unset($_SESSION["cart_item"]);
			}
		}
	break;
	case "empty":
		unset($_SESSION["cart_item"]);
	break;	
}
}
?>
<!DOCTYPE html>
<html lang="zxx">
<head>
	<!-- Meta Tag -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name='copyright' content=''>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Title Tag  -->
    <title>Ezon</title>
    
	<!-- Favicon -->
	<link rel="icon" type="image/png" href="mainezon.png">
	<!-- Web Font -->
	<link href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">
	
	<!-- StyleSheet -->
	
	<!-- Bootstrap -->
	<link rel="stylesheet" href="css/bootstrap.css">
	<!-- Magnific Popup -->
    <link rel="stylesheet" href="css/magnific-popup.min.css">
	<!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" /> 
	<!-- Fancybox -->
	<link rel="stylesheet" href="css/jquery.fancybox.min.css">
	<!-- Themify Icons -->
    <link rel="stylesheet" href="css/themify-icons.css">
	<!-- Nice Select CSS -->
    <link rel="stylesheet" href="css/niceselect.css">
	<!-- Animate CSS -->
    <link rel="stylesheet" href="css/animate.css">
	<!-- Flex Slider CSS -->
    <link rel="stylesheet" href="css/flex-slider.min.css">
	<!-- Owl Carousel -->
    <link rel="stylesheet" href="css/owl-carousel.css">
	<!-- Slicknav -->
    <link rel="stylesheet" href="css/slicknav.min.css">
	
	<!-- Eshop StyleSheet -->
	<link rel="stylesheet" href="css/reset.css">
	<link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/responsive.css">

	<style>
		.imgfooter{
		 width: 50%;
		 height: 50px;
		 
		}
		.single-footer{
			margin-top:10px;
			padding: auto;
		}
		.cart-action .product-quantity{
	padding: 5px 10px;
    border-radius: 3px;
	width: 50px;
    border: #E0E0E0 1px solid;
}
	</style>
	
</head>
<body class="js">
	
	<!-- Preloader -->
	<div class="preloader">
		<div class="preloader-inner">
			<div class="preloader-icon">
				<span></span>
				<span></span>
			</div>
		</div>
	</div>
	<!-- End Preloader -->
	
	
	<!-- Header -->
	<header class="header shop">
		<!-- Topbar -->
		<div class="topbar">
			<div class="container">
				<div class="row">
					<div class="col-lg-4 col-md-12 col-12">
						<!-- Top Left -->
						<div class="top-left">
							<ul class="list-main">
								<li class="all"><i class="fa-solid fa-headphones-simple"></i>  0525561519</li>
								<li class="allthing"><i class="fa-solid fa-envelope"></i>  Zaheerko@yahoo.com</li>
							</ul>
						</div>
						<!--/ End Top Left -->
					</div>
					<div class="col-lg-8 col-md-12 col-12">
						<!-- Top Right -->
						<div class="right-content">
							<ul class="list-main">
								<li class="store"><i class="fa-solid fa-location-pin-lock"></i> Store location</li>
								<li class="thing"><i class="fa-solid fa-clock"></i><a href="shop.php">deals</a></li>
								<li class="make"><i class="fa-solid fa-user"></i><a href="profileform.php">Make Profile</a></li>
								<li class="Sign"><i class="fa-solid fa-power-off"></i><a href="login.php">Sign Out</a></li>
							</ul>
						</div>
						<!-- End Top Right -->
					</div>
				</div>
			</div>
		</div>
		<!-- End Topbar -->
		<div class="middle-inner">
			<div class="container">
				<div class="row">
					<div class="col-lg-2 col-md-2 col-12">
						<!-- Logo -->
						<div class="logo mt-1">
							<a href="index.php"><img class="ezon" src="ezon.com" alt="logo"></a>
						</div>
						<!--/ End Logo -->
						<!-- Search Form -->
						<div class="search-top">
							<div class="top-search"><a href="#0"><i class="fa-solid fa-magnifying-glass"></i></a></div>
							<!-- Search Form -->
							<div class="search-top">
								<form class="search-form">
									<input type="text" placeholder="Search here..." name="search">
									<button value="search" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
								</form>
							</div>
							<!--/ End Search Form -->
						</div>
						<!--/ End Search Form -->
						<div class="mobile-nav"></div>
					</div>
					<div class="col-lg-8 col-md-7 col-12">
						<div class="search-bar-top">
							<div class="search-bar">
								<select>
									<option selected="selected">All Category</option>
									<option>watch</option>
									<option>mobile</option>
									<option>kid’s item</option>
								</select>
								<form>
									<input class="search" id="Search" name="search" placeholder="Search Products Here....." type="search">
									<button class="btnn"><i class="fa-solid fa-magnifying-glass"></i></button>
								</form>
							</div>
						</div>
					</div>
					<div class="col-lg-2 col-md-3 col-12">
						<div class="right-bar">
						    <div class="sinlge-bar">
									<a href="contact.php" class="single-icon"><i class="fa-solid fa-address-book" aria-hidden="true"></i></a>
								</div>
							<!-- Search Form -->
							<div class="sinlge-bar">
								<a href="profile.php" class="single-icon"><i class="fa-solid fa-circle-user" aria-hidden="true"></i></a>
							</div>
							<div class="sinlge-bar shopping">
								<a href="shop.php" class="single-icon"><i class="fa-solid fa-bag-shopping"></i></a>
								<!-- Shopping Item -->
								<div class="shopping-item">
									<div class="dropdown-cart-header">
										<span>Items</span>
										<a href="cart.php">View Cart</a>
									</div>
									<?php	
									if(isset($_SESSION["cart_item"])){
										$total_quantity = 0;
										$total_price = 0;	
                             foreach ($_SESSION["cart_item"] as $item){
                           $item_price = $item["quantity"]*$item["price"];
		?>	
									<ul class="shopping-list">
				
										<li>
											<a href="index.php?action=remove&code=<?php echo $item["code"]; ?>" class="remove" title="Remove this item"><i class="fa fa-remove"></i></a>
											<a class="cart-img" href="#"><img src="<?php echo $item["image"]; ?>" alt="#"></a>
											<h4><a href="#"><?php echo $item["name"]; ?></a></h4>
											<p class="quantity"><span class="amount"><?php echo "AED ".$item["price"]; ?></span></p>
										</li>
									</ul>
									<?php
				$total_quantity += $item["quantity"];
				$total_price += ($item["price"]*$item["quantity"]);
				?>
									<div class="bottom">
										<div class="total">
											<span>Total</span>
											<span class="total-amount"><?php echo number_format($total_price, 2)."AED " ?></span>
										</div>
										
										
									</div>
									<?php }} ?>
									<div class="bottom">
									<a href="checkout.php" class="btn animate">Checkout</a>
									</div>
								</div>
								<!--/ End Shopping Item -->
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Header Inner -->
		<div class="header-inner">
			<div class="container">
				<div class="cat-nav-head">
					<div class="row">
						<div class="col-lg-3">
						</div>
						<div class="col-lg-9 col-12">
							<div class="menu-area">
								<!-- Main Menu -->
								<nav class="navbar navbar-expand-lg">
									<div class="navbar-collapse">	
										<div class="nav-inner">	
											<ul class="nav main-menu menu navbar-nav">
													<li class="active"><a href="index.php">Home</a></li>
													<li><a href="product.php">Product</a></li>												
													<li><a href="service.php">Service</a></li>
													<li><a href="shop.php">Shop<i class="fa-solid fa-angle-down"></i><span class="new">New</span></a>
														<ul class="dropdown">
															<li><a href="cart.php">Cart</a></li>
															<li><a href="checkout.php">Checkout</a></li>
														</ul>
													</li>								
													<li><a href="blog.php">Blog</i></a>
													</li>
													<li><a href="contact.php">Contact Us</a></li>
												</ul>
										</div>
									</div>
								</nav>
								<!--/ End Main Menu -->	
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--/ End Header Inner -->
	</header>
	<!--/ End Header -->
	
	<!-- Slider Area -->
	<section class="hero-slider">
		<!-- Single Slider -->
		<div class="single-slider">
			<div class="container">
				<div class="row no-gutters">
					<div class="col-lg-9 offset-lg-3 col-12">
						<div class="text-inner">
							<div class="row">
								<div class="col-lg-7 col-12">
									<div class="hero-text">
										<h1><span>UP TO 10% OFF </span>Perfume For Man</h1>
										<p>Maboriosam in a nesciung eget magnae <br> dapibus disting tloctio in the find it pereri <br> odiy maboriosm.</p>
										<div class="button">
											<a href="shop.php" class="btn">Shop Now!</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--/ End Single Slider -->
	</section>
	<!--/ End Slider Area -->
	
	<!-- Start Small Banner  -->
	<section class="small-banner section">
		<div class="container-fluid">
			<div class="row">
				<!-- Single Banner  -->
				<div class="col-lg-4 col-md-6 col-12">
					<div class="single-banner">
						<img src="perfumecoco.jpg" style="height:300px;" alt="#">
						<div class="content">
							<p>Man's Collectons</p>
							<h3>Summer travel <br> 2023</h3>
							<a href="shop.php">Shop Now</a>
						</div>
					</div>
				</div>
				<!-- /End Single Banner  -->
				<!-- Single Banner  -->
				<div class="col-lg-4 col-md-6 col-12">
					<div class="single-banner">
						<img src="chanel.jpg" style="height:300px;" alt="#">
						<div class="content">
							<p>Bag Collectons</p>
							<h3>Awesome Bag <br> 2023</h3>
							<a href="cart.php">Shop Now</a>
						</div>
					</div>
				</div>
				<!-- /End Single Banner  -->
				<!-- Single Banner  -->
				<div class="col-lg-4 col-12">
					<div class="single-banner tab-height">
						<img src="perfumetwo.jpg" style="height:300px;" alt="#">
						<div class="content">
							<p>Flash Sale</p>
							<h3>Mid Season <br> Up to <span>40%</span> Off</h3>
							<a href="blog.php">Discover Now</a>
						</div>
					</div>
				</div>
				<!-- /End Single Banner  -->
			</div>
		</div>
	</section>
	<!-- End Small Banner -->
	
	<!-- Start Product Area -->
    <div class="product-area section" id="oldsearchdata">
            <div class="container">
				<div class="row">
					<div class="col-12">
						<div class="section-title">
							<h2>Trending Item</h2>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-12">
						<div class="product-info">
							<div class="nav-main">
								<!-- Tab Nav -->
								<ul class="nav nav-tabs" id="myTab" role="tablist">
									<li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#man" role="tab">Products</a></li>
									<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#amazon" role="tab">Amazon</a></li>
								</ul>
								<!--/ End Tab Nav -->
							</div>
							<div class="tab-content" id="myTabContent">
								<!-- Start Single Tab -->
								<div class="tab-pane fade show active" id="man" role="tabpanel">
									<div class="tab-single">
										<div class="row">
										<?php $product_array = $db_handle->runQuery("SELECT * FROM tblproduct ORDER BY id ASC");
                                         if (!empty($product_array)) { 
	                                     foreach($product_array as $key=>$value){
                                         ?>
							  <div class="col-xl-3 col-lg-4 col-md-4 col-12">
							   <form method="post" action="cart.php?action=add&code=<?php echo $product_array[$key]["code"]; ?>">
								<div class="single-product">
									<div class="product-img">
										<a href="#">
											<img class="default-img" style=" width:270px; height:200px;" src="<?php echo $product_array[$key]["image"]; ?>" alt="#">
											<img class="hover-img" style=" width:270px; height:200px;" src="<?php echo $product_array[$key]["hover"]; ?>" alt="#">
										</a>
										<div class="button-head">
											<div class="product-action-2">
											<a title="Buy now" href="checkout.php"><input type="button" class="btn" value="Buy Now"></a>
											<a title="Add to cart" href="cart.php"><input type="submit" class="btn" value="Add to cart "></a>
											</div>
										</div>
									</div>
									<div class="product-content">
										<h3><a href="product.php"><?php echo $product_array[$key]["name"]; ?></a></h3>
										<div class="cart-action"><input type="number" class="product-quantity" name="quantity" value="1"/></div>
										<div class="product-price">
											<span><?php echo "AED".$product_array[$key]["price"]; ?></span>
										</div>
									</div>
								</div>
							</form>
					</div>
    <?php } }?>
		  </div>
		</div>
	</div>
	
								<!--/ End Single Tab -->
								<!-- Start Single Tab -->
								<div class="tab-pane fade" id="amazon" role="tabpanel">
									<div class="tab-single">
										<div class="row">
										<?php $product_array = $db_handle->runQuery("SELECT * FROM tblamazon ORDER BY id ASC");
                                         if (!empty($product_array)) { 
	                               foreach($product_array as $key=>$value){
                               ?>
							<div class="col-xl-3 col-lg-4 col-md-4 col-12">
							<form method="post" action="cart.php?action=add&code=<?php echo $product_array[$key]["code"]; ?>">
								<div class="single-product">
									<div class="product-img">
										<a href="#">
											<img class="default-img" style=" width:270px; height:200px;" src="<?php echo $product_array[$key]["image"]; ?>" alt="#">
											<img class="hover-img" style=" width:270px; height:200px;" src="<?php echo $product_array[$key]["hover"]; ?>" alt="#">
										</a>
										<div class="button-head">
											<div class="product-action">
												
											
											</div>
											<div class="product-action-2">
											<a title="Add to cart" href="checkout.php"><input type="submit" class="btn" value="Buy Now"></a>
											<a title="Add to cart" href="cart.php"><input type="submit" class="btn" value="Add to cart "></a>
											
												
											</div>
										</div>
									</div>
									<div class="product-content">
										<h3><a href="product.php"><?php echo $product_array[$key]["name"]; ?></a></h3>
										<div class="cart-action"><input type="number" class="product-quantity" name="quantity" value="1"/></div>
										<div class="product-price">
											<span><?php echo $product_array[$key]["price"]; ?></span>
										</div>
									</div>
								</div>
							</form>
					</div>
    <?php } }?>
			</div>
		</div>
										
										</div>
									</div>
								</div>
								<!--/ End Single Tab -->
							</div>
						</div>
					</div>
				</div>
            </div>
    </div>
	<!-- End Product Area -->
	<div class="container">
		<div class="row" id="searchdata" style="padding-bottom:50px;"></div>
	    </div>
	<!-- Start Midium Banner  -->
	<section class="midium-banner">
		<div class="container">
			<div class="row">
				<!-- Single Banner  -->
				<div class="col-lg-6 col-md-6 col-12">
					<div class="single-banner">
						<img src="perfumefour.jpg" style="height:500px;" alt="#">
						<div class="content">
							<p>Man's Collectons</p>
							<h3>Man's items <br>Up to<span> 10%</span></h3>
							<a href="checkout.php">Shop Now</a>
						</div>
					</div>
				</div>
				<!-- /End Single Banner  -->
				<!-- Single Banner  -->
				<div class="col-lg-6 col-md-6 col-12">
					<div class="single-banner">
						<img src="perfumefive.jpg" style="height:500px;" alt="#">
						<div class="content">
							<p>shoes women</p>
							<h3>mid season <br> up to <span>15%</span></h3>
							<a href="checkout.php" class="btn">Shop Now</a>
						</div>
					</div>
				</div>
				<!-- /End Single Banner  -->
			</div>
		</div>
	</section>
	
	<!-- End Midium Banner -->
	
	<!-- Start Most Popular -->
	<div class="product-area most-popular section">
        <div class="container">
            <div class="row">
				<div class="col-12">
					<div class="section-title">
						<h2>Hot Item</h2>
					</div>
				</div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="owl-carousel popular-slider">
						<!-- Start Single Product -->
						<?php
  $product_array = $db_handle->runQuery("SELECT * FROM tblproduct ORDER BY id ASC");
  if (!empty($product_array)) { 
	  foreach($product_array as $key=>$value){
    ?>
							<form method="post" action="cart.php?action=add&code=<?php echo $product_array[$key]["code"]; ?>">
								<div class="single-product">
									<div class="product-img">
										<a href="#">
											<img class="default-img" style=" width:220px; height:170px;" src="<?php echo $product_array[$key]["image"]; ?>" alt="#">
											<img class="hover-img" style=" width:270px; height:200px;" src="<?php echo $product_array[$key]["hover"]; ?>" alt="#">		
										</a>
										<div class="button-head">
											<div class="product-action-2">
												<a title="Add to cart" href="checkout.php"><input type="submit" class="btn" value="Buy Now"></a>
											    <a title="Add to cart" href="cart.php"><input type="submit" class="btn" value="Add to cart "></a>
											</div>
										</div>
									</div>
									<div class="product-content">
										<h3><a href="product.php"><?php echo $product_array[$key]["name"]; ?></a></h3>
										<div class="cart-action"><input type="number" class="product-quantity" name="quantity" value="1"/></div>
										<div class="product-price">
											<span><?php echo "AED".$product_array[$key]["price"]; ?></span>
										</div>
									</div>
								</div>
							</form>
    <?php
        } }
    ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
	<!-- End Most Popular Area -->
	
	<!-- Start Shop Home List  -->
	<section class="shop-home-list section">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-md-6 col-12">
					<div class="row">
						<div class="col-12">
							<div class="shop-section-title">
								<h1>Ezon Products</h1>
							</div>
						</div>
					</div>
					<!-- Start Single List  -->
					<div class="single-list">
						<div class="row">
						<?php
  $product_array = $db_handle->runQuery("SELECT * FROM tblproduct ORDER BY id ASC");
      if (!empty($product_array)) { 
	  foreach($product_array as $key=>$value){
    ?>
							<div class="col-lg-6 col-md-6 col-12">
								<div class="list-image overlay">
									<img src="<?php echo $product_array[$key]["image"]; ?>" alt="#">
									<a href="checkout.php" class="buy"><i class="fa fa-shopping-bag"></i></a>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-12 no-padding">
								<div class="content">
									<h4 class="title"><a href="#"><?php echo $product_array[$key]["name"]; ?></a></h4>
									<p class="price with-discount"><?php echo "AED".$product_array[$key]["price"]; ?></p>
								</div>
							</div>
							<?php }} ?>
						</div>
	               </div>
					<!-- End Single List  -->
				</div>
				<div class="col-lg-6 col-md-6 col-12">
					<div class="row">
						<div class="col-12">
							<div class="shop-section-title">
								<h1>Amazon Products</h1>
							</div>
						</div>
					</div>
					<!-- Start Single List  -->
					<div class="single-list">
						<div class="row">
						<?php
  $product_array = $db_handle->runQuery("SELECT * FROM tblamazon ORDER BY id ASC");
      if (!empty($product_array)) { 
	  foreach($product_array as $key=>$value){
    ?>
							<div class="col-lg-6 col-md-6 col-12">
								<div class="list-image overlay">
									<img src="<?php echo $product_array[$key]["image"]; ?>" alt="#">
									<a href="checkout.php" class="buy"><i class="fa fa-shopping-bag"></i></a>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-12 no-padding">
								<div class="content">
									<h5 class="title"><a href="#"><?php echo $product_array[$key]["name"]; ?></a></h5>
									<p class="price with-discount"><?php echo $product_array[$key]["price"]; ?></p>
								</div>
							</div>
							<?php }} ?>
						</div>
					</div>
					<!-- End Single List  -->
				</div>
			</div>
		</div>
	</section>
	<!-- End Shop Home List  -->
	
	<!-- Start Cowndown Area -->
	<section class="cown-down">
		<div class="section-inner ">
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-6 col-12 padding-right">
						<div class="image">
							<img src="chanel.jpg" alt="#">
						</div>	
					</div>	
					<div class="col-lg-6 col-12 padding-left">
						<div class="content">
							<div class="heading-block">
								<p class="small-title">Deal of day</p>
								<h3 class="title">Blue Chanel</h3>
								<p class="text">Suspendisse massa leo, vestibulum cursus nulla sit amet, frungilla placerat lorem. Cars fermentum, sapien. </p>
								<h1 class="price">AED120 <s>AED180</s></h1>
								<div class="coming-time">
									<div class="clearfix" data-countdown="10/01/2023"></div>
								</div>
							</div>
						</div>	
					</div>	
				</div>
			</div>
		</div>
	</section>
	<!-- /End Cowndown Area -->
	
	<!-- Start Shop Blog  -->
	<section class="shop-blog section">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="section-title">
						<h2>From Our Blog</h2>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-4 col-md-6 col-12">
					<!-- Start Single Blog  -->
					<div class="shop-single-blog">
						<img src="perfumetwo.jpg" style=" width:300px; height:330px;" alt="#">
						<div class="content">
							<p class="date">22 July , 2020. Monday</p>
							<a href="blog.php" class="title">Sed adipiscing ornare.</a>
							<a href="blog.php" class="more-btn">Continue Reading</a>
						</div>
					</div>
					<!-- End Single Blog  -->
				</div>
				<div class="col-lg-4 col-md-6 col-12">
					<!-- Start Single Blog  -->
					<div class="shop-single-blog">
						<img src="perfumefive.jpg" style=" width:300px; height:330px;" alt="#">
						<div class="content">
							<p class="date">22 July, 2020. Monday</p>
							<a href="blog.php" class="title">Man’s Fashion Winter Sale</a>
							<a href="blog.php" class="more-btn">Continue Reading</a>
						</div>
					</div>
					<!-- End Single Blog  -->
				</div>
				<div class="col-lg-4 col-md-6 col-12">
					<!-- Start Single Blog  -->
					<div class="shop-single-blog">
						<img src="perfumethree.jpg" style=" width:300px; height:330px;" alt="#">
						<div class="content">
							<p class="date">22 July, 2020. Monday</p>
							<a href="blog.php" class="title">Women Fashion Festive</a>
							<a href="blog.php" class="more-btn">Continue Reading</a>
						</div>
					</div>
					<!-- End Single Blog  -->
				</div>
			</div>
		</div>
	</section>
	<!-- End Shop Blog  -->
	
	<!-- Start Shop Services Area -->
	<section class="shop-services section home">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-6 col-12">
					<!-- Start Single Service -->
					<div class="single-service">
                    <i class="fa-solid fa-rocket"></i>
						<h4>Free shiping</h4>
						<p>Orders over 100 AED</p>
					</div>
					<!-- End Single Service -->
				</div>
				<div class="col-lg-3 col-md-6 col-12">
					<!-- Start Single Service -->
					<div class="single-service">
					<i class="fa-solid fa-rotate-right"></i>
						<h4>Free Return</h4>
						<p>Within 30 days returns</p>
					</div>
					<!-- End Single Service -->
				</div>
				<div class="col-lg-3 col-md-6 col-12">
					<!-- Start Single Service -->
					<div class="single-service">
                    <i class="fa-solid fa-lock"></i>
						<h4>Sucure Payment</h4>
						<p>100% secure payment</p>
					</div>
					<!-- End Single Service -->
				</div>
				<div class="col-lg-3 col-md-6 col-12">
					<!-- Start Single Service -->
					<div class="single-service">
					<i class="fa-solid fa-tag"></i>
						<h4>Best Peice</h4>
						<p>Guaranteed price</p>
					</div>
					<!-- End Single Service -->
				</div>
			</div>
		</div>
	</section>
	<!-- End Shop Services Area -->
	
	<!-- Start Shop Newsletter  -->
	<section class="shop-newsletter section">
		<div class="container">
			<div class="inner-top">
				<div class="row">
					<div class="col-lg-8 offset-lg-2 col-12">
						<!-- Start Newsletter Inner -->
						<div class="inner">
							<h4>Newsletter</h4>
							<p> Subscribe to our newsletter and get <span>10%</span> off your first purchase</p>
							<form action="mail/mail.php" method="get" target="_blank" class="newsletter-inner">
								<input name="EMAIL" placeholder="Your email address" required="" type="email">
								<button class="btn">Subscribe</button>
							</form>
						</div>
						<!-- End Newsletter Inner -->
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- End Shop Newsletter -->
	
	
	<!-- Start Footer Area -->
	<footer class="footer">
		<!-- Footer Top -->
		<div class="footer-top section">
			<div class="container">
				<div class="row">
					<div class="col-lg-5 col-md-6 col-12">
						<!-- Single Widget -->
						<div class="single-footer about">
							<div class="logo">
								<a href="index.php"
                                ><img src="ezonbg.png" alt="#" class="imgfooter"></a>
							</div>
							<p class="text">Online shopping is the process whereby consumers directly buy goods or services from a seller in real-time, without an intermediary service, over the Internet.</p>
							<p class="call">Got Question? Call us 24/7<span><a href="tel:123456789">+923152372328</a></span></p>
						</div>
						<!-- End Single Widget -->
					</div>
					<div class="col-lg-2 col-md-6 col-12">
						<!-- Single Widget -->
						<div class="single-footer links">
							<h4>Information</h4>
							<ul>
								<li><a href="#">About Us</a></li>
								<li><a href="#">Faq</a></li>
								<li><a href="#">Terms & Conditions</a></li>
								<li><a href="#">Contact Us</a></li>
								<li><a href="#">Help</a></li>
							</ul>
						</div>
						<!-- End Single Widget -->
					</div>
					<div class="col-lg-2 col-md-6 col-12">
						<!-- Single Widget -->
						<div class="single-footer links">
							<h4>Customer Service</h4>
							<ul>
								<li><a href="#">Payment Methods</a></li>
								<li><a href="#">Money-back</a></li>
								<li><a href="#">Returns</a></li>
								<li><a href="#">Shipping</a></li>
								<li><a href="#">Privacy Policy</a></li>
							</ul>
						</div>
						<!-- End Single Widget -->
					</div>
					<div class="col-lg-3 col-md-6 col-12">
						<!-- Single Widget -->
						<div class="single-footer social">
							<h4>Get In Tuch</h4>
							<!-- Single Widget -->
							<div class="contact">
								<ul>
									<li>NO. 342 - London Oxford Street.</li>
									<li>012 UAE.</li>
									<li>info@eshop.com</li>
									<li>+032 3456 7890</li>
								</ul>
							</div>
							<!-- End Single Widget -->
							<ul>
								<li><a href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
								<li><a href="#"><i class="fa-brands fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa-brands fa-linkedin"></i></a></li>
								<li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
							</ul>
						</div>
						<!-- End Single Widget -->
					</div>
				</div>
			</div>
		</div>
		<!-- End Footer Top -->
		<div class="copyright">
			<div class="container">
				<div class="inner">
					<div class="row">
						<div class="col-lg-6 col-12">
							<div class="left">
								<p>Copyright © 2023 <a href="#" target="_blank">Ezon</a>  -  All Rights Reserved.</p>
							</div>
						</div>
						<div class="col-lg-6 col-12">
							<div class="right">
								<img src="images/payments.png" alt="#">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer>
	<!-- /End Footer Area -->
 
	<!-- Jquery -->
    <script src="js/jquery.min.js"></script>
    <script src="js/jquery-migrate-3.0.0.js"></script>
	<script src="js/jquery-ui.min.js"></script>
	<!-- Popper JS -->
	<script src="js/popper.min.js"></script>
	<!-- Bootstrap JS -->
	<script src="js/bootstrap.min.js"></script>
	<!-- Color JS -->
	<script src="js/colors.js"></script>
	<!-- Slicknav JS -->
	<script src="js/slicknav.min.js"></script>
	<!-- Owl Carousel JS -->
	<script src="js/owl-carousel.js"></script>
	<!-- Magnific Popup JS -->
	<script src="js/magnific-popup.js"></script>
	<!-- Waypoints JS -->
	<script src="js/waypoints.min.js"></script>
	<!-- Countdown JS -->
	<script src="js/finalcountdown.min.js"></script>
	<!-- Nice Select JS -->
	<script src="js/nicesellect.js"></script>
	<!-- Flex Slider JS -->
	<script src="js/flex-slider.js"></script>
	<!-- ScrollUp JS -->
	<script src="js/scrollup.js"></script>
	<!-- Onepage Nav JS -->
	<script src="js/onepage-nav.min.js"></script>
	<!-- Easing JS -->
	<script src="js/easing.js"></script>
	<!-- Active JS -->
	<script src="js/active.js"></script>
	<script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
	<script>
		$(document).ready(function(){
			$("#Search").keyup(function(){
                var value = $(this).val();
				if(value != ""){
					$.ajax({

						url:"searchbardata.php",
						method :"POST",
						data :{
							value : value
						},
						success :function(data){
							$("#searchdata").html(data);
							$("#searchdata").show();
							$("#oldsearchdata").hide();
							
						}
					});
				}
				else{
					$("#searchdata").hide();
					$("#oldsearchdata").show();
					
				}
			});
		});
	</script>
</body>
</html>