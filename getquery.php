<?php
include('connection.php');

 // SQL QUERY
 $query = "SELECT `name`, `email`, `password`, `cpassword` FROM `tblregisterdb` WHERE 1;";
 // FETCHING DATA FROM DATABASE
 $result = mysqli_query($connection,$query);
 
 if (mysqli_num_rows($result) > 0) {
     // OUTPUT DATA OF EACH ROW
     while($row = mysqli_fetch_assoc($result)) {
         echo "Email: " . $Email["email"]
         . " - Password: " . $Password["password"]. "<br>";
     }
 } else {
     echo "0 results";
 }

 mysqli_close($connection);



    header("location: index.php");
?>