<?php 
include_once 'dbh.inc.php';
$bookingid = $_GET['bookingid'];
$sql = "delete from booking where bookingid='$bookingid';";
mysqli_query($conn,$sql);
header("location:../adminbookingsdelete.php?delete=success");
exit(); 