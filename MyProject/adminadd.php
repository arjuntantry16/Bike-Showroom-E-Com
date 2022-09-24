<?php 
    include_once 'includes/dbh.inc.php';
    include_once 'header.php';
?>

<html>
    <head>
        <link rel="stylesheet" href="cssfiles/adminadd.css">
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
                if(isset($_GET['error'])){
                    $errormsg=$_GET['error'];
                    if($errormsg == "emptyfields"){
                        echo "<div class='error-container'><p id='emptyfields'>*Enter All Fields</p></div>";
                    }
                }elseif(isset($_GET['insertion'])){
                    $success = $_GET['insertion'];
                    if($success == "success"){
                    echo "<div class='error-container'><p id='emptyfields'>Inserted!</p></div>";
                }
            }
                ?>
                <div class="right-wrapper">
                    <div class="add-header-wrapper">
                        <h2 id="add-header">Add Bikes</h2>
                    </div>
                    <div class="form-wrapper">
                    <form action="includes/adminaddproducts.inc.php" method="post" id="form"  enctype= "multipart/form-data">
                        <div class = "inputs-container">
                            <label for="bikename">BikeName:</label>
                            <input type="text" name="bikename" placeholder="Bike Name">
                        </div>
                        <div class = "inputs-container">
                            <label for="bikeBrand">BrandName:</label>
                            <input type="text" name="bikebrand" placeholder="Bike Brand Name">
                            </div>
                        <div class = "inputs-container">
                            <label for="">BikeImage:</label>
                            <input type="file" name="file">
                        </div>
                        <div class = "inputs-container">
                            <label for="">BikeImage:</label>
                            <input type="file" name="file1">
                        </div>
                        <div class = "inputs-container">
                            <label for="">BikeImage:</label>
                            <input type="file" name="file2">
                        </div>
                        <div class = "inputs-container">
                            <label for="">BikeImage:</label>
                            <input type="file" name="file3">
                        </div>
                        <div class = "inputs-container">
                            <label for="">BrandLogo:</label>
                            <input type="file" name="brandlogo">
                        </div>
                        <div class = "inputs-container">
                            <label for="bikeprdno" >BikeProductionNumber:</label>
                            <input type="text" name="bikeprdno" placeholder="Production Number">
                        </div>
                        <div class = "inputs-container">
                            <label for="bikeprice">BikePrice:</label>
                            <input type="text" name="bikeprice" placeholder="Bike Price">
                        </div>
                        <div class = "inputs-container">
                            <label for="bikeqty">BikeQty:</label>
                            <input type="text" name="bikeqty" placeholder="Bike Quantity">
                        </div>
                        <div class = "inputs-container">
                            <label for="bikemileage">BikeMileage:</label>
                            <input type="text" name="bikemileage" placeholder="Bike Mileage">
                        </div>
                        <div class = "inputs-container">
                            <label for="bikeengine">BikeEngine:</label>
                            <input type="" name="bikeengine" placeholder="Bike Engine">
                        </div>
                        <div class = "inputs-container">
                            <label for="bikecc">BikePower:</label>
                            <input type="" name="bikepower" placeholder="Bike Power">
                        </div>
                        <div class = "inputs-container">
                            <label for="bikekerbweight">BikeKerbWeight:</label>
                            <input type="" name="bikekerbweight" placeholder="Bike Kerb Weight">
                        </div>
                        <div class = "inputs-container">
                            <label for="bikeabs">BikeAbs:</label>
                            <input type="" name="bikeabs" placeholder="Bike Abs">
                        </div>
                        <button type="submit" id="submit-button" name="product-submit">UPLOAD</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

