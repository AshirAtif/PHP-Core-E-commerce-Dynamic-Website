<?php
include('connection.php');

if(isset($_REQUEST['loginbtn'])){
  $Name = $_REQUEST['name'];
  $Email = $_REQUEST['email'];
  $Password = $_REQUEST['password'];
  $CPassword = $_REQUEST['cpassword'];


  $sqlquery = "INSERT INTO `tblregisterdb`(`name`, `email`, `password`, `cpassword`) VALUES ('{$Name}','{$Email}','{$Password}','{$CPassword}')";
  $result = mysqli_query($connection,$sqlquery);
  mysqli_close($connection);

 
  header("location: login.php");

}
?>
