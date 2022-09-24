<?php 
    include_once 'includes/dbh.inc.php';
    include_once 'header.php';
?>

<html>
    <head>
        <link rel="stylesheet" href="cssfiles/adminbookingsdelete.css">
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
                    <div class="delete-bookings-header-container">
                        <h2 id="delete-bookings-header">Delete Bookings</h2>
                    </div>
                    <div class="table-container">
                        <table id="bookings-table">
                            <tr>
                                <th>Booking ID</th>
                                <th>Client ID</th>
                                <th>Client Username</th>
                                <th>Bike ID</th>
                                <th>Booking Status</th>
                                <th>Booking Date</th>
                                <th>Payment Mode</th>
                            </tr>
                           <?php 
                           $sql2 = "select * from booking;";
                           $result2 = mysqli_query($conn,$sql2);
                           if(mysqli_num_rows($result2)>0){
                                while($row2=mysqli_fetch_assoc($result2)){
                           echo "<tr>
                                <td>".$row2['bookingid']."</td>
                                <td>".$row2['clientid']."</td>
                                <td>".strtoupper($row2['clientusername'])."</td>
                                <td>".$row2['bikeid']."</td>
                                <td>".strtoupper($row2['bookingstatus'])."</td>
                                <td>";$bookdate=$row2['bookingdate'];
                                $newdate1 = date("Y-m-d",strtotime($bookdate));
                                $timestamp = strtotime($newdate1);
                                $newdate=date("d-m-Y",$timestamp);
                             echo "$newdate</td>
                                <td>".strtoupper($row2['paymentmode'])."</td>
                                <td><a href='includes/adminbookingsdelete.inc.php?bookingid=".$row2['bookingid']."' id='del'><div id='btn'>DELETE</div></td>
                            </tr>";
                                }
                            }else {
                                echo "<p id='no-results'>No Results</p>";
                            }?>
                </div>
            </div>
        </div>
    </body>
</html>