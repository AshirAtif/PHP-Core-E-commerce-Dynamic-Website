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
	
	<link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/4.5.6/css/ionicons.min.css">
		
	<!-- Eshop StyleSheet -->
	<link rel="stylesheet" href="css/reset.css">
	<link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/responsive.css">
	<link rel="stylesheet" href="slidercss/animate.css">
		<link rel="stylesheet" href="slidercss/style.css">

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
.laptop{
		width: 100%;
		height: 800px;
	    background-size: cover;
		background-repeat: no-repeat;
		background-position: center;
		background-clip: border-box;
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

	<section>
		<div class="main">
			<div class="circle">
        
			</div>
           <div class="container">
			<div class="header">
				<div class="row">
				<div class="col-md-5">
				   <h1 class="serviceh1">Our Services</h1>
				   <p class="servicep">Electronic commerce more well known as e-commerce consists of the buying or selling of products via electronic means such as the internet or other electronic services.</p>
          </div>
				
				<div class="col-md-7">
					<img class="coco" src="perfumecoco.jpg" alt="">
				</div>
				</div>
			</div>
		   </div>
		</div>
	</section>

	<div class="maindiv">
		<div class="container">
			<div class="row">
				<div class="col-md-3">
					<div class="shop-services spon">
					<div class="single-service">
                    <i class="fa-solid fa-rocket"></i>
						<h4>Free shiping</h4>
						<p>Orders over 100 AED</p>
					</div>
					</div>
				</div>
				<div class="col-md-3">
				<div class="shop-services spo">
				<div class="single-service">
					<i class="fa-solid fa-rotate-right"></i>
						<h4>Free Return</h4>
						<p>Within 30 days returns</p>
					</div>
							 </div>
				</div>
				<div class="col-md-3">
				<div class="shop-services spo">
				<div class="single-service">
					<i class="fa-solid fa-tag"></i>
						<h4>Best Peice</h4>
						<p>Guaranteed price</p>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="shop-services spo">
				<div class="single-service">
                    <i class="fa-solid fa-lock"></i>
						<h4>Sucure Payment</h4>
						<p>100% secure payment</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
	
<!--Section: FAQ-->
<section class="answers">
	<div class="container">
  <h3 class="text-center mb-4 pb-2 text-danger fw-bold" style="text-size:30px;">FAQ</h3>
  <p class="text-center mb-5">
    Find the answers for the most frequently asked questions below
  </p>

  <div class="row">
    <div class="col-md-6 col-lg-4 mb-4">
      <h6 class="mb-3 text-danger heading"><i class="far fa-paper-plane text-danger pe-2"></i> A simple
        question?</h6>
      <p class="text">
        <strong><u>Absolutely!</u></strong> We work with top payment companies which guarantees
        your
        safety and
        security. All billing information is stored on our payment processing partner.
      </p>
    </div>

    <div class="col-md-6 col-lg-4 mb-4">
      <h6 class="mb-3 text-danger heading"><i class="fas fa-pen-alt text-danger pe-2"></i> A question
        that
        is longer then the previous one?</h6>
      <p class="text">
        <strong><u>Yes, it is possible!</u></strong> You can cancel your subscription anytime in
        your
        account. Once the subscription is
        cancelled, you will not be charged next month.
      </p>
    </div>

    <div class="col-md-6 col-lg-4 mb-4">
      <h6 class="mb-3 text-danger heading"><i class="fas fa-user text-danger pe-2"></i> A simple
        question?
      </h6>
      <p class="text">
        Currently, we only offer monthly subscription. You can upgrade or cancel your monthly
        account at any time with no further obligation.
      </p>
    </div>

    <div class="col-md-6 col-lg-4 mb-4">
      <h6 class="mb-3 text-danger heading"><i class="fas fa-rocket text-danger pe-2"></i> A simple
        question?
      </h6>
      <p class="text">
        Yes. Go to the billing section of your dashboard and update your payment information.
      </p>
    </div>

    <div class="col-md-6 col-lg-4 mb-4">
      <h6 class="mb-3 text-danger heading"><i class="fas fa-home text-danger pe-2"></i> A simple
        question?
      </h6>
      <p class="text"><strong><u>Unfortunately no</u>.</strong> We do not issue full or partial refunds for any
        reason.</p>
    </div>

    <div class="col-md-6 col-lg-4 mb-4">
      <h6 class="mb-3 text-danger heading"><i class="fas fa-book-open text-danger pe-2"></i> Another
        question that is longer than usual</h6>
      <p class="text">
        Of course! We’re happy to offer a free plan to anyone who wants to try our service.
      </p>
    </div>
  </div>
  </div>
</section>
<!--Section: FAQ-->
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
	

	<script src="sliderjs/jquery.min.js"></script>
    <script src="sliderjs/popper.js"></script>
    <script src="sliderjs/bootstrap.min.js"></script>
    <script src="sliderjs/owl.carousel.min.js"></script>
    <script src="sliderjs/main.js"></script>
	<script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
</body>
</html>