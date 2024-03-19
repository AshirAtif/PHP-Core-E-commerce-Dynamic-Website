<?php
include('connection.php');

error_reporting(0);
 
$msg = "";
 
// If upload button is clicked ...
if (isset($_POST['upload'])) {
    $name = $_POST["name"];
    $code = $_POST["code"];
    $price = $_POST["price"];
    $image = $_FILES["uploadfile"]["name"];
    $tempname = $_FILES["uploadfile"]["tmp_name"];
    $folder = "./image/" . $filename;
    $hover = $_FILES["hoverfile"]["name"];
    $tempname = $_FILES["hoverfile"]["tmp_name"];
    $hfolder = "./image/" . $filename;
    // Get all the submitted data from the form
    $query = "INSERT INTO `tblamazon`(`name`, `code`, `image`, `hover`, `price`) VALUES ('{$name}','{$code}','{$image}','{$hover}','{$price}')";
 
    // Execute query
    $result = mysqli_query($connection,$query);
 
    // Now let's move the uploaded image into the folder: image
    if (move_uploaded_file($tempname, $folder)) {
        echo "<h3>  Image uploaded successfully!</h3>";

    } 
    else {
        echo "<h3>  Failed to upload image!</h3>";
    }
    header("location: amazonproduct.php");
}
?>