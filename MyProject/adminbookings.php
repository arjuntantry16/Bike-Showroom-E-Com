<?php 
    include_once 'includes/dbh.inc.php';
    include_once 'header.php';
    if(isset($_GET['bikeqty'])){
        $qty = $_GET['bikeqty'];
        if($qty === '0'){
            echo "<div class='cart-info-wrapper1 considered-info-wrapper'><p id='considered-info'>Bike Quantity Is Zero!<br></p>
                        
                            <br><div id='ok'>OK</div></div>";
        }
    }
    if(isset($_GET['update'])){
        $errormsg=$_GET['update'];
        if($errormsg === "activated"){
            echo "<div class='error-container'><p id='emptyfields'>*Activated</p></div>";
        }elseif($errormsg === "deactivated"){
            echo "<div class='error-container'><p id='emptyfields'>*Deactivated</p></div>";
        }
    }
?>

<html>
    <head>
        <link rel="stylesheet" href="cssfiles/adminbookings.css">
    </head>
    <body>
        <div class="admin-panel-container">
            <div class="left-panel-container">
                <div class="left-panel-wrapper">
                    <div class="first-item-wrapper item-wrapper">
                        <div class="first-item">
                            Stock
                            <div class="drop-down-contents">
                                <a href="adminupdate.php" id="update-a"><div class="update">Update</div></a>
                                <a href="adminadd.php" id="add-a"><div class="add">Add Bikes</div></a>
                                <a href="admindelete.php" id="delete-a"><div class="delete">Delete</div></a>
                            </div>
                        </div>
                    </div>
                    <div class="second-item-wrapper item-wrapper">
                        <div class="second-item">
                            <a href="adminbookings.php" id="bookings-a">
                            <div class="bookings">Bookings
                            <div class="drop-down-contents1">
                                <a href="adminbookings.php" id="update-a1"><div class="update1">Update</div></a>
                                <a href="adminbookingsdelete.php" id="delete-a1"><div class="delete1">Delete</div></a>
                            </div>
                            </div></a>
                        </div>
                    </div>
                    <div class="third-item-wrapper item-wrapper">
                        <div class="third-item">
                            <a href="adminsales.php" id="sales-a">
                            <div class="sales">Sales
                            </div></a>
                        </div>
                    </div>
                    <div class="fourth-item-wrapper item-wrapper">
                        <div class="fourth-item">
                            <a href="clientinfo.php" id="client-a">
                            <div class="client-info">Client Info
                            </div></a>
                        </div>
                    </div>
                    <div class="fifth-item-wrapper item-wrapper">
                        <div class="fifth-item">
                            <a href="adminpasswordchange.php" id="change-password-a">
                            <div class="change-password-info">Change Password
                            </div></a>
                        </div>
                    </div>
                    <div class="sixth-item-wrapper item-wrapper">
                        <div class="sixth-item">
                        <a href="taxupdate.php" id="tax-a">
                            <div class="tax-update-info">Tax Update
                            </div></a>
                        </div>
                    </div>
                    <div class="seventh-item-wrapper item-wrapper">
                        <a href='adminaddsupplier.php' id='addsup-a'>
                        <div class="seventh-item">
                            <a href="adminaddsupplier.php" id="tax-a">
                            <div class="supplier-info">Supplier
                            </div></a>
                        </div>
                        <div class="drop-down-contents2">
                                <a href="adminaddsupplier.php" id="add-supplier-a"><div class="update">Add</div></a>
                                <a href="adminorder.php" id="order-a"><div class="add">Order/Update</div></a>
                        </div>
                    </div></a>
                </div>
            </div>
            <!--Right Container-->
            <div class="right-container">
                <div class="right-wrapper">
                    <div class="update-bookings-header-container">
                        <h2 id="update-bookings-header">Update Bookings</h2>
                    </div>
                    <div class="form-container">
                        <form id="form1" action="includes/bookingsupdate.inc.php" method="post">
                            <label id="label1">Select Booking ID:<label>
                                <select name="client" id="select-client">
                                    <?php
                                        $sql = "select * from booking;";
                                        $result = mysqli_query($conn,$sql);
                                        if(mysqli_num_rows($result)>0){
                                            while($row=mysqli_fetch_assoc($result)){
                                                echo "<option id='options' value='".$row['bookingid']."'>".strtoupper($row['bookingid'])."</option>";
                                            }
                                        }else { 
                                            echo "<p id='no-result'>No Results</p>";
                                        }
                                    ?>
                                </select>
                            <label>Select Booking Status:<label>
                                <select name="select-booking-status" id="select-booking-status">
                                    <option id="options" value="na">NOT ACTIVE(NA)</option>
                                    <option id="options" value="a">ACTIVE(A)</option>
                                    <option id="options" value="s">SOLD(S)</option>
                                </select>
                            <button type="submit" name="form1-submit" id="update-btn">UPDATE</button>
                        </form>
                    </div>
                    <div class="table-container">
                        <table id="bookings-table">
                            <tr>
                                <th>Booking ID</th>
                                <th>Client ID</th>
                                <th>Client Username</th>
                                <th>Bike ID</th>
                                <th>Client Bank Account No.</th>
                                <th>Advance Amount</th>
                                <th>Total Amount</th>
                                <th>Booking Status</th>
                                <th>Booking Date</th>
                                <th>Final Payment Due Date</th>
                                <th>Advance Payment Mode</th>
                            </tr>
                           <?php 
                           $sql2 = "select * from booking order by bookingid desc;";
                           $result2 = mysqli_query($conn,$sql2);
                           if(mysqli_num_rows($result2)>0){
                                while($row2=mysqli_fetch_assoc($result2)){
                           echo "<tr>
                                <td>".$row2['bookingid']."</td>
                                <td>".$row2['clientid']."</td>
                                <td>".strtoupper($row2['clientusername'])."</td>
                                <td>".$row2['bikeid']."</td>
                                <td>".$row2['clientbankaccno']."</td>
                                <td>".$row2['bikeadvanceprice']."</td>
                                <td>".$row2['bikeprice']."</td>
                                <td>".strtoupper($row2['bookingstatus'])."</td>
                                <td>";$bookdate=$row2['bookingdate'];
                                $newdate1 = date("Y-m-d",strtotime($bookdate));
                                $timestamp = strtotime($newdate1);
                                $newdate=date("d-m-Y",$timestamp);
                                echo "$newdate</td>
                                <td>"; $bookdate=$row2['bookingdate'];
                                $newdate1 = date('Y-m-d',strtotime($bookdate.' + 54 days'));
                                $timestamp = strtotime($newdate1);
                                $newdate=date("d-m-Y",$timestamp);
                                echo "$newdate</td>
                                <td>".strtoupper($row2['paymentmode'])."</td>
                                <td>";if($row2['bookingstatus'] !== "s"){
                                if($row2['bookingst'] === "active" || $row2['bookingst'] === "not-set"){
                                            echo "<a href='includes/deactivatebooking.inc.php?bookingid=".$row2['bookingid']."&bikeid=".$row2['bikeid']."' id='deactivate-a'><div id='deactive-btn'>DEACTIVATE</div></a>";
                                }elseif($row2['bookingst'] === "deactive"){
                                    echo "<a href='includes/activatebooking.inc.php?bookingid=".$row2['bookingid']."&bikeid=".$row2['bikeid']."' id='activate-a'><div id='activate-btn'>ACTIVATE</div></a>";
                                }
                                }else{
                                    echo "<strong>Sold!</strong>";
                                }
                                echo "</td>
                            </tr>";
                                }
                            }else {
                                echo "<td id='no-results'>No Bookings</td>";
                            }?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <script src="jsfiles/index.js"></script>
    </body>
</html>