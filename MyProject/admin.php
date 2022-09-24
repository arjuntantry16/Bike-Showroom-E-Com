<?php 
    include_once 'includes/dbh.inc.php';
    include_once 'header.php';
?>

<html>
    <head>
        <link rel = "stylesheet" href = "cssfiles/adminnav.css">
        <link rel = "stylesheet" href = "cssfiles/adminaddproducts.css">
    </head>
    <body>
    <div class= "outer-container">
        <div class="overall-container">
            <div class = "left-container">
                
                <div class = "list-items">
                    <a href="updatestock.php">Stock</a>
                </div>
                <div class = "list-items">
                    <a href="viewbooking.php">Bookings</a>
                </div>
                <div class = "list-items">
                    <a href="viewsales.php">Sales</a>
                </div>
                <div class = "list-items">
                    <a href="customerinfo.php">Customer Info</a>
                </div>
                <div class = "list-items">
                    <a href="adminpasschange.php">Change Password</a>
                </div>
            </div>
            <div class="right-container">
                <div class = "form-container">
                    <div class="heading-wrapper">
                        <h1 id="heading">Add Bikes</h1>
                    </div>
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
    </body>
</html>