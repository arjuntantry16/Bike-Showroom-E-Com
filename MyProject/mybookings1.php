<?php
    include_once 'includes/dbh.inc.php';
    include 'header.php';
    if(isset($_SESSION['username'])){
        $username = $_SESSION['username'];
    }
?>
<html>
    <head>
        <link rel="stylesheet" href="cssfiles/mybookings1.css">
        <link rel="stylesheet" href="cssfiles/cart.css">
    </head>

    <body>
        <div class="mybookings-container">
            <div class="mybookings-wrapper">
                <div class="header-mybookings">
                    <h1 id="mybookings-header">
                        My Bookings
                    </h1>
                </div>
                <?php
                    if(isset($_SESSION['username'])){
                    $sql = "select * from booking where clientusername='$username';";
                    $result = mysqli_query($conn,$sql);
                    if(mysqli_num_rows($result) > 0){
                        while($row=mysqli_fetch_assoc($result)){
                            $bookingid=$row['bookingid'];
                            $bikeid = $row['bikeid'];
                            $query = "select * from stock where bikeid='$bikeid';";
                            $res = mysqli_query($conn,$query);
                            $row2 = mysqli_fetch_assoc($res);
                        echo "<div class='bike-info-container'>
                                    <div class='bike-image-container'><a href='selectedbike.php?bikeid=".$row2['bikeid']."&pagename=cart' id='selected-a'>
                                        <hr id='hr3'><div class='bike-image-wrapper'>
                                            <img src='productimages/".$row2['bikeimage1']."' alt='bike-image' id='image'>
                                        </div></a>
                                    </div>
                                    <div class='bike-info'>
                                        <div class='name-container'>
                                           <p id='bikename'>".strtoupper($row2['bikename'])."</p>
                                        </div>
                                        <div class='price-specs-container'>
                                            <div class='price-container'>
                                                <p id='ex-showroom'>Avg. Ex-Showroom Price</p>
                                                <span id='rupee-sign'><i class='fas fa-rupee-sign' aria-hidden='true'></i></span>
                                                <span id='price'>".$row2['bikeprice']."<span id='onwards'> onwards</span></span>
                                                    <div class='book-now-button-wrapper'><a href='advanceinvoice.php?bikeid=".$row2['bikeid']."&pagename=cart' id='book-a'>
                                                        <span id='book-now-symbol'><i class='fas fa-book'></i></span>   
                                                        <span id='book-now'>Book Now</span>                              
                                                    </div>
                                                </a>
                                            </div><hr id='hr2'>
                                            <div class='specs-container'>
                                                <p id='key-specs'>Key Specs</p>
                                                <div class='specs-wrapper'>
                                                        <span id='bikespecs'>".$row2['bikeengine']."cc</span>
                                                        <span id='bikespecs'>".$row2['bikepower']."</span>
                                                        <span id='bikespecs'>".$row2['bikemileage']."</span>
                                                </div>

                                                <div class='remove-cart-btn-wrapper'><a href='includes/remove-from-cart.inc.php?bikeid=".$row2['bikeid']."&pagename=cart' id='remove-a'>
                                                    <div class='remove-cart-btn'><i class='fas fa-shopping-cart'></i>Remove From Cart</div>
                                               </a></div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <hr id='hr3'>
                                </div>";
                               echo "<div class='status-container'>
                                                <div class='status-wrapper'>

                                                    ";$sqlbookings="select * from booking where bookingid='$bookingid';";
                                                    $resultbooking=mysqli_query($conn,$sqlbookings);
                                                    $row3=mysqli_fetch_assoc($resultbooking);
                                                    if($row3['bookingst'] !== "deactive"){
                                                         echo "<div class='payment-status-wrapper'>Payment Status
                                                            <div id='payment-status'>";
                                                            if($row3['bookingstatus'] === "s"){
                                                                echo "<p id='paymentpaid'>Paid</p>";
                                                            }else{
                                                                echo "<p id='paymentpending'>Pending..";
                                                            }
                                                        echo "</div>
                                                    </div>
                                                    
                                                    <div class='estimated-delivery-status-wrapper'>Estimated Delivery Date";
                                                        $estdate1 = date('Y-m-d',strtotime($bdate.' + 60 days'));
                                                        $timestamp=strtotime($estdate1);
                                                        $estdate=date("d-m-Y",$timestamp);
                                                        echo "<p id='estimated'>$estdate</p>";
                                                        echo "</div>
                                                    <div class='delivery-status-wrapper'>Delivery Status";
                                                            $sqldel = "select * from sales where bookingid='$bookingid'";
                                                            $resultdel=mysqli_query($conn,$sqldel);
                                                            if(mysqli_num_rows($resultdel)>0){
                                                                $rowdel = mysqli_fetch_assoc($resultdel);
                                                                $deliverystatus=$rowdel['deliverystatus'];
                                                                if($deliverystatus === "y"){
                                                                    echo "<p id='delivery'>Delivered</p>";
                                                                }else{
                                                                    echo "<p id='deliverypending'>Pending..</p>";
                                                                }
                                                            }else{
                                                                echo "<p id='deliverypending'>Pending..</p>";
                                                            }
                                                    echo "</div>
                                                        ";}else{
                                                            echo "<div class='payment-status-wrapper'>Booking Status
                                                            <div id='payment-status'>";
                                                            $estdate1 = date('Y-m-d',strtotime($bdate.' + 60 days'));
                                                            $timestamp=strtotime($estdate1);
                                                            $estdate=date("d-m-Y",$timestamp);
                                                            $timestamp1 = strtotime($bdate);
                                                            $bdate1 = date("d-m-Y",$timestamp1);
                                                            if($bdate1 < $estdate){
                                                            echo "<p id='estimatedred'>Final Payment Date Expired!</p>";
                                                            }else{
                                                                echo "<p id='estimatedred'>Cancelled!</p>";
                                                            }
                                                        echo "</div>
                                                       "; }
                                                echo "</div>
                                        </div>";
                        }
                        }else {
                        echo "<p class='no-results'>No Bookings</p>$username";
                    }
                    }else {
                        header("Location:login.php");
                    }?>
            </div>
        </div>
        <?php 
            include_once 'footer.php';
        ?>
    </body>
</html>
