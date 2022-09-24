<?php
include "includes/dbh.inc.php";
$date =date("Y-m-d");

$sql = "select * from booking;";
$result =mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc(($result));
$bdate=$row['bookingdate'];
#echo $bdate;
$newdate = date("Y-m-d",strtotime($bdate));
echo $newdate;