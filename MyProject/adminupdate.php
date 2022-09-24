<?php 
    include_once 'includes/dbh.inc.php';
    include_once 'header.php';
    
?>

<html>
    <head>
        <link rel="stylesheet" href="cssfiles/adminupdate.css">
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
                    }elseif ($errormsg == "qtyerror"){
                        echo "<div class='error-container'><p id='emptyfields'>*Quantity Cannot Be Characters</p></div>";
                    }
                }elseif(isset($_GET['update'])){
                    $success = $_GET['update'];
                    echo "<div class='error-container'><p id='emptyfields'>Updated!</p></div>";
                }

                ?>
                <div class="right-wrapper">
                    <div class="stock-header-wrapper">
                        <h2 id="stock-header">Stock Update</h2>
                    </div>
                    <div class="update-container">
                        <div class="update-wrapper">
                            <form action="includes/adminupdatestock.inc.php" method="post" id="update-form1">
                            <label id="selectbike-label">Select Bike:</label>
                                <select id="bike-select" name="bike-select">
                                    <?php
                                        $query = "select * from stock;";
                                        $result1=mysqli_query($conn,$query);
                                        if(mysqli_num_rows($result)>0){
                                            while($row=mysqli_fetch_assoc($result1)){
                                            echo "<option value='".$row['bikename']."'>".strtoupper($row['bikename'])."</option>";
                                            }
                                        }else{
                                            echo "<option>None</option>";
                                        }
                                        ?>
                                </select>
                                <label id="value-select-label">Select Value:<label>
                                <select id="value-select" name="value-select">
                                    <option value="bikename">Name</option>
                                    <option value="bikebrand">Brand Name</option>
                                    <option value="bikeqty">Quantity</option>
                                    <option value="bikeprice">Price</option>
                                    <option value="bikemileage">Mileage</option>
                                    <option value="bikepower">Power</option>
                                    <option value="bikeengine">Engine</option>
                                </select>
                                <label id="enter-label">Enter Value:<label>
                                <input type="text" name="update-value" id="update-value" placeholder="Enter Value">
                                <button name="update-submit" id="update-submit">UPDATE</button>
                            </form>
                        </div>
                    </div>
                    <table id="t1">
                        <tr>
                            <th>Bike ID</th>
                            <th id='bname'>Bike Name</th>
                            <th>Bike Brand</th>
                            <th>Bike Price</th>
                            <th>Bike Quantity</th>
                            <th>Bike Mileage</th>
                            <th>Bike Engine</th>
                            <th>Bike Power</th>
                        </tr>

                        <?php
                            $sql = "select * from stock order by bikeqtystatus desc;";
                            $result=mysqli_query($conn,$sql);
                            if(mysqli_num_rows($result) > 0){
                                while($row=mysqli_fetch_assoc($result)){
                                    echo "<tr><form action='' method='' id='update-form'>
                                                <td><input type='text' value='".$row['bikeid']."' id='input1'></td> 
                                                <td><input type='text' value='".strtoupper($row['bikename'])."' id='input1'</td> 
                                                <td><input type='text' value='".strtoupper($row['bikebrand'])."' id='input1'></td> 
                                                <td><input type='text' value='".$row['bikeprice']."' id='input1'></td> 
                                                <td><input type='text' value='".$row['bikeqty']."' id='input1'></td> 
                                                <td><input type='text' value='".$row['bikemileage']."' id='input1'></td>
                                                <td><input type='text' value='".$row['bikeengine']."cc' id='input1'></td>
                                                <td><input type='text' value='".$row['bikepower']."' id='input1'></td>
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

