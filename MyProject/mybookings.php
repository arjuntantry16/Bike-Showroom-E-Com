<?php 
    include_once 'header.php';
    if(isset($_SESSION['username'])){
    $username = $_SESSION['username'];
?>
<html>
    <head>
        <link rel="stylesheet" href="cssfiles/mybookings.css">
    </head>
    <body>
        <div class="mybookings-container">
            <div class="mybookings-wrapper">
                <div class="mybookings-header-wrapper">
                    <h2 id="mybookings-header">My Bookings</h2>
                </div>
                <div class="bookings-container">
                    <div class="bookings-wrapper">
                        <?php
                            $sql2 = "select * from booking where clientusername='$username';";
                            $result2 = mysqli_query($conn,$sql2);
                            if(mysqli_num_rows($result2)>0){
                                while($row3=mysqli_fetch_assoc($result2)){
                                    if($row3['bookingstatus'] === "a" || $row3['bookingstatus'] === "s"){
                                        $bookingid = $row3['bookingid'];
                                        $bikeid3 = $row3['bikeid'];
                                        $sql4 = "select * from stock where bikeid='$bikeid3';";
                                        $result4=mysqli_query($conn,$sql4);
                                        if(mysqli_num_rows($result4)>0){
                                            $row4=mysqli_fetch_assoc($result4);
                                            echo "
                                            <div class='bike-info-container1'>
                                                <div class='bookingno-wrapper'>
                                                    BookingNo.:- ".$row3['bookingid']."
                                                </div>";
                                                $bdate=$row3['bookingdate'];
                                                $sqlsalesinfo = "select * from booking where bookingid='$bookingid';";
                                                $resultinfo = mysqli_query($conn,$sqlsalesinfo);
                                                if(mysqli_num_rows($resultinfo)>0){
                                                    $rowsalesinfo = mysqli_fetch_assoc($resultinfo);
                                                    $status = $rowsalesinfo['bookingstatus'];
                                                    if($status === "a" && $row3['bookingst'] !== "deactive"){ 
                                                        $duedate1 = date('Y-m-d',strtotime($bdate.' + 54 days'));
                                                        $timestamp5 = strtotime($duedate1);
                                                        $duedate = date("d-m-Y",$timestamp5);
                                                       echo "<p id='duedate'>*Final Payment Due Date: ".$duedate."</p>";
                                                    }elseif($row3['bookingst'] === "deactive"){
                                                        echo "<p id='duedate'>*Final Payment Due Date Exceeded!Please Place Your Booking Again!<br>Contact Us FAQ</p>";
                                                    }
                                                }
                                                echo "<div class='bike-image-container1'>
                                                        <a href='selectedbike.php?bikeid=".$row4['bikeid']."&pagename=cart' id='selected-a1'>
                                                        <hr id='hr31'><div class='bike-image-wrapper1'>
                                                        <img src='productimages/".$row4['bikeimage1']."' alt='bike-image' id='image1'>
                                                    </div></a>
                                            </div>
                                            <div class='bike-info1'>
                                                <div class='name-container1'>
                                                    <p id='bikename1'>".strtoupper($row4['bikename'])."</p>
                                                </div>
                                                <div class='price-specs-container1'>
                                                    <div class='price-container1'>
                                                        <p id='ex-showroom1'>Avg. Ex-Showroom Price</p>
                                                        <span id='rupee-sign1'><i class='fas fa-rupee-sign' aria-hidden='true'></i></span>
                                                        <span id='price1'>".$row4['bikeprice']."<span id='onwards1'> onwards</span></span>
                                                            
                                                        </a>
                                                        </div><hr id='hr21'>
                                                        <div class='specs-container1'>
                                                            <p id='key-specs1'>Key Specs</p>
                                                            <div class='specs-wrapper1'>
                                                                <span id='bikespecs1'>".$row4['bikeengine']."cc</span>
                                                                <span id='bikespecs1'>".$row4['bikepower']."</span>
                                                                <span id='bikespecs1'>".$row4['bikemileage']."</span>
                                                            </div>";
        
                                                            $sqlsalesinfo1 = "select * from booking where bookingid='$bookingid';";
                                                            $resultinfo1 = mysqli_query($conn,$sqlsalesinfo1);
                                                            if(mysqli_num_rows($resultinfo1)>0){
                                                                $rowsalesinfo1 = mysqli_fetch_assoc($resultinfo1);
                                                                $status1 = $rowsalesinfo1['bookingstatus'];
                                                                if($status1 === "a" && $row3['bookingst'] !== "deactive"){ 
                                                                    echo "<div class='final-payment-btn-wrapper'><a href='invoice.php?bookingid=".$bookingid."&bikeid=".$row4['bikeid']."&pagename=cart' id='remove-a1'>
                                                                    <div class='final-payment-btn'>Proceed For Full Payment</div>
                                                                    </a></div>";
                                                                }
                                                            }
                                                    echo "</div>
                                                </div>
                                                
                                            </div>";
                                    echo "</div>
                                    <div class='status-container'>
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
                                        ";
                                        echo "<div class='estimated-delivery-status-wrapper'>Estimated Delivery Date";
                                            $estdate1 = date('Y-m-d',strtotime($bdate.' + 60 days'));
                                            $timestamp=strtotime($estdate1);
                                            $estdate=date("d-m-Y",$timestamp);
                                            echo "<p id='estimated'>$estdate</p>";
                                        echo "</div>";
                                        
                                echo "<div class='delivery-status-wrapper'>Delivery Status";
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
                                    }elseif($row3['bookingst'] === "deactive"){
                                        echo "<div class='payment-status-wrapper'>Booking Status
                                            <div id='payment-status'>";
                                                echo "<p id='estimatedred'>Cancelled!</p>";
                                                 echo "</div>
                                            </div>
                                            </div>";
                                    }
                            echo "</div>
                                </div>
                                </div>
                                ";}
                            }else{
                                echo "<p class'no-results'>No Bookings</p>";
                            }
                                }
                            }else {
                                    echo "<p class='no-results'>No Bookings</p>";
                                }
            }else{
                header("Location:login.php");
            }
                        ?>
                        
                    </div>
                </div>
            </div>
        </div>
        
    </body>
    <?php
        include_once 'footer.php';
        ?>
</html>