<?php 
    include_once 'dbh.inc.php';
    $bikeid=$_GET['bikeid'];
    $bookingid=$_GET['bookingid'];
    $sql = "select * from stock where bikeid='$bikeid';";
    $result = mysqli_query($conn,$sql);
    $rowqty = mysqli_fetch_assoc($result);
    $qty = $rowqty['bikeqty'];
        $qty = $qty + 1;
        $stockupdate = "update stock set bikeqty='$qty' where bikeid='$bikeid';";
        mysqli_query($conn,$stockupdate); 
        $updatebooking = "update booking set bookingst='deactive' where bookingid='$bookingid';";
        mysqli_query($conn,$updatebooking);
        header("location:../adminbookings.php?update=deactivated");
        exit(); 
    ?>
