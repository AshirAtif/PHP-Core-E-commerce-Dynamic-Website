<?php

include('connection.php');

if(isset($_REQUEST['profilebtn'])){
$name = $_REQUEST['name'];
$sname = $_REQUEST['sname'];
$email = $_REQUEST['email'];
$num = $_REQUEST['number'];
$address = $_REQUEST['address'];


 $profilesqlquery = "INSERT INTO `tblprofile`(`name`, `sname`, `number`, `address`, `email`)  VALUES ('{$name}','{$sname}','{$num}','{$address}','{$email}')";
 $result = mysqli_query($connection,$profilesqlquery);

 
    header("location: profile.php");

mysqli_close($connection);
}
?>


