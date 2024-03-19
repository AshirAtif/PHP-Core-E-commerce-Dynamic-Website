<?php

include('connection.php');

if(isset($_REQUEST['combtn'])){
$name = $_REQUEST['name'];
$email = $_REQUEST['email'];
$message = $_REQUEST['message'];

 $contactsqlquery = "INSERT INTO `tblcomment`(`name`, `email`, `message`) VALUES ('{$name}','{$email}','{$message}')";
 $result = mysqli_query($connection,$contactsqlquery);


 echo("
 Message successfully sent!
 
 ");

 mysqli_close($connection);

 header("location: shop.php");


}
?>