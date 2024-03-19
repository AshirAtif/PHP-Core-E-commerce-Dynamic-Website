<?php

include('connection.php');

if(isset($_REQUEST['submitbtn'])){
$name = $_REQUEST['name'];
$email = $_REQUEST['email'];
$subject = $_REQUEST['subject'];
$message = $_REQUEST['message'];
$phone = $_REQUEST['phone'];

 $contactsqlquery = "INSERT INTO `tblwebcontact`(`name`, `email`, `subject`, `message`, `phone`) VALUES ('{$name}','{$email}','{$subject}','{$message}','{$phone}')";
 $result = mysqli_query($connection,$contactsqlquery);


 echo("
 Message successfully sent!
 
 ");
 
    header("location: contact.php");

mysqli_close($connection);
}
?>


