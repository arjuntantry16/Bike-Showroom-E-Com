<?php 
    include_once 'includes/dbh.inc.php';
    include_once 'header.php';
?>

<html>
    <head>
        <link rel="stylesheet" href="cssfiles/adminorder.css">
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
            <div class="right-container">
            <?php
                if(isset($_GET['error'])){
                    $errormsg=$_GET['error'];
                    if($errormsg == "emptyfields"){
                        echo "<div class='error-container'><p id='emptyfields'>*Enter All Fields</p></div>";
                    }elseif ($errormsg == "invalidqty"){
                        echo "<div class='error-container'><p id='emptyfields'>*Quantity Cannot Be Characters</p></div>";
                    }
                    elseif ($errormsg == "mailnotsent"){
                        echo "<div class='error-container'><p id='emptyfields'>*Mail Cannot Be Sent!</p></div>";
                    }
                }elseif(isset($_GET['mail'])){
                    $success = $_GET['mail'];
                    echo "<div class='error-container'><p id='emptyfields'>Order Sent!</p></div>";
                }elseif(isset($_GET['update'])){
                    $success = $_GET['update'];
                    echo "<div class='error-container'><p id='emptyfields'>Updated!</p></div>";
                }

                ?>
                <div class="order-header-wrapper">
                    <h2 id="order-header">Order</h2>
                </div>
                <div class="order-form-container">
                    <form id="order-form" action="includes/adminorder.inc.php" method="post">
                        <label>Select The Brand:</label>
                        <select name="brand-select">
                            <?php
                                $sqlbrand = "select * from supplier;";
                                $resultbrand=mysqli_query($conn,$sqlbrand);
                                if(mysqli_num_rows($resultbrand)>0){
                                    while($rowbrands=mysqli_fetch_assoc($resultbrand)){
                                        echo "<option value='".$rowbrands['supplierbrand']."'>".strtoupper($rowbrands['supplierbrand'])."</option>";
                                    }
                                }else{
                                    echo "<option value='no-results'>No-Results</option>";
                                }
                            ?>
                        </select>
                        <label>Select The Bike:</label>
                            <select name="bike-select">
                            <?php
                                $sqlbike = "select * from stock;";
                                $resultbike=mysqli_query($conn,$sqlbike);
                                if(mysqli_num_rows($resultbike)>0){
                                    while($rowbike=mysqli_fetch_assoc($resultbike)){
                                        echo "<option value='".$rowbike['bikename']."'>".strtoupper($rowbike['bikename'])."</option>";
                                    }
                                }else{
                                    echo "<option value='no-results'>No-Results</option>";
                                }
                            ?>
                        </select>
                        <label>Enter Quantity:</label>
                        <input type="text" name="qty" placeholder="Enter Quantity">
                        <button type="submit" id="order-btn" name="order-btn">ORDER</button>
                    </form><hr>
                    <div class="order-form-wrapper">
                        <div class="order-header-wrapper">
                            <h2 id="order-header">Update</h2>
                        </div>
                        <form id='order-form2' action="includes/adminorder.inc.php" method="post">
                            <label id=label1>Select Order:</label>
                            <select name="order-select">
                                <?php
                                    $sqlselect="select * from porder;";
                                    $resultselect=mysqli_query($conn,$sqlselect);
                                    if(mysqli_num_rows($resultselect)>0){
                                        while($rowselect=mysqli_fetch_assoc($resultselect)){
                                            echo "<option value='".$rowselect['orderid']."'>".$rowselect['orderid']."</option>";
                                        }
                                    }
                                ?>
                            </select>
                            <label id=label1>Select Status:</label>
                            <select name="status-select">
                                <option value="pending">Pending</option>
                                <option value="delivered">Delivered</option>
                            </select>
                            <button type="submit" id="status-btn" name="status-btn">UPDATE</button>
                        </form>
                    </div>
                    <div class="order-table-wrapper">
                        <table name="order-table" id="order-table3">
                            <tr>
                                <th>Order ID</th>
                                <th>Supplier ID</th>
                                <th>Bike ID</th>
                                <th>Quantity</th>
                                <th>Order Date</th>
                                <th>Order Status</th>
                            </tr>
                            <?php
                                $sqlorder="select * from porder;";
                                $resultorder =mysqli_query($conn,$sqlorder);
                                if(mysqli_num_rows($resultorder)>0){
                                    while($roworder=mysqli_fetch_assoc($resultorder)){
                                        echo "<tr>
                                                    <td>".$roworder['orderid']."</td>
                                                    <td>".$roworder['supplierid']."</td>
                                                    <td>".$roworder['bikeid']."</td>
                                                    <td>".$roworder['orderqty']."</td>
                                                    <td>";  
                                                        $date1=$roworder['orderdate'];
                                                        $timestamp=strtotime($date1);
                                                        $orderdate=date("d-m-Y",$timestamp);
                                                    echo $orderdate."</td>
                                                    <td>".strtoupper($roworder['orderstatus'])."</td>
                                                    <td><a href='includes/adminorderdelete.inc.php?orderid=".$roworder['orderid']."' id='orderdelete'><div class='order-delete-wrapper'>DELETE</div></a></td>
                                            </tr>";    
                                    }
                                }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>