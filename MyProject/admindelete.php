<?php 
    include_once 'includes/dbh.inc.php';
    include_once 'header.php';
?>

<html>
    <head>
        <link rel="stylesheet" href="cssfiles/admindelete.css">
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
                    <div class="delete-header-wrapper">
                        <h2 id="delete-header">
                            Delete
                        </h2>
                    </div>
                    <table id="t2">
                        <tr>
                            <th>Bike ID</th>
                            <th id='bname2'>Bike Name</th>
                            <th>Bike Brand</th>
                            <th>Bike Price</th>
                            <th>Bike Quantity</th>
                            <th>Bike Quantity Status</th>
                        </tr>

                        <?php
                            $sql = "select * from stock;";
                            $result=mysqli_query($conn,$sql);
                            if(mysqli_num_rows($result) > 0){
                                while($row=mysqli_fetch_assoc($result)){
                                    echo "<tr>
                                                <td>".$row['bikeid']."</td> 
                                                <td id='bname2'>".strtoupper($row['bikename'])."</td> 
                                                <td>".strtoupper($row['bikebrand'])."</td> 
                                                <td>".$row['bikeprice']."</td> 
                                                <td>".$row['bikeqty']."</td> 
                                                <td>".$row['bikeqtystatus']."</td> 
                                                <td><a href='includes/admindelete.inc.php?bikeid=".$row['bikeid']."' id='delete-a'><button name='delete-submit' type='button' id='delete-submit'>DELETE</button></a></td>
                                            </form></tr>";
                                }
                            }else {
                                echo "<p id='no-result'>No Results</p>;";
                            }
                        ?>
                        </form>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>

