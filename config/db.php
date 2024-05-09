<?php
   $conn = mysqli_connect("localhost", "root", "","reg");
   if($conn == false){
    die("Connection Error".mysqli_connect_error());
   }
?>