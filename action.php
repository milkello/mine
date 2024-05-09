<?php

include "config/db.php";

if(isset($_POST['submit'])){
$username = $_POST['username'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$position = $_POST['position'];
$gender = $_POST['gender'];
$pd = 12345678;

$sql =  mysqli_query($conn, "INSERT INTO users(username, password, fname, lname, gender, position) VALUES ( '$username', '$pd', '$fname', '$lname', '$gender', '$position')");
if($position == 'Administrator'){
    echo "
    <script>alert('Admin added successfully!')</script>
    <script>window.location = 'index.php?dashboard'</script>
    ";
}
elseif($position == 'teacher'){
    echo "
    <script>alert('teacher added successfully!')</script>
    <script>window.location = 'index.php?dashboard'</script>
    ";
}
//else{
   // echo "
   // <script>alert('New user added successfully!')</script>
   // <script>window.location = 'index.php?dashboard'</script>
   // ";
}
//}
?>