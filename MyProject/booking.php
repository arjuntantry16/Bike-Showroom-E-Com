<?php
    include_once 'includes/dbh.inc.php';
    include_once 'header.php';
    $bikeid=$_GET['bikeid'];
    $prevpage = $_GET['pagename'];
    $advanceprice=$_GET['ap'];
    $_SESSION['bikeid']=$bikeid;
    $_SESSION['pagename'] = $prevpage;
    $_SESSION['ap']=$advanceprice;
?>

<html>
    <head>
        <link rel="stylesheet" href="cssfiles/booking.css">
        <script src="https://kit.fontawesome.com/9edcdd8d08.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <div class='booking-container'>
            <?php
                if(isset($_GET['error'])){
                    $errormsg=$_GET['error'];
                    if($errormsg === 'emptyfields'){
                        echo "<div class='error-container-emptyfields'><p id='emptyfields'>Enter All Fields</p></div>";
                    }elseif($errormsg === 'nomethodselected'){
                        echo "<div class='error-container-nomethodselected'><p id='nomethodselected'>Select a Payment Method</p></div>";
                    }
                }
                if(isset($_GET['error'])){
                    $errormsg=$_GET['error'];
                    if($errormsg === 'accnonotaccurate'){
                        echo "<div class='error-container-emptyfields'><p id='emptyfields'>Account Number Not Accurate!</p></div>";
                    }
                }
            ?>
            <div class='booking-wrapper'>
                <div class='heading-wrapper'>
                    <h2 id='heading'>Advance Payment</h2>
                </div><?php
                 $sql ="select * from stock where bikeid='$bikeid';";
                 $result=mysqli_query($conn,$sql);
                 if(mysqli_num_rows($result)>0){
                     while($rows=mysqli_fetch_assoc($result)){
               echo "<div class='bike-image-wrapper'>
                    <img src='productimages/".$rows['bikeimage1']."' alt='' id='img'>
                </div>
                <div class='bike-info-wrapper'>
                    <ul>";
                       echo "<p id='stock'>In stock</p>
                        <p id='name'>".strtoupper($rows['bikename'])."</p>
                        <li id='item'><span id='qty-quantity'>Quantity:</span>
                        <span id='qty'>1</span></li><br>";
                        $sql2 = "select * from taxrates;";
                        $result2 = mysqli_query($conn,$sql2);
                        $row2=mysqli_fetch_assoc($result2);
                        $bikeenginevalue = $rows['bikeengine'];
                        $price=$rows['bikeprice'];
                        $bikeprice = str_replace(",","",$price);
                        if($bikeenginevalue >= 350){
                            $advanceamt = $row2['greaterthan350cc']/100 * $bikeprice; 
                        }else{
                            $advanceamt = $row2['lessthan350cc']/100 * $bikeprice;
                        }
                       echo "<li id='item'><span id='price-price'>Advance Pay Price:</span>
                        <span id='price'><i class='fas fa-rupee-sign' aria-hidden='true'>".$advanceprice."</i>";
                        }
                    }
                        ?></span></li>
                    </ul>
                </div>
                <div class='payment-methods-container'>
                    <div class='payment-methods'>
                    <p id='payment-methods'>PAYMENT METHODS</p> 
                    <p id='payment-methods-text'><strong>Please select any one method of payment</strong></p>
                        <form id='form1' action='includes/booking.inc.php' method='post'>
                            <!-- cheque -->
                            <input type='radio' name='radio' id='cheque' value='cheque'>CHEQUE<br>
                            <label id='acctholderlabel'>Account Holder Name:</label>
                            <input type='text' name='accholderinput' placeholder='Enter Account Holder Name' id='accholdername'><br>
                            <label id='branchlabel'>Branch Name:</label>
                            <input type='text' name='branchinput' placeholder='Enter Branch Name' id='branchname'><br>
                            <label id='bankaccnolabel'>Bank Account Number:</label>
                            <input type='text' name='bankaccountnoinput' placeholder='Enter Account Number' id='bankaccno'><br><hr><br>
                            <!-- neft -->
                            <input type='radio' name='radio' id='neft' value='neft'>NEFT<br>
                            <label id='acctholderlabel'>Account Holder Name:</label>
                            <input type='text' name='accholderinput1' placeholder='Enter Account Holder Name' id='accholdername'><br>
                            <label id='branchlabel'>Branch Name:</label>
                            <input type='text' name='branchinput1' placeholder='Enter Branch Name' id='branchname'><br>
                            <label id='bankaccnolabel'>Bank Account Number:</label>
                            <input type='text' name='bankaccountnoinput1' placeholder='Enter Account Number' id='bankaccno'><br><hr><br>
                            <button type='submit' name='payment-btn' id='payment-btn'>CONFIRM</button>
                        </form>
                        <div id='companybank-info-wrapper'>
                            <p id='note'><strong>IMPORTANT:Please make your cheque/NEFT payable to <?php 
                        $sqlcompany="select * from companydetails";
                            $resultcompany = mysqli_query($conn,$sqlcompany);
                            $rows1 = mysqli_fetch_assoc($resultcompany);
                            echo $rows1['companyname'];?></strong><br>
                            <strong>-Bank Details:-</strong><br>
                            <strong>-Bank Name:<?php echo $rows1['companybankname'];?><br>
                            -Bank Account Name:<?php echo $rows1['companyname'];?><br>
                            -Bank IFSC Code:<?php echo $rows1['companyifsccode'];?><br>
                            -Bank Branch:<?php echo $rows1['companybranchname'];?><br>
                            -Bank Account Number:<?php echo $rows1['companybankaccno'];?><br></strong>
                    
                            -Your booking will be confirmed once we get the amount through cheque or NEFT.<br>
                            -The Bike will be added into your <strong>Bookings Section</strong> where you can proceed to make the final payment and the amount has to be paid before a week of your bikes delivery.<br>
                        -     Once the booking is confirmed and in any case of cancellation of the booking required please send an email to 
                        <?php echo $rows1['companyemail'];?>,but the advance amount will <strong>not</strong> be <strong>refunded</strong> due to the companies policies.
                        <br><strong>For any queries send an email to <?php echo $rows1['companyemail'];?></strong>
                        </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
            include_once 'footer.php';
        ?>
    </body>
</html> 

