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
<?php
include('connection.php');
if(isset($_POST['value'])){
    $input = $_POST['value'];
    $searchquery = "SELECT * FROM `tblproduct` WHERE name Like '%$input%'";
    $result = mysqli_query($connection,$searchquery);
    if(mysqli_num_rows($result) > 0){
      while($row = mysqli_fetch_assoc($result))
      { ?>

                    <div class="col-lg-4 col-md-6 col-12">
							<form method="post" action="cart.php?action=add&code=<?php echo $product_array[$key]["code"]; ?>">
								<div class="single-product">
									<div class="product-img">
										<a href="#">
											<img class="default-img" style="width:300px; height:250px;" src="<?php echo $row['image'] ?>" alt="#">
											<img class="hover-img" style="width:300px; height:250px;" src="<?php echo $row['hover'] ?>" alt="#">
										</a>
										<div class="button-head">
											<div class="product-action-2">
											<a title="Add to cart" href="checkout.php"><input type="submit" class="btn" value="Buy Now"></a>
											<a title="Add to cart" href="cart.php" style="margin-left: 40px;"><input type="submit" class="btn" value="Add to cart "></a>
											</div>
										</div>
									</div>
									<div class="product-content">
										<h3><a href="product.php"><?php echo $row['name'] ?></a></h3>
										<div class="cart-action"><input type="number" class="product-quantity" name="quantity" value="1"/></div>
										<div class="product-price">
											<span><?php echo "AED".$row['price'] ?></span>
										</div>
									</div>
								</div>
							</form>
					</div>

<?php }}} ?>