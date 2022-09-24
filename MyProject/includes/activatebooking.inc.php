<?php 
    include_once 'dbh.inc.php';
    $bikeid=$_GET['bikeid'];
    $bookingid=$_GET['bookingid'];
    $sql = "select * from stock where bikeid='$bikeid';";
    $result = mysqli_query($conn,$sql);
    $rowqty = mysqli_fetch_assoc($result);
    $qty = $rowqty['bikeqty'];
    if($qty === '0'){
        header("location:../adminbookings.php?bikeqty=0");
        exit();
    }
    elseif($qty !== '0'){
        $qty = $qty - 1;
        $stockupdate = "update stock set bikeqty=$qty where bikeid=$bikeid;";
        mysqli_query($conn,$stockupdate); 
        $updatebooking = "update booking set bookingst='active' where bookingid='$bookingid';";
        mysqli_query($conn,$updatebooking);
        header("location:../adminbookings.php?update=activated");
        exit();  
    }
    ?>
