<?php 
    include_once 'includes/dbh.inc.php';
    include_once 'header.php';
    if(isset($_GET['update'])){
        $success = $_GET['update'];
        echo "<div class='error-container'><p id='emptyfields'>Updated!</p></div>";
    }elseif(isset($_GET['delete'])){
        $success = $_GET['delete'];
        echo "<div class='error-container'><p id='emptyfields'>Deleted!</p></div>";
    }
?>

<html>
    <head>
        <link rel="stylesheet" href="cssfiles/adminsales.css">
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
            <?php
                if(isset($_GET['delete'])){
                    $errormsg=$_GET['delete'];
                    if($errormsg == "success"){
                        echo "<div class='error-container'><p id='emptyfields'>Deleted!</p></div>";
                    }
            }
                ?>
                <div class="right-wrapper">
                    <div class="sales-header-container">
                        <h2 id="sales-header">Sales Information</h2>
                    </div>
                    <div class="sales-update-form-container">
                        <div class="sales-update-form-wrapper">
                            <form action="includes/updatesales.inc.php" method="post" id="sales-form">
                                <label id="meh">Select Sales ID:</label>
                                <select name="sales-select" id="sales-select">
                                    <?php
                                        $sqlsales= "select * from sales;";
                                        $resultsales = mysqli_query($conn,$sqlsales);
                                        if(mysqli_num_rows($resultsales)>0){
                                            while($rowsales=mysqli_fetch_assoc($resultsales)){
                                                echo "<option value='".$rowsales['salesid']."'>".$rowsales['salesid']."</option>";
                                            }
                                        }else{
                                            echo "<option value='no results'>No Results</option>";
                                        }
                                    ?>
                                </select>
                                <label>Select Status</label>
                                <select name="status-select" id="status-select">
                                    <?php
                                        echo "<option value='y'>Delivered(Y)</option>
                                        <option value='n'>Not Delivered(N)</option>";
                                    ?>
                                </select>
                                <button type="submit" name="sales-submit" id="sales-submit">UPDATE</button>
                            </form>
                        </div>
                    </div>
                    <div class="table-container">
                        <table id="table1">
                            <tr>
                                <th>Sales ID</th>
                                <th>Booking ID</th>
                                <th>Client ID</th>
                                <th>Client Username</th>
                                <th>Bike ID</th>
                                <th>Sales Date</th>
                                <th>Final Payment Mode</th>
                                <th>Delivery Status</th>
                            </tr>
                            <?php
                                $sql2 = "select * from sales where salesstatus='s';";
                                $result2 = mysqli_query($conn,$sql2);
                                if(mysqli_num_rows($result2)>0){
                                    while($row2 = mysqli_fetch_assoc($result2)){
                                        echo "<tr>
                                        <td>".$row2['salesid']."</td>
                                        <td>".$row2['bookingid']."</td>
                                        <td>".$row2['clientid']."</td>
                                        <td>".strtoupper($row2['clientusername'])."</td>
                                        <td>".$row2['bikeid']."</td>
                                        <td>";
                                        $sdate1=$row2['salesdate'];
                                        $timestamp=strtotime($sdate1); 
                                        $sdate = date("d-m-Y",$timestamp);
                                        echo $sdate."</td>
                                        <td>".strtoupper($row2['paymentmode'])."</td>
                                        <td>".strtoupper($row2['deliverystatus'])."</td>
                                        <td><a href='includes/adminsalesdelete.inc.php?salesid=".$row2['salesid']."' id='a2'><button name='sales-delete' type='submit' id='sales-delete'>DELETE</button></a></td>
                                        </tr>";
                                    }
                                }else {
                                    echo "<p id='no-results>No Results</p>";
                                }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>