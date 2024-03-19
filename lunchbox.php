<?php
session_start();
require_once("dbconnect.php");
$db_handle = new DBController();
if(!empty($_GET["action"])) {
switch($_GET["action"]) {
	case "add":
		if(!empty($_POST["quantity"])) {
			$productByCode = $db_handle->runQuery("SELECT * FROM tblproduct WHERE code='" . $_GET["code"] . "'");
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
	<!-- Jquery Ui -->
    <link rel="stylesheet" href="css/jquery-ui.css">
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



    <!-- Eshop detail page StyleSheet -->
    <link rel="stylesheet" href="detailcss/corestyle.css">
    <link rel="stylesheet" href="detailcss/style.css">
    <!-- Responsive CSS -->
    <link href="detailcss/responsive.css" rel="stylesheet">

	<style>
		.ti-heart{
			margin-right: 10px;
		}

.cart-action .product-quantity{
	padding: 5px 10px;
    border-radius: 3px;
	width: 50px;
    border: #E0E0E0 1px solid;
}
.submitbtn{
	border:none;
}
	</style>
	
</head>
<body class="js">
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
													<li ><a href="index.php">Home</a></li>
													<li class="active"><a href="product.php">Product</a></li>												
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

<!-- <<<<<<<<<<<<<<<<<<<< Breadcumb Area Start <<<<<<<<<<<<<<<<<<<< -->
<div class="breadcumb_area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <ol class="breadcrumb d-flex align-items-center">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active">Lunch box</li>
                </ol>
                <!-- btn -->
                <a href="product.php" class="backToHome d-block"><i class="fa fa-angle-double-left"></i> Back to Product</a>
            </div>
        </div>
    </div>
</div>
<!-- <<<<<<<<<<<<<<<<<<<< Breadcumb Area End <<<<<<<<<<<<<<<<<<<< -->

        <!-- <<<<<<<<<<<<<<<<<<<< Single Product Details Area Start >>>>>>>>>>>>>>>>>>>>>>>>> -->
        <section class="single_product_details_area section_padding_0_100">
            <div class="container">
                <div class="row">

                    <div class="col-12 col-md-6">
                        <div class="single_product_thumb">
                            <div id="product_details_slider" class="carousel slide" data-ride="carousel">

                                <ol class="carousel-indicators">
                                    <li class="active" data-target="#product_details_slider" data-slide-to="0" style="background-image: url(lunchbox1.jpg); background-size: cover;">
                                    </li>
                                    <li data-target="#product_details_slider" data-slide-to="1" style="background-image: url(lunchbox2.jpg); 	background-size: cover;">
                                    </li>
                                    <li data-target="#product_details_slider" data-slide-to="2" style="background-image: url(lunchbox3.jpg); 	background-size: cover;">
                                    </li>
                                    <li data-target="#product_details_slider" data-slide-to="3" style="background-image: url(lunchbox4.jpg); 	background-size: cover;">
                                    </li>
                                </ol>

                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <a class="gallery_img" href="lunchbox1.jpg">
                                        <img class="d-block w-100" style="height:650px;" src="lunchbox1.jpg" alt="First slide">
                                    </a>
                                    </div>
                                    <div class="carousel-item">
                                        <a class="gallery_img" href="lunchbox2.jpg">
                                        <img class="d-block w-100" style="height:650px;" src="lunchbox2.jpg" alt="Second slide">
                                    </a>
                                    </div>
                                    <div class="carousel-item">
                                        <a class="gallery_img" href="lunchbox3.jpg">
                                        <img class="d-block w-100" style="height:650px;" src="lunchbox3.jpg" alt="Third slide">
                                    </a>
                                    </div>
                                    <div class="carousel-item">
                                        <a class="gallery_img" href="lunchbox4.jpg">
                                        <img class="d-block w-100" style="height:650px;" src="lunchbox4.jpg" alt="Fourth slide">
                                    </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="single_product_desc">

                            <h4 class="title"><a href="#">Plastic Lunch Box</a></h4>

                            <h4 class="price">30.99 AED</h4>

                            <p class="available">Available: <span class="text-muted" style="color:green;">In Stock</span></p>

                            <div class="single_product_ratings mb-15">
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star-o" aria-hidden="true"></i>
                            </div>

                            <!-- Add to Cart Form -->
                            <form class="cart clearfix mb-50 d-flex" method="post">
                                <div class="quantity">
                                    <span class="qty-minus" onclick="var effect = document.getElementById('qty'); var qty = effect.value; if( !isNaN( qty ) &amp;&amp; qty &gt; 1 ) effect.value--;return false;"><i class="fa fa-minus" aria-hidden="true"></i></span>
                                    <input type="number" class="qty-text" id="qty" step="1" min="1" max="12" name="quantity" value="1">
                                    <span class="qty-plus" onclick="var effect = document.getElementById('qty'); var qty = effect.value; if( !isNaN( qty )) effect.value++;return false;"><i class="fa fa-plus" aria-hidden="true"></i></span>
                                </div>

                              
                                      <a title="Buy now" href="checkout.php"><input type="button" style="margin-left:20px;" class="btn" id="btnbuy" value="Buy Now"></a>
									  <a title="Add to cart" href="cart.php"><input type="submit" style="margin-left:10px;" class="btn" id="btnbuy" value="Add to cart "></a>
                           
                            </form>

                            <div id="accordion" role="tablist">
                                <div class="card">
                                    <div class="card-header" role="tab" id="headingOne">
                                        <h6 class="mb-0">
                                            <a data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Information</a>
                                        </h6>
                                    </div>

                                    <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
                                        <div class="card-body">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin pharetra tempor so dales. Phasellus sagittis auctor gravida. Integ er bibendum sodales arcu id te mpus. Ut consectetur lacus.</p>
                                            <p>Approx length 66cm/26" (Based on a UK size 8 sample) Mixed fibres</p>
                                            <p>The Model wears a UK size 8/ EU size 36/ US size 4 and her height is 5'8"</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" role="tab" id="headingTwo">
                                        <h6 class="mb-0">
                                            <a class="collapsed" data-toggle="collapse" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">Cart Details</a>
                                        </h6>
                                    </div>
                                    <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo" data-parent="#accordion">
                                        <div class="card-body">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Explicabo quis in veritatis officia inventore, tempore provident dignissimos nemo, nulla quaerat. Quibusdam non, eos, voluptatem reprehenderit hic nam! Laboriosam, sapiente! Praesentium.</p>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officia magnam laborum eaque.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" role="tab" id="headingThree">
                                        <h6 class="mb-0">
                                            <a class="collapsed" data-toggle="collapse" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">shipping &amp; Returns</a>
                                        </h6>
                                    </div>
                                    <div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree" data-parent="#accordion">
                                        <div class="card-body">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse quo sint repudiandae suscipit ab soluta delectus voluptate, vero vitae, tempore maxime rerum iste dolorem mollitia perferendis distinctio. Quibusdam laboriosam rerum distinctio. Repudiandae fugit odit, sequi id!</p>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae qui maxime consequatur laudantium temporibus ad et. A optio inventore deleniti ipsa.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ****** Quick View Modal Area Start ****** -->
        <div class="modal fade" id="quickview" tabindex="-1" role="dialog" aria-labelledby="quickview" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

                    <div class="modal-body">
                      							<div class="row no-gutters">
								<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
									<!-- Product Slider -->
										<div class="product-gallery">
											<div class="quickview-slider-active" >
												<div class="single-slider">
													<img src="harddrive.jpg" style="height:450px;"  alt="#">
												</div>
												<div class="single-slider">
													<img src="harddrive2.jpg" style="height:450px;" alt="#">
												</div>
											</div>
										</div>
									<!-- End Product slider -->
								</div>
								<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
							
									<div class="quickview-content">
										<h2>Harddrive</h2>
										<div class="quickview-ratting-review">
											<div class="quickview-ratting-wrap">
												<div class="quickview-ratting">
													<i class="yellow fa fa-star"></i>
													<i class="yellow fa fa-star"></i>
													<i class="yellow fa fa-star"></i>
													<i class="yellow fa fa-star"></i>
													<i class="fa fa-star"></i>
												</div>
												<a href="#"> (Customer reviews)</a>
											</div>
											<div class="quickview-stock">
												<span><i class="fa-solid fa-circle-check"></i> in stock</span>
											</div>
										</div>
										<h3>300AED</h3>
										<div class="quickview-peragraph">
											<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia iste laborum ad impedit pariatur esse optio tempora sint ullam autem deleniti nam in quos qui nemo ipsum numquam.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia iste laborum ad impedit pariatur.</p>
	                                    </div>
										<div class="quantity" style="margin-top:20px;">
											<!-- Input Order -->
											<div class="input-group">
												<div class="button minus">
													<button type="button" class="btn btn-primary btn-number"  data-type="minus" data-field="quant[1]">
														<i class="ti-minus"></i>
													</button>
												</div>
												<input type="text" name="quant[1]" class="input-number"  data-min="1" data-max="10" value="1">
												<div class="button plus">
													<button type="button" class="btn btn-primary btn-number" data-type="plus" data-field="quant[1]">
														<i class="ti-plus"></i>
													</button>
												</div>
											</div>
											<!--/ End Input Order -->
										</div>
										<div class="add-to-cart" style="margin-top:20px;">
											<a title="Add to cart" href="cart.php"><input type="submit" class="btn" value="Add to cart "></a>
											<a title="Buy now" href="checkout.php"><input type="button" class=" btn" value="Buy Now"></a>
											<a href="#" class="btn min"><i class="fa-solid fa-blog"></i></a>
										</div>
		
										<div class="default-social">
											<h4 class="share-now">Share:</h4>
											<ul>
												<li><a class="facebook" href="#"><i class="fa-brands fa-facebook"></i></a></li>
												<li><a class="twitter" href="#"><i class="fa-brands fa-twitter"></i></a></li>
												<li><a class="youtube" href="#"><i class="fa-brands fa-youtube"></i></a></li>
												<li><a class="dribbble" href="#"><i class="fa-brands fa-instagram"></i></a></li>
											</ul>
										</div>
									</div>
								</div>
							</div>

                    </div>
                </div>
            </div>
        </div>
        <!-- ****** Quick View Modal Area End ****** -->

        <section class="you_may_like_area clearfix">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section_heading text-center">
                            <h2>related Products</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="you_make_like_slider owl-carousel">

                            <!-- Single gallery Item -->
                            <div class="single_gallery_item">
                                <!-- Product Image -->
                                <div class="product-img">
                                    <img style="height:400px;" src="watch.jpg" alt="">
                                    <div class="product-quicview">
                                        <a href="#" data-toggle="modal" data-target="#quickview"><i class="ti-plus"></i></a>
                                    </div>
                                </div>
                                <!-- Product Description -->
                                <div class="product-description">
                                    <h4 class="product-price">$39.90</h4>
                                    <p>Jeans midi cocktail dress</p>
                                    <!-- Add to Cart -->
                                    <a href="#" class="add-to-cart-btn">ADD TO CART</a>
                                </div>
                            </div>

                            <!-- Single gallery Item -->
                            <div class="single_gallery_item">
                                <!-- Product Image -->
                                <div class="product-img">
                                    <img style="height:400px;" src="perfumetwo.jpg" alt="">
                                    <div class="product-quicview">
                                        <a href="#" data-toggle="modal" data-target="#quickview"><i class="ti-plus"></i></a>
                                    </div>
                                </div>
                                <!-- Product Description -->
                                <div class="product-description">
                                    <h4 class="product-price">$39.90</h4>
                                    <p>Jeans midi cocktail dress</p>
                                    <!-- Add to Cart -->
                                    <a href="#" class="add-to-cart-btn">ADD TO CART</a>
                                </div>
                            </div>

                            <!-- Single gallery Item -->
                            <div class="single_gallery_item">
                                <!-- Product Image -->
                                <div class="product-img">
                                    <img style="height:400px;" src="perfumethree.jpg" alt="">
                                    <div class="product-quicview">
                                        <a href="#" data-toggle="modal" data-target="#quickview"><i class="ti-plus"></i></a>
                                    </div>
                                </div>
                                <!-- Product Description -->
                                <div class="product-description">
                                    <h4 class="product-price">$39.90</h4>
                                    <p>Jeans midi cocktail dress</p>
                                    <!-- Add to Cart -->
                                    <a href="#" class="add-to-cart-btn">ADD TO CART</a>
                                </div>
                            </div>

                            <!-- Single gallery Item -->
                            <div class="single_gallery_item">
                                <!-- Product Image -->
                                <div class="product-img">
                                    <img style="height:400px;" src="perfumefive.jpg" alt="">
                                    <div class="product-quicview">
                                        <a href="#" data-toggle="modal" data-target="#quickview"><i class="ti-plus"></i></a>
                                    </div>
                                </div>
                                <!-- Product Description -->
                                <div class="product-description">
                                    <h4 class="product-price">$39.90</h4>
                                    <p>Jeans midi cocktail dress</p>
                                    <!-- Add to Cart -->
                                    <a href="#" class="add-to-cart-btn">ADD TO CART</a>
                                </div>
                            </div>

                            <!-- Single gallery Item -->
                            <div class="single_gallery_item">
                                <!-- Product Image -->
                                <div class="product-img">
                                    <img style="height:400px;" src="perfumefour.jpg" alt="">
                                    <div class="product-quicview">
                                        <a href="#" data-toggle="modal" data-target="#quickview"><i class="ti-plus"></i></a>
                                    </div>
                                </div>
                                <!-- Product Description -->
                                <div class="product-description">
                                    <h4 class="product-price">$39.90</h4>
                                    <p>Jeans midi cocktail dress</p>
                                    <!-- Add to Cart -->
                                    <a href="#" class="add-to-cart-btn">ADD TO CART</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

   <div class="productinformation">
   <div class="section_heading text-center">
         <h2>Product Information</h2>
    </div>
   <div class="tecnical">
    <h3 class="tecnicalnh3">Technical Details</h3>
    <div class="container">
        <div class="row">
          <div class="col-md-8">
          <table class="table" id="informationtable">
 <tbody>
   <tr>
    
     <td>Material Type</td>
     <td>Plastic</td>
    
   </tr>
   <tr>
  
     <td>Included Components</td>
     <td>Plastic</td>
     
   </tr>
   <tr>

     <td>Batteries Included?</td>
     <td>no</td>
     
   </tr>

   <tr>

     <td>Brand</td>
     <td>Generic</td>
     
   </tr>
    <tr>

     <td>Department</td>
     <td>Unisex</td>
     
   </tr>
    <tr>

     <td>Manufacturer</td>
     <td>Other</td>
     
   </tr>
    <tr>

     <td>Product Dimensions</td>
     <td>12 x 12 x 12 cm; 140 Grams</td>
     
   </tr>
   
 </tbody>

 
 </table>
 </div>
    <div class="col-md-4">
    <img src="lunchbox3.jpg" alt="">
 </div>
   </div>
   </div>


        <?php

include('connection.php');

$sqlquery = "SELECT * FROM `tblcomment`";
$result = mysqli_query($connection,$sqlquery);
if(mysqli_num_rows($result) > 0)
{
?>
        <section class="blog-single section">
			<div class="container">
				<div class="row">
					<div class="col-lg-8 col-12">
						<div class="blog-single-main">
							<div class="row">
								<div class="col-12">
									<div class="comments">
										<h3 class="comment-title">Comments</h3>
										<!-- Single Comment -->
										<div class="single-comment">
										<?php
										while($row = mysqli_fetch_assoc($result)){ ?>		
											<img src="user.png" alt="#">
											<div class="content">							
											<h4><?php echo $row['name']; ?></h4>
												<p><?php echo $row['message']; ?></p>
												<?php } ?>
											</div>
										</div>
									  </div>
									</div>									
								</div>
									<!-- End Single Comment -->											
								<div class="col-12">			
									<div class="reply">
										<div class="reply-head">
											<h2 class="reply-title">Leave a Comment</h2>
											<!-- Comment Form -->
											<form class="form" action="comment.php" method="post">
												<div class="row">
													<div class="col-lg-6 col-md-6 col-12">
														<div class="form-group">
															<label>Your Name<span>*</span></label>
															<input type="text" name="name" placeholder="" required="required">
														</div>
													</div>
													<div class="col-lg-6 col-md-6 col-12">
														<div class="form-group">
															<label>Your Email<span>*</span></label>
															<input type="email" name="email" placeholder="" required="required">
														</div>
													</div>
													<div class="col-12">
														<div class="form-group">
															<label>Your Message<span>*</span></label>
															<textarea name="message" placeholder=""></textarea>
														</div>
													</div>
													<div class="col-12">
														<div class="form-group button">
															<button type="submit" name="combtn" class="btn">Post comment</button>
														</div>
													</div>
												</div>
											</form>
											<?php } ?>
											<!-- End Comment Form -->
										</div>
									</div>			
								</div>			
							</div>
						</div>
					</div>
                                        </section>
        <!-- <<<<<<<<<<<<<<<<<<<< Single Product Details Area End >>>>>>>>>>>>>>>>>>>>>>>>> -->

       
        
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
								<a href="index.php"><img src="images/logo2.png" alt="#"></a>
							</div>
							<p class="text">Praesent dapibus, neque id cursus ucibus, tortor neque egestas augue,  magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus.</p>
							<p class="call">Got Question? Call us 24/7<span><a href="tel:123456789">+0123 456 789</a></span></p>
						</div>
						<!-- End Single Widget -->
					</div>
					<div class="col-lg-2 col-md-6 col-12">
						<!-- Single Widget -->
						<div class="single-footer links">
							<h4>Information</h4>
							<ul>
								<li><a href="index.php">Home</a></li>
								<li><a href="shop.php">Shop</a></li>
								<li><a href="blog.php">Blog</a></li>
								<li><a href="contact.php">Contact Us</a></li>
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
									<li>012 United Kingdom.</li>
									<li>info@eshop.com</li>
									<li>+032 3456 7890</li>
								</ul>
							</div>
							<!-- End Single Widget -->
							<ul>
								<li><a href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
								<li><a href="#"><i class="fa-brands fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa-brands fa-google"></i></a></li>
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
							<!--To translate the page into any language, provided by Google-->
		                      <div class="language" id="google_translate_element"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer>

	<!-- /End Footer Area -->
    <script src="productdetailjs/jquery/jquery-2.2.4.min.js"></script>
    <!-- Popper js -->
    <script src="productdetailjs/popper.min.js"></script>
    <!-- Bootstrap js -->
    <script src="productdetailjs/bootstrap.min.js"></script>
    <!-- Plugins js -->
    <script src="productdetailjs/plugins.js"></script>
    <!-- Active js -->
    <script src="productdetailjs/active.js"></script>
	
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
	<!-- Fancybox JS -->
	<script src="js/facnybox.min.js"></script>
	<!-- Waypoints JS -->
	<script src="js/waypoints.min.js"></script>
	<!-- Countdown JS -->
	<script src="js/finalcountdown.min.js"></script>
	<!-- Nice Select JS -->
	<script src="js/nicesellect.js"></script>
	<!-- Ytplayer JS -->
	<script src="js/ytplayer.min.js"></script>
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
<script>
    function google_translate_elementInit(){
    new google.translate.TranslateElement({ pageLanguage: 'en'}, 'google_translate_element');
    }
</script>
<script src="//translate.google.com/translate_a/element.js?cb=google_translate_elementInit"> </script>
</body>
</html>